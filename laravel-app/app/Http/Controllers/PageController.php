<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function home()
    {
        $banners = \App\Models\Banner::where('page', 'home')->orderBy('order', 'asc')->get();
        $services = \App\Models\Service::orderBy('order', 'asc')->get();
        $testimonials = \App\Models\Testimonial::where('published', true)->orderBy('order')->take(6)->get();
        $faqs = \App\Models\Faq::where('is_active', true)->orderBy('order')->get();
        return view('pages.home', [
            'pageName'     => 'home',
            'banners'      => $banners,
            'services'     => $services,
            'testimonials' => $testimonials,
            'faqs'         => $faqs,
        ]);
    }

    public function services()
    {
        $services = \App\Models\Service::orderBy('order', 'asc')->get();
        $banner = \App\Models\Banner::where('page', 'services')->orderBy('order', 'asc')->first();
        return view('pages.services', [
            'pageName' => 'services',
            'services' => $services,
            'banner' => $banner,
        ]);
    }

    public function serviceShow($id)
    {
        $service = \App\Models\Service::findOrFail($id);
        $relatedServices = \App\Models\Service::where('id', '!=', $id)->orderBy('order')->get();
        return view('pages.service-show', [
            'pageName' => 'services',
            'service' => $service,
            'relatedServices' => $relatedServices,
        ]);
    }

    public function about()
    {
        $banner = \App\Models\Banner::where('page', 'about')->orderBy('order', 'asc')->first();
        return view('pages.about', [
            'pageName' => 'about',
            'banner' => $banner,
        ]);
    }

    public function blog()
    {
        $banner = \App\Models\Banner::where('page', 'blog')->orderBy('order', 'asc')->first();
        return view('pages.blog', [
            'pageName' => 'blog',
            'blogs' => $this->publishedBlogs(),
            'banner' => $banner,
        ]);
    }

    public function blogShow(string $slug)
    {
        $article = $this->findBlogBySlug($slug);

        abort_unless(!empty($article), 404);

        return view('pages.blog-show', [
            'pageName' => 'blog',
            'article' => $article,
        ]);
    }

    public function gallery()
    {
        $galleryItems = \App\Models\GalleryItem::orderBy('order', 'asc')->get();
        $banner = \App\Models\Banner::where('page', 'gallery')->orderBy('order', 'asc')->first();
        return view('pages.gallery', [
            'pageName' => 'gallery',
            'galleryItems' => $galleryItems,
            'banner' => $banner,
        ]);
    }

    public function testimonials()
    {
        $testimonials = \App\Models\Testimonial::where('published', true)->orderBy('order')->get();
        $banner = \App\Models\Banner::where('page', 'testimonials')->orderBy('order', 'asc')->first();
        return view('pages.testimonials', [
            'pageName' => 'testimonials',
            'testimonials' => $testimonials,
            'banner' => $banner,
        ]);
    }

    public function contact()
    {
        $banner = \App\Models\Banner::where('page', 'contact')->orderBy('order', 'asc')->first();
        return view('pages.contact', [
            'pageName' => 'contact',
            'banner' => $banner,
        ]);
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    private function publishedBlogs(): Collection
    {
        $blogs = Blog::query()
            ->where('published', true)
            ->latest()
            ->get()
            ->values()
            ->map(function (Blog $blog, int $index) {
                return $this->transformDatabaseBlog($blog, $index);
            });

        if ($blogs->isNotEmpty()) {
            return $blogs;
        }

        return collect(array_values($this->fallbackBlogs()));
    }

    private function findBlogBySlug(string $slug): ?array
    {
        $blog = Blog::query()
            ->where('published', true)
            ->where('slug', $slug)
            ->first();

        if ($blog) {
            return $this->transformDatabaseBlog($blog, 0);
        }

        // Check fallback blogs with exact slug match
        if (isset($this->fallbackBlogs()[$slug])) {
            return $this->fallbackBlogs()[$slug];
        }

        // Check fallback blogs by matching slugified title (for admin-added blogs)
        $fallbackBlogs = $this->fallbackBlogs();
        foreach ($fallbackBlogs as $blog) {
            $slugifiedTitle = $this->generateSlug($blog['title']);
            if ($slugifiedTitle === $slug) {
                return $blog;
            }
        }

        return null;
    }

    private function generateSlug(string $title): string
    {
        // Match JavaScript behavior: lowercase and replace spaces with hyphens
        return strtolower(preg_replace('/\s+/', '-', trim($title)));
    }

    private function transformDatabaseBlog(Blog $blog, int $index): array
    {
        $plainText = trim(preg_replace('/\s+/', ' ', strip_tags((string) $blog->content)) ?? '');

        return [
            'title' => $blog->title,
            'slug' => $blog->slug,
            'category' => $blog->category,
            'excerpt' => $plainText !== ''
                ? Str::limit($plainText, 160, '...')
                : 'Explore practical dental guidance from our specialists.',
            'content' => $blog->content,
            'icon' => $blog->icon ?: '🦷',
            'image' => $blog->image,
            'thumb_class' => $this->blogThumbClass($index),
            'date' => $blog->created_at?->format('M d, Y') ?? now()->format('M d, Y'),
        ];
    }

    private function blogThumbClass(int $index): string
    {
        $thumbClasses = ['th1', 'th2', 'th3'];

        return $thumbClasses[$index % count($thumbClasses)];
    }

    private function fallbackBlogs(): array
    {
        return [
            'tips-for-dental-hygiene' => [
                'title' => 'Tips for Dental Hygiene',
                'slug' => 'tips-for-dental-hygiene',
                'category' => 'Hygiene',
                'excerpt' => 'Learn the best practices for maintaining healthy teeth and keeping your smile bright forever',
                'content' => "Daily brushing, flossing, and regular checkups are essential for good dental health. Visit us regularly for professional cleanups and expert advice on maintaining your oral health.\n\nHealthy teeth are built through consistency. Brushing twice a day with fluoride toothpaste, cleaning between teeth daily, and replacing your toothbrush regularly are small habits that prevent many common dental problems.\n\nDiet matters too. Frequent sugary snacks and acidic drinks increase the risk of decay and enamel wear. Drinking water after meals and limiting sticky snacks can help reduce that exposure.\n\nRegular checkups complete the picture. Even strong home care cannot remove hardened tartar or catch every early issue. Preventive dental visits help us detect concerns sooner, keep treatment simpler, and protect your smile over time.",
                'image' => '/images/blog_dental_hygiene.png',
                'thumb_class' => 'th1',
                'date' => 'Mar 28, 2025',
            ],
            'understanding-braces' => [
                'title' => 'Understanding Braces',
                'slug' => 'understanding-braces',
                'category' => 'Orthodontics',
                'excerpt' => 'Everything you need to know about orthodontic treatment and straightening your smile perfectly',
                'content' => "Braces are a popular choice for correcting misaligned teeth and improving your bite. Modern braces are more comfortable and discreet than ever before, with various options to suit your lifestyle.\n\nBraces work by applying gentle, continuous pressure to gradually move teeth into proper alignment. The process typically takes 18 to 24 months, though this varies depending on the complexity of your case.\n\nThere are several types of braces available today: traditional metal braces, ceramic braces that blend with your teeth, and lingual braces that go behind your teeth. Your orthodontist will help determine which option is best for your needs and goals.\n\nWith proper care and regular adjustments, braces can give you a beautiful, healthy smile that lasts a lifetime.",
                'image' => '/images/blog_braces.png',
                'thumb_class' => 'th2',
                'date' => 'Mar 25, 2025',
            ],
            'benefits-of-dental-implants' => [
                'title' => 'Benefits of Dental Implants',
                'slug' => 'benefits-of-dental-implants',
                'category' => 'Implants',
                'excerpt' => 'Discover why dental implants are the best long-term solution for missing teeth today',
                'content' => "Dental implants offer a permanent solution for missing teeth. They look, feel, and function like natural teeth, providing improved comfort, better eating ability, and enhanced confidence in your smile.\n\nDental implants replace missing teeth with a titanium post that functions like an artificial root. Once the implant integrates with the jawbone, it can support a crown, bridge, or denture with excellent stability and a very natural appearance.\n\nOne major benefit of implants is bone preservation. When a tooth is missing for a long time, the jawbone in that area can gradually shrink. Implants help stimulate the bone and reduce that loss, which supports long-term facial structure and oral function.\n\nImplants are more durable than other replacement options and can last 25+ years with proper care. Proper planning, bone evaluation, and aftercare make a big difference in long-term success.",
                'image' => '/images/blog_implants.png',
                'thumb_class' => 'th3',
                'date' => 'Mar 20, 2025',
            ],
            'benefits-of-invisalign-over-traditional-braces' => [
                'title' => 'The Benefits of Invisalign Over Traditional Braces',
                'slug' => 'benefits-of-invisalign-over-traditional-braces',
                'category' => 'Orthodontics',
                'excerpt' => 'Discover why transparent aligners are becoming the preferred choice for teeth straightening, with benefits in comfort, aesthetics, and daily convenience.',
                'content' => "Invisalign aligners offer a cleaner, more flexible orthodontic experience for many teens and adults. Because the trays are clear and removable, patients can continue eating their favorite foods and maintaining normal brushing and flossing habits without the challenges that fixed brackets create.\n\nTreatment planning is also highly precise. Digital scans allow us to map tooth movement stage by stage, which helps patients understand what to expect before treatment begins. Many people appreciate the smoother feel of aligners and the reduced number of emergency visits caused by broken wires or loose brackets.\n\nTraditional braces are still an excellent option for complex alignment issues, but Invisalign is often ideal when appearance, comfort, and routine flexibility matter most. A consultation helps determine which approach fits your bite, goals, and timeline best.",
                'image' => '/images/blog_invisalign.png',
                'thumb_class' => 'th1',
                'date' => 'Mar 15, 2025',
            ],
            'complete-guide-to-root-canal-treatment' => [
                'title' => 'Complete Guide to Root Canal Treatment',
                'slug' => 'complete-guide-to-root-canal-treatment',
                'category' => 'General Care',
                'excerpt' => 'Everything you need to know about root canal treatment, including the procedure, pain management, recovery, and long-term results.',
                'content' => "A root canal treatment is performed when the inner pulp of a tooth becomes infected or inflamed. Instead of removing the entire tooth, the procedure carefully cleans the infected canal space, disinfects it, and seals it to protect the tooth structure.\n\nModern root canal therapy is far more comfortable than many people expect. With local anesthesia and improved instrumentation, most patients describe the experience as similar to getting a filling. After treatment, some tenderness is normal for a short period, but it usually settles quickly with proper care and the medications your dentist recommends.\n\nThe biggest advantage of root canal treatment is that it helps preserve your natural tooth. Saving the tooth keeps your bite stable, protects surrounding teeth, and avoids more extensive replacements whenever possible.",
                'image' => '/images/blog_root_canal.png',
                'thumb_class' => 'th2',
                'date' => 'Mar 10, 2025',
            ],
            'teeth-whitening-professional-vs-at-home-methods' => [
                'title' => 'Teeth Whitening: Professional vs At-Home Methods',
                'slug' => 'teeth-whitening-professional-vs-at-home-methods',
                'category' => 'Cosmetic',
                'excerpt' => 'Compare professional whitening with DIY kits and understand which option is safer, faster, and more effective for your smile.',
                'content' => "Professional teeth whitening delivers stronger, more even results because it is supervised by dental experts. We evaluate gum health, enamel condition, and existing restorations before treatment so the process stays both safe and predictable.\n\nAt-home whitening kits can still be useful, especially for mild staining or touch-ups, but they often take longer and may cause sensitivity if used incorrectly. Over-the-counter products also vary widely in strength and fit, which affects how evenly the gel contacts your teeth.\n\nIf you want fast improvement for a special event or a major smile refresh, professional whitening is usually the better choice. If you are unsure, a quick exam can tell you whether stains are likely to respond well and which approach will protect your enamel best.",
                'image' => '/images/dentist_checking_patient.png',
                'thumb_class' => 'th3',
                'date' => 'Mar 05, 2025',
            ],
            'dental-implants-a-permanent-solution-for-missing-teeth' => [
                'title' => 'Dental Implants: A Permanent Solution for Missing Teeth',
                'slug' => 'dental-implants-a-permanent-solution-for-missing-teeth',
                'category' => 'Implants',
                'excerpt' => 'Learn how dental implants restore chewing function, preserve bone support, and provide a long-lasting replacement for missing teeth.',
                'content' => "Dental implants replace missing teeth with a titanium post that functions like an artificial root. Once the implant integrates with the jawbone, it can support a crown, bridge, or denture with excellent stability and a very natural appearance.\n\nOne major benefit of implants is bone preservation. When a tooth is missing for a long time, the jawbone in that area can gradually shrink. Implants help stimulate the bone and reduce that loss, which supports long-term facial structure and oral function.\n\nImplants are not the right solution for every situation immediately, but for many patients they provide the most durable and comfortable replacement option available. Proper planning, bone evaluation, and aftercare make a big difference in long-term success.",
                'image' => '/images/blog_implants.png',
                'thumb_class' => 'th1',
                'date' => 'Feb 28, 2025',
            ],
            'making-dental-visits-fun-for-children' => [
                'title' => 'Making Dental Visits Fun for Children',
                'slug' => 'making-dental-visits-fun-for-children',
                'category' => 'Kids Dentistry',
                'excerpt' => 'Practical tips for helping children feel relaxed and confident before, during, and after dental visits.',
                'content' => "A child's first few dental visits shape how they feel about oral care for years. Simple preparation at home can make a big difference. Try talking positively about the dentist, reading friendly storybooks about checkups, and avoiding scary words like pain or injection.\n\nDuring the visit, children respond well to calm explanations, a welcoming environment, and short praise-filled steps. Preventive appointments are especially helpful because they allow kids to build trust without coming in only when something hurts.\n\nParents play an important role by modeling a relaxed attitude. When children see dental care as a normal part of staying healthy, they are more likely to cooperate, ask questions, and build confidence in keeping their teeth clean.",
                'image' => '/images/dentist_checking_patient.png',
                'thumb_class' => 'th2',
                'date' => 'Feb 20, 2025',
            ],
            'daily-habits-for-a-lifetime-of-healthy-teeth' => [
                'title' => 'Daily Habits for a Lifetime of Healthy Teeth',
                'slug' => 'daily-habits-for-a-lifetime-of-healthy-teeth',
                'category' => 'Prevention',
                'excerpt' => 'Small daily choices in brushing, flossing, diet, and routine checkups can protect your smile for the long term.',
                'content' => "Healthy teeth are built through consistency more than intensity. Brushing twice a day with fluoride toothpaste, cleaning between teeth daily, and replacing your toothbrush regularly are small habits that prevent many common dental problems.\n\nDiet matters too. Frequent sugary snacks and acidic drinks increase the risk of decay and enamel wear, especially when they are consumed throughout the day. Drinking water after meals and limiting sticky snacks can help reduce that exposure.\n\nRegular checkups complete the picture. Even strong home care cannot remove hardened tartar or catch every early issue. Preventive dental visits help us detect concerns sooner, keep treatment simpler, and protect your smile over time.",
                'image' => '/images/blog_dental_hygiene.png',
                'thumb_class' => 'th3',
                'date' => 'Feb 15, 2025',
            ],
            'sedation-dentistry-a-closer-look' => [
                'title' => 'Sedation Dentistry: A Relaxing Dental Experience',
                'slug' => 'sedation-dentistry-a-closer-look',
                'category' => 'General Care',
                'excerpt' => 'Learn how modern sedation techniques can make your dental visit anxiety-free and completely comfortable.',
                'content' => "Many patients experience some level of anxiety when visiting the dentist. Sedation dentistry offers a way to receive necessary dental care in a state of total relaxation. From mild nitrous oxide (laughing gas) to deeper conscious sedation, there are options tailored to your comfort level.\n\nSedation is particularly helpful for patients undergoing longer procedures, those with sensitive teeth, or those who have had difficult dental experiences in the past. It allows the dentist to perform multiple treatments in a single session, saving you time and reducing the number of visits required.\n\nOur team is highly trained in administering and monitoring sedation to ensure your absolute safety. Before any procedure, we discuss your medical history and specific needs to choose the right sedation method for you. Experience a new level of calmness in the dental chair.",
                'image' => '/images/dentist_checking_patient.png',
                'thumb_class' => 'th1',
                'date' => 'Apr 01, 2025',
            ],
            'how-to-choose-the-right-toothbrush' => [
                'title' => 'How to Choose the Right Toothbrush',
                'slug' => 'how-to-choose-the-right-toothbrush',
                'category' => 'Hygiene',
                'excerpt' => 'Manual or electric? Soft or medium bristles? We help you navigate the aisles to find the perfect brush for your smile.',
                'content' => "Walking down the dental care aisle can be overwhelming with hundreds of toothbrush options. However, for most people, the simplest choice is often the best: a soft-bristled brush. Soft bristles are gentle on your gums and enamel while still being highly effective at removing plaque.\n\nElectric toothbrushes are a fantastic investment for those who want a more thorough cleaning with less effort. Many come with built-in timers and pressure sensors that ensure you brush for the full two minutes without applying too much force. Manual brushes can be just as effective, but they require a more meticulous technique.\n\nDon't forget to replace your brush (or brush head) every three to four months, or sooner if the bristles become frayed. A worn-out toothbrush is less efficient at cleaning and can even harbor bacteria over time. Choose a handle that feels comfortable in your hand and a head size that easily reaches all areas of your mouth.",
                'icon' => '🪥',
                'image' => '/images/blog_dental_hygiene.png',
                'thumb_class' => 'th2',
                'date' => 'Mar 31, 2025',
            ],
            'the-impact-of-diet-on-oral-health' => [
                'title' => 'The Impact of Diet on Oral Health',
                'slug' => 'the-impact-of-diet-on-oral-health',
                'category' => 'Prevention',
                'excerpt' => 'What you eat directly affects the health of your teeth and gums. Discover the best (and worst) foods for your smile.',
                'content' => "Your diet plays a critical role in preventing cavities and gum disease. Sugary foods and drinks are the well-known culprits, as they feed the bacteria that produce acids, leading to enamel erosion. However, it's not just about what you avoid—it's also about what you include.\n\nCrunchy fruits and vegetables like apples and carrots act as natural toothbrushes, stimulating saliva flow and scrubbing away surface particles. Calcium-rich foods like cheese and yogurt help remineralize enamel, while leafy greens provide essential vitamins for gum health.\n\nTiming also matters. Snacking throughout the day keeps your teeth in a constant 'acid bath.' It's better to eat treats with a full meal when saliva production is higher, which helps neutralize acids and wash away food particles. Drinking plenty of water, especially after meals, is the simplest way to keep your mouth clean and hydrated.",
                'image' => '/images/blog_implants.png',
                'thumb_class' => 'th3',
                'date' => 'Mar 30, 2025',
            ],
        ];
    }
}
