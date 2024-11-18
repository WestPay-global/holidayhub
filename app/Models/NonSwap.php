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
}
