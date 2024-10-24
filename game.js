var buttonColours = ["red", "blue", "green", "yellow"];
var gamePattern = [];
var userClickedPattern = [];
var level = 0;
var gameStarted = false; 

// Button click event handler
$(".btn").on("click", function() {
  var userChosenColour = $(this).attr("id");  // Get the id of the clicked button

  // Flash the clicked button
  animatePress(userChosenColour);
  
  playSound(userChosenColour);  // Play the corresponding sound
  animatePress(userChosenColour);  // Animate the button press
  
  userClickedPattern.push(userChosenColour);  // Add the clicked color to the userClickedPattern
  
  // Check the user's answer after the button click
  checkAnswer(userClickedPattern.length - 1);
});


//Detect keypress to start the game
$(document).keypress(function(){
  if(!gameStarted){
    gameStarted = true;
    $("#level-title").text("Level " + level);
    nextSequence()
  }
})


// Function to play sound based on the name provided
function playSound(name) {
  var audio = new Audio('./sounds/' + name + '.mp3');  
  audio.play();
}

// Function to generate the next sequence
function nextSequence() {
  userClickedPattern=[]
  level++;

  $("#level-title").text("Level " + level);

  var randomNumber = Math.floor(Math.random() * 4);  // Generate a random number from 0 to 3
  var randomChosenColour = buttonColours[randomNumber];
  
  gamePattern.push(randomChosenColour);  // Add the selected color to the game pattern

  $("#" + randomChosenColour).fadeIn(100).fadeOut(100).fadeIn(100);
  playSound(randomChosenColour);

}

function checkAnswer(currentLevel){
  if(gamePattern[currentLevel] === userClickedPattern[currentLevel]){
    console.log("success");

    if(userClickedPattern.length === gamePattern.length ){
      setTimeout(function(){
        nextSequence();
      },1000);
    }
  } else{
    console.log("wrong");
    //1. In the sounds folder, there is a sound called wrong.mp3, play this sound if the user got one of the answers wrong.
    playSound("wrong");


    //2. In the styles.css file, there is a class called "game-over", apply this class to the body of the website when the user gets one of the answers wrong and then remove it after 200 milliseconds.
    
    $("body").addClass("game-over");
      setTimeout(function () {
        $("body").removeClass("game-over");
      }, 200);


    //3. Change the h1 title to say "Game Over, Press Any Key to Restart" if the user got the answer wrong.
    $("#level-title").text("Game Over, Press Any Key to Restart");
    startOver();

    
  }

}

function startOver(){
  level = 0;
  gamePattern=[];
  gameStarted=false

}



// Function to animate the button press
function animatePress(currentColour) {
  $("#" + currentColour).addClass("pressed");  // Add the "pressed" class to the clicked button
  setTimeout(function() {
    $("#" + currentColour).removeClass("pressed");  // Remove the "pressed" class after 100ms
  }, 100);
}

