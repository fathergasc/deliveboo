<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order received notification</title>
</head>
<body>
    <h1>Dear customer, your order has been received by the restaurant "{{ $restaurant }}"!</h1>
    <p>Your order total is: ${{ $order->total_price }}</p>
    <p>It will be delivered to you as soon as possible.</p>
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

