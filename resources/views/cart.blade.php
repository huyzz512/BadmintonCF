@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 md:py-12">
    
    <div class="flex items-center justify-center mb-10 md:mb-16 hidden sm:flex">
        <div class="flex items-center text-blue-600 font-bold">
            <span class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center mr-3 shadow-lg shadow-blue-200 border-4 border-blue-100">1</span> 
            Giỏ hàng
        </div>
        <div class="w-16 md:w-32 h-1 bg-gray-100 mx-4 rounded-full"></div>
        <div class="flex items-center text-gray-400 font-bold">
            <span class="w-10 h-10 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center mr-3">2</span> 
            Thanh toán
        </div>
        <div class="w-16 md:w-32 h-1 bg-gray-100 mx-4 rounded-full"></div>
        <div class="flex items-center text-gray-400 font-bold">
            <span class="w-10 h-10 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center mr-3">3</span> 
            Hoàn tất
        </div>
    </div>

    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl md:text-4xl font-black text-gray-900 tracking-tight">Giỏ hàng của bạn</h1>
        @if(session('cart') && count(session('cart')) > 0)
            <span class="bg-blue-50 text-blue-600 font-bold px-4 py-2 rounded-full text-sm">
                {{ count(session('cart')) }} Sản phẩm
            </span>
        @endif
    </div>

    @if(session('cart') && count(session('cart')) > 0)
        <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
            
            <div class="lg:w-2/3">
                <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden p-6 md:p-8">
                    
                    <div class="hidden md:flex text-sm font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 pb-4 mb-6">
                        <div class="w-1/2">Sản phẩm</div>
                        <div class="w-1/4 text-center">Số lượng</div>
                        <div class="w-1/4 text-right">Thành tiền</div>
                    </div>

                    <div class="space-y-6">
                        @php $total = 0; @endphp
                        @foreach(session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity']; @endphp
                            
                            <div class="flex flex-col md:flex-row md:items-center justify-between group py-4 border-b border-gray-50 last:border-0 last:pb-0">
                                
                                <div class="flex items-center space-x-4 md:space-x-6 md:w-1/2 mb-4 md:mb-0">
                                    <div class="relative w-24 h-24 bg-gray-50 rounded-2xl border border-gray-100 p-2 flex-shrink-0">
                                        <img src="{{ $details['image'] ?? '/img/default-product.jpg' }}"
                                             class="w-full h-full object-contain mix-blend-multiply group-hover:scale-110 transition-transform duration-300">
                                    </div>
                                    <div>
                                        <a href="{{ route('product.detail', $id) }}" class="font-bold text-gray-800 text-lg leading-tight hover:text-blue-600 transition-colors line-clamp-2">
                                            {{ $details['name'] }}
                                        </a>
                                        <p class="text-blue-600 font-black mt-2">
                                            {{ number_format($details['price'], 0, ',', '.') }} ₫
                                        </p>
                                    </div>
                                </div>

                                <div class="md:w-1/4 flex justify-start md:justify-center mb-4 md:mb-0">
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="inline-flex">
                                        @csrf
                                        <div class="flex items-center border-2 border-gray-100 rounded-xl overflow-hidden bg-gray-50 focus-within:border-blue-500 transition-colors">
                                            <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1"
                                                class="w-16 py-2 px-2 text-center font-bold bg-transparent outline-none text-gray-800"
                                                onchange="this.form.submit()">
                                        </div>
                                    </form>
                                </div>

                                <div class="md:w-1/4 flex items-center justify-between md:justify-end md:space-x-6">
                                    <span class="font-black text-red-600 text-xl md:text-lg">
                                        {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }} ₫
                                    </span>
                                    
                                    <a href="{{ route('cart.remove', $id) }}" 
                                       class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-50 text-gray-400 hover:bg-red-50 hover:text-red-500 transition-colors"
                                       title="Xóa khỏi giỏ hàng">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-8">
                    <a href="/" class="inline-flex items-center text-gray-500 font-bold hover:text-blue-600 transition-colors px-4 py-2 rounded-xl hover:bg-blue-50">
                        <i class="fas fa-arrow-left mr-2"></i> Tiếp tục mua sắm
                    </a>
                </div>
            </div>

            <div class="lg:w-1/3">
                <div class="bg-gray-900 text-white p-8 rounded-[2rem] shadow-2xl sticky top-24 relative overflow-hidden">
                    
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-white opacity-5 rounded-full blur-2xl"></div>
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-purple-500"></div>

                    <h3 class="text-2xl font-black mb-8 border-b border-gray-800 pb-6 flex items-center">
                        <i class="fas fa-receipt text-blue-400 mr-3"></i> Tóm tắt đơn hàng
                    </h3>
                    
                    <div class="space-y-4 mb-8 text-lg">
                        <div class="flex justify-between items-center text-gray-300">
                            <span>Tạm tính ({{ count(session('cart')) }} món):</span>
                            <span class="font-bold text-white">{{ number_format($total, 0, ',', '.') }} ₫</span>
                        </div>
                        <div class="flex justify-between items-center text-gray-300">
                            <span>Phí vận chuyển:</span>
                            <span class="bg-green-500/20 text-green-400 font-bold px-3 py-1 rounded-lg text-sm uppercase tracking-wider">
                                Miễn phí
                            </span>
                        </div>
                    </div>

                    <div class="flex justify-between items-end border-t border-gray-800 pt-6 mb-10">
                        <div>
                            <span class="block text-gray-400 text-sm font-bold uppercase tracking-widest mb-1">Tổng thanh toán</span>
                        </div>
                        <span class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-200">
                            {{ number_format($total, 0, ',', '.') }} ₫
                        </span>
                    </div>

                    <a href="{{ route('checkout') }}"
                        class="block w-full text-center bg-blue-600 text-white py-5 rounded-2xl font-black text-lg hover:bg-blue-500 hover:shadow-lg hover:shadow-blue-500/50 transition-all duration-300 transform hover:-translate-y-1">
                        TIẾN HÀNH THANH TOÁN <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                    
                    <p class="text-center text-gray-500 text-xs mt-6 flex items-center justify-center">
                        <i class="fas fa-lock mr-2 text-gray-400"></i> Thanh toán an toàn & bảo mật 100%
                    </p>
                </div>
            </div>
            
        </div>
    @else
        <div class="bg-white py-24 px-4 rounded-[2rem] shadow-sm text-center border-2 border-dashed border-gray-200 flex flex-col items-center justify-center">
            <div class="w-32 h-32 bg-gray-50 rounded-full flex items-center justify-center mb-6">
                <i class="fas fa-shopping-basket text-6xl text-gray-300"></i>
            </div>
            <h3 class="text-3xl font-black text-gray-800 mb-3 tracking-tight">Giỏ hàng trống rỗng!</h3>
            <p class="text-gray-500 mb-10 text-lg font-light">Có vẻ như cậu chưa chọn được bảo kiếm cầu lông nào ưng ý...</p>
            <a href="/" class="bg-blue-600 text-white px-10 py-4 rounded-full font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200 transform hover:-translate-y-1 flex items-center">
                <i class="fas fa-search mr-2"></i> ĐI MUA SẮM NGAY
            </a>
        </div>
    @endif
</div>
@endsection