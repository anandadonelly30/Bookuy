
<!-- === NAMA_FILE: resources/views/layouts/navigation.blade.php === -->
<!--
Ini adalah file navigasi ATAS.
Kita akan sembunyikan di halaman-halaman utama dan ganti dengan header biru.
File ini tetap dipakai oleh Breeze untuk halaman profile, dll.
Jadi kita modifikasi sedikit saja.
-->
<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-sm mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-blue-600 font-bold text-lg">
                        {{-- Ganti dengan logo --}}
                        BooKu
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Sembunyikan di mobile, kita pakai bottom nav -->
            </div>
            
            <!-- Tombol Logout (Tetap ada untuk profile page) -->
            <div class="flex items-center">
                 <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                        class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                        <!-- Icon Logout -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                    </a>
                </form>
            </div>

            <!-- Hamburger (hidden, we use bottom nav) -->
            <div class="-me-2 flex items-center sm:hidden">
                <!-- ... -->
            </div>
        </div>
    </div>
</nav>
