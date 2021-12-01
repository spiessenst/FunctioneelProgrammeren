<?php

$student =	array(
    "voornaam" =>  "Jan",
    "naam" =>  "Janssens",
    "straat" =>  "Oude baan",
    "huisnr" =>  "22",
    "postcode" =>  2800,
    "gemeente" =>  "Mechelen",
    "geboortedatum" =>  "14/05/1991",
    "telefoon" =>  "015 24 24 26",
    "e-mail" =>  "jan.janssens@gmail.com"
);

$html = null;

print StundentToTable($student);


function StundentToTable($student){
    $html = null;
    $html .= "<h1>Student</h1>";
    $html .= "<table>";

        foreach ($student as $key => $val ){
            $html .= "<tr><td>". ucfirst($key) ."</td><td>".$val."</td></tr>";

        }

    $html .= "</table>";

return $html;

}
