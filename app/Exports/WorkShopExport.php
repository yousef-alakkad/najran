<?php

namespace App\Exports;

use App\Disneyplus;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\AttendsWorkShop;
use App\Models\member;

class WorkShopExport implements FromCollection , WithHeadings
{
    protected $date;

     function __construct($id) {
            $this->id = $id;
     }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $attenders = AttendsWorkShop::leftJoin('members','attend_workshops.member_id','members.id')
            ->selectRaw('
                members.first_name ,
                members.last_name ,
                members.email ,
                members.job ,
                attend_workshops.date as date,
                attend_workshops.date as time
            ')
            ->where('workshop_id', $this->id)
            ->get();
//        dd($attenders);
//        $visitors = member::select('first_name','last_name','email','job','created_at as date','created_at as time')->whereIn('id', $attenders)->get()->makeHidden(['full_name']);
        $visitors = $attenders;
        foreach ($visitors as $visitor) {
            $visitor->date = Carbon::parse($visitor->date)->format('Y-m-d');
            $visitor->time = Carbon::parse($visitor->time)->addHours(3)->format('H:i');
        }


        return $visitors;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Last Name',
            'Email',
            'Job',
            'Date',
            'Time',
        ];
    }

}
