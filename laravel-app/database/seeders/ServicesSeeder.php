<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServicesSeeder extends Seeder
{
    public function run(): void
    {
        Service::truncate();

        $services = [
            [
                'title' => 'Birth Doula',
                'subtitle' => 'Continuous Pregnancy & Birth Care',
                'description' => '🤍 Supporting you through pregnancy, birth, and postpartum with calm, informed, and continuous care.',
                'content' => <<<EOT
Why Choose a Doula?

Pregnancy and birth are deeply emotional, physical, and life-changing experiences. While medical care focuses on safety and clinical support, a doula focuses on you—your comfort, emotions, confidence, and overall experience.

During labor especially, having a familiar, steady presence can make a significant difference. A doula stays with you throughout the entire process—offering reassurance, guiding you through breathing and comfort techniques, helping with positioning, and supporting your partner as well. This continuous care can reduce fear, improve relaxation, and help you feel more in control of your birth experience.

Beyond birth, a doula also supports the transition into postpartum life, helping you recover emotionally, bond with your baby, and feel more grounded in your new role.

In simple terms, a doula ensures you are never alone in your journey—physically, emotionally, or mentally.

Packages
EOT,
                'icon' => 'images/cred-doula.png',
            ],
            [
                'title' => 'Prenatal Yoga',
                'subtitle' => 'Safe Movement for Pregnancy',
                'description' => 'Gentle, safe movement and breathwork to support your changing body during pregnancy—helping you feel strong, calm, and deeply connected to your baby.',
                'content' => <<<EOT
Prenatal yoga is a gentle and safe practice designed specifically for pregnancy. It supports your body through the physical changes of pregnancy while also calming the mind and preparing you for birth. It is not about intensity—it is about connection, awareness, and ease.

Through mindful movement, breathwork, and relaxation techniques, prenatal yoga helps you stay active in a safe way while creating space for your body to adapt comfortably to each stage of pregnancy.

It also helps you build a deeper connection with your baby, reduce stress, and prepare both physically and mentally for labor and delivery.

Packages
EOT,
                'icon' => 'images/cred-prenatal-yoga.png',
            ],
            [
                'title' => 'Postpartum Rebalance',
                'subtitle' => 'Recovery, Alignment & Strength',
                'description' => 'Gentle therapeutic support to restore pelvic health, core strength, and body alignment after birth—helping you feel balanced, supported, and connected as you recover.',
                'content' => <<<EOT
Postpartum Rebalance is a gentle, therapeutic approach designed to support your body after childbirth. Pregnancy and delivery bring major changes to your pelvic floor, core muscles, posture, and overall alignment. This service focuses on helping your body recover safely and naturally.

Through guided movement, breathwork, and restorative techniques, we work on rebuilding pelvic strength, improving stability, and reducing discomfort in the lower back, hips, and abdomen.

This is not about rushing recovery—it is about supporting your body at its own pace while helping you feel stronger, more stable, and more connected again.

Along with physical healing, this practice also supports emotional grounding during the postpartum phase, helping you transition more smoothly into motherhood.

Packages
EOT,
                'icon' => 'images/cred-therapeutic-yoga.png',
            ],
            [
                'title' => 'Labour Management & Comfort Measures',
                'subtitle' => 'Natural Pain & Labour Support',
                'description' => 'Natural comfort measures and techniques to ease pain and help you feel grounded during birth.',
                'content' => <<<EOT
This session provides continuous support during labor with a focus on comfort, confidence, and informed decision-making.

The session also includes guidance on natural methods that may support the body in preparing for labor, along with education about medical induction of labor—what it involves, why it may be recommended, and how it differs from a natural onset of labor.

We also discuss C-section (cesarean birth) in a simple, informative way so you understand when it may be needed, what the process generally looks like, and how to feel emotionally prepared if circumstances change during birth.

You will also be guided through pain-coping strategies such as positioning changes, breath awareness, and comfort measure techniques to help you feel more in control and less overwhelmed during contractions.

The session also includes emotional reassurance, education about what is happening in each stage, and support for your partner so they can actively assist you.

The focus is not on medical intervention, but on helping you feel safe, informed, and empowered throughout your labor journey.

The goal of this session is to help you feel informed, calm, and empowered—no matter how your birth unfolds.

Packages
EOT,
                'icon' => 'images/why_support.png',
            ],
            [
                'title' => 'Fat Loss Program',
                'subtitle' => 'Sustainable Holistic Weight Loss',
                'description' => 'A sustainable fat loss journey designed to balance your hormones, improve metabolism, and reduce inflammation—helping you lose weight naturally with simple, realistic lifestyle changes.',
                'content' => <<<EOT
This Fat Loss Program is not a restrictive diet plan—it is a holistic lifestyle approach designed to support long-term, healthy weight loss.

The focus is on improving metabolism, balancing hormones, and reducing inflammation through personalized nutrition, mindful eating habits, and lifestyle adjustments that are realistic and easy to follow.

The program also integrates simple movement practices, breathwork, and stress management techniques to support both physical and emotional well-being, as stress and lifestyle patterns play a major role in weight gain and resistance to fat loss.

Special attention is given to conditions like thyroid imbalance, PCOS tendencies, digestive issues, and hormonal fluctuations, ensuring the approach is gentle and suitable for your body's needs.

The goal is not quick results, but a steady, sustainable transformation where your body feels lighter, more energetic, and balanced over time.

Packages
EOT,
                'icon' => 'images/why_mindbody.png',
            ],
        ];

        foreach ($services as $idx => $service) {
            Service::create(array_merge($service, ['order' => $idx]));
        }
    }
}
