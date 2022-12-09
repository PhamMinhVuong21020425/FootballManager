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
    <link rel="stylesheet" href="css/demo4b.css">

    <meta name="theme-color" content="#fafafa">

    <style type="text/css">
        body {
            background-image: url("https://i.pinimg.com/originals/47/6f/29/476f29ab268611e99ed45d2196390f75.png");
            background-repeat: repeat-y;
            color: white;
        }

        .test {
            min-width:1110px;
            height:fit-content;
            overflow-x:auto;
            overflow-y:hidden;
            font-size: 5vh;
        }
        h2 {
            color: white;
            border-left: 10px solid #b1154a;
        }
    </style>

</head>
<main>
    <nav class="navbar navbar-expand-md navbar-light justify-content-center sticky-top" style="background-color: blue">
        <a class="navbar-brand d-flex col-sm-4 mr-auto" style="color: white" href="index.php">FIO team</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">
            <ul class="nav navbar-nav mr-auto justify-content-end">
                <li class="col-sm-4"></li>
                <li class="nav-item col-sm-2">
                    <a href="home.php" class="stretched-link text-center" style="color: white">Home</a>
                </li>
                <li class="nav-item col-sm-2">
                    <a href="player.php" class="stretched-link text-center" style="color: white">Player</a>
                </li>
                <li class="nav-item col-sm-2">
                    <a href="clubs.php" class="stretched-link text-center" style="color: white">Clubs</a>
                </li>
                <li class="nav-item col-sm-2">
                    <a href="competitions.php" class="stretched-link text-center" style="color: white">Competitions</a>
                </li>
            </ul>
        </div>
        <form action="" id="search-box" method="post">
            <input type="text" name="home" placeholder="Search" id="search-text">
            <button type="submit" id="search-btn">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
        <?php
        include('admincp/config/config.php');
        if (isset($_POST["home"])) {
            $home_name = $_POST["home"];
        } else {
            $home_name = 19001008;
        }
        $sql = "SELECT `player_id`,`pretty_name`,`image_url` FROM `players` 
                                             WHERE `pretty_name` LIKE CONCAT('%',?,'%') 
                                             ORDER BY market_value_in_gbp DESC LIMIT 21 ";
        $player_id = $conn->prepare($sql);
        $player_id->bind_param("s", $home_name);
        $player_id->execute();
        $player = $player_id->get_result();

        $sql1 = "SELECT * FROM clubs WHERE pretty_name LIKE CONCAT('%',?,'%') ORDER BY total_market_value DESC LIMIT 21";
        $club_id = $conn->prepare($sql1);
        $club_id->bind_param("s", $home_name);
        $club_id->execute();
        $club = $club_id->get_result();

        $sql_comp = "SELECT `competition_id`,`pretty_name`,`img_url` FROM `competitions` 
                                             WHERE `pretty_name` LIKE CONCAT('%',?,'%')
                                             ORDER BY competition_id LIMIT 14";
        $comp_id = $conn->prepare($sql_comp);
        $comp_id->bind_param("s", $home_name);
        $comp_id->execute();
        $comp = $comp_id->get_result();
        ?>
    </nav>
    <div class="container-fluid">
        <div id="pic" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="pic" data-slide-to="0" class="active"></li>
                <li data-target="#pic" data-slide-to="1"></li>
                <li data-target="#pic" data-slide-to="2"></li>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/player.jpg" alt="Player" style="width: 100vw">
                    <div class="carousel-caption">
                        <a href="player.php" style="color: white">
                            <h1>Amazing players</h1>
                        </a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/comp.jpg" alt="Competition" style="width: 100vw">
                    <div class="carousel-caption">
                        <a href="competitions.php" style="color: white">
                            <h1>Exciting competitions</h1>
                        </a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/chelsea.jpg" alt="Club" style="width: 100vw">
                    <div class="carousel-caption">
                        <a href="clubs.php" style="color: white">
                            <h1>Famous clubs</h1>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#pic" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#pic" data-slide="next" style="color: royalblue">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>

    <div class="latest-news" style="margin-top: 80px">
        <div class="container">
            <div class="row">
                <div class="col-12 title-section">
                    <h2 class="heading" style="color: white; border-left: 10px solid #b1154a; background-color: darkblue"> &nbsp;&nbsp;HOME </h2>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-md-4">
                    <div class="post-entry">
                        <div class="caption">
                            <div class="caption-inner">
                                <div class="author d-flex align-items-center">
                                    <div class="img mb-2 mr-3">
                                        <img src="images/epl.jpg" alt="" style="max-width: 1110px">
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
    if ($row = $player->fetch_array()) {
    ?>
    <div class="container" style="color: black">
        <h2>
            <a href="player.php">Players</a>
        </h2>
        <div class="row" style="margin-left: 0">
            <div class="card" style="width: 159px">
                <img class="card-img-top" src="<?php echo $row['image_url'] ?>" alt="Card image">
                <div class="card-body">
                    <h6 class="card-title"><?php echo $row['pretty_name'] ?></h6>
                </div>
                <a href="profile/playerprofile.php?value=player&id=<?php echo $row['player_id'] ?>"
                   class="btn btn-primary stretched-link">See Profile</a>
            </div>
            <?php
            while ($row = $player->fetch_array()) {
                ?>
                <div class="card" style="min-width: 10vw; max-with: 60vw">
                    <img class="card-img-top" src="<?php echo $row['image_url'] ?>" alt="Card image">
                    <div class="card-body">
                        <h6 class="card-title"><?php echo $row['pretty_name'] ?></h6>
                    </div>
                    <a href="profile/playerprofile.php?value=player&id=<?php echo $row['player_id'] ?>"
                       class="btn btn-primary stretched-link">See Profile</a>
                </div>
                <?php
            }
            }
            ?>
        </div>
    </div>

    <?php
    if ($row = $club->fetch_array()) {
    ?>
    <div class="container" style="color: black">
        <h2>
            <a href="clubs.php">Clubs</a>
        </h2>
        <div class="row" style="margin-left: 0">
            <div class="card" style="width: 159px">
                <img class="card-img-top" src="<?php echo $row['img_url'] ?>" alt="Card image">
                <div class="card-body">
                    <h6 class="card-title"><?php echo $row['pretty_name'] ?></h6>
                </div>
                <a href="profile/clubprofile.php?value=club&id=<?php echo $row['club_id'] ?>"
                   class="btn btn-primary stretched-link">See Profile</a>
            </div>
            <?php
            while ($row = $club->fetch_array()) {
                ?>
                <div class="card" style="width: 159px">
                    <img class="card-img-top" src="<?php echo $row['img_url'] ?>" alt="Card image">
                    <div class="card-body">
                        <h6 class="card-title"><?php echo $row['pretty_name'] ?></h6>
                    </div>
                    <a href="profile/clubprofile.php?value=club&id=<?php echo $row['club_id'] ?>"
                       class="btn btn-primary stretched-link">See Profile</a>
                </div>
                <?php
            }
            }
            ?>
        </div>
    </div>

    <?php
    if ($row = $comp->fetch_array()) {
    ?>
    <div class="container" style="color: black">
        <h2>
            <a href="competitions.php">Competitions</a>
        </h2>
        <div class="row" style="margin-left: 0">
            <div class="card" style="width: 159px">
                <img class="card-img-top" src="<?php echo $row['img_url'] ?>" alt="Card image">
                <div class="card-body">
                    <h6 class="card-title"><?php echo $row['pretty_name'] ?></h6>
                </div>
                <a href="profile/competitiondetails.php?value=comp&id=<?php echo $row['competition_id'] ?>"
                   class="btn btn-primary stretched-link">See Profile</a>
            </div>
            <?php
            while ($row = $comp->fetch_array()) {
                ?>
                <div class="card" style="width: 159px">
                    <img class="card-img-top" src="<?php echo $row['img_url'] ?>" alt="Card image">
                    <div class="card-body">
                        <h6 class="card-title"><?php echo $row['pretty_name'] ?></h6>
                    </div>
                    <a href="profile/competitiondetails.php?value=comp&id=<?php echo $row['competition_id'] ?>"
                       class="btn btn-primary stretched-link">See Profile</a>
                </div>
                <?php
            }
            }
            ?>
        </div>
    </div>
    <?php
    include('admincp/config/config.php');

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
        where games.competition_code = "GB1" and games.season = 2021 group by c1.club_id) home 
        join (select c2.pretty_name, c2.club_id, c2.img_url,
        sum(if(games.away_club_id is not null,1,0)) away_played,
        sum(if(games.home_club_goals < games.away_club_goals,3,if(games.home_club_goals = games.away_club_goals,1,0))) away_points,
        sum(if(games.home_club_goals < games.away_club_goals,1,0)) away_wins,
        sum(if(games.home_club_goals = games.away_club_goals,1,0)) away_draws,
        sum(if(games.home_club_goals > games.away_club_goals,1,0)) away_loses,
        sum(games.home_club_goals) away_conceded_goals,
        sum(games.away_club_goals) away_goals
        from games inner join clubs c2 on c2.club_id = games.away_club_id 
        where games.competition_code = "GB1" and games.season = 2021 group by c2.club_id) away 
        on home.club_id = away.club_id order by points DESC, HS desc, BT DESC;';
    $query_bxh = $conn->prepare($sql_bxh);
    $query_bxh->execute();
    $query_ltb = $query_bxh->get_result();
    //$query_bxh = mysqli_query($conn, $sql_bxh);
    ?>

    <div class="container">
        <br>
        <h3 style="background-color: cyan; border-left: 10px solid #b1154a; color: midnightblue">
            &nbsp;&nbsp;Premier league table
        </h3>
        <div class="widget-next-match">
            <table class="table custom-table">
                <thead>
                <tr style="background-color: red; text-align: justify" class="text-black">
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
                <tbody style="background-color: white; color: black">
                <?php
                $i = 0;
                while ($row = $query_ltb->fetch_array()) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i ?> </td>
                        <td><img src="<?php echo $row['Logo'] ?>" , align="middle" , height="25" , alt="Card image">
                            &nbsp;&nbsp;<a href="profile/clubprofile.php?value=club&id=<?php echo $row['club_id'] ?>"><strong
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
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    $sql_player = 'select * from players order by market_value_in_gbp desc limit 18';
    $query_player = mysqli_query($conn, $sql_player);
    ?>
    <div class="container">
        <h2>&nbsp;&nbsp;Most valuable players</h2>
        <div id="demo" class="carousel slide test" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1" class="active"></li>
                <li data-target="#demo" data-slide-to="2" class="active"></li>
            </ul>
            <!-- The slideshow -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="card-deck">
                        <?php
                        $i = 0;
                        $j = $i;
                        while ($i < $j + 6 and $row = mysqli_fetch_array($query_player)) {
                            $i++;
                            ?>
                            <div class="card" style="background-color: gold; color: black">
                                <img class="card-img-top" src="<?php echo $row['image_url'] ?>" alt="Card image">
                                <div class="card-body">
                                    <h6 class="card-title"><?php echo $row['pretty_name'] ?></h6>
                                </div>
                                <a href="profile/playerprofile.php?value=player&id=<?php echo $row['player_id'] ?>"
                                   class="btn btn-primary stretched-link">See Profile</a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="card-deck">
                        <?php
                        $j = $i;
                        while ($i < $j + 6 and $row = mysqli_fetch_array($query_player)) {
                            $i++;
                            ?>
                            <div class="card" style="background-color: silver; color: black">
                                <img class="card-img-top" src="<?php echo $row['image_url'] ?>" alt="Card image">
                                <div class="card-body">
                                    <h6 class="card-title"><?php echo $row['pretty_name'] ?></h6>
                                </div>
                                <a href="profile/playerprofile.php?value=player&id=<?php echo $row['player_id'] ?>"
                                   class="btn btn-primary stretched-link">See Profile</a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="card-deck">
                        <?php
                        while ($row = mysqli_fetch_array($query_player)) {
                            $i++;
                            ?>
                            <div class="card" style="background-color: chocolate">
                                <img class="card-img-top" src="<?php echo $row['image_url'] ?>" alt="Card image">
                                <div class="card-body">
                                    <h6 class="card-title"><?php echo $row['pretty_name'] ?></h6>
                                </div>
                                <a href="profile/playerprofile.php?value=player&id=<?php echo $row['player_id'] ?>"
                                   class="btn btn-primary stretched-link">See Profile</a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" style="width: 5%" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" style="width: 5%" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>

    <?php
    $sql_club = 'SELECT * FROM `clubs` order by `total_market_value` desc limit 18;';
    $query_club = mysqli_query($conn, $sql_club);
    ?>

    <br>
    <div class="container">
        <h2>&nbsp;&nbsp;Most valuable clubs</h2>
        <div id="demo2" class="carousel slide test" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#demo2" data-slide-to="0" class="active"></li>
                <li data-target="#demo2" data-slide-to="1"></li>
                <li data-target="#demo2" data-slide-to="2"></li>
            </ul>
            <!-- The slideshow -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="card-deck">
                        <?php
                        $i = 0;
                        $j = $i;
                        while ($i < $j + 6 and $row = mysqli_fetch_array($query_club)) {
                            $i++;
                            ?>
                            <div class="card" style="background-color: gold; color: black">
                                <img class="card-img-top" src="<?php echo $row['img_url'] ?>" alt="Card image">
                                <div class="card-body">
                                    <h6 class="card-title"><?php echo $row['pretty_name'] ?></h6>
                                </div>
                                <a href="profile/clubprofile.php?value=club&id=<?php echo $row['club_id'] ?>"
                                   class="btn btn-primary stretched-link">See Profile</a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="card-deck">
                        <?php
                        $j = $i;
                        while ($i < $j + 6 and $row = mysqli_fetch_array($query_club)) {
                            $i++;
                            ?>
                            <div class="card" style="background-color: silver; color: black">
                                <img class="card-img-top" src="<?php echo $row['img_url'] ?>" alt="Card image">
                                <div class="card-body">
                                    <h6 class="card-title"><?php echo $row['pretty_name'] ?></h6>
                                </div>
                                <a href="profile/clubprofile.php?value=club&id=<?php echo $row['club_id'] ?>"
                                   class="btn btn-primary stretched-link">See Profile</a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="card-deck">
                        <?php
                        while ($row = mysqli_fetch_array($query_club)) {
                            $i++;
                            ?>
                            <div class="card" style="background-color: chocolate">
                                <img class="card-img-top" src="<?php echo $row['img_url'] ?>" alt="Card image">
                                <div class="card-body">
                                    <h6 class="card-title"><?php echo $row['pretty_name'] ?></h6>
                                </div>
                                <a href="profile/clubprofile.php?value=club&id=<?php echo $row['club_id'] ?>"
                                   class="btn btn-primary stretched-link">See Profile</a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" style="width: 5%" href="#demo2" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" style="width: 5%" href="#demo2" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>
</main>
<footer style="background-color: #005ef7; margin-top: 20px">
    <?php include('footer.php'); ?>
</footer>
</body>
</html>