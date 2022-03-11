<?php
require_once('bddFunciones.php');
require_once('logsManager.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['user']) && isset($_POST['password']))
    {
        $loginResult=loginOK(filter_input(INPUT_POST,'user'),filter_input(INPUT_POST,'password'));
        if($loginResult==2)
        {
            generateLog(filter_input(INPUT_POST,'user'),0);
            updateLastSignIn(filter_input(INPUT_POST,'user'));
            session_start();
            $_SESSION["user"] = $_POST['user'];
            header('Location: ../mainpage/index.php');
            exit;
        }
        else if($loginResult==1){
            generateLog(filter_input(INPUT_POST,'user'),8);
            header('Location: ../index.php?error=8');
            exit;
        }
        else {
            generateLog(filter_input(INPUT_POST,'user'),1);
        }
    }    
}
header('Location: ../index.php?error=5');






