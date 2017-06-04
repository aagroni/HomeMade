<!DOCTYPE html>
<?php 
    session_start();
    include("../includes/connect_db.php");

    if( isset($_GET['alert'])){
    if ($_GET['alert'] == 'addcategoryexists') {
    $alertMessage = "<div class='alert alert-danger'><strong>Nen kategoria</strong> Nuk mundë të shtohet sepse Ekzistion ne DB <a class='close' data-dismiss='alert'>&times;</a></div>";
    } elseif ($_GET['alert'] == 'addcategorysuccess') {
    $alertMessage = "<div class='alert alert-success'><strong>Nen kategoria</strong> u Shtua me sukses<a class='close' data-dismiss='alert'>&times;</a></div>";
    }
}

    //nese eshte i loguar dhe done te regjistrohet prape nuk e lene me hy ne kete faqe
    if(!isset($_SESSION['loggedInAdminId'])) {
    header("Location: http://localhost/homemade/login.php");
    }

    //Me i Marr Kategorite Per me i shfaqe ne list
    $getKategorite = "SELECT * FROM kategoria";
    $resultK = mysqli_query($conn,$getKategorite);
 ?>

<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Subcategories</title>

    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="../css/datatables.min.css"/>
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
                    <li><a href="index.php">Dashboard <span class="sr-only">(current)</span></a></li>
                    <li><a href="users.php">Users</a></li>
                    <li><a href="ban.php">Ban</a></li>
                    <li><a href="categories.php">Categories</a></li>
                    <li class="active"><a href="subcategories.php">Subcategories</a></li>
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
            <div class=row>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <h1 class="page-header"><i class="glyphicon glyphicon-user"></i> SubCategories</h1>
                        </div>
                        <div class="col-md-6">
                            <div class="btn-group actions" role="group" aria-label="...">
                                <a href "#" class="btn btn-primary" data-toggle="modal" data-target="#new_subcategory_modal"><i class="glyphicon glyphicon-plus"></i> New</a>
                            <?php// include("new_subcategory.php"); ?>
                                <!-- ======================== NEW CATEGORY MODAL ======================== -->
                                <div class="modal fade" id="new_subcategory_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">New Sub Category Form</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" id="new_subcategory" action="new_subcategory.php" >
                                                    <div class="form-group">
                                                        <?php 
                                                            if(mysqli_num_rows($resultK)>0){
                                                                //Me i shfaq rolet ne list, si value e ka id
                                                                echo "<label for='kategoria_parent'>Category</label>";
                                                                echo "<select class='form-control' data-placeholder='Zgjedhe Kategorine...' id='kategoria_parent'  name='kategoria_parent'>";
                                                                while ($row = mysqli_fetch_assoc($resultK)) {
                                                                echo "<option value='".$row['id']."'>". $row['emri']."</option>";
                                                                }
                                                                echo "</select>";
                                                            } else {
                                                                $SkaRole = "<div class='alert alert-danger'><strong>Verejtje</strong> Nuk Ka Kategori ne DB <a class='close' data-dismiss='alert'>&times;</a></div>";
                                                            }        
                                                        ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="emri_subkategoria">Sub Category</label>
                                                        <input type="text" class="form-control" id="emri_subkategoria" name="emri_subkategoria">
                                                    </div>
                                                    <button type="submit" name="submit_new_subcategory" class="btn btn-default">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ======================== END NEW CATEGORY MODAL ======================== -->


                            </div>
                        </div>
                    </div>
                    <table id="sort-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="no-sort">ID</th>
                                <th>Sub Category</th>
                                <th class="no-sort">Manage</th>
						    </tr>
                        </thead>
                        <tbody>

                        <?php
                            $query = "SELECT * FROM kategoria WHERE parent IS NOT NULL";
                            $result2 = mysqli_query($conn, $query);

                            if(mysqli_num_rows($result2) > 0){
                                while($row = mysqli_fetch_assoc($result2)){
                                    echo
                                        "<tr>
                                            <td>" . $row["id"] . "</td>
                                            <td>" . $row["emri"] . "</td>
                                            <td><a href='#' class='btn btn-primary' data-id='". $row[uid] ."' data-toggle='modal' data-target='#edit_category'> <i class='glyphicon glyphicon-pencil'></i></a>
                                                <a class='btn btn-danger'><i class='glyphicon glyphicon-ban-circle'></i></a></td>
                                        </tr>";
                                }
                            }

                            else{
                                echo "No results!";
                            }

                            mysqli_close($conn);
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.min.js"></script>
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