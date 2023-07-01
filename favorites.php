<?php
// Connect to the database
$host = "303.itpwebdev.com";
$user = "hrazzak_bball_user";
$pass = "Login123!!!";
$db = "hrazzak_bball";

// DB Connection.
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_errno) {
    echo $conn->connect_error;
    exit();
}

$sql = "SELECT f.player_name, t.team_name, c.conference_name, f.ppg, f.apg, f.rpg
            FROM favorites f
            JOIN teams t ON f.team_id = t.id
            JOIN conferences c ON f.conference_id = c.id";
$result = $conn->query($sql);

if (isset($_POST['delete_player'])) {

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
    $player_name = $_POST['player_name'];

    // Delete the row from the favorites table
    $delete_query = "DELETE FROM favorites WHERE player_name = '$player_name'";
    $delete_result = mysqli_query($mysqli, $delete_query);

    if ($delete_result) {
        // If the deletion was successful, return a success message
        echo "Row deleted successfully.";
    } else {
        // If the deletion was not successful, return an error message
        echo "Error deleting row.";
    }

    mysqli_close($mysqli);
}

// Query to fetch favorites data with team and conference names

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Favorites</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <meta name="description" content="">
    <meta name="keywords" content="web, page, HTML, CSS, JavaScript">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .delete-btn {
            color: white;
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .delete-btn:hover {
            color: white;
            background-color: #c82333;
            border-color: #bd2130;
            cursor: pointer;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
    </script>

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

    <div class="container mt-5">
        <h1>My Favorites</h1>

        <div class="dropdown float-right mr-2" style="margin-top: -50px;">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Sort by
            </button>
            <div class="dropdown-menu dropdown-menu-right mt-3" aria-labelledby="dropdownMenuButton"
                style="left: -50px;">
                <a class="dropdown-item" href="#" data-sort-by="name">Name</a>
                <a class="dropdown-item" href="#" data-sort-by="points">Points</a>
                <a class="dropdown-item" href="#" data-sort-by="rebounds">Rebounds</a>
                <a class="dropdown-item" href="#" data-sort-by="assists">Assists</a>
            </div>
        </div>



        <table id="myTable" class="table table-striped">
            <thead>
                <tr>
                    <th id="name-header">Player</th>
                    <th id="team-header">Team</th>
                    <th id="conference-header">Conference</th>
                    <th id="ppg-header">PPG</th>
                    <th id="apg-header">APG</th>
                    <th id="rpg-header">RPG</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php
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

                // Query the database for all favorite players
                $sql = "SELECT * FROM favorites";
                $results = mysqli_query($mysqli, $sql);

                while ($row = mysqli_fetch_assoc($results)) {
                    $team_query = "SELECT team_name FROM teams WHERE team_id = '" . $row['team_id'] . "'";
                    $team_result = mysqli_query($mysqli, $team_query);
                    $team_name = mysqli_fetch_assoc($team_result)['team_name'];

                    $conference_query = "SELECT conference_name FROM conference WHERE conference_id = '" . $row['conference_id'] . "'";
                    $conference_result = mysqli_query($mysqli, $conference_query);
                    $conference_name = mysqli_fetch_assoc($conference_result)['conference_name'];

                    echo "<tr>";
                    echo "<td><a href='player_stats.php?player=" . $row['player_name'] . "' style='font-weight:bold; color:black; cursor:pointer;'>" . $row['player_name'] . "</a></td>";
                    echo "<td>" . $team_name . "</td>";
                    echo "<td>" . $conference_name . "</td>";
                    echo "<td>" . $row['ppg'] . "</td>";
                    echo "<td>" . $row['apg'] . "</td>";
                    echo "<td>" . $row['rpg'] . "</td>";
                    echo "<td><button class='delete-btn' data-player='" . $row['player_name'] . "'>Delete</button></td>";
                    echo "</tr>";
                }

                mysqli_close($mysqli);
                ?>
            </tbody>
        </table>

        <?php
        // Close database connection
        $conn->close();
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.delete-btn', function () {
            var player = $(this).data('player');
            var row = $(this).closest('tr');

            $.ajax({
                url: 'favorites.php',
                type: 'POST',
                data: {
                    player_name: player,
                    delete_player: true
                },
                success: function (data) {
                    console.log(data);
                    row.remove();
                    alert('Favorite deleted!');
                },
                error: function () {
                    console.log('Error deleting favorite!');
                    alert('Error deleting favorite!');
                }
            });
        });

        $(document).ready(function () {
            // Code to run when the page has loaded
            console.log("The page has loaded!");
        });

        $('.dropdown-item').on('click', function () {
            // Get the selected option
            let sortBy = $(this).text().trim();

            // Sort table based on selected option
            if (sortBy === "Name") {
                sortTableByName();
            } else if (sortBy === "Points") {
                sortTableByPoints();
            } else if (sortBy === "Rebounds") {
                sortTableByRebounds();
            } else if (sortBy === "Assists") {
                sortTableByAssists();
            }
        });

        function sortTableByName() {
            console.log("Sort table by name function called!");
            // Get the table body element
            var tableBody = document.querySelector('tbody');

            // Get all table rows and convert to an array
            var rows = Array.prototype.slice.call(tableBody.rows);

            // Sort the rows alphabetically based on the player name
            rows.sort(function (a, b) {
                var nameA = a.cells[0].textContent.toUpperCase();
                var nameB = b.cells[0].textContent.toUpperCase();
                if (nameA < nameB) {
                    return -1;
                }
                if (nameA > nameB) {
                    return 1;
                }
                return 0;
            });

            // Append the sorted rows to the table body
            for (var i = 0; i < rows.length; i++) {
                tableBody.appendChild(rows[i]);
            }
        }

        function sortTableByPoints() {
            var table, rows, switching, i, x, y, shouldSwitch;
            table = $('#myTable')[0];
            switching = true;
            rows = $("#myTable tr");
            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = parseFloat(rows[i].getElementsByTagName("td")[3].innerHTML);
                    y = parseFloat(rows[i + 1].getElementsByTagName("td")[3].innerHTML);
                    if (x < y) {
                        shouldSwitch = true;
                        break;
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
        }

        function sortTableByRebounds() {
            var table, switching, i, x, y, shouldSwitch;
            table = $('#myTable')[0];
            switching = true;
            let rows = $("#myTable tr");
            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = parseFloat(rows[i].getElementsByTagName("td")[5].innerHTML);
                    y = parseFloat(rows[i + 1].getElementsByTagName("td")[5].innerHTML);
                    if (x < y) {
                        shouldSwitch = true;
                        break;
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
        }

        function sortTableByAssists() {
            var table, switching, i, x, y, shouldSwitch;
            table = $('#myTable')[0];
            switching = true;
            let rows = $("#myTable tr");
            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = parseFloat(rows[i].getElementsByTagName("td")[4].innerHTML);
                    y = parseFloat(rows[i + 1].getElementsByTagName("td")[4].innerHTML);
                    if (x < y) {
                        shouldSwitch = true;
                        break;
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
        }
    </script>

</body>

</html>