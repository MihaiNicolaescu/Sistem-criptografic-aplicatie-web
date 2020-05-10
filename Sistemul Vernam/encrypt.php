<?php
/*
 * Functie care cripteaza mesajul dat de utilizator
 */
function encrypt($text, $key) {
    $outText = '';
    $new_Key = "";
    for($i=0; $i<strlen($text); $i++):
        if($text[$i] >= 'a' && $text[$i] <='z'):
            $tmp = ord($text{$i} ^ $key{$i})+97;//codul ascii al caracterului dupa ce acesta trece prin XOR
            if($tmp > 122): //daca codul depaseste limita alfabetului se scade codul ascii al ultimului caracter din alfabet si se adauna codul primului caracter, realizam acest lucru pentru ca textul criptat sa
                //fie in caractere ale alfabetului
                //evideta caracterelor ce depaseau limitele alfabetului se va tine prin adaucarea la cheie a unui numar care reprezinta cu cate poziti depaseste ultimul caracter din alfabet
                $tmp = $tmp -122;
                $new_Key .= $tmp . $key[$i];
                $outText .= chr($tmp+97);
            else:
                $outText .=chr(ord($text{$i} ^ $key{$i})+97);
                $new_Key .=$key[$i];
            endif;
        elseif($text[$i] >= 'A' && $text[$i] <='Z'):
            $tmp = ord($text{$i} ^ $key{$i})+65;//se realizeaza acelasi lucru ca mai sus si pentru literele majuscule
            if($tmp > 90):
                $tmp = $tmp - 90;
                $new_Key .= $tmp . $key[$i];

            endif;
            $new_Key .=$key[$i];
            $outText .=chr(ord($text{$i} ^ $key{$i})+65);
        else:
            $outText.=$text[$i];
            $new_Key .=$key[$i];
        endif;
    endfor;
    $outText = $outText . "|||" . $new_Key; // pentru a putea returna ambele variabile (cheia noua si textul criptat) adaugam un semn de delimitare intre cele doua valori
    return $outText;
}

