<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetboProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::create([
            'title' => 'Petbo Evcil Hayvan Ürünleri',
            'subtitle' => 'E-Ticaret Platformu',
            'description' => 'Evcil hayvan sahipleri için kapsamlı online alışveriş platformu. Kedi, köpek, kuş, balık ve diğer evcil hayvanlar için kaliteli ürünler sunan modern e-ticaret sitesi.',
            'detailed_description' => 'Petbo, evcil hayvan sahiplerinin ihtiyaç duyduğu tüm ürünleri tek platformda buluşturan kapsamlı bir e-ticaret sitesidir. Kedi ve köpek mamalarından kuş kafeslerine, akvaryum ekipmanlarından kaplumbağa yemlerine kadar geniş ürün yelpazesi sunar. Site, kullanıcı dostu arayüzü, kategorize edilmiş ürün yapısı ve güvenli ödeme sistemi ile evcil hayvan sahiplerinin alışveriş deneyimini kolaylaştırır. Bayi sistemi ile toptan satış imkanı da sunan platform, hem bireysel hem de kurumsal müşterilere hizmet vermektedir.',
            'client' => 'Petbo',
            'category' => 'ecommerce',
            'technologies' => ['HTML5', 'CSS3', 'JavaScript', 'PHP', 'MySQL', 'Responsive Design', 'E-Commerce', 'Payment Integration'],
            'project_url' => 'https://petbo.com.tr/',
            'github_url' => null,
            'image_path' => null,
            'gallery' => null,
            'duration_days' => 35,
            'completed_at' => '2025-08-10',
            'status' => 'completed',
            'is_featured' => true,
            'sort_order' => 0,
        ]);

        echo "Petbo project added successfully!\n";
    }
}
