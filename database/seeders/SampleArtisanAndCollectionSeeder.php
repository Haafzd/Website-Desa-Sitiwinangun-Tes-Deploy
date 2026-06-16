<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SampleArtisanAndCollectionSeeder extends Seeder
{
    public function run(): void
    {
        // Check if categories exist
        $categories = DB::table('categories')->pluck('id', 'slug')->toArray();
        if (empty($categories)) {
            $this->call(CategorySeeder::class);
            $categories = DB::table('categories')->pluck('id', 'slug')->toArray();
        }

        // Insert Artisans
        $artisanIds = [];
        
        $artisans = [
            [
                'name' => 'Mang Ade',
                'photo_url' => null,
                'years_active' => '35',
                'specialty' => 'Kendi Hias & Gentong Wudhu',
                'story' => 'Mang Ade adalah pengrajin gerabah generasi keempat di keluarganya. Memulai sejak usia remaja, beliau menguasai teknik putar miring yang khas dari Sitiwinangun.',
                'quote' => 'Tanah liat ini seperti lembaran sejarah. Kita membentuknya agar anak cucu kita tahu dari mana asal mereka.',
                'address' => 'Blok Pejaten, RT 02/RW 03, Desa Sitiwinangun',
                'phone' => '081234567890',
                'is_featured' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bi Junah',
                'photo_url' => null,
                'years_active' => '40',
                'specialty' => 'Peralatan Masak Tradisional & Celengan',
                'story' => 'Bi Junah mendedikasikan hidupnya untuk melestarikan pembuatan peralatan dapur tanah liat tradisional seperti cobek dan wajan. Beliau percaya memasak dengan gerabah memberi cita rasa tersendiri.',
                'quote' => 'Gerabah tidak hanya untuk pajangan, tapi untuk menghidupkan dapur kita dengan kehangatan bumi.',
                'address' => 'Blok Pos, RT 04/RW 01, Desa Sitiwinangun',
                'phone' => '087765432109',
                'is_featured' => true,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kang Maman',
                'photo_url' => null,
                'years_active' => '15',
                'specialty' => 'Vas Bunga Kontemporer',
                'story' => 'Kang Maman merupakan salah satu pengrajin muda yang menggabungkan teknik tradisional dengan desain modern minimalis untuk menyasar pasar urban.',
                'quote' => 'Inovasi adalah cara terbaik untuk menjaga agar tradisi gerabah tetap relevan di zaman modern.',
                'address' => 'Blok Kebon Kelapa, Desa Sitiwinangun',
                'phone' => '082199887766',
                'is_featured' => true,
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($artisans as $artisan) {
            $id = DB::table('artisans')->insertGetId($artisan);
            $artisanIds[$artisan['name']] = $id;
        }

        // Insert Collections
        $collections = [
            [
                'name' => 'Kendi Pratala Sitiwinangun',
                'slug' => 'kendi-pratala-sitiwinangun',
                'category_id' => $categories['kendi-wadah-air'] ?? 1,
                'photo_url' => '',
                'description' => 'Kendi air tradisional dengan hiasan relief bermotif parang tanah liat asli.',
                'history_origin' => 'Kendi ini digunakan oleh masyarakat Cirebon sejak zaman Kesultanan untuk menyimpan air minum harian agar tetap sejuk.',
                'philosophy' => 'Pratala berarti bumi, melambangkan kesuburan dan kerendahan hati.',
                'technique' => 'Teknik putar tangan (throwing) dikombinasikan dengan ukir manual.',
                'materials' => 'Tanah liat lokal Sitiwinangun, sekam padi untuk pembakaran.',
                'artisan_id' => $artisanIds['Mang Ade'],
                'location' => 'Bengkel Mang Ade, Blok Pejaten',
                'year' => 2024,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Guci Naga Sogan',
                'slug' => 'guci-naga-sogan',
                'category_id' => $categories['guci-gentong'] ?? 2,
                'photo_url' => '',
                'description' => 'Guci besar dekoratif dengan ornamen naga khas Cirebon dan pewarnaan sogan alami.',
                'history_origin' => 'Terinspirasi dari perpaduan budaya Tionghoa dan Jawa di pelabuhan kuno Cirebon.',
                'philosophy' => 'Naga melambangkan perlindungan dan kemakmuran.',
                'technique' => 'Pilin (coiling) tangan manual selama 2 minggu.',
                'materials' => 'Tanah liat merah, pewarna oksida besi alami.',
                'artisan_id' => $artisanIds['Mang Ade'],
                'location' => 'Bengkel Mang Ade, Blok Pejaten',
                'year' => 2023,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cobek Bumi Warni',
                'slug' => 'cobek-bumi-warni',
                'category_id' => $categories['peralatan-dapur'] ?? 6,
                'photo_url' => '',
                'description' => 'Cobek tradisional dengan ketahanan tinggi untuk kebutuhan dapur harian.',
                'history_origin' => 'Merupakan alat masak utama di dapur tradisional Cirebon sejak abad ke-17.',
                'philosophy' => 'Melambangkan kebersamaan dan kerja keras dalam menyiapkan pangan keluarga.',
                'technique' => 'Pinching (pijat tekan) dan cetak press.',
                'materials' => 'Tanah liat hitam vulkanis, pembakaran suhu tinggi.',
                'artisan_id' => $artisanIds['Bi Junah'],
                'location' => 'Rumah Bi Junah, Blok Pos',
                'year' => 2025,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vas Anila Modern',
                'slug' => 'vas-anila-modern',
                'category_id' => $categories['vas-pot'] ?? 4,
                'photo_url' => '',
                'description' => 'Vas bunga minimalis modern dengan sentuhan tekstur kasar alami tanah liat.',
                'history_origin' => 'Desain kontemporer yang dibuat pertama kali pada pameran kerajinan nasional 2024.',
                'philosophy' => 'Anila berarti angin, membawa kesegaran baru pada desain gerabah.',
                'technique' => 'Teknik putar cepat dilanjutkan dengan carving motif garis vertikal.',
                'materials' => 'Tanah liat campuran pasir halus.',
                'artisan_id' => $artisanIds['Kang Maman'],
                'location' => 'Studio Kang Maman, Blok Kebon Kelapa',
                'year' => 2026,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('collections')->insert($collections);
    }
}
