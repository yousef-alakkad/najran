<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['stage_name'];

    public static $stages_name = [
        1=>'بالمسرح الرئيسي ',
        2=>'بقاعة وعد التميز',
        3=>'بقاعة وعد الإبداع',
        4=>'بقاعة وعد الإتقان',
    ];
    // many to many
    public function members()
    {
        return $this->belongsToMany(member::class, 'workshops_registered_members', 'workshop_id', 'member_id');
    }

    public function getStageNameAttribute(){
        $stages_name = [
              1=>'بالمسرح الرئيسي ',
                2=>'بقاعة وعد التميز',
                3=>'بقاعة وعد الإبداع',
                4=>'بقاعة وعد الإتقان',
        ];
        return $stages_name[$this->stage];
    }
}
