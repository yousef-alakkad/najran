<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Workshop;

class WorkShopRegisteredMember extends Model
{
    use HasFactory;

    protected $table = 'workshops_registered_members';
    protected $fillable = ['member_id','workshop_id'];


    public function getName($id){
        return Workshop::where('id',$id)->first();
    }
}
