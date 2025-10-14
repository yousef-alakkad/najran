@extends('layouts.appp')
@section('css')
    <style>
        .red{
            color:red;
        }
        .error{
            color:red;
        }
        .alert-danger {
            background-color: red !important;
        }
    </style>
    @endsection
@section('content')
<div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-2">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <a class="btn" data-toggle="modal" data-target="#exampleModal" style="font-weight:bold;float:right;font-size:1.2rem">  جدول الورش</a>
                                <!-- Button trigger modal -->
{{--                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">--}}
{{--                                 إضافة ورشة جديدة--}}
{{--                                </button>--}}
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered yajra-datatable"  width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>التسلسل</th>
                                            <th>اسم الورشة</th>
                                            <th>المقر</th>
                                            <th>الجهة المنفذة</th>
                                            <th>من</th>
                                            <th>إلى</th>
                                            <th>عدد المسجلين الحالي</th>
                                            <th>عدد المسجلين المطلوب</th>
                                            <th>الإجراء</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

            </div>
            <!-- /.container-fluid -->

            </div>

            <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">إضافة ورشة جديدة</h5>
      </div>
      <form action="{{ url()->current() }}" method="post" id="addWorkShop">
          @csrf
          <div class="modal-body">
            <label for="name">اسم الورشة</label>
            <input type="text" dir="trl" class="form-control" name="name" id="name" required/>
            <label for="speaker">المقدم </label>
            <input type="text" dir="trl" class="form-control" name="speaker" id="speaker" required/>
            <label for="day">التاريخ </label>
            <input type="date" dir="trl" class="form-control" name="day" id="day" required/>
            <div class="row">
            <div class="input-group mb-3 col-md-6">
                <label style="width:100%">من</label>
              <div class="input-group-prepend">
                <select class="form-control" name="fromDateSelect" style="padding: 0.5rem 1rem 0.5rem 3rem;">
                    <option value="ص">
                        ص
                    </option>
                    <option value="م">
                        م
                    </option>
                </select>
              </div>
              <input type="text" class="form-control" name="startTime"  aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3 col-md-6">
                <label style="width:100%">إلى</label>
              <div class="input-group-prepend">
                <select class="form-control" name="toDateSelect" style="padding: 0.5rem 1rem 0.5rem 3rem;">
                    <option value="ص">
                        ص
                    </option>
                    <option value="م">
                        م
                    </option>
                </select>
              </div>
              <input type="text" class="form-control" name="endTime" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            </div>
            <label for="room">القاعة </label>
            <input type="text" dir="trl" class="form-control" name="room" id="room" required/>
             <label for="place">المكان </label>
            <input type="text" dir="trl" class="form-control" name="place" id="place" required/>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">إغلاق</button>
            <button type="submit" class="btn btn-primary">حفظ </button>
          </div>
      </form>
    </div>
  </div>
</div>

@push('style')

    <link href="{{ asset('assets/SmartWizard/bootstrap.css')}}" rel="stylesheet" type="text/css" />
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset('assets/admin/lib/SmartWizard/dist/css/smart_wizard.css')}}" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset('assets/admin/lib/SmartWizard/dist/css/smart_wizard_theme_arrows.css')}}" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset('assets/SmartWizard/theme_new.css')}}" rel="stylesheet" type="text/css" />--}}
    <link href="{{ asset('assets/SmartWizard/theme-ar.css')}}" rel="stylesheet" type="text/css" />

@endpush

@push('script')

    <script src="{{ asset('assets/SmartWizard/jquery.min.js')}}"></script>

    <script src="{{ asset('assets/SmartWizard/bootstrap.js')}}"></script>
    <script src="{{ asset('assets/SmartWizard/custom_js.js')}}"></script>

    <script src="{{ asset('assets/SmartWizard/validator.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/lib/SmartWizard/dist/js/jquery.smartWizard.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.js"></script>
    <script type="text/javascript">
    var serialNumber = 0;
    $(function () {

        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
        });

        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('getWorkShopData') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'stage_name', name: 'stage_name'},
                {data: 'side', name: 'side'},
                {data: 'start_time', name: 'start_time'},
                {data: 'end_time', name: 'end_time'},
                {data: 'persons_count', name: 'persons_count'},
                {data: 'max_count', name: 'max_count'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ] ,
            columnDefs: [
                {
                // For Responsive
                responsivePriority: 13,
                targets: 0
                },
                {
                    targets: 0,
                    render: function (data, type, full) {
                        return ++serialNumber;

                    }
                },
                {
                    targets: 1,
                    render: function (data, type, full) {
                        var text = full['name'];
                        if(text==null) return "-";
                        else return text;

                    }
                },
                {
                // Actions
                targets: -1,
                render: function (data, type, full, meta) {
                    var id = full['id'];
                    var persons = JSON.parse(full['persons']);
                    var value = full['name'];
                    var value1 = full['speaker'];
                    var value2 = full['day'];
                    var value3 = full['start_time']!=null?full['start_time'].replace('م', '').replace('ص', ''):'';
                    var value4 = full['end_time']!=null?full['end_time'].replace('م', '').replace('ص', ''):'';
                    var value5 = full['room'];
                    var value6 = full['place'];

                    var trPersons = '';
                    for (let index = 0; index < persons.length; index++) {
                        var element = persons[index];
                        trPersons += `
                            <tr>
                                <td>${element.id}</td>
                                <td>${element.full_name}</td>
                                <td>${element.email}</td>
                            </tr>
                        `;

                    }
                        return (

                            '<div style="display:flex">' +
                            // '<a title="حذف" style="text-align:center;margin-left:.4rem" class="btn btn-danger btn-sm" href="/deleteWorkShop/'+ id + '" id="delete_btn" class="dropdown-item"> <i class="fa fa-trash"></i></a>'+
                            // '<a title="تعديل" style="text-align:cente; margin-left:.4rem" href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateModal'+id+'"> <i class="fa fa-edit"></i></a>'+
                            '<a title="تصدير اكسلل للمسجلين" style="text-align:cente; margin-left:.4rem" href="{{ url('export-interested-in-workshop') }}/'+id+'" class="btn btn-primary btn-sm"> <i class="fa fa-download"></i></a>'+

                            '<a title="المهتمين" style="text-align:center" href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#interesting'+id+'"> <i class="fa fa-user"></i></a>'+
                            '</div>'+

                            '<div class="modal fade" id="interesting'+id+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">'+
                                '<div class="modal-dialog" role="document">'+
                                    '<div class="modal-content">'+
                                        '<div class="modal-header">'+
                                            '<h5 class="modal-title" id="exampleModalLabel">الأشخاص المهتمين بهذه الورشة</h5>'+
                                        '</div>'+
                                        '<div class="modal-body">'+
                                            `<table class="table table-bordered"  width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>الرقم التسلسلي</th>
                                                        <th>الاسم</th>
                                                        <th>البريد الإلكتروني</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    ${trPersons}
                                                </tbody>
                                            </table>`+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+


                             '<div class="modal fade" id="updateModal'+id+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">'+
                                '<div class="modal-dialog" role="document">'+
                                    '<div class="modal-content">'+
                                    '<div class="modal-header">'+
                                        '<h5 class="modal-title" id="exampleModalLabel">تعديل بيانات الورشة</h5>'+
                                    '</div>'+
                                    '<form action="/edit-workshop/'+id+'" method="post" enctype="multipart/form-data">'+
                                        '@csrf'+
                                        '{{ method_field("PUT") }}'+
                                        '<div class="modal-body">'+
                                                '<div class="row">' +
                                                    '<div class="col-md-12" style="margin-bottom:1rem">'+
                                                        '<label for="name">اسم الورشة</label>'+
                                                        '<input type="text" dir="trl" class="form-control" value="'+value+'" name="name"  required/><br>'+
                                                    '</div>'+
                                                    '<div class="col-md-12" style="margin-bottom:1rem">'+
                                                        '<label for="name">المقدم </label>'+
                                                        '<input type="text" dir="trl" class="form-control" value="'+value1+'" name="speaker"  required/><br>'+
                                                    '</div>'+
                                                    '<div class="col-md-12" style="margin-bottom:1rem">'+
                                                        '<label for="name">التاريخ </label>'+
                                                        '<input type="date" dir="trl" class="form-control" value="'+value2+'" name="day"  required/><br>'+
                                                    '</div>'+
                                                     '<div class="input-group mb-3 col-md-6">'+
                                                        '<label style="width:100%">من</label>' +
                                                      '<div class="input-group-prepend">' +
                                                        '<select class="form-control" name="fromDateSelect" style="padding: 0.5rem 1rem 0.5rem 3rem;">' +
                                                            '<option value="ص">'+
'                                                                ص'+
                                                            '</option>'+
                                                            '<option value="م">' +
                                                                'م' +
                                                            '</option>' +
                                                        '</select>' +
                                                      '</div>' +
                                                      '<input type="text" class="form-control" name="startTime" value="'+value3+'"  aria-label="Username" aria-describedby="basic-addon1">' +
                                                    '</div>' +
                                                     '<div class="input-group mb-3 col-md-6">'+
                                                        '<label style="width:100%">إلى</label>' +
                                                      '<div class="input-group-prepend">' +
                                                        '<select class="form-control" name="toDateSelect" style="padding: 0.5rem 1rem 0.5rem 3rem;">' +
                                                            '<option value="ص">'+
'                                                                ص'+
                                                            '</option>'+
                                                            '<option value="م">' +
                                                                'م' +
                                                            '</option>' +
                                                        '</select>' +
                                                      '</div>' +
                                                      '<input type="text" class="form-control" name="endTime" value="'+value4+'"   aria-label="Username" aria-describedby="basic-addon1">' +
                                                    '</div>' +
                                                    '<div class="col-md-12" style="margin-bottom:1rem">'+
                                                        '<label for="name">القاعة </label>'+
                                                        '<input type="text" dir="trl" class="form-control" value="'+value5+'" name="room"  required/><br>'+
                                                    '</div>'+
                                                    '<div class="col-md-12" style="margin-bottom:1rem">'+
                                                        '<label for="name">المكان </label>'+
                                                        '<input type="text" dir="trl" class="form-control" value="'+value6+'" name="place"  required/><br>'+
                                                    '</div>'+




                                                '</div>'+

                                        '</div>'+
                                        '<div class="modal-footer">'+
                                            '<button type="button" class="btn btn-secondary closeAdd" data-dismiss="modal">Close</button>'+
                                            '<button type="submit" class="btn btn-primary">Save </button>'+
                                       '</div>'+
                                    '</form>'+
                                    '</div>'+
                                '</div>'+
                               '</div>'
                        );
                }
                }
            ]
        });

        $(document).on('click', '#delete_btn', function (e) {
            e.preventDefault();

            var url = $(this).attr('href');
            bootbox.confirm('سيتم حذف الورشة ,هل أنت متأكد ؟', function (res) {

                if (res) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        'url': url,
                        'type': 'DELETE',
                        'dataType': 'json',
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            toastr.options = {
                                "debug": false,
                                position: { X: 'Left', Y: 'Top' },
                                "fadeIn": 300,
                                "fadeOut": 1000,
                                "timeOut": 5000,
                                "extendedTimeOut": 1000
                            }
                            table.ajax.reload();
                        },
                        error: function (xhr) {

                        }
                    });
                }

            });
        });

        $(document).on('submit', '#addWorkShop', function (e) {
            e.preventDefault();

            var url = $(this).attr('action');
            var data = $(this).serialize();
            $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
            });
            $.ajax({
                'url': url,
                'type': 'post',
                'dataType': 'json',
                data: data,
                success: function (response) {
                    toastr.success('تمت إضافة الورشة بنجاح');
                    table.ajax.reload();
                    $(".closeModal").click();
                },
                error: function (xhr) {
                    toastr.error('حدث خطأ ما');
                    $(".closeModal").click();
                }
            });

        });

        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        });

        $(document).on('submit', '#addNewLeader', function (e) {
            e.preventDefault();

            var url = $(this).attr('action');
            var name = $(this).serialize();
            $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
            });
            $.ajax({
                'url': url,
                'type': 'POST',
                'dataType': 'json',
                data: name,
                success: function (response) {
                    toastr.success('Leader added successfully');
                    table.ajax.reload();
                    $(".closeAdd").click();
                },
                error: function (xhr) {
                    toastr.error('Something went wrong !');
                    $(".closeAdd").click();
                }
            });

        });

    });
    </script>
    @endpush

@endsection
