<?php
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
    <title>show user list</title>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="../css/manager.css">
    <script type="text/javascript" src="../js/manager.js"></script>


    <script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="../js/jquery.ssd-vertical-navigation.min.js"></script>

    <script>
        function doDel(playerID) {
            if (confirm("Are you sure you want to delete?")) {
                window.location = 'action_user.php?action=del&playerID='+playerID;
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
            <H2><center>Show All List of Players</center></H2>
            <table id="showinfo" width="800" border="1">
                <tr>
                    <th>playerID</th>
                    <th>username</th>
                    <th>email</th>
                    <th>firstname</th>
                    <th>lastname</th>
                    <th>permission</th>
                    <th>operation</th>
                </tr>
                <?php
                    require_once('../php/connect.php');//链接数据库
                    $sql = "SELECT * FROM Members";
                    foreach ($pdo->query($sql) as $row) {
                        echo "<tr>";
                        echo "<td>{$row['playerID']}</td>";
                        echo "<td>{$row['username']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "<td>{$row['firstname']}</td>";
                        echo "<td>{$row['lastname']}</td>";
                        echo "<td>{$row['permission']}</td>";
                        echo "<td>
                            <a href='javascript:doDel({$row['playerID']})'>Delete</a>
                            <a href='edit.php?playerID={$row['playerID']}'>Change</a>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
            </table>

            <form id="addstu" name="addstu" method="post" action="action_user.php?action=add">
                <table id="addingtable">
                    <H2><center>Adding User Information</center></H2>
                    <tr>
                        <td>playerID</td>
                        <td><input id="playerID" name="playerID" type="text"/></td>
                    </tr>
                    <tr>
                        <td>username</td>
                        <td><input id="username" name="username" type="text"/></td>
                    </tr>
                    <tr>
                        <td>password</td>
                        <td><input id="password" name="password" type="text"/></td>
                    </tr>
                    <tr>
                        <td>email</td>
                        <td><input type="text" name="email" id="email"/></td>
                    </tr>
                    <tr>
                        <td>firstname</td>
                        <td><input id="firstname" name="firstname" type="text"/></td>
                    </tr>
                    <tr>
                        <td>lastname</td>
                        <td><input id="lastname" name="lastname" type="text"/></td>
                    </tr>
                    <tr>
                        <td>permission</td>
                        <td><input id="permission" name="permission" type="text"/></td>
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