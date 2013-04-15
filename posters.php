<!doctype html>
<head>
  <meta charset="ISO-8859-1">
<link rel="apple-touch-icon" href="icon.png"/>
  <title>movie collection</title>

  <meta name="description" content="movie collection">
  <meta name="author" content="bob belderbos">

  <style>
	body {width: 850px; background: #333; margin: 0 auto; font-size: small; font-family: verdana, sans-serif; }
	ul {background-color: #666; padding: 9px; overflow: hidden; }
	li {float: left; width: 280px; list-style: none; background-color: #fff;
		margin: 5px; padding: 9px; border-right: 1px solid #000; border-bottom: 2px solid #333;  }
	li.clear {clear: both;}
	img {width: 138px; height: 200px }
	a {color: #900; text-decoration: none; }
	h1 {font-size: 1.5em; margin-left: 20px; color: white; }
	h2 {font-size: 1.2em; height: 55px; background-color: #ccc; padding: 5px;}
	h3 {font-size: 1em;}
	div {padding: 0 5px; }
	div.genreWrapper { font-size: 90%; background-color:#eee; width: 115px; height: 200px; float: right;}
	div.poster {height: 200px; width: 138px; float: left; }
	div.castWrapper {width: 280px; float: left; height: 140px; }
	div.plotWrapper {clear: both;  height: 100px; font-size: 85%;}
	div.specWrapper {clear: both;  height: 35px; font-size: 90%; background-color:#ddd; padding: 5px; }
  </style>

<script type="text/javascript" src="video/html5lightbox.js"></script>

</head>

<body>
<FORM action="/movies/modify.html" style="display:inline;"><INPUT type=submit value="Modify"><a href="/movies/modify.html" ></a> </FORM>
<FORM action="/movies/posters.php" style="display:inline;"><INPUT type=submit value="Posters Only"><a href="/movies/posters.php" ></a></FORM>
<FORM action="/movies/index.php" style="display:inline;"><INPUT type=submit value="Full Details"><a href="/movies/posters.php" ></a></FORM>
	<ul>
		<?php
		$db_conn = new mysqli('localhost', 'root', 'raspberry', 'movieCol');
		$subtitle = '';
		
		if($_GET) {
			$col = $_GET['c']; # in real life, you need to secure this
			$filter = strtolower($_GET['q']);  # iidem, this example is just localhost / private use
			$q = "SELECT * FROM movie_collection where lcase($col) like '%$filter%' order by title";
			$subtitle = '<br><small> for /'.$col.'/ = %'.$filter.'%  -- <a style="color: #ccc; " href="index.php">view all</a> --</small>';
		} else {
			$q = "SELECT * FROM movie_collection order by title";			
		}
		$r = $db_conn->query($q);
		$numMovies = mysqli_num_rows($r);
		
		if(mysqli_num_rows($r)) { 
			$counter = 0;
			
			while($row = $r ->fetch_object()){
				 				
				if($counter % 3 == 0) {
					
				} else {
					echo '<li>';
				}
				echo '<img src="/movies/posters/'.$row->id.'.jpg">';
				}
				echo '</div>';
									
				$counter++;
			}
		 else {
			echo "cannot retrieve movies";
		}
		?>
	</ul>
</body>
</html>
