<?php

use Support\Flash;

function flash(string $index, string $css = ''): string
{
    $message = Flash::get($index);

    return "<span class='$css'>{$message}</span>";
}
