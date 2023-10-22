<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CARD</title>

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css2?family=Edu+NSW+ACT+Foundation&family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <!-- Styles -->
    <style>
        html, body {
            color: #000000;
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            width: 450px;
        }

        .wrap{
            margin: 0;
        }

        .content {
            text-align: center;
            position: relative;
        }

        .flex{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .header h1{
            padding-top: 20px;
            line-height: 0px;
            font-weight: bold;
            color: #fff;
            font-size: 1.25rem;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .header h4{
            font-family: 'Open Sans', sans-serif;
            line-height: 0px;
            font-weight: bold;
            font-size: 0.75rem;
        }


        .logo img {
            width: 40px;
        }
        .p-3 {

        }

        .alamat{
            font-family: 'Open Sans', sans-serif;
            position: relative;
            color: #ffffff;
            background: #1a2238;
            height: 170px;
        }
        .photo-profile{
            height: 480px;
        }

        .photo-profile img {
            margin-top: 120px;
            width: 136px;
            height: 180px;
        }

        .text-right {
            text-align: right;
            z-index: 100;
            position: absolute;
            right: 25px;
            top: -6px;
        }

        .org{
            font-size: 38px;
            font-weight: bold;
            line-height: 4rem;
        }

        .img-wave img{
            width: 450px;
            z-index: 12;
            position: absolute;
            left: 0;
            top: -66px;
        }

        .logo{
            text-align: right;
            padding-right: 20px;
            padding-top: 20px;
        }

        .address{
            font-size: 12px;
            font-weight: bold;
        }

        .address-kl{
            font-size: 12px;
        }

        .header{

        }

    </style>
</head>
<body  style="background: {{$card->warna != null ? $card->warna : '#595959'}}">
<div class="wrap">
    <div class="content">
        <div class="header flex p-3">
{{--            <div class="logo">--}}
{{--                <img src="{{url("/storage/" . $card->logo_organisasi)}}" alt="logo organisasi">--}}
{{--            </div>--}}
                <h1>
                    {{$card->nama_organisasi}}
                </h1>
                <h4>
                    {{$card->slogan_organisasi}}
                </h4>

        </div>

        <div class="photo-profile">
            @if($card->photo != null)
                <img src="{{ public_path('/storage/' . $card->photo) }}" alt="photo profile" width="250">
            @endif
        </div>

        <div class="alamat">
            <div class="img-wave">
                <img src="{{ public_path('/storage/wave.png') }}" alt="wave">
            </div>
            <div class="text-right">
                <div class="org">
                    {{$card->name}}
                </div>
                <div class="address">
                    {{$card->id_card}}
                </div>
                <div class="address-kl">
                    Kab/Kota: {{$card->kode_kabupaten != null ? get_nama_wilayah($card->kode_kabupaten) : null}}
                </div>
{{--                <div class="address-kl">--}}
{{--                    Kecamatan: {{$card->kode_kecamatan != null ? get_nama_wilayah($card->kode_kecamatan) : null}}--}}
{{--                </div>--}}
{{--                <div class="address-kl">--}}
{{--                    Gampong: {{$card->kode_desa != null ? get_nama_wilayah($card->kode_desa) : null}}--}}
{{--                </div>--}}
            </div>
        </div>

    </div>
</div>
</body>
</html>
