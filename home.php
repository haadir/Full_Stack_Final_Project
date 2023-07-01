<!DOCTYPE html>
<html lang="en">
<head>
  <title>MyNBA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
  .fakeimg {
    height: 200px;
    background: #aaa;
  }

  #me {
    width:100%;
    height:auto;
  }

  #medina {
    width:100%;
    height:auto;
  }

  #quran {
    width:100%;
    height:auto;
  }
  </style>
</head>
<body>

<div class="jumbotron text-center" style="margin-bottom:0">
  <h1>MyNBA</h1>
  <p>A web page to that tracks player data and play trivia</p> 
</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="background-color: #013220;">
  <a class="navbar-brand" href="#">Home</a>
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

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-4">
      <h2>About Me</h2>
      <h5>Photo of me:</h5>
      <img src="img/me.jpeg" id="me" alt="me">
      <p>I am a student at the University of Southern California studying Computer Science.
        I am currently taking ITP-303 and this is my final project. I intend on making a website
        that allows you access stats on all current players. There is a favorites, search, and trivia page.
      </p>
      
      
      <hr class="d-sm-none">
    </div>
    <div class="col-sm-8">
      <h2>MyNBA Beta</h2>
      <h5>NBA on the Rise</h5>
      <img src="img/best-nba-players-ever.jpg" id="medina" alt="medina">
      <p>Basketball is gaining popularity around the world.</p>
      <p>With the rise of international players making it the NBA, the amount of viewership has increased.
        This website is intended for helping making learn about players easier and compare how good they are statistically.
      </p>
      <br>
      <h2>Potential Future Features</h2>
      <h5>Apr 15, 2023</h5>
      <img src="img/5v5.jpg" id="quran" alt="quran">
      <p>Coming Soon...</p>
      <p>NBA Trivia.</p>
    </div>
  </div>
</div>

<div class="jumbotron text-center" style="margin-bottom:0">
  <p>Haadi Razzak ITP-303</p>
</div>

</body>
</html>
