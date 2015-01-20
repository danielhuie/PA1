<?php
	include "player.php";
	include "playerDB.php";

	$connection = new PDO('mysql:host=mydbinstance.cpruc60m73ez.us-west-2.rds.amazonaws.com;dbname=info344', 'info344user', 'passw0rd'); 
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$playersList = array();
	$numPlayersQueried = 0;
	$searchNotFound = false;

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

			if ($numPlayersQueried === 0) {
				$searchNotFound = true;
			}
		} catch(PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
		}
	}
?>

<html>
	<head>
		<title>PA 1</title>

		<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/site.css">
	</head>
	<body>
		<div class="container main">
			<h1 class="main-title">NBA Search For Yo' Playa!</h1>
				<div class="center">
					<img id="header-logo" src="img/nba-logo.jpg">	
				</div>
				<br>

				<div class="container center">
					<center>
						We love basketball but there’s no easy way to search NBA player stats! So let’s make our own! We found <a href="http://stats.nba.com/players.html">http://stats.nba.com/players.html</a>
						(Links to an external site.) but actually, try typing in “lebron” and press “Run It”, yuck! It doesn’t work. We can totally make a better one in a few days.
					</center>

					<!-- must clear form on-load -->
					<form action='' method='post'>
						<div class="input-group">
							<span class="input-group-addon" id="sizing-addon2">NBA</span>
							<input type="text" class="form-control" name="search" placeholder="Search for a player..." aria-describedby="sizing-addon2">
							<span class="input-group-btn">
								<button type="submit" class="btn btn-default">Search</button>
							</span>				
						</div>
					</form>

					<?php if(!isset($_REQUEST['search']) || $_REQUEST['search'] === '' || $searchNotFound) : ?>
						<h4>No search results to display. Please enter a query...</h4>
					<?php else : ?>
						<h5 class="count">
							<strong><?php echo 'Number of Players Searched: ' . $numPlayersQueried?></strong>
						</h5>
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Player Name</th>
									<th>Games Played</th>
									<th>Field Goal Percentage</th>
									<th>Three Point Percentage</th>
									<th>Free Throw Percentage</th>
									<th>Points Per Game</th>
								</tr>
							</thead>
					    	<?php foreach($playersList as $player): ?>
					    	<tbody>
					    		<tr>
						        <td><?php echo $player->GetPlayerName();?></td>
						        <td><?php echo $player->GetGP();?></td>
						        <td><?php echo $player->GetFGP();?></td>
					        	<td><?php echo $player->GetTPP();?></td>
					        	<td><?php echo $player->GetFTP();?></td>
					        	<td><?php echo $player->GetPPG();?></td>
						      </tr>
					    	</tbody>
						    <?php endforeach; ?>
						</table>
					<?php endif; ?>
				</div>
			</body>
		</div>
		
</html>