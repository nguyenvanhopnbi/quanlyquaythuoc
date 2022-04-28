<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta name="color-scheme" content="only">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: Roboto, Arial, sans-serif;
            color: #222;
        }

        body {
            font-size: 1rem;
        }

        body p {
            color: #222;
            font-size: 1rem;
        }

        .body {
            padding: 1rem 0;
            background-image: url("{{asset('assets/media/bg/bg_green.jpg')}}");
            background-position: bottom;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .wrapper {
            background-color: #fff;
            border-top: 3px solid #19813f;
            width: auto;
            max-width: 600px;
            margin: 0 auto;
            padding: 2rem 3rem 4rem 3rem;
        }

        h1 {
            font-weight: 600;
            font-size: 3rem;
            margin-bottom: 2.5rem;
            margin-top: 2.5rem;
            color: #44a347;
        }

        .logo {
            max-height: 80px;
        }

        .txtGrey {
            color: #777;
        }

        .txtGreen {
            color: #44a347;
        }

        .lbTitle {
            color: #777;
            margin-top: 1rem;
            margin-bottom: 1rem;
            font-size: 1rem;
            font-weight: 500;
        }

        .my1 {
            margin-top: 1.3rem;
            margin-bottom: 1.3rem
        }

        .my2 {
            margin-top: 2rem;
            margin-bottom: 2rem
        }

        .address {
            padding: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .table {
            width: 100%;
        }

        .table thead th {
            text-align: left;
        }

        .table tbody td {
            padding: 1rem 0rem;
        }

        .hr {
            height: 0.5px;
            background-color: #ccc;
        }

        .total {
            font-size: 2.2rem;
            font-weight: 600
        }

        .payContent {
            border-bottom: 1px dashed #ccc;
            padding-bottom: 0.5rem;
        }

        @media (max-width: 768px) {
            .wrapper {
                padding: 1rem 0.5rem 3rem 0.5rem;
            }

            h1 {
                font-size: 1.6rem;
            }
        }
    </style>
</head>
<body>
<div class="body">
    <div class="wrapper">
{{--        <img src="{{asset('assets/media/logos/logo_pay.png')}}" title="Appota logo" class="logo"/>--}}
        <div class="my2">Chào bạn,</div>
        <div class="my2"></div>
        <p>{{\Auth::user()->name}} đã từ chối yêu cầu chi tiền kỳ đối soát {{$bbds_id}} cho đối tác {{$partner_name}} vì {{$reason}}</p>

        <div class="my1 hr"></div>
        <div class="my1" style="font-size: 20px;font-weight: 500; color: #777">Thông tin</div>
        <div>
            <p style="margin-bottom: 10px"><b>Partner Code: </b><span>{{$partner_code}}</span></p>
            <p style="margin-bottom: 10px"><b>Partner Name: </b><span>{{$partner_name}}</span></p>
            <p style="margin-bottom: 10px"><b>Tổng tiền: </b><span>{{number_format($amount)}}đ</span></p>
            <p style="margin-bottom: 10px"><b>Kỳ đối soát: </b><span>{{$bbds_id}}</span></p>
            <p style="margin-bottom: 10px"><b>Nội dung: </b>
            <pre>{{$content}}</pre>
            </p>
            <p style="margin-bottom: 10px"><b>File đối soát đính kèm: </b>
                <span>
                    <a href="{{$file_url}}">
                        {{$file_url}}
                    </a>
                </span>
            </p>
        </div>

        <div class="my1 hr"></div>
    </div>
</div>
</body>
