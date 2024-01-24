<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait TableTrait
{
    /**
     * 修改默认复数表明为单数
     * @return string
     */
    public function getTable(){
        return $this->table ? $this->table : strtolower(Str::snake(class_basename($this)));
    }
}
