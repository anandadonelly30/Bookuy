<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center px-6 py-12 bg-white">
        
        <!-- Logo -->
        <div class="mb-8 text-center">
            <img src="{{ asset('logo/Logo Blue.png') }}" alt="Bookuy" class="h-20 w-20 mx-auto rounded-2xl shadow-lg mb-4">
            <h1 class="text-3xl font-bold font-header text-primary">Bookuy</h1>
            <p class="text-sm text-gray-500 mt-2">Welcome back! Please login to your account</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="w-full max-w-sm mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm">
                {{ session('status') }}
            </div>
        @endif

        <!-- Login Form -->
        <div class="w-full max-w-sm">
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus 
                        autocomplete="username"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-colors text-gray-900 placeholder-gray-400"
                        placeholder="your.email@example.com">
                    @error('email')
                        <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="current-password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-colors text-gray-900 placeholder-gray-400"
                        placeholder="Enter your password">
                    @error('password')
                        <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="flex items-center">
                        <input 
                            id="remember_me" 
                            type="checkbox" 
                            name="remember"
                            class="w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary">
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-primary hover:text-blue-600 font-medium">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <button 
                    type="submit" 
                    class="w-full py-3 bg-primary text-white font-semibold rounded-xl hover:bg-blue-600 transition-colors shadow-lg hover:shadow-xl">
                    Log in
                </button>

                <!-- Register Link -->
                <div class="text-center pt-4">
                    <p class="text-sm text-gray-600">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-primary hover:text-blue-600 font-semibold">
                            Sign up
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="mt-12 text-center text-xs text-gray-400">
            <p>&copy; 2025 Bookuy. All rights reserved.</p>
        </div>
    </div>
</x-guest-layout>
