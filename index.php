<!DOCTYPE html>
<?php session_start(); ?>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Index Page</title>

  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/main.css">
  <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/index_responsive.css">
</head>

<body id="body">
  <nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <a id="title" class="navbar-brand" href="index.php">Home Made</a>
      </div>
        <ul class="nav navbar-nav navbar-right">
        <?php if(!isset($_SESSION['loggedInUserId']) ) { ?>
          <li><a href="login.php">Login<span class="sr-only">(current)</span></a></li>
          <li><a href="signup.php">Register</a></li>
          <?php } //End is !isset Session... ?>
          <?php if (isset($_SESSION['loggedInUserId'])) { ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['loggedInUsername']; ?> <span class="glyphicon glyphicon-user"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="signout.php">Sign Out</a></li>
                    </ul>
                </li><?php } //End is isset Session... ?>
        </ul>
    </div>
  </nav>

    <div id="sectionParent">
   <div id="mainSection">
      <a href="food.php" id="section1">
        <h3 id="title">Food</h3>
      </a>
      <a href="ironing.php" id="section2">
        <h3 href="ironing.html" id="title">Housing</h3>
      </a>
      <a href="baby-sitting.php" id="section3">
        <h3 id="title">Baby-Sitting</h3>
      </a>
  </div>
  </div>


  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/backstretch.js"></script>

  <script>
    $('#body').backstretch('http://localhost/homemade/img/house.jpg');

    $("#section1").hover(
        function(e) {
        e.preventDefault();
        $.backstretch('http://localhost/homemade/img/food2.jpg', {fade: 500});
      }, function(e){
          e.preventDefault();
          $("#body").backstretch('http://localhost/homemade/img/house.jpg');
      });

    $("#section2").hover(function(e) {
      e.preventDefault();
      $.backstretch('http://localhost/homemade/img/ironing2.jpg');
    }, function(e){
        e.preventDefault();
        $("#body").backstretch('http://localhost/homemade/img/house.jpg');
    });

    $("#section3").hover(function(e) {
      e.preventDefault();
      $.backstretch('http://localhost/homemade/img/baby-sitting.jpg');
    }, function(e){
        e.preventDefault();
        $("#body").backstretch('http://localhost/homemade/img/house.jpg');
    });
  </script>
</body>

</html>