<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\member;
use App\Models\Workshop;
use App\Models\Attend;
use App\Models\AttendsWorkShop;
use App\Models\WorkShopRegisteredMember;
use DB;
use DataTables;

class AttendController extends Controller
{
    public function index(){
        return view('admin.attend.index');
    }

    public function indexWorkShop(){
        $workshops = Workshop::all();
        return view('admin.attend.indexWorkShop',compact('workshops'));
    }

    public function attendAndPrintView(){
          return view('admin.attend.attendAndPrint');
    }

    public function store(Request $request){
        $memeber = member::where('qrcode',$request->qrcode)->first();
        $mytime = \Carbon\Carbon::now();

        if ($memeber->registration_type == 3)
            return -1;
        $check = Attend::where([
                ['member_id','=',$memeber->id],
                ['date','=',$mytime->toDateString()]
        ])->first();


        if($check){
            return 0;
        }

        $new = Attend::create([
            'member_id' => $memeber->id,
            'date' => $mytime->toDateString(),
        ]);

        if($new)
            return $memeber;

        return false;
    }

    public function storeWorkShop(Request $request){
        $memeber = member::where('qrcode',$request->qrcode)->first();

        if($memeber->registration_type == 1){
         return 0;
        }else{
            $check = DB::table('workshops_registered_members')->where('member_id',$memeber->id)->where('workshop_id',$request->name)->first();

            if(!$check)
                return 0;
            $date = \Carbon\Carbon::now();

            $check2 = AttendsWorkShop::where('member_id' , $memeber->id)
                ->where('workshop_id',$request->name)
                ->where('date','like', $date->format('Y-m-d').'%')->first();
//            dd($check2);

            if ($check2)
                return -1;

            $new = AttendsWorkShop::create([
                'member_id' => $memeber->id,
                'workshop_id' => $request->name,
                'date'=> \Carbon\Carbon::now()
            ]);

             if($new){
                    return $memeber;
             }else{
                    return false;
             }
        }


    }

    public function attendPerDay(){
        $workshos = Attend::select('date', DB::raw('count(*) as total'))
        ->groupBy('date')
        ->get();

        $count = Attend::count();

        return view('admin.attend.attendPerDay',compact('workshos','count'));
    }

    public function attendPerWorkShop(){
        $workshos = AttendsWorkShop::select('workshop_id', DB::raw('count(*) as total'))
        ->groupBy('workshop_id')
        ->get();

        $count = AttendsWorkShop::count();

        return view('admin.attend.attendPerWorkShop',compact('workshos','count'));
    }

    public function intersetedInWorkShop(){
        $workshos = WorkShopRegisteredMember::select('work_shop_id', DB::raw('count(*) as total'))
        ->groupBy('work_shop_id')
        ->get();

        $count = WorkShopRegisteredMember::count();

        return view('admin.attend.interestedWorkShop',compact('workshos','count'));
    }

    public function viewIntersetedInWorkShop($id){
        $results = WorkShopRegisteredMember::where('work_shop_id',$id)->get();
        $route = '/admin/getBrowseInterestedInWorkshop/'.$id;
        return view('admin.attend.browseInterstedInWorkShop',compact('results','route'));
    }

    public function storeByCode($code){
        $memeber = member::where('qrcode',$code)->first();
        $mytime = \Carbon\Carbon::now();

        $check = Attend::where('member_id',$memeber->id)->where('date',Carbon::now()->format('Y-m-d'))->first();
        if ($check)
            return response('مسجل مسبقاً لهذا اليوم',500);
        $new = Attend::create([
            'member_id' => $memeber->id,
            'date' => $mytime->toDateString(),
        ]);
        if($new)
            return true;

        return response('حدث خطأ ما!',500);
    }

    public function saveAttendAndPrint(Request $request){
        $memeber = member::where('qrcode',$request->qrcode)->first();
        $mytime = \Carbon\Carbon::now();

        if (!$memeber)
            return response('الكود غير مسجل',500);

        $check = Attend::where('member_id',$memeber->id)->where('date',Carbon::now()->format('Y-m-d'))->first();
        if ($check)
            // return response('مسجل مسبقاً لهذا اليوم',500);
            return $memeber;

        $new = Attend::create([
            'member_id' => $memeber->id,
            'date' => $mytime->toDateString(),
        ]);
        if($new)
            return $memeber;

        return response('هناك خطأ ما',500);
    }

    public function BrowseAttenders($date){
        $results = Attend::where('date',$date)->get();
        $route = '/admin/getBrowseEventAttendersData/'.$date;
        $eventDate = $date;
        return view('admin.attend.browseAttenders',compact('results','route','eventDate'));
    }

    public function BrowseWorkShopAttenders($id){
        $results = AttendsWorkShop::where('workshop_id',$id)->get();
        $route = '/admin/getBrowseWorkShopAttendersData/'.$id;
         return view('admin.attend.browseWorkShopAttenders',compact('results','route'));
    }

    public function getBrowseWorkShopAttendersData(Request $request,$id){
        if ($request->ajax()) {
            $data = AttendsWorkShop::where('workshop_id',$id)->get();
            return Datatables::of($data)
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('full_name', function($row){
                    $member = member::where('id',$row->member_id)->first();
                    return $member->full_name;
                })
                ->addColumn('email', function($row){
                    $member = member::where('id',$row->member_id)->first();
                    return $member->email;
                })
                ->addColumn('job', function($row){
                    $member = member::where('id',$row->member_id)->first();
                    return $member->job;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getEventData(Request $request,$date)
    {
        if ($request->ajax()) {
            $data = Attend::where('date',$date)->get();
            return Datatables::of($data)
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('full_name', function($row){
                    $member = member::where('id',$row->member_id)->first();
                    return $member->full_name;
                })
                ->addColumn('email', function($row){
                    $member = member::where('id',$row->member_id)->first();
                    return $member->email;
                })
                ->addColumn('job', function($row){
                    $member = member::where('id',$row->member_id)->first();
                    return $member->job;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getBrowseInterestedInWorkshop(Request $request,$id)
    {
        if ($request->ajax()) {
            $data = WorkShopRegisteredMember::where('work_shop_id',$id)->get();
            return Datatables::of($data)
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('name', function($row){
                    $member = member::where('id',$row->member_id)->first();
                    return $member->name;
                })
                ->addColumn('email', function($row){
                    $member = member::where('id',$row->member_id)->first();
                    return $member->email;
                })
                ->addColumn('side', function($row){
                    $member = member::where('id',$row->member_id)->first();
                    return $member->side;
                })
                ->addColumn('job', function($row){
                    $member = member::where('id',$row->member_id)->first();
                    return $member->job;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function destroy($id){
        $result = Attend::find($id);

        if (!$result)
            return response(['status'=>false,'message'=>'Attend not founded!'],200);
        $result->delete();
        return response(['status'=>true,'message'=>'Attend deleted successfully'],200);

    }

    public function destroyWorkshop($id){
        $result = AttendsWorkShop::find($id);

        if (!$result)
            return response(['status'=>false,'message'=>'Attend not founded!'],200);
        $result->delete();
        return response(['status'=>true,'message'=>'Attend deleted successfully'],200);

    }
}
