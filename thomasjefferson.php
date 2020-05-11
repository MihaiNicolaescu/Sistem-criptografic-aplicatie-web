<?php
require_once "Thomas Jefferson/encryptTJ.php";
require_once "Thomas Jefferson/decryptTJ.php";
/*
 * Criptarea se realizeaza astfel:
 * textul introdus este pus pe discurile imaginare ale unui cilindru imaginar :)
 * la urmatorul pas discurile se amesteca si se alege o linie de pe cilindru ca fiind textul criptat
 * cheia este formata din pozitia originala pe care discurile amestecate o aveau
 * ======
 * Decriptarea se realizeaza astfel:
 * folosind textul cirptat introdus de catre utilizator formam un nou cilindru care contine discuri formate atsfel
 * Daca textul criptat este: GLM discurile vor fi urmatoarele
 * GLM
 * HMN
 * INO
 * pana cand se ajunge ca discurile sa contina toate literele alfabetului englezesc
 * urmatoare etapa este de a aranja discurile in oridea data de cheie, dupa aceasta textul transmis se regaseste pe cilindru
 */
if(isset($_POST['crypt-btn'])){
    $ok = false;
    $text = $_POST['message'];
    if (preg_match('/^[\p{L} ]+$/u', $text)): //conditie pentru a verificara daca in parola exista spatii sau in text exista doar litere ale alfabetului englezesc
        $ok = true;
        if (preg_match('/\s/',$text)):
            $ok=false;
        endif;
    endif;
    if($ok):
        $textPlusKey = explode(" | ",encrypt($text));
        $encText = $textPlusKey[0];
        $key = $textPlusKey[1];
        $cPromo = "(Key): ". $key . "<br>(Thomas Jefferson)Mesaj criptat: <br>";
        $cPromo = $cPromo . $encText;
    else:
        $cPromo = "Textul si parola trebuie sa contina numai litere din alfabetul englezesc!";
    endif;
}
if(isset($_POST['decrypt-btn'])){
    $ok = false;
    $text = $_POST['message-crypt'];
    $key_ = $_POST['key-wordd'];
    if (preg_match('/^[\p{L} ]+$/u', $text)): //conditie pentru a verificara daca in parola exista spatii sau in text exista doar litere ale alfabetului englezesc
        $ok = true;
        if (preg_match('/\s/',$text)):
            $ok=false;
        endif;
    endif;
    if($ok):
        $promo = "(Thomas Jefferson)Mesaj decriptat: <br>";
        $message_decrypt = decryptTJ($text, $key_); // apelarea functiei care decripteaza textul introdus de utilizator
        $promo = $promo . $message_decrypt;
    else:
        $promo = "Textul si parola trebuie sa contina numai litere din alfabetul englezesc!";
    endif;
}
if(isset($_POST['vigenere'])){
    header("location: index.php");
}
if(isset($_POST['vernam'])){
    header("location: vernam.php");
}
if(isset($_POST['caesar'])){
    header("location: caesar.php");
}
?>
<html>
<head>
    <title>Sistemul Vigenere</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-light" style="background-color: transparent;">
        <form method="post">
            <button class="btn btn-outline-success btn-sm" name="vigenere" type="submit">Sistemul Vigenere</button>
            <button class="btn btn-outline-success btn-sm" name="vernam" type="subit">Sistemul Vernam</button>
            <button class="btn btn-outline-success btn-sm" name="caesar" type="submit">Sistemul Caesar</button>
        </form>
    </nav>
    <div class="switch">
        <button type="submit" name="crypt-btn" id="crypt-btn" class="btn btn-primary" onclick="crypt()">Criptare</button>
        <button type="submit" name="decrypt-btn" id="decrypt-btn" class="btn btn-outline-primary" onclick="decrypt()">Decriptare</button>
    </div>
    <div class="vigenere" id="vigenere">
        <div class="container-crypt">
            <form method="post" id="crypt-form">
                <textarea name="message" rows="10" cols="50" placeholder="Introdu mesajul care doresti sa fie criptat aici."></textarea>
                <input style="visibility: hidden"   class="form-control" type="text" name="key-word" placeholder="Cuvantul cheie">
                <button class="btn-vigenege" type="submit" name="crypt-btn"><i class="material-icons">lock</i></button>
            </form>
        </div>
        <div class="container-decrypt">
            <form method="post" id="decrypt-form">
                <textarea name="message-crypt" rows="10" cols="50" placeholder="Introdu mesajul care doresti sa fie decriptat aici."></textarea>
                <input class="form-control" type="text" name="key-wordd" placeholder="Cuvantul cheie">
                <button class="btn-vigenege" type="submit" name="decrypt-btn"><i class="material-icons">lock_open</i></button>
            </form>
        </div>
    </div>
    <p id="text-criptat" style="color: white;"><?php if(isset($_POST['crypt-btn'])){echo  $cPromo;} ?></p>
    <p id="text-decriptat" style="color: white;"><?php if(isset($_POST['decrypt-btn'])){echo  $promo;} ?></p>
</div>
<p style="bottom: 1px; text-align: center; color: black;">©Nicolaescu Gheorghe-Mihaita 2020</p>
</body>
</html>
<script type="text/javascript">
    var dForm = document.getElementById("decrypt-form");
    var cForm = document.getElementById("crypt-form");
    var cBtn = document.getElementById("crypt-btn");
    var dBtn = document.getElementById("decrypt-btn");
    var cText = document.getElementById("text-criptat");
    var dText = document.getElementById("text-decriptat");
    var vigenere = document.getElementById("vigenere");
    var caesar = document.getElementById("caesar");
    function decrypt(){
        cForm.style.visibility="hidden";
        dForm.style.visibility="visible";
        cBtn.classList.remove('btn-primary');
        dBtn.classList.remove('btn-outline-primary');
        cBtn.classList.add('btn-outline-primary');
        dBtn.classList.add('btn-primary');
        dText.innerHTML = "";
        cText.innerHTML = "";
    }
    function crypt(){
        cForm.style.visibility="visible";
        dForm.style.visibility="hidden";
        cBtn.classList.remove("btn-outline-primary");
        dBtn.classList.remove("btn-primary");
        cBtn.classList.add("btn-primary");
        dBtn.classList.add("btn-outline-primary");
        dText.innerHTML = "";
        cText.innerHTML = "";
    }
</script>

