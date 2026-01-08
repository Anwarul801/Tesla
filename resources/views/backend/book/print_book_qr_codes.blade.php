<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Book QR Code</title>
</head>
<body>
{{--<h3>QR Codes for: {{ $book->name }}</h3>--}}

<div style="display:flex; flex-wrap:wrap; gap:20px; margin-bottom: 50px;">
    @foreach($qrs as $qr)
        <div style="text-align:center; border:1px solid #ccc; padding:10px;">
            {!! QrCode::size(150)->generate(url('/q/'.$qr->code_id)) !!}
            <p>স্ক্যান করুন</p>
        </div>
    @endforeach
</div>

<button onclick="window.print()">Print</button>


</body>
</html>
