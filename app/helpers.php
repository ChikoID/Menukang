<?php

if (! function_exists('rupiah')) {
    function rupiah($n)
    {
        return 'Rp ' . number_format($n, 0, ',', '.');
    }
}
