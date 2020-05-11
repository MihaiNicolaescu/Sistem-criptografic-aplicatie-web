<?php
/*
 * functie care cripteaza un text dat de utilizator folosind un cuvant ales de utilizator drept cheie
 */
function encript($text, $key){
    $encriptedText = "";
    for($i =0; $i < strlen($text); $i++):
        if($text[$i] >= 'a' && $text[$i] <= 'z'):
            $r = $i % strlen($key);
            $var_text = ord($text[$i]) - 97;
            if($key[$r] >= 'a' && $key[$r] <='z'): // conditie pentru a determina daca caracterul 'r' din cheie este litera mica sau mare pentru a folosi corect codul ascii in criptare
                $var_key = ord($key[$r]) - 97;
                $encriptedText = $encriptedText . chr((($var_text + $var_key) % 26 + 97));
            elseif($key[$r] >= 'A' && $key[$r] <= 'Z'): // conditie pentru a determina daca caracterul 'r' din cheie este litera mica sau mare pentru a folosi corect codul ascii in criptare
                $var_key = ord($key[$r]) - 65;
                $encriptedText = $encriptedText . chr((($var_text + $var_key) % 26 + 97));
            endif;
         elseif($text[$i] >= 'A' && $text[$i] <= 'Z'):
             $r = $i % strlen($key);
             $var_text = ord($text[$i]) - 65;
             if($key[$r] >= 'a' && $key[$r] <='z'): // conditie pentru a determina daca caracterul 'r' din cheie este litera mica sau mare pentru a folosi corect codul ascii in criptare
                 $var_key = ord($key[$r]) - 97;
                 $encriptedText = $encriptedText . chr((($var_text + $var_key) % 26 + 65));
             elseif($key[$r] >= 'A' && $key[$r] <= 'Z'): // conditie pentru a determina daca caracterul 'r' din cheie este litera mica sau mare pentru a folosi corect codul ascii in criptare
                 $var_key = ord($key[$r]) - 65;
                 $encriptedText = $encriptedText . chr((($var_text + $var_key) % 26 + 65));
             endif;
         else: //daca caracterul 'i' din text-ul introdus de utilizator nu este o litera a alfabetului englezesc acesta se copiaza in textul criptat ca atare.
            $encriptedText = $encriptedText . $text[$i];
        endif;
    endfor;
    return $encriptedText;
}
