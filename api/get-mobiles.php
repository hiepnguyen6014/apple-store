<?php
//init json
$json = array();
//set the status
$json['status'] = true;
//create arr have 5 attribute
$data = array();
for ($i = 0; $i < 100; $i++) {
    //random number 2 to 10
    $old_price = rand(2, 10) * 1000000;
    $price = rand(2, 10) * 1000000;
    //random string have length 10000
    $name = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10000);


    $data[] = array(
        'id' => $i,
        'name' => $name,
        'oldprice' => $old_price,
        'description' => $name,
        'rate' => 3.5,
        'price' => $price,
        'image' => 'http://localhost/mobile/images/' . $i . '.jpg',
    );
}

$json['data'] = $data;

echo json_encode($json);

?>