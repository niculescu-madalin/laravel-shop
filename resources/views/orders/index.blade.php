<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Orders
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($orders->isEmpty())
                <p>You have no orders yet.</p>
            @else
                <table class="table-auto w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">Order ID</th>
                            <th class="border border-gray-300 px-4 py-2">Status</th>
                            <th class="border border-gray-300 px-4 py-2">Total Price</th>
                            <th class="border border-gray-300 px-4 py-2">Ordered At</th>
                            <th class="border border-gray-300 px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $order->id }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ ucfirst($order->status) }}</td>
                                <td class="border border-gray-300 px-4 py-2">${{ number_format($order->total_price, 2) }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $order->ordered_at->format('Y-m-d H:i') }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <a href="{{ route('orders.show', $order->id) }}" class="text-blue-600 underline">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
