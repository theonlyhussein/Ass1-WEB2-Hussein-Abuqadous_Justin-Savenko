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
    if (isset($_GET ['Title']) ){
         findbytitle($_GET['Title']);
    }
    if(isset($_GET['artist'] )  ){
         findbyartist($_GET['artist']) ;
    }
    if(isset($_GET['genre'])  ){
        findbygenre($_GET['genre']);
    }
    if(isset($_GET['less_Year'])  ){
        if (is_numeric($_GET['less_Year'])) {
            $less_year = intval($_GET['less_Year']);
            findbylessyear($less_year);
        }
    }
    if(isset($_GET['Greater_Year'])  ){
        if (is_numeric($_GET['Greater_Year'])) {
            $greater_year = intval($_GET['Greater_Year']);
            findbygreateryear($greater_year);
        }
    }
    if(isset($_GET['Less_Popularity'])  ){
        if(is_numeric($_GET['Less_Popularity'])){
            $less_popularity = intval($_GET['Less_Popularity']);
            findbylesspopularity($less_popularity);
        }
    }
    if(isset($_GET['Greater_Popularity']) ){
        if(is_numeric($_GET['Greater_Popularity']))
        findbygreaterpopularity ($_GET['Greater_Popularity']);
    }
    function findbytitle($songtitle){
    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, 
        PDO::ERRMODE_EXCEPTION); 
        $sql = "SELECT title, artist_name, year, genre_name, popularity FROM artists  JOIN  songs ON  songs.artist_id = artists.artist_id
                JOIN genres  ON  songs.genre_id = genres.genre_id WHERE title LIKE '%$songtitle%'";
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
    }
    function findbyartist ($artist){
    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, 
        PDO::ERRMODE_EXCEPTION); 
        $sql = "SELECT title, artist_name, year, genre_name, popularity FROM artists  JOIN  songs ON  songs.artist_id = artists.artist_id
                JOIN genres  ON  songs.genre_id = genres.genre_id WHERE artist_name LIKE '%$artist%'";
        $statement = $pdo->prepare($sql); 
        $statement->bindValue(1, '%' . $artist . '%'); 
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
    }
    function findbygenre($genre){
        try{
            $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, 
            PDO::ERRMODE_EXCEPTION); 
            $sql = "SELECT title, artist_name, year, genre_name, popularity FROM artists  JOIN  songs ON  songs.artist_id = artists.artist_id
                    JOIN genres  ON  songs.genre_id = genres.genre_id WHERE genre_name LIKE '%$genre%'";
            $statement = $pdo->prepare($sql); 
            $statement->bindValue(1, '%' . $genre . '%'); 
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
    }
    function findbylessyear($less_year){

    }
    function findbygreateryear($greater_year){

    }
    function findbylesspopularity($less_popularity){

    }
    function findbygreaterpopularity($greaterpopularity){

    }

    ?>
</body>
</html>