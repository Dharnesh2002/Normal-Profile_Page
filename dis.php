<?php
session_start();
?>

<?php
   include("config.php");
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
    
      $uid=$_SESSION["id"];
      $mail = mysqli_real_escape_string($db,$_POST['email']);
      $mypassword = mysqli_real_escape_string($db,$_POST['pass']); 
      $name = mysqli_real_escape_string($db,$_POST['peru']);
      $mob = mysqli_real_escape_string($db,$_POST['mobile']);
      $addr = mysqli_real_escape_string($db,$_POST['addre']);
      $age = mysqli_real_escape_string($db,$_POST['agg']);
      $gend = mysqli_real_escape_string($db,$_POST['Gender']);
      $ddoo = mysqli_real_escape_string($db,$_POST['dob']);
      $pinc = mysqli_real_escape_string($db,$_POST['pin']);
      
      if($name == NULL )
    {
      echo "<script>alert('All Fields are mandatory');window.location.href='update.php';</script>";
        return;
    }


      $sql = " UPDATE user SET pass='$mypassword', pin='$pinc', fullname='$name', mobile='$mob',Addr='$addr',age='$age', gen='$gend', dob='$ddoo' where id='$uid'";
      $result = mysqli_query($db,$sql);
    
      //$active = $row['active'];
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($result) {
        // session_register("myusername");
		 $_SESSION['loggedin'] = TRUE;
         $_SESSION['login_user'] = $uid;
         
echo "<script>window.location.href='dis.php';</script>";
	}
	  else
	  {
         echo "<script>alert('Your Login Name or Password is invalid');</script>";
		 exit();
      }
   }	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="navbar" style="justify-content: left; color:black; background-color: #fefefe;margin-left: 20px;  padding: 20px;  height:100%;  width: 1200px;; margin-left: 20px; border-radius:20px; display:block; font-size:20px ">
  <a href="#pro" onmouseover="this.style.backgroundColor='dodgerblue'; this.style.color='white';" onmouseout="this.style.backgroundColor='white';  this.style.color='black';"style="text-decoration:none; padding:20px;"><i class="fa fa-user icon"></i> Profile</a>
  <a href="index.php" onmouseover="this.style.backgroundColor='dodgerblue'; this.style.color='white';" onmouseout="this.style.backgroundColor='white';  this.style.color='black';" style="text-decoration:none; padding:20px;"><i class="fa fa-sign-out icon"></i>Log-Out</a>
</div>
  <div class="container" >
  <?php
                    $uid=$_SESSION["id"];
                    $password=$_SESSION["passw"];
										$query2 = "SELECT * FROM user WHERE id='$uid' and pass='$password'";
										$query_run2 = mysqli_query($db, $query2);
                    $data=mysqli_fetch_assoc($query_run2);
										?>
    <div class="details" id="pro">
      <div class="m1">
      <?php
                    $uid=$_SESSION["id"];
                    $password=$_SESSION["passw"];
										$query2 = "SELECT * FROM user WHERE id='$uid' and pass='$password'";
										$query_run2 = mysqli_query($db, $query2);

										if(mysqli_num_rows($query_run2) > 0)
										{
											//$sn=1;
											foreach($query_run2 as $student2)
											{
                                    ?>
											<p><i class="fa fa-address-card icon"></i> Name: <?= $student2['fullname'] ?></p>
                      <hr></hr>
                      
                      <p><i class="fa fa-envelope icon"></i> Email:     <?= $student2['uname'] ?></p>
                      <hr></hr>
                      <p><i class="fa fa-phone icon"></i> Mobile No: <?= $student2['mobile'] ?></p>
                      <hr></hr>
                      <p><i class="fa fa-birthday-cake icon"></i> D.O.B: <?= $student2['dob'] ?></p>
                      <hr></hr>
									 <?php
											
											//$sn=$sn+1;
											}
                            }
                            ?>

      </div>
      <div class="m2">
      <?php
                    $uid=$_SESSION["id"];
                    $password=$_SESSION["passw"];
										$query2 = "SELECT * FROM user WHERE id='$uid' and pass='$password'";
										$query_run2 = mysqli_query($db, $query2);

										if(mysqli_num_rows($query_run2) > 0)
										{
											//$sn=1;
											foreach($query_run2 as $student2)
											{
                                    ?>
											<p><i class="fa fa-male icon"></i>/<i class="fa fa-female icon"></i> Gender: <?= $student2['gen'] ?></p>
                      <hr></hr>
                      <p><i class="fa fa-calendar icon"></i> Age: <?= $student2['age'] ?></p>
                      <hr></hr>
                      <p><i class="fa fa-address-card-o icon"></i> Address: <?= $student2['Addr'] ?></p>
                      <hr></hr>
                      <p><i class="fa fa-map-pin icon"></i> Pincode: <?= $student2['pin'] ?></p>
                      <hr></hr>
									 <?php
											
											//$sn=$sn+1;
											}
                            }
                            ?>
      </div>
                          </div>
      <div class="cent">                    
      <button type="button" class="btn" id="myBtn">Update</button>
                          </div>
    <div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content" style="width:30%;">
    <span class="close">&times;</span>
    <form id="reg" style=" margin-left:30px;" method="POST">
  <div class="input-container">
    <input class="input-field" type="text" placeholder="Name" name="peru" value="<?php  echo $data['fullname']; ?>" >
  </div>
  <div class="input-container">
    <input class="input-field" type="email" placeholder="Email-ID" name="email" value="<?php  echo $data['uname']; ?>">
  </div>
  <div class="input-container">
    <input class="input-field" type="password" placeholder="password" name="pass" value="<?php  echo $data['pass']; ?>">
  </div>
  <div class="input-container">
    <input class="input-field" type="text" placeholder="Mobile Number" name="mobile" value="<?php  echo $data['mobile']; ?>">
  </div>
  <div class="input-container">
    <input class="input-field" type="date" placeholder="Date of Birth" name="dob" value="<?php  echo $data['dob']; ?>">
  </div>
  <div class="input-container">
    <input class="input-field" type="text" placeholder="Address" name="addre" value="<?php  echo $data['Addr']; ?>">
  </div>
  <div class="input-container">
    <input class="input-field" type="text" placeholder="Age" name="agg" value="<?php  echo $data['age']; ?>">
  </div>
  <div class="input-container">
    <select name="Gender" id="opt" class="sel" style="width: 60%;
  padding: 10px;
  outline: none;">
  <option value="Male">Male</option>
  <option value="Female">Female</option>
  <option value="Transgender">Transgender</option>
    </select>
  </div>
  <div class="input-container">
    <input class="input-field" type="text" placeholder="Pincode" name="pin" value="<?php  echo $data['pin']; ?>">
  </div>
  <button type="submit" class="btn">Update</button>
    </form>
  </div>

</div>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
    </div>
</div>
</body>
</html>