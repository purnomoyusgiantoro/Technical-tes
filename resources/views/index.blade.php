<!DOCTYPE html>
<html>
<head>
    <title>Daftar Order</title>
</head>
<body>
    <h1>Daftar Order</h1>
    <a href="{{ route('technical_test_orders.upload') }}">Import CSV Baru</a>
    <br><br>
    
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Order Number</th>
                <th>SKU</th>
                <th>Qty</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->sku }}</td>
                    <td>{{ $order->qty }}</td>
                    <td>{{ $order->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
