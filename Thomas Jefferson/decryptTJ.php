<?php
require_once "functionsThomasJefferson.php";
/*
 * functie pentru decriptarea mesajului
 * primeste 2 parametrii: textul cripat si cheia pentru aranjarea discurilor
 */
function decryptTJ($text, $key){
    $decrypted_cylinder = decrypt($text, $key);
    $plainText = getPlainText($decrypted_cylinder);
    return $plainText;
}