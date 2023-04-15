<?php
include 'Header.html';
$uid = 1;
echo ' <h1>Игра</h1>';
echo '
<form action="endGame.php" method="post">
<input type="hidden" id="points" name="points" value="0">
<input type="hidden" id="multi" name="multi" value="0">
<input type="submit" name="submit" value="Вывести">
</form>
<h1 id="counter">0</h1>
<h2 id="mult">X1</h2>
<div id="cube" onclick="action()" style="  background-color: red;width: 100px; height: 100px;"></div>
<span>

</span>
<script>
var points = document.getElementById("points");
var multi = document.getElementById("multi");
var colors = ["gray", "green", "blue", "purple", "gold"];
var counter = 0; 
var pointsMult = 0;
var color = 0;
    var chanell = "https://www.youtube.com/@user-rt3my2dl6z/videos"
    function action() {
    counter ++  
    if (counter%500 == 0){
        if (getRandomInt(2) == 1){
            if (confirm("Сбросить ваши очки ?")) {
                counter = 0;
                pointsMult = 0;
                color = 0;
            }else {
                if (confirm("Перейти на след. уровень?")) {
            pointsMult++;
            counter = 0;
            color ++
            if (color>4){
                color = 0;
            }
          }
          }
        }else {
            if (confirm("Перейти на след. уровень?")) {
            pointsMult++;
            counter = 0;
            color ++
            if (color>4){
                color = 0;
            }
          }
        }
    }
   var h1 = document.getElementById("counter");
        points.value = counter;
      h1.innerHTML = "Очки: "+counter;  
    var h2 = document.getElementById("mult");
    h2.innerHTML = "X" + pointsMult;
    multi.value = pointsMult;
   var counter2 = counter + 5;
    document.getElementById("cube").style = "width:"+ counter2 + "px; background-color: "+colors[color]+"; height:"+ counter2 +"px";
     
    }
    
    function getRandomInt(max) {
  return Math.floor(Math.random() * max);
}

</script>
';