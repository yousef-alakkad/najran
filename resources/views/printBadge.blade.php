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
    </style>
</head>

<body style="padding:0; margin:0; direction:ltr">


<div id="bodyy"  style="height:12.5cm;width:9cm;margin:auto;">

    @if($withImage == 1)
    <div style="position:absolute; width:9cm;text-align:center; top:0cm;height: 12.5cm">
        <img src="{{ asset('public/assets/images/'.$member->badge_image) }}"  style="height:12.5cm;width:9cm;"/>
    </div>
    @endif

    <div  style="position:absolute; width:9cm;text-align:center; top:4.0cm;">
        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($member->qrcode , 'QRCODE')}}" alt="barcode" width="90px;"/>
    </div>
    <br>
        <div  style="line-height:18px; position:absolute; width:9cm;text-align:center; top:6.5cm; color:#000; font-size:12pt;font-weight: bold">
            {{$member->qrcode}}
        </div>
        <div  style="line-height:25px; position:absolute; width:9cm;text-align:center; top:6.9cm; color:#000; font-size:14pt;font-weight: bold">
            {{$member->full_name}}
        </div>
        @if($member->job == 'موظف')
            <div  style="line-height:1.4; position:absolute; width:9cm;text-align:center; top:7.6cm; color:#000; font-size:11pt;font-weight: bold">
                {{$member->position != 'وطائف أخرى' ? $member->position : $member->others}}
                <br>
                {{$member->side}}
            </div>
        @else
            <div  style="line-height:1.4; position:absolute; width:9cm;text-align:center; top:7.6cm; color:#000; font-size:11pt;font-weight: bold">
                {{$member->job}}
            </div>
        @endif
        <div  style="line-height:18px; position:absolute; width:9cm;text-align:center; top:8.6cm; color:#000;direction: rtl;  font-size:11pt;font-weight: bold">
            <a href="https://maps.app.goo.gl/W1Duc4HJXX1tYjzK7" style="text-decoration: none;color: #000;line-height: 1.5" target="_blank">
                مركز الأمير سلطان الحضاري بمدينة نجران
                <br>
                3 نوفمبر 2024
            </a>
        </div>

</div>
</body>

<script>
    window.print();
</script>

</html>

