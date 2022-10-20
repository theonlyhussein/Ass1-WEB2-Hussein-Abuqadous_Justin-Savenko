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
        $conn = DatabaseHelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));
        $topGenreGateway = new TopGenresDB($conn);
        $topGenre = $topGenreGateway->getAll();
        $topGenreGateway = null;
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
        $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
        $topArtistGateway = new TopArtistDB($conn);
        $topArtist = $topArtistGateway->getAll();
        $topArtistGateway = null;
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
        $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
        $mostPopularGateway = new MostPopularDB($conn);
        $mostPopular = $mostPopularGateway->getMostPopular();
        $mostPopularGateway = null;
        output($mostPopular);
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
}
elseif(isset($_GET["home_id"]) && isset($_GET["home_id"] )== "4"){
    try{
        $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
        $oneHitGateway = new OneHitDB($conn);
        $oneHit = $oneHitGateway->getAll();
        $oneHitGateway = null;
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
        $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
        $acousticGateway = new LongAcousticDB($conn);
        $acoustic = $acousticGateway->getAll();
        $acousticGateway = null;
        output($acoustic);
    }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
}
elseif(isset($_GET["home_id"]) && isset($_GET["home_id"] )== "6"){
    try{
        $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
        $clubGateway = new ClubDB($conn);
        $club = $clubGateway->getAll();
        $clubGateway = null;
        output($club);
    }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
}
elseif(isset($_GET["home_id"]) && isset($_GET["home_id"] )== "7"){
    try{
        $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
        $runningGateway = new RunningDB($conn);
        $running = $runningGateway->getAll();
        $runningGateway = null;
        output($running);
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
}
else{
    try{
        $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
        $studyGateway = new StudyDB($conn);
        $study = $studyGateway->getAll();
        $studyGateway = null;
        output($study);
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