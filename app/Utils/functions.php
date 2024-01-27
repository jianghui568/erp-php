<?php

if (!function_exists('bc_equal')) {
    /**
     * 浮点数是否相等，默认小数点后两位
     * @param $a
     * @param $b
     * @param int $precision
     * @return bool
     */
    function bc_equal($a, $b, $precision = 2)
    {
        return bccomp($a, $b, $precision) === 0;
    }
}

if (!function_exists('bc_gt')) {
    /**
     * 浮点数是否大于，默认小数点后两位
     * @param $a
     * @param $b
     * @param int $precision
     * @return bool
     */
    function bc_gt($a, $b, $precision = 2)
    {
        return bccomp($a, $b, $precision) === 1;
    }
}
if (!function_exists('bc_gte')) {
    /**
     * 浮点数是否大于等于，默认小数点后两位
     * @param $a
     * @param $b
     * @param int $precision
     * @return bool
     */
    function bc_gte($a, $b, $precision = 2)
    {
        return bccomp($a, $b, $precision) >= 0;
    }
}
if (!function_exists('bc_lt')) {
    /**
     * 浮点数是否小于，默认小数点后两位
     * @param $a
     * @param $b
     * @param int $precision
     * @return bool
     */
    function bc_lt($a, $b, $precision = 2)
    {
        return bccomp($a, $b, $precision) === -1;
    }
}

if (!function_exists('bc_lte')) {
    /**
     * 浮点数是否小于等于，默认小数点后两位
     * @param $a
     * @param $b
     * @param int $precision
     * @return bool
     */
    function bc_lte($a, $b, $precision = 2)
    {
        return bccomp($a, $b, $precision) <= 0;
    }
}

if (!function_exists('bc_precision')) {
    /**
     * 转浮点数
     * @param $a
     * @param int $precision
     * @return float
     */
    function bc_precision($a, $precision = 2)
    {
        return round($a,$precision);
    }
}

if (!function_exists('date_diff_days')) {

    /**
     * 比较两个日期相差几天
     * @param $date1
     * @param $date2
     * @return float
     */
    function date_diff_days($date1, $date2)
    {
        $date1 = date('Y-m-d', strtotime($date1));
        $date2 = date('Y-m-d', strtotime($date2));
        return intval(round(abs(strtotime($date1) - strtotime($date2)) / 3600/24));
    }
}

if (!function_exists('date_diff_month_day')) {

    /**
     * 比较两个日期相差几个月，几天
     * @param $start
     * @param $date2
     * @return $end
     */
    function date_diff_month_day($start, $end)
    {

        $start = date('Y-m-d', strtotime($start));
        $end   = date('Y-m-d', strtotime($end));

        $monthNum = 0;
        $lastDay  = $start;
        while ($start < $end) {
            $start = date('Y-m-d', strtotime('+1 month', strtotime($start)));
            if ($start <= $end) {
                $monthNum++;
                $lastDay = $start;
            }
        }
        $diff = date_diff_days($lastDay, $end);
        return [$monthNum, $diff];
    }
}
