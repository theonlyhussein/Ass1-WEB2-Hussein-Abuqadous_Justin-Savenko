<?php
    session_start();
    require_once('config.inc.php');    
    if (isset($_GET ["title"]) && $_GET["artist"]==0 
        && $_GET["genre"] ==0 && empty($_GET["less_Year"]) 
        && empty($_GET["Greater_Year"]) && empty($_GET["Less_Popularity"]) && empty($_GET['Greater_Popularity'])){
      $title = findbytitle($_GET["title"]);
      output($title);
    }
    function findbytitle($songtitle){
        try{
            $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $sql = "SELECT title, artist_name, year, genre_name, popularity
                    FROM artists, songs, genres  
                    WHERE  songs.genre_id = genres.genre_id 
                    AND songs.artist_id = artists.artist_id 
                    AND  title LIKE ?";
            $statement = $pdo->prepare($sql); 
            $statement->bindValue(1, '%' . $songtitle . '%'); 
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
            $pdo = null;
            return $data;
        }
        catch(PDOException $e){
            die($e->getMessage()); 
        }
        } 
        
    if(isset($_GET["artist"]) && empty($_GET["less_Year"]) 
        && empty($_GET["Greater_Year"]) && empty($_GET["Less_Popularity"]) 
        && empty($_GET["Greater_Popularity"]) && empty($_GET ["title"]) && $_GET["genre"] ==0){
     echo $_GET["artist"];
        if (is_numeric($_GET["artist"])) {
        $artist = findbyartist($_GET["artist"]);
        output($artist);
        }
    }
    function findbyartist ($artist){
        try{
            $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, 
            PDO::ERRMODE_EXCEPTION); 
            $sql = "SELECT title, artist_name, year, genre_name, popularity 
                    FROM artists, songs, genres  
                    WHERE  songs.genre_id = genres.genre_id 
                    AND songs.artist_id = artists.artist_id 
                    AND  artists.artist_id LIKE ?";
            $statement = $pdo->prepare($sql); 
            $statement->bindValue(1, '%' . $artist . '%'); 
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
           
            $pdo = null;
            return $data;
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        }
        }
    
    if(isset($_GET["genre"]) && $_GET["artist"]==0  && empty($_GET["less_Year"]) 
         && empty($_GET["Greater_Year"]) && empty($_GET["Less_Popularity"]) 
        && empty($_GET["Greater_Popularity"]) && empty($_GET ["title"])){
            if (is_numeric($_GET["genre"])) {
                echo $_GET["genre"];
            $genre =  findbygenre($_GET["genre"]);
            output($genre );
            }
    }
    function findbygenre($genre){
        try{
            $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, 
            PDO::ERRMODE_EXCEPTION); 
            $sql = "SELECT title, artist_name, year, genre_name, popularity
                    FROM artists, songs, genres  
                    WHERE  songs.genre_id = genres.genre_id 
                    AND songs.artist_id = artists.artist_id  
                    AND  genre_name LIKE ?";
            $statement = $pdo->prepare($sql); 
            $statement->bindValue(1, '%' . $genre . '%'); 
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
            $pdo = null;
            return $data;
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
    }
    if(isset($_GET["less_Year"])&& empty($_GET["Greater_Year"]) && $_GET["artist"]==0
        && empty($_GET["Less_Popularity"])  && empty($_GET["Greater_Popularity"]) 
        && empty($_GET ["title"])  && $_GET["genre"] ==0 ){
        if (is_numeric($_GET["less_Year"])) {
            $less_year = intval($_GET["less_Year"]);
            output(findbylessyear($less_year)) ;
        }
    }
    function findbylessyear($less_year){
        try{
            $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, 
            PDO::ERRMODE_EXCEPTION); 
            $sql = "SELECT title, artist_name, year, genre_name, popularity 
                    FROM artists, songs, genres  
                    WHERE  songs.genre_id = genres.genre_id 
                    AND songs.artist_id = artists.artist_id 
                    AND year <= ?";
            $statement = $pdo->prepare($sql); 
            $statement->bindValue(1, '%' . $less_year . '%'); 
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
            $pdo = null;
            return $data;
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
    }
    if(isset($_GET["Greater_Year"]) && $_GET["artist"]==0 
        && $_GET["genre"] ==0 && empty($_GET["less_Year"]) && empty($_GET["Less_Popularity"])  && empty($_GET["Greater_Popularity"]) 
        && empty($_GET ["title"]) ){
        if (is_numeric($_GET["Greater_Year"])) {
            $greater_year = intval($_GET["Greater_Year"]);
            output(findbygreateryear($greater_year));
        }
    }
    function findbygreateryear($greater_year){
        try{
            $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, 
            PDO::ERRMODE_EXCEPTION); 
            $sql = "SELECT title, artist_name, year, genre_name, popularity 
                    FROM artists, songs, genres  
                    WHERE  songs.genre_id = genres.genre_id 
                    AND songs.artist_id = artists.artist_id 
                    AND  year >= ?";
            $statement = $pdo->prepare($sql); 
            $statement->bindValue(1, '%' . $greater_year . '%'); 
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
            $pdo = null;
            return $data;
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
    }
    if(isset($_GET["Less_Popularity"])  && $_GET["artist"]==0 
        && $_GET["genre"] ==0 && empty($_GET["less_Year"]) 
        && empty($_GET["Greater_Year"]) && empty($_GET["Greater_Popularity"])&& empty($_GET ["title"])){
        if(is_numeric($_GET["Less_Popularity"])){
            $less_popularity = intval($_GET["Less_Popularity"]);
        output(findbylesspopularity($less_popularity));
        }
    }
    function findbylesspopularity($less_popularity){
        try{
            $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, 
            PDO::ERRMODE_EXCEPTION); 
            $sql = "SELECT title, artist_name, year, genre_name, popularity 
                    FROM artists, songs, genres  
                    WHERE  songs.genre_id = genres.genre_id 
                    AND songs.artist_id = artists.artist_id 
                    AND popularity <= ?";
            $statement = $pdo->prepare($sql); 
            $statement->bindValue(1, '%' . $less_popularity . '%'); 
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
            $pdo = null;
            return $data;
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
    }
    if(isset($_GET["Greater_Popularity"])  && $_GET["artist"]==0 
        && $_GET["genre"] ==0 && empty($_GET["less_Year"]) 
        && empty($_GET["Greater_Year"]) && empty($_GET["Less_Popularity"])&& empty($_GET ["title"]) ){
        if(is_numeric($_GET["Greater_Popularity"])){
        output(findbygreaterpopularity ($_GET["Greater_Popularity"]));
        }
    }
    function findbygreaterpopularity($greaterpopularity){
        try{
            $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, 
            PDO::ERRMODE_EXCEPTION); 
            $sql = "SELECT title, artist_name, year, genre_name, popularity 
                    FROM artists, songs, genres  
                    WHERE  songs.genre_id = genres.genre_id 
                    AND songs.artist_id = artists.artist_id 
                    AND popularity >= ?";
            $statement = $pdo->prepare($sql); 
            $statement->bindValue(1, '%' . $greaterpopularity . '%'); 
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
            $pdo = null;
            return $data;
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
    } 
?>
<!DOCTYPE html>
<html lang=en>
<head>
    <title>Search Results</title>
    <meta charset=utf-8>
</head>
<body>
    
    <?php
    
    function output($data){
         foreach ($data as $row) { 
            echo $row['title'] . ", ". $row['artist_name']. ", ". $row['year']. ", ". $row['genre_name']. ", ". $row['popularity']."</br>";      
        } 
    }
    ?>
</body>
</html>