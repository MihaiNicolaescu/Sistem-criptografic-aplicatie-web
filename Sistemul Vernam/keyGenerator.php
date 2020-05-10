<?php
//functie care genereaza o cheie prin cenerarea aleatoare a codurilor ascii ale literelor alfabetului englezesc
function generateKeyVernam($text){
    $key = "";
    for($i=0; $i< strlen($text); $i++):
        if($text[$i] >= 'a' && $text[$i] <='z'):
            $key = $key . chr(rand(97, 122));
        elseif($text[$i] >= 'A' && $text[$i] <='Z'):
            $key = $key . chr(rand(65, 90));
        else:
            $key .= ' ';
        endif;
    endfor;
    return $key;
}