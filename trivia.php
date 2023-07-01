<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>NBA Trivia Game</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <meta name="description" content="NBA Trivia. You are given 4 guesses and 3 hints to guess the NBA player!">
  <meta name="keywords" content="NBA, guess, trivia">
</head>

<body>

  <nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="background-color: #013220;">
    <a class="navbar-brand" href="home.php">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="search.php">Search</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="favorites.php">Favorites</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="trivia.php">Trivia</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container my-5">
    <div class="row">
      <div class="col-md-8 mx-auto text-center">
        <h1 class="mb-4">NBA Trivia Game</h1>
        <p class="lead mb-5">Can you guess the NBA player with these hints?</p>

        <div class="card p-3 mb-4">
          <h5 class="card-title mb-4">Hints</h5>
          <div id="triviaHints">
            <p class="card-text">Hint #1: This player is a professional basketball player and plays in the NBA.</p>
          </div>
        </div>

        <div class="form-group">
          <input type="text" class="form-control" id="userGuess" placeholder="Enter your guess">
        </div>

        <button type="button" class="btn btn-primary mt-4" id="submitGuess">Submit</button>

        <button type="button" class="btn btn-primary mt-4" id="revealAnswer">Reveal Answer</button>

        <div class="mt-5" id="guessResult"></div>

      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha384-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>

    $(document).ready(function () {
      // array to store the top 50 player names
      var top50Players = [];

      // make an AJAX request to the API to get the top 50 players by points per game
      $.ajax({
        url: "https://stats.nba.com/stats/leagueLeaders?LeagueID=00&PerMode=PerGame&Scope=S&Season=2022-23&SeasonType=Regular+Season&StatCategory=PTS&top_n=50",
        type: "GET",
        dataType: "json",
        success: function (data) {
          // extract the player names from the API response and store them in the top50Players array
          for (var i = 0; i < 50; i++) {
            top50Players.push(data["resultSet"]["rowSet"][i][2]);
          }

          var randomNum = Math.floor(Math.random() * 50);
          var randomPlayer = top50Players[randomNum];
          //CORRECT ANSWER CONSOLE LOGGED
          console.log(randomPlayer);

          var positionHint = "";
          var pointsHint = "";
          var teamHint = "";
          var numGuesses = 0;

          $("#submitGuess").on("click", function () {
            // get the user's guess
            var userGuess = $("#userGuess").val();

            // compare the user's guess to the random player
            if (userGuess.toLowerCase() === randomPlayer.toLowerCase()) {
              $("#guessResult").text("Correct! It was " + randomPlayer);
            } else {
              numGuesses++;
              if (numGuesses === 1) {
                // show the rebound hint
                positionHint = data["resultSet"]["rowSet"][randomNum][19];
                $("#triviaHints").append("<p class='card-text'>Hint #2: This player averages " + positionHint + " rebounds per game.</p>");
              } else if (numGuesses === 2) {
                // show the points hint
                pointsHint = data["resultSet"]["rowSet"][randomNum][23];
                $("#triviaHints").append("<p class='card-text'>Hint #3: This player averages " + pointsHint + " points per game.</p>");
              } else if (numGuesses === 3) {
                // show the team hint
                teamHint = data["resultSet"]["rowSet"][randomNum][4];
                $("#triviaHints").append("<p class='card-text'>Hint #4: This player plays for " + teamHint + ".</p>");
              } else {
                // out of hints, show the answer
                $("#guessResult").text("Game over! The answer was " + randomPlayer);
              }
            }
          });

          $("#revealAnswer").on("click", function () {
            $("#triviaHints").empty();
            $("#triviaHints").append("<p class='card-text'>The answer was " + randomPlayer + ".</p>");
          });

        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
      });

    });

  </script>

</body>