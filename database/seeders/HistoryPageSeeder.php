<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistoryPageSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('history_pages')->insert([
            [
                'page_key'   => 'desa_history',
                'title'      => 'Sejarah Desa Sitiwinangun',
                'content'    => 'Desa Sitiwinangun berdiri sejak abad ke-15. Sitiwinangun dibentuk oleh Pangeran Panjunan dan dilanjutkan oleh Pangeran Jagabaya.',
                'updated_at' => now(),
            ],
            [
                'page_key'   => 'gerabah_history',
                'title'      => 'Sejarah Gerabah Sitiwinangun',
                'content'    => 'Kerajinan gerabah di Sitiwinangun memiliki karakter visual perpaduan budaya Sunda, Jawa, Islam, dan Tionghoa. Teknik pembuatan gerabah ini diwariskan secara lisan lintas generasi.',
                'updated_at' => now(),
            ],
            [
                'page_key'   => 'museum_profile',
                'title'      => 'Profil Museum 3D Sitiwinangun',
                'content'    => 'Museum 3D Sitiwinangun dirancang oleh tim TPLM Universitas Telkom sebagai wadah digital repository kriya desa Sitiwinangun untuk branding daerah.',
                'updated_at' => now(),
            ],
        ]);
    }
}
