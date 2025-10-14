<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Badge</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap');
        @media print {
            @page {
                size: 9cm 12.5cm;
                print-color-adjust: exact;
            }
            #success{
                display: none;
            }

            #bodyy{
                margin: auto;!important;
                position: inherit !important;
            }
        }
        {{--@font-face {--}}
        {{--    font-family: 'Arial';--}}
        {{--    src: url({{asset('assets/badge/Arial.ttf')}});--}}
        {{--    font-weight: normal;--}}
        {{--    font-style: normal;--}}
        {{--}--}}
        html{
            zoom: 100%;
        }
        body{
            -webkit-print-color-adjust: exact;
        }
        *{
            font-family: Cairo;
        }

        .alert-success{
            color: #3c763d;
            background-color: #dff0d8;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #d6e9c6;
            border-radius: 4px;
            position: absolute;
            z-index: 99;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
        }
        .btn,
        .btn-badge{
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            color: #fff;
            text-decoration: none;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.47rem 0.75rem;
            font-size: 0.875rem;
            border-radius: 0.25rem;
            background-color: #fd931e;
            border-color: #fd931e;
            position: absolute;
            z-index: 99;
            bottom: 0px;
            left: 50%;
            transform: translateX(-50%);
        }
        .btn-badge{
            background-color: #56af78;
            border-color: #56af78;
            bottom: 50px;
        }
    </style>
</head>

<body style="padding:0; margin:0; direction:ltr">

<div id="success">
    @if()
    <div class="alert alert-success">
        نشكرك لقيامك بعملية التسجيل وسيتم إرسال ملحقات التسجيل على البريد الإلكتروني الخاص بك
    </div>
    <button type="button" class="btn btn-badge" onclick="window.print();">
        طباعة بطاقة الحضور
    </button>
    <a href="{{url('/')}}" class="btn btn-secondary">
        العودة للصفحة الرئيسية
    </a>
</div>

<div id="bodyy"  style="height:12.5cm;width:9cm;margin:auto;margin-top: 112px;position: relative;">

    <div style="position:absolute; width:9cm;text-align:center; top:0cm;height: 12.5cm">
        <img src="{{ asset('public/badge.png') }}"  style="height:12.5cm;width:9cm;"/>
    </div>

    <div style="position:absolute; width:9cm;text-align:center; top:4.0cm;">
        <img src="{{ asset('storage/app/public/qrcode/' . $member->id . $member->qrcode . '.png') }}" alt="barcode" width="150px"/>
    </div>
     <br>
    <div  style="line-height:18px; position:absolute; width:9cm;text-align:center; top:8.1cm; color:#005d45; font-size:12pt;font-weight: bold">
        {{$member->qrcode}}
    </div>
    <div  style="line-height:25px; position:absolute; width:9cm;text-align:center; top:9.1cm; color:#005d45; font-size:14pt;font-weight: bold">
        {{$member->name}}
    </div>



</div>
</body>

{{--<script>--}}
{{--    window.print();--}}
{{--</script>--}}

</html>

