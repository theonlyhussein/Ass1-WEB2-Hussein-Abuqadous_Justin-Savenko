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
    $song_id = defaultSONG_id;
    if(isset($_GET['song_id']) && $_GET['song_id'] > 1000 && $_GET['song_id'] < 1318)
        $song_id = $_GET['song_id'];
}catch (Exception $e) { die($e->getMessage());}




?>
<!DOCTYPE html>
<html lang=en>
    <head>
        <title>COMP 3512 Assign1</title>
        <p class="subtitle">Hussein Abuqadous & Justin Savenko</p>
        <link rel="stylesheet" href="./css/singleSongPage.css">
    </head>
<body>
    <main>
        <section class="center">
        <?php
        $row = $songs[$song_id - defaultSONG_id];
        $minutes = floor($row['duration'] / 60);
        $seconds = $row['duration'] % 60;
        if($seconds <= 9) {
            $seconds = sprintf('%02d', $seconds);
        }
        echo songInfoHeader($row,$minutes,$seconds)?>
        </section>
        <?php progressBars($row) ?>
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

