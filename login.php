<?php


   //include ("session.php");
   include ("dbconnect.php");
   include ("functions.php");

	/* if (file_exists('config')) {
		//do nothing
	} else {
		//create new file
		$config = include 'config';
		$config['email'] = "";
		$config['pass'] = "";
		$config['fname'] = "";
		$config['lname'] = "";
		$config['server_refresh_sec'] = "3";
		$config['mobile_number'] = "";
		$config['board_name_monitored'] = "";
		$config['filter_pins_by_board'] = "";
		file_put_contents('config', '<?php return ' . var_export($config, true) . ';');	
		//header("location: ?p=1");
		//exit();			
	}	

	$config = include 'config';
	$email = $config['email'];
	$pass = $config['pass'];
	$fname = $config['fname'];
	$lname = $config['lname'];
	$fullname = ucfirst($fname)." ".ucfirst($lname); */
	


	
	
	//init
	if(isset($_GET['msg'])){
		$msg = $_GET['msg'];
	} else {
		$msg = "";
	}
	
	
	
	if(isset($_POST['submit'])) {
		
		//$email_post = $_POST['email'];
		$email_post = $_POST['email'];
		$pass_post = $_POST['pass'];
		
         $sql = "SELECT * FROM tbl_users WHERE email = '$email_post' ";
         $result = mysqli_query($conn, $sql);         

         if (mysqli_num_rows($result) > 0)
         {
             // output data of each row
             while ($row = mysqli_fetch_assoc($result))
             {
                 //$email = $row['email'];
                 $pass = $row['pass'];
                 $fname = $row['fname'];
                 $lname = $row['lname'];
                 $mobile_number = $row['mobile_number'];
             }
        } else if (mysqli_num_rows($result) == 0) {
			header("location: ?p=2&email=$email_post&msg=please set new account");
			exit();	
		} 
		
		 $fullname = ucfirst($fname)." ".ucfirst($lname);		
		
		if( $pass_post == ""){
			header("location: ?p=1&msg=login-failed-empty-data");
			exit();	
		} 
		/*else if($pass == "") {
			header("location: ?p=8&msg=please-new-set-password");
			exit();	
		}*/ 
		else if(md5($pass_post) != $pass) {
			header("location: ?p=1&msg=login-failed-check-password");
			exit();	
		} 		
		else if(md5($pass_post) == $pass) {
			
			session_start(); //start the PHP_session function 			
			$_SESSION['id'] = md5(time());	
			$_SESSION['fullname'] = $fullname;	
			$_SESSION['fname'] = $fname;	
			$_SESSION['email'] = $email_post;	
			$_SESSION['mobile_number'] = $mobile_number;	
			
			
			
		
/* 			$s_file = "start.ts";
			if (!file_exists($s_file))
			{				
				file_put_contents($s_file, strtotime('now'));
			} 
		
			$c_file = "current.ts";
			if (!file_exists($c_file))
			{				
				file_put_contents($c_file, strtotime('now'));
			} */

			
			header("location: ?p=4&msg=login-success&");
			exit();
		}
	}
	
	
?>	
	


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back! <?php //echo $fullname; ?> </h1>
                                    </div>
									
								
									
                                    <form class="user" action="?p=1" method="post">
                                        <div class="form-group">
                                                <label><?php echo $msg; ?></label>                                            
                                        </div>	
										
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." name="email" >
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" name="pass">
                                        </div>
                                        <div class="form-group">
                                            <!--<div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>-->
                                        </div>
										<button type="submit" class="btn btn-primary btn-user btn-block" name="submit" >Login</button>
                                        <!--<a href="index.html" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </a>-->
                                       
                                        <!--<a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>-->
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="?p=3">Forgot Password?</a>
                                    </div>
                                    <!--<div class="text-center">
                                        <a class="small" href="?p=2">Set an Account!</a>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>