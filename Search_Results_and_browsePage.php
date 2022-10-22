
<!DOCTYPE html>
<html lang=en>
<head>
    <title>COMP 3512 Assign1-Search Results</title>
    <meta charset=utf-8>
    <p class="subtitle" align="right">Hussein Abuqadous & Justin Savenko</p>
    <link rel="stylesheet" href="./css/Search_Results_andbrowsePage.css">
    <nav>
        <ul>
        <li><div class="link"><a href="Homepage.php"> Home   </a></div> </li>
        <li><div class="link"><a href="Search page.php"> Search   </a></div> </li>
        <li><div class="link"><a href="viewFavourites.php"> Favourites  </a> </div> </li>
       <li><div class="link"><a href="singleSongPage.php"> Single Song</a></div> </li> 
        </ul>
    </nav>
</head>
<body>
<section>
    
</section>
<h1>Search Results</h1>
<?php
    session_start();
    require_once('./includes/config.inc.php');
    require_once 'includes/asg1-db-classes.inc.php';
    require_once 'includes/functionCalls.inc.php'; 
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
            output($genre);
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
    if (!isset($_GET["search"])) {
        echo '<form  method="post">';
        echo '<input id="showall" type="submit" name="showall"value="Show All">';
        echo '</form>';

            if(isset($_POST["showall"])){
            try{ 
                $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
                $dataGateway = new AllDB($conn);
                $data = $dataGateway->getAll();
                $dataGateway = null;
                    output($data);
            }
            catch(PDOException $e){
                die($e->getMessage()); 
        
            } 
        }   
    }
    ?>
    <br>    
    <footer>
  <div>COMP 3512 Fall 2022</div>
  <div>Hussein Abuqadous & Justin Savenko &#169</div>
  <div><a href ="https://github.com/theonlyhussein/Ass1-WEB2-Hussein-Abuqadous_Justin-Savenko">Github Repo</a></div>
  <div><a href ="https://github.com/theonlyhussein">Hussein Github</a></div>
  <div><a href ="https://github.com/Jsavy">Justin Github</a></div>
</footer>
</body>
</html>