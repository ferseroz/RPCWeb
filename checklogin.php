<?php
    include('config.php');
    session_start();
    $username=$_POST['username'];
    $password=$_POST['password'];
    $loginstat;

        $query = "SELECT * FROM User WHERE username='$username' AND password='$password' AND activation='1'";
        $result = mysql_query($query);
        if(mysql_num_rows($result))
            {   
                $row = mysql_fetch_array($result);          
                $_SESSION['username']=$row['username'];
                $_SESSION['class']=$row['class'];
                setcookie('username', $_POST['username'], time()+60*60*24*365);
                setcookie('password', $_POST['password'], time()+60*60*24*365);
                $loginstat = true;
            }
        else 
            {
                $loginstat = false;
                echo "Failed to log in";
            }

    if(!file_exists("logs/Login_" . date("Ymd") . ".txt")){
        $flog = "logs/Login_" . date("Ymd") . ".txt";
        $handle = fopen($flog, 'w');
    }

    $clientip = '';
    if (getenv('HTTP_CLIENT_IP'))
        $clientip = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $clientip = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $clientip = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $clientip = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $clientip = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $clientip = getenv('REMOTE_ADDR');
    else
        $clientip = 'UNKNOWN';

    $log  = "IP: ".$clientip.' - '.date("F j, Y, g:i a").PHP_EOL.
        "Login Status: ".($loginstat==true?'Success':'Failed').PHP_EOL.
        "Username: ".$username.PHP_EOL.
        "Password: ".$password.PHP_EOL.
        "-------------------------".PHP_EOL;
        file_put_contents("logs/Login_" . date("Ymd") . ".txt", $log, FILE_APPEND);

        header('Location: index.php');
?>
