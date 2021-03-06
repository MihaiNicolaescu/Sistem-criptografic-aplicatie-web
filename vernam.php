<?php
require_once "Sistemul Vernam/encrypt.php";
require_once "Sistemul Vernam/keyGenerator.php";
require_once "Sistemul Vernam/decrypt.php";

if(isset($_POST['crypt-btn'])){
    $ok = true;
    $text = $_POST['message'];
    if (preg_match('/[^A-Za-z]/', $text))
        $ok = false;
    if($ok):
        $key = generateKeyVernam($text);
        $message_crypt = explode("|||", encrypt($text, $key));// apelarea functiei care cripteaza textul introdus de utilizator
        $cPromo = "(Vernam)Key: " . $message_crypt[1] . "<br>Mesaj criptat: <br>";
        $cPromo = $cPromo . $message_crypt[0];
    else:
        $cPromo = "Textul si parola trebuie sa contina numai litere din alfabetul englezesc si sa nu contina spatii!";
    endif;
}
if(isset($_POST['decrypt-btn'])){
    $ok = true;
    $text = $_POST['message-crypt'];
    $key = $_POST['key-wordd'];
    if (preg_match('/[^A-Za-z]/', $text))
        $ok = false;
    if (!preg_match('/\s/',$text))//conditie pentru a verifica daca in text sunt introduse spatii
        $ok=false;
    if($ok):
        $promo = "(Vernam)Mesaj decriptat: <br>";
        $message_decrypt = decrypt($text, $key); // apelarea functiei care cripteaza textul introdus de utilizator
        $promo = $promo . $message_decrypt;
    else:
        $promo = "Textul si parola trebuie sa contina numai litere din alfabetul englezesc!";
    endif;
}
if(isset($_POST['vigenere'])){
    header("location: index.php");
}
if(isset($_POST['caesar'])){
    header("location: caesar.php");
}
if(isset($_POST['thomas'])){
    header("location: thomasjefferson.php");
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
                <button class="btn btn-outline-success btn-sm" name="caesar" type="submit">Caesar</button>
                <button class="btn btn-outline-success btn-sm" name="thomas" type="submit">Sistemul Thomas Jefferson</button>
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
                    <input class="form-control" type="text" style="visibility: hidden" name="key-wordd" placeholder="Cuvantul cheie">
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

<?php