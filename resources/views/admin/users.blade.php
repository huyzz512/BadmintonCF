@extends('admin.layout')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Quản lý Người dùng</h1>
</div>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
@endif

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-4 border-b">Tên người dùng</th>
                <th class="p-4 border-b">Email</th>
                <th class="p-4 border-b">Quyền hiện tại</th>
                <th class="p-4 border-b">Thay đổi quyền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="hover:bg-gray-50 border-b">
                <td class="p-4 font-medium">{{ $user->name }}</td>
                <td class="p-4 text-sm text-gray-600">{{ $user->email }}</td>
                <td class="p-4">
                    <span class="px-2 py-1 rounded text-xs font-bold {{ $user->role == 'admin' ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600' }}">
                        {{ strtoupper($user->role) }}
                    </span>
                </td>
                <td class="p-4">
                    <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST" class="flex items-center space-x-2">
                        @csrf
                        <select name="role" class="border rounded px-2 py-1 text-sm outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        <button type="submit" class="bg-gray-800 text-white px-3 py-1 rounded text-xs hover:bg-black transition">
                            Lưu
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection