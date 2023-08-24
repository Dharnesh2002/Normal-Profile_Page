<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
</head>
</html>



<?php
session_start();
?>
<?php
   include("config.php");
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myuid = mysqli_real_escape_string($db,$_POST['id']);
      $mypassword = mysqli_real_escape_string($db,$_POST['pass']); 
      $_SESSION["id"]=$myuid;
      $_SESSION["passw"]=$mypassword;
      
      $sql = "SELECT * FROM user WHERE id = '$myuid' and pass = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
        // session_register("myusername");
		 $_SESSION['loggedin'] = TRUE;
         $_SESSION['login_user'] = $myuid;
       ?>
         <script>

         swal.fire({
         icon: 'success',
                         title: 'Success',
                         text: 'Login Successful'
         }).then(function() {
             window.location = "dis.php";
         });
         </script>
    <?php       
//echo "<script>alert('Login Successful');window.location.href='dis.php';</script>";
	}
	  else
	  {
      ?>
      <script>

      swal.fire({
      icon: 'error',
                      title: 'Login Failure',
                      text: 'Check login credentials'
      }).then(function() {
          window.location = "index.php";
      });
              </script>
              <?php
         //echo "<script>alert('Your Login Name or Password is invalid'); window.location.href='index.php'</script>";
		 exit();
      }
   }	
?>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<link rel="stylesheet" href="stylee.css">
</head>

<body class>
  <div class="mk">
  <form method="post" style="max-width:500px;margin-top:50px; margin-left:400px; margin-right:300px;">
  <img src="login.svg" style="margin-left:100px;">
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="ID Number" name="id">
  </div>

  
  <div class="input-container">
    <i class="fa fa-key icon"></i>
    <input class="input-field" type="password" placeholder="Password" name="pass">
  </div>
  <button type="submit" class="btn">Login</button>
  <button type="button" class="btn" id="myBtn">Register</button>
</form>
  </div>
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <form id="reg" style="max-width:500px;margin-top:-80px; margin-left:80px;">
    <img src="login.svg" style="margin-left:100px;">
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Unique ID Number" name="id">
  </div>
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Name" name="peru">
  </div>
  <div class="input-container">
  <i class="fa fa-envelope icon"></i>
    <input class="input-field" type="email" placeholder="Email-ID" name="email">
  </div>
  <div class="input-container">
    <i class="fa fa-key icon"></i>
    <input class="input-field" type="text" placeholder="password" name="pass">
  </div>
  <div class="input-container">
    <i class="fa fa-phone icon"></i>
    <input class="input-field" type="text" placeholder="Mobile Number" name="mobile">
  </div>
  <button type="submit" class="btn">Register</button>
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
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  

<script>
$(document).on('submit', '#reg', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_reg", true);


            $.ajax({
                type: "POST",
                url: "insert2.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessage').addClass('d-none');
                        $('#reg')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                       $('#user').load(location.href + " #user");

                    }else if(res.status == 500) {
						            $('#errorMessage').addClass('d-none');
                        $('#reg')[0].reset();
                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });	

</script>
</body>

</html>