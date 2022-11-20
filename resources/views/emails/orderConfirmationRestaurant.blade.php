<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order received notification</title>
</head>
<body>
    <h1>You've just received an order!</h1>
    <ul>
        <li>Customer: {{ $order->name }}</li>
        <li>Shipping Address: {{ $order->shipping_address }}</li>
        <li>Phone: {{ $order->phone }}</li>
        <li>Email: {{ $order->email }}</li>
        <li>Total: {{ $order->total_price }}</li>

    </ul>
    <p>Please, check your dashboard for further details.</p>
</body>
</html>

<style>
    body {
        background-color: #00c2b3;
        color: white;
        /* text-align: center; */
        padding-top: 3rem;
    }
</style>


