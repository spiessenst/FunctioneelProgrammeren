<?php
function Sanitisation( $arr)
{
    foreach ( $arr as $key => $value )
    {
        $arr[$key] = htmlspecialchars(trim($value) , ENT_QUOTES);
    }

    return $arr;
}

