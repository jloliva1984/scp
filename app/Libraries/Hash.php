<?php 
 namespace App\libraries;

 class Hash
 {
     public static function hash_password($password)
     {
         return password_hash($password,PASSWORD_BCRYPT);
     }
 }

?>