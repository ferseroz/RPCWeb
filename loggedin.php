<?php
include('config.php');
//session_start();
function check() {
    if (isset($_COOKIE["username"])) {
        $username = $_COOKIE["username"];
        $password = $_COOKIE["password"];
        $query = "SELECT * FROM USER WHERE username='$username' and password='$password'";
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);
        $_SESSION['userid'] = $row['userid'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['class'] = $row['class'];
        return true;
    }
    else {
        return false;
    }
}
?>