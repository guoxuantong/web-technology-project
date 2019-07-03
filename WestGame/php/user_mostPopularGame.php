<?php
/**
 * Created by PhpStorm.
 * User: guoxuantong
 * Date: 2019-03-20
 * Time: 13:14
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
    <title>most popular game</title>
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

            <!--search information-->
            <div id="addstu">
                <h4>Search a game details </h4>
                <form name="search" method="post" action="">
                    <button type="button">
                        <input type="text" name="gameName" placeholder="please input game name"/>
                        <input type="submit" name="searchgame" VALUE="搜索">
                    </button>
                </form>
                <?php
                if(isset($_POST['searchgame'])){ //check if form was submitted
                    echo '<html lang="en">
                    <H2><center>Your Results of your search Games Played</center></H2>
                    <table id="showinfo" width="800" border="1">
                    <tr>
                        <th>gameName</th>
                        <th>yearPublished</th>
                        <th>minPlayers</th>
                        <th>maxPlayers</th>
                    </tr>           
                    </html>';
                    require_once('../php/connect.php');//链接数据库
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


                <!-- show all games of user -->
                <H2><center> List of  Popular Games</center></H2>
                <table id="showinfo" width="800" border="1">
                    <tr>
                        <th>gameName</th>
                        <th>yearPublished</th>
                        <th>minPlayers</th>
                        <th>maxPlayers</th>
                    </tr>
                    <?php
                    require_once('../php/connect.php');//链接数据库
                    echo"username: ".$username;
                    $sql = $pdo->query("select *
                                              from Game
                                              order by numPlays desc");
                    foreach ($sql as $row) {
                        echo "<tr>";
                        echo "<td>{$row['gameName']}</td>";
                        echo "<td>{$row['yearPublished']}</td>";
                        echo "<td>{$row['minPlayers']}</td>";
                        echo "<td>{$row['maxPlayers']}</td>";
                    }
                    ?>
                </table>
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