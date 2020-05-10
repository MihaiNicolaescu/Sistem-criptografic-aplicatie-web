<?php
/*
  * Functia de decriptare
  *
  */
function decrypt($text, $key) {
$outText = '';
$count = 0; //variabila pentru a contoriza caracterele de tip numeric din cheie
for($i=0; $i<strlen($text);$i++ ):
    if($text[$i] >= 'a' && $text[$i] <='z'):
        if(is_numeric($key[$i+$count])): // se testeza  daca valoarea din cheie este numerica
            $text[$i] = chr(122+$key[$i+$count]); //daca valoarea este numerica atunci caracterul din text este inlocuit de numarul din cheie + codul ascii al ultimului caracter
            $count++;
        endif;
        $text[$i] = chr(ord($text[$i])-97);
        $outText .= chr(ord($text{$i} ^ $key{$i+$count}));
    elseif($text[$i] >= 'A' && $text[$i] <='Z'):
        if(is_numeric($key[$i+$count]))://se realizeaza aceiasi pasi ca mai sus
            $text[$i] = chr(90+$key[$i+$count]);
            $count++;
        endif;
        $text[$i] = chr(ord($text[$i])-65);
        $outText .= chr(ord($text{$i} ^ $key{$i}));
    else:
        $outText .= $text[$i];
    endif;
endfor;
return $outText;
}