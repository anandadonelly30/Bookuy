<x-guest-layout>
    <!-- Header Biru dengan Back Button dan Logo -->
    <div class="bg-primary px-4 py-4">
        <div class="flex items-center justify-between mb-6">
            <!-- Back Button -->
            <a href="{{ route('profile.index') }}" class="p-1">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            
            <!-- Logo Bookuy -->
            <img src="{{ asset('logo/Logo White.png') }}" alt="Bookuy" class="h-8 rounded-lg object-contain">
        </div>
        
        <!-- Title -->
        <h1 class="text-2xl font-bold font-header text-white text-center mb-6">Edit Profile</h1>
        
        <!-- Profile Picture -->
        <div class="text-center pb-6">
            <div class="relative inline-block">
                <div class="w-24 h-24 rounded-full overflow-hidden shadow-xl mx-auto">
                    @if(Auth::user()->profile_picture)
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile" class="w-full h-full object-cover">
                    @else
                        <img src="{{ asset('logo/Logo Blue.png') }}" alt="Profile" class="w-full h-full object-contain bg-white p-2">
                    @endif
                </div>
                <label for="profile_picture" class="absolute -bottom-1 right-0 w-8 h-8 bg-white rounded-full flex items-center justify-center cursor-pointer shadow-lg hover:bg-gray-50">
                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </label>
                <input type="file" id="profile_picture" name="profile_picture" class="hidden" accept="image/*">
            </div>
            <p class="text-white text-xs mt-2">Change Picture</p>
        </div>
    </div>

    <!-- Form Section -->
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="bg-white rounded-t-[32px] -mt-6 px-5 py-6 space-y-4 pb-24">
        @csrf
        @method('PATCH')

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Name</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                value="{{ old('name', Auth::user()->name) }}"
                placeholder="Farrel Aditya" 
                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-gray-900" 
                required>
            @error('name')
                <p class="mt-1 text-xs text-danger">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email (Read-only) -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
            <input 
                type="email" 
                id="email" 
                value="{{ Auth::user()->email }}"
                class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-lg bg-gray-50 text-gray-500 cursor-not-allowed" 
                disabled>
        </div>

        <!-- Gender -->
        <div>
            <label for="gender" class="block text-sm font-medium text-gray-700 mb-1.5">Gender</label>
            <select 
                id="gender" 
                name="gender" 
                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-gray-900 appearance-none bg-white" 
                style="background-image: url(&quot;data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e&quot;); background-position: right 0.5rem center; background-repeat: no-repeat; background-size: 1.5em 1.5em;">
                <option value="">Select gender</option>
                <option value="Male" {{ old('gender', Auth::user()->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender', Auth::user()->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                <option value="Other" {{ old('gender', Auth::user()->gender) == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('gender')
                <p class="mt-1 text-xs text-danger">{{ $message }}</p>
            @enderror
        </div>

        <!-- Semester -->
        <div>
            <label for="semester" class="block text-sm font-medium text-gray-700 mb-1.5">Semester</label>
            <select 
                id="semester" 
                name="semester" 
                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-gray-900 appearance-none bg-white" 
                style="background-image: url(&quot;data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e&quot;); background-position: right 0.5rem center; background-repeat: no-repeat; background-size: 1.5em 1.5em;">
                <option value="">Select semester</option>
                @for($i = 1; $i <= 8; $i++)
                    <option value="{{ $i }}" {{ old('semester', Auth::user()->semester) == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
            @error('semester')
                <p class="mt-1 text-xs text-danger">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description/Bio -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1.5">Description</label>
            <textarea 
                id="description" 
                name="description" 
                rows="4" 
                placeholder="Halo aku Farrel, HMJ Kalo mau beli atau nyewa buku matkul sifar yaa, orangnya ga gigit kok tenang aja :)" 
                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-gray-900 placeholder-gray-400 resize-none">{{ old('description', Auth::user()->description) }}</textarea>
            @error('description')
                <p class="mt-1 text-xs text-danger">{{ $message }}</p>
            @enderror
        </div>

        <!-- Phone Number -->
        <div>
            <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1.5">Phone Number</label>
            <input 
                type="tel" 
                id="phone_number" 
                name="phone_number" 
                placeholder="+62 812-3456-7890" 
                value="{{ old('phone_number', Auth::user()->phone_number) }}"
                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-gray-900 placeholder-gray-400">
            @error('phone_number')
                <p class="mt-1 text-xs text-danger">{{ $message }}</p>
            @enderror
        </div>

        <!-- Save Button -->
        <div class="pt-2">
            <button 
                type="submit" 
                class="w-full py-3 bg-orange text-white text-base font-semibold rounded-lg hover:bg-orange/90 transition-colors">
                Save
            </button>
        </div>

        @if (session('status') === 'profile-updated')
            <div class="p-4 bg-success/10 border border-success/20 rounded-xl">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm font-medium text-success">Profile updated successfully!</span>
                </div>
            </div>
        @endif

    </form>

    <!-- Bottom Navigation -->
    <x-bottom-navigation />

</x-guest-layout>
