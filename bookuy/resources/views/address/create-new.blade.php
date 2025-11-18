<x-guest-layout>
    <!-- Header dengan Back Button -->
    <div class="sticky top-0 z-10 bg-white border-b border-gray-200 px-4 py-4">
        <div class="flex items-center">
            <a href="{{ route('address.index') }}" class="mr-3">
                <svg class="w-6 h-6 text-text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h1 class="text-xl font-bold text-text-primary">New Address</h1>
        </div>
    </div>

    <!-- Main Content -->
    <div class="pb-24">
        
        <!-- Map Section -->
        <div class="relative h-64 bg-gradient-to-br from-blue-100 to-blue-200">
            <!-- Map Placeholder with Interactive Elements -->
            <div class="absolute inset-0 flex items-center justify-center">
                <svg class="w-20 h-20 text-primary/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                </svg>
            </div>
            
            <!-- Location Pin -->
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-full">
                <svg class="w-12 h-12 text-danger drop-shadow-lg animate-bounce" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                </svg>
            </div>
            
            <!-- Current Location Button -->
            <button class="absolute bottom-4 right-4 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-gray-50">
                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </button>
        </div>

        <!-- Form Section -->
        <form action="{{ route('address.store') }}" method="POST" class="px-4 py-6 space-y-4">
            @csrf
            
            <!-- Address Nickname -->
            <div>
                <label for="nickname" class="block text-sm font-semibold text-text-primary mb-2">Address Nickname</label>
                <select 
                    id="nickname" 
                    name="nickname" 
                    class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent text-text-primary" 
                    required>
                    <option value="" disabled selected>Choose nickname</option>
                    <option value="Home">🏠 Home</option>
                    <option value="Office">🏢 Office</option>
                    <option value="Apartment">🏙️ Apartment</option>
                    <option value="Parent's House">👨‍👩‍👦 Parent's House</option>
                    <option value="Department">📚 Department</option>
                    <option value="Other">📍 Other</option>
                </select>
                @error('nickname')
                    <p class="mt-1 text-xs text-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Department (Optional) -->
            <div>
                <label for="department" class="block text-sm font-semibold text-text-primary mb-2">Department <span class="text-text-secondary font-normal">(Optional)</span></label>
                <input 
                    type="text" 
                    id="department" 
                    name="department" 
                    placeholder="e.g., Computer Science, Engineering" 
                    value="{{ old('department') }}"
                    class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent text-text-primary placeholder-text-secondary">
                @error('department')
                    <p class="mt-1 text-xs text-danger">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Full Address -->
            <div>
                <label for="full_address" class="block text-sm font-semibold text-text-primary mb-2">Full Address</label>
                <textarea 
                    id="full_address" 
                    name="full_address" 
                    rows="4" 
                    placeholder="Enter your complete address including street, building, floor, etc." 
                    class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent text-text-primary placeholder-text-secondary resize-none" 
                    required>{{ old('full_address') }}</textarea>
                @error('full_address')
                    <p class="mt-1 text-xs text-danger">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Phone Number -->
            <div>
                <label for="phone_number" class="block text-sm font-semibold text-text-primary mb-2">Phone Number</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <input 
                        type="tel" 
                        id="phone_number" 
                        name="phone_number" 
                        placeholder="+62 812-3456-7890" 
                        value="{{ old('phone_number') }}"
                        class="w-full pl-12 pr-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent text-text-primary placeholder-text-secondary" 
                        required>
                </div>
                @error('phone_number')
                    <p class="mt-1 text-xs text-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Latitude & Longitude (Hidden, can be populated via map interaction) -->
            <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude', '-6.200000') }}">
            <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude', '106.816666') }}">
            
            <!-- Set as Default Checkbox -->
            <div class="bg-gray-50 rounded-xl p-4">
                <label for="is_default" class="flex items-center cursor-pointer">
                    <input 
                        type="checkbox" 
                        id="is_default" 
                        name="is_default" 
                        class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary" 
                        {{ old('is_default') ? 'checked' : '' }}>
                    <span class="ml-3 text-sm font-medium text-text-primary">Set as default delivery address</span>
                </label>
                <p class="ml-8 mt-1 text-xs text-text-secondary">This address will be used automatically for your orders</p>
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button 
                    type="submit" 
                    class="w-full py-4 bg-primary text-white text-base font-semibold rounded-xl hover:bg-blue-600 transition-colors shadow-lg flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>Save Address</span>
                </button>
            </div>

        </form>

    </div>

    <!-- Bottom Navigation -->
    <x-bottom-navigation />

</x-guest-layout>
