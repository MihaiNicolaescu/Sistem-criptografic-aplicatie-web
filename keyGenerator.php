<?php
function generateKey($text, $key){
    $val_key = strlen($key);
    for($i = 1; ; $i++):
        if(strlen($key) - $val_key == strlen($text)):
            break;
        endif;
        if($key[$i] == 'a'):
            $key = $key . 'z';
        elseif ($key[$i] == 'A'):
            $key = $key[$i] . 'Z';
        else:
            $value_ascii = ord($key[$i]) - 1;
            $key = $key . chr($value_ascii);
        endif;
    endfor;
    $new_key = "";
    for($i = 0; $i < strlen($text); $i++):
        $new_key = $new_key . $key[$i + $val_key];
    endfor;
    $new_key = strrev($new_key);
    return $new_key;
}