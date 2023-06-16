<?php declare(strict_types = 1);
// UTF-8 marker äöüÄÖÜß€
/**
 * Class PageTemplate for the exercises of the EWA lecture
 * Demonstrates use of PHP including class and OO.
 * Implements Zend coding standards.
 * Generate documentation with Doxygen or phpdoc
 *
 * PHP Version 7.4
 *
 * @file     PageTemplate.php
 * @package  Page Templates
 * @author   Bernhard Kreling, <bernhard.kreling@h-da.de>
 * @author   Ralf Hahn, <ralf.hahn@h-da.de>
 * @version  3.1
 */

// to do: change name 'PageTemplate' throughout this file
require_once './Page.php';

/**
 * This is a template for top level classes, which represent
 * a complete web page and which are called directly by the user.
 * Usually there will only be a single instance of such a class.
 * The name of the template is supposed
 * to be replaced by the name of the specific HTML page e.g. baker.
 * The order of methods might correspond to the order of thinking
 * during implementation.
 * @author   Bernhard Kreling, <bernhard.kreling@h-da.de>
 * @author   Ralf Hahn, <ralf.hahn@h-da.de>
 */
class Order extends Page
{
    // to do: declare reference variables for members
    // representing substructures/blocks

    /**
     * Instantiates members (to be defined above).
     * Calls the constructor of the parent i.e. page class.
     * So, the database connection is established.
     * @throws Exception
     */
    protected function __construct()
    {
        parent::__construct();
        // to do: instantiate members representing substructures/blocks
    }

    /**
     * Cleans up whatever is needed.
     * Calls the destructor of the parent i.e. page class.
     * So, the database connection is closed.
     */
    public function __destruct()
    {
        parent::__destruct();

    }

    /**
     * Fetch all data that is necessary for later output.
     * Data is returned in an array e.g. as associative array.
     * @return array An array containing the requested data.
     * This may be a normal array, an empty array or an associative array.
     */
    protected function getViewData(): array
    {
        // to do: fetch data for this view from the database
        // to do: return array containing data
        $queryArticles = "select * from article";
        $recordsArticles = $this->_database->query($queryArticles)->fetch_all();
        return $recordsArticles;
    }

    /**
     * First the required data is fetched and then the HTML is
     * assembled for output. i.e. the header is generated, the content
     * of the page ("view") is inserted and -if available the content of
     * all views contained is generated.
     * Finally, the footer is added.
     * @return void
     */
    protected function generateView(): void
    {
        //TODO: Delete default orderid set used to debug
        session_start();
        $_SESSION["orderingID"] = "16";
        $data = $this->getViewData();
        $this->generatePageHeader('to do: change headline'); //to do: set optional parameters






        echo <<<END
              
				<!DOCTYPE html>
                <html lang='de'>
                <head>
                    <meta charset='utf-8'>
                    <!-- für später: CSS include -->
                    <!-- <link rel="stylesheet" href="XXX.css"/> -->
                    
                    <script type="text/javascript" src="order.js"></script>
                    <title>PIZZA</title>
                </head>
                <body onload="sumbitBlocker()">
                <section>
                <article id="test">
END;

        foreach($data as $row) {
            $article_id=htmlspecialchars($row[0]);
            $name=htmlspecialchars($row[1]);
            $picture =htmlspecialchars($row[2]);
            $price=htmlspecialchars($row[3]);
            echo <<<END
				 <div>
                    <img src='$picture' id="$article_id" height='160' width='250' alt='$name' onclick="addToShoppingCart($article_id)" data-name="$name" data-price="$price" />
                    <p>$name</p>
                     <p>$price</p>
                </div>
END;
        }
        echo <<<END
            </article>
			</section>
            <section>
                <h1>Warenkorb</h1>
                <form action='' method='post' accept-charset='UTF-8'>
                    <select name='pizza[]' size='3' multiple tabindex="0" id="cart">

                    </select>
            
                    <p id="totalprice">14,50€</p>
                    <label for="address">Adresse: </label>
                    <input id="address" name='address' placeholder='Ihre Adresse' value="" required>
                    <br/>
                    <input type='reset' value='Alle Löschen' onclick="deleteAllCartItems()">
                    <input type='button' value='Auswahl Löschen' onclick="deleteSelectedCartItems()">
                    <input id="submit" type='submit' value='Bestellen' disabled>
                </form>
            </section>
            </body>
            </html>
END;

        $this->generatePageFooter();
    }

    /**
     * Processes the data that comes via GET or POST.
     * If this page is supposed to do something with submitted
     * data do it here.
     * @return void
     */
    protected function processReceivedData(): void
    {
        parent::processReceivedData();
        // to do: call processReceivedData() for all members
        if(count($_POST)) {
            $shoppingCart[] = 0;
            $address = "";

            if(isset($_POST['pizza'])) {
                $shoppingCart = $_POST['pizza'];
            }
            if(isset($_POST['address'])) {
                $address = $_POST['address'];
                $address = mysqli_real_escape_string($this->_database,$address);
            }

            $query1 = "INSERT INTO ordering (address) VALUES ('$address')";
            $this->_database->query($query1);
            $lastOrdering_id = $this->_database->insert_id;
            if(isset($this->_database->insert_id)){
                foreach ($shoppingCart as $pizza) {
                    $lastOrdering_id = mysqli_real_escape_string($this->_database, strval($lastOrdering_id));
                    $pizza = mysqli_real_escape_string($this->_database,strval($pizza));
                    $query2 = "INSERT INTO ordered_article (ordering_id, article_id,status) VALUES ('$lastOrdering_id','$pizza','0')";
                    $inserted=$this->_database->query($query2);
                }
            }
            session_start();
            if(isset($lastOrdering_id)){
                $_SESSION["orderingID"] = $lastOrdering_id;
            }

            header("HTTP/1.1 303 See Other");
            header("Location: customer.php");
            die();
        }
    }

    /**
     * This main-function has the only purpose to create an instance
     * of the class and to get all the things going.
     * I.e. the operations of the class are called to produce
     * the output of the HTML-file.
     * The name "main" is no keyword for php. It is just used to
     * indicate that function as the central starting point.
     * To make it simpler this is a static function. That is you can simply
     * call it without first creating an instance of the class.
     * @return void
     */
    public static function main(): void
    {
        try {
            $page = new Order();
            $page->processReceivedData();
            $page->generateView();
        } catch(Exception $e) {
            //header("Content-type: text/plain; charset=UTF-8");
            header("Content-type: text/html; charset=UTF-8");
            echo $e->getMessage();
        }
    }
}

// This call is starting the creation of the page.
// That is input is processed and output is created.
Order::main();

// Zend standard does not like closing php-tag!
// PHP doesn't require the closing tag (it is assumed when the file ends).
// Not specifying the closing ? >  helps to prevent accidents
// like additional whitespace which will cause session
// initialization to fail ("headers already sent").
//? >