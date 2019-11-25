<?php
class Game {
    private $phrase;
    private $lives;

    //set the default object to phrase property
    function __construct($phrase){
        if(isset($phrase)){
            $this->phrase = $phrase;
        }
        $this->lives = 5;
    }

    //check if the phrase length is equal to the selected length
    public function checkForWin(){

        //trim and remove white space in the current phrase, get the unique value, count them
        $currentPhraseLength = count(
            array_unique(
                array_filter(
                    array_map(
                        'trim',
                        str_split(
                            $this->phrase->getCurrentphrase()
                        )
                    )
                )
            )
        );

        $currentSelectedLength = count($this->phrase->getCurrentselected());
        $currentSelectedCorrect = [];
        //echo $currentPhraseLength;

        foreach($this->phrase->getCurrentselected() as $selected){
            if($this->phrase->checkLetter($selected)){
                $currentSelectedCorrect[] = $selected;
            }
        }
        //echo count($currentSelectedCorrect);
        //check to see if the length of selected array matches the length of the phrase array, if does, which means win
        if($currentPhraseLength == count($currentSelectedCorrect)){
            return true;
        }else{
            return false;
        }
    }
    public function checkForLose(){
        //check if the lives eq 0, if does, the game over
        if($_SESSION['lives'] == 0){
            return true;
        }else{
            return false;
        }
    }

    //redirect to differnt page based on the result
    public function gameOver(){
        if($this->checkForWin()){
            header("Location: win.php");
        }else if($this->checkForLose()){
            header("Location: lose.php");
        }else{
            return false;
        }
    }

    public function displayKeyboard(){
        //check to see if the selected keys matches any in currentPhrase, if does, display the keyboard

        $keyRowOne = [
            'q','w','e','r','t','y','u','i','o','p'
        ];
        $keyRowTwo = [
            'a','s','d','f','g','h','j','k','l'
        ];
        $keyRowThree = [
            'z','x','c','v','b','n','m'
        ];

        //dynamic generate the page based on if the key is correct or not
        function key_row_render($phrase,$row,$lives){
            foreach($row as $key){
               
                if(
                    $phrase->checkLetter($key)
                    &&
                    in_array($key,$phrase->getCurrentselected())
                    ){
                        echo 
                            "
                                <input class='key correct' type='submit' name='key' value='$key' disabled />
                                
                            ";
                }else if(
                    (($phrase->checkLetter($key)) == false)
                    &&
                    in_array($key,$phrase->getCurrentselected())
                    ){

                        echo 
                            "
                                <input class='key incorrect' type='submit' name='key' value='$key' disabled />

                            ";
                }else{
                        echo 
                            "
                                <input class='key' type='submit' name='key' value='$key'/>
                            ";
                }
              }
              
        }

       
        echo "
        <form action='play.php' method='post'>
              <div id='qwerty' class='section'>";
              echo "<div class='keyrow'>";
              key_row_render($this->phrase,$keyRowOne,$this->lives);
              echo "</div>";

              echo "<div class='keyrow'>";
              key_row_render($this->phrase,$keyRowTwo,$this->lives);
              echo "</div>";

              echo "<div class='keyrow'>";
              key_row_render($this->phrase,$keyRowThree,$this->lives);
              echo "</div>";

        echo  "
            </div>
        </form>";
    }

    //display the scores based on how many lives left
    public function displayScore(){
        $lives = $_SESSION['lives'];
        
        echo "
            <div id='scoreboard' class='section'>
                <ol>";
                if(isset($_SESSION['lost'])){
                    $lost = $_SESSION['lost'];
                    for($i=0;$i<$lost;++$i){
                        echo "<li class='tries'><img src='images/lostHeart.png' height='35px' widght='30px'></li>";
                    }
                }
                for($i=0;$i<$lives;++$i){
                    echo "<li class='tries'><img src='images/liveHeart.png' height='35px' widght='30px'></li>";
                }
                " 
                </ol>
            </div>
        ";
    }

    public function getLives(){
        return $this->lives;
    }
}
?>