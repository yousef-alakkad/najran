<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Workshop;

class member extends Model
{
    use HasFactory;

    protected $guarded=[];
    protected $appends=['workshops','full_name'];

	// many to many
	public function work_shops(){
		return $this->belongsToMany(Workshop::class, 'workshops_registered_members', 'member_id', 'workshop_id');
	}

	public function getWorkshopsAttribute(){
	    $w='';
	    foreach ($this->work_shops()->get() as $work_shop){
	        $w.=$work_shop->name.'  |   ';
        }

        return $w;
    }


	public function getFullNameAttribute(){
        return $this->first_name . ' '.$this->last_name;
    }

    public function workshop(){
        return $this->hasMany(WorkShopRegisteredMember::class);
    }

    public function getBadgeImageAttribute()
    {
        $image = '';
        switch ($this->position) {
            case 'رئيس تنفيذي':
            case 'مدير عام':
            case 'رئيس مجلس إدارة':
                $image = 'badgeVIP.png';
                break;
            default:
                $image = 'badge2.jpeg';
        }
        return $image;
    }
}
