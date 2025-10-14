@extends('layouts.appp')
@push('css')
<style>
   h4{
      color: white;
   }
   h2{
      color: white;
   }
</style>
@endpush
@section('content')

    <div class="row ">
       <div class="col-sm-12 col-lg-4">
          <div class="card shadow-base bg-primary card-img-holder text-white">
             <div class="card-body">
                <h4 class=" mb-2 text-center">
                   عدد المسجلين
                </h4>
                <h2 class="mb-0 text-center">
                     {{ $members }}
                </h2>
             </div>
          </div>
       </div>
       <div class="col-sm-12 col-lg-4">
          <div class="card shadow-base bg-warning card-img-holder text-white">
             <div class="card-body">
                <h4 class=" mb-2 text-center">
                   عدد الورش
                </h4>
                <h2 class="mb-0 text-center">{{$workshops}}</h2>
             </div>
          </div>
       </div>
       <div class="col-sm-12 col-lg-4">
          <div class="card shadow-base bg-info card-img-holder text-white">
             <div class="card-body">
                <h4 class="mb-2 text-center">
                   عدد الحضور للمؤتمر
                </h4>
                <h2 class="mb-0 text-center">
                {{ $attends }}
                </h2>
             </div>
          </div>
       </div>
    </div>
@endsection

@push('script')

@endpush
