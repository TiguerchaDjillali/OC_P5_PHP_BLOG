<?php

namespace OpenFram;

function u($string = "")
{
    return urlencode($string);
}

function escape_to_html($dirty){
    echo htmlspecialchars($dirty, ENT_QUOTES, 'UTF-8');
}


