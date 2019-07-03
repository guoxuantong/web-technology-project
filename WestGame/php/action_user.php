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
         $playerID = $_POST['playerID'];
         $username = $_POST['username'];
         $password = $_POST['password'];
         $email = $_POST['email'];
         $firstname = $_POST['firstname'];
         $lastname = $_POST['lastname'];
         $permission = $_POST['permision'];

         $sql = "INSERT INTO Members (playerID,username, password,email,firstname,lastname,permission) VALUES (default,'$username','$password_hash1','$email','$firstname','$lastname',0)";
         $rw = $pdo->query($sql);
         if ($rw == true) {
             echo "<script> alert('adding successful');
             window.location='show_user.php'; //跳转到首页
                  </script>";
         } else {
             echo "<script> alert('adding failed');
             window.history.back(); //返回上一页
                  </script>";
         }
         break;
     }

     case "del": {    //1.获取表单信息

         $playerID = $_GET['playerID'];
         $sql = "DELETE FROM Members WHERE playerID = '$playerID';";
         $result = $pdo->query($sql);

         if ($result == true) {
             echo "delete successful！";
             echo "<script>alert('delete successfully!');window.location.href= 'show_user.php'</script>";
         } else {
             echo "<script>alert('delete failed');location.href='show_user.php'</script>";
         }
     }

     case "edit" :{   //1.获取表单信息
         $playerID = $_POST['playerID'];
         $username = $_POST['username'];
         $password = $_POST['password'];
         $email = $_POST['email'];
         $firstname = $_POST['firstname'];
         $lastname = $_POST['lastname'];
         $permission = $_POST['permision'];

         $sql = "UPDATE Members SET playerID='$playerID',username='$username',password='$password',email='$email' WHERE playerID='$playerID'";
         $rw=$pdo->exec($sql);
         if($rw>0){
             echo "<script>alert('change successful');window.location='index.php'</script>";
         }else{
             echo "<script>alert('change failed');window.history.back()</script>";
         }
        break;
    }

 }