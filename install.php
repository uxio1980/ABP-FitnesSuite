<form action="install.php" method="POST">
    <p>Mysql Root User: <input type="text" name="user" /></p>
    <p>Mysql Root Password:  <input type="password" name="passwd" /></p>
    <p><input type="submit" name="submit" value="submit" /></p>
</form>

<?php
if (isset($_POST["submit"])){

    $mysqlUserName = $_POST["user"];
    $mysqlPasswd = $_POST["passwd"];
    $dbFile = "fitnessdb-db.sql";
    $command='mysql -u' .$mysqlUserName .' -p' .$mysqlPasswd . ' < ' .$dbFile;
    exec($command,$output=array(),$worked);
    switch($worked){
	case 0:
            echo 'Import file <b>' .$dbFile .'</b> successfully imported to database<br />';
            break;
	case 1:
            echo 'There was an error during import: User already Exists or You insert bad credentials<br /><br />';

            break;
    }
}
?>
