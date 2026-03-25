<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
// CẬU ĐANG THIẾU DÒNG QUAN TRỌNG NÀY:
use Illuminate\Support\Facades\Auth; 

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Kiểm tra: Đã đăng nhập CHƯA và Role có phải là ADMIN không?
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request); // Cho phép đi tiếp vào trang Admin
        }

        // Nếu không phải Admin, đá về trang chủ kèm thông báo lỗi
        return redirect('/')->with('error', 'Bạn không có quyền truy cập trang này!');
    }
}