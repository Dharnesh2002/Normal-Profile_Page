<?php 
include("config.php");

if(isset($_POST['save_reg']))
{
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $pass = mysqli_real_escape_string($db, $_POST['pass']);
    $mobile = mysqli_real_escape_string($db, $_POST['mobile']);
    $name = mysqli_real_escape_string($db, $_POST['peru']);
	
    if($id==NULL || $pass==NULL || $mobile==NULL || $email==NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
    $query = "INSERT INTO user (id,uname,fullname,pass,mobile) VALUES('$id','$email','$name','$pass','$mobile')";
    $query_run = mysqli_query($db, $query);

       if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
	
}

	  
?>