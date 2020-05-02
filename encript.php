<?php
function encript($text, $key){
    $encriptedText = "";
    for($i =0; $i < strlen($text); $i++):
        if($text[$i] >= 'a' && $text[$i] <= 'z'):
            $r = $i % strlen($key);
            $var_text = ord($text[$i]) - 97;
            if($key[$r] >= 'a' && $key[$r] <='z'):
                $var_key = ord($key[$r]) - 97;
                $encriptedText = $encriptedText . chr((($var_text + $var_key) % 26 + 97));
            elseif($key[$r] >= 'A' && $key[$r] <= 'Z'):
                $var_key = ord($key[$r]) - 65;
                $encriptedText = $encriptedText . chr((($var_text + $var_key) % 26 + 97));
            endif;
         elseif($text[$i] >= 'A' && $text[$i] <= 'Z'):
             $r = $i % strlen($key);
             $var_text = ord($text[$i]) - 65;
             if($key[$r] >= 'a' && $key[$r] <='z'):
                 $var_key = ord($key[$r]) - 97;
                 $encriptedText = $encriptedText . chr((($var_text + $var_key) % 26 + 65));
             elseif($key[$r] >= 'A' && $key[$r] <= 'Z'):
                 $var_key = ord($key[$r]) - 65;
                 $encriptedText = $encriptedText . chr((($var_text + $var_key) % 26 + 65));
             endif;
         else:
            $encriptedText = $encriptedText . $text[$i];
        endif;
    endfor;
    return $encriptedText;
}
