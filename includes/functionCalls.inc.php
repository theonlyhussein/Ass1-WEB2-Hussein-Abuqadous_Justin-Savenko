<?php  
require_once 'asg1-db-classes.inc.php';
function songInfoHeader($row, $minutes, $seconds) {
    $statement = "<p>" . $row['title'] . " -" . " Song Information</p>";
    $statement .= "<p> Artist Name: " . $row['artist_name'] . "</p>";
    $statement .= "<p> Artist Type: " . $row['type_name'] . "</p>";
    $statement .= "<p> Song Genre: " . $row['genre_name'] . "</p>";
    $statement .= "<p> Song Release Year: " . $row['year'] . "</p>";
    $statement .= "<p> Duration: " . $minutes . ":" . $seconds . "</p>";
    return $statement;
} ?>

<?php function favouriteOutput($data) { ?>

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
            echo "<td class='artist'>".$row['artist']."</td>";
            echo "<td class='year'>".$row['year']."</td>";
            echo "<td class='genre'>".$row['genre']."</td>";
            echo "<td class='popularity'>".$row['popularity']."</td>";
            echo "<td class='favorites'> <a href=' removeFavourites.php?song_id=". $row['song_id']. "' > Remove from Favorites   </td>";
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


<?php
    function output($data){
    echo "<table>";
    echo "<tr>";
    echo "<th>Title</th>";
    echo "<th class='artist'>Artist</th>";
    echo "<th class='year'>Year</th>";
    echo "<th class='genre'>Genre</th>";
    echo "<th class='popularity'>Populartiy</th>";
    echo"<th> </th>";
    echo"<th>  </th>";
    echo "</tr>";
    foreach ($data as $row) {

           echo "<tr>";
           echo "<td id='title'>".$row['title']."</td>";
           echo "<td class='artist'>".$row['artist_name']."</td>";
           echo "<td class='year'>".$row['year']."</td>";
           echo "<td class='genre'>".$row['genre_name']."</td>";
           echo "<td class='popularity'>".$row['popularity']."</td>";
           echo '<td class="favorites"><a href="addFavourites.php?song_id=' . $row['song_id'] . '&title=' . $row['title'] . '&artist=' . $row['artist_name'] . '&year=' . $row['year'] . '&genre=' . $row['genre_name'] . '&popularity=' . $row['popularity'] . '">' . "Add to Favourites" . '</a></td>';
           echo "<td class='favorites'> <a href=' singleSongPage.php?song_id=". $row['song_id']. "' > View  </td>";
           echo "</tr>";
    }
    echo "</table>";
    }

    function homeOutput($data){
        echo "<table>";
        echo "<tr>";
        echo "<th>Title</th>";
        echo "<th class='artist'>Artist</th>";
        echo "<th class='year'>Year</th>";
        echo "<th class='genre'>Genre</th>";
        echo "<th class='popularity'>Populartiy</th>";
        echo"<th> </th>";
        echo"<th>  </th>";
        echo "</tr>";
        foreach ($data as $row) {
               echo "<tr>";
               echo "<td id='title'> <a href=' singleSongPage.php?song_id=". $row['song_id']. "'>". $row['title'] ." </td>";
               echo "<td class='artist'>".$row['artist_name']." </a> </td>";
               echo "<td class='year'>".$row['year']."</td>";
               echo "<td class='genre'>".$row['genre_name']."</td>";
               echo "<td class='popularity'>".$row['popularity']."</td>";
               echo "</tr>";
        }
        echo "</table>";
        }
    
    function findbytitle($songtitle){
        try{
            $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
            $titleGateway = new BrowseByTitleDB($conn);
            $titles = $titleGateway->getAll($songtitle);
            $titleGateway = null;
            return $titles;
        }
        catch(PDOException $e){
            die($e->getMessage()); 
        }
        } 
        
    
    function findbyartist ($artist){
        try{
            $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
            $artistGateway = new BrowseByArtistDB($conn);
            $artists = $artistGateway->getAll($artist);
            $artistGateway = null;
            return $artists;
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        }
        }
    

    function findbygenre($genre){
        try{
            $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
            $genreGateway = new BrowseByGenreDB($conn);
            $genres = $genreGateway->getAll($genre);
            $genreGateway = null;
            return $genres;
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
    }
   
    function findbylessyear($less_year){
        try{
            $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
            $lessYearGateway = new BrowseByLessYearDB($conn);
            $lessYears = $lessYearGateway->getAll($less_year);
            $lessYearGateway = null;
            return $lessYears;
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
    }
    
    function findbygreateryear($greater_year){
        try{
            $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
            $greaterYearGateway = new BrowseByGreatYearDB($conn);
            $greatYears = $greaterYearGateway->getAll($greater_year);
            $greaterYearGateway = null;
            return $greatYears;
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
    }
    function findbylesspopularity($less_popularity){
        try{
            $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
            $lessPopularityGateway = new BrowseByLessPopularityDB($conn);
            $lessPopularities = $lessPopularityGateway->getAll($less_popularity);
            $lessPopularityGateway = null;
            return $lessPopularities;
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
    }
    
    function findbygreaterpopularity($greaterpopularity){
        try{
            $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
            $greaterPopularityGateway = new BrowseByGreatPopularityDB($conn);
            $greaterPopularities = $greaterPopularityGateway->getAll($greaterpopularity);
            $greaterPopularityGateway = null;
            return $greaterPopularities;
        }
        catch(PDOException $e){
            die($e->getMessage()); 
    
        } 
    }

    function topGenres(){
        try{
            $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
            $topGenreGateway = new TopGenresDB($conn);
            $topGenres = $topGenreGateway->getAll();
            $topGenreGateway = null;
            return $topGenres;
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }

    function topArtists(){
        try{
            $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
            $topArtistGateway = new TopArtistDB($conn);
            $topArtists = $topArtistGateway->getAll();
            $topArtistGateway = null;
            return $topArtists;
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }

    function mostPopular(){
        try{
            $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
            $mostPopularGateway = new MostPopularDB($conn);
            $mostPopular = $mostPopularGateway->getAll();
            $mostPopularGateway = null;
            return $mostPopular;
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }

    function oneHit(){
        try{
            $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
            $oneHitGateway = new OneHitDB($conn);
            $oneHit = $oneHitGateway->getAll();
            $oneHitGateway = null;
            return $oneHit;
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }

    function longAcoustic(){
        try{
            $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
            $longAcousticGateway = new LongAcousticDB($conn);
            $longAcoustic = $longAcousticGateway->getAll();
            $longAcousticGateway = null;
            return $longAcoustic;
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }

    function atClub(){
        try{
            $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
            $atClubGateway = new ClubDB($conn);
            $atClub = $atClubGateway->getAll();
            $atClubGateway = null;
            return $atClub;
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }

    function running(){
        try{
            $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
            $runningGateway = new RunningDB($conn);
            $running = $runningGateway->getAll();
            $runningGateway = null;
            return $running;
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }

    function studying(){
        try{
            $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
            $studyingGateway = new StudyDB($conn);
            $studying = $studyingGateway->getAll();
            $studyingGateway = null;
            return $studying;
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }
?>   





