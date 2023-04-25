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
    <title>Fahrer</title>
</head>
<body>
    <form action="" method="post">
        <section>
            <h1>Fahrer</h1>

            <article>
                <fieldset id="order1">
                    <legend accesskey="1">Bestellung 1</legend>
                    <label for="address1">Adresse: </label>
                    <p id="address1"> Breubgerstraße 2 64750 Lützelbach </p>

                    <label for="onTheWay">Auf dem Weg</label>
                    <input type="radio" id="onTheWay" name="order1" value="onTheWay" checked> <br />
                    <label for="delivered">Ausgeliefert</label>
                    <input type="radio" id="delivered" name="order1" value="delivered"> <br />
                </fieldset>
            </article>

            <article>
                <fieldset id="order2">
                    <legend accesskey="2">Bestellung 1</legend>
                    <label for="address2">Adresse: </label>
                    <p id="address2"> Breubgerstraße 2 64750 Lützelbach </p>

                    <label for="onTheWay2">Auf dem Weg</label>
                    <input type="radio" id="onTheWay2" name="order2" value="onTheWay" checked> <br />
                    <label for="delivered2">Ausgeliefert</label>
                    <input type="radio" id="delivered2" name="order2" value="delivered"> <br />
                </fieldset>
            </article>
        </section>

        <input type="submit" value="Absenden" />

    </form>
</body>
</html>
