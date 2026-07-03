<?php 

session_start();

$_SESSION = array();

if(ini_get("session.use_cookies")){
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

session_destroy();

header("cache-control: no-store, no-cache, must-revalidate");
header("pragma: no-cache");
header("expires: 0");

header("Location: login.php");
exit()

?>