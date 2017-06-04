<!DOCTYPE html>
<?php 
    session_start();
    include("../includes/connect_db.php");

    if( isset($_GET['alert'])){
    if ($_GET['alert'] == 'addcategoryexists') {
    $alertMessage = "<div class='alert alert-danger'><strong>kategoria</strong> Nuk mundë të shtohet sepse Ekzistion ne DB <a class='close' data-dismiss='alert'>&times;</a></div>";
    } elseif ($_GET['alert'] == 'addcategorysuccess') {
    $alertMessage = "<div class='alert alert-success'><strong>kategoria</strong> u Shtua me sukses<a class='close' data-dismiss='alert'>&times;</a></div>";
    }
}

    //nese eshte i loguar dhe done te regjistrohet prape nuk e lene me hy ne kete faqe
    if(!isset($_SESSION['loggedInAdminId'])) {
    header("Location: http://localhost/homemade/login.php");
    }
 ?>

<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Categories</title>

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
                    <li class="active"><a href="categories.php">Categories</a></li>
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
            <div class=row>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <h1 class="page-header"><i class="glyphicon glyphicon-user"></i> Categories</h1>
                            <a type="button" class="btn btn-primary newBtn" data-toggle="modal" data-target="#new_category_modal"><i class="glyphicon glyphicon-plus"></i> New</a>
                        </div>
                    </div>

                    <div id="category-table">
                        <table id="sort-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="no-sort">ID</th>
                                    <th>Category</th>
                                    <th class="no-sort">Manage</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                                $query = "SELECT * FROM kategoria WHERE parent IS NULL";
                                // $query = "SELECT DISTINCT k.id,k.emri FROM kategoria AS k 
                                //         INNER JOIN kategoria kk ON kk.parent = k.id";

                                $result2 = mysqli_query($conn, $query);

                                if(mysqli_num_rows($result2) > 0){
                                    while($row = mysqli_fetch_assoc($result2)){
                                        echo
                                            "<tr>
                                                <td>" . $row["id"] . "</td>
                                                <td>" . $row["emri"] . "</td>
                                                <td><a type='button' class='btn btn-primary editCategory' id='". $row['id'] ."' data-toggle='modal' data-target='#new_category_modal'><i class='glyphicon glyphicon-pencil'></i></a>
                                                    <a type='button' class='btn btn-danger deleteCategory' id='".$row['id']."'><i class='glyphicon glyphicon-ban-circle'></i></a></td>
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
        </div>
    </section>

    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/datatables.js"></script>
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

    <script>
        $(document).ready(function(){
            $('#new_category').on('submit', function(event){
                event.preventDefault();

                var myform = document.getElementById("new_category");
                var formData = new FormData(myform);

                $.ajax({
                    url: "insert_category.php",
                    method: "POST",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(data){
                        $('#new_category')[0].reset();
                        $('#new_category_modal').modal('hide');
                        $('#category-table').html(data);

                        $('#sort-table').dataTable( {
                            "ordering": true,
                            columnDefs: [{
                            orderable: false,
                            targets: "no-sort"
                            }]
                        });
                    }
                });
            });

            $(document).on('click', '.editCategory', function(){
                var category_id = $(this).attr('id');

                $.ajax({
                    url: "fetch.php",
                    method: "POST",
                    data: { category_id:category_id },
                    datatype: "json",
                    success: function(data){
                        var category=JSON.parse(data);

                        $('#category_id').val(category.id);
                        $('#emri_kategoria').val(category.emri);

                        $('#new_category_modal').modal('show');
                    }
                });
            });

            $(document).on('click', '.deleteCategory', function(event){
                event.preventDefault();

                var delete_category_id = $(this).attr('id');

                $.ajax({
                    url: "insert_category.php",
                    method: "POST",
                    data: {delete_category_id:delete_category_id},
                    success: function(data){
                        $('#category-table').html(data);
                    }
                });
            });

            $(document).on('click', '.newBtn', function(){
                $.ajax({
                    success: function(){
                        $('#new_category')[0].reset();
                    }
                });
            });
        });
    </script>
</body>
</html>

<div class="modal fade" id="new_category_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">New Category Form</h4>
            </div>
            <div class="modal-body">
                <form method="POST" id="new_category">
                    <div class="form-group">
                        <label for="emri_kategoria">Name</label>
                        <input type="text" class="form-control" id="emri_kategoria" name="emri_kategoria">
                    </div>

                    <div class="form-group">
                        <input type="hidden" id="category_id" name="category_id">
                    </div>

                    <button type="submit" name="submit_new_category" id="submit_new_category" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>