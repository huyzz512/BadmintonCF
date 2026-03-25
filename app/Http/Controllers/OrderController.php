<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart))
            return redirect()->route('cart.index');

        return view('checkout', compact('cart'));
    }

    // Xử lý lưu đơn hàng vào Database
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'total_amount' => $total,
            'shipping_address' => $request->address,
            'phone' => $request->phone,
            'status' => 'pending',
            'payment_method' => 'COD',
        ]);

        // Lưu chi tiết từng món vào bảng order_items
        foreach ($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_variant_id' => $id,
                'quantity' => $details['quantity'],
                'unit_price' => $details['price'],
            ]);
        }

        //Xóa giỏ hàng sau khi đặt xong
        session()->forget('cart');

        return view('order.success', compact('order'));
    }



    public function myOrders()
    {
        // Lấy danh sách đơn hàng của người đang đăng nhập, đơn mới nhất lên đầu
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('order.my_orders', compact('orders'));
    }
}