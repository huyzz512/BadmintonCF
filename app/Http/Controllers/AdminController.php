<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->orderBy('id', 'desc')->get();
        return view('admin.orders', compact('orders'));
    }
    public function updateStatus($id, $status)
    {
        $order = Order::findOrFail($id);
        $order->status = $status;
        $order->save();

        return back()->with('success', 'Đã cập nhật trạng thái đơn hàng!');
    }

    public function dashboard()
    {
        $revenueData = Order::where('status', 'completed')
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_amount) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $labels = [];
        $totals = [];
        foreach ($revenueData as $data) {
            $labels[] = date('d/m', strtotime($data->date));
            $totals[] = $data->total;
        }

        $total_revenue = Order::where('status', 'completed')->sum('total_amount');
        $total_orders = Order::count();
        $total_products = Product::count();
        $total_users = User::where('role', 'customer')->count();

        return view('admin.dashboard', compact('labels', 'totals', 'total_revenue', 'total_orders', 'total_products', 'total_users'));
    }
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }
    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() == $user->id && $request->role != 'admin') {
            return back()->with('error', 'Cậu không thể tự hạ cấp chính mình đâu nhé!');
        }

        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'Đã phân quyền thành công cho ' . $user->name);
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        $order->items()->delete();

        $order->delete();

        return back()->with('success', 'Đã xóa đơn hàng #' . $id . ' thành công!');
    }
}