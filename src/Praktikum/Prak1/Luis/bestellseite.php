<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8" />
    <!-- für später: CSS include -->
    <!-- <link rel="stylesheet" href="XXX.css"/> -->
    <!-- für später: JavaScript include -->
    <!-- <script src="XXX.js"></script> -->
    <title>Bestellseite</title>
</head>
<body>

    <h1>Bestellung</h1>

    <form action="https://echo.fbi.h-da.de/" method="post">
        <article class="pizzaList">
            <h2>Speisekarte</h2>

            <p>
                <img src="img/pizzaSalami.jpg" alt="Pizza Salami" title="Salami Pizza" width="250" height="250"> <br />
                Pizza Salami <br />
                4,50€
            </p>
            <p>
                <img src="img/pizzaMargherita.jpg" alt="Pizza Margherita" title="Salami Margherita" width="250" height="250"> <br />
                Pizza Margherita <br />
                4,00€
            </p>
            <p>
                <img src="img/pizzaHawaii.jpg" alt="Pizza Hawaii" title="Salami Hawaii" width="250" height="250"> <br />
                Pizza Hawaii <br />
                5,50€
            </p>
        </article>
        <section>
            <h2>Warenkorb</h2>

            <select name="shoppingCart[]" size="5" multiple tabindex="0"  >    <!-- static data for demonstration purposes -->
                <option selected>Pizza Salami</option>
                <option>Pizza Margherita</option>
                <option>Pizza Hawaii</option>
            </select>
            <p>14,50€</p>  <!-- static data for demonstration purposes -->
            <input type="text" name="addressInput" value="" placeholder="Ihre Adresse"> <br />
            <input type='reset' value='Alle Löschen'>
            <input type='button' value='Auswahl Löschen'>
            <input type='submit' value='Bestellen'>
        </section>

    </form>

</body>
</html>