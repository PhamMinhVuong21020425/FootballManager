<!DOCTYPE html>
<html lang="">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <style type="text/css">
        <?php include ('../css/club_profile.css'); ?>
        h2 {
            font-size: 27px;
        }
    </style>

    <meta name="theme-color" content="#fafafa">

</head>
<body>

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
                <a href="../competitions.php" class="stretched-link text-center" style="color: white">Competitions</a>
            </li>
        </ul>
    </div>
</nav>

<?php
include('../admincp/config/config.php');
$sql_comp_info = "select comp.*, ct.flag_url 
from competitions comp
join country ct on ct.country_name = comp.country_name
where comp.competition_id = '$_GET[id]'";
$query_comp_info = mysqli_query($conn, $sql_comp_info);
$row_title = mysqli_fetch_array($query_comp_info);
?>

<section class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4 mb-sm-5">
                <div class="card card-style1 border-0">
                    <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
                        <div class="row align-items-center">
                            <div class="col-lg-6 mb-4 mb-lg-0">
                                <img src="<?php echo $row_title['img_url'] ?>" style="width: 200px; margin-left: 120px"
                                     alt="Card image">
                            </div>
                            <div class="col-lg-6 px-xl-10">
                                <div class="bg-secondary d-lg-inline-block py-1-9 px-1-9 px-sm-6 mb-1-9 rounded">
                                    <h3 class="h2 text-white mb-0"
                                        style="min-width: 280px"><?php echo $row_title['pretty_name'] ?></h3>
                                    <span class="text-primary">
                                        <b><?php echo $row_title['country_name'] ?></b>
                                        <img src="<?php echo $row_title['flag_url'] ?>"
                                             style="height: 18px; background-color: white; margin-bottom: 5px">
                                    </span>
                                </div>
                                <ul class="list-unstyled mb-1-9">
                                    <li class="mb-2 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">League level: </span><b> <?php echo $row_title['type'] ?> </b>
                                    </li>
                                    <li class="mb-2 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">Confederation: </span><b> <?php echo $row_title['confederation'] ?> </b>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="" method="post" style="color: darkblue">
            <a class="col-sm-2 text-left" style="font-size: 1.7vw"><b>&nbsp;Season:</b></a>
            <input type="text" name="year" value="">
            <button type="submit" class="text-left">Search</button>
        </form>
        <div class="container">
            <?php
            $competitions = $row_title['competition_id'];
            if (isset($_POST["year"])) {
                $year = $_POST["year"];
            } else {
                $year = 2021;
            }
            ?>
        </div>

        <?php
        if ($row_title['type'] === "first_tier") {
        ?>
        <div class="container site-section">
            <div class="row">
                <div class="col-6 title-section">
                    <br>
                    <h2 class="heading" style="color: darkblue; border-left: 10px solid #b1154a">
                        &nbsp;&nbsp;League Table </h2>
                </div>
                <div class="col-6 text-right">
                    <div class="custom-nav">
                        <a href="#" class="js-custom-prev-v2"><span class="icon-keyboard_arrow_left"></span></a>
                        <span></span>
                        <a href="#" class="js-custom-next-v2"><span class="icon-keyboard_arrow_right"></span></a>
                    </div>
                </div>
            </div>
            <?php
            include('../admincp/config/config.php');
            ?>
        </div>
        <?php
        $sql_bxh = 'select row_number() over (order by points desc, HS desc, BT desc) as STT,
        home.club_id,
        home.img_url as Logo,
        home.pretty_name as Clubs,
        home.home_played + away.away_played as PL,
        home.home_points + away.away_points as points,
        home.home_wins + away.away_wins as W,
        home.home_draws + away.away_draws as D,
        home.home_loses + away.away_loses as L,
        home.home_goals + away.away_goals as BT,
        home.home_conceded_goals + away.away_conceded_goals as BB,
        home.home_goals + away.away_goals - (home.home_conceded_goals + away.away_conceded_goals) as HS
        from (select c1.pretty_name, c1.club_id, c1.img_url,
        sum(if(games.home_club_id is not null,1,0)) home_played,
        sum(if(games.home_club_goals > games.away_club_goals,3,if(games.home_club_goals = games.away_club_goals,1,0))) home_points,
        sum(if(games.home_club_goals > games.away_club_goals,1,0)) home_wins,
        sum(if(games.home_club_goals = games.away_club_goals,1,0)) home_draws,
        sum(if(games.home_club_goals < games.away_club_goals,1,0)) home_loses,
        sum(games.home_club_goals) home_goals,
        sum(games.away_club_goals) home_conceded_goals
        from games inner join clubs c1 on c1.club_id = games.home_club_id 
        where games.competition_code = ? and games.season = ? group by c1.club_id) home 
        inner join (select c2.pretty_name, c2.club_id, c2.img_url,
        sum(if(games.away_club_id is not null,1,0)) away_played,
        sum(if(games.home_club_goals < games.away_club_goals,3,if(games.home_club_goals = games.away_club_goals,1,0))) away_points,
        sum(if(games.home_club_goals < games.away_club_goals,1,0)) away_wins,
        sum(if(games.home_club_goals = games.away_club_goals,1,0)) away_draws,
        sum(if(games.home_club_goals > games.away_club_goals,1,0)) away_loses,
        sum(games.home_club_goals) away_conceded_goals,
        sum(games.away_club_goals) away_goals
        from games inner join clubs c2 on c2.club_id = games.away_club_id 
        where games.competition_code = ? and games.season = ? group by c2.club_id) away 
        on home.club_id = away.club_id 
        order by points DESC, HS desc, BT DESC;';
        $query_bxh = $conn->prepare($sql_bxh);
        $query_bxh->bind_param("ssss", $competitions, $year, $competitions, $year);
        $query_bxh->execute();
        $query_ltb = $query_bxh->get_result();

        $sql_league = 'SELECT pretty_name FROM `competitions` WHERE competition_id = ?;';
        $query_league = $conn->prepare($sql_league);
        $query_league->bind_param("s", $competitions);
        $query_league->execute();
        $query_name = $query_league->get_result();

        $sql_top = "SELECT * FROM `competitions` WHERE competition_id IN ('CL','GB1','ES1','L1','IT1','FR1');";
        $query_top = mysqli_query($conn, $sql_top);
        ?>

        <div class="container">
            <h5 style="color: black">
                <?php
                if ($name = $query_name->fetch_array()) {
                    echo $name['pretty_name'];
                } ?>
                Season <?php echo $year ?>
            </h5>
            <div class="widget-next-match">
                <table class="table custom-table">
                    <thead>
                    <tr style="background-color: red; text-align: justify" class="text-white">
                        <th>STT</th>
                        <th>Teams</th>
                        <th>P</th>
                        <th>W</th>
                        <th>D</th>
                        <th>L</th>
                        <th>BT</th>
                        <th>BB</th>
                        <th>HS</th>
                        <th>PTS</th>
                    </tr>
                    </thead>
                    <tbody style="background-color: white; font-size: 1vw">
                    <?php
                    $i = 0;
                    while ($row = $query_ltb->fetch_array()) {
                        $i++;
                        ?>
                        <tr>
                            <td><?php echo $i ?> </td>
                            <td><img src="<?php echo $row["Logo"] ?>" style="background-color: white" align="middle"
                                     height="25"
                                     alt="Card image">
                                &nbsp;&nbsp;<a
                                        href="clubprofile.php?value=club&id=<?php echo $row["club_id"] ?>"><strong
                                            class="text-black"><?php echo $row['Clubs'] ?></strong></a></td>
                            <td><?php echo $row['PL'] ?> </td>
                            <td><?php echo $row['W'] ?> </td>
                            <td><?php echo $row['D'] ?> </td>
                            <td><?php echo $row['L'] ?> </td>
                            <td><?php echo $row['BT'] ?> </td>
                            <td><?php echo $row['BB'] ?> </td>
                            <td><?php echo $row['HS'] ?> </td>
                            <td><?php echo $row['points'] ?> </td>
                        </tr>
                        <?php
                    }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <?php
    $sql_best = 'SELECT players.*, clubs.club_id, clubs.img_url, clubs.pretty_name as club, sum(appearances.goals) as goals FROM `appearances` 
inner join players on appearances.player_id = players.player_id 
inner join games on appearances.game_id = games.game_id
inner join clubs on appearances.player_club_id = clubs.club_id                                                  
where games.competition_code = ? and games.season = ? 
group by players.player_id 
order by goals desc
limit 20';
    $sql_scorer = $conn->prepare($sql_best);
    $sql_scorer->bind_param("ss", $competitions, $year);
    $sql_scorer->execute();
    $scorer = $sql_scorer->get_result();
    ?>
    <div class="container site-section" style="margin-top:40px">
        <div class="row">
            <div class="col-6 title-section">
                <h2 class="heading" style="color: darkblue; border-left: 10px solid #b1154a">
                    &nbsp;&nbsp;Best Goal Scores </h2>
            </div>
            <div class="col-6 text-right">
                <div class="custom-nav">
                    <a href="#" class="js-custom-prev-v2"><span class="icon-keyboard_arrow_left"></span></a>
                    <span></span>
                    <a href="#" class="js-custom-next-v2"><span class="icon-keyboard_arrow_right"></span></a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="widget-next-match">
            <table class="table custom-table">
                <thead>
                <tr style="background-color: red; text-align: justify" class="text-white">
                    <th>STT</th>
                    <th>Player</th>
                    <th>Club</th>
                    <th>Goals</th>
                </tr>
                </thead>
                <tbody style="background-color: white">
                <?php
                $i = 0;
                while ($row = $scorer->fetch_array()) {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i ?> </td>
                    <td><img src="<?php echo $row["image_url"] ?>" style="background-color: white" align="middle"
                             height="50"
                             alt="Card image">
                        &nbsp;&nbsp;<a
                                href="playerprofile.php?value=player&id=<?php echo $row["player_id"] ?>"><strong
                                    class="text-black"><?php echo $row['pretty_name'] ?></strong></a></td></td>
                    <td><img src="<?php echo $row["img_url"] ?>" style="background-color: white" align="middle"
                             height="50"
                             alt="Card image">
                        &nbsp;&nbsp;<a
                                href="clubprofile.php?value=club&id=<?php echo $row["club_id"] ?>"><strong
                                    class="text-black"><?php echo $row['club'] ?></strong></a></td>
                    <td><?php echo $row['goals'] ?> </td>
                </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>



</section>
<footer>
    <?php include("../footer.php"); ?>
</footer>
</body>
</html>
