<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VirtualTourSeeder extends Seeder
{
    public function run(): void
    {
        $defaultIframe = '<iframe src="https://cdn.pannellum.org/2.5/pannellum.htm?panorama=https://pannellum.org/images/alma.jpg" width="100%" height="500" frameborder="0" allowfullscreen></iframe>';

        DB::table('virtual_tour')->insert([
            'title'           => 'Jelajah Virtual 360° Desa Sitiwinangun',
            'description'     => 'Telusuri sudut rumah produksi dan proses kriya gerabah langsung dari layar Anda.',
            'embed_type'      => 'pannellum',
            'embed_code'      => $defaultIframe,
            'sanitized_code'  => $defaultIframe,
            'is_active'       => true,
            'version_history' => json_encode([]),
            'updated_by'      => null,
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);
    }
}
