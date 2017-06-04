<?php
    session_start();

    include("../includes/connect_db.php");
 ?>

<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Ban</title>

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
                    <li ><a href="users.php">Users</a></li>
                    <li class="active"><a href="ban.php">Ban</a></li>
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
        <div class=row>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="page-header"><i class="glyphicon glyphicon-ban-circle"></i> Ban</h1>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="user_table">
            <table id="sort-table" data-order='[[ 4, "desc" ]]' class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="no-sort">ID</th>
                        <th>Banned User</th>
                        <th>Moderator</th>
                        <th>Date Banned</th>
                        <th class="no-sort">Reason for Ban</th>
                        <th class="no-sort">Currently Banned</th>
                        <th class="no-sort">Manage</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                    $query = "SELECT user_ban.id AS ubid, user_ban.user, user_ban.moderator, user_ban.data, user_ban.arsya, user_ban.isBanned FROM user_ban
                            LEFT JOIN user AS u1 ON user_ban.user = u1.id
                            LEFT JOIN user AS u2 ON user_ban.moderator = u2.id";

                    $result = mysqli_query($conn, $query);

                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $query2 = "SELECT emri, mbiemri FROM user
                                        INNER JOIN user_ban ON user.id = user_ban.user
                                        WHERE user.id = '" . $row["user"] . "'";
                            
                            $result2 = mysqli_query($conn, $query2);

                            $row2 = mysqli_fetch_assoc($result2);

                            $query3 = "SELECT emri, mbiemri FROM user
                                        INNER JOIN user_ban ON user.id = user_ban.moderator
                                        WHERE user.id = '" . $row["moderator"] . "'";

                            $result3 = mysqli_query($conn, $query3);

                            $row3 = mysqli_fetch_assoc($result3);

                            echo
                                "<tr>
                                    <td>" . $row["ubid"] . "</td>
                                    <td>" . $row2["emri"] . " " . $row2["mbiemri"] . "</td>
                                    <td>" . $row3["emri"] . " " . $row3["mbiemri"] . "</td>
                                    <td>" . $row["data"] . "</td>
                                    <td>" . $row["arsya"] . "</td>
                                    <td>" . $row["isBanned"] . "</td>
                                    <td><a type='button' name='unbanBtn' id='" . $row["user"] . "' class='btn btn-success unbanBtn'><i class='glyphicon glyphicon-heart'></i></a></td>
                                </tr>";
                        }
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
        $(document).ready(function() {
            $('#sort-table').dataTable( {
                "ordering": true,
                columnDefs: [{
                orderable: false,
                targets: "no-sort"
                }]
            });
        });
    </script>
    <script>
        $(document).on("click", ".unbanBtn", function(){
            var user_ban_id = $(this).attr('id');

            $.ajax({
                url: "unban.php",
                method: "POST",
                data: { user_ban_id:user_ban_id },
                success: function(data){
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
    </script>
</body>
</html>