<?php declare(strict_types=1);
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
	class PageTemplate extends Page
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
			#TODO: Ordering ID will be given over session
			$givenid="17";
			$orderingid=mysqli_real_escape_string($this->_database,$givenid);
			$query = "SELECT a.status, a2.name FROM ordered_article as a
						JOIN article as a2 ON a2.article_id=a.article_id
						WHERE ordering_id='$orderingid'";
			$records = $this->_database->query($query)->fetch_all();
			return $records;
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
			echo <<<END
                <!DOCTYPE html>
                <html lang='de'>
                <head>
                    <meta charset='utf-8'>
                    <!-- für später: CSS include -->
                    <!-- <link rel="stylesheet" href="XXX.css"/> -->
                    <!-- für später: JavaScript include -->
                    <!-- <script src="XXX.js"></script> -->
                    <title>Kunde</title>
                </head>
                <body>
                    <section>
                        <h1>Deine Bestellung:</h1>
END;
			/*
		  O = Ordered
		  1 = in Oven
		  2 = done
		  3 = ready for delivery
		  4 = on the way
		  5 = delivered
	  */
                foreach($data as $row) {
					$status=htmlspecialchars($row[0]);
					$pizza=htmlspecialchars($row[1]);
					$statusDisplayname="error";
					switch ($status) {
						case 0:
							$statusDisplayname="Bestellt";
							break;
						case 1:
							$statusDisplayname="Im Backofen";
							break;
						case 2:
							$statusDisplayname="Useless";
							break;
						case 3:
							$statusDisplayname="bereit zu lieferung";
							break;
						case 4:
							$statusDisplayname="auf dem weg";
							break;
						case 5:
							$statusDisplayname="geliefert";
							break;
					}
					
					
					echo <<<END
                            <p>$pizza: $statusDisplayname</p>
END;
				}
					echo <<<END
                    </section>
                
                    <input type="button" value="Neue Bestellung" />
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
				$page = new PageTemplate();
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
	PageTemplate::main();

// Zend standard does not like closing php-tag!
// PHP doesn't require the closing tag (it is assumed when the file ends).
// Not specifying the closing ? >  helps to prevent accidents
// like additional whitespace which will cause session
// initialization to fail ("headers already sent").
//? >
