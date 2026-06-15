<!DOCTYPE html>
<html lang="id"
      x-data
      x-bind:data-theme="$store.theme.current"
      x-init="$store.theme.init()">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin — {{ config('app.name', 'Desa Sitiwinangun') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- ========================================================
     BODY — daisyUI drawer layout (sidebar + content)
     ======================================================== --}}
<body class="bg-base-100 text-base-content font-sans antialiased">

{{-- ── DRAWER WRAPPER ─────────────────────────────────── --}}
<div class="drawer lg:drawer-open">

    {{-- Drawer toggle (mobile) --}}
    <input id="admin-drawer" type="checkbox" class="drawer-toggle"/>

    {{-- ================================================
         DRAWER CONTENT (Main area)
         ================================================ --}}
    <div class="drawer-content flex flex-col min-h-screen">

        {{-- ── NAVBAR ────────────────────────────── --}}
        <div class="navbar bg-base-100 border-b border-base-300 sticky top-0 z-30 shadow-sm">

            {{-- Mobile: hamburger to open drawer --}}
            <div class="flex-none lg:hidden">
                <label for="admin-drawer" aria-label="buka sidebar"
                       class="btn btn-square btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         class="inline-block h-5 w-5 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </label>
            </div>

            {{-- Brand / page title --}}
            <div class="flex-1 px-2 lg:px-4">
                <span class="font-serif font-bold text-lg text-primary hidden lg:block">
                    Desa Sitiwinangun
                </span>
                <span class="font-semibold text-base-content/70 text-sm lg:hidden">
                    Dashboard Admin
                </span>
            </div>

            {{-- Right section: theme toggle + user dropdown --}}
            <div class="flex-none flex items-center gap-2">

                {{-- ★ Light / Dark Mode Toggle ★ --}}
                <label id="theme-toggle" class="swap swap-rotate btn btn-ghost btn-circle"
                       title="Toggle tema"
                       x-on:click="$store.theme.toggle()">
                    {{-- Sun icon (shown in dark mode → click to go light) --}}
                    <svg x-show="$store.theme.isDark()"
                         xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-accent" viewBox="0 0 24 24">
                        <path d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z"/>
                    </svg>
                    {{-- Moon icon (shown in light mode → click to go dark) --}}
                    <svg x-show="!$store.theme.isDark()"
                         xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-base-content/70" viewBox="0 0 24 24">
                        <path d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z"/>
                    </svg>
                </label>

                {{-- User dropdown --}}
                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button"
                         class="btn btn-ghost flex items-center gap-2 px-2 rounded-btn">
                        <div class="avatar placeholder">
                            <div class="bg-primary text-primary-content rounded-full w-8">
                                <span class="text-xs font-bold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                </span>
                            </div>
                        </div>
                        <span class="text-sm font-medium hidden sm:block max-w-24 truncate">
                            {{ Auth::user()->name }}
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-base-content/50"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                    <ul tabindex="-1"
                        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-50 mt-3 w-52 p-2 shadow-xl border border-base-300">
                        <li class="menu-title">
                            <span>{{ Auth::user()->email }}</span>
                        </li>
                        <li>
                            <a class="text-base-content/70">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Profil Saya
                            </a>
                        </li>
                        <li>
                            <a class="text-base-content/70">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Pengaturan
                            </a>
                        </li>
                        <div class="divider my-0.5"></div>
                        <li>
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" id="btn-logout"
                                        class="w-full text-left text-error">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Keluar (Logout)
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>

            </div>{{-- /right section --}}
        </div>{{-- /navbar --}}

        {{-- ── MAIN CONTENT ────────────────────────── --}}
        <main class="flex-1 p-5 lg:p-8 bg-base-200 bg-batik-parang">

            {{-- Welcome banner --}}
            <div class="card bg-gradient-to-r from-primary to-primary/80 text-primary-content shadow-lg mb-6">
                <div class="card-body py-6 px-7">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div>
                            <h2 class="card-title font-serif text-2xl font-bold mb-1">
                                Selamat datang, {{ Auth::user()->name }}!
                            </h2>
                            <p class="text-primary-content/80 text-sm leading-relaxed max-w-lg">
                                Panel administrasi Website Desa Sitiwinangun.
                                Kelola koleksi gerabah, profil pengrajin, dan Virtual Tour 360° dari sini.
                            </p>
                        </div>
                        {{-- Badge role --}}
                        <div class="shrink-0">
                            <div class="badge badge-accent badge-lg font-semibold capitalize gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                {{ Auth::user()->role }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Statistics ── --}}
            <div class="stats stats-vertical sm:stats-horizontal shadow-md bg-base-100 border border-base-300 w-full mb-6">

                {{-- Stat 1: Koleksi --}}
                <div class="stat">
                    <div class="stat-figure text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <div class="stat-title text-xs font-semibold uppercase tracking-wider">Total Koleksi</div>
                    <div class="stat-value text-primary">32</div>
                    <div class="stat-desc">Karya gerabah & kriya</div>
                </div>

                {{-- Stat 2: Pengrajin --}}
                <div class="stat">
                    <div class="stat-figure text-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div class="stat-title text-xs font-semibold uppercase tracking-wider">Pengrajin Aktif</div>
                    <div class="stat-value text-secondary">12</div>
                    <div class="stat-desc">Warga desa terdata</div>
                </div>

                {{-- Stat 3: Virtual Tour --}}
                <div class="stat">
                    <div class="stat-figure text-accent">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M15 10l4.553-2.069A1 1 0 0121 8.87v6.26a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/>
                        </svg>
                    </div>
                    <div class="stat-title text-xs font-semibold uppercase tracking-wider">Kunjungan Virtual</div>
                    <div class="stat-value text-accent">1.4K</div>
                    <div class="stat-desc">
                        <span class="text-success font-semibold">↗ +12%</span> bulan ini
                    </div>
                </div>

            </div>{{-- /stats --}}

            {{-- ── Quick Access Cards ── --}}
            <h3 class="text-xs font-bold uppercase tracking-widest text-base-content/50 mb-3">
                Manajemen Konten
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">

                {{-- Card: Koleksi Kriya --}}
                <div class="card bg-base-100 border border-base-300 hover:border-primary/40 hover:shadow-md
                            transition-all duration-200 cursor-pointer group">
                    <div class="card-body py-5 px-5">
                        <div class="flex items-start justify-between">
                            <div class="p-2.5 rounded-btn bg-primary/10 text-primary
                                        group-hover:bg-primary group-hover:text-primary-content transition-all duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="badge badge-ghost text-xs">32 item</div>
                        </div>
                        <h4 class="card-title text-sm mt-3 font-semibold">Koleksi Kriya</h4>
                        <p class="text-xs text-base-content/60">Kelola foto & info gerabah</p>
                    </div>
                </div>

                {{-- Card: Virtual Tour --}}
                <div class="card bg-base-100 border border-base-300 hover:border-secondary/40 hover:shadow-md
                            transition-all duration-200 cursor-pointer group">
                    <div class="card-body py-5 px-5">
                        <div class="flex items-start justify-between">
                            <div class="p-2.5 rounded-btn bg-secondary/10 text-secondary
                                        group-hover:bg-secondary group-hover:text-secondary-content transition-all duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                </svg>
                            </div>
                            <div class="badge badge-ghost text-xs">3 lokasi</div>
                        </div>
                        <h4 class="card-title text-sm mt-3 font-semibold">Virtual Tour 360°</h4>
                        <p class="text-xs text-base-content/60">Embed & atur tur virtual</p>
                    </div>
                </div>

                {{-- Card: Kisah Pengrajin --}}
                <div class="card bg-base-100 border border-base-300 hover:border-accent/40 hover:shadow-md
                            transition-all duration-200 cursor-pointer group">
                    <div class="card-body py-5 px-5">
                        <div class="flex items-start justify-between">
                            <div class="p-2.5 rounded-btn bg-accent/10 text-accent
                                        group-hover:bg-accent group-hover:text-accent-content transition-all duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <div class="badge badge-ghost text-xs">12 profil</div>
                        </div>
                        <h4 class="card-title text-sm mt-3 font-semibold">Kisah Pengrajin</h4>
                        <p class="text-xs text-base-content/60">Profil & cerita pengrajin</p>
                    </div>
                </div>

                {{-- Card: Konten Statis --}}
                <div class="card bg-base-100 border border-base-300 hover:border-neutral/40 hover:shadow-md
                            transition-all duration-200 cursor-pointer group">
                    <div class="card-body py-5 px-5">
                        <div class="flex items-start justify-between">
                            <div class="p-2.5 rounded-btn bg-neutral/10 text-neutral
                                        group-hover:bg-neutral group-hover:text-neutral-content transition-all duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="badge badge-ghost text-xs">5 halaman</div>
                        </div>
                        <h4 class="card-title text-sm mt-3 font-semibold">Konten Statis</h4>
                        <p class="text-xs text-base-content/60">Tentang, sejarah, kontak</p>
                    </div>
                </div>

            </div>{{-- /grid quick access --}}

            {{-- ── Activity / Info row ── --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

                {{-- Last login info --}}
                <div class="card bg-base-100 border border-base-300 lg:col-span-2">
                    <div class="card-body py-5 px-6">
                        <h3 class="card-title text-sm font-semibold text-base-content/80 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Info Sesi
                        </h3>
                        <ul class="space-y-2.5 text-sm">
                            <li class="flex items-center justify-between py-1.5 border-b border-base-200">
                                <span class="text-base-content/60">Pengguna</span>
                                <span class="font-semibold">{{ Auth::user()->name }}</span>
                            </li>
                            <li class="flex items-center justify-between py-1.5 border-b border-base-200">
                                <span class="text-base-content/60">Role</span>
                                <span class="badge badge-primary badge-sm capitalize">{{ Auth::user()->role }}</span>
                            </li>
                            <li class="flex items-center justify-between py-1.5 border-b border-base-200">
                                <span class="text-base-content/60">Email</span>
                                <span class="font-medium text-xs">{{ Auth::user()->email }}</span>
                            </li>
                            <li class="flex items-center justify-between py-1.5">
                                <span class="text-base-content/60">Login Terakhir</span>
                                <span class="font-medium text-xs">
                                    {{ Auth::user()->last_login_at
                                        ? Auth::user()->last_login_at->format('d M Y, H:i')
                                        : 'Pertama kali login' }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Quick tips / notes --}}
                <div class="card bg-accent/10 border border-accent/20">
                    <div class="card-body py-5 px-6">
                        <h3 class="card-title text-sm font-semibold text-accent mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Catatan
                        </h3>
                        <ul class="space-y-2 text-xs text-base-content/70 leading-relaxed">
                            <li class="flex gap-2">
                                <span class="text-accent mt-0.5">✦</span>
                                Selalu simpan perubahan sebelum berpindah halaman.
                            </li>
                            <li class="flex gap-2">
                                <span class="text-accent mt-0.5">✦</span>
                                Gambar koleksi disarankan rasio 4:3, min. 800px.
                            </li>
                            <li class="flex gap-2">
                                <span class="text-accent mt-0.5">✦</span>
                                Backup data dilakukan otomatis setiap minggu.
                            </li>
                        </ul>
                    </div>
                </div>

            </div>{{-- /activity row --}}

        </main>{{-- /main content --}}

        {{-- Footer --}}
        <footer class="footer footer-center text-base-content/40 border-t border-base-300 bg-base-100 p-4">
            <aside>
                <p class="text-xs">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Desa Sitiwinangun') }}
                    &mdash; Sistem Informasi Digital Kriya
                </p>
            </aside>
        </footer>

    </div>{{-- /drawer-content --}}

    {{-- ================================================
         DRAWER SIDE (Sidebar navigation)
         ================================================ --}}
    <div class="drawer-side z-40">
        <label for="admin-drawer" aria-label="tutup sidebar" class="drawer-overlay"></label>

        <aside class="bg-base-100 border-r border-base-300 min-h-full w-64 flex flex-col">

            {{-- Sidebar brand header --}}
            <div class="flex items-center gap-3 px-5 py-4 border-b border-base-300 bg-primary/5">
                {{-- Mini logo --}}
                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-primary to-accent/60
                            flex items-center justify-center shrink-0 shadow-sm">
                    <svg class="w-5 h-5 text-primary-content" viewBox="0 0 48 48" fill="none">
                        <path d="M14 28 C10 20 10 12 24 8 C38 12 38 20 34 28 C32 32 28 35 24 35 C20 35 16 32 14 28Z"
                              fill="currentColor" opacity="0.9"/>
                    </svg>
                </div>
                <div class="flex flex-col min-w-0">
                    <span class="font-serif font-bold text-sm text-primary truncate leading-tight">
                        Admin Panel
                    </span>
                    <span class="text-xs text-base-content/50 truncate">
                        Desa Sitiwinangun
                    </span>
                </div>
            </div>

            {{-- Navigation menu --}}
            <nav class="flex-1 py-4 px-3 overflow-y-auto">

                <ul class="menu menu-sm gap-0.5 w-full p-0">

                    <li class="menu-title text-xs uppercase tracking-widest mb-1">Utama</li>

                    {{-- Dashboard (active) --}}
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                           class="active font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Dashboard
                        </a>
                    </li>

                    <div class="divider my-1 text-xs text-base-content/40">Konten</div>

                    <li>
                        <a href="#" class="text-base-content/75 hover:text-base-content">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Koleksi Kriya
                            <span class="badge badge-sm badge-ghost ml-auto">32</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="text-base-content/75 hover:text-base-content">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                            </svg>
                            Virtual Tour 360°
                        </a>
                    </li>

                    <li>
                        <a href="#" class="text-base-content/75 hover:text-base-content">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            Kisah Pengrajin
                        </a>
                    </li>

                    <li>
                        <a href="#" class="text-base-content/75 hover:text-base-content">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Konten Statis
                        </a>
                    </li>

                    <div class="divider my-1 text-xs text-base-content/40">Sistem</div>

                    <li>
                        <a href="#" class="text-base-content/75 hover:text-base-content">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Pengaturan
                        </a>
                    </li>

                </ul>
            </nav>

            {{-- Sidebar footer: user info + logout --}}
            <div class="border-t border-base-300 p-3 bg-base-200/50">
                <div class="flex items-center gap-3 px-2 py-1.5 mb-2">
                    <div class="avatar placeholder">
                        <div class="bg-primary text-primary-content rounded-full w-8">
                            <span class="text-xs font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </span>
                        </div>
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="text-sm font-semibold truncate">{{ Auth::user()->name }}</span>
                        <span class="text-xs text-base-content/50 capitalize">{{ Auth::user()->role }}</span>
                    </div>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="btn btn-ghost btn-sm btn-block text-error hover:bg-error/10 justify-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Keluar (Logout)
                    </button>
                </form>
            </div>

        </aside>
    </div>{{-- /drawer-side --}}

</div>{{-- /drawer --}}

</body>
</html>
