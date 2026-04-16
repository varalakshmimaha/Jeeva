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
            'title' => 'Empowered Birth & Beyond',
            'description' => 'Compassionate birth doula support, prenatal yoga, childbirth education, and nutrition guidance for your journey into motherhood.',
            'image' => 'https://images.unsplash.com/photo-1519782522197-0ad0ea62dfeb?auto=format&fit=crop&w=1200&q=80',
        ]);
        \App\Models\Banner::create([
            'page' => 'home',
            'title' => 'Nourish Your Body and Mind',
            'description' => 'Holistic care through prenatal yoga and tailored nutrition to support you and your baby.',
            'image' => 'https://images.unsplash.com/photo-1447452001602-7090c7ab2bf3?auto=format&fit=crop&w=1200&q=80',
        ]);

        // 2. Seed Blogs
        \App\Models\Blog::truncate();
        $fallbackBlogs = [
            [
                'title' => 'The Benefits of a Birth Doula',
                'category' => 'Doula Support',
                'content' => "Having a birth doula by your side provides continuous physical, emotional, and informational support before, during, and after childbirth. Research shows that doula support can lead to shorter labor, fewer complications, and a more positive birth experience.\n\nA doula helps you navigate your birth plan, advocates for your preferences, and offers comfort techniques like massage, breathing exercises, and positioning. It is about creating a safe, empowering space where you feel heard and supported.\n\nWhether you are planning an unmedicated birth, a hospital birth with an epidural, or a cesarean, your doula is there exclusively for you and your partner, ensuring you transition into motherhood with confidence and peace.",
                'image' => 'https://images.unsplash.com/photo-1516627145497-ae6968895b74?auto=format&fit=crop&w=800&q=80',
                'slug' => 'benefits-of-birth-doula',
                'published' => true,
            ],
            [
                'title' => 'Prenatal Yoga for a Smooth Pregnancy',
                'category' => 'Prenatal Yoga',
                'content' => "Prenatal yoga is a multifaceted approach to exercise that encourages stretching, mental centering, and focused breathing. It is one of the best ways to prepare your body and mind for the journey of labor and delivery.\n\nRegular practice helps improve sleep, reduce stress, and minimize common pregnancy discomforts like lower back pain, nausea, and shortness of breath. The gentle stretching increases your strength and flexibility, particularly in the muscles needed for childbirth.\n\nBeyond the physical benefits, prenatal yoga offers a wonderful opportunity to connect with your growing baby and meet other expectant mothers. Building a community of support during this transformative time is invaluable.",
                'image' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=800&q=80',
                'slug' => 'prenatal-yoga-smooth-pregnancy',
                'published' => true,
            ],
            [
                'title' => 'Nourishing Nutrition for Two',
                'category' => 'Nutrition',
                'content' => "What you eat during pregnancy directly impacts your baby's growth and development, as well as your own health and energy levels. A balanced diet rich in essential nutrients is the foundation of a healthy pregnancy.\n\nFocus on incorporating plenty of colorful fruits and vegetables, whole grains, lean proteins, and healthy fats. Folate, iron, calcium, and DHA are particularly important during this time. Staying hydrated by drinking plenty of water throughout the day is equally crucial.\n\nEvery woman's nutritional needs are unique, especially if experiencing morning sickness or specific aversions. Personalized nutrition guidance can help you navigate these challenges and ensure you and your baby get the nourishment you need to thrive.",
                'image' => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&w=800&q=80',
                'slug' => 'nourishing-nutrition-for-two',
                'published' => true,
            ],
        ];
        foreach ($fallbackBlogs as $blogData) {
            \App\Models\Blog::create($blogData);
        }

        // 3. Seed Gallery
        \App\Models\GalleryItem::truncate();
        $galleryItems = [
            ['title' => 'Gentle Prenatal Yoga Session', 'category' => 'yoga', 'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=800&q=80', 'color_class' => 'tone-1'],
            ['title' => 'Nutrition & Meal Planning', 'category' => 'nutrition', 'image' => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&w=800&q=80', 'color_class' => 'tone-2'],
            ['title' => 'Comfort Measures in Labor', 'category' => 'doula', 'image' => 'https://images.unsplash.com/photo-1516627145497-ae6968895b74?auto=format&fit=crop&w=800&q=80', 'color_class' => 'tone-3'],
            ['title' => 'Childbirth Education Class', 'category' => 'education', 'image' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=800&q=80', 'color_class' => 'tone-4'],
        ];
        foreach ($galleryItems as $idx => $item) {
            \App\Models\GalleryItem::create(array_merge($item, ['order' => $idx]));
        }

        // 4. Seed Services
        \App\Models\Service::truncate();
        $services = [
            ['title' => 'Birth Doula Support', 'subtitle' => 'Continuous Labor Support', 'description' => 'Receive unwavering physical, emotional, and informational support throughout your pregnancy, labor, and the immediate postpartum period. Ensure your birth experience is respected, calm, and deeply empowering.', 'icon' => 'https://images.unsplash.com/photo-1516627145497-ae6968895b74?auto=format&fit=crop&w=400&q=80'],
            ['title' => 'Prenatal Yoga', 'subtitle' => 'Mind & Body Preparation', 'description' => 'Prepare your body for birth with customized prenatal yoga practices. Focus on gentle stretching, breathing techniques, and mental centering to relieve discomfort and increase flexibility.', 'icon' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=400&q=80'],
            ['title' => 'Childbirth Education', 'subtitle' => 'Knowledge is Power', 'description' => 'Comprehensive classes covering everything from the stages of labor and comfort measures to postpartum recovery. Feel confident and fully informed as you make choices for your birth plan.', 'icon' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=400&q=80'],
            ['title' => 'Nutrition Guidance', 'subtitle' => 'Nourishment for Two', 'description' => 'Personalized nutritional counseling to support optimal health during pregnancy and postpartum. Learn how to fuel your body and baby with the right balance of wholesome, nutrient-dense foods.', 'icon' => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&w=400&q=80'],
        ];
        foreach ($services as $idx => $service) {
            \App\Models\Service::create(array_merge($service, ['order' => $idx]));
        }

        // 5. Seed Testimonials
        \App\Models\Testimonial::truncate();
        $testimonials = [
            ['name' => 'Priya Sharma', 'role' => 'First-time Mother', 'message' => 'Jiva Birth and Beyond made my birthing experience truly beautiful. The doula support was incredible - I felt calm, informed, and empowered throughout. I cannot recommend them enough!', 'rating' => 5, 'published' => true, 'order' => 0],
            ['name' => 'Ananya Reddy', 'role' => 'Mother of Two', 'message' => 'The prenatal yoga classes were a game-changer for my second pregnancy. I felt so much stronger and more prepared compared to my first. The breathing techniques helped immensely during labor.', 'rating' => 5, 'published' => true, 'order' => 1],
            ['name' => 'Meera Krishnan', 'role' => 'Expectant Mother', 'message' => 'The nutrition guidance I received was personalized and practical. I finally understood what my body needed during pregnancy. My energy levels improved dramatically within weeks.', 'rating' => 4, 'published' => true, 'order' => 2],
            ['name' => 'Kavitha Nair', 'role' => 'New Mother', 'message' => 'The childbirth education classes gave me and my husband so much confidence. We knew exactly what to expect and felt like a team. The postpartum support was equally wonderful.', 'rating' => 5, 'published' => true, 'order' => 3],
        ];
        foreach ($testimonials as $t) {
            \App\Models\Testimonial::create($t);
        }

        // 6. Seed Site Settings
        \App\Models\SiteSetting::truncate();
        $settings = [
            ['key' => 'company_name', 'value' => 'Jiva Birth and Beyond'],
            ['key' => 'company_email', 'value' => 'info@jivabirthandbeyond.com'],
            ['key' => 'company_phone', 'value' => '+91 74832 11870'],
            ['key' => 'company_address', 'value' => 'Tippasandra, Bangalore, Karnataka 560075'],
            ['key' => 'company_hours', 'value' => 'Mon-Sat: 10:00 AM - 8:00 PM'],
            ['key' => 'logo_url', 'value' => '/images/about-us-dental.svg'],
        ];
        foreach ($settings as $setting) {
            \App\Models\SiteSetting::updateOrCreate(['key' => $setting['key']], ['value' => $setting['value']]);
        }

        // 7. Create Admin User
        \App\Models\User::truncate();
        \App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@jivabirthandbeyond.com',
            'password' => bcrypt('admin123'),
        ]);
    }
}
