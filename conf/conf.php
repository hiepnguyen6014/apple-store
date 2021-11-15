<?php
    require_once('db.php');
    function login($user,$pass){
        $sql = "select * from admin where username = ?";
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm -> bind_param('s',$user);
        if (!$stm->execute()){
            return array('code' => 1,'error' => 'Can not execute');
        }
        $result = $stm->get_result();
        if($result->num_rows==0){
            return array('code' => 1,'error' => 'User does not exists');
        }
        $data = $result->fetch_assoc();

        // $hashed_password = $data['password'];
        if(($pass != $data['password'])){
            return array('code' => 2,'error' => 'Invalid password');
        }
        // else if ($data['activated']==0){
        //     return array('code' => 3,'error' => 'This account is not activated');
        // }
        else{
            return array('code' => 0,'error' => '','data' => $data);
        }
    }
    function getAllUser(){
        $conn = open_database();
        $sql = 'SELECT * FROM user';
        $stm = $conn->prepare($sql);
        
        if (!$stm->execute()){
            return array('code' => 1,'error' => 'Can not execute');
        }
        $result = $stm -> get_result();
        $data = array();
        while($row = $result -> fetch_assoc() ){
            $data[] = $row;
        }
        return json_encode(array('code' => 0, 'data' => $data));
    }
    // function deleteUser($id){
    //     $conn = open_database();
    //     $sql = "delete from user where user_Id = ? ";
    //     $stm = $conn->prepare($sql);
    //     $stm -> bind_param('s',$id);
    //     if (!$stm->execute()){
    //         return array('code' => 1,'error' => 'Can not execute');
    //     }
    //     return array('code' => 0,'success' => 'Data deleted ');
    // }
?>