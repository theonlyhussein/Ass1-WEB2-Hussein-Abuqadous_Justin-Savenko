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
        <link rel="stylesheet" href="./css/viewFavourites.css">
    </head>
    <body>
        <h1>Session Favourites</h1>
        <?php output($favourites)?>

        <footer>
  <div>COMP 3512 Fall 2022</div>
  <div>Hussein Abuqadous & Justin Savenko &#169</div>
  <div><a href ="https://github.com/theonlyhussein/Ass1-WEB2-Hussein-Abuqadous_Justin-Savenko">Github Repo</a></div>
  <div><a href ="https://github.com/theonlyhussein">Hussein Github</a></div>
  <div><a href ="https://github.com/Jsavy">Justin Github</a></div>
</footer>
</body>
</html>