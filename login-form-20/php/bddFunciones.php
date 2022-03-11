<?php


function connectaDB(){
    //$cadenaConnexio = 'mysql:dbname=cinetics;host=localhost:3307'; // Conexion Gerard
    $cadenaConnexio = 'mysql:dbname=cinetics;host=localhost'; //Conexion Gallego
    $usuari = 'root';
    $passwd = '1234'; //Gallego
    //$passwd = '';//Gerard
   
    try{
        $db = new PDO($cadenaConnexio, $usuari, $passwd, 
                        array(PDO::ATTR_PERSISTENT => true));
        return $db;
    }catch(PDOException $e){
        echo 'Error amb la BDs: ' . $e->getMessage();
        return $e;
    }
}


function loginOK ($user,$pwd)
{ 
    $okloguejat=0;
    $db = connectaDB();
    $sql = 'SELECT username, passHash, active FROM `users` WHERE username= ?';
    $usuaris = $db->prepare($sql);
    $usuaris->execute(array($user));
    if($usuaris){
        $linies=$usuaris->rowCount();

        if ($linies>0){
            foreach ($usuaris as $fila) {      
                if(password_verify($pwd,$fila['passHash'])){
                    if ($fila['active']==1)$okloguejat=2;
                    else $okloguejat=1;
                }
            }       
        }    
    }
    return $okloguejat;
}


function checkMailAccount($mail, $activationCode)
{

   

    $db = connectaDB();
    $sql = 'SELECT * FROM `users` WHERE `mail`=:mail AND `activationCode`=:activationCode';
    $codigoOK = $db->prepare($sql);
    $codigoOK->execute(array(':mail'=>$mail,':activationCode'=>$activationCode));
    
        $linies=$codigoOK->rowCount();
        if($linies>0)
        {
            $sql = 'UPDATE `users` SET `activationCode`="", `active`=1, `activationDate`= now() WHERE `mail`=:mail';
            $update = $db->prepare($sql);
            $update->execute(array(':mail'=>$mail));
            return 1; // return true
            
        }
    
        return 0; // return false
}

function registerOk ($user,$pwd,$firstname,$lastname,$email,$activationCode)
{
    $db=connectaDB();
    $pwd = password_hash($pwd,PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO `users` (`mail`, `username`, `passHash`, `userFirstName`, `userLastName`,`activationCode`) VALUES (:mail,:user,:pwd,:firstname,:lastname,:activationcode)";  
        $insert=$db->prepare($sql);
        $insert->execute(array(':mail'=>$email,':user'=>$user,':pwd'=>$pwd,':firstname'=>$firstname,':lastname'=>$lastname, ':activationcode'=>$activationCode));
        return $insert;
  
}
function getIdUser($username){
    $db=connectaDB();
    $sql = "SELECT `iduser` FROM `users` WHERE `username`=:user";  
    $select=$db->prepare($sql);
    $select->execute(array(':user'=>$username));
    $datos = $select ->fetchAll();
    return $datos[0]['iduser'];    
}
function updateLastSignIn ($user)
{
    $db=connectaDB();   
    $sql = 'UPDATE `users` SET `lastSignIn`=NOW() WHERE `username`=:user';
    $update = $db->prepare($sql);
    $update->execute(array(':user'=>$user));

}

function comprobarExistentes($user,$email){

    $db=connectaDB();
    $sqlUsuari='SELECT `username` FROM `users` WHERE `username`= ?';
    $sqlMail='SELECT `mail` FROM `users` WHERE `mail`= ?';
    $preparadaUsuari=$db->prepare($sqlUsuari);
    $preparadaUsuari->execute(array($user));
    $usuariRepetits=$preparadaUsuari->rowCount();
    $preparadaMail=$db->prepare($sqlMail);
    $preparadaMail->execute(array($email));
    $emailRepetits=$preparadaMail->rowCount();
    $error=0; // Cap repetit

    if($usuariRepetits&&$emailRepetits)$error=1; //Ambos Repetidos
    elseif($usuariRepetits)$error=2; //user Repetidos
    elseif($emailRepetits) $error=3; // Mail repetido

    return $error;
}

function resetPassPost($resetPassCode,$password)
{
    $db = connectaDB();
    if(strlen($password)>7)
    {  
        $newPass =password_hash($password,PASSWORD_DEFAULT) ;
        $sql = 'UPDATE `users` SET `resetPassCode`="",`passHash`= :pass WHERE `resetPassCode`=:resetCode';
        $update = $db->prepare($sql);
        $update->execute(array(':pass'=>$newPass,':resetCode'=>$resetPassCode));
        return 90;  
    }
    return 4;
}

function resetPassGet($mail,$resetCode)
{   
    $db = connectaDB();
    $sql = 'SELECT * FROM `users` WHERE `mail`=:mail AND `resetPassCode`=:resetCode';
    $codigoOK = $db->prepare($sql);
    $codigoOK->execute(array(':mail'=>$mail,':resetCode'=>$resetCode));
    $datos = $codigoOK->fetchAll();

    if (isset($datos[0]['resetPassExpiry']))
    {
        $expira = $datos[0]['resetPassExpiry'];
    } 
        $linies=$codigoOK->rowCount();
      
        if(!($linies>0&&date("Y-m-d H:i:s")<$expira))
        {                
            $resetCode = 0;       
        }
        return $resetCode;
}
function obtenirReaccioVideo($username,$video)
{

}
function videoExiste($path)
{
    $db = connectaDB();
    $sql = 'SELECT `idVideo`,`description` FROM `videos` WHERE `path`=:patho';
    $codigoOK = $db->prepare($sql);
    $codigoOK->execute(array(':patho'=>$path));
    $datos = $codigoOK->fetchAll();

    return $datos;
}

function recuperarReacciones($idVideo)
{
    $db = connectaDB();
    $sql = 'SELECT SUM(`vote`) `likes`,SUM(NOT `vote`) `dislikes` FROM `videoReactions` WHERE `videosIdVideo`=:idVideo';
    $codigoOK = $db->prepare($sql);
    $codigoOK->execute(array(':idVideo'=>$idVideo));
    $datos = $codigoOK->fetchAll();

    return $datos;
}
function insertarVideo($username,$path,$description,$hashtags)
{
    $user = getIduser($username);
    $db=connectaDB();
    //insert del video a la bdd (path). 
    $sql = "INSERT INTO `videos`(`path`,`description`,`usersIduser`)VALUES(:pathU,:descriptionU,:usersIduser)";  
    $insert=$db->prepare($sql);
    $insert->execute(array(':pathU'=>$path,':descriptionU'=>$description,':usersIduser'=>$user));
    //con hacer el insert anterior, recuperar la idVideo asignada
    $idVideo = $db->lastInsertId();
    if (count($hashtags)>0){    
    //insert de los hashtags a la bdd. con los inserts anteriores nos darán los ids de Hashtag.
    $idHashtags=tratarHashtags($hashtags,$db);   
    //Con la idVideo y los idHashtags, hacer los inserts a la tabla videosHashtag.
    vincularVideoHashtags($idVideo,$idHashtags,$db);
    }
}

function tratarHashtags($hastagsList,$db)
{
    $arrayHashtag = [];
    foreach ($hastagsList as $valor)
    {
        $valor=strtolower($valor);
        $sql = "SELECT `idHashtag` FROM `hashtags` WHERE `tag`=:valor";  
        $select=$db->prepare($sql);
        $select->execute(array(':valor'=>$valor));
        $linies=$select->rowCount();

        if($linies>0)
        {
            $datos = $select->fetchAll();
            array_push($arrayHashtag,$datos[0]['idHashtag']); 
        }
        else
        {
            $sql = "INSERT INTO `hashtags`(`tag`)VALUES(:tag)"; 
            $insert=$db->prepare($sql);
            $insert->execute(array(':tag'=>$valor));
            $idHashtag = $db->lastInsertId();
            array_push($arrayHashtag,$idHashtag);
        }

    }
    return $arrayHashtag;
}
function vincularVideoHashtags($idVideo,$idHashtags,$db)
{
    foreach ($idHashtags as $id)
    {
        $sql = "INSERT INTO `videoHashtags` VALUES (:idVideo,:idHashtag)";
        $insert=$db->prepare($sql);
        $insert->execute(array(':idVideo'=>$idVideo,':idHashtag'=>$id));
    }
}
function obtenirVideoAleatori() 
{
    $db = connectaDB();
    $sql = 'SELECT `path` FROM `videos` ORDER BY RAND() LIMIT 1';
    $video = $db->prepare($sql);
    $video->execute(array());
    $datos = $video->fetchAll();
    if (count($datos)==0)
    {
        return 0;
    }
    return $datos[0]['path'];

}
function obtenirVideosAleatoris()
{
    $arrayVideos = [];
    $db = connectaDB();
    $sql = 'SELECT `path` FROM `videos` ORDER BY RAND() LIMIT 9';
    $videos = $db->prepare($sql);
    $videos->execute(array());
    $datos = $videos->fetchAll();
    foreach($datos as $video) array_push($arrayVideos,$video['path']);
    return $arrayVideos;
}
?>