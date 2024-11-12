<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    //
    protected $guarded = [];

    protected $casts = [
        'details' => 'array', // Automatically casts details to array when accessed
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
