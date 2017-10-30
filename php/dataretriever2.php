<?php
   header('Access-Control-Allow-Origin: *'); 
   
   // Define database connection parameters
   $hn      = 'localhost';
   $un      = 'clement';
   $pwd     = 'CheriChou2503';
   $db      = 'arcamonecreations';
   $cs      = 'utf8';
   
   // Set up the PDO parameters
   $dsn  = "mysql:host=" . $hn . ";port=3306;dbname=" . $db . ";charset=" . $cs;
   $opt  = array(
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                        PDO::ATTR_EMULATE_PREPARES   => false,
                       );
   // Create a PDO instance (connect to the database)
   $pdo  = new PDO($dsn, $un, $pwd, $opt);
   $collect = strip_tags($_REQUEST['collect']);
   $data = array();

   // Attempt to query database table and retrieve data 
if($collect != ''){
    $rq = 'SELECT * FROM content WHERE type ="'. $collect .'" ORDER BY id DESC';
} else {
    $rq = 'SELECT * FROM content ORDER BY id DESC';
}
try {    
    $stmt    = $pdo->query($rq); 
    while($row  = $stmt->fetch(PDO::FETCH_OBJ))
    {
        // Assign each row of data to associative array
        $data[] = $row;
    }

    // Return data as JSON
    echo json_encode($data);
}
catch(PDOException $e)
{
    echo $e->getMessage();
}

?>