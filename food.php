<?php 
    session_start();
    include 'includes/connect_db.php';

    require ('includes/paginator.php');
    include ("includes/functions.php");
                
    //$resultgetallfood = mysqli_query($conn, $getallfood); 
    if (isset($_GET['search'])) {
        $kerkimi = validateFormData($_GET['search']);
        $getallfood= "SELECT shpallja.id, shpallja.titulli, shpallja.short_pershkrimi, shpallja.cmimi, shpallja_gallery.foto as foto FROM shpallja LEFT JOIN shpallja_gallery ON shpallja.id = shpallja_gallery.shpallja WHERE MATCH (shpallja.titulli,shpallja.short_pershkrimi)
    AGAINST ('".$kerkimi."')";
    } else {
        $getallfood= "SELECT shpallja.id, shpallja.titulli, shpallja.short_pershkrimi, shpallja.cmimi, shpallja_gallery.foto as foto FROM shpallja LEFT JOIN shpallja_gallery ON shpallja.id = shpallja_gallery.shpallja ORDER BY shpallja.created_date DESC";
    }

    //these variables are passed via URL
    $limit = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 12; //movies per page
    $page = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1; //starting page
    $links = 12;

    $paginator = new Paginator( $conn, $getallfood); //__constructor is called
    $results = $paginator->getData( $limit, $page );

    //print_r($results);die; $results is an object, $result->data is an array

    //print_r($results->data);die; //array

    

$getallcategories = "SELECT * FROM Kategoria";
$resultgetallcategories = mysqli_query($conn, $getallcategories);

$getallcities = "SELECT * FROM qyteti";
$resultgetallcities = mysqli_query($conn, $getallcities);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Food</title>

    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="css/food.css" rel="stylesheet">
    <link href="css/search.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/food_responsive.css">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/backstretch.js"></script>
</head>

<body id="body">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="flex">
            <div class="navbar-header">
                <a id="title" class="navbar-brand" href="index.php">Home Made</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <form method="GET" class="navbar-form navbar-left">
                    <input type="text" name="search" id="search" class="form-control" placeholder="Search..." autocomplete="off">
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search text-center"></span></button>
                </form>
                <li><a href="shto_shpallje.php" id="postbtn" class="btn btn-success">Add a Post </a></li>
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
        <div class="searchResult"></div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2"><!-- Ka mundsi qe duhet me ba form -->
                <form id="filter-form" method="GET" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]);?>">
                    <div class="filter-box">
                        <h4>Kategoria</h4>
                        <?php 
                            if (mysqli_num_rows($resultgetallcategories)>0) {
                                while ($row = mysqli_fetch_assoc($resultgetallcategories)) {
                                    echo "<input type='checkbox' name='kategorite[]' value='".$row['id']."'> ".$row['emri']."<br>";
                                }
                            }
                        ?>
                    </div>
                </form>

                <div class="filter-box">
                    <h4>Qyteti</h4>

                    <?php 
                    if (mysqli_num_rows($resultgetallcities)>0) {
                            while ($row = mysqli_fetch_assoc($resultgetallcities)) {
                                echo "<input type='checkbox' value='".$row['id']."'> ".$row['emri']."<br>";
                            }
                        }
                     ?>    
                </div>

                <div class="filter-box">
                    <h4>Çmimi</h4>

                    <input type="checkbox"> 1-5 <br>
                    <input type="checkbox"> 5-10 <br>
                    <input type="checkbox"> 10+ <br>
                </div>
                <div class="filter-box">
                    <h4>Ratings</h4>
                    <input type="checkbox"> <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span> & Up<br>
                    <input type="checkbox"> <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span> & Up<br>
                    <input type="checkbox"> <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span> & Up<br>
                    <input type="checkbox"> <span class="glyphicon glyphicon-star"></span> & Up<br>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 ">
                <div class="row posts-div">
                    <?php 
                    if (count($results->data)>0) 
                            {
                                for ($p = 0; $p < count($results->data); $p++)
                                {
                                    $row = $results->data[$p];
                                    echo "<div class='col-xs-12 col-sm-6 col-md-4 col-lg-3'>";
                                    echo "<div class='thumbnail'>";
                                    //echo "<img src='uploads/shpalljet/".$row['foto']."' alt='' class='image'>";
                                    echo "<div class='image' id='".$row['id']."'></div>";
                                    echo "<div class='caption'>";
                                    echo "<h4 class='pull-right'>".$row['cmimi']."&euro;</h4>";
                                    echo "<h4><a href='post.php?id=".$row['id']."'>".$row['titulli']."</a></h4>";
                                    echo "<p>".$row['short_pershkrimi']."</p>";
                                    echo "<div class='ratings'>";
                                    $getnrReview = "SELECT COUNT(id) AS nrReviews, AVG(rating) AS mesatarja FROM review WHERE review.shpallja =".$row['id'];
                                    $resultgetnrReview = mysqli_query($conn, $getnrReview);
                                    $row2 = mysqli_fetch_assoc($resultgetnrReview);
                                    echo "<p class='pull-right'>".$row2['nrReviews']." reviews</p>";
                                    echo "<p><span>".$row2['mesatarja']."</span></p>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>"; ?>
                                <script>
                                    $('#<?php echo($row['id']); ?>').backstretch('uploads/shpalljet/<?php echo $row['foto']; ?>');
                                </script><?php
                                }

                    } else {echo "<div class='jumbotron'><h1 class='text-center' >Nuk ka Ushqime ne DB</h1></div>";}               

                    ?>
                </div>
            </div>
            <div class="text-center">
                <?php echo $paginator->createLinks( $links, 'pagination pagination-md' ); ?>
            </div>
        </div>
    </div><!-- END Container -->
        

    <footer>
        <div class="row">
            <div class="col-xs-12 text-right">
                <p>Copyright &copy; Your Website 2017</p>
            </div>
        </div>
    </footer>
<!--     <script>
        $(document).ready(function() {
            $('#search').keyup(function() {
            var search=$(this).val();
            if(search.length<=0){
             $(".searchResult").hide();
             //$(".searchResult").slideUp('slow');
            } else {
            $.get(('searchFood.php'),
                {'search':search},
                function(data){
                    $('.searchResult').html(data);  
                    //$(".searchResult").slideDown('fast');
                    $(".searchResult").show();

                })  
            }
            });
        });
    </script> -->

    <script>
    	$( "input[type='checkbox']" ).on( "click", function(){
            var postData = $('#filter-form').serialize(); // i.e <form id="myForm">

            $.ajax({
                type:"post",
                url:"searchFunction.php",
                data: postData,
                success:function(data) {
                    $(".posts-div").html(data);
                }
            });
        });
    </script>
</body>
</html>