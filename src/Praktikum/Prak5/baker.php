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
	class Baker extends Page
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
			$query = "SELECT a.ordering_id, a2.name, a.ordered_article_id, a.status FROM ordered_article as a
    				JOIN article as a2 ON a2.article_id=a.article_id
    				WHERE a.status<4";
			$records = $this->_database->query($query);
            $result = $records->fetch_all();
            $records->free();
			return $result;
		}
		
		/**
		 * First the required data is fetched and then the HTML is
		 * assembled for output. i.e. the header is generated, the content
		 * of the page ("view") is inserted and -if available- the content of
		 * all views contained is generated.
		 * Finally, the footer is added.
		 * @return void
		 */
		protected function generateView(): void
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
					<title>Bäcker</title>
				</head>
				<body>

					<form method="post" id="form11">
						<section>
							<h1>Bestellte Pizzen:</h1>
				END;
			
			foreach($data as $row) {
				// TODO: Fix HTML-Lint & order grouping
				$ordering_id=htmlspecialchars($row[0]);
				$name=htmlspecialchars($row[1]);
				$ordered_article_id =htmlspecialchars($row[2]);
				$status =htmlspecialchars($row[3]);
				$statusDisplayname1="";
				$statusDisplayname2="";
				$statusDisplayname3="";
				switch ($status) {
					case 0:
						$statusDisplayname1="checked";
						break;
					case 1:
						$statusDisplayname2="checked";
						break;
					case 2:
						$statusDisplayname=""; //useless
						break;
					case 3:
						$statusDisplayname3="checked";
						break;
				}
				
				echo <<<END
				 <article>
					<fieldset name='$ordering_id'>
						<h2>Bestellung $ordering_id $name</h2>
						
						<label for="bestellt$ordered_article_id">Bestellt</label>
						<input type="radio" id="bestellt$ordered_article_id" name="$ordered_article_id" value="0" $statusDisplayname1 onclick="document.forms['form11'].submit();"> <br />
						
						<label for="inOven$ordered_article_id">Im Ofen</label>
						<input type="radio" id="inOven$ordered_article_id" name="$ordered_article_id" value="1" $statusDisplayname2 onclick="document.forms['form11'].submit();"> <br />
						
						<label for="done$ordered_article_id">Fertig</label>
						<input type="radio" id="done$ordered_article_id" name="$ordered_article_id" value="3" $statusDisplayname3 onclick="document.forms['form11'].submit();"> <br />
					</fieldset>
				</article>
				END;
			}
			echo <<<END
			        </section>
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
		protected function processReceivedData(): void
		{
			parent::processReceivedData();
			if(count($_POST)) {
				//Key = ordering_id and value = status
				foreach ($_POST as $key => $value) {
					$key = mysqli_real_escape_string($this->_database,strval($key));
					$value = mysqli_real_escape_string($this->_database,strval($value));
					$query = "UPDATE ordered_article SET status = $value WHERE ordered_article_id = $key";
					$this->_database->query($query);
				}
				header("HTTP/1.1 303 See Other");
				header("Location: baker.php");
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
				$page = new Baker();
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
	Baker::main();
	
	// Zend standard does not like closing php-tag!
	// PHP doesn't require the closing tag (it is assumed when the file ends).
	// Not specifying the closing ? >  helps to prevent accidents
	// like additional whitespace which will cause session
	// initialization to fail ("headers already sent").
	//? >