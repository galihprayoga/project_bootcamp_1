<?php     
    function format_rupiah($number, $sign = false)
    {
        if ($sign) {
            return 'Rp ' . number_format($number, 0, ',', '.');
        }
        return number_format($number, 0, ',', '.');
    }
