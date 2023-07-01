<!DOCTYPE html>
<html>

<head>
    <title>Player Stats</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <meta name="description" content="More player stats provided such as position, height, and weight.">
    <meta name="keywords" content="NBA, player, height, weight, position">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            background-color: #f2f2f2;
            margin: 0 auto;
            max-width: 500px;
            padding: 20px;
        }

        h1 {
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            font-size: 18px;
            margin-bottom: 5px;
        }

        img {
            width: 5%;
            height: 5%;
        }

        .back-btn {
            margin-bottom: -30px;
        }
    </style>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

    </script>


    <div class="container">
        <div class="card">
            <?php
            // Retrieve the player name from the URL
            $player_name = $_GET['player'];

            $host = "303.itpwebdev.com";
            $user = "hrazzak_bball_user";
            $pass = "Login123!!!";
            $db = "hrazzak_bball";

            // DB Connection.
            $mysqli = new mysqli($host, $user, $pass, $db);

            // Query the database to retrieve the stats of the selected player
            $query = "SELECT ppg, apg, rpg, team_id FROM favorites WHERE player_name = '$player_name'";
            $result = mysqli_query($mysqli, $query);
            $row = mysqli_fetch_assoc($result);

            $team_query = "SELECT team_name FROM teams WHERE team_id = '" . $row['team_id'] . "'";
            $team_result = mysqli_query($mysqli, $team_query);
            $team_name = mysqli_fetch_assoc($team_result)['team_name'];

            $query1 = "SELECT playerId FROM favorites WHERE player_name = '$player_name'";
            $result1 = mysqli_query($mysqli, $query1);
            $row1 = mysqli_fetch_assoc($result1);
            
            // Retrieve the playerId from the query result
            $player_id = $row1['playerId'];
            $endpoint = "https://www.balldontlie.io/api/v1/players/$player_id";
            $data = file_get_contents($endpoint);
            $player_data = json_decode($data, true);
            $position = $player_data['position'];
            $height1 = $player_data['height_feet'];
            $height2 = $player_data['height_inches'];
            $weight = $player_data['weight_pounds'];

            // Display the player's stats
            echo "<a href='favorites.php'><img src='img/back_button.png' alt='Back button'></a>";
            echo "<h1>$player_name's Stats</h1>";
            echo "<p>Team Name: " . $team_name . "</p>";
            echo "<p>Points Per Game: " . $row['ppg'] . "</p>";
            echo "<p>Assists Per Game: " . $row['apg'] . "</p>";
            echo "<p>Rebounds Per Game: " . $row['rpg'] . "</p>";
            echo "<p>Position: $position</p>";
            echo "<p>Height: $height1'$height2''</p>";
            echo "<p>Weight: $weight</p>";

            ?>
        </div>
    </div>
</body>

</html>