<?php session_start();
    if(!isset($_SESSION['loggedInUserId'])) {
    header("Location: login.php");
    }

    $useri = $_SESSION['loggedInUserId'];
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Shto Shpallje</title>
    <link href="css/bootstrap-chosen.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <style type="text/css">
        body {
            padding-top: 70px;
        }
    </style>

   
</head>
<?php
//error_reporting(0); Nëse nuk e qesim error_reporting(0) kur ka gabime  shfaqet pathi i gabimit 
include ("includes/connect_db.php");
include ("includes/functions.php");

//Me i Marr Kategorite 
$getKategorite = "SELECT * FROM kategoria ORDER BY emri ASC";
$resultKat = mysqli_query($conn,$getKategorite);

//Me i Marr Kategorite 
$getQytetet = "SELECT * FROM qyteti ORDER BY emri ASC";
$resultQytetet = mysqli_query($conn,$getQytetet);

if (isset( $_POST['shto'] )) {
$titulli = $short_pershkrimi = $pershkrimi = $foto = $cmimi = $target = "";
$titulli = validateFormData( $_POST["titulli"]);
$short_pershkrimi = validateFormData( $_POST["short_pershkrimi"]);
$pershkrimi = validateFormData( $_POST["pershkrimi"]);
$cmimi = validateFormData( $_POST["cmimi"]);
$qyteti = validateFormData( $_POST["qyteti"]);
$adresa = validateFormData( $_POST["adresa"]);
//$target = "uploads/movies/".basename($_FILES['foto'] ['name']);
//$foto = $_FILES['foto'] ['name'];

//me marr prapashtesen e fotos e.g jpge,png
$temp = explode(".", $_FILES["foto"]["name"]);
//me gjeneru nje numer dhe mja bashkangjit prapashtesen
$newfoto = round(microtime(true)) . '.' . end($temp);
//foton e uplodume me qu ne folderin uploads/movies
move_uploaded_file($_FILES["foto"]["tmp_name"], "uploads/shpalljet/" . $newfoto);

    $shtoadresen = mysqli_prepare($conn, "INSERT INTO adresa (qyteti,adresa) VALUES (?,?)");
        mysqli_stmt_bind_param($shtoadresen, "is", $qyteti, $adresa);
        mysqli_stmt_execute($shtoadresen);
        mysqli_stmt_close($shtoadresen);
        $last_adresa_id = mysqli_insert_id($conn);

  if($stmt = mysqli_prepare($conn, "INSERT INTO shpallja (titulli, short_pershkrimi, pershkrimi, user,cmimi,adresa) VALUES (?,?,?,?,?,?)")){

    mysqli_stmt_bind_param($stmt, "sssisi", $titulli, $short_pershkrimi, $pershkrimi, $useri, $cmimi, $last_adresa_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $last_shpallja_id = mysqli_insert_id($conn);
    //Te gjitha Kategorite e selektume me i shti ne tbl shpallja_kategoria me id e shpalljat
    $stmt2 = mysqli_prepare($conn, "INSERT INTO shpallja_kategoria (shpallja, kategoria) VALUES (?,?)"); 
    foreach ($_POST['Kategorite'] as $kategoria1) {
        mysqli_stmt_bind_param($stmt2, "ii", $last_shpallja_id, $kategoria1);
        mysqli_stmt_execute($stmt2);
    }
    mysqli_stmt_close($stmt2);
    //Te gjitha Kategorite e selektume me i shti ne tbl shpallja_kategoria me id e shpalljat
    $stmt3 = mysqli_prepare($conn, "INSERT INTO shpallja_gallery (foto, shpallja) VALUES (?,?)"); 
        mysqli_stmt_bind_param($stmt3, "si", $newfoto, $last_shpallja_id);
        mysqli_stmt_execute($stmt3);
    mysqli_stmt_close($stmt3);
    $Sukses = "<div class='alert alert-success'><strong>Shpallja</strong> u shtua me Sukses. <a class='close' data-dismiss='alert'>&times;</a></div>";
}else {
    $Deshtim = "<div class='alert alert-danger'><strong>Shpallja</strong> nuk u shtua. <a class='close' data-dismiss='alert'>&times;</a></div>";
}
//foton e uplodume me qu ne folderin uploads/movies
//move_uploaded_file($_FILES['foto'] ['tmp_name'], $target); 

}
mysqli_close($conn);
?>

<body id="body">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
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
    <div class="container">
        <h1><strong>Shto Shpallje</strong></h1>
        <?php echo($Sukses);
              echo($Deshtim);
              echo ($SkaKategori);
              echo ($SkaQytete);
        ?>
        <form id="shpallja_form" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]);?>" method="post" enctype="multipart/form-data">

        <div class="row">
                <div class="form-group col-sm-6">
                    <label for="titulli">Title</label>
                    <input type="text" id="titulli" name="titulli" class="form-control">
                </div>
        </div>
        <div class="row">        
            <div class="form-group col-sm-6">
                <label for="short_pershkrimi">Short Description</label>
                <textarea id="short_pershkrimi" name="short_pershkrimi" class="form-control" rows="2"></textarea>
            </div>
        </div>
        <div class="row">        
            <div class="form-group col-sm-6">
                <label for="pershkrimi">Description</label>
                <textarea id="pershkrimi" name="pershkrimi" class="form-control" rows="4"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-3">
                <label for="cmimi">Price</label>
                <input type="number" id="cmimi" name="cmimi" class="form-control">
            </div>
        </div> 
        <div class="row">  
            <div class="form-group col-sm-3">
                <label for="Foto">Image</label>
                <input type="file" id="foto" name="foto" class="form-control">
            </div>        
        </div><!-- END ROW --> 

        <div class="row">
            <div class="form-group col-sm-6">
                <?php 
                        if(mysqli_num_rows($resultKat)>0){
                            //Me i shfaq studiot ne list, si value e ka id
                            echo "<label for='kategoria1'>Zgjedh Kategorite</label>";
                            echo "<select id='kategoria1' data-placeholder='Zgjidh Kategorite'  name='Kategorite[]'  class='chosen-select' multiple='' tabindex='4'>";
                            while ($row = mysqli_fetch_assoc($resultKat)) {
                            echo "<option value='".$row['id']."'>". $row['emri']."</option>";
                            }
                            echo "</select>";
                        } else {
                            $SkaKategori = "<div class='alert alert-danger'><strong>Verejtje</strong> Nuk Ka Kategori ne DB <a class='close' data-dismiss='alert'>&times;</a></div>";
                        }
                ?> 
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <?php 
                        if(mysqli_num_rows($resultQytetet)>0){
                            //Me i shfaq studiot ne list, si value e ka id
                            echo "<label for='qyteti'>Zgjedhe Qytetin</label>";
                            echo "<select id='qyteti' data-placeholder='Zgjidh Qytetin'  name='qyteti'  class='chosen-select' tabindex='4'>";
                            while ($row = mysqli_fetch_assoc($resultQytetet)) {
                            echo "<option value='".$row['id']."'>". $row['emri']."</option>";
                            }
                            echo "</select>";
                        } else {
                            $SkaQytete = "<div class='alert alert-danger'><strong>Verejtje</strong> Nuk Ka Qytete ne DB <a class='close' data-dismiss='alert'>&times;</a></div>";
                        }
                ?>
            </div>
        </div> 
        <div class="row">
                <div class="form-group col-sm-6">
                    <label for="adresa">Adresa</label>
                    <input type="text" id="adresa" name="adresa" class="form-control">
                </div>
        </div>
            <div class="row">
                <div class="col-sm-12">
                    <a href="index.php" type="button" class="btn btn-primary">Anulo</a>
                    <button type="submit" class="btn btn-primary" name="shto">Shto shpalljen</button>
                </div>
            </div>
        </form>
      </div><!-- container -->
    
    <script src="js/chosen.jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/additional-methods.min.js"></script>
    <script src="js/validation.js"></script>
    <script type="text/javascript">
            var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"85%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
    </script>
    
    
</body>
</html>