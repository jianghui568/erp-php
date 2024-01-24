<?php

namespace App\Models;

use App\Models\Traits\ScopeTrait;
use App\Models\Traits\TableFieldTrait;
use App\Models\Traits\TableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    protected $primaryKey = 'id';
    use SoftDeletes;
    use TableFieldTrait;
    use TableTrait;
    use ScopeTrait;

    //修改日期时间格式
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

}
