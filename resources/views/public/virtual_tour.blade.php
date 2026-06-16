@extends('layouts.public')

@section('title', 'Virtual Tour 360° — Museum Digital Gerabah Sitiwinangun')
@section('meta_description', $tour ? Str::limit($tour->description, 150) : 'Jelajahi Desa Sitiwinangun dan rumah produksi gerabah dalam panorama 360° interaktif.')

@section('content')

{{-- Header --}}
<section class="bg-base-200 bg-batik-pattern py-16 px-4">
    <div class="max-w-5xl mx-auto text-center">
        <span class="text-sm font-semibold uppercase tracking-wider text-primary">Pengalaman Virtual</span>
        <h1 class="section-heading text-center text-3xl md:text-4xl animate-fade-in-up">Jelajahi Sitiwinangun dalam 360°</h1>
        <p class="text-base-content/60 max-w-2xl mx-auto mt-4 animate-fade-in-up leading-relaxed" style="animation-delay:0.15s">
            @if($tour)
                {{ $tour->description }}
            @else
                Jelajahi keindahan desa wisata gerabah Sitiwinangun, ruang produksi, dan galeri pameran secara virtual dari sudut pandang 360 derajat.
            @endif
        </p>
    </div>
</section>

{{-- Tour Container --}}
<section class="py-12 px-4" id="virtual-tour-section">
    <div class="max-w-5xl mx-auto">
        @if($tour && $tour->is_active && $tour->sanitized_code)
            <div class="flex flex-col gap-6"
                 x-data="{
                    isFullscreen: false,
                    toggleFullscreen() {
                        let elem = document.getElementById('tour-viewer-container');
                        if (!elem) return;
                        if (!document.fullscreenElement) {
                            elem.requestFullscreen().then(() => {
                                this.isFullscreen = true;
                            }).catch(err => {
                                alert(`Gagal mengaktifkan mode layar penuh: ${err.message}`);
                            });
                        } else {
                            document.exitFullscreen();
                            this.isFullscreen = false;
                        }
                    }
                 }"
                 @fullscreenchange.window="isFullscreen = !!document.fullscreenElement">

                {{-- Interactive Guide Alert --}}
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-primary/10 text-primary p-4 rounded-box border border-primary/20 text-sm" id="interaction-guide">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-primary text-primary-content rounded-full">
                            {{-- Rotate Icon --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 7.89M9 11l3-3 3 3m-3-3v12"/>
                            </svg>
                        </div>
                        <p class="font-medium text-center sm:text-left">
                            Drag atau geser untuk navigasi 360°; scroll/pinch untuk zoom
                        </p>
                    </div>
                    <button @click="toggleFullscreen()" class="btn btn-primary btn-sm gap-2" id="fullscreen-btn">
                        <template x-if="!isFullscreen">
                            <span class="flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 4h-4m4 0l-5-5"/>
                                </svg>
                                Layar Penuh
                            </span>
                        </template>
                        <template x-if="isFullscreen">
                            <span class="flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4l5 5m11-9l-5 5M4 20l5-5m11 5l-5-5M9 4v4H5m10-4v4h4M9 20v-4H5m10 4v-4h4"/>
                                </svg>
                                Keluar Layar Penuh
                            </span>
                        </template>
                    </button>
                </div>

                {{-- Viewer Container --}}
                <div id="tour-viewer-container" class="relative w-full h-[320px] md:h-[500px] rounded-box overflow-hidden shadow-lg bg-black border border-base-300">
                    {{-- Embed Code Renderer --}}
                    <div class="w-full h-full [&_iframe]:w-full [&_iframe]:h-full flex items-center justify-center" id="tour-embed-wrapper">
                        {!! $tour->sanitized_code !!}
                    </div>

                    {{-- Floating fullscreen button on bottom-right inside viewer when fullscreen --}}
                    <button @click="toggleFullscreen()"
                            class="absolute bottom-4 right-4 btn btn-circle btn-sm bg-black/60 hover:bg-black/80 border-none text-white hidden lg:flex"
                            title="Toggle Fullscreen">
                        <svg x-show="!isFullscreen" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 4h-4m4 0l-5-5"/>
                        </svg>
                        <svg x-show="isFullscreen" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4l5 5m11-9l-5 5M4 20l5-5m11 5l-5-5M9 4v4H5m10-4v4h4M9 20v-4H5m10 4v-4h4"/>
                        </svg>
                    </button>
                </div>
            </div>
        @else
            {{-- Fallback Empty/Inactive State --}}
            <div class="card bg-base-100 shadow-md border border-base-200/50 p-8 md:p-12 text-center max-w-2xl mx-auto" id="fallback-tour">
                <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-base-200 flex items-center justify-center text-base-content/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-serif font-bold text-base-content/80 mb-3">Virtual Tour Belum Tersedia</h3>
                <p class="text-base-content/60 leading-relaxed mb-8">
                    Pihak pengelola museum sedang mempersiapkan panorama interaktif 360° Desa Sitiwinangun. Kunjungi kembali beberapa saat lagi untuk mendapatkan pengalaman virtual yang mendalam.
                </p>
                <div class="divider text-xs uppercase tracking-wider text-base-content/30">Alternatif Penjelajahan</div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
                    <a href="{{ route('public.collections.index') }}" class="btn btn-outline btn-primary gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z"/>
                        </svg>
                        Galeri Produk Kriya
                    </a>
                    <a href="{{ route('public.artisans.index') }}" class="btn btn-outline btn-accent gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857"/>
                        </svg>
                        Kisah Para Pengrajin
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

@endsection
