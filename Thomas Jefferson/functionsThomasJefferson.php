<?php
/*
 * functie care formeaza "cilindrul Bazeries "
 */
function cylinder($text){
    $wheel = array();
    for($i = 0; $i<strlen($text); $i++):
        $disk = array();
        array_push($disk, strtoupper($text[$i]));
        $tmp =  ord(strtoupper($text[$i]));
        $tmp++;
        for($j=0;$j<25;$j++):
            if($tmp > 90) //daca caracterul actual este mai mare de 90 ('z') atunci tmp va fi resetat la caracterul 65('a')
                $tmp=65;
            array_push($disk, chr($tmp)); // se adauga pe rand cate o litera, incepand de la litera de pe pozitia $i din text
            $tmp++;
        endfor;
        array_push($wheel, $disk);
    endfor;
    return $wheel;
}
//functie pentru a afisa discurile dupa aranjarea acestora
function wheel($wheel){
    for($j=0; $j<25; $j++):
        for($i = 0; $i<count($wheel); $i++):
            echo $wheel[$i][$j];
        endfor;
        echo "<br>";
    endfor;
}
/*
 * functie care returneaza textul criptat care se regasteste pe cilindru
 */
function getChiper($wheel){
    $chiper_text = "";
    for($j=0; $j<25; $j++):
        if($j == 10):
            for($i = 0; $i<count($wheel); $i++):
                $chiper_text .= $wheel[$i][$j];
            endfor;
        endif;
    endfor;
    return $chiper_text;
}
/*
 * functie care returneaza pozitia discurilor pentru a forma cheia
 */
function mix($wheel){
    $number_disk = array();
    for($i=0; $i<count($wheel); $i++):
        array_push($number_disk,  $i+1);
    endfor;
    shuffle($number_disk); //initial pozitile discurilor sunt 1,2,3..., de aceea le amestecam pentru ca pozitiile acestora sa fie aleatoare
    echo "<br>";
    return $number_disk;
}
/*
 * functie care aranjeaza discurile pe cilindru dupa pozitiile date de cheie
 */
function disk_place($wheel, $key){
    $wheel_new = array();
    for($i =0; $i < count($key);$i++):
        array_push($wheel_new, $wheel[(int)$key[$i]-1]);
    endfor;
    return $wheel_new;
}
/*
 * functie care returenaza cheia folosita de utilizator pentru a decripta mesajul
 */
function key_($key){
    $real_key = "";
    for($i=0; $i<count($key); $i++):
        for($j=0; $j<count($key); $j++):
            if($i+1 == $key[$j]):
                $real_key .= $j+1 . " ";
            endif;
        endfor;
    endfor;
    return $real_key;
}
/*
 * functie pentru a decripta cilindrul format dupa textul criptat
 */
function decrypt($wheel, $key){
    $encrypted_wheel = cylinder($wheel);
    $key_decrypt = explode(" ", $key);
    $decrypted_wheel = disk_place($encrypted_wheel, $key_decrypt);
    return $decrypted_wheel;
}
/*
 * functie care returneaza textul in clar(textul initial)
 */
function getPlainText($wheel){
    $chiper_text = "";
    for($j=0; $j<25; $j++):
        if($j == 16):
            for($i = 0; $i<count($wheel); $i++):
                $chiper_text .= $wheel[$i][$j];
            endfor;
        endif;
    endfor;
    return $chiper_text;
}
