<?php
  session_start();
  include 'includes/functions.php';

  $error = null;
  $passError = null;
  $successmsg = null;
  $errormsg = null;

  //nese eshte i loguar dhe done te regjistrohet prape nuk e lene me hy ne kete faqe
  if(isset($_SESSION['loggedInUserId'])) {
      header("Location: http://localhost/homemade/");
  }

  if(isset($_SESSION['loggedInAdminId'])) {
      header("Location: http://localhost/homemade/");
  }

  //set validation error flag as false
  $error = false;

  if (isset( $_POST['register'])) {
      $name = validateFormData( $_POST['registername']);
      $lastname = validateFormData( $_POST['registerlastname']);
      $email = validateFormData( $_POST['registeremail']);
      $pasi = validateFormData( $_POST['registerpassword']);
      
      include 'includes/connect_db.php';
      
      if(strlen($pasi) < 6) {
          $error = true;
          $passError = "<div class='alert alert-danger'>Passwordi minimum duhet te jete 6 karaktere<a class='close' data-dismiss='alert'>&times;</a></div>";
      }
      
      if (!$error) {
          if(mysqli_query($conn, "INSERT INTO user(emri,mbiemri,email,password) VALUES('" . $name . "','" . $lastname . "','" . $email . "', '" . password_hash($pasi,PASSWORD_DEFAULT) . "')")) {
              
              $successmsg = "<div class='alert alert-info'>U Regjistruat me Sukses <strong>$name</strong>. Aplikacioni eshte ne fazen testuese..! <a class='close' data-dismiss='alert'>&times;</a></div>";
          } else {
              $errormsg = "<div class='alert alert-danger'>Regjistrimi <strong>Deshtoi </strong><a class='close' data-dismiss='alert'>&times;</a></div>";
          }
      }
  }
  mysqli_close($conn);
?>

  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register</title>

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/signup-form-elements.css">
    <link rel="stylesheet" href="css/signup.css">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    
  </head>

  <body>
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
    ?>
      <!-- Top content -->
      <div class="top-content">

        <div class="inner-bg">
          <div class="container">
            <div class="row">
              <div class="col-sm-8 text">
                <h1>Register Now</h1>
                <div class="description">
                  <p>
                    Register and start buying and selling homemade stuff online and make your life easier and earn some money
                  </p>
                </div>
              </div>
              <!--<div class="col-sm-6 book">
                <!-- <img src="img/ebook.png" alt=""> -->
                <!-- <h1>Work. Life. Balanced.</h1> -->
              <!--</div>-->
              <div class="col-sm-4 form-box">
                <div class="form-top">
                  <div class="form-top-left">
                    <h3>Buy & Sell HomeMade Products</h3>
                    <p>Create an account to get started</p>
                  </div>
                  <!--<div class="form-top-right">
                    <i class="fa fa-pencil"></i>
                  </div>-->
                </div>
                <div class="form-bottom">
                  <form role="form" id="registerform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="registration-form">
                    <div class="form-group">
                      <label for="registername">First name</label>
                      <input type="text" name="registername" class="registername form-control" id="registername">
                    </div>
                    <div class="form-group">
                      <label for="registerlastname">Last name</label>
                      <input type="text" name="registerlastname" class="registerlastname form-control" id="registerlastname">
                    </div>
                    <div class="form-group">
                      <label for="registeremail">Email</label>
                      <input type="text" name="registeremail" placeholder="example@domain.com" class="registeremail form-control" id="registeremail">
                    </div>
                    <div class="form-group">
                      <label for="registerpassword">Password</label>
                      <input type="password" name="registerpassword" class="registerpassword form-control" id="registerpassword">
                    </div>
                    <button type="submit" class="btn" name="register">Sign Up</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Javascript -->
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/jquery.validate.min.js"></script>
      <script src="js/additional-methods.min.js"></script>
      <script src="js/validation.js"></script>
  </body>

  </html>