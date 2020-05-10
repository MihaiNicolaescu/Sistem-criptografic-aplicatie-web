<?php
/*
 * functie pentru generarea unei key de lungimea textului introdus de utilizator pe baza unu cuvant cheie ales de utilizator
 * ================================================================================================================================================
 * Initial cheia era formata din repetarea cuvantului cheie ceea ce reprezenta o vulnerabilitate in sistemul criptografic deoarece                *
 * la o anumita distanta caracterele se repetau cea ce ducea la posibilitatea dea a ghici cheia                                                   *
 * ex:Cuvant: qwe => cheia generata: qweqweqweqwe(repetata pana se ajungea la lungimea textului)                                                  *
 * Prin noua modalitate cheia este formata astfel.                                                                                                *
 * se repeta blocul de instructiuni pana cand lungimea cheiei este egala cu lumginea textului + lungimea cuvantului folosit pentru a forma cheia  *
 * caracterele din cuvantul introdus de utilizator sunt shiftate pe rand la stanga pana se ajunge la lungimea dorita, cand se ajunge la lungimea  *
 * dorita sunt scoase din sir primele n caractere ( n = lungimea cheiei initiale)                                                                 *
 * in pasul final cheia generata este inversata pentru a oferi o criptare mai buna si pentru a ingreuna spargerea acesteia. Prin aceasta metoda   *
 * caracterele din cheie nu se mai repeta cea ce duce la o criptare mult mai buna a textului                                                      *
 * ex: Cuvant: qwe = > cheia generata: qzrasbtcudv (aceasta avand lungimea egala cu cea a textului)                                               *
 * ================================================================================================================================================
 */
function generateKey($text, $key){
    $val_key = strlen($key);
    for($i = 1; ; $i++):    //se va repeta blocul de instructiuni pana cand conditia din acestuia il va opri (lungime cheie = lungime text)
        if(strlen($key) - $val_key == strlen($text)): // conditia care opreste repetarea blocului de instructiuni (initial lungimea cheiei este mai mare ca cea a textului avand o lungime toatala de lungime text + lungime cheie)
            break;
        endif;
        if($key[$i] == 'a'):// daca caracterul 'i' din cheie este 'a' atunci urmatorul caracter adaugat in coada stringului este 'z', astfel se evita iesirea din limite a caracterelor (litera mica)
            $key = $key . 'z';
        elseif ($key[$i] == 'A'): // daca caracterul 'i' din cheie este 'a' atunci urmatorul caracter adaugat in coada stringului este 'z', astfel se evita iesirea din limite a caracterelor (litera mare)
            $key = $key[$i] . 'Z';
        else:
            $value_ascii = ord($key[$i]) - 1; // se stocheaza valoarea ascii a caracterului de pe pozitia 'i' din cheie - 1, pentru a se realiza shiftarea la stanga
            $key = $key . chr($value_ascii); // adaugarea cacaracterului in coada cheiei
        endif;
    endfor;
    $new_key = ""; // variabila folosita pentru a stoca 'noua cheie' dupa editarea acesteia
    for($i = 0; $i < strlen($text); $i++):
        $new_key = $new_key . $key[$i + $val_key]; // in noua cheie se vor trece pe rand fiecare caracter din vechea cheie exceptand primele n caractere (n = lungimea cheiei initiale)
    endfor;
    $new_key = strrev($new_key); // re inverseaza noua cheie pentru a creste protectia codificari, noua cheie fiind formata din caractere diferite
    return $new_key;
}