<?php
class Phrase {
    private $currentPhrase;
    private $selected = []; 
    public $availablePhrases = [
        "I love my puppy",
        "I love startbucks",
        "Knowledge is power",
        "Simplicity is the soul of efficiency",
        "My dog loves me",
        "Black coffee is the best",
        "Never give up your dream",
        "I AM A DOG PERSON",
        "May the force be with you"
    ];
    function __construct($phrase=NULL, $selected=NULL){
        //set a random phrase to currentP if the phrase not set yet
        if(isset($phrase)){
            $this->currentPhrase = strtolower($phrase);
        }else{
            $this->currentPhrase = strtolower(
                (
                    $this->availablePhrases[array_rand($this->availablePhrases)]
                )
            );
        }

        //set the selected key to the selected array
        if(isset($selected)){
            $this->selected = $selected;
        }
    }
    public function addPhraseToDisplay(){
        //split the string into array and place each of them into the html list 
        $splitedPhrase = str_split($this->currentPhrase);

        //check to see if the single phrase is in selected array, if does, display the phrase with show, else hide
        echo "
            <div id='phrase' class='section'>
            ";
            foreach($splitedPhrase as $phrase){
                if($phrase == " "){
                    echo "
                        <ul>
                            <li class='hide space'>$phrase</li>
                        </ul>";
                }else if(in_array($phrase, $this->selected)){
                    echo "
                        <ul>
                            <li class='show letter $phrase'>$phrase</li>
                        </ul>";
                }else{
                    echo "
                        <ul>
                            <li class='hide letter $phrase'>$phrase</li>
                        </ul>";
                }
                
            }
        echo "
            </div>
        ";
    }

    public function checkLetter($letter){
        //if in the selected array, there is one selected value included in the currentPhrase, the return true
        $splitedPhrase = str_split($this->currentPhrase);
        if(in_array($letter, $splitedPhrase)){
            return true;
        }else{
            return false;
        }
    }

    public function getCurrentphrase(){
        return $this->currentPhrase;
    }
    
    public function getCurrentselected(){
        return $this->selected;
    }
}

?>