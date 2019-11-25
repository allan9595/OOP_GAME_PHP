<?php
    //start session to store phrase and selected keys and pass them to the Phrase object for env
    session_start();
    include('inc/Phrase.php');
    include('inc/Game.php');

    if(filter_input(INPUT_POST, 'key', FILTER_SANITIZE_STRING) !== NULL){
        $_SESSION['selected'][] = filter_input(INPUT_POST, 'key', FILTER_SANITIZE_STRING);
    }

    if(isset($_SESSION['phrase']) && isset($_SESSION['selected'])){
        $phrase = new Phrase($_SESSION['phrase'],$_SESSION['selected']);
    }else{
        $phrase = new Phrase(NULL,NULL);
    }

    $_SESSION['phrase'] = $phrase->getCurrentphrase();
   
    $game = new Game($phrase);

    //set the default lives to lives sessions
    
    $_SESSION['lives'] = $game->getLives();
    
    //anti-cheating manchanism
    $_SESSION['check_win_status'] = $game->checkForWin();

    if(count($phrase->getCurrentselected()) !== 0){
         //get the incorrect letters from selected then set it to the live_session
        $incorrectSelected = [];
        foreach($phrase->getCurrentselected() as $value){
            if($phrase->checkLetter($value) == false){
                $incorrectSelected[] = $value;
            }
        }
        $_SESSION['lives'] = $_SESSION['lives'] - count($incorrectSelected);
        $_SESSION['lost'] = count($incorrectSelected);
    }  
?>
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

    <body>
        <div class="main-container">
            <div id="banner" class="section">
                <h2 class="header">Phrase Hunter</h2>
            </div>
            <?php
                $game->gameOver();
                $phrase->addPhraseToDisplay();
                $game->displayKeyboard();
                $game->displayScore();
            ?>
        </div>
        <script src="js/script.js"></script>
    </body>
</html>
