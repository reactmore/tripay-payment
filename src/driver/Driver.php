<?php

namespace Reactmore\driver;

class Driver
{
    public static function filterGroup(array $data, string $group)
    {
        $row = $data;
        $filtered = array();

        foreach ($row as $index => $columns) {
            foreach ($columns as $key => $value) {
                // Filter Transaksi Tanggal SKG
                if ($key == 'group' && $value == $group) {
                    $filtered[] = $columns;
                }
            }
        }

        return json_encode($filtered);
    }
}
