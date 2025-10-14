<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\WhatsappHelper;
use App\Http\Controllers\Controller;
use App\Models\Workshop;
use App\Models\WorkShopRegisteredMember;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\member;
use App\Models\Attend;
use Illuminate\Support\Facades\Validator;
use Str;
use Session;
use Storage;

class VisitorController extends Controller
{
    public function index(){
        $workshopsGroup = Workshop::where('id','>',0)->get()->groupBy('stage');

        $cities = [
            ['name_ar'=>'الرياض'],
            ['name_ar'=>'مكة المكرمة'],
            ['name_ar'=>'المدينة المنورة'],
            ['name_ar'=>'القصيم'],
            ['name_ar'=>'المنطقة الشرقية'],
            ['name_ar'=>'أبها'],
            ['name_ar'=>'تبوك'],
            ['name_ar'=>'حائل'],
            ['name_ar'=>'الحدود الشمالية'],
            ['name_ar'=>'نجران'],
            ['name_ar'=>'نجران'],
            ['name_ar'=>'الباحة'],
            ['name_ar'=>'الجوف'],
        ];

        return view('admin.visitor.index',compact('workshopsGroup','cities'));
    }

    public function showVisitors(){
        return view('admin.visitor.show');
    }

    public function showVisitors2(){
        return view('admin.visitor.show2');
    }

    public function showVisitors3(){
        return view('admin.visitor.show3');
    }

    public function sendReminderVisitors($type){
        $members = member::where('registration_type',$type)->where('send_email',0)->get();
        $link = '';

        foreach ($members as $member){
            $data = ['memberEmail' => $member->email, 'link' => $link, 'member' => $member];

            try {
                Mail::send('email.reminder', $data, function ($m) use ($data) {
                    $m->to($data['memberEmail'])->subject(' ملتقى المهارات والتدريب "وعد" بمنطقة نجران');
                });

                $member->update([
                   'send_email'=>1
                ]);

                $text = 'الوعد في وعد';
                $text.= ' \n \n';
                $text.= ' \n \n';
                $text.= ' ننتظركم غداً باذن الله في ملتقى المهارات والتدريب وعد بمنطقة نجران في مركز  الأمير سلطان الحضاري بنجران';
                $text.= ' \n \n';
                $text.= 'الساعه ١٠ صباحاً';
                $text.= ' \n \n';
                $text.= ' \n \n';
                $text.= 'رابط الموقع :';
                $text.=' \n \n';
                $text.= 'https://maps.app.goo.gl/gZRg9QWaAXPB7BLX6?g_st=ic';

                // WhatsappHelper::sendMessage($member->mobile,$text);
            } catch (Exception $ex) {

            }
        }

        return redirect()->back()->with('success','تم الإرسال ينجاح');
    }

    public function indexExheb(){
        return view('admin.exheb.index');
    }

    public function showExheb (){
        return view('admin.exheb.show');
    }
    public function showCompany (){
        return view('admin.visitor.show_company');
    }

    public function print(){
        return view('admin.visitor.print');
    }

    public function printBadge($withImage,$code){
        $member = member::where('code',$code)->get()->first();
        if (!$member)
            abort(404);

        return view('printBadge',["member"=>$member,"withImage"=>$withImage]);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:members|email:rfc,dns',
            'mobile' => 'required',
            'city' => 'required',
            'gender' => 'required',
            'job' => 'required',
            'position' => $request->job == 'موظف' ? 'required' : 'nullable',
            'side' => $request->job == 'موظف' ? 'required' : 'nullable',
            'registration_type' => 'required',
            'workshop' => $request->registration_type != 1 ? 'required' : 'nullable',
        ],[
            'first_name.required' => 'الاسم مطلوب',
            'last_name.required' => 'اللقب مطلوب',
            'email.required' => 'البريد الالكتروني مطلوب',
            'email.email' => 'البريد الالكتروني المدخل غير صحيح',
            'email.unique' => 'البريد الالكتروني المدخل مستخدم سابقاً',
            'mobile.required' => 'رقم الجوال مطلوب',
            'city.required' => 'المدينة مطلوب',
            'gender.required' => 'يجب تحديد الجنس',
            'job.required' => 'يجب تحديد المهنة',
            'position.required' => 'يجب تحديد المنصب الوظيفي',
            'side.required' => 'جهة العمل مطلوب',
            'registration_type.required' => 'يجب تحدي نوع الحضور',
            'workshop.required' => 'يجب تحديد دورة تدريبية واحدة على الأقل',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
//        $request->dd();
        $code = Str::random(40);

        $qrcode = member::max('qrcode');
        $member = member::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email ,
            'mobile' => $request->full ,
            'city' => $request->city ,
            'gender' => $request->gender ,
            'job' => $request->job ,
            'position' => $request->position ,
            'side' => $request->side ,
            'registration_type' => $request->registration_type ,
            'others' => $request->others ,
            'code' => $code,
            'qrcode' => $qrcode ? ($qrcode +1) : 100000,
            'system'=>1
        ]);

        if ($request->registration_type != 1){
            foreach ($request->workshop as $key => $workshop){
                WorkShopRegisteredMember::create([
                    'member_id'=>$member->id,
                    'workshop_id'=>$workshop,
                ]);
            }
        }

        $link = url('/badge' . '/' . $member->code);

        $data = ['memberEmail' => $request->email, 'link' => $link, 'member' => $member];

        Mail::send('email.qrcode', $data, function ($m) use ($data) {
            $m->to($data['memberEmail'])->subject(' ملتقى المهارات والتدريب "وعد" بمنطقة نجران');
        });

        $text = ' شكرا لتسجيلك بملتقى المهارات والتدريب "وعد" بمنطقة نجران';
        $text.=' \n \n';
        $text.='رابط البادج :';
        $text.=' \n \n';
        $text.= $link;

        WhatsappHelper::sendMessage($member->mobile,$text);

        return redirect()->back()->with('success','تم التسجيل بنجاح');
    }

    public function storeExheb(Request $request){
        $code = Str::random(40);
        $newmember = member::create([
            'name' => $request->name,
            'badgeName' => $request->name,
            'mobile' => '-',
            'email' => $code,
            'type' => $request->type,
            'badgeSide' => $request->company,
            'badgeJob' => $request->position,
            'nationality' => '-',
            'address' => $request->country,
            'howYouKnow' => '-',
            'member' => '-',
            'inBahreen' => '-',
            'code' => $code,
            'qrcode' => random_int(100000, 999999)
        ]);

        if($newmember)
            return $newmember;

        return false;
    }

}
