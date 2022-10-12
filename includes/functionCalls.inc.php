<?php  function songInfoHeader($row, $minutes, $seconds) {
    $statement = "<p>" . $row['title'] . " -" . " Song Information</p>";
    $statement .= "<p> Artist Name: " . $row['artist_name'] . "</p>";
    $statement .= "<p> Artist Type: " . $row['type_name'] . "</p>";
    $statement .= "<p> Song Genre: " . $row['genre_name'] . "</p>";
    $statement .= "<p> Song Release Year: " . $row['year'] . "</p>";
    $statement .= "<p> Duration: " . $minutes . ":" . $seconds . "</p>";
    return $statement;
} ?>
