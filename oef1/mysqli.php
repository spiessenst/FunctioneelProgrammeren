<?php
$conn = new mysqli("localhost","root","root","covid19");

// Check connection
if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $conn -> connect_error;
    exit();
}

//define and execute query
$sql = 'select * from gemeente inner join provincie on det_prv_id = prv_id';
$result = $conn->query($sql);

print "<table>";

//show result (if there is any)
if ( $result->num_rows > 0 )
{
// output data of each row
    while( $row = $result->fetch_assoc() )
    {
//var_dump($row); print "<br>";
        echo "<tr>";
        print "<td>" . $row["det_id"] . "</td>";
        print "<td>" . $row["det_niscode"] . "</td>";
        print "<td>" . $row["prv_naam"] . "</td>";
        print "<td>" . $row["det_txt_nl"] . "</td>";
        print "<td>" . $row["det_txt_fr"] . "</td>";
        print "<td>" . $row["det_cases"] . "</td>";


        if ($row["det_image"]){

            $afb= "<img src=./". $row["det_image"].">";
        }

        else{

            $afb="" ;
        }
        print "<td>$afb</td>";

        print "</tr>";
    }
}
else
{
    echo "No records found";
}

print "</table>";

$conn->close();
?>



