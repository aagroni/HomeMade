<?php 
    session_start();
    include("../includes/connect_db.php");

 	if( isset($_GET['alert'])){
      if ($_GET['alert'] == 'adduserekzistion') {
	 	$alertMessage = "<div class='alert alert-danger'><strong>Useri</strong> Nuk mundë të shtohet sepse Ekzistion ne DB <a class='close' data-dismiss='alert'>&times;</a></div>";
 			} 
	 		elseif ($_GET['alert'] == 'addusersuccess') {
          $alertMessage = "<div class='alert alert-success'><strong>Useri</strong> u Shtua me sukses<a class='close' data-dismiss='alert'>&times;</a></div>";
	       }
 	}

    //Me i Mperson Rolet Per me shfaqe ne list
    $getRolet = "SELECT * FROM roli";
    $resultR = mysqli_query($conn,$getRolet);

    //nese eshte i loguar dhe done te regjistrohet prape nuk e lene me hy ne kete faqe
    if(!isset($_SESSION['loggedInAdminId'])) {
        header("Location: http://localhost/HomeMade/login.php");
    }
 ?>

<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Users</title>

    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/datatables.min.css"/>
    <link rel="stylesheet" href="css/style.css" />

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
                <a class="navbar-brand" href="../index.php">Home Made</a>
            </div>
            <!--navbar-header-->

            <div class="collapse navbar-collapse" id="collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php">Dashboard <span class="sr-only">(current)</span></a></li>
                    <li class="active"><a href="users.php">Users</a></li>
                    <li><a href="ban.php">Ban</a></li>
                    <li ><a href="categories.php">Categories</a></li>
                    <li><a href="subcategories.php">Subcategories</a></li>
                    <?php if (isset($_SESSION['loggedInAdminId'])) { ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['loggedInAdminname']; ?> <span class="glyphicon glyphicon-user"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="http://localhost/HomeMade/signout.php">Sign Out</a></li>
                        </ul>
                    </li><?php } //End is isset Session... ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <div class="container">
        <?php echo $alertMessage; ?>

        <div class=row>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="page-header"><i class="glyphicon glyphicon-user"></i> Users</h1>
                        <a type="button" class="btn btn-primary newBtn" data-toggle="modal" data-target="#new_user"><i class="glyphicon glyphicon-plus"></i> New</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="user_table">
            <table id="sort-table" data-order='[[ 5, "desc" ]]' class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="no-sort">ID</th>
                        <th>Emri</th>
                        <th>Mbiemri</th>
                        <th class="no-sort">Email</th>
                        <th class="no-sort">Phone 1</th>
                        <th>Date Created</th>
                        <th class="no-sort">Active</th>
                        <th class="no-sort">Role</th>
                        <th class="no-sort">Manage</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                    $query = "SELECT user.id as uid, user.emri, user.mbiemri, user.email, user.telefoni1, user.created_date, user.aktiv, roli.id, roli.roli 
                            FROM user LEFT JOIN roli ON user.roli = roli.id";

                    $result2 = mysqli_query($conn, $query);

                    if(mysqli_num_rows($result2) > 0){
                        while($row = mysqli_fetch_assoc($result2)){
                            echo "
                                <tr>
                                    <td>" . $row["uid"] . "</td>
                                    <td>" . $row["emri"] . "</td>
                                    <td>" . $row["mbiemri"] . "</td>
                                    <td>" . $row["email"] . "</td>
                                    <td>" . $row["telefoni1"] . "</td>
                                    <td>" . $row["created_date"] . "</td>
                                    <td>" . $row["aktiv"] . "</td>
                                    <td>" . $row["roli"] . "</td>
                                    <td><a type='button' name='edit' id='" . $row["uid"] . "' class='btn btn-primary editUser'><i class='glyphicon glyphicon-pencil'></i></a>
                                ";

                            $banQuery = "SELECT isbanned FROM user_ban
                                        RIGHT JOIN user ON user_ban.user = user.id
                                        WHERE user_ban.user ='".$row['uid']."' AND isbanned = 'PO'";

                            $resultBan = mysqli_query($conn, $banQuery);

                            if(mysqli_num_rows($resultBan) < 1){
                            echo "
                                        <a type='button' name='banUser' id='" . $row["uid"] . "' class='btn btn-danger banUser' data-toggle='modal' data-target='#ban_user'><i class='glyphicon glyphicon-ban-circle'></i></a></td>
                                </tr>
                                ";
                            }

                            else{
                            echo "
                                </td>
                            </tr>
                                ";
                            }
                        }
                    }

                    else{
                        echo "No results!";
                    }

                    mysqli_close($conn);
                ?>

                </tbody>
            </table>
        </div><!-- user table end -->
    </div>
    
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/datatables.js"></script>
    <script src="../js/jquery.validate.min.js"></script>
    <script src="../js/additional-methods.min.js"></script>
    <script src="../js/validation.js"></script>
    
    <script>
        $(document).ready(function(){
            $('#sort-table').dataTable( {
                "ordering": true,
                columnDefs: [{
                orderable: false,
                targets: "no-sort"
                }]
            });

            $('#admin_new_user').on('submit', function(event){
                event.preventDefault();
                
                var myform = document.getElementById("admin_new_user");
                var formData = new FormData(myform);

                $.ajax({
                    url: "insert.php",
                    method: "POST",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(data){
                        $('#admin_new_user')[0].reset();
                        $('#new_user').modal('hide');
                        $('#user_table').html(data);

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

            $(document).on('click', '.editUser', function(){
                var user_id = $(this).attr('id');

                $(".password-div").addClass('hide');

                $.ajax({
                    url: "fetch.php",
                    method: "POST",
                    data: { user_id:user_id },
                    datatype: "json",
                    success: function(data){
                        var person=JSON.parse(data);
                        
                        $('#emri').val(person.emri);
                        $('#mbiemri').val(person.mbiemri);

                        if(person.gjinia == 'M'){
                            $('#mashkull').attr('checked', 'checked');
                        }
                        else if(person.gjinia == 'F'){
                            $('#femer').attr('checked', 'checked');
                        }

                        $('#email').val(person.email);
                        $('#email').attr('disabled', 'disabled');
                        $('#telefoni1').val(person.tel1);
                        $('#telefoni2').val(person.tel2);
                        $('#data_lindjes').val(person.data_lindjes);
                        $('#roli').val(person.roli);
                        $('#user_id').val(person.id);

                        $('#new_user').modal('show');
                    }
                });
            });

            $('#admin_ban_user').on('submit', function(event){
                var banForm = document.getElementById("admin_ban_user");
                var banFormData = new FormData(banForm);

                $.ajax({
                    url: "insert.php",
                    method: "POST",
                    data: banFormData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(data){
                        $('#admin_ban_user')[0].reset();
                        $('#ban_user').modal('hide');
                        $('#user_table').html(data);

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

            $(document).on('click', '.banUser', function(event){
                event.preventDefault();

                var ban_id = $(this).attr('id');

                $.ajax({
                    url: "fetch.php",
                    method: "POST",
                    data: {ban_id:ban_id},
                    datatype: "json",
                    success: function(data){
                        var ban = JSON.parse(data);
                        var user = ban.user_emri + " " + ban.user_mbiemri;
                        var admin = ban.admin_emri + " " + ban.admin_mbiemri;

                        $('#user').val(user);
                        $('#moderator').val(admin);
                        $('#ban_user_id').val(ban.user_id);
                    }
                });
            });

            $(document).on('click', '.newBtn', function(){
                $.ajax({
                    success: function(){
                        $('#admin_new_user')[0].reset();
                        $('#mashkull').removeAttr('checked');
                        $('#femer').removeAttr('checked');
                        $(".password-div").removeClass('hide');
                        $('#email').removeAttr('disabled');
                    }
                });
            });
        });
    </script>
</body>
</html>

<div class="modal fade" id="new_user">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">New User Form</h4>
            </div>
            <div class="modal-body">
                <form method="POST" id="admin_new_user">
                    <div class="form-group">
                        <label for="emri">Name</label>
                        <input type="text" class="form-control" id="emri" name="emri">
                    </div>
                    <div class="form-group">
                        <label for="mbiemri">Surname</label>
                        <input type="text" class="form-control" id="mbiemri" name="mbiemri">
                    </div>
                    <div class="form-group">
                        <label>Gender</label><br>
                        <label class="radio-inline"><input id="mashkull" type="radio" name="gjinia" value="M">Male</label>
                        <label class="radio-inline"><input id="femer" type="radio" name="gjinia" value="F">Female</label>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="example@domain.com">
                    </div>
                    <div class="form-group password-div">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="telefoni1">Phone 1</label>
                        <input type="number" class="form-control" id="telefoni1" name="telefoni1">
                    </div>
                    <div class="form-group">
                        <label for="data_lindjes">Birth Date</label>
                        <input type="date" id="data_lindjes" min="1920-01-01" name="data_lindjes" class="form-control">
                    </div>
                    <div class="form-group">
                        <?php 
                            if(mysqli_num_rows($resultR)>0){
                                //Me i shfaq rolet ne list, si value e ka id
                                echo "<label for='roli'>Role</label>";
                                echo "<select class='form-control' data-placeholder='Zgjedhe Rolin...' id='roli'  name='roli'>";
                                while ($row = mysqli_fetch_assoc($resultR)) {
                                echo "<option value='".$row['id']."'>". $row['roli']."</option>";
                                }
                                echo "</select>";
                            } else {
                                $SkaRole = "<div class='alert alert-danger'><strong>Verejtje</strong> Nuk Ka Role ne DB <a class='close' data-dismiss='alert'>&times;</a></div>";
                            }        
                        ?>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="user_id" id="user_id">
                    </div>
                    <button type="submit" name="submit_new_user" id="submit_new_user" class="btn btn-default">Submit</button>
                </form>
            </div><!-- modal body end -->
        </div><!-- modal content end -->
    </div><!-- modal dialog end -->
</div><!-- modal end -->

<div class="modal fade" id="ban_user">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ban Form</h4>
            </div>
            <div class="modal-body">
                <form method="POST" id="admin_ban_user">
                    <div class="form-group">
                        <label for="user">User to Ban</label>
                        <input type="text" class="form-control" id="user" name="user" disabled>
                    </div>
                    <div class="form-group">
                        <label for="moderator">Moderator</label>
                        <input type="text" class="form-control disabled" id="moderator" name="moderator" disabled>
                    </div>
                    <div class="form-group">
                        <label for="arsya">Reason for Ban</label>
                        <input type="text" class="form-control" id="arsya" name="arsya">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="ban_user_id" id="ban_user_id">
                    </div>
                    <button type="submit" name="ban_new_user" id="ban_new_user" class="btn btn-default">Submit</button>
                </form>
            </div><!-- modal body end -->
        </div><!-- modal content end -->
    </div><!-- modal dialog end -->
</div><!-- modal end -->