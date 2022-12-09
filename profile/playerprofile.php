<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name=" viewport " content=" width = device-width, initial-scale = 1 ">
    <title>Document</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
          integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">

    <!-- Style CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/player_profile.css">

    <meta name="theme-color" content="#fafafa">

    <style type="text/css">
        <?php include ('../css/player_profile.css'); ?>
    </style>

</head>
<body>
<main style="padding-right: 10vw; padding-left: 10vw">
    <nav class="navbar navbar-expand-md navbar-light justify-content-center fixed-top" style="background-color: blue">
        <a class="navbar-brand d-flex col-sm-4 mr-auto" style="color: white" href="index.php">FIO team</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">
            <ul class="nav navbar-nav mr-auto justify-content-end">
                <li class="col-sm-4"></li>
                <li class="nav-item col-sm-2">
                    <a href="../home.php" class="stretched-link text-center" style="color: white">Home</a>
                </li>
                <li class="nav-item col-sm-2">
                    <a href="../player.php" class="stretched-link text-center" style="color: white">Player</a>
                </li>
                <li class="nav-item col-sm-2">
                    <a href="../clubs.php" class="stretched-link text-center" style="color: white">Clubs</a>
                </li>
                <li class="nav-item col-sm-2">
                    <a href="../competitions.php" class="stretched-link text-center"
                       style="color: white">Competitions</a>
                </li>
            </ul>
        </div>
    </nav>

    <?php
    include('../admincp/config/config.php');
    $sql_player_info = "SELECT p.*, c.pretty_name AS club, c.img_url AS logo, 
       comp.pretty_name AS league, comp.img_url AS league_img, 
       bct.flag_url AS birth_flag, cct.flag_url AS citizen_flag, YEAR(NOW()) - YEAR(p.date_of_birth) AS age
FROM players p
JOIN clubs c ON p.current_club_id = c.club_id
JOIN competitions comp ON comp.competition_id = c.domestic_competition_id
JOIN country bct ON bct.country_name = p.country_of_birth
JOIN country cct ON cct.country_name = p.country_of_citizenship
WHERE p.player_id = $_GET[id]";
    $query_player_info = mysqli_query($conn, $sql_player_info);
    $row_title = mysqli_fetch_array($query_player_info);
    ?>
    <div class="page-content page-container" id="page-content" style="margin-top: 90px">
        <h5 class="section-title text-primary mb-3 mb-sm-4">PROFILE</h5>
        <div class="row container d-flex">
            <div class="col-xl-6 col-md-12">
                <div class="card user-card-full" >
                    <div class="row m-l-0 m-r-0" >
                        <div class="col-sm-4 bg-c-lite-green" style="padding-top: 6vh">
                            <div class="text-center text-white" >
                                <div class="m-b-20">
                                    <img src="<?php echo $row_title['image_url'] ?>" class="img-radius"
                                         alt="User-Profile-Image" style="max-width: 20vw">
                                </div>
                                <h5 class="f-w-600">
                                    <b>
                                        <span><?php echo $row_title['pretty_name'] ?></span>
                                        <br>
                                        <h6 style="padding-top: 5px; color: darkblue">
                                            <b><?php
                                                if ($row_title['position'] === "Goalkeeper") {
                                                    echo $row_title['position'];
                                                } else {
                                                    echo $row_title['sub_position'];
                                                } ?>
                                            </b>
                                        </h6>
                                    </b>
                                </h5>
                                <i class="mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Date of birth</p>
                                        <h6 class="text-muted f-w-600"><?php echo $row_title['date_of_birth'] . ' (' . $row_title['age'] . ')' ?></h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Height</p>
                                        <h6 class="text-muted f-w-600"><?php echo ($row_title['height_in_cm'] / 100) . ' m' ?></h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Citizenship</p>
                                        <h6 class="text-muted f-w-600">
                                            <?php echo $row_title['country_of_citizenship'] . ' ' ?>
                                            <img src="<?php echo $row_title['citizen_flag'] ?>" alt="No image"
                                                 style="max-height: 20px">
                                        </h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Country of birth</p>
                                        <h6 class="text-muted f-w-600">
                                            <?php echo $row_title['country_of_birth'] . ' ' ?>
                                            <img src="<?php echo $row_title['birth_flag'] ?>" alt="No image"
                                                 style="max-height: 20px">
                                        </h6>
                                    </div>

                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Curent club</p>
                                        <h5 class="f-w-600">
                                            <b>
                                                <img src="<?php echo $row_title['logo'] ?>" style="max-height: 20px">
                                                <a href="clubprofile.php?value=club&id=<?php echo $row_title['current_club_id'] ?>"
                                                   style="font-size: 2vh; color: darkblue">
                                                    <?php echo $row_title['club'] ?>
                                                </a>
                                            </b>
                                        </h5>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Market value</p>
                                        <h6 class="text-muted f-w-600"><?php echo '€' . number_format($row_title['market_value_in_gbp'] / 1000000, 2) . 'm' ?></h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Dominant foot</p>
                                        <h6 class="text-muted f-w-600"><?php echo $row_title['foot'] ?></h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Lastest season</p>
                                        <h6 class="text-muted f-w-600"><?php echo $row_title['last_season'] ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
$sql_career = "SELECT games.season AS season, players.pretty_name AS player_name, 
       clubs.img_url as Logo, clubs.club_id, clubs.pretty_name AS club_name
FROM `appearances` 
inner join players on players.player_id = appearances.player_id
inner join games on games.game_id = appearances.game_id
inner join clubs on clubs.club_id = appearances.player_club_id
where players.player_id = $_GET[id]
GROUP BY players.pretty_name, clubs.pretty_name, games.season
ORDER BY games.date;";
$query_career = mysqli_query($conn, $sql_career);
?>

<h5 class="section-title text-primary mb-3 mb-sm-4">Club career</h5>
<h4>
    <div class="widget-next-match">
        <table class="table custom-table">
            <thead>
            <tr style="background-color: red; text-align: justify; font-size: 2.5vh" class="text-white">
                <th>SEASON</th>
                <th>CLUB NAME</th>
            </tr>
            </thead>
            <tbody style="background-color: white">
            <?php
            while ($row = $query_career->fetch_array()) {
                ?>
                <tr>
                    <td style="font-size: 2.5vh"><?php echo $row['season'] ?> </td>
                    <td><img src="<?php echo $row["Logo"] ?>" style="background-color: white" align="middle"
                             height="25"
                             alt="Card image">
                        &nbsp;&nbsp;<a
                                href="clubprofile.php?value=club&id=<?php echo $row["club_id"] ?>"
                                style="font-size: 2.5vh"><strong
                                    class="text-black"><?php echo $row['club_name'] ?></strong></a></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</h4>
</main>
</body>
<footer>
    <?php include('../footer.php'); ?>
</footer>
</html>