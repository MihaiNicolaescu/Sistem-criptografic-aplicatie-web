<?php
/*
 *functie pentru decriparea textului initial folosind textul criptat si cuvantul cheie
 */
function decryptCaesar($encriptedText, $key){
    $text = "";
    for($i =0; $i < strlen($encriptedText); $i++):
        if($encriptedText[$i] >= 'a' && $encriptedText[$i] <= 'z'):
            $var_text = ord($encriptedText[$i]) - 97;
            if($key[$i] >= 'a' && $key[$i] <='z'): // conditie pentru a determina daca caracterul 'r' din cheie este litera mica sau mare pentru a folosi corect codul ascii in decriptare
                $var_key = ord($key[$i]) - 97;
                $text = $text . chr((($var_text - $var_key + 26) % 26 + 97));
            elseif($key[$i] >= 'A' && $key[$i] <= 'Z'): // conditie pentru a determina daca caracterul 'r' din cheie este litera mica sau mare pentru a folosi corect codul ascii in decriptare
                $var_key = ord($key[$i]) - 65;
                $text = $text . chr((($var_text - $var_key + 26) % 26 + 97));
            endif;
        elseif($encriptedText[$i] >= 'A' && $encriptedText[$i] <= 'Z'):
            $var_text = ord($encriptedText[$i]) - 65;
            if($key[$i] >= 'a' && $key[$i] <='z'): // conditie pentru a determina daca caracterul 'r' din cheie este litera mica sau mare pentru a folosi corect codul ascii in decriptare
                $var_key = ord($key[$i]) - 97;
                $text = $text . chr((($var_text - $var_key + 26) % 26 + 65));
            elseif($key[$i] >= 'A' && $key[$i] <= 'Z'): // conditie pentru a determina daca caracterul 'r' din cheie este litera mica sau mare pentru a folosi corect codul ascii in decriptare
                $var_key = ord($key[$i]) - 65;
                $text = $text . chr((($var_text - $var_key + 26) % 26 + 65));
            endif;
        else:   //daca caracterul 'i' din text-ul criptat nu este o litera a alfabetului englezesc acesta se copiaza in textul decriptat ca atare.
            $text = $text . $encriptedText[$i];
        endif;
    endfor;
    return $text;
}