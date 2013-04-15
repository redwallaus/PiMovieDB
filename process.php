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
  
<?
$title=$_POST['title'];
exec(" perl getMovieData.pl \"$title\" > \"input.sql\" "); 
$mysqli = new mysqli('localhost', 'root', 'raspberry', 'movieCol');
 
if (mysqli_connect_error()) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}

echo 'Success... ' . $mysqli->host_info . "<br />";
echo 'Retrieving Movie' . "<br />";

$sql = file_get_contents('./input.sql');
if (!$sql){
	die ('Error opening file');
}
 
echo 'processing file <br />';
mysqli_multi_query($mysqli,$sql);
 
echo 'done.';
$mysqli->close();

$dir = '/var/www/movies/posters/';
$dbdir = '/movies/posters/';
$mysqli = new mysqli("localhost", "root", "raspberry", "movieCol");
$result = $mysqli->query("SELECT * FROM `movie_collection` ORDER BY `id` DESC LIMIT 1");
$row = $result->fetch_assoc();
echo htmlentities($row['_message']);

$id = $row['id'];
$ide = $id.'.jpg';
$pos = $row['poster'];
$newfile = $dir.$ide;
$newdbf = $dbdir.$ide;

if (!copy($pos, $newfile )) {
    echo "failed to copy $file...\n";
}
$mysqli = new mysqli("localhost", "root", "raspberry", "movieCol");
$result = $mysqli->query("UPDATE  `movie_collection` SET  `poster` =  '$newdbf' WHERE  `id` = $id");
 ?>

<br> <br/>
<form action="process.php" method="post"> 
Add another?: <input type="text" name = "title">  
<input type="submit" value="Submit"> 
</form>
<a href="/movies/index.php">Return to Catalogue?</a>
<br> <br/>
<a href="/movies/modify.html">Return to Modify Page?</a>