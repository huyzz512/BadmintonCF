<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\AuthController;

// --- 1. NHÓM CÔNG KHAI (Ai cũng vào được) ---
Route::get('/', [HomeController::class, 'index']);
Route::get('/san-pham/{slug}', [HomeController::class, 'show'])->name('product.detail');
Route::get('/danh-muc/{slug}', [HomeController::class, 'category'])->name('category.show');
Route::get('/tim-kiem', [HomeController::class, 'search'])->name('search');

// [ĐÃ FIX] Nhóm Route Giỏ hàng (Tách ra cho dễ nhìn)
Route::get('/gio-hang', [CartController::class, 'index'])->name('cart.index');
Route::match(['get', 'post'], '/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');


// --- 2. NHÓM XÁC THỰC (Đăng nhập, Đăng ký) ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// --- 3. NHÓM THANH TOÁN (Chỉ dành cho người đã đăng nhập) ---
Route::middleware(['auth'])->group(function () {
    Route::get('/thanh-toan', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/dat-hang', [OrderController::class, 'store'])->name('order.store');
    Route::get('/don-hang-cua-toi', [OrderController::class, 'myOrders'])->name('orders.my');
});


// --- 4. NHÓM QUẢN TRỊ (Chỉ dành cho ADMIN) ---
Route::middleware(['is_admin'])->prefix('admin')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Quản lý Đơn hàng
    Route::get('/orders', [AdminController::class, 'index'])->name('admin.orders');
    Route::get('/orders/update/{id}/{status}', [AdminController::class, 'updateStatus'])->name('admin.orders.update');
    Route::get('/orders/delete/{id}', [AdminController::class, 'destroy'])->name('admin.orders.delete');

    // Quản lý Khách hàng
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/users/update-role/{id}', [AdminController::class, 'updateRole'])->name('admin.users.updateRole');

    // Quản lý Sản phẩm (CRUD)
    Route::get('/products', [AdminProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products/store', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/delete/{id}', [AdminProductController::class, 'destroy'])->name('admin.products.delete');
});