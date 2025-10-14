<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Workshop;

class AttendsWorkShop extends Model
{
    use HasFactory;
    protected $table = 'attend_workshops';
    protected $fillable = ['member_id','workshop_id','date'];


    public function getName($id){
        return Workshop::where('id',$id)->first();
    }
}
