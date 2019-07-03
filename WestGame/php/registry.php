<?php
/**
 * Created by PhpStorm.
 * User: guoxuantong
 * Date: 2019-03-16
 * Time: 01:39
 */

header("Content-Type: text/html; charset=utf8");
require_once('../php/connect.php');

if(isset($_POST["submit"])) {

    $username = $_POST['username'];
    $password1 = $_POST['password'];
    $password2 = $_POST['password2'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    $salt = "65";
    echo $password1 . $username . $salt;

    $password_hash1 = $password1 . $username . $salt;
    $password_hash1 = hash('sha256', $password_hash1);

    $password_hash2 = $password2 . $username . $salt;
    $password_hash2 = hash('sha256', $password_hash2);

    require_once('../php/connect.php');

    if ($username == "" || $password1 == "")//判断是否填写
    {
        echo "<script type=" . "\"" . "text/javascript" . "\"" . ">" . "window.alert" . "(" . "\"" . "please input info" . "\"" . ")" . ";" . "</script>";
        echo "<script type=" . "\"" . "text/javascript" . "\"" . ">" . "window.location=" . "\"" . "registry.html" . "\"" . "</script>";

    }else{
        $statement = $pdo->query("SELECT * FROM Members where username = '$username';");
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if($row)//0 false 1 true
        {
            echo "<script>alert('user exist! please registry again!');location.href='../html/registry.html'</script>";
        }else{
            if ($password1 != $password2) {
                echo "<script>alert('two passwords must be the same!');location.href='../html/registry.html'</script>";
            }else{
                //check and insert
                $sql = "INSERT INTO Members (username, password,email,firstname,lastname,permission,playerID) VALUES ('$username','$password_hash1','$email','$firstname','$lastname',0,default)";
                $result = $pdo->query($sql);
                if ($result == true) {
                    echo "<script>alert('successfully');window.location= '../html/login.html'</script>";
                } else {
                    echo "<script>alert('please registry again!');location.href='../html/registry.html'</script>";
                }
            }
        }
    }
}

