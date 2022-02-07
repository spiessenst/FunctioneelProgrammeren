<?php

if(!isset($_SESSION ['user']) AND $public_access == false){
   header( "Location: no_access.php" );
}


