@extends('admin.layout')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">Thêm Sản Phẩm Mới</h1>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-2 gap-6">
            <div class="mb-4">
                <label class="block font-medium mb-1">Tên sản phẩm</label>
                <input type="text" name="product_name" class="w-full border p-2 rounded" placeholder="VD: Vợt Yonex Astrox 88D" required>
            </div>
            <div class="mb-4">
                <label class="block font-medium mb-1">Danh mục</label>
                <select name="category_id" class="w-full border p-2 rounded">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block font-medium mb-1">Giá bán (₫)</label>
                <input type="number" name="price" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block font-medium mb-1">Số lượng kho</label>
                <input type="number" name="stock_quantity" class="w-full border p-2 rounded" value="10">
            </div>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Mô tả sản phẩm</label>
            <textarea name="description" rows="4" class="w-full border p-2 rounded"></textarea>
        </div>

        <div class="mb-6">
            <label class="block font-medium mb-1">Hình ảnh đại diện</label>
            <input type="file" name="image" class="w-full border p-2 rounded" accept="image/*" required>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.products.index') }}" class="px-6 py-2 bg-gray-200 rounded">Hủy</a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Lưu sản phẩm</button>
        </div>
    </form>
</div>
@endsection