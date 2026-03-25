<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Badminton Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 flex">
    <aside class="w-64 bg-gray-900 text-white min-h-screen p-4">
        <h2 class="text-2xl font-bold mb-8 text-blue-400"><i class="fas fa-shuttlecock"></i> ADMIN CF</h2>
        <nav class="space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block p-3 hover:bg-gray-800 rounded"><i class="fas fa-chart-line mr-2"></i> Thống kê</a>
            <a href="{{ route('admin.products.index') }}" class="block p-3 hover:bg-gray-800 rounded"><i class="fas fa-box mr-2"></i> Sản phẩm</a>
            <a href="{{ route('admin.orders') }}" class="block p-3 hover:bg-gray-800 rounded"><i class="fas fa-shopping-cart mr-2"></i> Đơn hàng</a>
            <a href="{{ route('admin.users') }}" class="block p-3 hover:bg-gray-800 rounded"><i class="fas fa-users mr-2"></i> Khách hàng</a>
            <a href="/" class="block p-3 text-gray-400 hover:text-white mt-10"><i class="fas fa-external-link-alt mr-2"></i> Xem Website</a>
        </nav>
    </aside>

    <main class="flex-1 p-8">
        @yield('content')
    </main>
</body>
</html>