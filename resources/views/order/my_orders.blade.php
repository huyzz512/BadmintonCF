@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-black text-gray-900 mb-8 italic flex items-center">
            <i class="fas fa-history mr-3 text-blue-600"></i> LỊCH SỬ ĐƠN HÀNG
        </h1>

        @if($orders->isEmpty())
            <div class="bg-white p-12 rounded-3xl shadow-sm text-center border border-gray-100">
                <div class="text-6xl mb-4">📦</div>
                <h3 class="text-xl font-bold text-gray-700">Cậu chưa có đơn hàng nào!</h3>
                <p class="text-gray-500 mt-2">Hãy chọn cho mình những cây vợt thật ưng ý nhé.</p>
                <a href="/" class="inline-block mt-6 bg-blue-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-700 transition">
                    ĐI MUA SẮM NGAY
                </a>
            </div>
        @else
            <div class="space-y-6">
                @foreach($orders as $order)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                    <div class="p-6">
                        <div class="flex flex-wrap justify-between items-center mb-4">
                            <div>
                                <span class="text-xs font-black text-blue-500 uppercase tracking-widest">Mã đơn hàng</span>
                                <h3 class="text-xl font-black text-gray-900">#{{ $order->id }}</h3>
                            </div>
                            <div class="text-right">
                                {{-- Trạng thái đơn hàng với màu sắc tương ứng --}}
                                <span class="px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-wider 
                                    {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $order->status == 'shipping' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $order->status == 'completed' ? 'bg-green-100 text-green-700' : '' }}
                                ">
                                    {{ $order->status }}
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600 border-t border-b border-gray-50 py-4 my-4">
                            <div class="flex items-center">
                                <i class="fas fa-calendar-alt w-6 text-gray-400"></i>
                                <span>Ngày đặt: <strong>{{ $order->created_at->format('d/m/Y H:i') }}</strong></span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt w-6 text-gray-400"></i>
                                <span class="truncate">Địa chỉ: <strong>{{ $order->shipping_address }}</strong></span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-xs text-gray-400 uppercase font-bold">Tổng thanh toán</p>
                                <p class="text-2xl font-black text-red-600">{{ number_format($order->total_amount, 0, ',', '.') }} ₫</p>
                            </div>
                            <button class="bg-gray-100 text-gray-700 px-6 py-2 rounded-xl text-sm font-bold hover:bg-gray-200 transition">
                                Chi tiết <i class="fas fa-chevron-right ml-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection