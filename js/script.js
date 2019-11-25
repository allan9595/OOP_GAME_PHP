
//get all the key element, check if keyboard press equals to one of the screen key
//if does, then use click() to click the on screen key
function keyPress(e){
    let key = document.querySelectorAll('.key');
    key.forEach(function(element,index){
        if(element.value == e.key){
            key[index].click();
        }
    });
}
let result = document.addEventListener('keypress',keyPress);
