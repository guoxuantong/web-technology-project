<?php
//check login or not
session_start();
$username = $_SESSION['username'];
include('../php/connect.php');
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
    <title>Manager</title>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="../css/manager.css">
    <script type="text/javascript" src="../js/manager.js"></script>

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

            <center><h1> Manager Dashboard </h1></center>
            <div id="showinfo">
                <?php
                require_once('../php/connect.php');//链接数据库
                $users=$pdo->query("select username from Members;");
                $usernames=$users->fetchALL();

                echo '<table border="1" width="600" align="center">';
                echo '<caption><h2>Show statistic of win-played Rate</h2></caption>';
                echo '<tr bgcolor="#dddddd">';
                echo '<th>Username</th><th>Win Rate</th>';
                echo '</tr>';

                for($num=0;$num<count($usernames);$num++)
                {
                    echo '<tr>';
                    $username = $usernames[$num];
                    echo '<td>'.$username[0].'</td>';
                    $rate = $pdo->query("select (select count(*) as win from Members,Records
                                              where Records.playerID = Members.playerID
                                              AND Records.result = 'win'
                                              AND Members.username='$username[0]')
                                              /
                                              (select count(*) as total from Members,Records 
                                              where Records.playerID = Members.playerID 
                                              AND Members.username='$username[0]')");
                    $res=$rate->fetch();
                    echo '<td>'.$res[0].'</td>';
                    echo '</tr>';
                }
                echo '</table>';
                ?>
            </div>

            <H2><center>Show number of match in each day</center></H2>
            <table id="showinfo" width="800" border="1">
                <tr bgcolor="#dddddd">
                    <th>Date</th>
                    <th>Number of match per day</th>
                </tr>
                <?php
                require_once('../php/connect.php');//链接数据库
                $sql = "SELECT * FROM Records";
                $matchtimes = ("SELECT matchDate,SUM(result='win') AS 'date times' 
                                FROM Records GROUP BY matchDate");
                foreach ($pdo->query($matchtimes) as $row) {
                    echo "<tr>";
                    echo "<td>{$row['matchDate']}</td>";
                    echo "<td>{$row['date times']}</td>";
                    echo "</tr>";
                }
                ?>
            </table>
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