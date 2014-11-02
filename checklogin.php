<?php
    include('config.php');
    session_start();
    $username=$_POST['username'];
    $password=$_POST['password'];

        $query = "SELECT * FROM User WHERE username='$username' AND password='$password'";
        $result = mysql_query($query);
        if(mysql_num_rows($result))
            {   
                $row = mysql_fetch_array($result);          
                $_SESSION['username']=$row['username'];
                $_SESSION['class']=$row['class'];
                setcookie('username', $_POST['username'], time()+60*60*24*365);
                setcookie('password', $_POST['password'], time()+60*60*24*365);
                header('Location: index.php');
            }
        else 
            {
                echo "Failed to log in";
            }
?>
