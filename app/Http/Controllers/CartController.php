<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // 1. Hiển thị trang giỏ hàng
    public function index()
    {
        $cart = session()->get('cart', []);
        
        // Đảm bảo file view của sếp tên đúng là cart.blade.php
        return view('cart', compact('cart')); 
    }

    // 2. Thêm sản phẩm vào giỏ (Đã fix lỗi không nhận dữ liệu)
    public function add(Request $request, $id)
    {
        // Lấy thông tin sản phẩm và ảnh chính
        $product = Product::with('primaryImage')->findOrFail($id);
        
        // Lấy giỏ hàng hiện tại (nếu chưa có tạo mảng rỗng)
        $cart = session()->get('cart', []);

        // Lấy số lượng từ Form gửi lên, nếu không có thì mặc định là 1
        $quantity = $request->input('quantity', 1);

        // Kiểm tra xem sản phẩm đã có trong giỏ chưa
        if (isset($cart[$id])) {
            // Có rồi thì cộng dồn số lượng mới vào
            $cart[$id]['quantity'] += $quantity;
        } else {
            // Chưa có thì tạo mới mảng thông tin chuẩn để view cart.blade.php có thể đọc được
            $cart[$id] = [
                "name" => $product->product_name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->primaryImage->image_url ?? '/img/default-product.jpg'
            ];
        }

        // Lưu ngược lại vào Session
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Đã thêm bảo kiếm vào giỏ hàng!');
    }

    // 3. Cập nhật số lượng ngay trong giỏ hàng
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            // Ép kiểu về số nguyên và không cho phép số lượng dưới 1
            $quantity = max(1, intval($request->quantity));
            $cart[$id]['quantity'] = $quantity;
            
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Đã cập nhật số lượng!');
    }

    // 4. Xóa sản phẩm khỏi giỏ
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ!');
    }
}