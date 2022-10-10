<?php 
    require_once('config.inc.php');    
    if (isset($_GET ["title"]) ){
        echo $_GET ["title"];
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
                    AND  title LIKE '%$songtitle%'";
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
        
   /* if(isset($_GET['artist'] )  ){
        $artist = findbyartist($_GET['artist']);
        output($artist);
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
            $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
           
            $pdo = null;
            return $data;
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        }
        }
    
    if(isset($_GET['genre'])  ){
      $genre =  findbygenre($_GET['genre']);
      output($genre );
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
            $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
            $pdo = null;
            return $data;
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
    }
    if(isset($_GET['less_Year'])  ){
        if (is_numeric($_GET['less_Year'])) {
            $less_year = intval($_GET['less_Year']);
            output(findbylessyear($less_year)) ;
        }
    }
    function findbylessyear($less_year){
        try{
            $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, 
            PDO::ERRMODE_EXCEPTION); 
            $sql = "SELECT title, artist_name, year, genre_name, popularity FROM artists  JOIN  songs ON  songs.artist_id = artists.artist_id
                    JOIN genres  ON  songs.genre_id = genres.genre_id WHERE year <= '%$$less_year%'";
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
    if(isset($_GET['Greater_Year'])  ){
        if (is_numeric($_GET['Greater_Year'])) {
            $greater_year = intval($_GET['Greater_Year']);
            output(findbygreateryear($greater_year));
        }
    }
    function findbygreateryear($greater_year){
        try{
            $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, 
            PDO::ERRMODE_EXCEPTION); 
            $sql = "SELECT title, artist_name, year, genre_name, popularity FROM artists  JOIN  songs ON  songs.artist_id = artists.artist_id
                    JOIN genres  ON  songs.genre_id = genres.genre_id WHERE year >= '%$$greater_year%'";
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
    if(isset($_GET['Less_Popularity'])  ){
        if(is_numeric($_GET['Less_Popularity'])){
            $less_popularity = intval($_GET['Less_Popularity']);
        output(findbylesspopularity($less_popularity));
        }
    }
    function findbylesspopularity($less_popularity){
        try{
            $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, 
            PDO::ERRMODE_EXCEPTION); 
            $sql = "SELECT title, artist_name, year, genre_name, popularity FROM artists  JOIN  songs ON  songs.artist_id = artists.artist_id
                    JOIN genres  ON  songs.genre_id = genres.genre_id WHERE popularity <= '%$$less_popularity%'";
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
    if(isset($_GET['Greater_Popularity']) ){
        if(is_numeric($_GET['Greater_Popularity'])){
        output(findbygreaterpopularity ($_GET['Greater_Popularity']));
        }
    }
    function findbygreaterpopularity($greaterpopularity){
        try{
            $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, 
            PDO::ERRMODE_EXCEPTION); 
            $sql = "SELECT title, artist_name, year, genre_name, popularity FROM artists  JOIN  songs ON  songs.artist_id = artists.artist_id
                    JOIN genres  ON  songs.genre_id = genres.genre_id WHERE popularity >= '%$$greaterpopularity%'";
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
    } */
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