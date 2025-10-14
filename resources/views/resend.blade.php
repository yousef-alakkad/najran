<!doctype html>
<html lang="{{app()->getLocale()}}" style="direction: {{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}};">
<head>
    <meta charset="utf-8"/>
    <title>Wad</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Wad" name="description"/>
    <meta content="Themesdesign" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('public/favicon.png')}}">

    <!-- Bootstrap Css -->
    <link href="{{asset('public/assets/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="{{asset('public/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="{{asset('public/assets/css/app-rtl.min.css')}}" rel="stylesheet" type="text/css"/>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap');

        @font-face {
            font-family: hrsd;
            src: url({{url('public/fonts/HRSD-Regular.ttf')}});
        }

        * {
            font-family: "cairo";
            font-size: 18px;
        }

        body {
            color: #158285;
            height: 100% !important;
        }

        html{
            height: 100%;
        }

        .btn-primary {
            background-color: #f7941d;
            border-color: groove #f7941d;
        }

        .btn-primary:hover {
            color: #fff;
            background-color: #f7941d;
            border-color: #f7941d;
        }

        .btn-check:active + .btn-primary, .btn-check:checked + .btn-primary, .btn-primary.active, .btn-primary:active, .show > .btn-primary.dropdown-toggle {
            color: #fff;
            background-color: #f7941d;
            border-color: #f7941d;
        }

        .bg-primary {
            --bs-bg-opacity: 1;
            background-color: #1c569f !important;
        }

        a {
            color: #158285;
            text-decoration: none;
        }

        @media (max-width: 994px) {

            .logo-group {
                display: block;
            }

            .logo-group img {
                margin-bottom: 20px;
            }
        }

        .authentication-bg::before{
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-image: linear-gradient(135deg, #fe931f 0%, #56af79 51%, #1d858e 100%);
            color: white;
            opacity: 0.63;
        }
    </style>
</head>


<body class="authentication-bg bg-primary position-relative">
    <div class="home-center">
        <div class="home-desc-center">

            <div class="container">
                <div class="row justify-content-center mt-5">
                    <div class="col-md-8 col-lg-9 col-xl-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="px-2 py-3">

                                    <a href="{{url('/')}}" class="text-center d-block mx-auto">
                                        <img src="{{asset('public/assets/images/logo.png')}}" height="82"
                                             alt="logo">
                                    </a>

                                    <div class="mt-2 pt-2 ">

                                        @if(session()->has('error'))
                                            <div class="alert alert-danger p-2">
                                                {{session()->get('error')}}
                                            </div>
                                        @endif
                                        @if(session()->has('success'))
                                            <div class="alert alert-success p-2">
                                                {{session()->get('success')}}
                                            </div>
                                        @endif
                                            @if ($errors->any())
                                                <div class="alert alert-danger p-2">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                        <form class="form-horizontal mt-4 pt-2" method="post">
                                            @csrf

                                            <div class="mb-3">
                                                <h5>{{__('auth.email')}} </h5>
                                                <input type="email" id="email" value="{{old('email') ?? ''}}"
                                                       name="email" class="form-control" required
                                                       oninvalid="this.setCustomValidity('يرجى إدخال البريد الالكتروني')"
                                                       oninput="this.setCustomValidity('')"
                                                />
                                            </div>



                                            <div class="text-center mt-3">
                                                <button class="btn btn-primary waves-effect waves-light" style="background-color: #56af78;border-color: #56af78;"
                                                        type="submit">{{__('auth.reg')}}
                                                </button>
                                            </div>



                                        </form>


                                    </div>
                                </div>
                            </div>

                            <div class="mt-2 text-center text-dark" style="direction: ltr">

                                <p>©
                                    <script>document.write(new Date().getFullYear())</script>
                                     Wad.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- End Log In page -->
        </div>
    </div>


<!-- JAVASCRIPT -->
<script src="{{asset('public/assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('public/assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('public/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('public/assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<script src="{{asset('public/assets/js/app.js')}}"></script>


<script>
    $('#registration_type').on('change', function () {
        if ($(this).val() != 1) {
            $('#work-shops').slideDown()
        } else {
            $('#work-shops').slideUp()
        }
    })



    @foreach(\App\Models\Workshop::all() as $workshop)
    $('#go{{$workshop->id}}').on('change',function(){
        if($(this).is(':checked')){
            @foreach(\App\Models\Workshop::where('start_time','>=',$workshop->start_time)->where('end_time','<=',$workshop->end_time)->where('id','!=',$workshop->id)->get() as $workshopSameTime)
            $('#go{{$workshopSameTime->id}}').prop('disabled', 'disabled');
            @endforeach
        }else{
            @foreach(\App\Models\Workshop::where('start_time','>=',$workshop->start_time)->where('end_time','<=',$workshop->end_time)->where('id','!=',$workshop->id)->get() as $workshopSameTime)
            $('#go{{$workshopSameTime->id}}').removeAttr('disabled');
            @endforeach
        }
    });
    @endforeach
    @if(old('workshop'))
        @foreach(\App\Models\Workshop::whereIn('id',old('workshop'))->get() as $workshop)
        @foreach(\App\Models\Workshop::where('start_time','>=',$workshop->start_time)->where('end_time','<=',$workshop->end_time)->where('id','!=',$workshop->id)->get() as $workshopSameTime)
        $('#go{{$workshopSameTime->id}}').prop('disabled', 'disabled');
        @endforeach
        @endforeach
    @endif
</script>

<script>
    var phone_number = window.intlTelInput(document.querySelector("#mobile"), {
        separateDialCode: true,
        preferredCountries: ["sa"],
        hiddenInput: "full",
        utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
    });
    $('#selectpicker').selectpicker();
    $('.filter-option-inner-inner').text('قم باختيار واحدة أو أكثر');

    $('#mobile').keypress(function (e) {
        var mobile = $(this).val();
        if (mobile.length == 9) {
            e.preventDefault();
        }
    });
</script>
</body>

</html>
