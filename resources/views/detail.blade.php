@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 md:py-12">
    
    <nav class="mb-8">
        <a href="/" class="inline-flex items-center text-blue-600 font-bold hover:text-blue-800 transition-transform hover:-translate-x-2">
            <i class="fas fa-arrow-left mr-2"></i> Quay lại trang chủ
        </a>
    </nav>

    <div class="bg-white rounded-[2rem] shadow-xl shadow-blue-900/5 overflow-hidden border border-gray-100 p-6 md:p-10">
        <div class="flex flex-col md:flex-row gap-10 md:gap-16">
            
            <div class="md:w-1/2 flex flex-col">
                <div class="relative aspect-square bg-gray-50/50 flex items-center justify-center rounded-3xl p-8 shadow-inner border border-gray-100 overflow-hidden group">
                    <img id="mainProductImage" 
                         src="{{ $product->primaryImage->image_url ?? '/img/default-product.jpg' }}" 
                         alt="{{ $product->product_name }}"
                         class="max-w-full max-h-full object-contain transition-transform duration-700 group-hover:scale-110 drop-shadow-2xl">
                </div>
            </div>

            <div class="md:w-1/2 flex flex-col justify-center">
                
                <p class="text-blue-600 font-extrabold uppercase tracking-widest text-sm mb-3 flex items-center">
                    <span class="w-2 h-2 rounded-full bg-blue-600 mr-2 animate-pulse"></span>
                    {{ $product->category->name ?? 'Dụng cụ cầu lông' }}
                </p>
                
                <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-6 leading-tight tracking-tight">
                    {{ $product->product_name }}
                </h1>
                
                <div class="flex items-end gap-4 mb-6 p-4 bg-gray-50 rounded-2xl border border-gray-100 w-max">
                    <span class="text-4xl md:text-5xl font-black text-red-600 tracking-tighter drop-shadow-sm">
                        {{ number_format($product->price, 0, ',', '.') }} ₫
                    </span>
                    <span class="text-gray-400 line-through text-xl font-medium mb-1">
                        {{ number_format($product->price * 1.1, 0, ',', '.') }} ₫
                    </span>
                </div>

                <div class="text-gray-600 leading-relaxed mb-8 text-base md:text-lg font-light border-l-4 border-blue-600 pl-5 bg-gradient-to-r from-blue-50/50 to-transparent py-2">
                    {{ Str::limit(strip_tags($product->description), 160, '...') }}
                </div>

                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mb-10 mt-auto">
                    <a href="{{ route('cart.add', $product->id) }}" 
                       class="flex-1 bg-blue-600 text-white text-center py-5 px-8 rounded-2xl font-black text-lg hover:bg-blue-700 shadow-xl shadow-blue-500/30 transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center group">
                        <i class="fas fa-shopping-cart mr-3 text-2xl group-hover:scale-110 transition-transform"></i> THÊM VÀO GIỎ HÀNG
                    </a>
                    <button class="bg-gray-50 border border-gray-200 text-gray-400 px-6 py-5 rounded-2xl hover:text-red-500 hover:bg-red-50 hover:border-red-100 transition-all duration-300 flex items-center justify-center group">
                        <i class="fas fa-heart text-2xl group-hover:scale-110 transition-transform"></i>
                    </button>
                </div>

                <div class="grid grid-cols-2 gap-4 pt-6 border-t border-gray-100 text-sm font-bold text-gray-600">
                    <div class="flex items-center gap-3"><i class="fas fa-shield-check text-blue-500 text-xl"></i> Hàng chính hãng</div>
                    <div class="flex items-center gap-3"><i class="fas fa-box-open text-green-500 text-xl"></i> Kiểm tra khi nhận</div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-12 bg-white rounded-[2rem] shadow-xl shadow-blue-900/5 overflow-hidden border border-gray-100">
        <div class="flex border-b border-gray-100 bg-gray-50/50 px-6 md:px-12 pt-6 gap-8 overflow-x-auto hide-scrollbar">
            <button id="tab-desc-btn" class="tab-btn pb-4 text-xl font-black text-blue-600 border-b-4 border-blue-600 active tracking-tight whitespace-nowrap transition-colors" onclick="switchTab('desc')">
                <i class="fas fa-file-alt mr-2"></i> Bài viết chi tiết
            </button>
            <button id="tab-specs-btn" class="tab-btn pb-4 text-xl font-bold text-gray-400 border-b-4 border-transparent hover:text-blue-500 tracking-tight whitespace-nowrap transition-colors" onclick="switchTab('specs')">
                <i class="fas fa-cogs mr-2"></i> Thông số kỹ thuật
            </button>
        </div>

        <div class="p-6 md:p-12">
            
            <div id="tab-desc-content" class="tab-content text-gray-700 leading-loose font-light text-lg">
                {!! nl2br(e($product->description)) !!}
            </div>

            <div id="tab-specs-content" class="tab-content hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-4 max-w-5xl">
                    @php $specs = json_decode($product->specifications, true); @endphp
                    
                    @if(!empty($specs))
                        @foreach($specs as $key => $value)
                            <div class="flex items-center justify-between py-4 border-b border-dashed border-gray-200 hover:bg-gray-50 px-2 rounded-lg transition-colors">
                                <span class="text-gray-500 font-semibold capitalize flex items-center">
                                    <i class="fas fa-check text-blue-400 mr-3 text-sm"></i> 
                                    {{ str_replace('_', ' ', $key) }}
                                </span>
                                <span class="text-gray-900 font-extrabold text-right">{{ $value }}</span>
                            </div>
                        @endforeach
                    @else
                        <div class="col-span-2 flex flex-col items-center justify-center py-10 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                            <i class="fas fa-tools text-4xl text-gray-300 mb-3"></i>
                            <p class="text-gray-500 font-medium">Đang cập nhật thông số từ nhà sản xuất...</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

</div>

<script>
    function switchTab(tabName) {
        // Reset tất cả nút
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('text-blue-600', 'border-blue-600', 'font-black');
            btn.classList.add('text-gray-400', 'border-transparent', 'font-bold');
        });
        
        // Active nút được bấm
        document.getElementById(`tab-${tabName}-btn`).classList.add('text-blue-600', 'border-blue-600', 'font-black');

        // Ẩn tất cả nội dung
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });
        
        // Hiện nội dung tương ứng (Kèm hiệu ứng fade in)
        const targetContent = document.getElementById(`tab-${tabName}-content`);
        targetContent.classList.remove('hidden');
        targetContent.style.opacity = '0';
        setTimeout(() => {
            targetContent.style.transition = 'opacity 0.4s ease';
            targetContent.style.opacity = '1';
        }, 10);
    }
</script>

<style>
    /* Ẩn thanh cuộn ngang ở khung Tabs trên Mobile */
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endsection