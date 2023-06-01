<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ public_path('css/laporan.css') }}">
    <script src="{{public_path('js/laporan.js')}}"></script>
    {{-- @if (request()->has('success'))
    <title>{{ request('success') }}</title>
    @endif --}}
</head>
<body>
    <div class="a4-container">
        <div class="header">
        <img src="{{public_path('img/logo.png')}}" alt="Logo" class="logo">
            <div class="header-content">
                <h2>KEMENTERIAN AGAMA</h2>
                <h2>INSTITUT AGAMA ISLAM IBRAHIMY</h2>
                <div class="contact-info">
                    <span>Jl. KH. Hasyim Asy'ari No.01, Dusun Krajan, Kembiritan Kec. Genteng, Kabupaten Banyuwangi, Jawa Timur 68465</span>
                    <span>Phone:0333-845654&nbsp;Email: admin@iaiibrahimy.ac.id</span>
                </div>
            </div>
        </div>
        <hr>