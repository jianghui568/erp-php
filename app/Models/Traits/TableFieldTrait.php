<?php

namespace App\Models\Traits;


trait TableFieldTrait
{
    /**
     * @param $value
     * @return false|string
     */
    public function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
