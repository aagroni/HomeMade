<!DOCTYPE html>
<?php 
    session_start();
    include("../includes/connect_db.php");

    if(!isset($_SESSION['loggedInAdminId'])) {
    header("Location: http://localhost/homemade/login.php");
    }

    //Krejt userat qe jane te regjistrume
    $totalusers ="SELECT COUNT(user.id) AS totali FROM user";
    $resulttotalusers = mysqli_query($conn,$totalusers);

    //Userat qe jane regjistru ne 7 ditet e fundit
    $newusers ="SELECT COUNT(id) AS totali FROM user WHERE created_date >= ( CURDATE() - INTERVAL 7 DAY ) AND created_date <= CURDATE() ORDER BY created_date DESC";
    $resultnewusers = mysqli_query($conn,$newusers);

    //Krejt shpalljet qe jane te regjistrume
    $totalshpalljet ="SELECT COUNT(shpallja.id) AS totali FROM shpallja";
    $resulttotalshpalljet = mysqli_query($conn,$totalshpalljet);

    //Shpalljet qe jane regjistru ne 7 ditet e fundit
    $newshpalljet ="SELECT COUNT(id) AS totali FROM shpallja WHERE created_date >= ( CURDATE() - INTERVAL 7 DAY ) AND created_date <= CURDATE() ORDER BY created_date DESC";
    $resultnewshpalljet = mysqli_query($conn,$newshpalljet);
 ?>

<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Dashboard</title>

    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/datatables.min.css"/>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/dashboard.css"/>
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
                    aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      	</button>
                <a class="navbar-brand" href="#">Home Made</a>
            </div>
            <!--navbar-header-->

            <div class="collapse navbar-collapse" id="collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="index.php">Dashboard <span class="sr-only">(current)</span></a></li>
                    <li><a href="users.php">Users</a></li>
                    <li><a href="ban.php">Ban</a></li>
                    <li><a href="categories.php">Categories</a></li>
                    <li><a href="subcategories.php">Subcategories</a></li>
                    <?php if (isset($_SESSION['loggedInAdminId'])) { ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['loggedInAdminname']; ?> <span class="glyphicon glyphicon-user"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="http://localhost/homemade/signout.php">Sign Out</a></li>
                        </ul>
                    </li><?php } //End is isset Session... ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <section>
        <div class="container">
            <?php echo $alertMessage; ?>

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="glyphicon glyphicon-user main-icon" aria-hidden="true"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <?php 
                                    while ($row = mysqli_fetch_assoc($resulttotalusers)) 
                                        {
                                            echo "<div class='huge'>".$row['totali']."</div>";
                                        }
                                ?>
                                    <!-- <div class="huge">26</div> -->
                                    <div>Total Users!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="glyphicon glyphicon-chevron-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="glyphicon glyphicon-globe main-icon"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <?php 
                                    while ($row = mysqli_fetch_assoc($resultnewusers)) 
                                        {
                                            echo "<div class='huge'>".$row['totali']."</div>";
                                        }
                                ?>
                                    <!-- <div class="huge">12</div> -->
                                    <div>New Users past 7 days!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="glyphicon glyphicon-chevron-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="glyphicon glyphicon-comment main-icon"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <?php 
                                    while ($row = mysqli_fetch_assoc($resulttotalshpalljet)) 
                                        {
                                            echo "<div class='huge'>".$row['totali']."</div>";
                                        }
                                ?>
                                    <!-- <div class="huge">124</div> -->
                                    <div>Total Posts!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="glyphicon glyphicon-chevron-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="glyphicon glyphicon-cd main-icon"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <?php 
                                    while ($row = mysqli_fetch_assoc($resultnewshpalljet)) 
                                        {
                                            echo "<div class='huge'>".$row['totali']."</div>";
                                        }
                                ?>
                                    <!-- <div class="huge">13</div> -->
                                    <div>New Posts past 7 days!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="glyphicon glyphicon-chevron-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/datatables.min.js"></script>
    <script src="../js/jquery.validate.min.js"></script>
    <script src="../js/additional-methods.min.js"></script>
    <script src="../js/validation.js"></script>

    <script>
        $(document).ready(function() {
            $('#sort-table').dataTable( {
                "ordering": true,
                columnDefs: [{
                orderable: false,
                targets: "no-sort"
                }]
            });
        } );

    </script>
</body>

</html>