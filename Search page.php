<?php  
/* add your PHP code here */
require_once('./includes/config.inc.php');                
?>
<!DOCTYPE html>
<html lang=en>
<head>
    <title>COMP 3512 Assign1-Song  Search page</title>
    <meta charset=utf-8>
    <link rel="stylesheet" href="./css/searchpage.css">
    <p class="subtitle" align="right">Hussein Abuqadous & Justin Savenko</p>
    <nav>
        <ul>
        <li><div class="link"><a href="Homepage.php"> Home   </a></div> </li>
        <li><div class="link"><a href="Search_Results_and_browsePage.php"> Browse  </a></div> </li>
        <li><div class="link"><a href="viewFavourites.php"> Favourites  </a> </div> </li>
       <li><div class="link"><a href="singleSongPage.php"> Single Song</a></div> </li> 
        </ul>
    </nav>
</head>
<body>
    <h1>Song Search</h1>
    <form action="Search_Results_and_browsePage.php" method="get">
        <label id="labeltitle">Title</label> 
        <input type="text" name ="title" id="title">
        <label class="labelartist"> Artist </label>
        <select name="artist" id="aritst">
            <option value="0"> Select Artist</option>
            <?php 
                try{
                    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql="select artist_name, artist_id from artists";
                    $result = $pdo->query($sql);
                    $data = $result->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($data as $row) { 
                        echo '<option value="' . $row["artist_id"] . '">'; 
                        echo ($row["artist_name"]); 
                        echo '</option>'; 
                    } 
                    $pdo = null;
                }
                catch (PDOException $e) { 
                    die( $e->getMessage() ); 
                }   
            ?>
        </select>
        <label class="labelartist"> Genre </label>
        <select  name="genre" id="genre">
            <option value='0'>Select Genre</option> 
            <?php  
                try { 
                    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); 
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql="select genre_name,genre_id from genres";
                    $result = $pdo->query($sql);
                    $data = $result->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($data as $row) { 
                        echo '<option value="' . $row["genre_id"] . '">'; 
                        echo utf8_encode($row["genre_name"]); 
                        echo "</option>"; 
                    } 
                    $pdo = null;
                }
                catch (PDOException $e) { 
                    die( $e->getMessage() ); 
                }
            ?>
        </select> <br>
        <section class="container">
        <div>
        <label class="year"> Year</label><br>
        <label class="year">Less</label> <input type="text" size="4" maxlength="4" placeholder="4 digits" pattern="[0-9]" name="less_Year" id="less_Year"> <br>
        <label class="year">Greater</label> <input type ="text" size="4" maxlength="4" placeholder="4 digits"  pattern="[0-9]"  name="Greater_Year" id="greater_Year"> 
        </div>
        <div>
        <label class="Popularity"> Popularity </label> <br>
        <label class="Popularity"> Less </label> <input type ="text" size="4"  placeholder="0-100"  pattern="[0-9]{1,3}"  name="Less_Popularity" id="Less_Popularity"> <br>
        <label class="Popularity">Greater</label> <input type ="text" size="4"  placeholder="0-100" name="Greater_Popularity"  pattern="[0-9]{1,3}"  id="Greater_Popularity"> <br>
        </div>
        </section>
        <input  type="submit" name="search" value="Search" >

    </form>
    <footer>
  <div>COMP 3512 Fall 2022</div>
  <div>Hussein Abuqadous & Justin Savenko &#169</div>
  <div><a href ="https://github.com/theonlyhussein/Ass1-WEB2-Hussein-Abuqadous_Justin-Savenko">Github Repo</a></div>
  <div><a href ="https://github.com/theonlyhussein">Hussein Github</a></div>
  <div><a href ="https://github.com/Jsavy">Justin Github</a></div>
</footer>

</body>


</html>
