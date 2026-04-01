<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Banners
        \App\Models\Banner::truncate();
        \App\Models\Banner::create([
            'page' => 'home',
            'title' => 'Complete Smile Solutions',
            'description' => 'Experience the most advanced dental care in Bangalore with our expert team.',
            'image' => '/images/dentist_checking_patient.png',
        ]);
        \App\Models\Banner::create([
            'page' => 'home',
            'title' => 'Your Journey to a Perfect Smile',
            'description' => 'Modern orthodontics and painless treatments tailored for your comfort.',
            'image' => '/images/blog_braces.png',
        ]);

        // 2. Seed Blogs (Migrate Fallback Blogs)
        \App\Models\Blog::truncate();
        $fallbackBlogs = [
            [
                'title' => 'Tips for Dental Hygiene',
                'category' => 'Hygiene',
                'content' => "Daily brushing, flossing, and regular checkups are essential for good dental health. Visit us regularly for professional cleanups and expert advice on maintaining your oral health.\n\nHealthy teeth are built through consistency. Brushing twice a day with fluoride toothpaste, cleaning between teeth daily, and replacing your toothbrush regularly are small habits that prevent many common dental problems.\n\nDiet matters too. Frequent sugary snacks and acidic drinks increase the risk of decay and enamel wear. Drinking water after meals and limiting sticky snacks can help reduce that exposure.\n\nRegular checkups complete the picture. Even strong home care cannot remove hardened tartar or catch every early issue. Preventive dental visits help us detect concerns sooner, keep treatment simpler, and protect your smile over time.",
                'image' => '/images/blog_dental_hygiene.png',
                'slug' => 'tips-for-dental-hygiene',
                'published' => true,
            ],
            [
                'title' => 'Understanding Braces',
                'category' => 'Orthodontics',
                'content' => "Braces are a popular choice for correcting misaligned teeth and improving your bite. Modern braces are more comfortable and discreet than ever before, with various options to suit your lifestyle.\n\nBraces work by applying gentle, continuous pressure to gradually move teeth into proper alignment. The process typically takes 18 to 24 months, though this varies depending on the complexity of your case.\n\nThere are several types of braces available today: traditional metal braces, ceramic braces that blend with your teeth, and lingual braces that go behind your teeth. Your orthodontist will help determine which option is best for your needs and goals.\n\nWith proper care and regular adjustments, braces can give you a beautiful, healthy smile that lasts a lifetime.",
                'image' => '/images/blog_braces.png',
                'slug' => 'understanding-braces',
                'published' => true,
            ],
            [
                'title' => 'Benefits of Dental Implants',
                'category' => 'Implants',
                'content' => "Dental implants offer a permanent solution for missing teeth. They look, feel, and function like natural teeth, providing improved comfort, better eating ability, and enhanced confidence in your smile.\n\nDental implants replace missing teeth with a titanium post that functions like an artificial root. Once the implant integrates with the jawbone, it can support a crown, bridge, or denture with excellent stability and a very natural appearance.\n\nOne major benefit of implants is bone preservation. When a tooth is missing for a long time, the jawbone in that area can gradually shrink. Implants help stimulate the bone and reduce that loss, which supports long-term facial structure and oral function.\n\nImplants are more durable than other replacement options and can last 25+ years with proper care. Proper planning, bone evaluation, and aftercare make a big difference in long-term success.",
                'image' => '/images/blog_implants.png',
                'slug' => 'benefits-of-dental-implants',
                'published' => true,
            ],
        ];
        foreach ($fallbackBlogs as $blogData) {
            \App\Models\Blog::create($blogData);
        }

        // 3. Seed Gallery
        \App\Models\GalleryItem::truncate();
        $galleryItems = [
            ['title' => 'Reception & Waiting Area', 'category' => 'clinic-interior', 'image' => '/images/dentist_checking_patient.png', 'color_class' => 'tone-1'],
            ['title' => 'Modern Consultation Suite', 'category' => 'clinic-interior', 'image' => '/images/blog_dental_hygiene.png', 'color_class' => 'tone-2'],
            
            ['title' => 'Advanced Treatment Room', 'category' => 'equipment', 'image' => '/images/dentist_checking_patient.png', 'color_class' => 'tone-3'],
            ['title' => 'Clinical Sterilization Unit', 'category' => 'equipment', 'image' => '/images/blog_implants.png', 'color_class' => 'tone-4'],
            
            ['title' => 'Smile Makeover Result', 'category' => 'before-after', 'image' => '/images/blog_invisalign.png', 'color_class' => 'tone-5'],
            ['title' => 'Braces Transformation', 'category' => 'before-after', 'image' => '/images/blog_braces.png', 'color_class' => 'tone-6'],
        ];
        foreach ($galleryItems as $idx => $item) {
            \App\Models\GalleryItem::create(array_merge($item, ['order' => $idx]));
        }
    }
}
