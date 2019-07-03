<?php
/**
 * Created by PhpStorm.
 * User: guoxuantong
 * Date: 2019-03-19
 * Time: 04:40
 */

//check login or not
session_start();
$username = $_SESSION['username'];
include('../php/connect.php');//链接数据库
if ($username) {
}else{
    ?>
    <script>
        alert('You are not logged in yet! please log in first.');
        window.location.href="../html/login.html";
    </script>
    <?php
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>index</title>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <script type="text/javascript" src="../js/index.js"></script>


    <script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="../js/jquery.ssd-vertical-navigation.min.js"></script>


</head>
<body>

<header>
    <div class="logo">
        <a href="index.php"><img src="../images/logo.png" height="80" width="100" /></a>
    </div><!-- end logo -->

    <div id="menu_icon"></div>
    <nav>
        <ul>
            <li><a href="index.php">Personal Profile</a></li>
            <li><a href="user_mostPopularGame.php">Most Popular Games</a></li>
            <li><a href="user_addMatch.php">Add Match Record</a></li>
            <li><a href="load_API_gameInfo.php">Additional Game Info</a></li>
        </ul>
    </nav><!-- end navigation menu -->


</header><!-- end header -->

<section class="main clearfix">

    <section class="top">
        <div class="wrapper content_header clearfix">
            <p class="logincs"><a href="../html/login.html">Login</a> || <a href="../html/registry.html">Registry</a></p>
            <p class="title">Welcome, <?php echo" ".$username;?></p>

        </div>
    </section><!-- end top -->

    <section class="wrapper">
        <div class="content">

            <!-- show all games of user -->
            <H2><center>All List of Games You Played</center></H2>
            <table id="showinfo" width="800" border="1">
                <tr>
                    <th>Your Player ID</th>
                    <th>recordID</th>
                    <th>gameID</th>
                    <th>gameName</th>
                    <th>result</th>
                    <th>matchDate</th
                </tr>
                <?php
                require_once('../php/connect.php');//链接数据库
                echo"username: ".$username;
                $sql = $pdo->query("select Members.playerID,Matches.recordID,Game.gameID,Game.gameName,Records.result,Records.matchDate 
                                              from Members,Matches,Game,Records 
                                              where Matches.recordID = Records.recordID AND Matches.gameID = Game.gameID 
                                              AND Members.playerID = Records.playerID AND Members.username = '$username';");
                foreach ($sql as $row) {
                    echo "<tr>";
                    echo "<td>{$row['playerID']}</td>";
                    echo "<td>{$row['recordID']}</td>";
                    echo "<td>{$row['gameID']}</td>";
                    echo "<td>{$row['gameName']}</td>";
                    echo "<td>{$row['result']}</td>";
                    echo "<td>{$row['matchDate']}</td>";
                }
                ?>
            </table>

            <!--search information-->
            <div id="addstu">
                <h4>Search the match info of game played </h4>
                <form name="search" method="post" action="">
                    <button type="button">
                        <input type="text" name="gameName" placeholder="please input game name"/>
                        <input type="submit" name="searchbtn" VALUE="搜索">
                    </button>
                </form>

                <?php

                if(isset($_POST['searchbtn'])){ //check if form was submitted
                    echo '<html lang="en">
                    <H2><center>Results of your Search Games Played</center></H2>
                    <table id="showinfo" width="800" border="1">
                    <tr>
                        <th>gameName</th>
                        <th>recordID</th>
                        <th>matchDate</th>
                        <th>numPlayers</th>
                        <th>result</th>
                    </tr>           
                    </html>';
                    require_once('../php/connect.php');//链接数据库
                    $gameName = $_POST["gameName"];
                    $sql = "SELECT Game.gameName, Records.recordID, matchDate, numPlayers, result, gameName FROM Records,Game,Members,Matches
                        WHERE Game.gameName = '$gameName' and Members.username = '$username' and Members.playerID = Records.playerID and Matches.gameID=Game.gameID and Records.recordID=Matches.recordID";
                    foreach ($pdo->query($sql) as $row) {
                        echo "<tr>";
                        echo "<td>{$row['gameName']}</td>";
                        echo "<td>{$row['recordID']}</td>";
                        echo "<td>{$row['matchDate']}</td>";
                        echo "<td>{$row['numPlayers']}</td>";
                        echo "<td>{$row['result']}</td>";
                        echo "</tr>";
                    }
                }
                ?>
                </table>


                <!--search information-->
                <div id="addstu">
                    <h4>Search the game details you played</h4>
                    <form name="search" method="post" action="">
                        <button type="button">
                            <input type="text" name="gameName" placeholder="please input game name"/>
                            <input type="submit" name="searchgame" VALUE="搜索">
                        </button>
                    </form>

                    <?php
                    if(isset($_POST['searchgame'])){ //check if form was submitted
                        echo '<html lang="en">
                    <H2><center>Game Details of Your Search</center></H2>
                    <table id="showinfo" width="800" border="1">
                    <tr>
                        <th>gameName</th>
                        <th>yearPublished</th>
                        <th>minPlayers</th>
                        <th>maxPlayers</th>
                    </tr>           
                    </html>';
                        require_once('../php/connect.php');
                        $gameName = $_POST["gameName"];
                        $sql = "SELECT * FROM Game
                        WHERE Game.gameName = '$gameName';";
                        foreach ($pdo->query($sql) as $row) {
                            echo "<tr>";
                            echo "<td>{$row['gameName']}</td>";
                            echo "<td>{$row['yearPublished']}</td>";
                            echo "<td>{$row['minPlayers']}</td>";
                            echo "<td>{$row['maxPlayers']}</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                    </table>


                    <!-- filter by user's choice-->
                    <form id ='filter' name="search" method="post" action="">
                        <h4>Filter by a Date Time</h4>
                        <button type="button">
                            <input type="text" name="inputText" placeholder="please input date yyyy-mm-dd"/>
                            <input type="submit" name="SubmitButton" value="Filter"/>
                        </button>
                    </form>

                    <?php
                    if(isset($_POST['SubmitButton'])){ //check if form was submitted
                        echo '<html lang="en">
                    <H2><center>Your Results of Filter by Date</center></H2>
                    <table id="showinfo" width="800" border="1">
                    <tr>
                        <th>recordID</th>
                        <th>playerID</th>
                        <th>matchDate</th>
                        <th>numPlayers</th>
                        <th>result</th>
                    </tr>           
                    </html>';
                        require_once('../php/connect.php');//链接数据库
                        $inputText = $_POST["inputText"];
                        $sql = "SELECT * FROM Records,Members,Matches
                            WHERE matchDate = '$inputText' and Members.username = '$username' and Records.recordID=Matches.recordID and Records.playerID=Members.playerID";
                        foreach ($pdo->query($sql) as $row) {
                            echo "<tr>";
                            echo "<td>{$row['recordID']}</td>";
                            echo "<td>{$row['playerID']}</td>";
                            echo "<td>{$row['matchDate']}</td>";
                            echo "<td>{$row['numPlayers']}</td>";
                            echo "<td>{$row['result']}</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                    </table>

                    <!-- filter by user's choice-->
                    <form id ='filter' name="search" method="post" action="">
                        <h4>Filter by Result Win or Lose</h4>
                        <button type="button">
                            <input type="text" name="inputwin" placeholder="please input win or lose"/>
                            <input type="submit" name="SubBtn" value="Filter"/>
                        </button>
                    </form>

                    <?php
                    if(isset($_POST['SubBtn'])){ //check if form was submitted
                        echo '<html lang="en">
                    <H2><center>Your Results of Filter by Result</center></H2>
                    <table id="showinfo" width="800" border="1">
                    <tr>
                        <th>recordID</th>
                        <th>playerID</th>
                        <th>matchDate</th>
                        <th>numPlayers</th>
                        <th>result</th>
                    </tr>           
                    </html>';
                        require_once('../php/connect.php');
                        $inputwin = $_POST["inputwin"];
                        $sql = "SELECT * FROM Records,Members,Matches
                            WHERE result = '$inputwin' and Members.username = '$username' and Records.recordID=Matches.recordID
                    and Records.playerID=Members.playerID";

                        foreach ($pdo->query($sql) as $row) {
                            echo "<tr>";
                            echo "<td>{$row['recordID']}</td>";
                            echo "<td>{$row['playerID']}</td>";
                            echo "<td>{$row['matchDate']}</td>";
                            echo "<td>{$row['numPlayers']}</td>";
                            echo "<td>{$row['result']}</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                    </table>
                </div>
            </div>
        </div><!-- end content -->
    </section>
</section><!-- end main -->
<script type="text/javascript">
    $(function() {
        $('#leftNavigation').ssdVerticalNavigation();
    });
</script>
</body>
</html>