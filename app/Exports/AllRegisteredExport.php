<?php

namespace App\Exports;

use App\Disneyplus;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Attend;
use App\Models\member;

class AllRegisteredExport implements FromCollection , WithHeadings
{
    protected $date;

     function __construct() {

     }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $visitors = member::select('first_name','last_name','email','mobile','city',
            'gender','job','position',
            'side','others','qrcode'
        );
        if(request()->type==3){
            $visitors=$visitors->where('registration_type',3);
        }elseif(request()->type==2){
            $visitors=$visitors->where('registration_type',2);
        }else{
            $visitors=$visitors->where('registration_type',1);
        }

        return $visitors->get()->makeHidden(['full_name']);
    }

    public function headings(): array
    {
        return [
            'الاسم',
            'اللقب',
            'البريد الالكتروني',
            'رقم الجوال',
            'المدينة',
            'الجنس',
            'الوظيفة',
            'المسمى الوظيفي',
            'جهة العمل',
            'مسمى وظيفي آخر',
            'QrCode'
        ];
    }

}
