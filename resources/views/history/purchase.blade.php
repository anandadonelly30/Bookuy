<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>Purchase History</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
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

        body { background-color: #F8F9FD; font-family: 'Poppins', sans-serif; }

        .mobile-container {
            max-width: 390px;
            margin: 0 auto;
            background-color: #FFFFFF;
            min-height: 100vh;
            position: relative;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            overflow-x: hidden;
        }

        .header-fixed {
            width: 100%;
            height: 172px;
            background-color: #246BFD;
            border-bottom-left-radius: 30px;
            border-bottom-right-radius: 30px;
            position: relative;
            z-index: 10;
        }

        .book-card {
            width: 342px;
            height: 107px;
            padding: 14px 15px;
            gap: 16px;
            border-radius: 10px;
            background: #FFFFFF;
            display: flex;
            align-items: flex-start;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid #F5F5F5;
            margin: 0 auto;
            box-sizing: border-box;
        }

        .book-image {
            height: 79px;
            width: 83px;
            border-radius: 6px;
            overflow: hidden;
            flex-shrink: 0;
            background-color: #f3f3f3;
        }

        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-100">

    <div class="mobile-container">

        <div class="header-fixed">
            <div class="px-6 pt-[14px] flex justify-between items-center text-white">
                <div class="text-[15px] font-semibold tracking-wide font-poppins ml-2">9:41</div>
                <div class="flex items-center gap-1.5 mr-2">
                    <svg class="w-[18px] h-[12px]" viewBox="0 0 18 12" fill="currentColor"><path d="M1.5 8.5C1.5 8.22386 1.72386 8 2 8H3C3.27614 8 3.5 8.22386 3.5 8.5V11.5C3.5 11.7761 3.27614 12 3 12H2C1.72386 12 1.5 11.7761 1.5 11.5V8.5Z" /><path d="M6 5.5C6 5.22386 6.22386 5 6.5 5H7.5C7.77614 5 8 5.22386 8 5.5V11.5C8 11.7761 7.77614 12 7.5 12H6.5C6.22386 12 6 11.7761 6 11.5V5.5Z" /><path d="M10.5 2.5C10.5 2.22386 10.7239 2 11 2H12C12.2761 2 12.5 2.22386 12.5 2.5V11.5C12.5 11.7761 12.2761 12 12 12H11C10.7239 12 10.5 11.7761 10.5 11.5V2.5Z" /><path d="M15 0.5C15 0.223858 15.2239 0 15.5 0H16.5C16.7761 0 17 0.223858 17 0.5V11.5C17 11.7761 16.7761 12 16.5 12H15.5C15.2239 12 15 11.7761 15 11.5V0.5Z" /></svg>
                    <svg class="w-[18px] h-[12px]" viewBox="0 0 18 12" fill="currentColor"><path fill-rule="evenodd" clip-rule="evenodd" d="M9 2.5C5.65 2.5 2.65 3.7 0.35 5.65L9 12L17.65 5.65C15.35 3.7 12.35 2.5 9 2.5Z" /></svg>
                    <svg class="w-[24px] h-[12px]" viewBox="0 0 24 12" fill="none"><rect x="0.5" y="0.5" width="20" height="10" rx="2.5" stroke="white"/><rect x="2.5" y="2.5" width="16" height="6" rx="1" fill="white"/><path d="M23 4.5V7.5" stroke="white" stroke-linecap="round"/></svg>
                </div>
            </div>

            <div class="relative mt-4 px-5 flex items-center justify-center">
                <a href="{{ route('profile.menu') }}" class="absolute left-5 text-white">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="M12 19L5 12L12 5"/></svg>
                </a>
                <img src="{{ asset('images/logo-bookuy.png') }}" alt="Bookuy" class="h-[28px] object-contain">
            </div>

            <div class="text-center mt-6">
                <h1 class="font-suga text-[32px] text-white tracking-wide drop-shadow-sm leading-none relative z-10">Purchase History</h1>
                </div>
        </div>

        <div class="relative z-20 px-[24px] -mt-6 pb-24">

            <div class="bg-[#F4F4F4] p-1 rounded-[12px] flex items-center h-[50px] mb-6 shadow-sm">
                <a href="{{ route('purchase.history', ['tab' => 'ongoing']) }}"
                   class="flex-1 h-full flex items-center justify-center rounded-[10px] text-[14px] font-poppins font-medium transition-all
                   {{ $currentTab == 'ongoing' ? 'bg-blue-main text-white shadow-sm' : 'text-gray-400' }}">
                    Ongoing
                </a>
                <a href="{{ route('purchase.history', ['tab' => 'completed']) }}"
                   class="flex-1 h-full flex items-center justify-center rounded-[10px] text-[14px] font-poppins font-medium transition-all
                   {{ $currentTab == 'completed' ? 'bg-blue-main text-white shadow-sm' : 'text-gray-400' }}">
                    Completed
                </a>
            </div>

            <div class="space-y-4 flex flex-col items-center">
                @forelse ($orders as $order)
                    @foreach ($order->items as $item)
                    <div class="book-card">
                        <div class="book-image shadow-sm relative bg-gray-200">
                            <img src="{{ asset($item->book->image) }}"
                                 alt="{{ $item->book->title }}"
                                 class="w-full h-full object-cover">
                        </div>

                        <div class="flex-1 h-full flex flex-col justify-between">
                            <div class="flex justify-between items-start w-full">
                                <h3 class="font-poppins font-bold text-[#1E1E1E] text-[14px] leading-[1.2] line-clamp-2 w-[60%]">
                                    {{ $item->book->title }}
                                </h3>

                                @php
                                    // Cek apakah statusnya Delivered atau Completed
                                    $isDone = in_array($order->status, ['Delivered', 'Completed']);

                                    // Jika Done -> Teks "Completed", Warna Hijau
                                    // Jika Belum -> Teks Asli (misal In Transit), Warna Abu
                                    $statusText = $isDone ? 'Completed' : $order->status;
                                    $badgeClass = $isDone ? 'bg-[#E4F9E9] text-[#27AE60]' : 'bg-[#F3F3F3] text-gray-500';
                                @endphp

                                <div class="{{ $badgeClass }} px-2 py-1 rounded-[6px] flex-shrink-0">
                                    <span class="text-[10px] font-semibold block">
                                        {{ $statusText }}
                                    </span>
                                </div>
                            </div>

                            <p class="text-[11px] text-gray-400 font-poppins -mt-1">{{ $item->book->condition ?? 'Baru' }}</p>

                            <div class="flex justify-between items-end w-full">
                                <span class="font-poppins font-bold text-[#1E1E1E] text-[14px]">Rp{{ number_format($item->price, 0, ',', '.') }}</span>

                                @if($currentTab == 'ongoing')
                                    <a href="{{ route('order.track', $order->id) }}" class="bg-blue-main text-white px-4 py-[6px] rounded-[8px] text-[10px] font-semibold shadow-md hover:opacity-90 transition">
                                        Track Order
                                    </a>
                                @else
                                    @php $userReview = $item->book->reviews->where('user_id', auth()->id())->first(); @endphp

                                    @if($userReview)
                                        <div class="flex items-center border border-gray-200 px-2 py-1 rounded-[6px]">
                                            <svg class="w-3 h-3 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                            <span class="text-[10px] font-bold text-gray-600 ml-1">{{ $userReview->rating * 1 }}/5</span>
                                        </div>
                                    @else
                                        <button onclick="openReviewModal({{ $item->book->id }})" class="bg-blue-main text-white px-4 py-[6px] rounded-[8px] text-[10px] font-semibold shadow-md hover:opacity-90 transition">
                                            Leave Review
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                @empty
                    <div class="py-10 text-gray-400 text-sm">Belum ada pesanan.</div>
                @endforelse
            </div>
        </div>

        <div class="fixed bottom-0 left-1/2 transform -translate-x-1/2 pb-2 pt-4 w-full max-w-[390px] flex justify-center bg-transparent pointer-events-none z-50">
            <div class="w-[134px] h-[5px] bg-black rounded-full opacity-80"></div>
        </div>
    </div>

    <div id="reviewModal" class="fixed inset-0 z-50 hidden font-poppins">
        <div class="absolute inset-0 bg-black bg-opacity-60 transition-opacity" onclick="closeReviewModal()"></div>
        <div class="absolute bottom-0 w-full md:w-[390px] md:left-1/2 md:-translate-x-1/2 bg-white rounded-t-[30px] p-6 transform transition-transform duration-300 translate-y-0">
            <div class="flex justify-between items-center mb-2">
                <h3 class="text-[18px] font-bold text-[#1E1E1E]">Leave a Review</h3>
                <button onclick="closeReviewModal()" class="bg-gray-100 p-1 rounded-full text-gray-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
            </div>
            <p class="text-gray-400 text-[12px] mb-6">How was your order?</p>
            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <input type="hidden" name="book_id" id="modalBookId">
                <div class="flex justify-center gap-3 mb-8">
                    @for($i = 1; $i <= 5; $i++)
                        <svg onclick="setRating({{ $i }})" id="star-{{ $i }}" class="w-10 h-10 cursor-pointer text-gray-200" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    @endfor
                </div>
                <input type="hidden" name="rating" id="ratingInput" value="0">
                <textarea name="comment" rows="3" class="w-full bg-gray-50 rounded-[15px] p-4 mb-6 text-sm focus:outline-none border border-transparent focus:border-blue-500" placeholder="Write your review here..."></textarea>
                <button type="submit" class="w-full bg-blue-main text-white font-bold text-[14px] py-3 rounded-full shadow-lg">Submit</button>
            </form>
        </div>
    </div>

    <script>
        function openReviewModal(id) { document.getElementById('modalBookId').value = id; document.getElementById('reviewModal').classList.remove('hidden'); setRating(0); }
        function closeReviewModal() { document.getElementById('reviewModal').classList.add('hidden'); }
        function setRating(r) { document.getElementById('ratingInput').value = r; for(let i=1; i<=5; i++) { document.getElementById('star-'+i).classList.toggle('text-yellow-400', i<=r); document.getElementById('star-'+i).classList.toggle('text-gray-200', i>r); } }
    </script>
</body>
</html>
