<?php

?>
<!DOCTYPE html>
<html lang='de'>
<head>
    <meta charset='utf-8'>
    <!-- für später: CSS include -->
    <!-- <link rel="stylesheet" href="XXX.css"/> -->
    <!-- für später: JavaScript include -->
    <!-- <script src="XXX.js"></script> -->
    <title>Bäcker</title>
</head>
<body>
    <form action="" method="post">
        <section>
            <h1>Bestellte Pizzen:</h1>
            <article>
                <fieldset id="orderOneMargherita">
                    <legend accesskey="1">Bestellung 1 Pizza Margherita</legend>
                    <label for="bestellt">Bestellt</label>
                    <input type="radio" id="bestellt" name="orderOneMargherita" value="bestellt" checked> <br />
                    <label for="inOven">Im Ofen</label>
                    <input type="radio" id="inOven" name="orderOneMargherita" value="Im Ofen"> <br />
                    <label for="done">Fertig</label>
                    <input type="radio" id="done" name="orderOneMargherita" value="Fertig"> <br />
                </fieldset>
            </article>
            <article>
                <fieldset id="orderOneSalami">
                    <legend accesskey="2">Bestellung 1 Pizza Salami</legend>
                    <label for="bestellt2">Bestellt</label>
                    <input type="radio" id="bestellt2" name="orderOneSalami" value="bestellt" checked> <br />
                    <label for="inOven2">Im Ofen</label>
                    <input type="radio" id="inOven2" name="orderOneSalami" value="Im Ofen"> <br />
                    <label for="done2">Fertig</label>
                    <input type="radio" id="done2" name="orderOneSalami" value="Fertig"> <br />
                </fieldset>
            </article>
            <article>
                <fieldset id="order3Hawaii">
                    <legend accesskey="3">Bestellung 3 Pizza Hawaii</legend>
                    <label for="bestellt3">Bestellt</label>
                    <input type="radio" id="bestellt3" name="order3Hawaii" value="bestellt" checked> <br />
                    <label for="inOven3">Im Ofen</label>
                    <input type="radio" id="inOven3" name="order3Hawaii" value="Im Ofen"> <br />
                    <label for="done3">Fertig</label>
                    <input type="radio" id="done3" name="order3Hawaii" value="Fertig"> <br />
                </fieldset>
            </article>
        </section>
        <input type="submit" value="Absenden" />
    </form>
</body>
</html>