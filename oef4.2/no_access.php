<?php
$public_access = true;
require_once "lib/autoload.php";
PrintHead();
PrintJumbo( $title = "Geen toegang" ,
$subtitle = "" );

?>

<div class="container">
    <div class="alert alert-success" >U hebt helaas geen toegang! Probeer eventueel <a href="login.php" >in te loggen</a></div>



</div>

</body>
</html>