<?php
function GetData($sql ,$conn)
{
    $result = $conn->query($sql);
    $sqlarray = array();

    while ($row = mysqli_fetch_assoc($result))
        $sqlarray[] = $row;

    return $sqlarray;
}