<?php
function decrypt($encriptedText, $key){
    $text = "";
    for($i =0; $i < strlen($encriptedText); $i++):
        if($encriptedText[$i] >= 'a' && $encriptedText[$i] <= 'z'):
            $r = $i % strlen($key);
            $var_text = ord($encriptedText[$i]) - 97;
            if($key[$r] >= 'a' && $key[$r] <='z'):
                $var_key = ord($key[$r]) - 97;
                $text = $text . chr((($var_text - $var_key + 26) % 26 + 97));
            elseif($key[$r] >= 'A' && $key[$r] <= 'Z'):
                $var_key = ord($key[$r]) - 65;
                $text = $text . chr((($var_text - $var_key + 26) % 26 + 97));
            endif;
        elseif($encriptedText[$i] >= 'A' && $encriptedText[$i] <= 'Z'):
            $r = $i % strlen($key);
            $var_text = ord($encriptedText[$i]) - 65;
            if($key[$r] >= 'a' && $key[$r] <='z'):
                $var_key = ord($key[$r]) - 97;
                $text = $text . chr((($var_text - $var_key + 26) % 26 + 65));
            elseif($key[$r] >= 'A' && $key[$r] <= 'Z'):
                $var_key = ord($key[$r]) - 65;
                $text = $text . chr((($var_text - $var_key + 26) % 26 + 65));
            endif;
        else:
            $text = $text . $encriptedText[$i];
        endif;
    endfor;
    return $text;
}