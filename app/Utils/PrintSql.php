<?php

namespace App\Utils;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PrintSql
{
    public static function listen() {
        DB::listen(function ($query) {
            foreach ($query->bindings as $i => $binding) {
                if ($binding instanceof \DateTime) {
                    $query->bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
                } else {
                    if (is_string($binding)) {
                        $query->bindings[$i] = "'$binding'";
                    }
                }
            }
            $qsql = str_replace(array('%', '?'), array('%%', '%s'), $query->sql);
            $qsql = vsprintf($qsql, $query->bindings);
            $err = "Time: [{$query->time} s] Query: {$qsql}";
            Log::info($err);
        });
    }
}
