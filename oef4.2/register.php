<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );
$public_access = true;
require_once "lib/autoload.php";

PrintHead();
PrintJumbo( $title = "Registratie" ,
    $subtitle = "" );
PrintNavbar();

?>

    <div class="container">


<?php
//get data

if (count($old_post) > 0) {

    $data = [ 0 => [ "usr_voornaam" => "$old_post[usr_voornaam]", "usr_naam" => "$old_post[usr_naam]", "usr_email" => "$old_post[usr_email]", "usr_password" => "" ]];
}
else {$data = [ 0 => [ "usr_voornaam" => "", "usr_naam" => "", "usr_email" => "", "usr_password" => "" ]];}


$extra_elements['csrf_token'] = GenerateCSRF();





//get template
$template = file_get_contents("templates/register.html");



//merge
$output = MergeViewWithData( $template, $data );
$output = MergeViewWithExtraElements( $output, $extra_elements );
$output = MergeViewWithErrors( $output, $errors );
$output = RemoveEmptyErrorTags( $output, $data );


print $output;
?>
