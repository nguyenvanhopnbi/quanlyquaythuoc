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
        <div class="my2">Ch??o b???n,</div>
        <div class="my2"></div>
        <p>{{\Auth::user()->name}} y??u c???u x??c nh???n chi ti???n k??? ?????i so??t {{$bbds_id}} cho ?????i t??c {{$partner_name}}</p>

        <div class="my1 hr"></div>
        <div class="my1" style="font-size: 20px;font-weight: 500; color: #777">Th??ng tin</div>
        <div>
            <p style="margin-bottom: 10px"><b>Partner Code: </b><span>{{$partner_code}}</span></p>
            <p style="margin-bottom: 10px"><b>Partner Name: </b><span>{{$partner_name}}</span></p>
            <p style="margin-bottom: 10px"><b>T???ng ti???n: </b><span>{{number_format($amount)}}??</span></p>
            <p style="margin-bottom: 10px"><b>K??? ?????i so??t: </b><span>{{$bbds_id}}</span></p>
            <p style="margin-bottom: 10px"><b>N???i dung: </b>
            <pre>{{$content}}</pre>
            </p>
            <p style="margin-bottom: 10px"><b>File ?????i so??t ????nh k??m: </b>
                <span>
                    <a href="{{$file_url}}">
                        {{$file_url}}
                    </a>
                </span>
            </p>
        </div>

        <div class="my1 hr"></div>
        <div class="txtGrey my1">M?? x??c th???c cho l???nh chuy???n ti???n n??y l??:</div>
        <div class="my1">
            <div
                style="font-weight: bold;font-size: 18px; border: 1px solid #ccc;padding: 8px 20px;border-radius: 10px;display: inline-block; background-color: #f5f5f5">
                {{$code ?? 123}}
            </div>
            <p style="margin-bottom: 10px">Click v??o link ????? nh???p OTP x??c nh???n y??u c???u.</p>
            <p style="margin-bottom: 10px"><a href="{{$link}}">{{$link}}</a></p>
        </div>
        <div class="my1 hr"></div>

        <div class="thankyou">
            <p class="txtGrey" style="font-size: 12px">M?? x??c th???c c?? hi???u l???c trong v??ng 60 ph??t</p>
        </div>
    </div>
</div>
</body>
