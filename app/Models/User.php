<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthdate'         => 'datetime:d.m.Y',
        'created_at'        => 'datetime:d.m.Y H:i:s',
        'updated_at'        => 'datetime:d.m.Y H:i:s',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function favourite_items()
    {
        return $this->belongsToMany(Item::class, 'likes', 'usr_id', 'id', 'id');
    }

    public function basket_items()
    {
        return $this->belongsToMany(Item::class, 'basket_items', 'user_id', 'item_id', 'id', 'id')
        ->withPivot(['amount']);
    }

    public function getBasketItemsCountAttribute()
    {
        return count($this->basket_items);
    }

}
