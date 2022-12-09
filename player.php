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

    <meta name="theme-color" content="#fafafa">

    <style type="text/css">
        body {
            background-image: url("https://i.pinimg.com/originals/47/6f/29/476f29ab268611e99ed45d2196390f75.png");
            background-repeat: repeat-y;
            background-color: blue;
        }
        .test {
            width:1110px;
            height:350px;
            overflow-x:auto;
            overflow-y:hidden;
        }
        h2 {
            color: white;
            border-left: 10px solid #b1154a;
        }
    </style>

</head>
<body>
<main>
<nav class="navbar navbar-expand-md navbar-light justify-content-center fixed-top" style="background-color: blue">
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
        <input type="text" name="player" placeholder="Players" id="search-text">
        <button type="submit" id="search-btn">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </form>

    <?php
    include('admincp/config/config.php');
    if (isset($_POST["player"])) {
        $player_name = $_POST["player"];
    } else {
        $player_name = 1;
    }
    $sql = "SELECT `player_id`,`pretty_name`,`image_url` FROM `players` 
                                             WHERE `pretty_name` LIKE CONCAT('%',?,'%') 
                                             ORDER BY market_value_in_gbp DESC LIMIT 50 ";
    $player_id = $conn->prepare($sql);
    $player_id->bind_param("s", $player_name);
    $player_id->execute();
    $player = $player_id->get_result();
    ?>
</nav>

<div class="latest-news" style="margin-top: 80px">
    <div class="container">
        <div class="row">
            <div class="col-12 title-section">
                <h2 class="heading" style="color: white; border-left: 10px solid #b1154a; background-color: darkblue"> &nbsp;&nbsp;PLAYER </h2>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-md-4">
                <div class="post-entry">
                    <div class="caption">
                        <div class="caption-inner">
                            <div class="author d-flex align-items-center">
                                <div class="img mb-2 mr-3">
                                    <img src="images/player.jpg" alt="" width = "1110px">
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
    <div class="container">
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
                <div class="card" style="width: 159px">
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

    <?php
} else {
    include('admincp/config/config.php');
    $sql_player = 'select * from players order by market_value_in_gbp desc limit 18';
    $query_player = mysqli_query($conn, $sql_player);
    ?>

    <div class="container">
        <h2 style="color: white">&nbsp;&nbsp;Most valuable players</h2>
        <div id="demo" class="carousel slide test" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
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
                            <div class="card" style="background-color: gold">
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
                            <div class="card" style="background-color: silver">
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
                            <div class="card" style="background-color: saddlebrown">
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
    include('admincp/config/config.php');
    $sql_player = 'select * from players where position = \'Goalkeeper\' order by market_value_in_gbp desc limit 18';
    $query_player = mysqli_query($conn, $sql_player);
    ?>

    <div class="container">
        <h2 style="color: gold">&nbsp;&nbsp;Most valuable GK</h2>
        <div id="gk" class="carousel slide test" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#gk" data-slide-to="0" class="active"></li>
                <li data-target="#gk" data-slide-to="1" class="active"></li>
                <li data-target="#gk" data-slide-to="2" class="active"></li>
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
                            <div class="card">
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
                            <div class="card">
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
                            <div class="card">
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
            <a class="carousel-control-prev" style="width: 5%" href="#gk" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" style="width: 5%" href="#gk" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>

    <?php
    include('admincp/config/config.php');
    $sql_player = 'select * from players where sub_position = \'Centre-Back\' order by market_value_in_gbp desc limit 18';
    $query_player = mysqli_query($conn, $sql_player);
    ?>

    <div class="container">
        <h2 style="color: limegreen">&nbsp;&nbsp;Most valuable CB</h2>
        <div id="cb" class="carousel slide test" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#cb" data-slide-to="0" class="active"></li>
                <li data-target="#cb" data-slide-to="1"></li>
                <li data-target="#cb" data-slide-to="2"></li>
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
                            <div class="card">
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
                            <div class="card">
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
                            <div class="card">
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
            <a class="carousel-control-prev" style="width: 5%" href="#cb" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" style="width: 5%;" href="#cb" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>

    <?php
    include('admincp/config/config.php');
    $sql_player = 'select * from players where sub_position = \'Left-Back\' order by market_value_in_gbp desc limit 18';
    $query_player = mysqli_query($conn, $sql_player);
    ?>

    <div class="container">
        <h2 style="color: limegreen">&nbsp;&nbsp;Most valuable LB</h2>
        <div id="lb" class="carousel slide test" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#lb" data-slide-to="0" class="active"></li>
                <li data-target="#lb" data-slide-to="1"></li>
                <li data-target="#lb" data-slide-to="2"></li>
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
                            <div class="card">
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
                            <div class="card">
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
                            <div class="card">
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
            <a class="carousel-control-prev" style="width: 5%" href="#lb" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" style="width: 5%" href="#lb" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>

    <?php
    include('admincp/config/config.php');
    $sql_player = 'select * from players where sub_position = \'Right-Back\' order by market_value_in_gbp desc limit 18';
    $query_player = mysqli_query($conn, $sql_player);
    ?>

    <div class="container">
        <h2 style="color: limegreen">&nbsp;&nbsp;Most valuable RB</h2>
        <div id="rb" class="carousel slide test" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#rb" data-slide-to="0" class="active"></li>
                <li data-target="#rb" data-slide-to="1"></li>
                <li data-target="#rb" data-slide-to="2"></li>
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
                            <div class="card">
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
                            <div class="card">
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
                            <div class="card">
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
            <a class="carousel-control-prev" style="width: 5%" href="#rb" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" style="width: 5%" href="#rb" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>

    <?php
    include('admincp/config/config.php');
    $sql_player = 'select * from players where sub_position = \'Defensive Midfield\' order by market_value_in_gbp desc limit 18';
    $query_player = mysqli_query($conn, $sql_player);
    ?>

    <div class="container">
        <h2 style="color:blue">&nbsp;&nbsp;Most valuable DM</h2>
        <div id="dm" class="carousel slide test" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#dm" data-slide-to="0" class="active"></li>
                <li data-target="#dm" data-slide-to="1"></li>
                <li data-target="#dm" data-slide-to="2"></li>
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
                            <div class="card">
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
                            <div class="card">
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
                            <div class="card">
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
            <a class="carousel-control-prev" style="width: 5%" href="#dm" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" style="width: 5%" href="#dm" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>

    <?php
    include('admincp/config/config.php');
    $sql_player = 'select * from players where sub_position = \'Central Midfield\' order by market_value_in_gbp desc limit 18';
    $query_player = mysqli_query($conn, $sql_player);
    ?>

    <div class="container">
        <h2 style="color:blue">&nbsp;&nbsp;Most valuable CM</h2>
        <div id="cm" class="carousel slide test" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#cm" data-slide-to="0" class="active"></li>
                <li data-target="#cm" data-slide-to="1"></li>
                <li data-target="#cm" data-slide-to="2"></li>
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
                            <div class="card">
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
                            <div class="card">
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
                            <div class="card">
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
            <a class="carousel-control-prev" style="width: 5%" href="#cm" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" style="width: 5%" href="#cm" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>

    <?php
    include('admincp/config/config.php');
    $sql_player = 'select * from players where sub_position = \'Left Midfield\' order by market_value_in_gbp desc limit 18';
    $query_player = mysqli_query($conn, $sql_player);
    ?>

    <div class="container">
        <h2 style="color:blue">&nbsp;&nbsp;Most valuable LM</h2>
        <div id="lm" class="carousel slide test" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#lm" data-slide-to="0" class="active"></li>
                <li data-target="#lm" data-slide-to="1"></li>
                <li data-target="#lm" data-slide-to="2"></li>
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
                            <div class="card">
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
                            <div class="card">
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
                            <div class="card">
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
            <a class="carousel-control-prev" style="width: 5%" href="#lm" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" style="width: 5%" href="#lm" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>

    <?php
    include('admincp/config/config.php');
    $sql_player = 'select * from players where sub_position = \'Right Midfield\' order by market_value_in_gbp desc limit 18';
    $query_player = mysqli_query($conn, $sql_player);
    ?>

    <div class="container">
        <h2 style="color:blue">&nbsp;&nbsp;Most valuable RM</h2>
        <div id="rm" class="carousel slide test" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#rm" data-slide-to="0" class="active"></li>
                <li data-target="#rm" data-slide-to="1"></li>
                <li data-target="#rm" data-slide-to="2"></li>
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
                            <div class="card">
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
                            <div class="card">
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
                            <div class="card">
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
            <a class="carousel-control-prev" style="width: 5%" href="#rm" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" style="width: 5%" href="#rm" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>

    <?php
    include('admincp/config/config.php');
    $sql_player = 'select * from players where sub_position = \'Attacking Midfield\' order by market_value_in_gbp desc limit 18';
    $query_player = mysqli_query($conn, $sql_player);
    ?>

    <div class="container">
        <h2 style="color:blue">&nbsp;&nbsp;Most valuable AM</h2>
        <div id="am" class="carousel slide test" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#am" data-slide-to="0" class="active"></li>
                <li data-target="#am" data-slide-to="1"></li>
                <li data-target="#am" data-slide-to="2"></li>
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
                            <div class="card">
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
                            <div class="card">
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
                            <div class="card">
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
            <a class="carousel-control-prev" style="width: 5%" href="#am" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" style="width: 5%" href="#am" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>

    <?php
    include('admincp/config/config.php');
    $sql_player = 'select * from players where sub_position = \'Left Winger\' order by market_value_in_gbp desc limit 18';
    $query_player = mysqli_query($conn, $sql_player);
    ?>

    <div class="container">
        <h2 style="color:red">&nbsp;&nbsp;Most valuable LW</h2>
        <div id="lw" class="carousel slide test" data-ride="carousel">

            <!-- Indicators -->
            <div>
                <ul class="carousel-indicators">
                    <li data-target="#lw" data-slide-to="0" class="active"></li>
                    <li data-target="#lw" data-slide-to="1"></li>
                    <li data-target="#lw" data-slide-to="2"></li>
                </ul>
            </div>
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
                            <div class="card">
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
                            <div class="card">
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
                            <div class="card">
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
            <div>
                <a class="carousel-control-prev" style="width: 5%" href="#lw" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" style="width: 5%" href="#lw" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>
    </div>

    <?php
    include('admincp/config/config.php');
    $sql_player = 'select * from players where sub_position = \'Right Winger\' order by market_value_in_gbp desc limit 18';
    $query_player = mysqli_query($conn, $sql_player);
    ?>

    <div class="container">
        <h2 style="color:red">&nbsp;&nbsp;Mostvaluable RW</h2>
        <div id="rw" class="carousel slide test" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#rw" data-slide-to="0" class="active"></li>
                <li data-target="#rw" data-slide-to="1"></li>
                <li data-target="#rw" data-slide-to="2"></li>
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
                            <div class="card">
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
                            <div class="card">
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
                            <div class="card">
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
            <a class="carousel-control-prev" style="width: 5%" href="#rw" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" style="width: 5%" href="#rw" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>

    <?php
    include('admincp/config/config.php');
    $sql_player = 'select * from players where sub_position = \'Second Striker\' order by market_value_in_gbp desc limit 18';
    $query_player = mysqli_query($conn, $sql_player);
    ?>

    <div class="container">
        <h2 style="color:red">&nbsp;&nbsp;Most valuable CF</h2>
        <div id="ss" class="carousel slide test" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#ss" data-slide-to="0" class="active"></li>
                <li data-target="#ss" data-slide-to="1"></li>
                <li data-target="#ss" data-slide-to="2"></li>
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
                            <div class="card">
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
                            <div class="card">
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
                            <div class="card">
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
            <a class="carousel-control-prev" style="width: 5%" href="#ss" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" style="width: 5%" href="#ss" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>

    <?php
    include('admincp/config/config.php');
    $sql_player = 'select * from players where sub_position = \'Centre-Forward\' order by market_value_in_gbp desc limit 18';
    $query_player = mysqli_query($conn, $sql_player);
    ?>
    <div class="container">
        <h2 style="color:red">&nbsp;&nbsp;Most valuable ST</h2>
        <div id="cf" class="carousel slide test" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#cf" data-slide-to="0" class="active"></li>
                <li data-target="#cf" data-slide-to="1"></li>
                <li data-target="#cf" data-slide-to="2"></li>
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
                            <div class="card">
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
                            <div class="card">
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
                            <div class="card">
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
            <a class="carousel-control-prev" style="width: 5%" href="#cf" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" style="width: 5%" href="#cf" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>
<?php } ?>
</main>
<footer>
    <?php include('footer.php'); ?>
</footer>
</body>
</html>