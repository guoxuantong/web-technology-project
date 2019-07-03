<?php
/**
 * Created by PhpStorm.
 * User: guoxuantong
 * Date: 2019-03-20
 * Time: 03:37
 */


ob_start();
require_once('../php/connect.php');//链接数据库

//3.通过action的值进行对应操作
switch ($_GET['action']) {

    case 'add':
        {   //增加操作
            $recordID = $_POST['recordID'];
            $playerID = $_POST['playerID'];
            $matchDate = $_POST['matchDate'];
            //$matchDate = ($_POST['$matchDate']);
            $numPlayers = $_POST['numPlayers'];
            $result = $_POST['result'];

            $gameID = $_POST['gameID'];
            $winner = $_POST['winner'];


            $pdo->query("INSERT INTO Matches(recordID, gameID, winner) 
                                    values('$recordID','$gameID','$winner')");

            $rw1 = $pdo->query("SELECT LAST_INSERT_ID();");//取结果 pdo object格式
            $t = $rw1->fetch();//转Array fetch（）只取一位，fetchALL（）取array
            $r = $t[0];//取第一位
            //echo "test :$r";

            $sql2 = "INSERT 
                     INTO Records (recordID,playerID,matchDate,numPlayers,result) 
                     VALUES ('$recordID','$playerID','$matchDate','$numPlayers','$result')";

            $rw2 = $pdo->query($sql2);

            if ($rw2) {
                echo "<script> alert('adding successful');
                window.location='user_addMatch.php'; 
                  </script>";
            } else {
                alert($rw2);
            }
            break;
        }


}
