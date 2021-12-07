<?php
function PrintHead($title){

$html = file_get_contents("./templates/head.html");

$head = str_replace("@@title@@" , "$title" , $html);

return $head;
}

function PrintJumbo($title , $paragraph){

    $html = file_get_contents("./templates/jumbo.html");

    $search = array('@@title@@', '@@paragraph@@');
    $replace = array($title, $paragraph);


    $jumbo = (str_replace($search, $replace, $html));

return $jumbo;

}

function PrintBody(){

    return "<body>";

}