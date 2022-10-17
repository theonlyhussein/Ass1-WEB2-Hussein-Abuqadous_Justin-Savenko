<?php
session_start();

if(isset($_GET['song_id']) && ! empty($_GET['song_id'])) {

    if(! isset($_SESSION['favourites'])) {
        $favourites = array();
        $_SESSION['favourites'] = $favourites;
    }
    $favourites = $_SESSION['favourites'];
    $favourites[] = array("song_id" => $_GET['song_id'],"title" => $_GET['title'], "artist" => $_GET['artist'],"year" => $_GET['year'], "genre" => $_GET['genre'], "popularity" => $_GET['popularity']);
    $_SESSION['favourites'] = $favourites;
}
header("Location: viewFavourites.php");
?>
