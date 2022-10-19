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