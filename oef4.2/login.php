<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

require_once "lib/autoload.php";


require_once "lib/autoload.php";

PrintHead();
PrintJumbo( $title = "Login", $subtitle = "" );
PrintNavbar();
?>

<div class="container">
    <div class="row">

        <?php

        $data = [ 0 => [ "usr_email" => "", "usr_password" => "" ]];


$extra_elements['csrf_token'] = GenerateCSRF();


//get template
$template = file_get_contents("templates/login.html");



//merge
$output = MergeViewWithData( $template, $data );
$output = MergeViewWithExtraElements( $output, $extra_elements );
//$output = MergeViewWithErrors( $output, $errors );
//$output = RemoveEmptyErrorTags( $output, $data );


print $output;

        ?>

    </div>
</div>

</body>
</html>