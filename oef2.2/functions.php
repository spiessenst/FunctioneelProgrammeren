<?php
require_once "config.php";

function GetData($sql)
{
    global $servername, $username, $password, $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $result = $conn->query($sql);
    $sqlarray = array();

    while ($row = mysqli_fetch_assoc($result))
        $sqlarray[] = $row;

    $conn->close();

    return $sqlarray;
}

function ExecSQL( $sql )
{
    // create connection

    global $servername, $username, $password, $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);

    // check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // execute given query
    $result = $conn->query($sql);

    return $result;
}

function MakeSelect( $fieldname, $sql, $list_fields = [], $optional = true )
{
    $rows = GetData($sql);

    $myselect = "";

    $myselect .= "<select id=$fieldname name=$fieldname>";

    if ( $optional ) $myselect .= "<option></option>";

    foreach ( $rows as $row )
    {
        $myselect .= "<option value='" . $row[$list_fields[0]] . "'>" . $row[$list_fields[1]] . "</option>";
    }

    $myselect .= "</select>";

    print $myselect;
}

