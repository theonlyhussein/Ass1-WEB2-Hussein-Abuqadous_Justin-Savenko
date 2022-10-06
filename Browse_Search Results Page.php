<?php  
/* add your PHP code here */
require_once('config.inc.php');                
?>
<!DOCTYPE html>
<html lang=en>
<head>
    <title>Search Results</title>
    <meta charset=utf-8>
</head>
<body>
    <?php 
    if (isset($_POST ['Title']) ){
        $songtitle = $_POST ['Title'];
    }
    if(isset($_GET['artist'] )  ){
        $artist = $_GET['artist'];
    }
    if(isset($_GET['genre'])  ){
        $genre = $_GET['genre'];
    }
    if(isset($_GET['less_Year'])  ){
        $less_year =$_GET['less_Year'];
    }
    if(isset($_GET['Greater_Year'])  ){
        $greater_year =$_GET['Greater_Year'];
    }
    if(isset($_GET['Less_Popularity'])  ){
        $less_populartiy = $_GET['Less_Popularity'];
    }
    if(isset($_GET['Greater_Popularity']) ){
        $greater_populartiy = $_GET['Greater_Popularity'];
    }
    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, 
        PDO::ERRMODE_EXCEPTION); 
        $sql = "SELECT title, artist_name, year, genre_name, popularity";
        $sql .= "FROM artists  JOIN  songs ON  songs.artist_id = artist.artist_id
                JOIN gnres  ON  songs.genre_id = genres.genre_id";
        $sql .= "WHERE title LIKE '%$songtitle%'";
        $statement = $pdo->prepare($sql); 
        $statement->bindValue(1, '%' . $songtitle . '%'); 
        $statement->execute();
        $result = $pdo->query($sql); 
        $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
        foreach ($data as $row) { 
            echo $row['title'] . ", ". $row['artist_name']. ", ". $row['year']. ", ". $row['genre_name']. ", ". $row['popularity']; 
            
        } 
        $pdo = null;
    }
    catch(PDOException $e){
        die($e->getMessage()); 
    }
    ?>
</body>
</html>