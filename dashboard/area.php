<?php
header('Content-Type: application/json');
require_once("../config.php");

   $name = $user->areaSearchData();
   	 $q = $user->crtstr($_POST["phrase"]);


if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($name as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            $hint[]['name'] = $name;
        }
    }
}
if(isset($hint))
{
echo json_encode($hint);
}







?>
