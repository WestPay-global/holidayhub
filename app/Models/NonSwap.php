<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonSwap extends Model
{
    use HasFactory;

    //list owner
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by')->select('id', 'name', 'profile_picture');
    }

    public function seeker()
    {
        return $this->belongsTo(User::class, 'seeker_id');
    }

    public function listOffers()
    {
        return $this->hasMany(ListOffer::class, 'list_id')->where('list_type','nonswap');
    }

    public function getBgColor($status)
    {

        $allStatus = [
            ['name'=>'draft', 'bgColor'=>'primary'],
            ['name'=>'completed', 'bgColor'=>'success'],
            ['name'=>'deactivated', 'bgColor'=>'dark'],
            ['name'=>'suspended', 'bgColor'=>'danger'],
        ];

        foreach ($allStatus as $statusItem) {
            if ($statusItem['name'] === $status) {
                return $statusItem['bgColor'];
            }
        }
        return null; // Return null or a default value if the status is not found
    }
}
