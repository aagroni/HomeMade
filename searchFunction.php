<?php 
    include 'includes/connect_db.php';

    $kategorite = implode(',', $_POST['kategorite']);

    $getshpalljet= "SELECT shpallja.id, shpallja.titulli, shpallja.short_pershkrimi, shpallja.cmimi, kategoria.emri, shpallja_gallery.foto as foto FROM shpallja 
                    LEFT JOIN shpallja_gallery ON shpallja.id = shpallja_gallery.shpallja 
                    LEFT JOIN shpallja_kategoria ON shpallja.id = shpallja_kategoria.shpallja 
                    LEFT JOIN kategoria ON shpallja_kategoria.kategoria = kategoria.id 
                    WHERE kategoria.id in($kategorite)"; 

    $result = mysqli_query($conn, $getshpalljet);

    if (mysqli_num_rows($result)>0) {
        while ($row=mysqli_fetch_assoc($result)) {      
            echo "<div class='col-xs-12 col-sm-6 col-md-4 col-lg-3'>";
            echo "<div class='thumbnail'>";
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
} 

    else if($kategorite == NULL || $kategorite == ""){
        $query = "SELECT shpallja.id, shpallja.titulli, shpallja.short_pershkrimi, shpallja.cmimi, shpallja_gallery.foto as foto FROM shpallja 
                LEFT JOIN shpallja_gallery ON shpallja.id = shpallja_gallery.shpallja 
                ORDER BY shpallja.created_date DESC";

        $result = mysqli_query($conn, $query);

        while ($row=mysqli_fetch_assoc($result)) {      
            echo " 
                <div class='col-xs-12 col-sm-6 col-md-4 col-lg-3'>
                    <div class='thumbnail'>
                        <div class='image' id='" . $row['id'] . "'></div>
                            <div class='caption'>
                                <h4 class='pull-right'>" . $row['cmimi'] . "&euro;</h4>
                                <h4><a href='post.php?id=".$row['id']."'>".$row['titulli']."</a></h4>
                                <p>" . $row['short_pershkrimi'] . "</p>
                                <div class='ratings'>";

            $getnrReview = "SELECT COUNT(id) AS nrReviews, AVG(rating) AS mesatarja FROM review WHERE review.shpallja =".$row['id'];

            $resultgetnrReview = mysqli_query($conn, $getnrReview);

            $row2 = mysqli_fetch_assoc($resultgetnrReview);

            echo "
                                    <p class='pull-right'>" . $row2['nrReviews'] . " reviews</p>
                                    <p><span>" . $row2['mesatarja'] . "</span></p>
                                </div>
                            </div>
                        </div>
                    </div>";
            ?>

            <script>
                $('#<?php echo($row['id']); ?>').backstretch('uploads/shpalljet/<?php echo $row['foto']; ?>');
            </script><?php
        }
    }

    else{
        echo "<div class='jumbotron'><h1 class='text-center' >Nuk ka Ushqime ne DB</h1></div>";
    }
                         

 ?>