<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use SoftDeletes;
    //
    protected $guarded = [];


    public static function rules($id = null)
    {
        return [

        ];
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

}
