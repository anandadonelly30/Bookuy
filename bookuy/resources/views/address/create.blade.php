<x-guest-layout>
    <!-- Header Biru dengan Back Button -->
    <div class="bg-primary px-4 py-4">
        <div class="flex items-center">
            <a href="{{ route('address.index') }}" class="mr-3">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h1 class="text-xl font-semibold font-header text-white">New Address</h1>
        </div>
    </div>

    <!-- Main Content -->
    <div class="pb-24">
        
        <!-- Map Section with Building Illustration -->
        <div class="relative h-56 bg-gradient-to-br from-blue-300 via-blue-200 to-blue-100 overflow-hidden">
            <!-- Building Illustration (simplified) -->
            <div class="absolute bottom-0 left-0 right-0 flex items-end justify-center space-x-2 px-8">
                <!-- Building 1 -->
                <div class="w-16 h-32 bg-white/40 backdrop-blur-sm rounded-t-lg border border-white/50 flex flex-col">
                    <div class="flex-1 grid grid-cols-2 gap-1 p-1.5">
                        <div class="bg-blue-400/30 rounded"></div>
                        <div class="bg-blue-400/30 rounded"></div>
                        <div class="bg-blue-400/30 rounded"></div>
                        <div class="bg-blue-400/30 rounded"></div>
                        <div class="bg-blue-400/30 rounded"></div>
                        <div class="bg-blue-400/30 rounded"></div>
                    </div>
                </div>
                
                <!-- Building 2 (Center - Tallest) -->
                <div class="w-20 h-40 bg-white/40 backdrop-blur-sm rounded-t-lg border border-white/50 flex flex-col">
                    <div class="flex-1 grid grid-cols-2 gap-1 p-2">
                        <div class="bg-blue-400/30 rounded"></div>
                        <div class="bg-blue-400/30 rounded"></div>
                        <div class="bg-blue-400/30 rounded"></div>
                        <div class="bg-blue-400/30 rounded"></div>
                        <div class="bg-blue-400/30 rounded"></div>
                        <div class="bg-blue-400/30 rounded"></div>
                        <div class="bg-blue-400/30 rounded"></div>
                        <div class="bg-blue-400/30 rounded"></div>
                    </div>
                </div>
                
                <!-- Building 3 -->
                <div class="w-16 h-28 bg-white/40 backdrop-blur-sm rounded-t-lg border border-white/50 flex flex-col">
                    <div class="flex-1 grid grid-cols-2 gap-1 p-1.5">
                        <div class="bg-blue-400/30 rounded"></div>
                        <div class="bg-blue-400/30 rounded"></div>
                        <div class="bg-blue-400/30 rounded"></div>
                        <div class="bg-blue-400/30 rounded"></div>
                        <div class="bg-blue-400/30 rounded"></div>
                        <div class="bg-blue-400/30 rounded"></div>
                    </div>
                </div>
            </div>
            
            <!-- Location Pin (Yellow) -->
            <div class="absolute top-16 left-1/2 transform -translate-x-1/2">
                <svg class="w-10 h-10 text-yellow-400 drop-shadow-lg" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                </svg>
            </div>
            
            <!-- Text overlay -->
            <div class="absolute bottom-4 left-0 right-0 text-center">
                <p class="text-white text-sm font-medium drop-shadow">Jalan November Institute</p>
            </div>
        </div>

        <!-- Form Section with Close Button -->
        <div class="bg-white rounded-t-3xl -mt-6 relative">
            <!-- Close Button -->
            <button onclick="window.location.href='{{ route('address.index') }}'" class="absolute top-4 right-4 w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-gray-200">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            
            <form action="{{ route('address.store') }}" method="POST" class="px-4 pt-6 pb-6 space-y-4">
                @csrf
                
                <h2 class="text-base font-semibold text-gray-900 mb-4">Address</h2>
                
                <!-- Address Nickname -->
                <div>
                    <label for="nickname" class="block text-xs font-medium text-gray-700 mb-1.5">Address Nickname</label>
                    <select 
                        id="nickname" 
                        name="nickname" 
                        class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-gray-900 appearance-none bg-white" 
                        style="background-image: url(&quot;data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e&quot;); background-position: right 0.5rem center; background-repeat: no-repeat; background-size: 1.5em 1.5em;"
                        required>
                        <option value="" disabled selected>Choose one</option>
                        <option value="Home">Home</option>
                        <option value="Office">Office</option>
                        <option value="Apartment">Apartment</option>
                        <option value="Parent's House">Parent's House</option>
                        <option value="Department">Department</option>
                    </select>
                    @error('nickname')
                        <p class="mt-1 text-xs text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Department (Optional) -->
                <div>
                    <label for="department" class="block text-xs font-medium text-gray-700 mb-1.5">Department</label>
                    <select 
                        id="department" 
                        name="department" 
                        class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-gray-900 appearance-none bg-white" 
                        style="background-image: url(&quot;data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e&quot;); background-position: right 0.5rem center; background-repeat: no-repeat; background-size: 1.5em 1.5em;">
                        <option value="">Choose one</option>
                        <option value="Computer Science">Computer Science</option>
                        <option value="Engineering">Engineering</option>
                        <option value="Business">Business</option>
                        <option value="Arts">Arts</option>
                        <option value="Science">Science</option>
                    </select>
                    @error('department')
                        <p class="mt-1 text-xs text-danger">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Full Address -->
                <div>
                    <label for="full_address" class="block text-xs font-medium text-gray-700 mb-1.5">Full Address</label>
                    <textarea 
                        id="full_address" 
                        name="full_address" 
                        rows="3" 
                        placeholder="Isi komplet 21 lingkungan 43 RW 01, Kota..." 
                        class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-gray-900 placeholder-gray-400 resize-none" 
                        required>{{ old('full_address') }}</textarea>
                    @error('full_address')
                        <p class="mt-1 text-xs text-danger">{{ $message }}</p>
                    @enderror
                    <div class="flex items-center mt-2">
                        <input 
                            type="checkbox" 
                            id="save_location" 
                            class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary">
                        <label for="save_location" class="ml-2 text-xs text-gray-600">Make this address saved by default</label>
                    </div>
                </div>

                <!-- Latitude & Longitude (Hidden) -->
                <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude', '-6.200000') }}">
                <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude', '106.816666') }}">
                <input type="hidden" id="phone_number" name="phone_number" value="+62 812-3456-7890">
                
                <!-- Submit Button -->
                <div class="pt-2">
                    <button 
                        type="submit" 
                        class="w-full py-3 bg-primary text-white text-sm font-semibold rounded-lg hover:bg-blue-600 transition-colors">
                        Save
                    </button>
                </div>

            </form>
        </div>

    </div>

    <!-- Success Modal (shown after save) -->
    @if(session('success'))
    <div id="successModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 px-4">
        <div class="bg-white rounded-2xl p-6 max-w-sm w-full text-center">
            <!-- Checkmark Icon -->
            <div class="w-16 h-16 bg-green-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            
            <h3 class="text-xl font-bold text-gray-900 mb-2">Congratulations!</h3>
            <p class="text-sm text-gray-600 mb-6">Your address success to saved</p>
            
            <button 
                onclick="document.getElementById('successModal').style.display='none'; window.location.href='{{ route('address.index') }}';" 
                class="w-full py-3 bg-primary text-white text-sm font-semibold rounded-lg hover:bg-blue-600 transition-colors">
                Home
            </button>
        </div>
    </div>
    @endif

</x-guest-layout>
