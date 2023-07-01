<?php

// Check if the request method is POST
if (isset($_POST['add_favorite'])) {

    // Connect to the database
    $host = "303.itpwebdev.com";
    $user = "hrazzak_bball_user";
    $pass = "Login123!!!";
    $db = "hrazzak_bball";

    // DB Connection.
    $mysqli = new mysqli($host, $user, $pass, $db);

    if ($mysqli->connect_errno) {
        echo $mysqli->connect_error;
        exit();
    }

    // get data from post request
    $player_id = $_POST['playerId'];
    $player_name = $_POST['player_name'];
    $team_name = $_POST['team'];
    $conference_name = $_POST['conference'];
    $ppg = $_POST['ppg'];
    $apg = $_POST['apg'];
    $rpg = $_POST['rpg'];

    $check_query = "SELECT COUNT(*) as count FROM favorites WHERE player_name = '$player_name'";
    $check_result = mysqli_query($mysqli, $check_query);
    $check_row = mysqli_fetch_assoc($check_result);
    $count = $check_row['count'];

    if ($count > 0) {
        echo "Player already exists in favorites list";
        http_response_code(500);
        exit();
    } else {
        // query to get team id
        $team_query = "SELECT team_id FROM teams WHERE team_name = '$team_name'";
        $team_result = mysqli_query($mysqli, $team_query);

        // check if team exists in the teams table
        if (mysqli_num_rows($team_result) > 0) {
            $team_row = mysqli_fetch_assoc($team_result);
            $team_id = $team_row['team_id'];

            // query to get conference id
            $conference_query = "SELECT conference_id FROM conference WHERE conference_name = '$conference_name'";
            $conference_result = mysqli_query($mysqli, $conference_query);

            // check if conference exists in the conferences table
            if (mysqli_num_rows($conference_result) > 0) {
                $conference_row = mysqli_fetch_assoc($conference_result);
                $conference_id = $conference_row['conference_id'];

                // insert data into favorites table
                $insert_query = "INSERT INTO favorites (playerId, player_name, conference_id, team_id, ppg, apg, rpg)
                           VALUES ($player_id, '$player_name', $conference_id, $team_id, $ppg, $apg, $rpg)";

                if (mysqli_query($mysqli, $insert_query)) {
                    // success message
                    echo "Added to favorites successfully";
                } else {
                    // error message
                    echo mysqli_error($mysqli);
                }
            } else {
                // error message
                echo "Conference not found in database";
            }
        } else {
            // error message
            echo "Team not found in database";
        }

        mysqli_close($mysqli);
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Player Search</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .favorite-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .favorite-btn:hover {
            background-color: #218838;
        }

        #topScore {
            border-collapse: collapse;
            border: 1px solid black;
            width: 50%;
        }

        #topScore th {
            background-color: gray;
            color: white;
            padding: 10px;
            text-align: left;
        }

        #topScore td {
            border: 1px solid black;
            padding: 10px;
        }
    </style>
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

    <div class="container">
        <div class="row">
            <h1 class="col-12 mt-4">Player Search</h1>
        </div> <!-- .row -->

        <div class="row">
            <form class="col-12" id="search-form">
                <div class="form-row">
                    <div class="col-12 mt-4 col-sm-6 col-lg-4">
                        <label for="search-term" class="sr-only">Search:</label>
                        <input type="text" class="form-control" id="search-term" placeholder="Search...">
                    </div>

                    <div class="col-12 mt-4 col-sm-auto">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div> <!-- .form-row -->
            </form>
        </div> <!-- .row -->
        <div class="row">
            <div class="col-12 mt-4">

                Showing <span id="num-results" class="font-weight-bold">0</span>
                result(s).

            </div>
            <div class="col-md-6">
                <table class="table table-responsive table-striped col-12 mt-3">
                    <thead>
                        <tr>
                            <!-- <th>Player Picture</th> -->
                            <th>Name</th>
                            <th>Team</th>
                            <th>Conference</th>
                            <th>PPG</th>
                            <th>APG</th>
                            <th>RPG</th>
                            <th>Favorite</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        </tr>
                    </tbody>
                </table>
            </div>


            <div class="col-md-6">
                <h1 style="font-size: 20px;">Current League Leaders in Scoring</h1>
                <table id="topScore">
                    <thead>
                        <tr>
                            <th>Player</th>
                            <th>Points</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script>
                $(document).ready(function () {
                    $.ajax({
                        url: "https://stats.nba.com/stats/leagueLeaders",
                        type: "GET",
                        data: {
                            "LeagueID": "00",
                            "PerMode": "PerGame",
                            "Scope": "S",
                            "Season": "2022-23",
                            "SeasonType": "Regular Season",
                            "StatCategory": "PTS"
                        },
                        success: function (response) {
                            let data = response.resultSet.rowSet.slice(0, 10);
                            let table = $("#topScore tbody");
                            $.each(data, function (index, player) {
                                let row = $("<tr>");
                                row.append($("<td>").text(player[2]));
                                row.append($("<td>").text(player[23]));
                                table.append(row);
                            });
                        }
                    });
                });
            </script>

        </div> <!-- .row -->
    </div> <!-- .container -->

    <script src="http://303.itpwebdev.com/~hannah/itp303/math.js"></script>
    <script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        document.querySelector('#search-form').onsubmit = function () {
            console.log("Inside submit")

            document.querySelector("#num-results").innerHTML = ''

            const name = document.querySelector('#search-term').value.trim();
            // const limit = document.querySelector('#search-limit').value.trim();

            const endpoint = "https://www.balldontlie.io/api/v1/players?search=" + name
            if (name === "") {
                endpoint = "https://www.balldontlie.io/api/v1/players?team_ids[]=14"
            }

            $.ajax({
                url: endpoint,
                method: 'GET',
                dataType: 'json',
                success: function (data) {

                    document.querySelector('tbody').innerHTML = ''

                    var count = 0
                    for (let i = 0; i < data.data.length; i++) {
                        checkStats(data.data[i].id, function (stats) {
                            console.log(stats);
                            if (stats.data.length > 0) {
                                var pts = stats.data[0].pts;
                                var ast = stats.data[0].ast;
                                var reb = stats.data[0].reb;
                                createRow(data.data[i], pts, ast, reb, data.data[i].first_name, data.data[i].last_name, data.data[i].team.conference, data.data[i].team.full_name, data.data[i].id);
                                count++;
                                document.querySelector("#num-results").innerHTML = count
                            }
                        });
                    }

                },
                error: function (e) {
                    alert("AJAX error")
                    console.log(e)
                }
            })


            return false;
        }

        function checkStats(playerId, callback) {
            var processedData =
                $.ajax({
                    url: "https://www.balldontlie.io/api/v1/season_averages?season=2022&player_ids[]=" + playerId,
                    method: 'GET',
                    data: processedData,
                    success: function (data) {
                        if (callback) {
                            callback(data);
                        }
                    },
                    error: function () {
                        console.log('Error getting data from API');
                        if (callback) {
                            callback(null);
                        }
                    }
                });
        }

        function createRow(player, ppg, apg, rpg, playerFirstName, playerLastName, playerConf, playerTeam, playerId) {
            console.log("CREATING ROW")
            var tr = document.createElement('tr');
            var tdPicture = document.createElement('td');
            var tdName = document.createElement('td');
            var tdTeam = document.createElement('td');
            var tdConference = document.createElement('td');
            var tdPPG = document.createElement('td');
            var tdAPG = document.createElement('td');
            var tdRPG = document.createElement('td');
            var tdFavorite = document.createElement('td');
            var favoriteButton = document.createElement('button');
            // var img = document.createElement('img');

            tdName.innerHTML = player.first_name + " " + player.last_name;
            tdTeam.innerHTML = player.team.full_name;
            tdConference.innerHTML = player.team.conference;
            tdPPG.innerHTML = ppg;
            tdAPG.innerHTML = apg;
            tdRPG.innerHTML = rpg;

            // img.src = track.artworkUrl100; // todo: Fill Out Info
            // img.alt = track.collectionName + " Cover";

            favoriteButton.innerHTML = 'Favorite'; // set favorite button text
            favoriteButton.onclick = function () {
                addFavorite(player, ppg, apg, rpg, playerFirstName, playerLastName, playerConf, playerTeam, playerId);
            };

            favoriteButton.classList.add('favorite-btn');

            tdFavorite.appendChild(favoriteButton);

            tr.appendChild(tdName);
            tr.appendChild(tdTeam);
            tr.appendChild(tdConference);
            tr.appendChild(tdPPG);
            tr.appendChild(tdAPG);
            tr.appendChild(tdRPG);
            tr.appendChild(tdFavorite);

            document.querySelector('tbody').appendChild(tr);
        }

        function addFavorite(player, ppg, apg, rpg, playerFirstName, playerLastName, playerConf, playerTeam, playerId) {
            $.ajax({
                url: 'search.php',
                type: 'POST',
                data: {
                    playerId: playerId,
                    player_name: playerFirstName + " " + playerLastName,
                    team: playerTeam,
                    conference: playerConf,
                    ppg: ppg,
                    apg: apg,
                    rpg: rpg,
                    add_favorite: true
                },
                success: function (data) {
                    console.log(data);
                    if (data.error) {
                        alert(data.error);
                    } else {
                        alert('Added to favorites!');
                    }
                },
                error: function () {
                    alert("Player already exists in favorites list");
                    console.log('Error adding to favorites!');
                }
            });
        }   
    </script>
</body>

</html>