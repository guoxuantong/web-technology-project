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
    <title>API gameinfo</title>
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
            <li><a href="load_API_gameInfo.php.php">Additional Game Info</a></li>
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
            <H2><center> Additional Games' Information</center></H2>
            <table id="showinfo" width="800" border="1">
                <tr>
                    <th class="tg-0pky">Game Name</th>
                    <th class="tg-0pky">Get API</th>
                </tr>
                <tr>
                    <td class="tg-0pky">10 Days in Africa(7865)</td>
                    <td class="tg-0pky">
                        <input type="button" value="Get More Info" id='btnAjax1'>
                        <div id="pick1"></div>
                    </td>
                </tr>
                <tr>
                    <td class="tg-zd5i">10 Days in Europe(5867)</td>
                    <td class="tg-0pky">
                        <input type="button" value="Get More Info" id='btnAjax2'>
                        <div id="pick2"></div>
                    </td>
                </tr>
                <tr>
                    <td class="tg-0pky">10 Days in the Americas(64956)</td>
                    <td class="tg-0pky">
                        <input type="button" value="Get More Info" id='btnAjax3'>
                        <div id="pick3"></div>
                    </td>
                </tr>
            </table>


            <script type="text/javascript">
                //绑定点击事件
                document.querySelector('#btnAjax1').onclick = function () {
                    //发送ajax 请求 需要 五步
                    //创建异步对象
                    var ajaxObj = new XMLHttpRequest();
                    //设置请求的参数。包括：请求的方法、请求的url。
                    ajaxObj.open('get', 'https://bgg-json.azurewebsites.net/thing/7865');
                    //发送请求
                    ajaxObj.send();
                    //注册事件。 onreadystatechange事件，状态改变时就会调用。
                    //如果要在数据完整请求回来的时候才调用，我们需要手动写一些判断的逻辑。
                    ajaxObj.onreadystatechange = function () {
                        //为了保证 数据 完整返回，我们一般会判断 两个值
                        if (ajaxObj.readyState == 4 && ajaxObj.status == 200) {
                            //如果能够进到这个判断 说明 数据 完美的回来了,并且请求的页面是存在的
                            //5.在注册的事件中 获取 返回的 内容 并修改页面的显示
                            console.log('data return successful');
                            //数据是保存在 异步对象的 属性中
                            console.log(ajaxObj.responseText);
                            //修改页面的显示
                            document.getElementById('pick1').innerHTML = ajaxObj.responseText;
                        }
                    }
                }

                document.querySelector('#btnAjax2').onclick = function () {
                    var ajaxObj = new XMLHttpRequest();
                    ajaxObj.open('get', 'https://bgg-json.azurewebsites.net/thing/5867');
                    ajaxObj.send();
                    ajaxObj.onreadystatechange = function () {
                        if (ajaxObj.readyState == 4 && ajaxObj.status == 200) {
                            console.log('data return successful');
                            console.log(ajaxObj.responseText);
                            document.getElementById('pick2').innerHTML = ajaxObj.responseText;
                        }
                    }
                }

                document.querySelector('#btnAjax3').onclick = function () {
                    var ajaxObj = new XMLHttpRequest();
                    ajaxObj.open('get', 'https://bgg-json.azurewebsites.net/thing/64956');
                    ajaxObj.send();
                    ajaxObj.onreadystatechange = function () {
                        if (ajaxObj.readyState == 4 && ajaxObj.status == 200) {
                            console.log('data return successful');
                            console.log(ajaxObj.responseText);
                            document.getElementById('pick3').innerHTML = ajaxObj.responseText;
                        }
                    }
                }
            </script>
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