<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>Profile Menu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* FONT SETUP */
        @font-face {
            font-family: 'SugaPro';
            src: url("{{ asset('fonts/suga-pro-display/Sugo-Pro-Display-Bold-trial.ttf') }}") format("truetype");
            font-weight: bold;
            font-style: normal;
        }
        .font-suga { font-family: 'SugaPro', sans-serif; }
        .font-poppins { font-family: 'Poppins', sans-serif; }

        /* WARNA & UTILITAS */
        .bg-blue-main { background-color: #246BFD !important; }
        .text-blue-main { color: #246BFD !important; }

        body { background-color: #F8F9FD; font-family: 'Poppins', sans-serif; }

        .mobile-container {
            max-width: 390px;
            margin: 0 auto;
            background-color: #F8F9FD;
            min-height: 100vh;
            position: relative;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            overflow-x: hidden;
        }

        /* Header Curve */
        .header-curve {
            border-bottom-left-radius: 40px;
            border-bottom-right-radius: 40px;
        }

        /* Shadow Card Menu */
        .menu-card-shadow {
            box-shadow: 0 10px 40px -5px rgba(0,0,0,0.05);
        }

        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-100">

    <div class="mobile-container">

        <div class="relative bg-blue-main h-[175px] header-curve z-0">

            <div class="px-6 pt-[14px] flex justify-between items-center text-white">
                <div class="text-[15px] font-semibold tracking-wide font-poppins ml-2">9:41</div>
                <div class="flex items-center gap-1.5 mr-2">
                    <svg class="w-[18px] h-[12px]" viewBox="0 0 18 12" fill="currentColor"><path d="M1.5 8.5C1.5 8.22386 1.72386 8 2 8H3C3.27614 8 3.5 8.22386 3.5 8.5V11.5C3.5 11.7761 3.27614 12 3 12H2C1.72386 12 1.5 11.7761 1.5 11.5V8.5Z" /><path d="M6 5.5C6 5.22386 6.22386 5 6.5 5H7.5C7.77614 5 8 5.22386 8 5.5V11.5C8 11.7761 7.77614 12 7.5 12H6.5C6.22386 12 6 11.7761 6 11.5V5.5Z" /><path d="M10.5 2.5C10.5 2.22386 10.7239 2 11 2H12C12.2761 2 12.5 2.22386 12.5 2.5V11.5C12.5 11.7761 12.2761 12 12 12H11C10.7239 12 10.5 11.7761 10.5 11.5V2.5Z" /><path d="M15 0.5C15 0.223858 15.2239 0 15.5 0H16.5C16.7761 0 17 0.223858 17 0.5V11.5C17 11.7761 16.7761 12 16.5 12H15.5C15.2239 12 15 11.7761 15 11.5V0.5Z" /></svg>
                    <svg class="w-[18px] h-[12px]" viewBox="0 0 18 12" fill="currentColor"><path fill-rule="evenodd" clip-rule="evenodd" d="M9 2.5C5.65 2.5 2.65 3.7 0.35 5.65L9 12L17.65 5.65C15.35 3.7 12.35 2.5 9 2.5Z" /></svg>
                    <svg class="w-[24px] h-[12px]" viewBox="0 0 24 12" fill="none"><rect x="0.5" y="0.5" width="20" height="10" rx="2.5" stroke="white"/><rect x="2.5" y="2.5" width="16" height="6" rx="1" fill="white"/><path d="M23 4.5V7.5" stroke="white" stroke-linecap="round"/></svg>
                </div>
            </div>

            <div class="flex items-center px-6 mt-6">
                <div class="w-[64px] h-[64px] rounded-full border-2 border-white overflow-hidden bg-gray-300 shadow-sm">
                    <img src="https://via.placeholder.com/100x100" alt="Profile" class="w-full h-full object-cover">
                </div>

                <div class="ml-4 text-white">
                    <h1 class="font-suga text-[28px] leading-none tracking-wide">Farrel Aditya</h1>
                    <a href="#" class="text-[13px] font-normal opacity-90 flex items-center mt-1.5 hover:opacity-100 font-poppins">
                        Edit Profile
                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="px-5 relative -mt-8 z-10 pb-32 font-poppins">
            <div class="bg-white rounded-[24px] p-6 menu-card-shadow">

                <h3 class="text-[15px] font-bold text-[#1E1E1E] mb-4">Account Security</h3>

                <div class="flex items-center mb-6 cursor-pointer group">
                    <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-[#1E1E1E]">
                        <svg class="w-[22px] h-[22px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/><circle cx="12" cy="12" r="10" stroke-width="1.5"/></svg>
                    </div>
                    <div class="ml-3 flex-1">
                        <h4 class="text-[14px] font-semibold text-[#1E1E1E]">Privacy & Security</h4>
                        <p class="text-[11px] text-gray-400 font-normal">Password, E-mail, Security Stuff</p>
                    </div>
                    <div class="bg-blue-main text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full shadow-sm">1</div>
                </div>

                <div class="border-t border-gray-50 mb-6"></div>

                <h3 class="text-[15px] font-bold text-[#1E1E1E] mb-4">Purchase History</h3>

                <a href="{{ route('sales.history') }}" class="flex items-center mb-5 cursor-pointer hover:bg-gray-50 rounded-lg transition -mx-2 px-2">
                    <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-[#1E1E1E]">
                        <svg class="w-[22px] h-[22px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="ml-3 flex-1">
                        <h4 class="text-[14px] font-semibold text-[#1E1E1E]">Sales History</h4>
                        <p class="text-[11px] text-gray-400 font-normal">History Penjualanmu</p>
                    </div>
                    <div class="bg-blue-main text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full shadow-sm">1</div>
                </a>

                <a href="{{ route('purchase.history') }}" class="flex items-center mb-6 cursor-pointer hover:bg-gray-50 rounded-lg transition -mx-2 px-2">
                    <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-[#1E1E1E]">
                        <svg class="w-[22px] h-[22px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-dasharray="4 2"/></svg>
                    </div>
                    <div class="ml-3 flex-1">
                        <h4 class="text-[14px] font-semibold text-[#1E1E1E]">Purchase History</h4>
                        <p class="text-[11px] text-gray-400 font-normal">Leave a review!</p>
                    </div>
                    <div class="bg-blue-main text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full shadow-sm">1</div>
                </a>

                <div class="border-t border-gray-50 mb-6"></div>

                <h3 class="text-[15px] font-bold text-[#1E1E1E] mb-4">Information</h3>

                <div class="flex items-center mb-5 cursor-pointer group">
                    <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-[#1E1E1E]">
                        <svg class="w-[22px] h-[22px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div class="ml-3 flex-1">
                        <h4 class="text-[14px] font-semibold text-[#1E1E1E]">Address</h4>
                        <p class="text-[11px] text-gray-400 font-normal">Set up address to your location!</p>
                    </div>
                </div>

                <div class="flex items-center mb-2 cursor-pointer group">
                    <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-[#1E1E1E]">
                        <svg class="w-[22px] h-[22px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                    </div>
                    <div class="ml-3 flex-1">
                        <h4 class="text-[14px] font-semibold text-[#1E1E1E]">Payment</h4>
                        <p class="text-[11px] text-gray-400 font-normal">Set up your payment method!</p>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="mt-10 text-center">
                @csrf
                <button type="submit" class="text-[#FF3B30] font-bold text-[15px] flex items-center justify-center gap-2 hover:opacity-80 mx-auto transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Logout
                </button>
            </form>
        </div>

        <div class="fixed bottom-0 w-full max-w-[390px] z-50">
            <div class="relative">

                <div class="h-[86px] bg-blue-main rounded-t-[35px] flex items-center px-8 pb-3 shadow-[0_-5px_20px_rgba(36,107,253,0.2)]">

                    <div class="flex items-center justify-between w-[75%] pr-4">

                        <a href="#" class="flex flex-col items-center justify-center text-white hover:opacity-80 transition">
                            <svg class="w-[26px] h-[26px]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </a>

                        <a href="#" class="flex flex-col items-center justify-center text-white hover:opacity-80 transition">
                            <svg class="w-[26px] h-[26px]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                        </a>

                        <a href="#" class="flex flex-col items-center justify-center hover:opacity-80 transition">
                            <div class="w-[30px] h-[30px] rounded-full border-[2px] border-white flex items-center justify-center text-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                </svg>
                            </div>
                        </a>

                        <a href="#" class="flex flex-col items-center justify-center text-white hover:opacity-80 transition">
                            <svg class="w-[26px] h-[26px]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                        </a>

                    </div>
                </div>

                <div class="absolute right-5 -top-7">
                    <div class="w-[72px] h-[72px] rounded-full bg-[#F8F9FD] flex items-center justify-center">
                        <a href="#" class="w-[56px] h-[56px] bg-blue-main rounded-full flex items-center justify-center shadow-lg hover:scale-105 transition relative z-10">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </a>
                    </div>
                    <div class="absolute bottom-2 right-0 w-full h-10 bg-transparent rounded-b-full -z-10"></div>
                </div>

            </div>

            <div class="absolute bottom-2 left-1/2 transform -translate-x-1/2 w-[134px] h-[5px] bg-white rounded-full opacity-40"></div>
        </div>

    </div>

</body>
</html>
