<?php
//init json
$json = array();
//set the status
$json['status'] = true;
//create arr have 5 attribute
$data = array();
for ($i = 0; $i < 100; $i++) {
    $data[] = array(
        'id' => $i,
        'name' => 'name' . $i,
        'price' => $i * 100
    );
}

$json['data'] = $data;

echo json_encode($json);

?>