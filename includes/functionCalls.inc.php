<?php  function songInfoHeader($row, $minutes, $seconds) {
    $statement = "<p>" . $row['title'] . " -" . " Song Information</p>";
    $statement .= "<p> Artist Name: " . $row['artist_name'] . "</p>";
    $statement .= "<p> Artist Type: " . $row['type_name'] . "</p>";
    $statement .= "<p> Song Genre: " . $row['genre_name'] . "</p>";
    $statement .= "<p> Song Release Year: " . $row['year'] . "</p>";
    $statement .= "<p> Duration: " . $minutes . ":" . $seconds . "</p>";
    return $statement;
} ?>

<?php function output($data) { ?>

    <table>
     <tr>
     <th>Title</th>
     <th class='artist'>Artist</th>
     <th class='year'>Year</th>
     <th class='genre'>Genre</th>
     <th class='popularity'>Populartiy</th>
    <th> </th>
    <th>  </th>
     </tr>
     <?php
          foreach($data as $row) {
            echo "<tr>";
            echo "<td id='title'>".$row['title']."</td>";
            echo "<td class='artist'>".$row['artist_name']."</td>";
            echo "<td class='year'>".$row['year']."</td>";
            echo "<td class='genre'>".$row['genre_name']."</td>";
            echo "<td class='popularity'>".$row['popularity']."</td>";
            echo "<td class='favorites'> <a href=' viewFavourites.php?song_id=<?=". $row['song_id']. "?>' > Add to Favorites   </td>";
            echo "<td class='favorites'> <a href=' singleSongPage.php?song_id=". $row['song_id']. "' > View  </td>";
            echo "</tr>";
          } echo "</table>" ?>
<?php } ?>

<?php function progressBars($row) { ?>
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
<?php } ?>
        





