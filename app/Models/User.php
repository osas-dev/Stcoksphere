<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'main_balance',
        'invest_balance',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function assets()
    {
        return $this->hasMany(Assets::class);
    }
    public function tradeHistory()
    {
        return $this->hasMany(TradeHistory::class);
    }
    public function deposit()
    {
        return $this->hasMany(Deposit::class);
    }
    public function withdrawal()
    {
        return $this->hasMany(Withdrawal::class);
    }
    public function investment_plan()
    {
        return $this->hasMany(InvestmentPlan::class);
    }
    public function user_investment()
    {
        return $this->hasMany(UserInvestment::class);
    }

}
