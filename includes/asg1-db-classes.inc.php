<?php 
class DatabaseHelper { 
 /* Returns a connection object to a database */
 public static function createConnection( $values=array() ) { 
 $connString = $values[0]; 
 $user = $values[1]; 
 $password = $values[2]; 
 $pdo = new PDO($connString,$user,$password); 
 $pdo->setAttribute(PDO::ATTR_ERRMODE, 
 PDO::ERRMODE_EXCEPTION); 
 $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, 
 PDO::FETCH_ASSOC); 
 return $pdo; 
 } 
 /*
 Runs the specified SQL query using the passed connection and 
 the passed array of parameters (null if none)
 */
 public static function runQuery($connection, $sql, $parameters) { 
 $statement = null; 
 // if there are parameters then do a prepared statement
 if (isset($parameters)) { 
 // Ensure parameters are in an array
 if (!is_array($parameters)) { 
 $parameters = array($parameters); 
 } 
 // Use a prepared statement if parameters 
 $statement = $connection->prepare($sql); 
 $executedOk = $statement->execute($parameters); 
 if (! $executedOk) throw new PDOException; 
 } else { 
 // Execute a normal query 
 $statement = $connection->query($sql); 
 if (!$statement) throw new PDOException; 
 } 
 return $statement; 
 } 
}
class SingleSongViewDB {
    private static $baseSQL = "SELECT song_id, title, artists.artist_name, types.type_name, genres.genre_name, year, duration, bpm, energy, danceability, liveness, valence, acousticness, speechiness, popularity
                                FROM songs
                                INNER JOIN artists ON artists.artist_id = songs.artist_id
                                INNER JOIN genres ON genres.genre_id = songs.genre_id
                                INNER JOIN types on types.type_id = artists.artist_type_id";
    public function __construct($connection) {
        $this->pdo = $connection;
    }

    public function getAll() {
        $sql = self::$baseSQL;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }
}
class BrowseByTitleDB {
    private static $baseSQL = "SELECT title, artist_name, year, genre_name, popularity, song_id
                                FROM songs  
                                NATURAL JOIN artists
                                NATURAL JOIN genres 
                                WHERE  title LIKE ?";

    public function __construct($connection) {
        $this->pdo = $connection;
    }

    public function getAll($title) {
        $newTitle = '%' . $title . '%';
        $sql = self::$baseSQL;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, array($newTitle));
        return $statement->fetchAll();
    }
}
class BrowseByArtistDB {
    private static $baseSQL = "SELECT title, artist_name, year, genre_name, popularity, song_id 
                                FROM songs  
                                NATURAL JOIN artists
                                NATURAL JOIN genres 
                                WHERE  artist_id = ?";

    public function __construct($connection) {
        $this->pdo = $connection;
    }

    public function getAll($artist) {
        $sql = self::$baseSQL;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, array($artist));
        return $statement->fetchAll();
    }
}
class BrowseByGenreDB {
    private static $baseSQL = "SELECT title, artist_name, year, genre_name, popularity, song_id
                                FROM songs  
                                NATURAL JOIN artists
                                NATURAL JOIN genres  
                                WHERE  genre_id =  ?";

    public function __construct($connection) {
        $this->pdo = $connection;
    }

    public function getAll($genre) {
        $sql = self::$baseSQL;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, array($genre));
        return $statement->fetchAll();
    }
}
class BrowseByLessYearDB {
    private static $baseSQL = "SELECT title, artist_name, year, genre_name, popularity, song_id
                                FROM songs  
                                NATURAL JOIN artists
                                NATURAL JOIN genres 
                                WHERE year < ?";

    public function __construct($connection) {
        $this->pdo = $connection;
    }

    public function getAll($year) {
        $sql = self::$baseSQL;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, array($year));
        return $statement->fetchAll();
    }
}
class BrowseByGreatYearDB {
    private static $baseSQL = "SELECT title, artist_name, year, genre_name, popularity, song_id 
                                FROM songs  
                                NATURAL JOIN artists
                                NATURAL JOIN genres 
                                WHERE  year > ?";

    public function __construct($connection) {
        $this->pdo = $connection;
    }

    public function getAll($year) {
        $sql = self::$baseSQL;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, array($year));
        return $statement->fetchAll();
    }
}
class BrowseByLessPopularityDB{
    private static $baseSQL = "SELECT title, artist_name, year, genre_name, popularity, song_id
                                FROM songs  
                                NATURAL JOIN artists
                                NATURAL JOIN genres 
                                WHERE popularity < ?";
    public function __construct($connection) {
        $this->pdo = $connection;
    }

    public function getAll($popularity) {
        $sql = self::$baseSQL;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, array($popularity));
        return $statement->fetchAll();
    }
}
class BrowseByGreatPopularityDB{
    private static $baseSQL = "SELECT title, artist_name, year, genre_name, popularity, song_id
                                FROM songs  
                                NATURAL JOIN artists
                                NATURAL JOIN genres 
                                WHERE popularity > ?";
    public function __construct($connection) {
        $this->pdo = $connection;
    }

    public function getAll($popularity) {
        $sql = self::$baseSQL;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, array($popularity));
        return $statement->fetchAll();
    }
}
class TopGenresDB {
    private static $baseSQL = "SELECT genre_name, COUNT(song_id) as Num_of_songs
                                FROM songs INNER JOIN genres USING(genre_id)
                                GROUP BY genre_name
                                ORDER BY COUNT(song_id) DESC
                                LIMIT 10";
    
    public function __construct($connection) {
        $this->pdo = $connection;
    }

    public function getAll() {
        $sql = self::$baseSQL;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }
}
class TopArtistDB {
    private static $baseSQL = "SELECT artist_name , COUNT(song_id) as num_of_songs
                                FROM songs INNER JOIN artists USING(artist_id)
                                GROUP BY artist_name
                                ORDER BY COUNT(song_id) DESC
                                LIMIT 10";

    public function __construct($connection) {
        $this->pdo = $connection;
    }

    public function getAll() {
        $sql = self::$baseSQL;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }
}
class MostPopularDB {
    private static $baseSQL = "SELECT title, artist_name, popularity
                                FROM songs INNER JOIN artists USING (artist_id)
                                GROUP BY title
                                ORDER BY popularity DESC
                                LIMIT 10";
    
    public function __construct($connection) {
        $this->pdo = $connection;
    }

    public function getAll() {
        $sql = self::$baseSQL;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }
}
class OneHitDB{
    private static $baseSQL = "SELECT artist_name , COUNT(song_id) as num_of_songs
                                FROM songs INNER JOIN artists USING(artist_id)
                                GROUP BY artist_name
                                HAVING COUNT(song_id) = 1
                                LIMIT 10";
    
    public function __construct($connection) {
        $this->pdo = $connection;
    }

    public function getAll() {
        $sql = self::$baseSQL;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }
}
class LongAcousticDB{
    private static $baseSQL = "SELECT title, artist.artist_name, year, genre.genre_name,popularity 
                                FROM songs
                                INNER JOIN artist ON artist.artist_id = songs.artist_id
                                INNER JOIN genres ON genres.genre_id = songs.genre_id
                                WHERE acousticness > 80
                                ORDER BY duration desc
                                LIMIT 10";
    
    public function __construct($connection) {
        $this->pdo = $connection;
    }

    public function getAll() {
        $sql = self::$baseSQL;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }
}
class ClubDB{
    private static $baseSQL = "SELECT title, artist.artist_name, year, genre.genre_name,popularity, ((danceability * 1.6) + (energy * 1.4)) AS calculation  
                                FROM songs
                                INNER JOIN artist ON artist.artist_id = songs.artist_id
                                INNER JOIN genres ON genres.genre_id = songs.genre_id
                                WHERE danceability > 80
                                ORDER BY calculation desc
                                LIMIT 10";
    
    public function __construct($connection) {
        $this->pdo = $connection;
    }

    public function getAll() {
        $sql = self::$baseSQL;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }
}
class RunningDB{
    private static $baseSQL = "SELECT title, artist.artist_name, year, genre.genre_name,popularity, ((energy * 1.3) + (valence * 1.6)) AS calculation  
                                FROM songs
                                INNER JOIN artist ON artist.artist_id = songs.artist_id
                                INNER JOIN genres ON genres.genre_id = songs.genre_id
                                WHERE bpm > 119 AND bpm < 126
                                ORDER BY calculation desc
                                LIMIT 10";
    
    public function __construct($connection) {
        $this->pdo = $connection;
    }

    public function getAll() {
        $sql = self::$baseSQL;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }
}
class StudyDB{
    private static $baseSQL = "SELECT title, artist.artist_name, year, genre.genre_name,popularity, ((acousticness * 0.8) + (100 - speechiness) + (100 - valence)) AS calculation  
                                FROM songs
                                INNER JOIN artist ON artist.artist_id = songs.artist_id
                                INNER JOIN genres ON genres.genre_id = songs.genre_id
                                WHERE bpm > 99 AND bpm < 116
                                ORDER BY calculation desc
                                LIMIT 10";

    public function __construct($connection) {
        $this->pdo = $connection;
    }

    public function getAll() {
        $sql = self::$baseSQL;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
        }
}
class AllDB{
    private static $baseSQL = "SELECT title, artist_name, year, genre_name, popularity, song_id
                                FROM songs  
                                NATURAL JOIN artists
                                NATURAL JOIN genres";
    
    public function __construct($connection) {
        $this->pdo = $connection;
    }

    public function getAll() {
        $sql = self::$baseSQL;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }
}