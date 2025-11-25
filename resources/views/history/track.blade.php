<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>Track Order</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* FONT & COLOR SETUP */
        @font-face {
            font-family: 'SugaPro';
            src: url("{{ asset('fonts/suga-pro-display/Sugo-Pro-Display-Bold-trial.ttf') }}") format("truetype");
            font-weight: bold;
            font-style: normal;
        }
        .font-suga { font-family: 'SugaPro', sans-serif; }
        .font-poppins { font-family: 'Poppins', sans-serif; }
        .bg-blue-main { background-color: #246BFD !important; }
        .text-blue-main { color: #246BFD !important; }

        body { background-color: #F8F9FD; font-family: 'Poppins', sans-serif; overflow: hidden; }

        .mobile-container {
            max-width: 390px;
            margin: 0 auto;
            background-color: #FFFFFF;
            height: 100vh;
            position: relative;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        /* HEADER: Lengkung & Biru */
        .header-curve {
            border-bottom-left-radius: 35px;
            border-bottom-right-radius: 35px;
            height: 108px;
            width: 100%;
            background-color: #246BFD;
            position: absolute;
            top: 0;
            z-index: 20;
            pointer-events: none;
        }
        .header-content { pointer-events: auto; }

        /* MAP AREA (Draggable) */
        .map-container {
            flex: 1;
            width: 100%;
            height: 100%;
            background-color: #BEE0FF;
            position: relative;
            z-index: 10;
            margin-top: -30px;
            cursor: grab;
            touch-action: none;
            overflow: hidden;
        }
        .map-container:active { cursor: grabbing; }

        /* Gambar Peta */
        .draggable-map {
            width: 180%;
            height: 180%;
            position: absolute;
            top: -40%;
            left: -40%;
            transform: translate(0px, 0px);
            will-change: transform;
        }

        /* BOTTOM SHEET (DIKEMBALIKAN KE 55%) */
        .bottom-sheet {
            background: white;
            border-top-left-radius: 32px;
            border-top-right-radius: 32px;
            width: 100%;
            position: absolute;
            bottom: 0;
            z-index: 30;
            /* TINGGI SAYA KEMBALIKAN KE 55% (Lebih Tinggi) */
            height: 55%;
            padding: 24px 24px 20px 24px;
            box-shadow: 0 -10px 40px rgba(0,0,0,0.08);
            transition: transform 0.3s ease-out;
            display: flex;
            flex-direction: column;
        }

        .sheet-content {
            flex: 1;
            overflow-y: auto;
            padding-bottom: 40px;
        }

        .timeline-dashed {
            position: absolute;
            left: 11px;
            top: 12px;
            bottom: 30px;
            width: 2px;
            border-left: 2px dashed #333;
            z-index: 0;
        }

        .home-indicator {
            width: 134px;
            height: 5px;
            background-color: #000;
            border-radius: 100px;
            margin: 10px auto 0 auto;
            opacity: 0.8;
            flex-shrink: 0;
        }

        .sheet-content::-webkit-scrollbar { display: none; }
        .sheet-content { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-100">

    <div class="mobile-container">

        <div class="header-curve">
            <div class="header-content">
                <div class="px-6 pt-[14px] flex justify-between items-center text-white">
                    <div class="text-[15px] font-semibold tracking-wide font-poppins ml-2">9:41</div>
                    <div class="flex items-center gap-1.5 mr-2">
                        <svg class="w-[18px] h-[12px]" viewBox="0 0 18 12" fill="currentColor"><path d="M1.5 8.5C1.5 8.22386 1.72386 8 2 8H3C3.27614 8 3.5 8.22386 3.5 8.5V11.5C3.5 11.7761 3.27614 12 3 12H2C1.72386 12 1.5 11.7761 1.5 11.5V8.5Z" /><path d="M6 5.5C6 5.22386 6.22386 5 6.5 5H7.5C7.77614 5 8 5.22386 8 5.5V11.5C8 11.7761 7.77614 12 7.5 12H6.5C6.22386 12 6 11.7761 6 11.5V5.5Z" /><path d="M10.5 2.5C10.5 2.22386 10.7239 2 11 2H12C12.2761 2 12.5 2.22386 12.5 2.5V11.5C12.5 11.7761 12.2761 12 12 12H11C10.7239 12 10.5 11.7761 10.5 11.5V2.5Z" /><path d="M15 0.5C15 0.223858 15.2239 0 15.5 0H16.5C16.7761 0 17 0.223858 17 0.5V11.5C17 11.7761 16.7761 12 16.5 12H15.5C15.2239 12 15 11.7761 15 11.5V0.5Z" /></svg>
                        <svg class="w-[18px] h-[12px]" viewBox="0 0 18 12" fill="currentColor"><path fill-rule="evenodd" clip-rule="evenodd" d="M9 2.5C5.65 2.5 2.65 3.7 0.35 5.65L9 12L17.65 5.65C15.35 3.7 12.35 2.5 9 2.5Z" /></svg>
                        <svg class="w-[24px] h-[12px]" viewBox="0 0 24 12" fill="none"><rect x="0.5" y="0.5" width="20" height="10" rx="2.5" stroke="white"/><rect x="2.5" y="2.5" width="16" height="6" rx="1" fill="white"/><path d="M23 4.5V7.5" stroke="white" stroke-linecap="round"/></svg>
                    </div>
                </div>

                <div class="relative mt-2 px-5 flex items-center justify-center">
                    <a href="{{ $backUrl }}" class="absolute left-5 text-white hover:opacity-80 p-2 -ml-2">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="M12 19L5 12L12 5"/></svg>
                    </a>
                    <h1 class="font-suga text-[32px] text-white tracking-wide drop-shadow-sm pt-1">Track Order</h1>
                </div>
            </div>
        </div>

        <div class="map-container" id="mapContainer">
            <div class="draggable-map" id="draggableMap">
                <img src="{{ asset('images/map.png') }}"
                     alt="Map"
                     class="w-full h-full object-cover pointer-events-none opacity-90">

                <svg class="absolute top-0 left-0 w-full h-full pointer-events-none z-10">
                    <path d="M 280 180 Q 280 350 150 450" fill="none" stroke="#246BFD" stroke-width="6" stroke-linecap="round" stroke-dasharray="10 0"/>
                </svg>

                <div class="absolute top-[30%] left-[65%] transform -translate-x-1/2 -translate-y-1/2 drop-shadow-xl">
                    <div class="w-16 h-16 bg-blue-main/30 rounded-full flex items-center justify-center animate-pulse">
                        <div class="w-12 h-12 bg-blue-main rounded-full border-[3px] border-white flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>
                </div>

                <div class="absolute bottom-[45%] left-[35%] transform -translate-x-1/2 -translate-y-1/2 drop-shadow-lg">
                    <div class="w-11 h-11 bg-white rounded-full border-[2.5px] border-blue-main flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-main" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" /></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="bottom-sheet font-poppins">

            <div class="w-10 h-[5px] bg-gray-200 rounded-full mx-auto mb-2 flex-shrink-0"></div>

            <div class="flex justify-between items-center mb-6 mt-2">
                <h2 class="text-[18px] font-bold text-[#1E1E1E]">Order Status</h2>
                <a href="{{ $backUrl }}" class="text-black p-1 rounded-full hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </a>
            </div>

            <div class="sheet-content">
                <div class="relative pl-1 mb-8">
                    <div class="timeline-dashed"></div>
                    <div class="space-y-6 relative z-10">
                        @foreach($trackingSteps as $step)
                        <div class="flex gap-4 items-start">
                            <div class="w-6 h-6 flex-shrink-0 rounded-full z-10 flex items-center justify-center box-border
                                {{ $step['completed'] ? 'bg-blue-main border-[5px] border-blue-main' : 'bg-white border-[2px] border-gray-300' }}">
                                @if($step['completed'])
                                    <div class="w-1.5 h-1.5 bg-white rounded-full"></div>
                                @endif
                            </div>
                            <div class="-mt-1">
                                <h3 class="text-[15px] font-bold {{ $step['completed'] ? 'text-[#1E1E1E]' : 'text-gray-400' }}">
                                    {{ $step['status'] }}
                                </h3>
                                <p class="text-[13px] text-gray-400 leading-tight">
                                    {{ $step['location'] }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <hr class="border-gray-100 mb-5">

                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center gap-3">
                        <div class="w-[50px] h-[50px] rounded-full bg-gray-200 overflow-hidden border border-gray-100">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Driver" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="text-[16px] font-bold text-[#1E1E1E]">Reksy</h4>
                            <p class="text-[13px] text-gray-400 font-normal">Kurir</p>
                        </div>
                    </div>
                    <button class="w-[42px] h-[42px] rounded-full bg-[#F4F4F4] flex items-center justify-center text-blue-main hover:bg-blue-100 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" /></svg>
                    </button>
                </div>
            </div>

            <div class="home-indicator"></div>
        </div>

    </div>

    <script>
        const container = document.getElementById('mapContainer');
        const map = document.getElementById('draggableMap');
        let isDragging = false;
        let startX, startY;
        let currentX = 0, currentY = 0;

        container.addEventListener('touchstart', (e) => { isDragging = true; startX = e.touches[0].clientX - currentX; startY = e.touches[0].clientY - currentY; });
        container.addEventListener('touchmove', (e) => { if (!isDragging) return; e.preventDefault(); currentX = e.touches[0].clientX - startX; currentY = e.touches[0].clientY - startY; map.style.transform = `translate(${currentX}px, ${currentY}px)`; });
        container.addEventListener('touchend', () => isDragging = false);
        container.addEventListener('mousedown', (e) => { isDragging = true; startX = e.clientX - currentX; startY = e.clientY - currentY; container.style.cursor = 'grabbing'; });
        window.addEventListener('mousemove', (e) => { if (!isDragging) return; currentX = e.clientX - startX; currentY = e.clientY - startY; map.style.transform = `translate(${currentX}px, ${currentY}px)`; });
        window.addEventListener('mouseup', () => { isDragging = false; container.style.cursor = 'grab'; });
    </script>

</body>
</html>
