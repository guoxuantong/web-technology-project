<?php
/**
 * Created by PhpStorm.
 * User: guoxuantong
 * Date: 2019-03-20
 * Time: 03:33
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
    <title>add match</title>
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

      <!--adding match information-->
            <form id="addstu" name="addstu" method="post" action="action_user_addMatch.php?action=add">
                <table id="addingtable">
                    <H2><center>Add a record for your Match</center></H2>
                    <tr>
                        <td>recordID</td>
                        <td><input id="recordID" name="recordID" type="text"/></td>
                    </tr>
                    <tr>
                        <td>playerID</td>
                        <td><input id="playerID" name="playerID" type="text"/></td>
                    </tr>
                    <tr>
                        <td>matchDate</td>
                        <td><input id="matchDate" name="matchDate" type="text" placeholder="yyyy-mm-dd"/></td>
                    </tr>
                    <tr>
                        <td>numPlayers</td>
                        <td><input id="numPlayers" name="numPlayers" type="text"/></td>
                    </tr>
                    <tr>
                        <td>result</td>
                        <td><input id="result" name="result" type="text"/></td>
                    </tr>
                    <tr>
                        <td>gameID</td>
                        <td><input id="gameID" name="gameID" type="text"/></td>
                    </tr>
                    <tr>
                        <td>winner</td>
                        <td><input id="winner" name="winner" type="text" placeholder="winner's username"/></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="Adding"/>&nbsp;&nbsp;
                            <input type="reset" value="Reset"/>
                        </td>
                    </tr>
                </table>
            </form>
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