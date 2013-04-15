<title>Movie Modify</title>
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
$variable = $_GET['var_value'];
$loc = "/var/www/movies/posters/$variable.jpg";
$con=mysqli_connect('localhost', 'root', 'raspberry', 'movieCol');
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

mysqli_query($con,"DELETE FROM movie_collection WHERE id='$variable'");
mysqli_close($con);

unlink ($loc);
echo "Deleted item number $variable";
?>
<br> <br/>
<form action="process.php" method="post"> 
Add another?
Movie Title (to include year &y=YYYY after the title: <input type="text" name = "title">  
<input type="submit" value="Submit"> 
</form>
<br> <br/>
<form action="process.php" method="post"> 
Add another?: <input type="text" name = "title">  
<input type="submit" value="Submit"> 
</form>
<a href="/movies/index.php">Return to Catalogue?</a>
<br> <br/>
<a href="/movies/modify.html">Return to Modify Page?</a>