<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasUuids, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /* Relationship */

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }
    public function monthBudgets()
    {
        return $this->hasMany(MonthBudget::class);
    }
    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function targets()
    {
        return $this->hasMany(Target::class);
    }
}
