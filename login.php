<?php 
	session_start();
	include 'includes/functions.php';
	$registererror = null;
  	$error = null;
  	$nameError = null;
  	$emailError = null;
  	$passError = null;
  	$successmsg = null;
  	$errormsg = null;

        $linktoback = "index.php";
      if (isset($_GET['postbackid'])) {
        $linktoback = "post.php?id=".$_GET['postbackid'];
  }

  	 //nese eshte i loguar dhe done te logohet prape, nuk e lene me hy ne kete faqe
  if(isset($_SESSION['loggedInUserId'])) {
    header("Location: http://localhost/HomeMade/");
    }

    if(isset($_SESSION['loggedInAdminId'])) {
    header("Location: http://localhost/HomeMade/");
    }

	//set validation error flag as false
  	$error = false;

  if (isset( $_POST['login'])) {
    $email = $_POST['loginemail'];
    $pasi = $_POST['loginpassword'];

    include 'includes/connect_db.php';

    $query = "SELECT * FROM user WHERE email='$email'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result)>0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $userid = $row['id'];
        $username = $row['emri'];
        $useremail = $row['email'];
        $hashedpass = $row['password'];
        $userrole = $row['roli']; 
      }

      //me kshyr pasin qe e ka shenu a perputhet met pasin ne db qe osht i enkriptum
      if (password_verify($pasi, $hashedpass)) {
        //nese vjen qety te dhenat jane te sakta(succesful sign in)

        // $_SESSION['loggedInUserId'] = $userid;
        // $_SESSION['loggedInUsername'] = $username;
        // $_SESSION['loggedInUseremail'] = $useremail;

        //header("Location: ".$linktoback);
        //echo("Sukses");

        if ($userrole == 1) {
            $_SESSION['loggedInUserId'] = $userid;
            $_SESSION['loggedInUsername'] = $username;
            $_SESSION['loggedInUseremail'] = $useremail;
            header("Location: ".$linktoback);
        } elseif ($userrole == 2) {
            $_SESSION['loggedInAdminId'] = $userid;
            $_SESSION['loggedInAdminname'] = $username;
            $_SESSION['loggedInAdminemail'] = $useremail;  
            header("Location: admin/index.php");
        }
      } else {
        $signinerror = "<div class='alert alert-danger'>Te dhenat Gabim</div>";
      }

    } else {
      $signinerror = "<div class='alert alert-danger'>Te dhenat Gabim</div>";
    }

  }

  mysqli_close($conn);
 ?>
<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Log In</title>

        <!-- CSS -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
		<link rel="stylesheet" href="css/signup-form-elements.css">
        <link rel="stylesheet" href="css/signup.css">
		<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
        <script src="js/jquery.min.js"></script>
    </head>

    <body>

		<!-- Top menu -->
		<nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a id="title" class="navbar-brand" href="index.php">Home Made</a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="top-navbar-1">
					<ul class="nav navbar-nav navbar-right">
						<li>
							<span class="li-social">
								<a href="#"><i class="fa fa-facebook"></i></a> 
								<a href="#"><i class="fa fa-twitter"></i></a> 
								<a href="#"><i class="fa fa-envelope"></i></a> 
								<a href="#"><i class="fa fa-skype"></i></a>
							</span>
						</li>
					</ul>
				</div>
			</div>
		</nav>
        <?php 
            echo $passError;
            echo $successmsg;
            echo $errormsg; 
            echo $signinerror;
        ?>
        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div id="bigan" class="col-sm-8 col-sm-offset-2 text">
                            <h1>Log In Now</h1>
                            <div class="description">
                            	<p>
	                            	Log in to go to your personal profile
                            	</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    	<!--<div class="col-sm-6 book">
                    		<!-- <img src="img/ebook.png" alt=""> -->
                            <!-- <h1>Work. Life. Balanced.</h1> -->
                    	<!--</div>-->
                        <div class="col-sm-4 col-md-offset-4 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Buy & Sell HomeMade Products</h3>
                            		<p>Log in to continoue</p>
                        		</div>
                        		<!--<div class="form-top-right">
                        			<i class="fa fa-pencil"></i>
                        		</div>-->
                            </div>
                            <div class="form-bottom">
			                    <form role="form" id="loginform" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]);?>" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="loginemail">Email</label>
			                        	<input type="text" name="loginemail" placeholder="Email..." class="loginemail form-control" id="loginemail">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="loginpassword">Password</label>
			                        	<input type="password" name="loginpassword" placeholder="Password..." class="loginpassword form-control" id="loginpassword">
			                        </div>
			                        <button id="login_btn" type="submit" class="btn" name="login">Log in</button>
			                    </form>
		                    </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <!-- Javascript -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script src="js/validation.js"></script>
    </body>

</html>