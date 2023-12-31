<?php declare(strict_types=1);
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
class Driver extends Page
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
    protected function getViewData():array
    {
        // to do: fetch data for this view from the database
		// to do: return array containing data
        /*$orderIdAddress = "SELECT o.ordering_id, address FROM ordering as o
                JOIN ordered_article as oa ON o.ordering_id = oa.ordering_id
                GROUP BY o.ordering_id"; */
        /*  O = Ordered
            1 = in Oven
            2 = done //useless
            3 = ready for delivery
            4 = on the way
            5 = delivered
        */
        $queryOrdersReadyToDeliver = "SELECT oa.ordering_id, o.address, oa.status, oa.total_price
FROM (
         SELECT oa.ordering_id,oa.status, MAX(oa.status) AS max_status, SUM(a.price) AS total_price
         FROM ordered_article oa
                  JOIN article a ON oa.article_id = a.article_id
         GROUP BY oa.ordering_id
         HAVING MIN(oa.status) >= 3 AND MAX(oa.status) <= 4
     ) oa
         JOIN ordering o ON oa.ordering_id = o.ordering_id";

        $recordsOrdersReadyToDeliver = $this->_database->query($queryOrdersReadyToDeliver)->fetch_all();
        foreach ($recordsOrdersReadyToDeliver as $row){

        }



        return $recordsOrdersReadyToDeliver;
    }

    /**
     * First the required data is fetched and then the HTML is
     * assembled for output. i.e. the header is generated, the content
     * of the page ("view") is inserted and -if available- the content of
     * all views contained is generated.
     * Finally, the footer is added.
	 * @return void
     */
    protected function generateView():void
    {
		$data = $this->getViewData();
        $this->generatePageHeader('to do: change headline'); //to do: set optional parameters
        // to do: output view of this page
        echo <<<END
				<script>
                setTimeout(function(){
                   window.location.reload(1);
                }, 10000);
                </script>
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
							<h1>Fahrer:</h1>
END;
        foreach($data as $row) {

            $ordering_id=htmlspecialchars($row[0]);
            $address=htmlspecialchars($row[1]);
            $status=htmlspecialchars($row[2]);
            $total_price=htmlspecialchars(number_format(floatval($row[3]), 2));

            $ready = "";
            $onTheWay = "";
            $delivered = "";
            //switch case for status
            switch ($status) {
                case 3:
                    $ready = "checked";
                    break;
                case 4:
                    $onTheWay = "checked";
                    break;
                case 5:
                    $delivered = "checked";
                    break;
            }

            echo <<<END
            <article>
                <fieldset id="Order$ordering_id">
                    <legend accesskey="1">Bestellung $ordering_id</legend>
                    <p>Adresse: $address </p>
                    <p>Preis: $total_price €</p>
                    
                    <label for="ready">Bereit für Lieferung</label>
                    <input type="radio" id="ready" name="$ordering_id" value="3" $ready> <br />
                    
                    <label for="onTheWay">Auf dem Weg</label>
                    <input type="radio" id="onTheWay" name="$ordering_id" value="4" $onTheWay> <br />
                    
                    <label for="delivered">Ausgeliefert</label>
                    <input type="radio" id="delivered" name="$ordering_id" value="5" $delivered> <br />
                </fieldset>
            </article>
            END;
        }

        echo <<<END
			        </section>
			<input type="submit" value="Absenden" />
				</form>
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
    protected function processReceivedData():void
    {
        parent::processReceivedData();
        // to do: call processReceivedData() for all members
        if(isset($_POST)){
            if(count($_POST)) {
                //Key = ordering_id and value = status
                foreach ($_POST as $key => $value) {
                    $key = mysqli_real_escape_string($this->_database,strval($key));
                    $value = mysqli_real_escape_string($this->_database,strval($value));
                    $query = "UPDATE ordered_article SET status = $value WHERE ordering_id = $key";
                    $this->_database->query($query);
                }
                header("HTTP/1.1 303 See Other");
                header("Location: driver.php");
                die();
            }
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
    public static function main():void
    {
        try {
            $page = new Driver();
            $page->processReceivedData();
            $page->generateView();
        } catch (Exception $e) {
            //header("Content-type: text/plain; charset=UTF-8");
            header("Content-type: text/html; charset=UTF-8");
            echo $e->getMessage();
        }
    }
}

// This call is starting the creation of the page. 
// That is input is processed and output is created.
Driver::main();

// Zend standard does not like closing php-tag!
// PHP doesn't require the closing tag (it is assumed when the file ends). 
// Not specifying the closing ? >  helps to prevent accidents 
// like additional whitespace which will cause session 
// initialization to fail ("headers already sent"). 
//? >


