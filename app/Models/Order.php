<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

class Order extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'store_id',
        'user_id',
        'number',
        'payment_method',
        'status',
        'payment_status',
        'shipping',
        'tax',
        'discount',
        'total',
    ];
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Guest Customer'
        ]);
    }

    public function Order_Items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
    public function product()
    {
        return $this->belongsToMany(
            product::class,
            'Order_Items',
            'order_id',
            'product_id',
            'id',
            'id'
        )->using(OrderItem::class)
            ->WithPivote(['product_name', 'price', 'quantity', 'options']);
    }
    protected static function booted()
    {
        static::creating(function (Order $order) {
            $order->number = Order::GetNextOrderNumber();
        });
    }
    public static function GetNextOrderNumber()
    {
        $year = Carbon::now()->year;
        $number = Order::whereYear('created_at', $year)->max(('number'));
        if ($number) {
            return $number + 1;
        }
        return $year . '0001';
    }

    public function addresses()
    {
        return $this->hasMany(OrderAddress::class);
    }

    public function billingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id', )
            ->where('type', '=', 'billing');
    }

    public function ShippingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id', )
            ->where('type', '=', 'shipping');
    }


}
