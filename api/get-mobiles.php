<?php
//init json
$myObj = new stdClass();
// for 1 to 100
for ($i = 1; $i <= 100; $i++) {
    $myObj->name = "John";
    $myObj->age = 30;
    $myObj->city = "New York";
}
$myJSON = json_encode($myObj);

echo $myJSON;

?>