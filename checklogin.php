<?php
    include('config.php');
    session_start();
    $username=$_POST['username'];
    $password=$_POST['password'];

        $query = "SELECT * FROM User WHERE username='$username' AND password='$password'";
        $result = mysql_query($query);
        if(mysql_num_rows($result))
            {   
                $row = mysql_fetch_array($query);          
                $_SESSION['username']=$row['username'];
                $_SESSION['class']=$row['class'];
                //$_SESSION['password']=$row['Password'];
                //$_SESSION['fname']=$row['Firstname'];
                //$_SESSION['lname']=$row['Lastname'];
                //$_SESSION['class']=$row['Class'];
                //setcookie('email', $_POST['email'], time()+60*60*24*365);
                //setcookie('password', $_POST['password'], time()+60*60*24*365);
                header('Location: index.html');
		//echo "Done!";
            }
        else 
            {
                echo "Failed to log in";
            }
?>