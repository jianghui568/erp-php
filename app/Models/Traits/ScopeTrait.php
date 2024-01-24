<?php

namespace App\Models\Traits;

trait ScopeTrait
{
    public function scopeWhereLike($query, $column, $value)
    {
        return $query->where($column, 'like', '%'.$value.'%');
    }

    public function scopePaging($query)
    {
        if (request()->isJson()) {
            $size = request()->json('size');
        } else {
            $size = request('size');
        }

        if (intval($size) < 1) {
            $size = config('paging.size');
        }

        $sizeMax = config('paging.size_max');
        if ($size > $sizeMax) {
            $size = $sizeMax;
        }
        return $query->paginate(intval($size));
    }
}
