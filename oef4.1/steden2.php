<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );



require_once "lib/pdo.php";
require_once "lib/html_functions.php";

PrintHead();

PrintJumbo( $title = "Leuke plekken in Europa" ,
                        $subtitle = "Tips voor citytrips voor vrolijke vakantiegangers!" );
PrintNavbar();
//var_dump( $_SESSION['last_sql'] );
?>

<div class="container">
    <div class="row">

<?php
    //get data
    $data = GetData( "select * from images
inner join  land l on images.img_lan_id = l.lan_id
" );

    //get template
    $template = file_get_contents("templates/column.html");

    //merge
    $output = MergeViewWithData( $template, $data );
    print $output;
?>

    </div>
</div>

</body>
</html>