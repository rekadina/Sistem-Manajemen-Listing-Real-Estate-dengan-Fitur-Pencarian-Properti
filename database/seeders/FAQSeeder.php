<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FAQ;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'How long does it take to get a response?',
                'answer' => 'We typically respond to inquiries within 24 hours during business days.',
                'is_active' => true,
                'order' => 1
            ],
            [
                'question' => 'What payment methods do you accept?',
                'answer' => 'We accept all major credit cards, bank transfers, and digital payments.',
                'is_active' => true,
                'order' => 2
            ],
            [
                'question' => 'Can I schedule a property viewing?',
                'answer' => 'Yes, you can schedule viewings by contacting our agents or using the viewing form.',
                'is_active' => true,
                'order' => 3
            ],
            [
                'question' => 'Are your properties listed anywhere else?',
                'answer' => 'Yes, our properties are listed on major real estate portals and our exclusive platform.',
                'is_active' => true,
                'order' => 4
            ],
            [
                'question' => 'Do you offer property management services?',
                'answer' => 'We offer comprehensive property management services for investors and owners.',
                'is_active' => true,
                'order' => 5
            ],
        ];

        foreach ($faqs as $faq) {
            FAQ::create($faq);
        }
    }
}