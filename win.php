<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Phrase Hunter</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/styles.css?version=51" rel="stylesheet">
		<link href="css/animate.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	</head>

	<body class="win">
		<div class="main-container win">
			<h2 class="header">Phrase Hunter</h2>
            <?php
				session_start();
				
				//anti-cheating manchanism
				////if the user attempt to diectly go to win.php, redirect them to nocheating page

				if($_SESSION['check_win_status'] == false){
					header('Location: nocheating.php');
				}elseif(isset($_SESSION['phrase'])){
					echo "<h1 id='game-over-message'>Congratulations on guessing: $_SESSION[phrase]</h1>";
					session_destroy();
                }else{
					echo "<h1 id='game-over-message'>Oops..You refreshed page! Click to play again!</h1>";
					session_destroy();
                }
                
            ?>
            <form action="play.php" method="post">
                <input id="btn__reset" type="submit" value="Play Again" />
            </form>
		</div>
	</body>
</html>