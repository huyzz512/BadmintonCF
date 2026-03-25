@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 md:py-12">
    
    <div class="flex items-center justify-center mb-10 md:mb-16 hidden sm:flex">
        <a href="{{ route('cart.index') }}" class="flex items-center text-blue-600 font-bold hover:text-blue-800 transition">
            <span class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-3"><i class="fas fa-check"></i></span> 
            Giỏ hàng
        </a>
        <div class="w-16 md:w-32 h-1 bg-blue-600 mx-4 rounded-full"></div>
        <div class="flex items-center text-blue-600 font-bold">
            <span class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center mr-3 shadow-lg shadow-blue-200 border-4 border-blue-100">2</span> 
            Thanh toán
        </div>
        <div class="w-16 md:w-32 h-1 bg-gray-100 mx-4 rounded-full"></div>
        <div class="flex items-center text-gray-400 font-bold">
            <span class="w-10 h-10 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center mr-3">3</span> 
            Hoàn tất
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-10">
        
        <div class="lg:w-3/5">
            <div class="bg-white p-8 md:p-10 rounded-[2rem] shadow-sm border border-gray-100">
                <h2 class="text-3xl font-black text-gray-900 mb-8 tracking-tight">Thông tin giao hàng</h2>
                
                <form action="{{ route('order.store') }}" method="POST" id="checkout-form">
                    @csrf
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Họ tên người nhận <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <input type="text" name="name" value="{{ auth()->check() ? auth()->user()->name : '' }}" 
                                       class="w-full pl-11 pr-4 py-4 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all outline-none" 
                                       placeholder="Nhập họ tên đầy đủ..." required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Số điện thoại liên hệ <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-phone-alt text-gray-400"></i>
                                </div>
                                <input type="text" name="phone" value="{{ auth()->check() ? auth()->user()->phone : '' }}" 
                                       class="w-full pl-11 pr-4 py-4 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all outline-none" 
                                       placeholder="Ví dụ: 0987654321" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Địa chỉ nhận hàng (Chi tiết) <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute top-4 left-4 pointer-events-none">
                                    <i class="fas fa-map-marker-alt text-gray-400"></i>
                                </div>
                                <textarea name="address" rows="3" 
                                          class="w-full pl-11 pr-4 py-4 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all outline-none" 
                                          placeholder="Số nhà, Tên đường, Phường/Xã, Quận/Huyện, Tỉnh/Thành phố..." required>{{ auth()->check() ? auth()->user()->address : '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 mt-10 mb-6 border-b border-gray-100 pb-4">Phương thức thanh toán</h3>
                    <div class="space-y-4 mb-10">
                        <label class="flex items-center justify-between p-4 border-2 border-blue-500 bg-blue-50/50 rounded-2xl cursor-pointer transition-all">
                            <div class="flex items-center gap-4">
                                <input type="radio" name="payment_method" value="COD" checked class="w-5 h-5 text-blue-600 focus:ring-blue-500">
                                <div>
                                    <span class="block font-bold text-gray-900 text-lg">Thanh toán khi nhận hàng (COD)</span>
                                    <span class="block text-sm text-gray-500">Kiểm tra vợt kỹ càng rồi mới trả tiền</span>
                                </div>
                            </div>
                            <i class="fas fa-money-bill-wave text-3xl text-blue-500 opacity-80"></i>
                        </label>
                        
                        <label class="flex items-center justify-between p-4 border border-gray-200 rounded-2xl cursor-not-allowed opacity-60">
                            <div class="flex items-center gap-4">
                                <input type="radio" name="payment_method" value="BANK" disabled class="w-5 h-5">
                                <div>
                                    <span class="block font-bold text-gray-900 text-lg">Chuyển khoản ngân hàng</span>
                                    <span class="block text-sm text-gray-500">Tính năng đang được nâng cấp</span>
                                </div>
                            </div>
                            <i class="fas fa-credit-card text-3xl text-gray-400"></i>
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-gray-900 text-white font-black text-xl py-5 rounded-2xl hover:bg-blue-600 transition-colors shadow-xl shadow-gray-200 flex items-center justify-center group">
                        XÁC NHẬN ĐẶT HÀNG <i class="fas fa-paper-plane ml-3 group-hover:translate-x-2 transition-transform"></i>
                    </button>
                    <p class="text-center text-sm text-gray-400 mt-4"><i class="fas fa-shield-check mr-1"></i> Thông tin của bạn được bảo mật tuyệt đối</p>
                </form>
            </div>
        </div>

        <div class="lg:w-2/5">
            <div class="bg-gray-50 p-8 rounded-[2rem] border border-gray-200 sticky top-24">
                <h3 class="text-2xl font-black text-gray-900 mb-6 tracking-tight">Đơn hàng của bạn</h3>
                
                <div class="space-y-4 mb-6 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                    @php $total = 0; @endphp
                    @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity']; @endphp
                            <div class="flex items-center gap-4 bg-white p-3 rounded-xl border border-gray-100 shadow-sm">
                                <div class="relative w-16 h-16 bg-gray-50 rounded-lg flex-shrink-0 border border-gray-100 p-1">
                                    <img src="{{ $details['image'] ?? '/img/default-product.jpg' }}" class="w-full h-full object-contain">
                                    <span class="absolute -top-2 -right-2 bg-gray-800 text-white text-xs font-bold w-6 h-6 flex items-center justify-center rounded-full border-2 border-white">{{ $details['quantity'] }}</span>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-gray-800 text-sm line-clamp-2 leading-tight">{{ $details['name'] }}</h4>
                                </div>
                                <div class="font-black text-gray-900 whitespace-nowrap">
                                    {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }} ₫
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="border-t border-gray-200 pt-6 space-y-3">
                    <div class="flex justify-between text-gray-600 font-medium">
                        <span>Tạm tính</span>
                        <span>{{ number_format($total, 0, ',', '.') }} ₫</span>
                    </div>
                    <div class="flex justify-between text-gray-600 font-medium">
                        <span>Phí vận chuyển</span>
                        <span class="text-green-600">Miễn phí</span>
                    </div>
                    <div class="flex justify-between items-end border-t border-gray-200 pt-4 mt-2">
                        <span class="font-bold text-gray-800 text-lg">TỔNG CỘNG</span>
                        <span class="text-3xl font-black text-red-600 tracking-tighter">{{ number_format($total, 0, ',', '.') }} ₫</span>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<style>
    /* Làm đẹp thanh cuộn cho danh sách sản phẩm dài */
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
</style>
@endsection