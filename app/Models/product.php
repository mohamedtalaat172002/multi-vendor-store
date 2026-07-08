<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
class product extends Model
{

    use HasFactory;

    //

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function scopeActive(Builder $query, ?string $status)
    {
        return $query->when($status, function ($query, $status) {
            $query->where('status', $status);
        });
    }


    public function scopeSearch(Builder $query, array $search)
    {
        return $query->when($search['search'] ?? null, function ($query, $name) {
            $query->where('name', 'like', '%' . $name . '%');
        });
    }

    public function scopeCategory(Builder $query, $category_id)
    {
        return $query->when($category_id, function ($query, $category_id) {
            $query->where('category_id', $category_id);
        });

    }

    //Accessor for image url
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return "https://eweb.naccho.org/eweb/images/DEMO1/notavailable.jpg";
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return "$this->image";
        }

        return asset('storage/' . $this->image);
    }

    public function getSalesPercentageAttribute()
    {
        if ($this->compare_price && $this->compare_price > $this->price) {
            $salesPercentage = (($this->compare_price - $this->price) / $this->compare_price) * 100;
            return round($salesPercentage, 0);
        }
        return null;
    }

}
