<?php
    include('inc/Phrase.php');
    include('inc/Game.php');

    //start session to store phrase and selected keys and pass them to the Phrase object for env
    session_start();

    if(filter_input(INPUT_POST, 'key', FILTER_SANITIZE_STRING) !== NULL){
        $_SESSION['selected'][] = filter_input(INPUT_POST, 'key', FILTER_SANITIZE_STRING);
    }

    if(isset($_SESSION['phrase']) && isset($_SESSION['selected'])){
        $test = new Phrase($_SESSION['phrase'],$_SESSION['selected']);
    }else{
        $test = new Phrase(NULL,NULL);
    }

    $_SESSION['phrase'] = $test->getCurrentphrase();

    $game = new Game($test);
   
     var_dump($_SESSION['phrase']);
     //var_dump($_SESSION['selected']);
    // var_dump($test->getCurrentphrase());
     var_dump($test->getCurrentselected());
    // var_dump($test->checkLetter('a'));
    //var_dump($test->addPhraseToDisplay());

    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Phrase Hunter</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/styles.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    </head>

    <body>
        <div class="main-container">
            <div id="banner" class="section">
                <h2 class="header">Phrase Hunter</h2>
            </div>
            <?php
                $test->addPhraseToDisplay();
                $game->displayKeyboard();
                echo $game->displayScore();
                $game->checkForWin();
            ?>
        </div>
    </body>
</html>
