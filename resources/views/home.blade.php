@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">

    {{-- CHỈ HIỆN BANNER KHI LÀ TRANG CHỦ --}}
    @if(!isset($search_title) && !isset($category))
        <div class="relative w-full h-[400px] md:h-[500px] rounded-3xl overflow-hidden mb-12 shadow-2xl group">
            <img src="https://images.unsplash.com/photo-1622279457486-640cf4c131eb?q=80&w=1920&auto=format&fit=crop" 
                 alt="Badminton Banner" 
                 class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900/90 via-gray-900/60 to-transparent"></div>
            
            <div class="absolute inset-0 flex flex-col justify-center px-8 md:px-16 lg:px-24">
                <span class="text-blue-400 font-bold tracking-widest uppercase text-sm mb-4">Mãnh liệt & Chuẩn xác</span>
                <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-6 leading-tight max-w-2xl drop-shadow-lg">
                    Đánh Thức <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Đam Mê Cầu Lông</span>
                </h1>
                <p class="text-gray-200 text-base md:text-lg mb-8 max-w-lg font-light">
                    Trang bị những cây vợt đẳng cấp nhất để làm chủ mọi trận đấu. Ưu đãi đặc biệt cho bộ sưu tập mới nhất.
                </p>
                <div>
                    <a href="#danh-sach-san-pham" id="btn-kham-pha" class="inline-flex items-center justify-center px-8 py-3 text-sm font-bold text-white transition-all duration-300 bg-blue-600 rounded-full hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-500/30 transform hover:-translate-y-1">
                        Khám phá ngay <i class="fas fa-arrow-down ml-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-16">
            <div class="flex items-center p-4 bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-center w-10 h-10 bg-blue-50 text-blue-600 rounded-full mr-3"><i class="fas fa-shield-alt text-lg"></i></div>
                <div><h4 class="font-bold text-gray-800 text-sm">Chính hãng 100%</h4></div>
            </div>
            <div class="flex items-center p-4 bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-center w-10 h-10 bg-green-50 text-green-600 rounded-full mr-3"><i class="fas fa-truck-fast text-lg"></i></div>
                <div><h4 class="font-bold text-gray-800 text-sm">Giao hỏa tốc</h4></div>
            </div>
            <div class="flex items-center p-4 bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-center w-10 h-10 bg-orange-50 text-orange-600 rounded-full mr-3"><i class="fas fa-rotate-left text-lg"></i></div>
                <div><h4 class="font-bold text-gray-800 text-sm">Đổi trả dễ dàng</h4></div>
            </div>
            <div class="flex items-center p-4 bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-center w-10 h-10 bg-purple-50 text-purple-600 rounded-full mr-3"><i class="fas fa-headset text-lg"></i></div>
                <div><h4 class="font-bold text-gray-800 text-sm">Hỗ trợ 24/7</h4></div>
            </div>
        </div>
    @endif

    <div id="danh-sach-san-pham" class="flex items-center justify-between mb-8 border-b-2 border-gray-100 pb-4">
        <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight">
            @if(isset($search_title))
                <span class="text-blue-600"><i class="fas fa-search mr-2"></i>{{ $search_title }}</span>
            @elseif(isset($category))
                <span class="text-blue-600"><i class="fas fa-filter mr-2"></i>Danh mục: {{ $category->name }}</span>
            @else
                <span class="text-gray-800">🔥 Sản phẩm nổi bật</span>
            @endif
        </h2>
        <span class="text-sm px-4 py-2 bg-gray-50 text-gray-600 rounded-full font-bold border border-gray-200">
            Tìm thấy {{ $products->count() }} sản phẩm
        </span>
    </div>

    <div id="skeleton-loader" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @for ($i = 0; $i < 8; $i++)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col p-4">
            <div class="w-full aspect-square bg-gray-200 animate-pulse rounded-xl mb-4"></div>
            <div class="h-3 bg-gray-200 animate-pulse rounded-full w-1/3 mb-3"></div>
            <div class="h-5 bg-gray-200 animate-pulse rounded-full w-3/4 mb-2"></div>
            <div class="h-5 bg-gray-200 animate-pulse rounded-full w-1/2 mb-4"></div>
            <div class="mt-auto flex items-center justify-between pt-4 border-t border-gray-50">
                <div class="h-6 bg-gray-200 animate-pulse rounded-full w-1/3"></div>
                <div class="w-10 h-10 bg-gray-200 animate-pulse rounded-full"></div>
            </div>
        </div>
        @endfor
    </div>

    <div id="actual-products" class="hidden transition-opacity duration-700 opacity-0">
        @if($products->isEmpty())
            <div class="bg-white py-16 px-4 rounded-3xl shadow-sm text-center border-2 border-dashed border-gray-200">
                <div class="text-6xl mb-4 animate-bounce">🏸</div>
                <h3 class="text-2xl font-extrabold text-gray-800 mb-2">Rất tiếc, không tìm thấy sản phẩm nào!</h3>
                <p class="text-gray-500 mb-8 font-medium">Cậu thử tìm với từ khóa khác hoặc quay lại trang chủ nhé.</p>
                <a href="/" class="inline-flex items-center justify-center px-8 py-3 bg-blue-600 text-white rounded-full font-bold hover:bg-blue-700 transition transform hover:-translate-y-1">
                    <i class="fas fa-home mr-2"></i> Quay lại trang chủ
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden flex flex-col hover:-translate-y-1">
                        
                        <div class="relative overflow-hidden aspect-square bg-gray-50 flex items-center justify-center p-6">
                            <img src="{{ $product->primaryImage->image_url ?? '/img/default-product.jpg' }}" 
                                 alt="{{ $product->product_name }}"
                                 class="max-w-full max-h-full object-contain transition-transform duration-500 group-hover:scale-110">
                            
                            @if($product->stock_quantity <= 0)
                                <div class="absolute top-3 left-3 z-10">
                                    <span class="bg-gray-800 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-md uppercase">Hết hàng</span>
                                </div>
                                <div class="absolute inset-0 bg-black/20"></div>
                            @else
                                <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <a href="{{ route('product.detail', $product->slug) }}" class="bg-white text-blue-600 font-bold py-2 px-6 rounded-full shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:bg-blue-600 hover:text-white">
                                        <i class="fas fa-eye mr-1"></i> Xem ngay
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div class="p-5 flex-1 flex flex-col bg-white">
                            <p class="text-xs text-blue-600 font-black uppercase mb-1.5 tracking-wider">{{ $product->category->name ?? 'Cầu lông' }}</p>
                            <h3 class="font-bold text-gray-800 text-lg line-clamp-2 mb-3 group-hover:text-blue-600 transition-colors">
                                <a href="{{ route('product.detail', $product->slug) }}">{{ $product->product_name }}</a>
                            </h3>
                            
                            <div class="mt-auto flex items-center justify-between pt-4 border-t border-gray-50">
                                <span class="text-xl font-extrabold text-red-600">{{ number_format($product->price, 0, ',', '.') }} ₫</span>
                                
                                @if($product->stock_quantity <= 0)
                                    <button disabled class="w-10 h-10 rounded-full bg-gray-100 text-gray-400 cursor-not-allowed flex items-center justify-center"><i class="fas fa-times"></i></button>
                                @else
                                    <a href="{{ route('product.detail', $product->slug) }}" class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-colors flex items-center justify-center shadow-sm"><i class="fas fa-shopping-cart"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        // 1. HIỆU ỨNG SMOOTH SCROLL (Lướt mượt mà khi bấm nút)
        const btnKhamPha = document.getElementById('btn-kham-pha');
        if (btnKhamPha) {
            btnKhamPha.addEventListener('click', function(e) {
                e.preventDefault(); // Ngăn chặn nhảy trang giật cục
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                
                if (targetElement) {
                    // Trượt xuống từ từ
                    targetElement.scrollIntoView({ 
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        }

        // 2. HIỆU ỨNG SKELETON LOADING
        // Giả lập thời gian tải trang mất 1.5 giây để khách kịp nhìn thấy hiệu ứng Skeleton siêu ngầu
        setTimeout(function() {
            const skeleton = document.getElementById('skeleton-loader');
            const realContent = document.getElementById('actual-products');
            
            // Ẩn khung xương đi
            skeleton.style.display = 'none';
            
            // Hiện sản phẩm thật lên từ từ (Fade in)
            realContent.classList.remove('hidden');
            
            // Đợi một tíc tắc (10ms) để trình duyệt nhận diện bỏ class hidden rồi mới thêm class hiện
            setTimeout(() => {
                realContent.classList.remove('opacity-0');
                realContent.classList.add('opacity-100');
            }, 10);
            
        }, 1200); // 1200ms = 1.2s. Sếp có thể tăng giảm số này tùy ý nhé!
    });
</script>
@endsection