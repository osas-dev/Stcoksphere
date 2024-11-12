<?php

if (! function_exists('generateTxId')) {
    function generateTxId()
    {
        // Example: Use the current timestamp and a random string
        return 'TXN-' . time() . '-' . strtoupper(Str::random(4));
    }
}
