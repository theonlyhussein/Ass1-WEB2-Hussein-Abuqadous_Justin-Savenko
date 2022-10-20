<!DOCTYPE html>
<html lang=en>
<head>
    <title>Song Website Search page</title>
    <meta charset=utf-8>
    <p class="subtitle" align="right">Hussein Abuqadous & Justin Savenko</p>
</head>
<body>
<section class="container">
<div><a href="Homepage.php?home_id=1"> Top genres </a> </div>
<div> <a href="Homepage.php?home_id=2"> Top Artist </a> </div>
<div> <a href="Homepage.php?home_id=3"> Most Popular Songs </a> </div>
<div> <a href="Homepage.php?home_id=4"> One Hit Wonders </a> </div>
<div> <a href="Homepage.php?home_id=5"> Long  Acoustic  Songs</a> </div>
<div> <a href="Homepage.php?home_id=6">  At the Club </a> </div>
<div> <a href="Homepage.php?home_id=7"> Running Songs </a> </div>
<div> <a href="Homepage.php?home_id=8"> Studying </a> </div>
</section>
<section>
<?php 
session_start();
require_once('config.inc.php'); 
if (isset($_GET["home_id"])){
 if(isset($_GET["home_id"]) && isset($_GET["home_id"] )== "1"){
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
    echo "<th class='genre'>Genre</th>";
    echo "<th class='numberofsongs' >Number of Songs</th>";
    echo "</tr>";
    foreach($data as $row){
        echo "<tr>";
        echo "<td class='genre'>".$row['genre_name']."</td>";
        echo "<td class='numberofsongs'".$row['Num_of_songs']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    }
    catch(PDOException $e){
        die($e->getMessage()); 
    } 

}
elseif(isset($_GET["home_id"]) && isset($_GET["home_id"] )== "2"){
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
        echo "<th class='artist'>Artist</th>";
        echo "<th class='numberofsongs'>Number of Songs</th>";
        echo "</tr>";
        foreach($data as $row){
            echo "<tr>";
            echo "<td class='artist'>".$row['artist_name']."</td>";
            echo "<td class='numberofsongs'".$row['num_of_songs']."</td>";
            echo "</tr>"; 
        }
        echo "</table>";
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
}
elseif(isset($_GET["home_id"]) && isset($_GET["home_id"] )== "3"){
    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="SELECT title, artist.artist_name, year, genre.genre_name,popularity 
            FROM songs INNER JOIN artists USING (artist_id)
            GROUP BY title
            ORDER BY popularity DESC
            LIMIT 10";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo =null;
        output($data);
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
}
elseif(isset($_GET["home_id"]) && isset($_GET["home_id"] )== "4"){
    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="SELECT title,artist_name , COUNT(song_id) as num_of_songs, popularity
                FROM songs INNER JOIN artists USING(artist_id)
                GROUP BY artist_name
                HAVING COUNT(song_id) = 1
                ORDER BY popularity DESC
                LIMIT 10";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo =null;
        echo "<table>";
        echo "<tr>";
        echo "<th class='title'>Title</th>";
        echo "<th class='artist'>Artist</th>";
        echo "<th class='numberofsongs'>Number of Songs</th>";
        echo "<th class='popularity'>Populartiy</th>";
        echo "</tr>";
        foreach($data as $row){
            echo "<tr>";
            echo "<td class='title'>".$row['Title']."</td>";
            echo "<td class='artist'>".$row['artist_name']."</td>";
            echo "<td class='numberofsongs'".$row['num_of_songs']."</td>";
            echo "<td class='popularity'>".$row['popularity']."</td>";
            echo "</tr>"; 
        }
        echo "</table>";
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
}
elseif(isset($_GET["home_id"]) && isset($_GET["home_id"] )== "5"){
    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="SELECT title, artist.artist_name, year, genres.genre_name,popularity 
              FROM songs
              INNER JOIN artists ON artists.artist_id = songs.artist_id
              INNER JOIN genres ON genres.genre_id = songs.genre_id
              WHERE acousticness > 40
              ORDER BY duration desc
              LIMIT 10";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo =null;
        output($data);
    }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
}
elseif(isset($_GET["home_id"]) && isset($_GET["home_id"] )== "6"){
    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="SELECT title, artists.artist_name, year, genres.genre_name,popularity, ((danceability * 1.6) + (energy * 1.4)) AS calculation  
        FROM songs
        INNER JOIN artists ON artists.artist_id = songs.artist_id
        INNER JOIN genres ON genres.genre_id = songs.genre_id
        WHERE danceability > 80
        ORDER BY calculation desc
        LIMIT 10";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo =null;
        output($data);
    }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
}
elseif(isset($_GET["home_id"]) && isset($_GET["home_id"] )== "7"){
    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="SELECT title, artists.artist_name, year, genres.genre_name,popularity, ((energy * 1.3) + (valence * 1.6)) AS calculation  
        FROM songs
        INNER JOIN artists ON artists.artist_id = songs.artist_id
        INNER JOIN genres ON genres.genre_id = songs.genre_id
        WHERE bpm > 119 AND bpm < 126
        ORDER BY calculation desc
        LIMIT 10";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo =null;
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
        $sql="SELECT title, artists.artist_name, year, genres.genre_name,popularity, ((acousticness * 0.8) + (100 - speechiness) + (100 - valence)) AS calculation  
        FROM songs
        INNER JOIN artists ON artists.artist_id = songs.artist_id
        INNER JOIN genres ON genres.genre_id = songs.genre_id
        WHERE bpm > 99 AND bpm < 116
        ORDER BY calculation desc
        LIMIT 10";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo =null;
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
           echo "<td id='title'>".$row['title']."</td>";
           echo "<td class='artist'>".$row['artist_name']."</td>";
           echo "<td class='year'>".$row['year']."</td>";
           echo "<td class='genre'>".$row['genre_name']."</td>";
           echo "<td class='popularity'>".$row['popularity']."</td>";
           echo "</tr>";
    }
    echo "</table>";
    }

?>
</section>
</body>
</html>