<?php

namespace App\Http\Controllers;

use App\Helpers\WhatsappHelper;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Remittance;
use App\Models\member;
use App\Models\Workshop;
use App\Models\WorkShopRegisteredMember;
use Illuminate\Support\Facades\Validator;
use Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Session;
use Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MemberController extends Controller
{

    public function saveMedicalData(Request $request)
    {
        $checkMail = member::where('email',$request->email)->first();

        if($checkMail)
            return redirect()->back()->with('error','البريد الالكتروني مسجل مسبقاً!')->withInput();

        $validator = Validator::make($request->all(),[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:members|email',
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

        $data = array('memberEmail' => $request->email, 'link' => $link, 'member' => $member);

        // Mail::send('email.qrcode', $data, function ($m) use ($data) {
        //     $m->to($data['memberEmail'])->subject(' ملتقى المهارات والتدريب "وعد" بمنطقة نجران');
        // });

        // $text = ' شكرا لتسجيلك بملتقى المهارات والتدريب "وعد" بمنطقة نجران';
        // $text.=' \n \n';
        // $text.='رابط البادج :';
        // $text.=' \n \n';
        // $text.= $link;

        // WhatsappHelper::sendMessage($member->mobile,$text);

        return redirect()->to('/badge' . '/' . $member->code);
    }

    public function saveCompanyData(Request $request)
    {
        /* $checkMail = member::where('email',$request->email)->first();

         if($checkMail)
             return '<p style="font-size:4vw;color:red;width:100%;margin: 5rem auto;text-align:center">البريد الالكتروني مستخدم من قبل شخص آخر</p>';
         */
        $member = member::where('type', 2)->where('email', $request->email)->first();
        if ($member) {

            return response()->json([
                'status' => -1,
                'msg' => 'البريد الالكتروني مستخدم سابقا'
            ]);
        }
        $code = Str::random(40);

        $member = member::create([
            'name' => $request->name . ' ' . $request->l_name,
            'company' => $request->company_name,
            'position' => $request->position,
            'lang' => $request->lang,
            'mobile' => $request->mobile,
            'email' => ($request->email != null) ? $request->email : '',
            'side' => '-',
            'howYouKnow' => '-',
            'code' => $code,
            'type' => 2,
            'favourite_day' => '-',
            'qrcode' => random_int(100000, 999999),
        ]);

        $link = url('/badge' . '/' . $member->code);

        $data = array('memberEmail' => $request->email, 'link' => $link, 'name' => $member->name);
//        Mail::send('email.test', $data, function ($m) use ($data) {
//            //$m->from('register@emf5.net');
//            $m->from('Support@ralsksa.com');
//            $m->to($data['memberEmail'])->subject(' EMF Season 7 - ملتقي الطب التجميلي');
//        });


        return response()->json([
            'status' => 1,
            'link' => '/badge' . '/' . $member->code
        ]);


    }

    public function save(Request $request)
    {
        $checkMail = member::where('email',$request->email)->first();

        if($checkMail)
            return redirect()->back()->with('error','البريد الالكتروني مسجل مسبقاً!')->withInput();

        $code = Str::random(40);

        if ($request->howYouKnow) {
            $howYouKnow = $request->howYouKnow;
        } else {
            $howYouKnow = $request->howYouKnowOther;
        }

        $member = member::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'side' => $request->side,
            'howYouKnow' => $howYouKnow,
            'code' => $code,
            'type' => 1,
            'favourite_day' => $request->favourite_day,
            'qrcode' => random_int(100000, 999999),
        ]);
        $workshops = $request->workshops;
        $member->work_shops()->sync($workshops);

        $link = url('/badge' . '/' . $member->code);

        $data = array('memberEmail' => $request->email, 'link' => $link);


//        Mail::send('email.welcome', $data, function ($m) use ($data) {
//            //$m->from('register@emf5.net');
//            $m->from('Support@ralsksa.com');
//            $m->to($data['memberEmail'])->subject(' EMF Season 7 - ملتقي الطب التجميلي');
//        });

        if ($member)
            return response()->json(['code' => $code]);
        else
            return 400;


    }

    public function bankDetailsView($code)
    {
        $code = member::where('code', $code)->first();
        if ($code)
            return view('bankDetails', compact('code'));
        else
            return 'This Link Unavailable';
    }

    public function savebankDetailsView(Request $request, $code)
    {
        $code = member::where('code', $code)->first();
        $fileName = null;
        if ($request->file('remittanceFile')) {
            $file = $request->file('remittanceFile');
            $fileName = Str::random(7) . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put('remittances/' . $fileName, file_get_contents($file));
        }

        Remittance::create([
            'memeber_id' => $code->id,
            'money' => $request->money,
            'sender' => $request->sender,
            'datee' => $request->datee,
            'bank' => $request->bank,
            'remittanceFile' => $fileName
        ]);

        return view('success');
    }

    public function badgeView($code)
    {
        $member = member::where('code', $code)->first();
        if ($member)
            return view('badge', compact('member'));
        else
            return 'This Link Unavailable';
    }

    public function download_pdf($code)
    {
        try {

            $member = member::where('code', $code)->first();


            $pdf = PDF::loadView('badge', ['member' => $member]);
            return $pdf->download('invitation' . '_' . $member->name . '.pdf');
        } catch (Exception $ex) {
            return Errors::catchErrorAdmin($ex);
        }
    }

    public function registrationView()
    {
        $workshops1 = Workshop::where('day', '2023-12-25')->get();
        $workshops2 = Workshop::where('day', '2023-12-26')->get();
        $workshops3 = Workshop::where('day', '2023-12-27')->get();
        return view('welcome', compact('workshops1', 'workshops2', 'workshops3'));
    }

    public function companyRegistrationView($lang = 'ar')
    {
        app()->setLocale($lang);
        return view('welcomeCompany', compact('lang'));
    }

    public function medicalRegistrationView($lang = 'ar')
    {
        $workshopsGroup = Workshop::where('id','>',0)->get()->groupBy('stage');
        app()->setLocale($lang);

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
            ['name_ar'=>'[جزان]'],
            ['name_ar'=>'نجران'],
            ['name_ar'=>'الباحة'],
            ['name_ar'=>'الجوف'],
        ];

        return view('welcomeMedical', compact('lang','workshopsGroup','cities'));
    }

    public function resendBadge()
    {
        $route = 'resend-badge';
        app()->setLocale('ar');
        return view('resend', compact('route'));
    }

    public function resendBadgePost(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email:rfc,dns|exists:members',
        ],[
            'email.required' => 'يرجى إدخال البريد الالكتروني',
            'email.exists' => 'لم يتم العثور على بيانات مسجلة لهذا البريد الالكتروني',
            'email.email' => 'البريد الالكتروني المدخل غير صحيح',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();


        $member = member::where('email',$request->email)->first();


        $link = url('/badge' . '/' . $member->code);

        $data = array('memberEmail' => $request->email, 'link' => $link, 'member' => $member);

        Mail::send('email.qrcode', $data, function ($m) use ($data) {
            $m->to($data['memberEmail'])->subject(' ملتقى المهارات والتدريب "وعد" بمنطقة نجران');
        });

        $text='رابط البادج :';
        $text.=' \n \n';
        $text.= $link;

        WhatsappHelper::sendMessage($member->mobile,$text);
        return redirect()->to('/badge' . '/' . $member->code);
    }

    public function editLink()
    {
        $route = 'edit-link';
        app()->setLocale('ar');
        return view('resend2', compact('route'));
    }


    public function editLinkPost(Request $request)
    {
        $member = member::where('email',$request->email)->first();

        $data = array('memberEmail' => $request->email, 'member' => $member);

        Mail::send('email.edit', $data, function ($m) use ($data) {
            $m->to($data['memberEmail'])->subject(' ملتقى المهارات والتدريب "وعد" بمنطقة نجران');
        });

        $text = 'شكرا لتسجيلك بالورش التدريبية بملتقى المهارات والتدريب "وعد" بمنطقة نجران للتعديل';
        $text.=' \n \n';
        $text.=' \n \n';
        $text.= url('/edit-registration' . '/' . $member->code);

        WhatsappHelper::sendMessage($member->mobile,$text);

        return redirect()->to('/badge' . '/' . $member->code);
    }
    public function editRegistration($code)
    {
        $member = member::where('code',$code)->first();
        if (!$member)
            abort(404);
        $memberWorkshop = $member->workshop->pluck('workshop_id')->toArray();
        $workshopsGroup = Workshop::all()->groupBy('stage');
        app()->setLocale('ar');
        if (!$member)
            abort(404);
        return view('editReg', compact('member','workshopsGroup','memberWorkshop'));
    }

    public function editRegistrationPost($code,Request $request)
    {
        $member = member::where('code',$code)->first();

        $member->update([
//            'name' => $request->name,
//            'mobile' => $request->full,
//            'city' => $request->city ,
//            'gender' => $request->gender ,
//            'job' => $request->job ,
            'registration_type' => $request->registration_type ,
        ]);

        WorkShopRegisteredMember::where('member_id',$member->id)->delete();

        if ($request->registration_type != 1){
            foreach ($request->workshop as $key => $workshop){
                WorkShopRegisteredMember::create([
                    'member_id'=>$member->id,
                    'workshop_id'=>$workshop,
                ]);
            }
        }

        $link = url('/badge' . '/' . $member->code);

        $data = array('memberEmail' => $member->email, 'link' => $link, 'member' => $member);

        Mail::send('email.qrcode', $data, function ($m) use ($data) {
            $m->to($data['memberEmail'])->subject(' ملتقى المهارات والتدريب "وعد" بمنطقة نجران');
        });

        $text = ' شكرا لتسجيلك بملتقى المهارات والتدريب "وعد" بمنطقة نجران';
        $text.=' \n \n';
        $text.='رابط البادج :';
        $text.=' \n \n';
        $text.= $link;

//        WhatsappHelper::sendMessage($member->mobile,$text);

        return redirect()->to('/badge' . '/' . $member->code);
    }

    public function checkEmail($email)
    {
        $member = member::where('email', $email)->first();
        if ($member)
            return false;
        return true;
    }

    // public function testEmail(){
    //       $data = array('memberEmail' => 'drghamdakhol@gmail.com','link' => '/testttttt','needVisa' => 0);


    //         Mail::send('email.welcome',$data,function($m) use($data){
    //              $m->from('Registration@roshandubai.com');
    //              $m->to($data['memberEmail'])->subject('HRALS EXPO 5 - ملتقي ومعرض الموارد البشرية');
    //         });
    // }
}
