<!DOCTYPE html>
<html lang=en>
<head>
    <title>Song Website Search page</title>
    <meta charset=utf-8>

    <p class="subtitle" align="right">Hussein Abuqadous & Justin Savenko</p>
    <link rel="stylesheet" href="./css/homepage.css">
    <nav>
        <ul>
        <li><div class="link"><a href="Search page.php"> Search  </a></div> </li>
        <li><div class="link"><a href="Search_Results_and_browsePage.php"> Browse  </a></div> </li>
        <li><div class="link"><a href="viewFavourites.php"> Favourites  </a> </div> </li>
       <li><div class="link"><a href="singleSongPage.php"> Single Song</a></div> </li> 
        </ul>
    </nav>
</head>
<body>

<section class="container">
<div class="item"> <a href="Homepage.php?home_id=1"> Top genres </a> </div>
<div class="item"> <a href="Homepage.php?home_id=2"> Top Artist </a> </div>
<div class="item"> <a href="Homepage.php?home_id=3"> Most Popular Songs </a> </div>
<div class="item"> <a href="Homepage.php?home_id=4"> One Hit Wonders </a> </div>
<div class="item"> <a href="Homepage.php?home_id=5"> Long  Acoustic  Songs</a> </div>
<div class="item"> <a href="Homepage.php?home_id=6">  At the Club </a> </div>
<div class="item"> <a href="Homepage.php?home_id=7"> Running Songs </a> </div>
<div class="item"> <a href="Homepage.php?home_id=8"> Studying </a> </div>
</section>
<section>
<?php 
require_once('config.inc.php'); 
if (isset($_GET["home_id"])){
 if($_GET["home_id"]== "1"){
    try{
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="SELECT genre_name, COUNT(song_id) as Num_of_songs
            FROM songs INNER JOIN genres USING(genre_id)
            GROUP BY genre_name
            ORDER BY COUNT(song_id) DESC
             LIMIT 10";
    $result = $pdo->query($sql);
    $data = $result->fetchAll(PDO::FETCH_ASSOC);
    $pdo =null;
    echo "<table>";
    echo "<tr>";
    echo "<th class='genre'> <h2> Top Genres </h2></th>";
    echo "</tr>";
    foreach($data as $row){
        echo "<tr>";
        echo "<td class='genre'>".$row['genre_name']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    }
    catch(PDOException $e){
        die($e->getMessage()); 
    } 

}
elseif($_GET["home_id"] == "2"){
    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="SELECT artist_name , COUNT(song_id) as num_of_songs
            FROM songs INNER JOIN artists USING(artist_id)
            GROUP BY artist_name
            ORDER BY COUNT(song_id) DESC
            LIMIT 10";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo =null;
        echo "<table>";
        echo "<tr>";
        echo "<th class='artist'> <h2> Top Artists </h2></th>";
        echo "</tr>";
        foreach($data as $row){
            echo "<tr>";
            echo "<td class='artist'>".$row['artist_name']."</td>";
            echo "</tr>"; 
        }
        echo "</table>";
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
}
elseif( $_GET["home_id"] =="3"){
    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="SELECT song_id,title, artists.artist_name, year, genres.genre_name,popularity 
            FROM songs
            INNER JOIN artists ON artists.artist_id = songs.artist_id
            INNER JOIN genres ON genres.genre_id = songs.genre_id
            GROUP BY title
            ORDER BY popularity DESC
            LIMIT 10";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo =null;
        echo "<h2  align='center'> Most Popular Songs </h2>";
        output($data);
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
}
elseif($_GET["home_id"]== "4"){
    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="SELECT song_id,title,artist_name , year, genres.genre_name, COUNT(song_id) as num_of_songs, popularity
                FROM songs
                INNER JOIN artists ON artists.artist_id = songs.artist_id
                INNER JOIN genres ON genres.genre_id = songs.genre_id
                GROUP BY artist_name
                HAVING COUNT(song_id) = 1
                ORDER BY popularity DESC
                LIMIT 10";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo =null;
        echo "<h2  align='center'> One Hit Wonders</h2>";
        output($data);
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
}
elseif($_GET["home_id"] == "5"){
    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="SELECT song_id,title, artists.artist_name, year, genres.genre_name,popularity 
              FROM songs
              INNER JOIN artists ON artists.artist_id = songs.artist_id
              INNER JOIN genres ON genres.genre_id = songs.genre_id
              WHERE acousticness > 40
              ORDER BY duration desc
              LIMIT 10";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo =null;
        echo "<h2  align='center'> Long Acoustics Songs </h2>";
        output($data);
    }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
}
elseif($_GET["home_id"] == "6"){
    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="SELECT song_id,title, artists.artist_name, year, genres.genre_name,popularity, ((danceability * 1.6) + (energy * 1.4)) AS calculation  
        FROM songs
        INNER JOIN artists ON artists.artist_id = songs.artist_id
        INNER JOIN genres ON genres.genre_id = songs.genre_id
        WHERE danceability > 80
        ORDER BY calculation desc
        LIMIT 10";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo =null;
        echo "<h2  align='center'> At the Club </h2>";
        output($data);
    }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
}
elseif($_GET["home_id"] == "7"){
    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="SELECT song_id,title, artists.artist_name, year, genres.genre_name,popularity, ((energy * 1.3) + (valence * 1.6)) AS calculation  
        FROM songs
        INNER JOIN artists ON artists.artist_id = songs.artist_id
        INNER JOIN genres ON genres.genre_id = songs.genre_id
        WHERE bpm > 120 AND bpm < 125
        ORDER BY calculation desc
        LIMIT 10";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo =null;
        echo "<h2  align='center'> Running Songs </h2>";
        output($data);
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
}
else{
    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="SELECT song_id,title, artists.artist_name, year, genres.genre_name,popularity, ((acousticness * 0.8) + (100 - speechiness) + (100 - valence)) AS calculation  
        FROM songs
        INNER JOIN artists ON artists.artist_id = songs.artist_id
        INNER JOIN genres ON genres.genre_id = songs.genre_id
        WHERE bpm > 100 AND bpm < 115
        ORDER BY calculation desc
        LIMIT 10";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo =null;
        echo "<h2  align='center'>  Studying </h2>";
        output($data);
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
}
}
function output($data){
    echo "<table>";
    echo "<tr>";
    echo "<th>Title</th>";
    echo "<th class='artist'>Artist</th>";
    echo "<th class='year'>Year</th>";
    echo "<th class='genre'>Genre</th>";
    echo "<th class='popularity'>Populartiy</th>";
    echo"<th> </th>";
    echo"<th>  </th>";
    echo "</tr>";
    foreach ($data as $row) {
           echo "<tr>";
           echo "<td id='title'> <a href=' singleSongPage.php?song_id=". $row['song_id']. "'>". $row['title'] ." </td>";
           echo "<td class='artist'>".$row['artist_name']." </a> </td>";
           echo "<td class='year'>".$row['year']."</td>";
           echo "<td class='genre'>".$row['genre_name']."</td>";
           echo "<td class='popularity'>".$row['popularity']."</td>";
           echo "</tr>";
    }
    echo "</table>";
    }

?>
 <footer>
  <div>COMP 3512 Fall 2022</div>
  <div>Hussein Abuqadous & Justin Savenko &#169</div>
  <div><a href ="https://github.com/theonlyhussein/Ass1-WEB2-Hussein-Abuqadous_Justin-Savenko">Github Repo</a></div>
  <div><a href ="https://github.com/theonlyhussein">Hussein Github</a></div>
  <div><a href ="https://github.com/Jsavy">Justin Github</a></div>
</footer>
</section>
</body>
</html>