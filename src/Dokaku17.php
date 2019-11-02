<?php

declare(strict_types=1);

namespace Nagoyaphp\Dokaku17;

class Dokaku17
{
    public function run(string $input) : string
    {
        return strval($this->findNext(intval($input) + 1));
    }

    private function findNext(int $value) :int
    {
        $binStr = decbin($value);
        preg_match("/(000|111)/", $binStr, $data, PREG_OFFSET_CAPTURE);
        if (empty($data)) {
            return $value;
        } else {
            // 最初に見つかった三連数の1桁目位置
            $placeIndex = $data[1][1] + 2;
            // 繰上げる位
            $placeNumber = 2 ** (strlen($binStr) - $placeIndex - 1);
            // 繰上げて以下の位を切り捨てる
            $value = intval((floor($value / $placeNumber) + 1) * $placeNumber);
            // 再帰呼び出し
            return $this->findNext($value);
        }
    }
}
