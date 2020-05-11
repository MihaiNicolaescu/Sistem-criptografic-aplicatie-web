<?php
/*
 *functie pentru decriparea textului initial folosind textul criptat si cuvantul cheie
 */
function decrypt($encriptedText, $key){
    $text = "";
    for($i =0; $i < strlen($encriptedText); $i++):
        if($encriptedText[$i] >= 'a' && $encriptedText[$i] <= 'z'):
            $r = $i % strlen($key);
            $var_text = ord($encriptedText[$i]) - 97;
            if($key[$r] >= 'a' && $key[$r] <='z'): // conditie pentru a determina daca caracterul 'r' din cheie este litera mica sau mare pentru a folosi corect codul ascii in decriptare
                $var_key = ord($key[$r]) - 97;
                $text = $text . chr((($var_text - $var_key + 26) % 26 + 97));
            elseif($key[$r] >= 'A' && $key[$r] <= 'Z'): // conditie pentru a determina daca caracterul 'r' din cheie este litera mica sau mare pentru a folosi corect codul ascii in decriptare
                $var_key = ord($key[$r]) - 65;
                $text = $text . chr((($var_text - $var_key + 26) % 26 + 97));
            endif;
        elseif($encriptedText[$i] >= 'A' && $encriptedText[$i] <= 'Z'):
            $r = $i % strlen($key);
            $var_text = ord($encriptedText[$i]) - 65;
            if($key[$r] >= 'a' && $key[$r] <='z'): // conditie pentru a determina daca caracterul 'r' din cheie este litera mica sau mare pentru a folosi corect codul ascii in decriptare
                $var_key = ord($key[$r]) - 97;
                $text = $text . chr((($var_text - $var_key + 26) % 26 + 65));
            elseif($key[$r] >= 'A' && $key[$r] <= 'Z'): // conditie pentru a determina daca caracterul 'r' din cheie este litera mica sau mare pentru a folosi corect codul ascii in decriptare
                $var_key = ord($key[$r]) - 65;
                $text = $text . chr((($var_text - $var_key + 26) % 26 + 65));
            endif;
        else:   //daca caracterul 'i' din text-ul criptat nu este o litera a alfabetului englezesc acesta se copiaza in textul decriptat ca atare.
            $text = $text . $encriptedText[$i];
        endif;
    endfor;
    return $text;
}