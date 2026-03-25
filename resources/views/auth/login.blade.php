<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8"><title>Đăng nhập</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Đăng Nhập</h2>
        <form action="/login" method="POST">
            @csrf
            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label>Mật khẩu</label>
                <input type="password" name="password" class="w-full border p-2 rounded" required>
            </div>
            <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">VÀO CỬA HÀNG</button>
        </form>
        <p class="mt-4 text-center text-sm">Chưa có tài khoản? <a href="/register" class="text-blue-500">Đăng ký ngay</a></p>
    </div>
</body>
</html>