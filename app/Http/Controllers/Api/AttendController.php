<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\WorkshopRegistered;
use App\Models\WorkshopAttend;
use App\Models\member;
use App\Models\Attend;
use DB;


class AttendController extends Controller
{

    public function attend(Request $request)
    {

        $registered = member::where('qrcode',$request->qrcode)->first();
        $mytime = \Carbon\Carbon::now();

        if($registered){
            if($registered->registration_type == 3)
            return response()->json(["status" => "failed", "message" => "لا يمكن الحضور غير مسجل بالحفل"], Response::HTTP_FORBIDDEN );

            $check = Attend::where('member_id',$registered->id)->where('date',$mytime->toDateString())->first();

            if($check) return response()->json(["status" => "failed", "message" => "تم التسجيل مسبقا لتاريخ اليوم"], Response::HTTP_FORBIDDEN );

            $new = Attend::create(['member_id' => $registered->id,'date' => $mytime->toDateString()]);

            if($new) return response()->json(["status" => "sucess","message" => "تمت العملية بنجاح","member" => $registered], Response::HTTP_CREATED );
            return response()->json(["status" => "failed", "message" => "حدث خطأ ما"], Response::HTTP_INTERNAL_SERVER_ERROR );
        }

        return response()->json(["status" => "failed", "message" => "الرقم غير موجود"], Response::HTTP_NOT_FOUND);
    }


    public function workshopAttend(Request $request)
    {
        $registered = member::where('qrcode',$request->qrcode)->first();

        if($registered){

            $check = DB::table('workshops_registered_members')->where('member_id',$registered->id)->where('workshop_id',$request->workshop_id)->first();

             if($check){

                $secondCheck = DB::table('attend_workshops')->where('member_id',$registered->id)->where('workshop_id',$request->workshop_id)->first();

                if(!$secondCheck){
                    $new = DB::table('attend_workshops')->insert(['member_id' => $registered->id,'workshop_id' => $request->workshop_id]);
                    if($new)
                        return response()->json(["status" => "sucess","message" => "تمت العملية بنجاح","member" => $registered], Response::HTTP_CREATED);
                }else{
                    return response()->json(["status" => "failed", "message" => "تم التسجيل مسبقاً"], Response::HTTP_INTERNAL_SERVER_ERROR);
                }


                return response()->json(["status" => "failed", "message" => "حدث خطأ ما"], Response::HTTP_INTERNAL_SERVER_ERROR);

             }else{
                 return response()->json(["status" => "failed", "message" => "غير مسجل في الورشة"], Response::HTTP_UNAUTHORIZED );
             }
        }

       return response()->json(["status" => "failed", "message" => "الرقم غير موجود"], Response::HTTP_NOT_FOUND);
    }

}
