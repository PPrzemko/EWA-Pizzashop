<?php

?>
<!-- Made by Leon Stöckbauer 111413 2023 -->
<!DOCTYPE html>
<html lang='de'>
<head>
    <meta charset='utf-8'>
    <!-- für später: CSS include -->
    <!-- <link rel="stylesheet" href="XXX.css"/> -->
    <!-- für später: JavaScript include -->
    <!-- <script src="XXX.js"></script> -->
    <title>PIZZA</title>
</head>
<body>
<section>
    <h1>Bestellung</h1>
    <article>
        <h2>Speisekarte</h2>
        <div>
            <img src='pizza.gif' height='160' width='250' alt='Pizza Margherita' />
            <p>Margherita</p>
            <p>4,00€</p>
        </div>
        <div>
            <img src='pizza.gif' height='160' width='250' alt='Pizza Salami'/>
            <p>Salami</p>
            <p>4,50€</p>
        </div>
        <div>
            <img src='pizza.gif' height='160' width='250' alt='Pizza Hawaii' />
            <p>Hawaii</p>
            <p>5,50€</p>
        <div>
    </article>
</section>
<section>
    <h1>Warenkorb</h1>
    <form action='https://echo.fbi.h-da.de/' method='post' accept-charset='UTF-8'>
        <select name='pizza[]' size='3' multiple tabindex="0">
            <option value='margherita' selected>Pizza Margherita</option>
            <option value='salami'>Pizza Salami</option>
            <option value='hawaii'>Pizza Hawaii</option>
        </select>

        <p>14,50€</p>
        <label for="address">Adresse: </label>
        <input name='address' placeholder='Ihre Adresse' value="" required>
        <br/>
        <input type='reset' value='Alle Löschen'>
        <input type='button' value='Auswahl Löschen'>
        <input type='submit' value='Bestellen'>
    </form>
</section>
</body>
</html>