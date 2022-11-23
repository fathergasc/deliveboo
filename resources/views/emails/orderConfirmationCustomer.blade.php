<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order received notification</title>
</head>
<body>
    <header>DeliveBoo</header>
    <main>
        <div class="container">
            <h3>Dear {{ $order->name }}, your order has been received by "{{ $restaurant }}"!</h3>
            <p>Your order total is: ${{ $order->total_price }}</p>
            <p>It will be delivered to you as soon as possible.</p>
        </div>
    </main>

</body>
</html>

<style>

    html{
        padding:0;
        margin: 0;
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif;
        color: white;
    }
    main {
        background-color: #e4e7eb;
        color: black;
        padding-top: 2.5rem;
        display: flex;
        justify-content: center;
        height: 100vh;
        width: 100%;
        padding: 2rem
    }

    header {
        width: 100%;
        padding: 1rem;
        font-size: 3rem;
        font-style: bold;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #007bff;
    }

    ul {
        list-style: none;
        padding-left: 0;
    }

    .container {
        width: 80%;
    }
</style>

