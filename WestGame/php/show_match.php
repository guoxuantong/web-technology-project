<?php
/**
 * Created by PhpStorm.
 * User: guoxuantong
 * Date: 2019-03-19
 * Time: 04:05
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
    <title>show match</title>
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
            <li><a href="#">Player Management</a>
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

            <!-- show user information-->
            <H2><center>Show All List of Matches</center></H2>
            <table id="showinfo" width="800" border="1">
                <tr>
                    <th>recordID</th>
                    <th>playerID</th>
                    <th>result</th>
                    <th>matchDate</th>
                    <th>numPlayers</th>
                    <th>operation</th>
                </tr>
                <?php
                    require_once('../php/connect.php');//链接数据库
                $sql = "SELECT  Records.recordID, Records.playerID, Records.result, Records.matchDate, Records.numPlayers
                        FROM Records
                        ";
                    foreach ($pdo->query($sql) as $row) {
                        echo "<tr>";
                        echo "<td>{$row['recordID']}</td>";
                        echo "<td>{$row['playerID']}</td>";
                        echo "<td>{$row['result']}</td>";
                        echo "<td>{$row['matchDate']}</td>";
                        echo "<td>{$row['numPlayers']}</td>";
                        echo "<td>
                            <a href='javascript:doDel({$row['playerID']})'>Delete</a>
                            <!--<a href='edit.php?playerID={$row['playerID']}'>Change</a>-->
                            </td>";
                        echo "</tr>";
                    }
                    ?>
            </table>

            <!--adding match information-->
            <form id="addstu" name="addstu" method="post" action="action_match.php?action=add">
                <table id="addingtable">
                    <H2><center>Adding Players in a Match</center></H2>
                    <tr>
                        <td>recordID</td>
                        <td><input id="recordID" name="recordID" type="text"/></td>
                    </tr>
                    <tr>
                        <td>playerID</td>
                        <td><input id="playerID" name="playerID" type="text"/></td>
                    </tr>
                    <tr>
                        <td>result</td>
                        <td><input id="result" name="result" type="text"/></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="Adding"/>&nbsp;&nbsp;
                            <input type="reset" value="Reset"/>
                        </td>
                    </tr>
                </table>
            </form>

            <!--search information-->
            <div id="addstu">
                <h2><center>Search</center></h2>
                <h4>Search your matches of game played </h4>
                <form name="search" method="post" action="">
                    <button type="button">
                        <input type="text" name="recordID" placeholder="please input record ID"/>
                        <input type="submit" name="searchbtn" VALUE="搜索">
                    </button>
                </form>

                <?php
                if(isset($_POST['searchbtn'])){ //check if form was submitted
                    echo '<html lang="en">
                    <H2><center>Your Results of your search Games Played</center></H2>
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
                    $recordID = $_POST["recordID"];
                    $sql = "SELECT * FROM Records,Members 
                        WHERE recordID = '$recordID' and Members.username = '$username'";
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