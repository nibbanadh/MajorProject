<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    @php
    $user = Auth::user()->name;
    @endphp
    <div>
        <b>Dear, {{ $user }}</b>
        <br>
        <p> Your order has been successfully done. We will review your order as soon as possible and Please keep on viewing your order status.</p>
        <p>Following are your order details:</p>
        <br>
        <ul style="list-style-type: none;">
            <li> Payment ID: {{ $data['payment_id'] }}</li>
            <li> Total Amount: Rs. {{ $data['total'] }}</li>
            <li> Payment Type: {{ $data['payment_type'] }}</li>
            <li> Status Code: {{ $data['status_code'] }}</li>
        </ul>
        <h3>You can track your order using this code (<span style="color:#008bef">{{ $data['status_code'] }}</span>).</h3>
        <div>
            <div style="width: 15%; margin: 0 auto;">
                <button style="width:100%; height:40px; border: 0 none; border-radius:8px; font-size:1rem;background-color: #008bef; color:white;">
                    <a href="{{env('APP_URL', null)}}#exampleModal" style="color:white; text-decoration: none;">Track Now</a>
                </button>
            </div>
        </div>
        <br>
        <p>Thank's for your purchase.</p><br>

        <strong>Have a Good Day.</strong>
        <b><br>OnNepa<br>Contact: 111232123<br>Address: Mid-Baneshwor, Kathmandu</b>
    </div>

</body>

</html>