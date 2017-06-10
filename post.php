<?php 
	session_start();
    include 'includes/connect_db.php';
    include 'includes/functions.php';
	$useri = $_SESSION['loggedInUserId'];
    $PostId = validateFormData($_GET['id']);


    if (isset($_POST['shto_review'])) {
    $review = "";
    $review = validateFormData( $_POST["review"]);
    $vote = validateFormData( $_POST["vote"]);

    $stmt = mysqli_prepare($conn, "INSERT INTO review (user, shpallja, koment, rating) VALUES (?,?,?,?)");
    mysqli_stmt_bind_param($stmt, "iisi", $useri, $PostId, $review, $vote);
    if (mysqli_stmt_execute($stmt)){
    $alertMessage = "<div class='alert alert-success'><strong>Review</strong> u shtua me sukses<a class='close' data-dismiss='alert'>&times;</a></div>";
    mysqli_stmt_close($stmt);

    }else if (mysqli_errno($conn) == 1062) {//errori per duplicate key
    //echo "Error: ". mysqli_error($conn);
    $alertMessage = "<div class='alert alert-danger'>Nuk munde te shtoni me shume nje review<a class='close' data-dismiss='alert'>&times;</a></div>";
}   
}
 ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/review.css" rel="stylesheet">
    <link href="css/shpallja.css" rel="stylesheet">

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/backstretch.js"></script>
</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home Made</a>
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

	<div class="container-fluid">
	<div class="row">
    <?php echo $alertMessage; ?>

            <div class="col-md-8">
				<div class="row">
				<?php
                        if (isset($_GET['id'])) {
                        //$PostId = validateFormData($_GET['id']);
                        $aekzistonshpallja = "SELECT * FROM shpallja WHERE id='$PostId'";
                        $resultaekzistonshpallja = mysqli_query($conn, $aekzistonshpallja);
                        if (mysqli_num_rows($resultaekzistonshpallja)!=1) {
                         header("Location: index.php");
                            } else {
                            $getShpallja= "SELECT shpallja.id, shpallja.titulli, shpallja.pershkrimi, shpallja.created_date, shpallja.cmimi, shpallja_gallery.foto as foto, user.emri, user.mbiemri,user.telefoni1, user.foto as userfoto FROM shpallja LEFT JOIN shpallja_gallery ON shpallja.id = shpallja_gallery.shpallja LEFT JOIN user ON shpallja.user = user.id WHERE shpallja.id = '$PostId'";                
                    		$resultgetShpallja = mysqli_query($conn, $getShpallja);

                    		 if (mysqli_num_rows($resultgetShpallja)>0) {
                		     $row = mysqli_fetch_assoc($resultgetShpallja);
                		    echo "<div class='col-md-6'>";
							echo "<hr>";
							//echo "<p><span class='glyphicon glyphicon-time'></span> Posted on ".$row['created_date']."</p>";
							echo "<p>".dateFormat($row['created_date'])."</p>";
							echo "<hr>";
							echo "<div id='img-user'></div>";
							echo "</div>";
							echo "<div class='col-md-6'>";
							echo "<div class='info-div'>";
							echo "<h1 id='titulli'>".$row['titulli']."</h1>";
							echo "<div class='ratings'>";
							$getnrReview = "SELECT COUNT(id) as nrReviews FROM review WHERE review.shpallja =".$row['id'];
                            $resultgetnrReview = mysqli_query($conn, $getnrReview);
                            $row2 = mysqli_fetch_assoc($resultgetnrReview);
                            echo "<p class='pull-right'>".$row2['nrReviews']." reviews</p>";   
							echo "<p>Price: ".$row['cmimi']."$</p>";
                            echo "</div>";
						echo "</div>";
						
						echo "<p id='pershkrimi'>".$row['pershkrimi']."</p>";
						
						echo "<div id='buy-btn' class='btn btn-primary btn-lg'>Order now!</div>";
						echo "</div>";	
							 ?>
							 </div></div>
				<div class="col-md-4">
					<div class="row">
						<div class="col-md-6">
							<div id="seller-img"></div>

                            <h5 style="font-weight: bold">Name: </h5> 
                            <?php echo ("<h5>".$row['emri']." ".$row['mbiemri']."</h5>"); ?><br>

                            <h5 style="font-weight: bold">Telephone: </h5> 
                            <?php echo ("<h5>".$row['telefoni1']."</h5>"); ?><br>

                            <h5 style="font-weight: bold">City: </h5>
                            <?php ?><br> 

                            <h5 style="font-weight: bold">Address: </h5> 
                            <?php echo ("<h5>".$row['adresa']."</h5>"); ?>


                        </div>
					</div>
				</div>
							<script>
									$('#seller-img').backstretch('uploads/users/<?php echo $row['userfoto']; ?>');
                                    $('#img-user').backstretch('uploads/shpalljet/<?php echo $row['foto']; ?>');
                            </script>

                            <?php
                		 	}
                		}
            		}
                 ?>
				</div>
			</div><!-- END Container -->

			<div class="container">
        <div class="row">
        <div class="col-md-9"><!-- class="col-lg-10 col-sm-8 col-xs-12" -->

        <?php if (isset($_SESSION['loggedInUserId']) ) { ?>
        <!-- Comments Form -->
        <div class="well">
            <form id="review_form" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]);?>" method="post" role="form">
                <div class="form-group">
                    <h5><label for="review">Leave a Review:</label></h5>
                    <textarea id="review" name="review" class="form-control" rows="3"></textarea>
                    <div>
                    <h5><label for='myvote'>Vote:</label></h5>
                        <select id="myvote" name="vote" class="form-control">
                            <option value="">Your Vote</option>
                            <option value="1">1 (awful)</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5 (excellent)</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="shto_review">Add Review</button>
            </form>
        </div>
        <?php } else {?>

        <hr>
        <h4 id="addComment">Leave a Review:</h4>
        <p class="well">Please <a href="login.php?postbackid=<?php echo $PostId; ?>">sign in</a> to add reviews!</p>
        <hr>
        <?php } ?>

        <?php 
            $getReviews = "SELECT * FROM review WHERE shpallja='$PostId' ORDER BY created_date DESC";
            $resultReviews = mysqli_query($conn, $getReviews);   
        ?>

        <?php 
                            if (mysqli_num_rows($resultReviews)>0) {
                                echo "<ul class='media-list comments'>";
                                while ($row = mysqli_fetch_assoc($resultReviews)) {
                                    $userId = $row['user'];
                                    $emriUserit = mysqli_query($conn, "SELECT id,emri,mbiemri,foto FROM user WHERE id='$userId'");
                                    $row2 = mysqli_fetch_assoc($emriUserit); 

                                    echo "<li class='media'>";
                                    echo "<a class='pull-left' href='#''>";
                                    echo "<img class='media-object img-circle img-thumbnail' src='uploads/users/".$row2['foto']."' width='64' alt='user profile picture'>";
                                    echo "</a>";

                     echo "<img width='51' height='12' alt='".$row['rating']."/5' src='img/review/".$row['rating'].".gif' style='margin-top: 15px;'>";
                                    echo "<div class='media-body'>";
                                    echo "<h5 class='media-heading pull-left'>".$row2['emri']." ".$row2['mbiemri']."</h5>";
                                    echo "<div class='comment-info pull-left'>";
                                    echo "<div class='btn btn-default btn-xs'><i class='fa fa-clock-o'></i> Posted on ".substr($row['created_date'],0,10)."</div>";
                                    echo "</div>";
                                    echo "<br class='clearfix'>";
                                    echo "<p class='well'>".$row['koment']."</p>";
                                    echo "</div>";
                                    echo "</li>";
                                }
                                echo "</ul>";
                            } else {echo "<div class='well'><h4>Kjo Shpallje nuk ka reviews</h4></div>";}
        ?>
  </div>
</div>
    </div>

        </div>
	</div>
        
		
        <hr>

        <footer>
            <div class="row">
                <div class="col-lg-12">
                   
                </div>
            </div>
        </footer>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/additional-methods.min.js"></script>
    <script src="js/validation.js"></script>
</body>

</html>
