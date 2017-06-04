<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ironing</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.css">
	<!--<link rel="stylesheet" href="css/main.css">-->
    <link href="css/ironing.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
</head>

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
        </div>
    </nav>
	
	
        <div id="btns" class="row">
            <form action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]);?>" method="GET" class="forma-search">
				<div class="form-group col-md-2">
					<button id="postbtn"class="btn btn-primary">Add a Post</button>
				</div>
				
                <div class="form-group col-sm-4 col-md-offset-6">
                  <input id="top-search" type="text" name="search" placeholder="Search..." class="form-control">
					<button id="search-btn" type="submit" class="btn btn-primary">Search</button>
                </div>
                
            </form>
        </div>



        <div class="row">
            <div class="col-sm-2 col-lg-2 col-md-2">
                <div class="filter-box">
                    <h4>Kategoria</h4>

                    <input type="checkbox"> Full time <br>
                    <input type="checkbox"> Part time <br>
                </div>

                <div class="filter-box">
                    <h4>Qyteti</h4>

                    <input type="checkbox"> Mekka <br>
                    <input type="checkbox"> Peja <br>
                    <input type="checkbox"> New York <br>
                    <input type="checkbox"> London <br>
                    <input type="checkbox" >Paris <br>
                    <input type="checkbox"> Prishtina <br>
                </div>


                <div class="filter-box">
                    <h4>Ratings</h4>

                    <input type="checkbox"> <span class="glyphicon glyphicon-star"></span> <br>
                    <input type="checkbox"> <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><br>
                    <input type="checkbox"> <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><br>
                    <input type="checkbox"> <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><br>
                    <input type="checkbox"> <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><br>
                </div>
            </div>

            <div class="col-sm-10  col-lg-10 col-md-10">
                <div class="row ">
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <div class="image"></div>
                            <div class="caption">
                                <h4><a href="#">Emri Mbiemri</a>
                                </h4>
                                <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">15 reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                </p>
                            </div>
                        </div>
                    </div>
					
					<div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <div class="image"></div>
                            <div class="caption">
                                <h4><a href="#">Emri Mbiemri</a>
                                </h4>
                                <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">15 reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                </p>
                            </div>
                        </div>
                    </div>
					
					<div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <div class="image"></div>
                            <div class="caption">
                                <h4><a href="#">Emri Mbiemri</a>
                                </h4>
                                <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">15 reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                </p>
                            </div>
                        </div>
                    </div>
					
					<div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <div class="image"></div>
                            <div class="caption">
                                <h4><a href="#">Emri Mbiemri</a>
                                </h4>
                                <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">15 reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                </p>
                            </div>
                        </div>
                    </div>
					
					<div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <div class="image"></div>
                            <div class="caption">
                                <h4><a href="#">Emri Mbiemri</a>
                                </h4>
                                <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">15 reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                </p>
                            </div>
                        </div>
                    </div>
					
					<div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <div class="image"></div>
                            <div class="caption">
                                <h4><a href="#">Emri Mbiemri</a>
                                </h4>
                                <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">15 reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                </p>
                            </div>
                        </div>
                    </div>
					
					<div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <div class="image"></div>
                            <div class="caption">
                                <h4><a href="#">Emri Mbiemri</a>
                                </h4>
                                <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">15 reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                </p>
                            </div>
                        </div>
                    </div>
					
					<div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <div class="image"></div>
                            <div class="caption">
                                <h4><a href="#">Emri Mbiemri</a>
                                </h4>
                                <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">15 reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                </p>
                            </div>
                        </div>
                    </div>
					
					<div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <div class="image"></div>
                            <div class="caption">
                                <h4><a href="#">Emri Mbiemri</a>
                                </h4>
                                <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">15 reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                </p>
                            </div>
                        </div>
                    </div>
					
					<div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <div class="image"></div>
                            <div class="caption">
                                <h4><a href="#">Emri Mbiemri</a>
                                </h4>
                                <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">15 reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                </p>
                            </div>
                        </div>
                    </div>
            <div class="row">
                <div class="col-md-12"></div>
                </div>
            </div>
        
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/backstretch.js"></script>
    
    <!--<script>
        $('#body').backstretch('http://localhost/homemade/img/food2.jpg');
    </script>-->
    <script>
        $('.image').backstretch('http://localhost/homemade/img/housekeeping.png');
    </script>
</body>

</html>