@extends('admin.layout')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Quản lý Sản phẩm</h1>
    <a href="{{ route('admin.products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
    + Thêm sản phẩm
</a>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-4 border-b">ID</th>
                <th class="p-4 border-b">Tên sản phẩm</th>
                <th class="p-4 border-b">Danh mục</th>
                <th class="p-4 border-b">Giá</th>
                <th class="p-4 border-b">Kho</th>
                <th class="p-4 border-b">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $pro)
            <tr class="hover:bg-gray-50 border-b">
                <td class="p-4">#{{ $pro->id }}</td>
                <td class="p-4 font-bold">{{ $pro->product_name }}</td>
                <td class="p-4">{{ $pro->category->name ?? 'N/A' }}</td>
                <td class="p-4 text-red-600 font-bold">{{ number_format($pro->price, 0, ',', '.') }} ₫</td>
                <td class="p-4">{{ $pro->stock_quantity }}</td>
                <td class="p-4">
                    <a href="{{ route('admin.products.delete', $pro->id) }}" 
                       onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')"
                       class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i> Xóa</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection