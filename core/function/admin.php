<?php
$con = mysqli_connect('localhost','root','','mvc');

function user_id_from_email($con,$email){

    $sql = "SELECT `id` FROM `adminusers`  WHERE `email` = '$email'";
    $query = mysqli_query($con,$sql);
    $fetcharray=mysqli_fetch_array($query,MYSQLI_NUM);
    return $fetcharray[0];

}


function login($con,$email,$password){

    $user_id= user_id_from_email($con,$email);
    $password = md5($password);

    $query=mysqli_query($con,"SELECT * FROM `adminusers` WHERE `email`= '$email' AND `password`='$password'");
    $result=mysqli_num_rows($query);
    return ($result==1) ? $user_id :false;

}

function user_data($con,$id){
    $data =array();
    $id= (int)$id;

    $get_num = func_num_args();
    $get_args =func_get_args();

    if($get_num>1){
        unset($get_args[0],$get_args[1]);
        $fields = '`'. implode('`,`',$get_args). '`';

        $res=mysqli_query($con,"SELECT $fields FROM `adminusers` WHERE `id`= $id");
        $data = mysqli_fetch_assoc($res);
        return $data;

    }

}

function logged_in(){

    return(isset($_SESSION['id'])) ? true : false;

}

if(isset($_GET['call'])) {



       $sql = " SELECT email from staff";
        $res = mysqli_query($con, $sql);

        if (mysqli_num_rows($res) > 0) {

            while ($row = mysqli_fetch_assoc($res)) {

                echo '<option value="' . $row['email'] . '">' . $row['email'] . '</option>';
            }



        }

}

if(isset($_POST['submit'])){

    $subject = $_POST[''];


}

function adminusers($con,$id){
    $sql = "SELECT id,name,role,email FROM adminusers WHERE id =$id";
    $res = mysqli_query($con,$sql);
    return $res;


}


function postdata($con,$postdata){

    $fields='`' .implode('`,`' ,array_keys($postdata)) . '`';
    $data='\'' . implode('\', \'' ,$postdata ) . '\' ';

    $sql = "INSERT INTO posts ($fields) VALUE ($data)";
    mysqli_query($con,$sql);

}

function published($con,$id){

    $sql = "SELECT posts.adminid,posts.subject,posts.date,adminusers.name,adminusers.role FROM posts INNER JOIN adminusers WHERE type = 1 AND adminusers.id=posts.adminid";
    $res = mysqli_query($con,$sql);
    return $res;

}

function allusers($con,$id){
    $sql = "SELECT * FROM staff";
    $res = mysqli_query($con,$sql);
    return $res;


}

function countmembers(){




}

function adduser($con,$postdata){

    $fields='`' .implode('`,`' ,array_keys($postdata)) . '`';
    $data='\'' . implode('\', \'' ,$postdata ) . '\' ';

    $sql = "INSERT INTO staff ($fields) VALUE ($data)";
    mysqli_query($con,$sql);

}


function email($to,$subject,$body){
    mail($to,$subject,$body, ' From:Computer and Service Center - University of Colombo School of Computing');
}

function change_profile_image($con,$user_id,$file_temp,$file_extn) {
    $file_path='public/dist/img/profile/' . substr(md5(time()),0,10) . '.' . $file_extn;
    move_uploaded_file($file_temp,$file_path);
    $query="UPDATE adminusers SET profile = '" . $file_path . "' WHERE id= " . (int)$user_id;
    mysqli_query($con,$query);
    return $file_path;

}
