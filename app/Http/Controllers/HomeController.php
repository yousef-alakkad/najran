<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\member;
use App\Models\Attend;
use App\Models\AttendsWorkShop;
use App\Models\Remittance;
use App\Models\Workshop;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use DataTables;
use Storage;
use Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FestivalExport;
use App\Exports\WorkShopExport;
use App\Exports\AllRegisteredExport;
use App\Exports\AllRegisteredExportInWorkshop;
use App\Exports\InterestedInWorkShop;
use App\Models\WorkShopRegisteredMember;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $attends = Attend::count();
        $members = member::count();
        $remittance = Remittance::count();
        $workshops = Workshop::count();
        return view('home',compact('attends','members','remittance','workshops'));
    }


    public function index2()
    {
        return view('remittance');
    }

    public function visaIndex()
    {
        return view('visa');
    }

    public function getData(Request $request)
    {
//        if ($request->ajax()) {
            $data = member::where('registration_type',1)->get();
            return Datatables::of($data)
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('workshops', function($row){
                    return $row->workshops;
                })
                ->rawColumns(['action','workshops'])
                ->make(true);
//        }
    }
    public function getData2(Request $request)
    {
//        if ($request->ajax()) {
            $data = member::where('registration_type',2)->get();
            return Datatables::of($data)
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('workshops', function($row){
                    return $row->workshops;
                })
                ->rawColumns(['action','workshops'])
                ->make(true);
//        }
    }
    public function getData3(Request $request)
    {
//        if ($request->ajax()) {
            $data = member::where('registration_type',3)->get();
            return Datatables::of($data)
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('workshops', function($row){
                    return $row->workshops;
                })
                ->rawColumns(['action','workshops'])
                ->make(true);
//        }
    }
    public function getCompanyData(Request $request)
    {
        if ($request->ajax()) {
            $data = member::where('registration_type',3)->get();
            return Datatables::of($data)
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getExhebsData(Request $request)
    {
        if ($request->ajax()) {
            $data = member::where('type',1)->get();
            return Datatables::of($data)
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getVisaMembers(Request $request)
    {
        if ($request->ajax()) {
            $data = member::where([
                ['member','=','No'],
                ['inBahreen','=','No'],
            ])->get();
            return Datatables::of($data)
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getRemittance(Request $request)
    {
        if ($request->ajax()) {
            $data = Remittance::get();
            return Datatables::of($data)
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->editColumn('memeber_id', function($q){
                   $member = member::where('id',$q->memeber_id)->first();
                   return $member->name;
                })
                ->editColumn('datee', function($q){
                $newDate = \Carbon\Carbon::createFromFormat('Y-m-d', $q->datee)->format('d/m/Y');

                return $newDate;
                })
                ->editColumn('is_accept', function($row){
                   if($row->is_accept == 0)
                     return 'لم يتم التأكيد بعد';
                   if($row->is_accept == 1)
                     return 'يحتاج الفيزا لإكمال التأكيد';

                   return 'تم التأكيد';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getAll(Request $request)
    {
        if ($request->ajax()) {
            $data = member::get();
            return Datatables::of($data)
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function destroy($id){
        $member = member::find($id);
        WorkShopRegisteredMember::where('member_id',$id)->delete();
        AttendsWorkShop::where('member_id',$id)->delete();
        Attend::where('member_id',$id)->delete();

        $member->delete();

        return true;
    }

    public function destroyRemittance($id){
        $memberRemittance = Remittance::where('id',$id)->first();
        $memberRemittance->delete();
        return true;
    }

    public function approve($id){
        $remittance = Remittance::where('id',$id)->first();
        $member = member::find($remittance->memeber_id);
        $needVisa = 0;
        if($member->member == 'No' && $member->inBahreen == 'No' ){
            $needVisa = 1;
            $remittance->update([
                'is_accept' => 1
            ]);
        }else{
            $needVisa = 2;
            $remittance->update([
                'is_accept' => 2
            ]);
        }



        $link = url('/badge'.'/'.$member->code);
        $data = array('memberEmail' => $member->email,'link' => $link,'needVisa' => $needVisa);

        Mail::send('email.confirm',$data,function($m) use($data){
            $m->from('Registration@roshandubai.com');
            $m->to($data['memberEmail'])->subject('Confirmation Email!');
        });

        return true;

    }

    public function addVisa(Request $request,$id){
        $fileName = null;
        if($request->file('visaFile')){
            $file = $request->file('visaFile');
            $fileName   = Str::random(30).'.'. $file->getClientOriginalExtension();
            Storage::disk('public')->put('Visa/'.$fileName,file_get_contents($file));
        }

        member::where('id',$id)->update([
                'visaFile' => $fileName,
                'status' => 1
        ]);

        $member = member::where('id',$id)->first();

        $link = 'https://festival-gcc.org/storage/app/public/Visa/'.$fileName;
        $data = array('memberEmail' => $member->email,'link' => $link);

        Mail::send('email.visaMail',$data,function($m) use($data){
            $m->from('Registration@roshandubai.com');
            $m->to($data['memberEmail'])->subject('Visa Confirmation Email!');
        });

        return redirect()->back();
    }

    public function allUsers(){
        $users = User::all();

        return view('admin.users.index',compact('users'));
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = User::get();
            return Datatables::of($data)
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function destroyUser($id){
        $member = User::find($id);
        WorkShopRegisteredMember::where('member_id',$id)->delete();
        Attend::where('member_id',$id)->delete();
        AttendsWorkShop::where('member_id',$id)->delete();
        $member->delete();

        return true;
    }

    public function showVisitor($id){
        $member = member::where('id',$id)->first();

        return view('admin.visitor.showVisitor',compact('member'));
    }

    public function resendVisa($id){
        $member = member::where('id',$id)->first();


        if($member->visaFile != null){
            $link = 'https://festival-gcc.org/storage/app/public/Visa/'.$member->visaFile;
            $data = array('memberEmail' => $member->email,'link' => $link);
            Mail::send('email.visaMail',$data,function($m) use($data){
                $m->from('Registration@roshandubai.com');
                $m->to($data['memberEmail'])->subject('Visa Confirmation Email!');
            });

            return true;
        }

        return false;


    }

    public function exportByDate($date){
        return Excel::download(new FestivalExport($date), 'Visitor-'.$date.'.xlsx');
    }

    public function exportByWorkShop($id){
        return Excel::download(new WorkShopExport($id), 'WorkShopVisitors--'.$id.'.xlsx');
    }

    public function exportInterestedInWorkShop($id){
        $workshop = Workshop::find( $id );
        return Excel::download(new InterestedInWorkShop($id), $workshop->name.'.xlsx');
    }

    public function exportAllRegistered(){
        return Excel::download(new AllRegisteredExport(), 'Registered.xlsx');
    }

    public function exportAllRegisteredInWorkShops(){
        return Excel::download(new AllRegisteredExportInWorkshop(), 'Registered.xlsx');
    }
}
