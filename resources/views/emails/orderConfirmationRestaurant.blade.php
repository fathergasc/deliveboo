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
            <h3>You've just received an order!</h3>
            <h4>Order:</h4>
            <ul>
                <li>Customer: {{ $order->name }}</li>
                <li>Shipping Address: {{ $order->shipping_address }}</li>
                <li>Phone: {{ $order->phone }}</li>
                <li>Email: {{ $order->email }}</li>
                <li>Total: ${{ $order->total_price }}</li>
            </ul>
            <p>Please, check your dashboard for further details.</p>
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

