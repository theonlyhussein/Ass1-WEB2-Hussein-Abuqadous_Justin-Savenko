
<!DOCTYPE html>
<html lang=en>
<head>
    <title>COMP 3512 Assign1-Search Results</title>
    <meta charset=utf-8>
    <p class="subtitle" align="right">Hussein Abuqadous & Justin Savenko</p>
    <link rel="stylesheet" href="./css/Search_Results_andbrowsePage.css">
</head>
<body>
<section>
    
</section>
<h1>Search Results</h1>
<?php
    session_start();
    require_once('config.inc.php'); 
    if(isset($_GET["search"])){
    if(empty($_GET ["title"]) && $_GET["artist"]=="0" 
    && $_GET["genre"] =="0" && empty($_GET["less_Year"]) 
    && empty($_GET["Greater_Year"]) && empty($_GET["Less_Popularity"]) && empty($_GET['Greater_Popularity'])){
     echo "You have not searched anything go back to the previous page";
    }
    elseif (isset($_GET ["title"]) && $_GET["artist"]=="0" 
        && $_GET["genre"] =="0" && empty($_GET["less_Year"]) 
        && empty($_GET["Greater_Year"]) && empty($_GET["Less_Popularity"]) && empty($_GET['Greater_Popularity'])){
      $title = findbytitle($_GET["title"]);
      output($title);
    }
    elseif(isset($_GET["artist"]) && empty($_GET["less_Year"]) 
        && empty($_GET["Greater_Year"]) && empty($_GET["Less_Popularity"]) 
        && empty($_GET["Greater_Popularity"]) && empty($_GET ["title"]) && $_GET["genre"] =="0"){
        if (is_numeric($_GET["artist"])) {
        $artist = findbyartist(intval($_GET["artist"]));
        output($artist);
        }
    }
    elseif(isset($_GET["genre"]) && $_GET["artist"]=="0"  && empty($_GET["less_Year"]) 
         && empty($_GET["Greater_Year"]) && empty($_GET["Less_Popularity"]) 
        && empty($_GET["Greater_Popularity"]) && empty($_GET ["title"])){
            if (is_numeric($_GET["genre"])) {
            $genre =  findbygenre(intval($_GET["genre"]));
            output($genre );
            }
    }
    else if(isset($_GET["less_Year"])&& empty($_GET["Greater_Year"]) && $_GET["artist"]=="0"
    && empty($_GET["Less_Popularity"])  && empty($_GET["Greater_Popularity"]) 
    && empty($_GET ["title"])  && $_GET["genre"] =="0" ){ 
    if (is_numeric($_GET["less_Year"])) {
        $less_year = intval($_GET["less_Year"]);
        output(findbylessyear($less_year)) ;
    }
    }
    elseif(isset($_GET["Greater_Year"]) && $_GET["artist"]=="0" 
        && $_GET["genre"] =="0" && empty($_GET["less_Year"]) && empty($_GET["Less_Popularity"])  
        && empty($_GET["Greater_Popularity"]) && empty($_GET ["title"]) ){
        if (is_numeric($_GET["Greater_Year"])) {
            $greater_year = intval($_GET["Greater_Year"]);
            output(findbygreateryear($greater_year));
        }
    }
    elseif(isset($_GET["Less_Popularity"])  && $_GET["artist"]=="0" 
    && $_GET["genre"] =="0" && empty($_GET["less_Year"]) 
    && empty($_GET["Greater_Year"]) && empty($_GET["Greater_Popularity"])&& empty($_GET ["title"])){
    if(is_numeric($_GET["Less_Popularity"])){
        $less_popularity = intval($_GET["Less_Popularity"]);
    output(findbylesspopularity($less_popularity));
    }
    }
    elseif(isset($_GET["Greater_Popularity"])  && $_GET["artist"]=="0"
        && $_GET["genre"] =="0" && empty($_GET["less_Year"]) 
        && empty($_GET["Greater_Year"]) && empty($_GET["Less_Popularity"])&& empty($_GET ["title"]) ){
        if(is_numeric($_GET["Greater_Popularity"])){
        $greaterpopularity = intval($_GET["Greater_Popularity"]);
        output(findbygreaterpopularity ($greaterpopularity));
        }
    }
    else {
        echo "only one feild can have a input";
    }
}

    function findbytitle($songtitle){
        try{
            $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $sql = "SELECT title, artist_name, year, genre_name, popularity, song_id
                    FROM songs  
                    NATURAL JOIN artists
                    NATURAL JOIN genres 
                    WHERE  title LIKE ?";
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
        
    
    function findbyartist ($artist){
        try{
            $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, 
            PDO::ERRMODE_EXCEPTION); 
            $sql = "SELECT title, artist_name, year, genre_name, popularity, song_id 
                    FROM songs  
                    NATURAL JOIN artists
                    NATURAL JOIN genres 
                    WHERE  artist_id = ?";
            $statement = $pdo->prepare($sql); 
            $statement->bindValue(1,  $artist ); 
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
           
            $pdo = null;
            return $data;
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
            $sql = "SELECT title, artist_name, year, genre_name, popularity, song_id
                    FROM songs  
                    NATURAL JOIN artists
                    NATURAL JOIN genres  
                    WHERE  genre_id =  ?";
            $statement = $pdo->prepare($sql); 
            $statement->bindValue(1,  $genre ); 
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
            $pdo = null;
            return $data;
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
    }
   
    function findbylessyear($less_year){
        try{
            $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $sql = "SELECT title, artist_name, year, genre_name, popularity, song_id
                    FROM songs  
                    NATURAL JOIN artists
                    NATURAL JOIN genres 
                    WHERE year < ?";
            $statement = $pdo->prepare($sql); 
            $statement->bindValue(1,  $less_year ); 
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
            $pdo = null;
            return $data;
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
    }
    
    function findbygreateryear($greater_year){
        try{
            $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, 
            PDO::ERRMODE_EXCEPTION); 
            $sql = "SELECT title, artist_name, year, genre_name, popularity, song_id 
                    FROM songs  
                    NATURAL JOIN artists
                    NATURAL JOIN genres 
                    WHERE  year > ?";
            $statement = $pdo->prepare($sql); 
            $statement->bindValue(1,  $greater_year ); 
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
            $pdo = null;
            return $data;
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
    }
   
    function findbylesspopularity($less_popularity){
        try{
            $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, 
            PDO::ERRMODE_EXCEPTION); 
            $sql = "SELECT title, artist_name, year, genre_name, popularity, song_id
                    FROM songs  
                    NATURAL JOIN artists
                    NATURAL JOIN genres 
                    AND popularity < ?";
            $statement = $pdo->prepare($sql); 
            $statement->bindValue(1,  $less_popularity ); 
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC); 
            $pdo = null;
            return $data;
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
    }
    
    function findbygreaterpopularity($greaterpopularity){
        try{
            $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, 
            PDO::ERRMODE_EXCEPTION); 
            $sql = "SELECT title, artist_name, year, genre_name, popularity, song_id 
                    FROM songs  
                    NATURAL JOIN artists
                    NATURAL JOIN genres 
                    WHERE popularity > ?";
            $statement = $pdo->prepare($sql); 
            $statement->bindValue(1,  $greaterpopularity ); 
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
<?php 
    if (!isset($_GET["search"])&&!isset($_GET["home_id"])) {
        echo '<form  method="post">';
        echo '<input id="showall" type="submit" name="showall"value="Show All">';
        echo '</form>';

            if(isset($_POST["showall"])){
            try{ 
                    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "SELECT title, artist_name, year, genre_name, popularity, song_id
                    FROM songs  
                    NATURAL JOIN artists
                    NATURAL JOIN genres";
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
    else{
        if(isset($_GET["home_id"]) && isset($_GET["home_id"] )== 1){
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
            }
            catch(PDOException $e){
                die($e->getMessage()); 
        
            } 

        }
        elseif(isset($_GET["home_id"]) && isset($_GET["home_id"] )== 2){
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
                output($data);
                }
                catch(PDOException $e){
                    die($e->getMessage()); 
            
                } 
        }
        elseif(isset($_GET["home_id"]) && isset($_GET["home_id"] )== 3){
            try{
                $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql="SELECT title, artist_name, popularity
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
        elseif(isset($_GET["home_id"]) && isset($_GET["home_id"] )== 4){
            try{
                $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql="SELECT artist_name , COUNT(song_id) as num_of_songs
                    FROM songs INNER JOIN artists USING(artist_id)
                    GROUP BY artist_name
                    HAVING COUNT(song_id) = 1
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
        elseif(isset($_GET["home_id"]) && isset($_GET["home_id"] )== 5){
            try{
                $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql="";
                $result = $pdo->query($sql);
                $data = $result->fetchAll(PDO::FETCH_ASSOC);
                $pdo =null;
                output($data);
                }
                catch(PDOException $e){
                    die($e->getMessage()); 
            
                } 
        }
        elseif(isset($_GET["home_id"]) && isset($_GET["home_id"] )== 6){
            try{
                $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql="";
                $result = $pdo->query($sql);
                $data = $result->fetchAll(PDO::FETCH_ASSOC);
                $pdo =null;
                output($data);
                }
                catch(PDOException $e){
                    die($e->getMessage()); 
            
                } 
        }
        elseif(isset($_GET["home_id"]) && isset($_GET["home_id"] )== 7){
            try{
                $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql="";
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
                $sql="";
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
    ?>
    <br>
    <?php
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
           echo '<td class="favorites"><a href="addFavourites.php?song_id=' . $row['song_id'] . '&title=' . $row['title'] . '&artist=' . $row['artist_name'] . '&year=' . $row['year'] . '&genre=' . $row['genre_name'] . '&popularity=' . $row['popularity'] . '">' . "Add to Favourites" . '</a></td>';
           echo "<td class='favorites'> <a href=' singleSongPage.php?song_id=". $row['song_id']. "' > View  </td>";
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
</body>
</html>