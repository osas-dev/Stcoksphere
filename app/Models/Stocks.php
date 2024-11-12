<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    //
    protected $guarded = [];

    public function tradeHistory()
    {
        return $this->hasMany(TradeHistory::class);
    }
}
