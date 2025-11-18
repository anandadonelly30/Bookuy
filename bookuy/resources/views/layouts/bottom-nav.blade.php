
<!-- === NAMA_FILE: resources/views/layouts/bottom-nav.blade.php === -->
<!--
Ini adalah navigasi bawah FAKE kita, mirip aplikasi mobile.
-->
<footer class="fixed bottom-0 left-0 right-0 max-w-sm mx-auto bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 shadow-lg z-20">
    <div class="flex justify-around items-center h-16 px-4">
        
        <!-- Home -->
        <a href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center text-gray-600 dark:text-gray-400 {{ request()->routeIs('dashboard') ? 'text-blue-600 dark:text-blue-500' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span class="text-xs mt-1">Home</span>
        </a>
        
        <!-- Cart -->
        <a href="{{ route('cart.index') }}" class="flex flex-col items-center justify-center text-gray-600 dark:text-gray-400 {{ request()->routeIs('cart.index') ? 'text-blue-600 dark:text-blue-500' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
            </svg>
            <span class="text-xs mt-1">Cart</span>
        </a>

        <!-- Notifications -->
        <a href="{{ route('notifications.index') }}" class="flex flex-col items-center justify-center text-gray-600 dark:text-gray-400 {{ request()->routeIs('notifications.index') ? 'text-blue-600 dark:text-blue-500' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
            <span class="text-xs mt-1">Notif</span>
        </a>
        
        <!-- Profile -->
        <a href="{{ route('profile.edit') }}" class="flex flex-col items-center justify-center text-gray-600 dark:text-gray-400 {{ request()->routeIs('profile.edit') ? 'text-blue-600 dark:text-blue-500' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="text-xs mt-1">Profile</span>
        </a>
    </div>
</footer>