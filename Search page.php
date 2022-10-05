<?php  
/* add your PHP code here */
require_once('config.inc.php');                
?>
<!DOCTYPE html>
<html lang=en>
<head>
    <title>Song Website Search page</title>
    <meta charset=utf-8>
</head>
<body>
    <section>
    <form action="/Browse_Search Results Page.php" method="get">
        <div id="title">
        <label>Title</label> 
        <input type="text"  name="Title" > <br>
        </div>
        <div id="artist">
        <label> Artist </label>
        <select name="artist" >
            <option value='0'> Select Artist</option>
            <?php 
                try{
                    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql="select artist_name from artists";
                    $result = $pdo->query($sql);
                    $data = $result->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($data as $row) { 
                        echo '<option value="' . $row['artist_id'] . '">'; 
                        echo $row['artist_name']; 
                        echo "</option>"; 
                    } 
                    $pdo = null;
                }
                catch (PDOException $e) { 
                    die( $e->getMessage() ); 
                }
                
            ?>
        </select>
        </div>
        <div id="genre">
        <label> Genre </label>
        <select name="genre">
            <option value='0'>Select Genre</option> 
            <?php  
                try { 
                    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql="select genre_name from genres";
                    $result = $pdo->query($sql);
                    $data = $result->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($data as $row) { 
                        echo '<option value="' . $row['genre_id'] . '">'; 
                        echo $row['genre_name']; 
                        echo "</option>"; 
                    } 
                    $pdo = null;
                }
                catch (PDOException $e) { 
                    die( $e->getMessage() ); 
                }
            ?>
        </select> <br>
        </div>
        <div id="year">
        <label> Year</label> <br>
        <label>Less</label> <input type="text" size="4" maxlength="4"  name="less_Year"> <br>
        <label>Greater</label> <input type ="text" size="4" maxlength="4"  name="Greater_Year"> <br>
        </div>
        <div id="popularity">
        <label> Popularity </label> <br>
        <label> Less </label> <input type ="text" size="4"  name="Less_Popularity"> <br>
        <label>Greater</label> <input type ="text" size="4"  name="Greater_Popularity"> <br>
        </div>
        <button type="button"> Search </button>
        </section>
    </form>


</body>


</html>