<title>Add Trailer</title>
<style type="text/css">
<!--
    body {
      color:#000000;
      background-color:#969696;
    }
    a  { color:#0000FF; }
    a:visited { color:#800080; }
    a:hover { color:#008000; }
    a:active { color:#FF0000; }
    -->
    
</style>
  
<?php
$movid = $_GET['movie'];
$yout = $_GET['youtube'];
$con=mysqli_connect('localhost', 'root', 'raspberry', 'movieCol');
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

mysqli_query($con,"UPDATE movie_collection SET imdb='$yout' WHERE id='$movid'");
mysqli_close($con);

echo "movie updated";
?>
<br> <br/>
<form action="process.php" method="post"> 
Add another Movie?
Movie Title (to include year &y=YYYY after the title: <input type="text" name = "title">  
<input type="submit" value="Submit"> 
</form>
<br> <br/>
<a href="/movies/index.php">Return to Catalogue?</a>
<br> <br/>
<a href="/movies/modify.html">Return to Modify Page?</a>