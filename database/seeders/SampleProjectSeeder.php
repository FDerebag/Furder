<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SampleProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::create([
            'title' => 'Adagarden Flowers',
            'subtitle' => 'Çiçekçi E-Ticaret Platformu',
            'description' => 'Sakarya\'nın önde gelen çiçekçisi için geliştirilmiş modern e-ticaret platformu. Responsive tasarım ve SEO optimizasyonu.',
            'detailed_description' => 'Adagarden Flowers için geliştirilen bu platform, müşterilerin kolayca çiçek siparişi verebilmesi, WhatsApp üzerinden iletişim kurabilmesi ve aynı gün teslimat hizmeti alabilmesi için tasarlanmıştır. Site, mobil uyumlu responsive tasarıma sahip olup, SEO optimizasyonu ile Google\'da üst sıralarda yer almaktadır.',
            'client' => 'Adagarden Flowers',
            'category' => 'ecommerce',
            'technologies' => ['HTML5', 'CSS3', 'JavaScript', 'SEO Optimization', 'WhatsApp Integration', 'Responsive Design'],
            'project_url' => 'https://adagardenflowers.com/',
            'github_url' => null,
            'image_path' => null,
            'gallery' => null,
            'duration_days' => 21,
            'completed_at' => '2025-09-01',
            'status' => 'completed',
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Project::create([
            'title' => 'Kurumsal CRM Sistemi',
            'subtitle' => 'Müşteri İlişkileri Yönetimi',
            'description' => 'Laravel ve Vue.js ile geliştirilmiş modern kurumsal CRM sistemi. Satış takibi, müşteri yönetimi ve raporlama özellikleri.',
            'detailed_description' => 'Şirketlerin müşteri ilişkilerini daha etkin yönetebilmesi için tasarlanmış kapsamlı CRM sistemi. Lead yönetimi, satış süreci takibi, müşteri iletişim geçmişi ve detaylı raporlama özellikleri içermektedir.',
            'client' => null,
            'category' => 'web',
            'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'REST API', 'Bootstrap'],
            'project_url' => null,
            'github_url' => null,
            'image_path' => null,
            'gallery' => null,
            'duration_days' => 45,
            'completed_at' => '2025-08-15',
            'status' => 'completed',
            'is_featured' => false,
            'sort_order' => 2,
        ]);

        Project::create([
            'title' => 'Mobil E-Ticaret Uygulaması',
            'subtitle' => 'React Native Cross-Platform App',
            'description' => 'iOS ve Android için geliştirilmiş modern e-ticaret mobil uygulaması. Push notification ve güvenli ödeme sistemi.',
            'detailed_description' => 'React Native teknolojisiyle geliştirilen cross-platform mobil uygulama. Kullanıcı dostu arayüz, push notification desteği, güvenli ödeme altyapısı ve offline çalışma özelliklerine sahiptir.',
            'client' => null,
            'category' => 'mobile',
            'technologies' => ['React Native', 'TypeScript', 'Firebase', 'Redux', 'Stripe API'],
            'project_url' => null,
            'github_url' => null,
            'image_path' => null,
            'gallery' => null,
            'duration_days' => 60,
            'completed_at' => '2025-07-20',
            'status' => 'completed',
            'is_featured' => true,
            'sort_order' => 3,
        ]);

        echo "Sample projects created!\n";
    }
}
