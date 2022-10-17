<?php
session_start();

if (isset($_GET['song_id']) && ! empty($_GET['song_id'])) {
    if(! isset($_SESSION['favourites'])) {
        $favourites = array();
        $_SESSION['favourites'] = $favourites;
    }
    $favourites = $_SESSION['favourites'];

    $indexDelete = -1;
    for($i=0; $i<count($favourites); $i++) {
        if ($favourites[$i]['song_id'] == $_GET['song_id']) {
            $indexDelete = $i;
            break;
        }
    }
    if ($indexDelete > -1) {
        unset($favourites[$indexDelete]);
        $_SESSION['favourites'] = $favourites;
    }

    $_SESSION['favourites'] = $favourites;
}
else {
    $favourites = array();
    $_SESSION['favourites'] = $favourites;
}

header("Location: viewFavourites.php");
?>