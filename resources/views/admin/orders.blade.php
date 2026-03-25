@extends('admin.layout')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Quản lý Đơn hàng</h1>
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            <i class="fas fa-file-export mr-2"></i> Xuất báo cáo
        </button>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 shadow-sm animate-pulse">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-100">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-4 border-b">Mã đơn</th>
                    <th class="p-4 border-b">Thông tin khách</th>
                    <th class="p-4 border-b">Tổng tiền</th>
                    <th class="p-4 border-b">Trạng thái</th>
                    <th class="p-4 border-b">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr class="hover:bg-gray-50 border-b transition">
                        <td class="p-4 font-bold text-blue-600">#{{ $order->id }}</td>
                        <td class="p-4 text-sm">
                            <div class="font-bold text-gray-800">
                                {{ $order->user->name ?? 'Khách vãng lai' }}
                            </div>

                            <div class="text-blue-600 font-medium">
                                <i class="fas fa-phone-alt text-[10px] mr-1"></i> {{ $order->phone ?? 'Chưa có SĐT' }}
                            </div>

                            <div class="text-gray-500 italic mt-1 line-clamp-1" title="{{ $order->shipping_address }}">
                                <i class="fas fa-map-marker-alt text-[10px] mr-1"></i> {{ $order->shipping_address }}
                            </div>
                        </td>
                        <td class="p-4 font-bold text-gray-800">{{ number_format($order->total_amount, 0, ',', '.') }} ₫</td>
                        <td class="p-4">
                            <span class="px-2 py-1 rounded text-xs font-bold 
                                    {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $order->status == 'shipping' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $order->status == 'completed' ? 'bg-green-100 text-green-700' : '' }}
                                ">
                                {{ strtoupper($order->status) }}
                            </span>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center space-x-3">
                                @if($order->status == 'pending')
                                    <a href="{{ route('admin.orders.update', [$order->id, 'shipping']) }}"
                                        class="bg-blue-500 text-white px-3 py-1 rounded text-xs hover:bg-blue-600 transition shadow-sm">Duyệt</a>
                                @endif

                                @if($order->status == 'shipping')
                                    <a href="{{ route('admin.orders.update', [$order->id, 'completed']) }}"
                                        class="bg-green-500 text-white px-3 py-1 rounded text-xs hover:bg-green-600 transition shadow-sm">Xong</a>
                                @endif

                                <a href="{{ route('admin.orders.delete', $order->id) }}"
                                    onclick="return confirm('Sếp có chắc chắn muốn xóa đơn hàng #{{ $order->id }} này không? Hành động này sẽ xóa vĩnh viễn dữ liệu đơn hàng!')"
                                    class="text-gray-400 hover:text-red-500 transition duration-300 transform hover:scale-125">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection