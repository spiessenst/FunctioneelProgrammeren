<?php
require_once "functions.php";


$sql = "update images set img_id= " .  $_POST['img_id'] .
    ", img_title= " .  "'" . $_POST['img_title'] .  "'" .
    ", img_filename= " . "'" . $_POST['img_filename'] . "'" .
    ", img_width= " .  $_POST['img_width'] .
    ", img_height= " .  $_POST['img_height'] .
    " where img_id  = " . $_POST['img_id'];

 ExecSQL($sql)   ? header("Location: steden.php") : Print "Error";
