<?php
/*
 * functie care cripteaza un text dat de utilizator folosind un cuvant ales de utilizator drept cheie
 * criptarea sistemului Caesar a fost modificata, aceasta folosid o cheie generata automat pe baza unui cuvant introdus de catre utilizator
 * in sistemul original criptarea se realiza prin permutarea cu n poziti a toturor caracterelor din textul ce urmeaza sa fie cifrat
 * in sistemul actual permutarea se face diferit pentru fiecare caracter din textul ce urmeaza sa fie criptat, ceea ce face mesajul criptat sa fie mai greu de decriptat
 */
function encryptCaesar($text, $key){
    $encriptedText = "";
    for($i =0; $i < strlen($text); $i++):
        if($text[$i] >= 'a' && $text[$i] <= 'z'):
            $var_text = ord($text[$i]) - 97;
            if($key[$i] >= 'a' && $key[$i] <='z'): // conditie pentru a determina daca caracterul 'r' din cheie este litera mica sau mare pentru a folosi corect codul ascii in criptare
                $var_key = ord($key[$i]) - 97;
                $encriptedText = $encriptedText . chr((($var_text + $var_key) % 26 + 97));
            elseif($key[$i] >= 'A' && $key[$i] <= 'Z'): // conditie pentru a determina daca caracterul 'r' din cheie este litera mica sau mare pentru a folosi corect codul ascii in criptare
                $var_key = ord($key[$i]) - 65;
                $encriptedText = $encriptedText . chr((($var_text + $var_key) % 26 + 97));
            endif;
        elseif($text[$i] >= 'A' && $text[$i] <= 'Z'):
            $var_text = ord($text[$i]) - 65;
            if($key[$i] >= 'a' && $key[$i] <='z'): // conditie pentru a determina daca caracterul 'r' din cheie este litera mica sau mare pentru a folosi corect codul ascii in criptare
                $var_key = ord($key[$i]) - 97;
                $encriptedText = $encriptedText . chr((($var_text + $var_key) % 26 + 65));
            elseif($key[$i] >= 'A' && $key[$i] <= 'Z'): // conditie pentru a determina daca caracterul 'r' din cheie este litera mica sau mare pentru a folosi corect codul ascii in criptare
                $var_key = ord($key[$i]) - 65;
                $encriptedText = $encriptedText . chr((($var_text + $var_key) % 26 + 65));
            endif;
        else: //daca caracterul 'i' din text-ul introdus de utilizator nu este o litera a alfabetului englezesc acesta se copiaza in textul criptat ca atare.
            $encriptedText = $encriptedText . $text[$i];
        endif;
    endfor;
    return $encriptedText;
}
