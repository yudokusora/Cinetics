<?php
function controlError($err){
    switch($err){
        case 0: $string="<script type=\"text/javascript\">var e =alert('Usuario registrado correctamente, activa tu cuenta en tu mail');</script>";break;
        case 1: $string="<script type=\"text/javascript\">var e =alert('El usuario y mail introducidos ya existen');</script>";break;
        case 2: $string="<script type=\"text/javascript\">var e =alert('El usuario introducido ya existe');</script>";break;
        case 3: $string="<script type=\"text/javascript\">var e =alert('El mail introducido ya existe');</script>";break;
        case 4: $string="<script type=\"text/javascript\">var e =alert('El password no mide 8 caracteres');</script>";break;
        case 50: $string="<script type=\"text/javascript\">var e =alert('Usuario verificado correctamente. Cuenta activada');</script>";break;
        case 90: $string="<script type=\"text/javascript\">var e =alert('Contraseña reseteada. Ya puedes loguear con tu nueva contraseña');</script>";break;
    }
    return $string;
}$string2=""
?>