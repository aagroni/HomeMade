<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> -->

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>User Profile</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
	
<link rel="stylesheet" href="css/user_profile.css" type="text/css" />
</head>
<body id="top">
<div class="container">
<div class="container-fluid"> 
  <div id="header">
    <div class="fl_left">
      <h1><a href="#">Home Made</a></h1>
    </div>
    
    <br class="clear" />
  </div>

	<div id="top-bar" class="row">
		<div class="col-md-10">
			<p>Tel: xxxxx xxxxxxxxxx | Mail: info@domain.com</p>
		</div>
		<div class="col-md-2">
			<div class="btn-group pull-right">
				<button class="btn btn-primary">Short Bio</button>
				<button class="btn btn-primary">Posts</button>
			</div>
		</div>
	</div>
	
  <div id="intro" class="row">
    <div class="col-md-4"><img src="img/betimi.jpg" alt="" /> </div>
    <div class="col-md-8">
      <h2>Betim Gashi</h2>
      <p>This is a W3C standards compliant free website template from OS Templates.</p>
      <p>This template is d4stributed using a Website Template Licence</a>, which allows you to use and modify the template for both personal and commercial use when you keep the provided credit links in the footer.</p>
      <p>For more CSS templates visit Free Website Templates.</p>
    </div>
    <br class="clear" />
  </div>
</div>
	
<div class="container">
	<div class="row">
		<?php 
			if (mysqli_num_rows($resultgetallfood)>0) 
				{
					while ($row = mysqli_fetch_assoc($resultgetallfood))
					{
						echo "<div class='col-sm-4 col-lg-4 col-md-4'>";
						echo "<div class='thumbnail'>";
						//echo "<img src='uploads/shpalljet/".$row['foto']."' alt='' class='image'>";
						echo "<div id='".$row['id']."'></div>";
						echo "<div class='caption'>";
						echo "<h4 class='pull-right'>".$row['cmimi']."&euro;</h4>";
						echo "<h4><a href='#'>".$row['titulli']."</a></h4>";
						echo "<p>".$row['short_pershkrimi']."</p>";
						echo "<div class='ratings'>";
						$getnrReview = "SELECT COUNT(id) as nrReviews FROM review WHERE review.shpallja =".$row['id'];
						$resultgetnrReview = mysqli_query($conn, $getnrReview);
						$row2 = mysqli_fetch_assoc($resultgetnrReview);
						echo "<p class='pull-right'>".$row2['nrReviews']." reviews</p>";
						echo "</div>";
						echo "</div>";
						echo "</div>";
						echo "</div>"; ?>
					<script>
						$('#<?php echo($row['id']); ?>').backstretch('uploads/shpalljet/<?php echo $row['foto']; ?>');
					</script><?php
					}
				} 
				else {
					echo "<div class='jumbotron'><h1 class='text-center' >Nuk ka Ushqime ne DB</h1></div>";
				}
		?>
	</div>
</div>
  <div id="footer">
   
  <!-- ####################################################################################################### -->
	<div id="copyright">
		<p class="fl_left">Copyright &copy; 2017 - All Rights Reserved - <a href="#">Home Made</a></p>
	</div>
	  
</div>
</body>
</html>