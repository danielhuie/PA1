<!-- make sure db allows nulls for certain fields -->
<?php 
	$connection = new PDO('mysql:host=mydbinstance.cpruc60m73ez.us-west-2.rds.amazonaws.com;dbname=info344', 'info344user', 'passw0rd'); 
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$playersList = array();
	$numPlayersQueried = 0;

	if (isset($_REQUEST['search']) && $_REQUEST['search'] !== '') {
		$search = $_REQUEST['search'];
		try {
			$myQuery = "SELECT * FROM NBA where PlayerName LIKE '%{$search}%' ORDER BY PlayerName ASC";
			$searchQuery = $connection->prepare($myQuery);
			$searchQuery->execute();

	 		foreach($searchQuery as $player) {
				$numPlayersQueried++;
				array_push($playersList, new Player($player['PlayerName'], $player['GP'], $player['FGP'], $player['TPP'], $player['FTP'], $player['PPG']));
			}
		} catch(PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
		}
	}
?>