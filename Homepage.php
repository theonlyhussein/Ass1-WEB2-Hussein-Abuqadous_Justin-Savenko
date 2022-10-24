<!DOCTYPE html>
<html lang=en>
<head>
    <title>COMP 3512 Assign1- Home page</title>
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
require_once('./includes/config.inc.php');
require_once('./includes/functionCalls.inc.php'); 
if (isset($_GET["home_id"])){
 if($_GET["home_id"]== "1"){
    $data = topGenres();
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
elseif($_GET["home_id"] == "2"){
        $data = topArtists();
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
elseif( $_GET["home_id"] =="3"){
        $data = mostPopular();
        echo "<h2  align='center'> Most Popular Songs </h2>";
        homeOutput($data);       
}
elseif($_GET["home_id"]== "4"){
    
        $data = oneHit();
        echo "<h2  align='center'> One Hit Wonders</h2>";
        homeOutput($data);
}
elseif($_GET["home_id"] == "5"){
        $data = longAcoustic();
        echo "<h2  align='center'> Long Acoustics Songs </h2>";
        homeOutput($data);
}
elseif($_GET["home_id"] == "6"){ 
        $data = atClub();
        echo "<h2  align='center'> At the Club </h2>";
        homeOutput($data);
}
elseif($_GET["home_id"] == "7"){
        $data = running();
        $pdo =null;
        echo "<h2  align='center'> Running Songs </h2>";
        homeOutput($data);
}
else{
        $data = studying();
        $pdo =null;
        echo "<h2  align='center'>  Studying </h2>";
        homeOutput($data);
}
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