<?php
/**
 * Created by PhpStorm.
 * User: guoxuantong
 * Date: 2019-03-21
 * Time: 04:29
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
    <title>player leaderboard</title>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="../css/manager.css">
    <script type="text/javascript" src="../js/manager.js"></script>

    <script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="../js/jquery.ssd-vertical-navigation.min.js"></script>

    <script>
        function doDel(playerID) {
            if (confirm("Are you sure you want to delete?")) {
                window.location = 'action_match.php?action=del&playerID='+playerID;
            }
        }
    </script>
</head>
<body>

<header>
    <div class="logo">
        <a href="index.php"><img src="../images/logo.png" height="80" width="100" /></a>
    </div><!-- end logo -->

    <div id="menu_icon"></div>
    <nav>
        <ul id="leftNavigation">
            <li class="active"><a href="#">Personal Profile</a>
                <ul>
                    <li>
                        <a href="manager.php"><i></i> - Manager Dashboard</a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="index_manager.php"><i></i> - Matches Played</a>
                    </li>
                </ul>
            </li>
            <li class="active"><a href="#">Player Management</a>
                <ul>
                    <li>
                        <a href="show_user.php"><i></i> - Player List</a>
                    </li>
                    <li>
                        <a href="show_playerLeaderboard.php"><i></i> - Player Leaderboard</a>
                    </li>
                </ul>
            </li>
            <li><a href="#">Game Management</a>
                <ul>
                    <li>
                        <a href="show_game.php"><i></i> - Modify Games</a>
                    </li>
                    <li>
                        <a href="show_gameLeaderboard.php"><i></i> - Game Leaderboard</a>
                    </li>
                </ul>
            </li>
            <li><a href="#">Match Management</a>
                <ul>
                    <li>
                        <a href="show_match.php"><i></i> - List of Matches</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav><!-- end navigation menu -->


</header><!-- end header -->

<section class="main clearfix">

    <section class="top">
        <div class="wrapper content_header clearfix">
            <p class="logincs"><a href="../html/login.html">Login</a> || <a href="../html/registry.html">Registry</a></p>
            <p class="title">Welcome, Manager <?php echo" ".$username;?> </p>
        </div>
    </section><!-- end top -->

    <section class="wrapper">
        <div class="content">

            <div id="showinfo">
            <!-- show user information-->

                <H2><center> Leaderboard of All Players</center></H2>
                <table id="showinfo" width="800" border="1">
                    <tr bgcolor="#dddddd">
                        <th>username</th>
                        <th>Win Times</th>
                    </tr>
                    <?php
                    require_once('../php/connect.php');//链接数据库
                    $sql = $pdo->query("SELECT u.username,COUNT(m.winner)AS wintimes
                                              FROM `Members` AS u LEFT JOIN `Matches` AS m ON u.username = m.winner 
                                              GROUP BY u.username 
                                              ORDER BY COUNT(m.winner) DESC");
                    foreach ($sql as $row) {
                        echo "<tr>";
                        echo "<td>{$row['username']}</td>";
                        echo "<td>{$row['wintimes']}</td>";
                    }
                    ?>
                </table>
            </div>
            <center><p id="showbutton"><a href='show_user.php'>Modify Player Information</a></p></center>
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