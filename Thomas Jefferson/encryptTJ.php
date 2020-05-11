<?php
require_once "functionsThomasJefferson.php";
/*
 * functie pentru criptarea textului
 * primeste un singur parametru ce reprezinta mesajul pe care utilizatorul doreste sa il cripteze
 */
function encrypt($text){
    $cylinder = cylinder($text);
    $key = mix($cylinder);
    $cylinder = disk_place($cylinder, $key);
    $key = key_($key);
    $chiperText = getChiper($cylinder);
    $textPlusKey  = "";
    $textPlusKey .= $chiperText . " | " . $key;
    return $textPlusKey;
}
