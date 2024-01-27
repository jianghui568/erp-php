<?php
/**
 * @createtime   2023/3/25
 * @author       wild
 * @copyright    PhpStorm
 */

namespace App\Utils;

use App\Enums\AppType;
use App\Enums\ClientType;
use App\Model\Apps;
use Illuminate\Support\Arr;
use Leonis\IDCard\IDCard;
use WhichBrowser\Parser;

class Helps
{

    /**
     * 定向发布新功能
     * @param $shopId
     * @return true[]
     */
    public static function release($shopId)
    {
        $isProd = env('APP_ENV') == 'production';
        return [
            'notice_wechat' => true,
        ];
    }

    public static function appBuyerDownloadUrl()
    {
        return rtrim(env('APP_DOWN_URL'), '/') . '/client/app_download';
    }

    public static function appSellerDownloadUrl()
    {
        return rtrim(env('APP_DOWN_URL'), '/') . '/client/app_download?type=seller';
    }

    public static function appIOSBuyerUrl()
    {
        return rtrim(env('APP_DOWN_URL'), '/') . '/apps/ios/buyer.sign.mobileconfig';
        return rtrim(env('APP_DOWN_URL'), '/') . '/apps/ios/buyer-manifest.plist';
    }

    public static function appIOSSellerUrl()
    {
        return rtrim(env('APP_DOWN_URL'), '/') . '/apps/ios/seller.sign.mobileconfig';
        return rtrim(env('APP_DOWN_URL'), '/') . '/apps/ios/seller-manifest.plist';
    }

    public static function appBuyerUrl($version, $type = AppType::ANDROID)
    {
        return rtrim(env('APP_DOWN_URL'), '/') . '/apps/' . $type . "/buyer-{$version}.apk";
    }

    public static function appSellerUrl($version, $type = AppType::ANDROID)
    {
        return rtrim(env('APP_DOWN_URL'), '/') . '/apps/' . $type . "/seller-{$version}.apk";
    }

    public static function ipaBuyerPath()
    {

        $version = Apps::buyerIOSVersion();
        return public_path('apps/ios/buyer-' . $version . '.ipa');
    }

    public static function ipaSellerPath()
    {
        $version = Apps::sellerIOSVersion();
        return public_path('apps/ios/seller-' . $version . '.ipa');
    }

    public static function fullUrl($imgPath)
    {
        return rtrim(config('filesystems.disks.local.url'), '/') . '/' . ltrim($imgPath, '/');
    }

    public static function getClientType($useragent)
    {
        if (!$useragent) {
            return ClientType::UNKNOWN;
        }
        $result = new Parser($useragent);

        if ($result->os->getName() == 'iOS') {
            return ClientType::IOS;
        }
        if ($result->os->getName() == 'Android') {
            return ClientType::ANDROID;
        }
        return ClientType::UNKNOWN;
    }

    public static function weekStr2Num($week)
    {
        $weeks = [
            '周一' => 1,
            '周二' => 2,
            '周三' => 3,
            '周四' => 4,
            '周五' => 5,
            '周六' => 6,
            '周日' => 7,
        ];
        return Arr::get($weeks, $week, 0);
    }

    public static function getWeek($dateString, $weekName = '周')
    {
        $w = date('w', strtotime($dateString));
        $week = array(
            "0" => $weekName . "日",
            "1" => $weekName . "一",
            "2" => $weekName . "二",
            "3" => $weekName . "三",
            "4" => $weekName . "四",
            "5" => $weekName . "五",
            "6" => $weekName . "六"
        );
        return $week[$w];
    }

    public static function getWeekNum($dateString)
    {
        $w = date('w', strtotime($dateString));
        $weekName = '';
        $week = array(
            "0" => $weekName . "7",
            "1" => $weekName . "1",
            "2" => $weekName . "2",
            "3" => $weekName . "3",
            "4" => $weekName . "4",
            "5" => $weekName . "5",
            "6" => $weekName . "6"
        );
        return $week[$w];
    }

    public static function validPhone($phone)
    {
        if (!$phone) {
            return false;
        }
        return preg_match('/^1[3-9]\d{9}$/i', $phone);
    }

    public static function validIdCard($idCard)
    {
        if (!$idCard) {
            return false;
        }
        $IDCard = new \Church\IDCard\IDCard($idCard);
        return $IDCard->isValid();
    }

    public static function validIdCardIsAdult($idCard)
    {

        $idCard = new \Church\IDCard\IDCard($idCard);
        $bir = $idCard->getBirthday();
        return date('Y-m-d') >= date('Y-m-d', strtotime('+18 year', strtotime($bir)));
    }

    public static function floatFormat($number, $decimals = 2)
    {
        return round($number, $decimals);
    }

    public static function floatFormatUnRound($number, $decimals = 2)
    {
        $compute = str_pad('1', $decimals + 1, 0, STR_PAD_RIGHT);
        dump($compute);
        return floor($number * $compute) / $compute; // 将数字乘以100，向下取整，再除以100
    }


    public static function compareOdds($odds, $lastOdds)
    {
        if (!$odds) {
            return $odds;
        }
        $result = [];
        foreach ($odds as $k => $v) {
            $result[$k] = $v;
            $result[$k . '_updown'] = 0;
            $lastVal = Arr::get($lastOdds, $k);
            if ($lastVal === null) {
                continue;
            }
            if ($v > $lastVal) {
                $result[$k . '_updown'] = 1;
            }
            if ($v < $lastVal) {
                $result[$k . '_updown'] = -1;
            }
        }
        if (!$result) {
            return null;
        }
        return $result;
    }

    public static function copyProperty($last, $old)
    {
        $result = [];
        foreach ($old as $k => $val) {
            $result[$k] = $last[$k];
        }
        return $result;
    }

    public static function copyPropertyIfExist($last, $oldData, $oldDataKey, $jsonEncode = true)
    {
        if (!isset($oldData[$oldDataKey]) || !is_array($oldData[$oldDataKey])) {
            return null;
        }
        $old = $oldData[$oldDataKey];
        $result = [];
        foreach ($old as $k => $val) {
            $result[$k] = $last[$k];
        }
        if ($jsonEncode) {
            return json_encode($result, JSON_UNESCAPED_UNICODE);
        }
        return $result;
    }

    // https://juejin.cn/post/6934667781291900942

    /**
     * 二维数组组合，不允许重复
     * @param $input  二维数组
     * @param $length 组合数
     * @return array
     */
    public static function getCombinationData($input, $length)
    {
        $combinations = array();
        // Call recursive function to generate combinations
        self::generateCombinations(array(), $input, $length, $combinations);

        return $combinations;
    }

    // Define recursive function to generate combinations
    protected static function generateCombinations($prefix, $input, $length, &$combinations)
    {
        // Base case: length of prefix is equal to desired length
        if (count($prefix) == $length) {
            $combinations[] = $prefix;
            return;
        }
        // Recursive case: add each element from the input array to the prefix
        foreach ($input as $key => $values) {
            // Skip if values have already been used in the current prefix
            if (count(array_intersect($prefix, $values)) > 0) {
                continue;
            }
            foreach ($values as $value) {
                self::generateCombinations(array_merge($prefix, array($value)), array_slice($input, $key + 1), $length, $combinations);
            }
        }
    }

    /**
     * 二维数据组合，允许元素重复
     * @param $input
     * @param $length
     * @return array
     */
    public static function getRepeatCombinationData($input, $length)
    {
        $combinations = array();
        // Call recursive function to generate combinations
        self::generateRepeatCombinations(array(), $input, $length, $combinations);

        return $combinations;
    }

    // Define recursive function to generate combinations
    protected static function generateRepeatCombinations($prefix, $input, $length, &$combinations)
    {
        // Base case: length of prefix is equal to desired length
        if (count($prefix) == $length) {
            $combinations[] = $prefix;
            return;
        }
        // Recursive case: add each element from the input array to the prefix
        foreach ($input as $key => $values) {
            // Skip if values have already been used in the current prefix

            foreach ($values as $value) {
                self::generateRepeatCombinations(array_merge($prefix, array($value)), array_slice($input, $key + 1), $length, $combinations);
            }
        }
    }

    // https://juejin.cn/post/6934667781291900942
    public static function combination($data, $len)
    {
        $boxData = [];
        $n = count($data);
        if ($len <= 0 || $len > $n) {
            return $boxData;
        }

        for ($i = 0; $i < $n; $i++) {
            $tempData = [$data[$i]];
            if ($len == 1) {
                $boxData[] = $tempData;
            } else {
                $b = array_slice($data, $i + 1);
                $c = self::combination($b, $len - 1);
                foreach ($c as $v) {
                    $boxData[] = array_merge($tempData, $v);
                }
            }
        }
        return $boxData;
    }


    // 组三,组4,组5：N个数字，生成M个不同的N组合
    public static function generateCombination35(array $inputArray): array
    {
        $result = [];

        $recurse = function ($inputArr, $perm = []) use (&$recurse, &$result) {
            if (empty($inputArr)) {
                $result[] = join('', $perm);
            } else {
                $used = [];
                for ($i = 0; $i <= count($inputArr) - 1; $i++) {
                    if (!isset($used[$inputArr[$i]])) {
                        $used[$inputArr[$i]] = true;
                        $newInput = $inputArr;
                        $newPerms = $perm;
                        $newPerms[] = $inputArr[$i];
                        array_splice($newInput, $i, 1);
                        $recurse($newInput, $newPerms);
                    }
                }
            }
        };

        $recurse($inputArray);
        return $result;
    }

    // 给定一个数，求三个数(0-$maxNum)相加等于该数的所有组合
    public static function sumCombination($sum, $maxNum = 9)
    {
        $res = [];
        for ($i = 0; $i <= $maxNum; $i++) {
            for ($j = 0; $j <= $maxNum; $j++) {
                for ($k = 0; $k <= $maxNum; $k++) {
                    if ($i + $j + $k == $sum) {
                        $item = [$i, $j, $k];
                        $res[] = $item;
                    }
                }
            }
        }
        return $res;
    }

    public static function sumCountCombination($sum, $maxNum = 9)
    {
        $combinations = self::sumCombination($sum, $maxNum);
        return count($combinations);
    }


    public static function filterStackTrace($tracks, $needNum = 2, $unsetIndexs = [0, 1])
    {
        $array = $tracks;
        //print_r($array);//信息很齐全
        foreach ($unsetIndexs as $index) {
            unset($array[$index]);
        }
        $num = 0;
        $result = [];
        foreach ($array as $row) {
            $result[] = $row;
            $num++;
            if ($num >= $needNum) {
                break;
            }
        }
        return $result;
    }

    // https://github.com/laminas/laminas-xml2json
    public static function xml2json($xml, $toArray = true)
    {
        libxml_use_internal_errors(true);
        $xmlObj = simplexml_load_string($xml);
        if (false === $xmlObj) {
            $msg = '解析xml失败：' . json_encode(libxml_get_errors());
            throw new \ErrorException($msg);
        }
        if ($toArray) {
            return json_decode(json_encode($xmlObj), true);
        }
        return $xmlObj;
    }

    /**
     * 给定一组日期，找出最大连续天数
     * @param $dates
     * @return int|mixed
     */
    public static function findMaxConsecutiveDays($dates)
    {
        // 将日期数组按升序排序
        sort($dates);
        $maxConsecutiveDays = 0;
        $currentConsecutiveDays = 1;

        $totalDates = count($dates);

        for ($i = 1; $i < $totalDates; $i++) {
            // 计算相邻日期之间的差值
            $diff = strtotime($dates[$i]) - strtotime($dates[$i - 1]);
            // 如果相邻日期差值为一天，则增加当前连续天数
            if ($diff == 86400) { // 86400 秒等于一天
                $currentConsecutiveDays++;
            } else {
                // 否则，重置当前连续天数
                $currentConsecutiveDays = 1;
            }
            // 更新最大连续天数
            $maxConsecutiveDays = max($maxConsecutiveDays, $currentConsecutiveDays);
        }

        return $maxConsecutiveDays;
    }


    /**
     * 查找$array中连续出现$target的最大次数
     * @param $array
     * @param $target
     * @return int|mixed
     */
    public static function findMaxConsecutive($array, $target)
    {
        $maxConsecutiveTrue = 0;
        $currentConsecutiveTrue = 0;

        foreach ($array as $value) {
            if ($value === $target) {
                // 如果当前值为 true，则增加当前连续 true 的次数
                $currentConsecutiveTrue++;
            } else {
                // 如果当前值不为 true，则重置当前连续 true 的次数
                $currentConsecutiveTrue = 0;
            }

            // 更新最大连续 true 的次数
            $maxConsecutiveTrue = max($maxConsecutiveTrue, $currentConsecutiveTrue);
        }

        return $maxConsecutiveTrue;
    }

    public static function percentage($numerator, $denominator , $decimal = 2) {

        if ($denominator <= 0 || $numerator <=0) {
            return 0;
        }
        return number_format($numerator / $denominator, $decimal, '.', '') * 100;
    }
}
