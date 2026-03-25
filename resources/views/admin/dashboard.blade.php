@extends('admin.layout')

@section('content')
<h1 class="text-3xl font-bold mb-8 text-gray-800">Tổng quan hệ thống</h1>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500">
        <p class="text-gray-500 uppercase text-xs font-bold">Doanh thu (Hoàn thành)</p>
        <p class="text-2xl font-bold text-gray-800">{{ number_format($total_revenue, 0, ',', '.') }} ₫</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
        <p class="text-gray-500 uppercase text-xs font-bold">Tổng đơn hàng</p>
        <p class="text-2xl font-bold text-gray-800">{{ $total_orders }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-yellow-500">
        <p class="text-gray-500 uppercase text-xs font-bold">Sản phẩm trong kho</p>
        <p class="text-2xl font-bold text-gray-800">{{ $total_products }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-purple-500">
        <p class="text-gray-500 uppercase text-xs font-bold">Khách hàng</p>
        <p class="text-2xl font-bold text-gray-800">{{ $total_users }}</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-gray-800 italic">Doanh thu 7 ngày gần nhất</h3>
                <span class="text-xs text-gray-400 font-medium">Đơn vị: VNĐ</span>
            </div>
            <canvas id="revenueChart" style="min-height: 300px;"></canvas>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-gray-800 mb-6 italic">Ghi chú nhanh</h3>
            <div class="space-y-4">
                <div class="p-4 bg-blue-50 rounded-2xl border border-blue-100">
                    <p class="text-xs text-blue-600 font-bold uppercase tracking-widest">Mẹo:</p>
                    <p class="text-sm text-blue-900 mt-1">Đừng quên kiểm tra các đơn hàng đang "Pending" để duyệt sớm cho khách nhé! 🏸</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctx, {
            type: 'line', 
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Doanh thu',
                    data: {!! json_encode($totals) !!}, 
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, 0.1)',
                    borderWidth: 3,
                    tension: 0.4, 
                    fill: true,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#2563eb',
                    pointBorderWidth: 2,
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { display: false }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    </script>
@endsection