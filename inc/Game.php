<?php
class Game {
    private $phrase;
    private $lives;
    function __construct($phrase){
        if(isset($phrase)){
            $this->phrase = $phrase;
        }
    }
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
       
        echo $currentPhraseLength;
        echo $currentSelectedLength;

        //check to see if the length of selected array matches the length of the phrase array, if does, which means win
        if($currentPhraseLength == $currentSelectedLength){
            return true;
        }else{
            return false;
        }

    }
    public function checkForLose(){

    }
    public function gameOver(){

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

        function key_row_render($phrase,$row){
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
                    var_dump($phrase->checkLetter($key));
                    var_dump(in_array($key,$phrase->getCurrentselected()));
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

        echo $this->phrase->getCurrentphrase();
        var_dump($this->phrase->getCurrentselected());

        echo "
        <form action='play.php' method='post'>
              <div id='qwerty' class='section'>";
              echo "<div class='keyrow'>";
              key_row_render($this->phrase,$keyRowOne);
              echo "</div>";

              echo "<div class='keyrow'>";
              key_row_render($this->phrase,$keyRowTwo);
              echo "</div>";

              echo "<div class='keyrow'>";
              key_row_render($this->phrase,$keyRowThree);
              echo "</div>";

        echo  "
            </div>
        </form>";
    }
    public function displayScore(){
        return "
            <div id='scoreboard' class='section'>
                <ol>
                    <li class='tries'><img src='images/liveHeart.png' height='35px' widght='30px'></li>
                    <li class='tries'><img src='images/liveHeart.png' height='35px' widght='30px'></li>
                    <li class='tries'><img src='images/liveHeart.png' height='35px' widght='30px'></li>
                    <li class='tries'><img src='images/liveHeart.png' height='35px' widght='30px'></li>
                    <li class='tries'><img src='images/liveHeart.png' height='35px' widght='30px'></li>
                </ol>
            </div>
        ";
    }
}
?>