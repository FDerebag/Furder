<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Project;

// Adagarden Flowers projesini bul ve güncelle
$project = Project::where('title', 'Adagarden Flowers')->first();

if ($project) {
    // Mevcut görsel dosyasını kullan
    $project->update([
        'image_path' => 'projects/NBFwTCgMfsq3DiRIVk6ud4OFprnG68PdN5LKhSYv.png'
    ]);
    
    echo "Adagarden Flowers projesi güncellendi!\n";
    echo "Görsel yolu: " . $project->image_path . "\n";
} else {
    echo "Adagarden Flowers projesi bulunamadı!\n";
}
