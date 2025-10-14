@extends('layouts.appp')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
<style>
    .red {
        color: red;
    }

    .error {
        color: red;
    }

    .alert-danger {
        background-color: red !important;
    }

    .exhebSuccessMsg {
        display: none;
        color: green;
        font-weight: bold;
    }

.iti {
    width: 100%;
    display: block;
}

.iti__country-list {
    left: 0;
}

.select2-container {
    direction: rtl;
}

.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #ced4da;
    border-radius: 4px;
    height: 40px;
}

.iti__country-list {
    text-align: right;
}

.select2-container--default .select2-results>.select2-results__options {
    text-align: right;
}
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header text-center">
                    <h4>نموذج تسجيل جديد</h4>
                </div>
                <div class="card-body">
                    @if(Session::has('msg'))
                    <p style="background: #2cc52c;color: #fff;padding: 0 1rem;" class="alert alert-succrdd">{{
                        Session::get('msg') }}</p>
                    @endif
                    <form method="POST" id="addNewVisitor" enctype="multipart/form-data"
                        action="{{ url()->current() }}">
                        @csrf
                        <div>

                            {{--<div class="text-center m-2">--}}
                                {{--<span class='text-danger text-center'>يرجى تعبئة كافة الحقول</span>--}}
                                {{--</div>--}}
                            {{-- <h2> {{ __('userInfo.wizard.basic_info') }} </h2>--}}
                            @if ($errors->any())

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div class="d-flex align-items-center justify-content-start">
                                            <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                                            <ul>
                                                @foreach ($errors->all() as $key => $error)
                                                <h6 class="text-dark"> {!!($key+1) .": ". $error !!}</h6>
                                                @endforeach
                                            </ul>
                                        </div><!-- d-flex -->
                                    </div><!-- alert -->
                                </div>
                            </div>

                            @endif
                            <div id="form-step-1" role="form" data-toggle="validator">

                                <div class="mb-1">
                                    <h5> الاسم الأول </h5>
                                    <input type="text" id="first_name" name="first_name"
                                        value="{{old('first_name') ?? ''}}" class="form-control" />
                                </div>
                                <div class="mb-1">
                                    <h5> الاسم الأخير</h5>
                                    <input type="text" id="last_name" name="last_name"
                                        value="{{old('last_name') ?? ''}}" class="form-control" />
                                </div>

                                <div class="mb-1">
                                    <h5> {{__('auth.mobile')}}</h5>

                                    <input type="number" maxlength="9" id="mobile" value="{{old('mobile') ?? ''}}"
                                        name="mobile" class="form-control" />
                                    <p id="output"></p>

                                </div>

                                <div class="mb-1">
                                    <h5>البريد الالكتروني </h5>
                                    <input type="email" id="email" value="{{old('email') ?? ''}}" name="email"
                                        class="form-control" />
                                </div>

                                <div class="mb-1">
                                    <h5>المنطقة </h5>
                                    {{-- <input type="text" id="city" value="{{old('city') ?? ''}}" --}} {{--
                                        name="city" class="form-control" />--}}
                                    <select type="text" id="city" class="form-control select2" name="city">
                                        <option value="">--اختر--</option>
                                        @foreach($cities as $city)
                                        <option value="{{$city['name_ar']}}" {{old('city')==$city['name_ar']
                                            ? 'selected' : '' }}>{{$city['name_ar']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-1">
                                    <h5>الجنس </h5>
                                    <select type="text" id="gender" class="form-control" name="gender">
                                        <option value="">--اختر--</option>
                                        <option value="ذكر" {{old('gender')=='ذكر' ? 'selected' : '' }}>ذكر</option>
                                        <option value="أنثى" {{old('gender')=='أنثى' ? 'selected' : '' }}>أنثى</option>
                                    </select>
                                </div>

                                <div class="mb-1">
                                    <h5>المهنة </h5>
                                    <select type="text" id="job" class="form-control" name="job">
                                        <option value="">--اختر--</option>
                                        <option value="طالب" {{old('job')=='طالب' ? 'selected' : '' }}>طالب</option>
                                        <option value="موظف" {{old('job')=='موظف' ? 'selected' : '' }}>موظف</option>
                                        <option value="باحث عن عمل" {{old('job')=='باحث عن عمل' ? 'selected' : '' }}>
                                            باحث عن عمل</option>
                                    </select>
                                </div>

                                <div class="mb-3 job-divs" style="display: none;">
                                    <h5>المسمى الوظيفي </h5>
                                    <select type="text" id="position" class="form-control" name="position">
                                        <option value="">--اختر--</option>
                                        <option value="رئيس مجلس إدارة" {{old('position')=='رئيس مجلس إدارة'
                                            ? 'selected' : '' }}>رئيس مجلس إدارة </option>
                                        <option value="رئيس تنفيذي" {{old('position')=='رئيس تنفيذي' ? 'selected' : ''
                                            }}>رئيس تنفيذي</option>
                                        <option value="مدير عام" {{old('position')=='مدير عام' ? 'selected' : '' }}>مدير
                                            عام</option>
                                        <option value="مدير إدارة" {{old('position')=='مدير إدارة' ? 'selected' : '' }}>
                                            مدير إدارة</option>
                                        <option value="الوطائف التخصصية" {{old('position')=='الوطائف التخصصية'
                                            ? 'selected' : '' }}>الوطائف التخصصية</option>
                                        <option value="الوظائف الإدارية" {{old('position')=='الوظائف الإدارية'
                                            ? 'selected' : '' }}>الوظائف الإدارية</option>
                                        <option value="وطائف أخرى" {{old('position')=='وطائف أخرى' ? 'selected' : '' }}>
                                            وطائف أخرى</option>
                                    </select>
                                </div>

                                <div class="mb-3 others-divs" style="display: none;">
                                    <h5>أدخل المسمى الوظيفي </h5>
                                    <input type="text" id="others" value="{{old('others') ?? ''}}" name="others"
                                        class="form-control" />
                                </div>

                                <div class="mb-3 job-divs" style="display: none;">
                                    <h5>جهة العمل </h5>
                                    <input type="text" id="side" value="{{old('side') ?? ''}}" name="side"
                                        class="form-control" />
                                </div>

                                <div class="mb-1">
                                    <h5>نوع الحضور </h5>
                                    <select type="text" id="registration_type" class="form-control"
                                        name="registration_type">
                                        <option value="1" {{old('registration_type')=='1' ? 'selected' : '' }}>التسجيل
                                            في الحفل الرئيسي</option>
                                        <option value="2" {{old('registration_type')=='2' ? 'selected' : '' }}>التسجيل
                                            في الحفل الرئيسي وورش العمل التدريبية</option>
                                        <option value="3" {{old('registration_type')=='3' ? 'selected' : '' }}>التسجيل
                                            في ورش العمل التدريبية</option>
                                    </select>
                                </div>

                                <div class="col-md-12 div2">
                                    <div id="work-shops"
                                        style="display: {{old('registration_type') ? (old('registration_type') == '1' ? 'none' : 'block') : 'none'}};">
                                        @foreach($workshopsGroup as $workshopStages => $workshops)
                                        <div class="form-group">
                                            <h5 class="mb-1 mt-3">
                                                الرجاء تحديد الورشة المراد التسجيل فيها حضوريا بـ
                                                {{\App\Models\Workshop::$stages_name[$workshopStages]}}
                                            </h5>
                                            <div class="check-gender check-habits">
                                                @foreach($workshops as $workshop)
                                                @php
                                                    $active = App\Models\WorkShopRegisteredMember::where('workshop_id',$workshop->id)->get()->count() < $workshop->max_count;
                                                @endphp
                                                <div class="form-check">
                                                    @if ($active)
                                                    <input type="checkbox" class="form-check-input"
                                                        value="{{$workshop->id}}" {{old('workshop') ?
                                                        (in_array($workshop->id,old('workshop')) ? 'checked' : '') :
                                                    ''}}
                                                    name="workshop[]" id="go{{$workshop->id}}">
                                                    @endif
                                                    <label class="form-check-label"
                                                        style="text-decoration: {{ $active ? 'none' : 'line-through' }};"
                                                        for="go{{$workshop->id}}">
                                                        {{$workshop->name .' '}}
                                                        <span
                                                            style="direction: ltr;text-align: left;display: inline-block;text-decoration: inherit;">
                                                            {{
                                                            Carbon\Carbon::createFromFormat('H:i:s',$workshop->end_time)->format('h:i
                                                            A')
                                                            .'-'.Carbon\Carbon::createFromFormat('H:i:s',$workshop->start_time)->format('h:i
                                                            A')}}
                                                        </span>
                                                        @if (!$active)
                                                        <span style="text-decoration: none;display: inline-block;padding-right: 10px;">
                                                            (نفذت المقاعد)
                                                        </span>
                                                        @endif
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>


                            </div>
                            <div id="form-step-2" role="form" data-toggle="validator">
                                <div class="form-material">

                                    <div class="form-group text-center">
                                        <input id="rb" type="submit" name="approve" value='تسجيل'
                                            class="btn btn-info pull-left ml-2">
                                        <div id="error_msg" class="alert alert-danger p-2 m-2" style="display: none">
                                        </div>

                                    </div>
                                    <span class="exhebSuccessMsg"><i class="fa fa-check"></i>
                                        تمت العملية بنجاح</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('style')

<link href="{{ asset('assets/SmartWizard/bootstrap.css')}}" rel="stylesheet" type="text/css" />
{{--
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css" rel="stylesheet"
    type="text/css" />--}}
{{--
<link href="{{ asset('assets/admin/lib/SmartWizard/dist/css/smart_wizard.css')}}" rel="stylesheet" type="text/css" />
--}}
{{--
<link href="{{ asset('assets/admin/lib/SmartWizard/dist/css/smart_wizard_theme_arrows.css')}}" rel="stylesheet"
    type="text/css" />--}}
{{--
<link href="{{ asset('assets/SmartWizard/theme_new.css')}}" rel="stylesheet" type="text/css" />--}}
<link href="{{ asset('assets/SmartWizard/theme-ar.css')}}" rel="stylesheet" type="text/css" />

@endpush

@push('script')

<script src="{{ asset('assets/SmartWizard/jquery.min.js')}}"></script>

<script src="{{ asset('assets/SmartWizard/bootstrap.js')}}"></script>
<script src="{{ asset('assets/SmartWizard/custom_js.js')}}"></script>

<script src="{{ asset('assets/SmartWizard/validator.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/admin/lib/SmartWizard/dist/js/jquery.smartWizard.js')}}"></script>
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>
<script>
    $(function () {

        $('.select2').select2()
    $('#registration_type').on('change', function () {
        if ($(this).val() != 1) {
            $('#work-shops').slideDown()
        } else {
            $('#work-shops').slideUp()
        }
    })

    $('#job').on('change', function () {
        if ($(this).val() == 'موظف') {
            $('.job-divs').slideDown()
            $('.job-divs').find('select').attr('required','required')
            $('.job-divs').find('input').attr('required','required')
        } else {
            $('.job-divs').slideUp()
            $('.job-divs').find('select').removeAttr('required','required').val('')
            $('.job-divs').find('input').removeAttr('required','required').val('')
        }
    })

    $('#position').on('change', function () {
        if ($(this).val() == 'وطائف أخرى') {
            $('.others-divs').slideDown()
            $('.others-divs').find('input').attr('required','required')
        } else {
            $('.others-divs').slideUp()
            $('.others-divs').find('input').removeAttr('required','required').val('')
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
            // $('#addNewVisitor').submit(function (e) {
            //     e.preventDefault();
            //     $('.exhebSuccessMsg').css('display','none');
            //     var url = $(this).attr('action');
            //     var data = $(this).serialize();
            //     $.ajaxSetup({
            //       headers: {
            //           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //       }
            //     });
            //     $.ajax({
            //         'url': url,
            //         'type': 'POST',
            //         'dataType': 'json',
            //          data: data,
            //         success: function (response) {
            //               if(response.code != null){
            //                   $('input').val('');
            //                   $('input#rb').val('تسجيل');
            //                   $('.exhebSuccessMsg').css('display','block');
            //                   window.open('/admin/print/printBadge/0/'+response.code,"_blank");
            //               }else{
            //                   alert('Please Try Again!');
            //               }

            //         }
            //         // ,
            //         // error: function (xhr) {
            //         //         $('h2.msg-header').text('Error');
            //         //         $('img.fit-image').css('display','none');
            //         //         $('img.fit-image.error').css('display','block');
            //         //         $('.msg-content h5').text('حدث خطأ ما');
            //         // }
            //     });

            // });

    });
</script>
<script>
    const input = document.querySelector("#mobile");
    const output = document.querySelector("#output");

    const iti = window.intlTelInput(input, {
        preferredCountries: ["sa"],
        onlyCountries: ["sa"],
        separateDialCode: true,
        nationalMode: true,
        hiddenInput: "full",
        utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
    });

    const handleChange = () => {
        let text;
        if (input.value) {
            if (iti.isValidNumber()) {
                text = ''
                $('#reg-btn').removeAttr('disabled')
            }else {
                text = "الرقم غير صالح - يرجى ادخال رقم صحيح";
                $('#reg-btn').attr('disabled','disabled')
            }
            // text = iti.isValidNumber()
            //     ? "الرقم صحيح : " + iti.getNumber()
            //     : "الرقم غير صالح - يرجى ادخال رقم صحيح";
        } else {
            text = "";
            $('#reg-btn').removeAttr('disabled')
        }
        const textNode = document.createTextNode(text);
        output.innerHTML = "";
        output.appendChild(textNode);
    };

    // listen to "keyup", but also "change" to update when the user selects a country
    input.addEventListener('change', handleChange);
    input.addEventListener('keyup', handleChange);

    // var phone_number = window.intlTelInput(document.querySelector("#mobile"), {
    //     separateDialCode: true,
    //     preferredCountries: ["sa"],
    //     hiddenInput: "full",
    //     utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
    // });
    // $('#selectpicker').selectpicker();
    // $('.filter-option-inner-inner').text('قم باختيار واحدة أو أكثر');
    //
    // $('#mobile').keypress(function (e) {
    //     var mobile = $(this).val();
    //     if (mobile.length == 9) {
    //         e.preventDefault();
    //     }
    // });
</script>
@endpush

@endsection
