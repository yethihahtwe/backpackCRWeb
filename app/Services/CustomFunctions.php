<?php

namespace App\Services;

class CustomFunctions
{
    public static function getTableCellColor($record)
    {
        if ($record->rdt_bool === 'Positive') {
            return 'danger';
        }
        return null;
    }
}
