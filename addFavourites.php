<?php
session_start();

if(isset($_GET['song_id']) && ! empty($_GET['song_id'])) {

    if(! isset($_SESSION['favourites'])) {
        $favourites = array();
        $_SESSION['favourites'] = $favourites;
    }
    $favourites = $_SESSION['favourites'];
    $favourites[] = array($_GET['song_id'],$_GET['title'],$_GET['artist'],$_GET['year'],$_GET['genre'],$_GET['popularity']);
    $_SESSION['favourites'] = $favourites;
}
header("Location: viewFavourites.php");
?>
