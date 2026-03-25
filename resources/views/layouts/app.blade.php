<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Badminton Shop - Thế giới cầu lông chính hãng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
        html { font-size: 85%; } 
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    
    <header class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                {{-- Logo --}}
                <a href="/" class="text-3xl font-extrabold text-blue-600 tracking-tighter flex-shrink-0">
                    BADMINTON<span class="text-red-500">CF</span>
                </a>

                {{-- Thanh tìm kiếm --}}
                <div class="hidden md:flex flex-1 mx-10">
                    <form action="{{ route('search') }}" method="GET" class="w-full flex">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Tìm kiếm sản phẩm..." 
                               class="w-full border-2 border-blue-600 px-4 py-2 rounded-l-2xl focus:outline-none focus:ring-2 focus:ring-blue-200 transition">
                        <button type="submit" class="bg-blue-600 text-white px-6 rounded-r-2xl hover:bg-blue-700 transition">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                {{-- Action Icons: Cart & Auth --}}
                <div class="flex items-center space-x-6">
                    {{-- Nút Giỏ hàng --}}
                    <a href="{{ route('cart.index') }}" class="relative text-gray-700 hover:text-blue-600 transition">
                        <i class="fas fa-shopping-basket text-2xl"></i>
                        @if(session('cart') && count(session('cart')) > 0)
                            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full border-2 border-white">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </a>

                    {{-- Xác thực người dùng --}}
                    <div class="flex items-center space-x-4 border-l pl-6 border-gray-100">
                        @auth
                            <div class="hidden lg:block text-right">
                                <p class="text-[10px] text-gray-400 uppercase font-black tracking-widest">Xin chào,</p>
                                <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</p>
                            </div>
                            
                            <div class="flex items-center space-x-3">
                                {{-- Link xem đơn hàng --}}
                                <a href="{{ route('orders.my') }}" class="text-gray-600 hover:text-blue-600 text-sm font-semibold" title="Đơn hàng của tôi">
                                    <i class="fas fa-box-open mr-1"></i> Đơn hàng
                                </a>

                                {{-- Nếu là Admin thì hiện nút vào Dashboard --}}
                                @if(Auth::user()->role == 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="bg-red-50 text-red-600 px-3 py-1 rounded-lg text-xs font-black border border-red-100 hover:bg-red-600 hover:text-white transition">
                                        ADMIN
                                    </a>
                                @endif

                                <a href="{{ route('logout') }}" class="text-gray-300 hover:text-red-500 transition" title="Đăng xuất">
                                    <i class="fas fa-sign-out-alt"></i>
                                </a>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-bold text-sm">Đăng nhập</a>
                            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-5 py-2 rounded-xl text-sm font-bold hover:bg-blue-700 shadow-lg shadow-blue-100 transition">Đăng ký</a>
                        @endauth
                    </div>
                </div>
            </div>

            <nav class="flex space-x-8 py-3 text-xs font-black uppercase tracking-widest overflow-x-auto whitespace-nowrap scrollbar-hide">
                <a href="/" class="text-blue-600 border-b-2 border-blue-600 pb-1">Trang chủ</a>
                <a href="{{ route('category.show', 'vot-cau-long') }}" class="text-gray-500 hover:text-blue-600 transition">Vợt cầu lông</a>
                <a href="{{ route('category.show', 'giay-cau-long') }}" class="text-gray-500 hover:text-blue-600 transition">Giày cầu lông</a>
                <a href="{{ route('category.show', 'ao-cau-long') }}" class="text-gray-500 hover:text-blue-600 transition">Áo cầu lông</a>
                <a href="{{ route('category.show', 'phu-kien') }}" class="text-gray-500 hover:text-blue-600 transition">Phụ kiện</a>
            </nav>
        </div>
    </header>

    @if(session('success'))
        <div class="container mx-auto px-4 mt-4">
            <div class="bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg flex justify-between items-center animate-bounce">
                <span><i class="fas fa-check-circle mr-2"></i> {{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-white opacity-50 hover:opacity-100">&times;</button>
            </div>
        </div>
    @endif

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-gray-400 mt-20 py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 border-b border-gray-800 pb-10 mb-10 text-center md:text-left">
                <div>
                    <h4 class="text-white text-xl font-black mb-4 tracking-tighter">BADMINTON<span class="text-red-500">CF</span></h4>
                    <p class="text-sm leading-relaxed">Hệ thống phân phối dụng cụ cầu lông chính hãng hàng đầu Việt Nam. Chất lượng tạo nên thương hiệu.</p>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4 uppercase text-xs tracking-widest">Hỗ trợ khách hàng</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Chính sách bảo hành</a></li>
                        <li><a href="#" class="hover:text-white transition">Chính sách đổi trả</a></li>
                        <li><a href="#" class="hover:text-white transition">Hướng dẫn thanh toán</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4 uppercase text-xs tracking-widest">Liên hệ</h4>
                    <p class="text-sm mb-2"><i class="fas fa-phone mr-2 text-blue-500"></i> 0123.456.789</p>
                    <p class="text-sm"><i class="fas fa-map-marker-alt mr-2 text-blue-500"></i> Hanoi, Vietnam</p>
                </div>
            </div>
            <div class="text-center text-xs tracking-widest font-medium">
                &copy; 2026 BADMINTON SHOP. DEVELOPED BY <span class="text-white">LUU XUAN TUAN VU</span>.
            </div>
        </div>
    </footer>

</body>
</html>