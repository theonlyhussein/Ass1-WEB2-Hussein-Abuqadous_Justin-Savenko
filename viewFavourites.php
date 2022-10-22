<?php
session_start();
require_once 'includes/functionCalls.inc.php';

if(! isset($_SESSION['favourites'])) {
    $favourites = array();
    $_SESSION['favourites'] = $favourites;
}

$favourites = $_SESSION['favourites'];

?>

<!DOCTYPE html>
<html lang=en>
    <head>
        <title>COMP 3512 Assign1-Favourites</title>
        <meta charset=utf-8/>
        <p class="subtitle" align="right">Hussein Abuqadous & Justin Savenko</p>
        <nav>
        <ul>
        <li><div class="link"><a href="Homepage.php"> Home </a></div> </li>
        <li><div class="link"><a href="Search page.php"> Search  </a></div> </li>
        <li><div class="link"><a href="Search_Results_and_browsePage.php"> Browse  </a></div> </li>
        <li><div class="link"><a href="singleSongPage.php"> singleSongPage  </a> </div> </li> 
        </ul>
        </nav>
        <div class="favorites" align="right">
        <a href="removeFavourites.php">
                   Remove All Favorites
                </a>
</div>
        <link rel="stylesheet" href="./css/viewFavourites.css">
    </head>
    <body>
        <h1>Session Favourites</h1>
        <?php favouriteOutput($favourites)?> 
       

        <footer>
  <div>COMP 3512 Fall 2022</div>
  <div>Hussein Abuqadous & Justin Savenko &#169</div>
  <div><a href ="https://github.com/theonlyhussein/Ass1-WEB2-Hussein-Abuqadous_Justin-Savenko">Github Repo</a></div>
  <div><a href ="https://github.com/theonlyhussein">Hussein Github</a></div>
  <div><a href ="https://github.com/Jsavy">Justin Github</a></div>
</footer>
</body>
</html>