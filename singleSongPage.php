<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once 'includes/asg1-db-classes.inc.php';
require_once 'includes/config.inc.php';
require_once 'includes/functionCalls.inc.php';

try {
    $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
    $songsGateway = new SingleSongViewDB($conn);
    $songs = $songsGateway->getAll();
    $songsGateway = null;
    if(!isset($_GET['song_id'])){
        $indexDisplay = 0;
    }
}catch (Exception $e) { die($e->getMessage());}




?>
<!DOCTYPE html>
<html lang=en>
    <head>
        <title>COMP 3512 Assign1- Single Song Page</title>
        <section class="subtitle">
        <p>Hussein Abuqadous & Justin Savenko</p>
        <nav>
        <ul>
        <li><div><a href="Homepage.php"> Home </a></div></li> 
        <li><div><a href="Search page.php"> Search  </a></div></li> 
        <li><div><a href="Search_Results_and_browsePage.php"> Browse  </a></div></li> 
        <li><div><a href="viewFavourites.php"> Favourites  </a> </div></li> 
        <ul>
        </nav>
        <link rel="stylesheet" href="./css/singleSongPage.css">
</section>
    </head>
<body>
    <main>
        <section class="center">
        <?php
        if(isset($_GET['song_id'])) {
            $indexDisplay = -1;
        for($i=0; $i<count($songs); $i++) {
            if($songs[$i]['song_id'] == $_GET['song_id']) {
                $indexDisplay = $i;
                break;
            }
        }}
        if($indexDisplay == -1) {
            $indexDisplay = 0;
        }
        $minutes = floor($songs[$indexDisplay]['duration'] / 60);
        $seconds = $songs[$indexDisplay]['duration'] % 60;
        if($seconds <= 9) {
            $seconds = sprintf('%02d', $seconds);
        } 
        echo songInfoHeader($songs[$indexDisplay],$minutes,$seconds)?>
        </section>
        <?php progressBars($songs[$indexDisplay]) ?>
    </main>
<footer>
  <div>COMP 3512 Fall 2022</div>
  <div>Hussein Abuqadous & Justin Savenko &#169</div>
  <div><a href ="https://github.com/theonlyhussein/Ass1-WEB2-Hussein-Abuqadous_Justin-Savenko">Github Repo</a></div>
  <div><a href ="https://github.com/theonlyhussein">Hussein Github</a></div>
  <div><a href ="https://github.com/Jsavy">Justin Github</a></div>
</footer>
</body>
</html>

