<?php 
    if($_GET['search'] && !empty($_GET['search']))
    {
	include 'includes/connect_db.php';
	$keyword = $_GET['search'];
	$sql = "SELECT shpallja.id, shpallja.titulli, shpallja.short_pershkrimi, shpallja.cmimi, shpallja_gallery.foto as foto FROM shpallja LEFT JOIN shpallja_gallery ON shpallja.id = shpallja_gallery.shpallja
		WHERE titulli LIKE '%$keyword%'
		ORDER BY
  		CASE
    	WHEN titulli LIKE '$keyword%' THEN 1
    	WHEN titulli LIKE '%$keyword' THEN 3
    	ELSE 2
  		END LIMIT 3";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result)>0) {
		echo "<ul>";
		while ($row=mysqli_fetch_assoc($result)) {
		echo "<li><a style='background-image: url(uploads/shpalljet/".$row['foto'].")' class='thumb' href='#'></a><div class='ss-info'><a href='post.php?id=".$row['id']."' class='ss-title'>".$row['titulli']."</a></div>" 
			// echo "<li><div class='ss-info'><a href='#' class='ss-title'>".$row['titulli']."</a></div>"

			."</li>";
		}
		echo "</ul>";
	} else {
		echo "NUK KA TE DHENA";
	}
}
?>