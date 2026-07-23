<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Observers\CartObserver;
use Illuminate\Support\Facades\cookie;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
class cart extends Model
{
    protected $fillable = [
        'cookie_id',
        'user_id',
        'product_id',
        'quantity',
        'options',
    ];
    public $incrementing = false;

    protected static function booted()
    {
        static::observe(CartObserver::class);
        static::addGlobalScope('cookie_id', function (Builder $builder) {
            $builder->where('cookie_id', '=', cart::getCookieId());
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class)
            ->withDefault();
    }
    public function user()
    {
        return $this->belongsTo(User::class)
            ->withDefault([
                'name' => 'Guest User',
            ]);
    }
    public static function getCookieId()
    {
        $cookie_id = Cookie::get('Cart_id');
        if (!$cookie_id) {
            $cookie_id = Str::uuid();
            Cookie::queue('Cart_id', $cookie_id, 60 * 24 * 30);
        }
        return $cookie_id;
    }


}
