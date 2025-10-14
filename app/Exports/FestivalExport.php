<?php

namespace App\Exports;

use App\Disneyplus;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Attend;
use App\Models\member;

class FestivalExport implements FromCollection , WithHeadings
{
    protected $date;

     function __construct($date) {
            $this->date = $date;
     }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
//        $attenders = Attend::select('member_id')->where('date', $this->date)->get();
//        $visitors = member::select('first_name','last_name','email','job','created_at as date','created_at as time')->whereIn('id', $attenders)->get()->makeHidden(['full_name']);
//        foreach ($visitors as $visitor) {
//            $visitor->date = Carbon::parse($visitor->date)->format('Y-m-d');
//            $visitor->time = Carbon::parse($visitor->time)->addHours(3)->format('H:i');
//        }
        $attenders = Attend::leftJoin('members','attends.member_id','members.id')
            ->selectRaw('
                members.first_name ,
                members.last_name ,
                members.email ,
                members.job ,
                attends.created_at as date,
                attends.created_at as time
            ')
            ->where('date', $this->date)
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
