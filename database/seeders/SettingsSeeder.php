<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            // General Settings
            ['key' => 'site_name', 'value' => 'PropertyID', 'type' => 'string', 'description' => 'Nama website'],
            ['key' => 'site_description', 'value' => 'Website Properti Terbaik di Indonesia', 'type' => 'string', 'description' => 'Deskripsi website'],
            
            // Contact Information
            ['key' => 'company_address', 'value' => 'Jl. Contoh Alamat No. 123, Jakarta Selatan', 'type' => 'text', 'description' => 'Alamat perusahaan'],
            ['key' => 'company_phone', 'value' => '+62 21 1234 5678', 'type' => 'string', 'description' => 'Nomor telepon'],
            ['key' => 'company_email', 'value' => 'info@propertyid.com', 'type' => 'string', 'description' => 'Email perusahaan'],
            ['key' => 'company_whatsapp', 'value' => '+6281234567890', 'type' => 'string', 'description' => 'Nomor WhatsApp'],
            ['key' => 'business_hours', 'value' => 'Senin - Jumat: 09:00 - 17:00', 'type' => 'string', 'description' => 'Jam operasional'],
            
            // Social Media
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/propertyid', 'type' => 'string', 'description' => 'URL Facebook'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/propertyid', 'type' => 'string', 'description' => 'URL Instagram'],
            ['key' => 'social_twitter', 'value' => 'https://twitter.com/propertyid', 'type' => 'string', 'description' => 'URL Twitter'],
            ['key' => 'social_linkedin', 'value' => 'https://linkedin.com/company/propertyid', 'type' => 'string', 'description' => 'URL LinkedIn'],
            ['key' => 'social_youtube', 'value' => 'https://youtube.com/propertyid', 'type' => 'string', 'description' => 'URL YouTube'],
            
            // SEO Settings
            ['key' => 'meta_title', 'value' => 'PropertyID - Jual Beli Properti Terpercaya', 'type' => 'string', 'description' => 'Meta title'],
            ['key' => 'meta_description', 'value' => 'Temukan properti impian Anda dengan harga terbaik. Rumah, apartemen, tanah, dan properti komersial lainnya.', 'type' => 'text', 'description' => 'Meta description'],
            ['key' => 'meta_keywords', 'value' => 'properti, rumah, apartemen, tanah, jual beli properti', 'type' => 'string', 'description' => 'Meta keywords'],
            
            // About Us
            ['key' => 'about_us_content', 'value' => 'Kami adalah perusahaan properti terpercaya yang telah membantu ribuan klien menemukan properti impian mereka. Dengan pengalaman lebih dari 10 tahun, kami menyediakan layanan terbaik dalam jual beli properti.', 'type' => 'text', 'description' => 'Konten tentang kami'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}