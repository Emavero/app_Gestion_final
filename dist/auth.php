<?php
class Auth{
    static function isLogged(){
        if(isset($_SESSION['Auth']) && isset($_SESSION['Auth']['login']) && isset($_SESSION['Auth']['password']) && isset($_SESSION['Auth']['id_user']))
        {
            return true;
        }else{
            return false;
        }
    }
}
?>