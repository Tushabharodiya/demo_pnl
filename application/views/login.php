<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="icon" href="<?php echo base_url()?>source/image/favicon.ico">
<meta name="robots" content="noindex, nofollow" />
<title>Master Panel</title>

<link href="<?php echo base_url();?>source/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>source/css/theme.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>source/css/all.min.css">
<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
</head>
<?php
    $emailError = "";
    $passwordError = "";
	if($this->session->userdata('webLog') == "TRUE"){
		redirect('dashboard');
	} else if ($this->session->userdata('webLog') == "FALSE"){
    	redirect('confirmOTP');
    }
	
	if (form_error('user_email') != "" & form_error('user_password') != ""){
		$emailError = "Please enter email address";
		$passwordError = "Please enter password";
	} else if (form_error('user_email') != ""){
		$emailError = "Please enter email";
	} else if (form_error('user_password') != ""){
		$passwordError = "Please enter password";
	}
?>
<body class="bg-light p-0">
<div class="container">
  <div class="row justify-content-md-center">
    <div class="col-lg-6 col-sm-12">
      <div class="my-5 p-md-5 p-3 bg-white rounded box-shadow">
        <form action="" method="post">
          <div class="text-center mb-4"> 
          	<img class="border rounded box-shadow rounded-circle mb-4" src="<?php echo base_url();?>source/image/logo.png" alt="logo" width="100" height="100">
          </div>
          <div class="form-label-group mb-3">
            <label>Email Address</label>
            <input type="email" id="inputEmail" class="form-control" name="user_email" placeholder="Enter Email Address">
            <?php if($emailError != ""){ ?>
            	<small class="form-text text-danger mt-2"><?php echo $emailError; ?></small>
            <?php } else { ?>
            	<small class="form-text text-muted"> We'll never share your email with anyone else.</small>
            <?php } ?>	
          </div>
          <div class="form-label-group mb-3">
            <label>Password</label>
            <input type="password" id="inputPassword" class="form-control" name="user_password" placeholder="Enter Password">
            <?php if($passwordError != ""){ ?>
            	<small class="form-text text-danger mt-2"><?php echo $passwordError; ?></small>
            <?php } else { ?>
            	<small class="form-text text-muted"> We'll never share your password with anyone else.</small>
            <?php } ?>
          </div>
          <div class="form-group">
            <input class="btn btn-md btn-bg mr-3" type="submit" value="Sign In" name="submit">
          </div>
          
          <?php if($error != ""){ ?>
          <small class="form-text text-danger mt-2"><?php echo $error; ?></small>
          <?php } ?> 
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>
