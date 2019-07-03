<?php
/**
 * Created by PhpStorm.
 * User: guoxuantong
 * Date: 2019-03-18
 * Time: 23:44
 */
ob_start();
require_once('../php/connect.php');//链接数据库

//3.通过action的值进行对应操作
switch ($_GET['action']) {

    case 'add':{   //增加操作
        $gameID = $_POST['gameID'];
        $gameName = $_POST['gameName'];
        $yearPublished = $_POST['yearPublished'];
        $numPlays = $_POST['numPlays'];
        $minPlayers = $_POST['minPlayers'];
        $maxPlayers = $_POST['maxPlayers'];

        $sql = "INSERT INTO Game (gameID,gameName, yearPublished, numPlays, minPlayers, maxPlayers) VALUES ('$gameID','$gameName','$yearPublished','$numPlays','$minPlayers','$maxPlayers')";
        $rw = $pdo->query($sql);
        if ($rw == true) {
            echo "<script> alert('adding successful');
             window.location='show_game.php'; 
                  </script>";
        } else {
            echo "<script> alert('adding failed');
             window.history.back(); //返回上一页
                  </script>";
        }
        break;
    }

    case "del": {    //1.获取表单信息

        $gameID = $_GET['gameID'];

        $sql = "DELETE FROM Game WHERE gameID = '$gameID';";
        $result = $pdo->query($sql);

        if ($result == true) {
            //echo "delete successful！";
            echo "<script>alert('delete successfully!');window.location.href= 'show_game.php'</script>";
        } else {
            echo "<script>alert('delete failed');location.href='show_game.php'</script>";
        }

    }

    case "edit" :{   //1.获取表单信息
        $gameID = $_POST['gameID'];
        $gameName = $_POST['gameName'];
        $yearPublished = $_POST['yearPublished'];
        $numPlays = $_POST['numPlays'];
        $minPlayers = $_POST['minPlayers'];
        $maxPlayers = $_POST['maxPlayers'];

        $sql = "UPDATE Game SET gameID='$gameID',gameName='$gameName',yearPublished='$yearPublished',numPlays='$numPlays',minPlayers='$minPlayers',maxPlayers='$maxPlayers'
                WHERE gameID='$gameID'";
        $rw=$pdo->exec($sql);
        if($rw>0){
            echo "<script>alert('change successful');window.location='index.php'</script>";
        }else{
            echo "<script>alert('change failed');window.history.back()</script>";
        }

        break;
    }

}