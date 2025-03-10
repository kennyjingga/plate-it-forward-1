<body>
    

<h2 class="text-xl font-bold mb-4">Daftar Order</h2>

<table class="border-collapse w-full">
    <thead>
        <tr class="bg-gray-200">
            <th class="border p-2">ID</th>
            <th class="border p-2">Total</th>
            <th class="border p-2">Detail</th>
            <th class="border p-2">Status</th>
            <th class="border p-2">Tanggal</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($allOrders as $order)
        <tr>
            <td class="border p-2">{{ $order->id }}</td>
            <td class="border p-2">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
            <td class="border p-2">{{ $order->transaction_detail }}</td>
            <td class="border p-2">
                <select class="update-status border rounded px-2 py-1" data-order-id="{{ $order->id }}">
                    <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="Canceled" {{ $order->status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                </select>
            </td>
            <td class="border p-2">{{ $order->created_at }}</td>
        </tr>
        @endforeach

    </tbody>
</table>

</body>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('change', '.update-status', function() {
        var orderId = $(this).data('order-id');
        var newStatus = $(this).val();

        $.ajax({
            url: "{{ route('admin.tesdashboardadmin') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: orderId,
                status: newStatus
            },
            success: function(response) {
                alert(response.message);
            },
            error: function() {
                alert("Gagal mengupdate status.");
            }
        });
    });
</script>

