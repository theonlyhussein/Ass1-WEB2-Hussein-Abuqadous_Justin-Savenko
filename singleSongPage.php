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
        echo songInfoHeader($row,$minutes,$seconds)?>
        </section>
        <div class="container">
  <div class="card">
    <div class="box">
      <div class="percent" style="--clr: #00ff43; --num:<?php echo $row['bpm']?>;">
        <svg>
          <circle cx="70" cy="70" r="70"></circle>
          <circle cx="70" cy="70" r="70"></circle>
          <svg>
            <div class="num">
              <h2><?php echo $row['bpm']?><span>bpm</span></h2>
            </div>
      </div>
          <h2 class="text">bpm</h2>
    </div>
  </div>
</div>
<div class="container">
  <div class="card">
    <div class="box">
      <div class="percent" style="--clr: #ed6c02; --num:<?php echo $row['energy']?>;">
        <svg>
          <circle cx="70" cy="70" r="70"></circle>
          <circle cx="70" cy="70" r="70"></circle>
          <svg>
            <div class="num">
              <h2><?php echo $row['energy']?><span>%</span></h2>
            </div>
      </div>
          <h2 class="text">Energy</h2>
    </div>
  </div>
</div>
<div class="container">
  <div class="card">
    <div class="box">
      <div class="percent" style="--clr: #0f6fbd; --num:<?php echo $row['danceability']?>;">
        <svg>
          <circle cx="70" cy="70" r="70"></circle>
          <circle cx="70" cy="70" r="70"></circle>
          <svg>
            <div class="num">
              <h2><?php echo $row['danceability']?><span>%</span></h2>
            </div>
      </div>
          <h2 class="text">Danceability</h2>
    </div>
  </div>
</div>
<div class="container">
  <div class="card">
    <div class="box">
      <div class="percent" style="--clr: #9805b5; --num:<?php echo $row['liveness']?>;">
        <svg>
          <circle cx="70" cy="70" r="70"></circle>
          <circle cx="70" cy="70" r="70"></circle>
          <svg>
            <div class="num">
              <h2><?php echo $row['liveness']?><span>%</span></h2>
            </div>
      </div>
          <h2 class="text">Liveness</h2>
    </div>
  </div>
</div>
<div class="container">
  <div class="card">
    <div class="box">
      <div class="percent" style="--clr: #1d05f5; --num:<?php echo $row['valence']?>;">
        <svg>
          <circle cx="70" cy="70" r="70"></circle>
          <circle cx="70" cy="70" r="70"></circle>
          <svg>
            <div class="num">
              <h2><?php echo $row['valence']?><span>%</span></h2>
            </div>
      </div>
          <h2 class="text">Valence</h2>
    </div>
  </div>
</div>
<div class="container">
  <div class="card">
    <div class="box">
      <div class="percent" style="--clr: #05f59d; --num:<?php echo $row['acousticness']?>;">
        <svg>
          <circle cx="70" cy="70" r="70"></circle>
          <circle cx="70" cy="70" r="70"></circle>
          <svg>
            <div class="num">
              <h2><?php echo $row['acousticness']?><span>%</span></h2>
            </div>
      </div>
          <h2 class="text">Acousticness</h2>
    </div>
  </div>
</div>
<div class="container">
  <div class="card">
    <div class="box">
      <div class="percent" style="--clr: #9fc40a; --num:<?php echo $row['speechiness']?>;">
        <svg>
          <circle cx="70" cy="70" r="70"></circle>
          <circle cx="70" cy="70" r="70"></circle>
          <svg>
            <div class="num">
              <h2><?php echo $row['speechiness']?><span>%</span></h2>
            </div>
      </div>
          <h2 class="text">Speechiness</h2>
    </div>
  </div>
</div>
<div class="container">
  <div class="card">
    <div class="box">
      <div class="percent" style="--clr: #f7051d; --num:<?php echo $row['popularity']?>;">
        <svg>
          <circle cx="70" cy="70" r="70"></circle>
          <circle cx="70" cy="70" r="70"></circle>
          <svg>
            <div class="num">
              <h2><?php echo $row['popularity']?><span>%</span></h2>
            </div>
      </div>
          <h2 class="text">Popularity</h2>
    </div>
  </div>
</div>
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