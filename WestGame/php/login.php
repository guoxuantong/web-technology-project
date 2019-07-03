<?php
ob_start();
header("Content-Type: text/html; charset=utf8");
if(!isset($_POST["submit"])){
    exit("错误执行");
}//verify if has submit or not
else{
}

$username = $_POST['username'];//post获得用户名表单值
$password = $_POST['password'];//post获得用户密码单值

$salt = "65";
$password_hash = $password . $username . $salt;
echo $password . $username . $salt;

$password_hash = hash('sha256', $password_hash);


require_once('../php/connect.php');//connect to database

if ($username && $password)//if password and userword is not empty
{
    echo "haasword : ".$password_hash;

    $pdo = new PDO($db_host.';'.$db_name, $db_user, $db_pass);
    $statement = $pdo->query("SELECT * FROM Members where username = '$username' and password='$password_hash';");
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    if($row)//0 false 1 true
    {
        // Verify the administrator login
        $st = $pdo->query("SELECT permission FROM Members where username = '$username';");
        $r = $st->fetch(PDO::FETCH_ASSOC);
        if($r['permission']=="1"){
            //manager login successful
            header('location:manager.php');
            session_start();
            $_SESSION['username']=$username;

        }else{
            //player login successful
            header('location:index.php');//if login successful change to index.php
            session_start();
            $_SESSION['username']=$username;
        }
    }else {
        echo "<script>alert('username or password incorrect!');
        location.href='../html/login.html'</script>";
        echo "
             <script>
                 setTimeout(function(){window.location.href='../html/login.html';},9000);
             </script>";
    }
}else{//if the info is not full
    echo "<script>alert('please input full information!');
    location.href='../html/login.html'</script>";
    echo "
             <script>
                 setTimeout(function(){window.location.href='../html/login.html';},9000);
             </script>";
    //use js change to login page if it has error after 9s;
}

?>