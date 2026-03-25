<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký tài khoản</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-96 border-t-4 border-blue-600">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Tạo Tài Khoản</h2>
        
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Họ và tên</label>
                <input type="text" name="name" class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Nhập tên của bạn" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-500 outline-none" placeholder="email@example.com" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu</label>
                <input type="password" name="password" class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-500 outline-none" placeholder="••••••••" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg font-bold hover:bg-blue-700 transition duration-300">ĐĂNG KÝ NGAY</button>
        </form>
        
        <p class="mt-4 text-center text-sm text-gray-600">
            Đã có tài khoản? <a href="{{ route('login') }}" class="text-blue-500 font-bold hover:underline">Đăng nhập</a>
        </p>
    </div>
</body>
</html>