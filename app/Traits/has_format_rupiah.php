<?php

namespace App\Traits;

/**
 * trait format rupiah
 */
trait has_format_rupiah
{
    function format_rupiah($field, $prefix = null)
    {
        $prefix = $prefix ? $prefix : 'Rp. ';
        $nominal = $this->attributes[$field];
        return $prefix . number_format($nominal, 0, ',', '.');
    }
}

?>