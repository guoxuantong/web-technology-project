<?php
/**
 * Created by PhpStorm.
 * User: guoxuantong
 * Date: 2019-03-20
 * Time: 00:03
 */

ob_start();
require_once('../php/connect.php');//链接数据库

//3.通过action的值进行对应操作
switch ($_GET['action']) {

    case 'add':
        {   //增加操作
            $recordID = $_POST['recordID'];
            $playerID = $_POST['playerID'];
            //$matchDate = $_POST['matchDate'];
            //$numPlayers = $_POST['numPlayers'];
            $result = $_POST['result'];


            $s1 = "SELECT distinct Records.matchDate FROM Records
                            where recordID='$recordID'";
            $result1 = $pdo->query($s1);
            $t1 = $result1->fetch();
            $matchDate = $t1[0];


            $s2 = "SELECT Records.numPlayers FROM Records
                            where recordID='$recordID'";
            $result2 = $pdo->query($s2);
            $t2 = $result2->fetch();
            $numPlayers = $t2[0]+1;


            $pdo->query("INSERT INTO Records (recordID,playerID,matchDate,numPlayers,result) 
                                    VALUES ('$recordID','$playerID','$matchDate','$numPlayers','$result')");
            $rw1 = $pdo->query("SELECT LAST_INSERT_ID();");
            $t = $rw1->fetch();
            $r = $t[0];//取第一位


            //update Records set numPlayers=numPlayers+1 where recordID ='$recordID';
            $sql2 = " update Records set numPlayers='{$numPlayers}'where recordID ='$recordID';";
            $rw2 = $pdo->query($sql2);

            if ($rw2) {
                echo "<script> alert('adding successful');
                window.location='show_match.php'; 
                  </script>";
            } else {
                alert($rw2);
            }
            break;
        }


    case "del":
        {    //1.获取表单信息

            $playerID = $_GET['playerID'];

            $pdo->query("DELETE FROM Records WHERE playerID = '$playerID';");
            //$rw1 = $pdo->query("SELECT LAST_INSERT_ID();");
            //$t = $rw1->fetch();
            //update Records set numPlayers=numPlayers+1 where recordID ='$recordID';

            $dels2 = "SELECT Records.numPlayers FROM Records
                            where recordID='$recordID'";
            $delresult2 = $pdo->query($dels2);
            $delt2 = $delresult2->fetch();
            $delnumPlayers = $delt2[0]-1;

            $sql2 = " update Records set numPlayers='$delnumPlayers' where recordID ='$recordID';";
            $rw2 = $pdo->query($sql2);

            if ($rw2) {
                echo "<script>alert('delete successfully!');window.location.href= 'show_match.php'</script>";
            } else {
                echo "<script>alert('delete failed');location.href='show_match.php'</script>";
            }

        }


    case "edit" :
        {   //1.获取表单信息
            $id = $_POST['id'];
            $name = $_POST['name'];
            $sex = $_POST['sex'];
            $classid = $_POST['classid'];
            $age = $_POST['age'];

            $sql = "UPDATE stu SET name='{$name}',sex='{$sex}',age='{$age}',classid='{$classid}' WHERE id='{$id}'";
            $rw = $pdo->exec($sql);
            if ($rw > 0) {
                echo "<script>alert('修改成功');window.location='index.php'</script>";
            } else {
                echo "<script>alert('修改失败');window.history.back()</script>";
            }

            break;
        }
}
