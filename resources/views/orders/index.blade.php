<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Orders
        </h2>
    </x-slot>

    <div class="">
        <div class="mx-auto">
            @if ($orders->isEmpty())
                <p>You have no orders yet.</p>
            @else
                <table class="table-auto w-full border-collapse border-gray-300">
                    <thead class="font-semibold text-left">
                        <tr class="bg-white">
                            <th class="border border-gray-100 px-4 py-2"></th>
                            <th class="border border-gray-200 px-4 py-2">Order ID</th>
                            <th class="border border-gray-300 px-4 py-2">Status</th>
                            <th class="border border-gray-300 px-4 py-2">Total Price</th>
                            <th class="border-l border-y border-gray-300 px-4 py-2">Ordered At</th>
                            <th class="border-l border-y border-gray-200 px-4 py-2">Actions</th>
                            <th class="border border-gray-100 px-4 py-2"></th>
                        </tr>
                    </thead>
                    <tbody class="font-semibold">
                        @foreach ($orders as $order)
                            <tr class="bg-gray-100">
                                <th class="border border-gray-200 px-4 py-2"></th>
                                <td class="border border-gray-300 px-4 py-2">{{ $order->id }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ ucfirst($order->status) }}</td>
                                <td class="border border-gray-300 px-4 py-2">${{ number_format($order->total_price, 2) }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $order->ordered_at->format('Y-m-d H:i') }}</td>
                                <td class="border-l border-y border-gray-300 px-4 py-2">
                                    <a href="{{ route('orders.show', $order->id) }}" class="hover:underline flex items-center gap-2">
                                        <span>View Details</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>    
                                    </a>
                                </td>
                                <th class="border border-gray-200 px-4 py-2"></th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
