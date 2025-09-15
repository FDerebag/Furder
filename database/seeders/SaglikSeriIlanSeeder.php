<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaglikSeriIlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::create([
            'title' => 'Sağlık Seri İlan',
            'subtitle' => 'Sağlık Sektörü İş İlanları Platformu',
            'description' => 'Sağlık sektörü profesyonelleri için özel tasarlanmış iş ilanları platformu. Doktorlar, hemşireler ve diğer sağlık çalışanları için kapsamlı kariyer fırsatları sunan web sitesi.',
            'detailed_description' => 'Sağlık Seri İlan, Türkiye\'nin sağlık sektörüne odaklanan özel iş ilanları platformudur. Doktor iş ilanları, hemşire pozisyonları, sağlık kurumu ruhsat satışları ve uzman hekim kadroları gibi sağlık sektörüne özel hizmetler sunar. Platform, 743+ aktif ilan ile sağlık profesyonellerinin kariyer fırsatlarını keşfetmelerini sağlar. Şehir ve branş bazlı filtreleme, CV oluşturma, üye sistemi ve forum özellikleri ile kullanıcı deneyimini zenginleştirir. Nisa Danışmanlık Hizmetleri tarafından işletilen platform, Türkiye İş Kurumu izinli olarak faaliyet göstermektedir.',
            'client' => 'Nisa Danışmanlık Hizmetleri',
            'category' => 'web',
            'technologies' => ['PHP', 'MySQL', 'HTML5', 'CSS3', 'JavaScript', 'Bootstrap', 'User Management', 'Search & Filter System', 'Forum Integration'],
            'project_url' => 'https://www.saglikseriilan.com/',
            'github_url' => null,
            'image_path' => null,
            'gallery' => null,
            'duration_days' => 45,
            'completed_at' => '2025-07-15',
            'status' => 'completed',
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        echo "Sağlık Seri İlan project added successfully!\n";
    }
}
