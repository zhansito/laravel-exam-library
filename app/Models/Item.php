<?php

namespace App\Models;

use Facade\FlareClient\View;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Psy\CodeCleaner\UseStatementPass;

use function PHPUnit\Framework\returnSelf;

class Item extends Model
{
    use HasFactory;

    protected $is_liked = false;
    protected $in_basket = 0;

    protected $appends = ['is_liked', 'in_basket'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'basket_items', 'item_id', 'user_id', 'id')->withPivot(['amount']);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function likes()
    {
        return $this->hasMany(View::class);
    }

    
    public function views()
    {
        return $this->hasMany(View::class);
    }
    
    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function getIsLikedAttribute()
    {
        if(!auth()->user()) return false;

        return $this->likes()->where('user_id', auth()->user()->id)->first() || false;
    }

    public function getInBasketAttribute()
    {
        if(!auth()->user()) return 0;

        $in_basket = $this->users()->where('user_id', auth()->user()->id)->first();
        if(!$in_basket) return 0;

        return $this->users()->where('user_id', auth()->user()->id)->first()->pivot->amount;
    }

    public function getViewCountAttribute()
    {
        return $this->views()->count();
    }

    public function getAvgRatingAttribute()
    {
        return $this->reviews()->avg('rating');
    }
}
