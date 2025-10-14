<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wad</title>
    <style>

        @font-face {
            font-family: hrsd;
            src: url({{url('public/fonts/HRSD-Regular.ttf')}});
        }
        * {
            font-family: "hrsd";
            font-size: 18px;
        }
    </style>
</head>

<body style="background-color: #1d848f; margin: 0 !important; padding: 0 !important;direction: ltr;">

<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td bgcolor="#1d848f" align="center">
            <table border="0" cellpadding="0" cellspacing="0" width="480">
                <tr>
                    <td align="center" valign="top" style="padding: 40px 10px 40px 10px;">
                        <div
                            style="display: block;background-color: #fff; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 30px;font-weight: bold;border-radius: 5px;padding: 20px;"
                            border="0">
                            <div class="text-center logo-group">
                                <img src="{{asset('public/assets/images/logo.png')}}" height="82"
                                     alt="logo">
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#f4f4f4" align="left" valign="top">
            <div
                style="font-family: Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;
                min-width: 320px;
                padding: 20px;
                margin: 20px auto;
                background-color: #fff;
                max-width: 430px;
                ">

                <div style="font-size: 18px; color:#000; margin:8px 0 0;font-weight:bold;text-align:right">
                        <h4>
                            شكرا لتسجيلك بالورش التدريبية بملتقى المهارات والتدريب "وعد" بمنطقة نجران للتعديل
                        </h4>
                </div>

                <br>
                <br>
                <div style="text-align: center">
                    <a href="{{url('/edit-registration' . '/' . $member->code)}}" class="btn btn-secondary" style="
                            background-color: #56af78;
                            border-color: #56af78;
                            color: #fff;
                            padding: 9px 14px;
                            border-radius: 10px;
                            text-decoration: none;
                            font-size: 15px;">
                        اضغط هنا
                    </a>

                </div>
                <br>


            </div>
        </td>
    </tr>
</table>

</body>

</html>
