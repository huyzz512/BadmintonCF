@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-16 flex justify-center">
    <div class="max-w-2xl w-full bg-white rounded-3xl shadow-2xl p-8 md:p-12 text-center border border-gray-100">
        
        <div class="mb-8 relative inline-block">
            <div class="bg-green-100 text-green-600 w-24 h-24 rounded-full flex items-center justify-center mx-auto text-5xl animate-bounce">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="absolute -top-2 -right-2 text-yellow-400 animate-pulse">
                <i class="fas fa-star text-xl"></i>
            </div>
        </div>

        <h1 class="text-4xl font-black text-gray-900 mb-4 tracking-tight italic">ĐẶT HÀNG THÀNH CÔNG! 🏸</h1>
        <p class="text-gray-500 text-lg mb-8 leading-relaxed">
            Cảm ơn cậu đã tin tưởng lựa chọn <span class="text-blue-600 font-bold uppercase">Badminton Shop</span>. <br> 
            Đơn hàng của cậu đã được hệ thống tiếp nhận và đang chờ duyệt.
        </p>

        <div class="bg-blue-50 rounded-2xl p-6 mb-10 border border-blue-100 flex flex-col md:flex-row justify-around items-center space-y-4 md:space-y-0">
            <div>
                <p class="text-xs text-blue-400 uppercase font-black tracking-widest mb-1">Mã đơn hàng</p>
                <p class="text-2xl font-black text-blue-900">#{{ $order->id }}</p>
            </div>
            <div class="hidden md:block w-px h-10 bg-blue-200"></div>
            <div>
                <p class="text-xs text-blue-400 uppercase font-black tracking-widest mb-1">Tổng thanh toán</p>
                <p class="text-2xl font-black text-red-600">{{ number_format($order->total_amount, 0, ',', '.') }} ₫</p>
            </div>
        </div>

        <div class="text-left mb-10">
            <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-truck-loading mr-2 text-blue-600"></i> Các bước tiếp theo:
            </h3>
            <ul class="space-y-4">
                <li class="flex items-start space-x-3 text-sm text-gray-600">
                    <span class="bg-gray-200 text-gray-800 w-5 h-5 rounded-full flex items-center justify-center text-xs flex-shrink-0 mt-0.5">1</span>
                    <p>Nhân viên sẽ gọi điện xác nhận đơn hàng trong vòng 15-30 phút.</p>
                </li>
                <li class="flex items-start space-x-3 text-sm text-gray-600">
                    <span class="bg-gray-200 text-gray-800 w-5 h-5 rounded-full flex items-center justify-center text-xs flex-shrink-0 mt-0.5">2</span>
                    <p>Đơn hàng sẽ được đóng gói cẩn thận và gửi đến đơn vị vận chuyển.</p>
                </li>
            </ul>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="/" class="bg-gray-900 text-white py-4 rounded-2xl font-bold hover:bg-black transition duration-300 shadow-lg">
                <i class="fas fa-home mr-2"></i> Về trang chủ
            </a>
            <a href="{{ route('cart.index') }}" class="bg-blue-600 text-white py-4 rounded-2xl font-bold hover:bg-blue-700 transition duration-300 shadow-lg">
                Xem lại giỏ hàng <i class="fas fa-chevron-right ml-2 text-sm"></i>
            </a>
        </div>

    </div>
</div>
@endsection