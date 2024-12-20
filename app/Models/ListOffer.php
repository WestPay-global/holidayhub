<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ListOffer extends Model
{
    use HasFactory;

    protected $appends = ['stay_duration'];

    /**
     * Calculate the duration in days between check_in and check_out.
     *
     * @return int|null
     */
    public function getStayDurationAttribute()
    {
        if ($this->check_in && $this->check_out) {
            $checkIn = Carbon::parse($this->check_in);
            $checkOut = Carbon::parse($this->check_out);

            return $checkIn->diffInDays($checkOut);
        }

        return null; // Return null if one of the dates is missing
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function seeker()
    {
        return $this->belongsTo(User::class, 'seeker_id');
    }

    public function homeswaplist()
    {
        return $this->belongsTo(HomeSwap::class, 'list_id')->where('list_type','homeswap');
    }

    public function nonswaplist()
    {
        return $this->belongsTo(NonSwap::class, 'list_id')->where('list_type','nonswap');
    }

    public function getBgColor($status)
    {
        $allStatus = [
            ['name'=>'pending', 'bgColor'=>'primary'],
            ['name'=>'upcoming', 'bgColor'=>'info'],
            ['name'=>'completed', 'bgColor'=>'success'],
            ['name'=>'cancelled', 'bgColor'=>'dark'],
        ];

        foreach ($allStatus as $statusItem) {
            if ($statusItem['name'] === $status) {
                return $statusItem['bgColor'];
            }
        }
        return null; // Return null or a default value if the status is not found
    }
}
