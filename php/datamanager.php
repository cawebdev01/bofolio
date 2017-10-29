<?php 
header('Access-Control-Allow-Origin: *');
 // Define database connection parameters
 $hn      = 'localhost';
 $un      = 'root';
 $pwd     = 'root';
 $db      = 'arcamonecreations_prod';
 $cs      = 'utf8';

 // Set up the PDO parameters
 $dsn  = "mysql:host=" . $hn . ";port=8889;dbname=" . $db . ";charset=" . $cs;
 $opt  = array(
                      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                      PDO::ATTR_EMULATE_PREPARES   => false,
                     );
 // Create a PDO instance (connect to the database)
 $pdo  = new PDO($dsn, $un, $pwd, $opt);

 // Retrieve specific parameter from supplied URL
 $key  = strip_tags($_REQUEST['key']);
 $data    = array();


 // Determine which mode is being requested
 switch($key)
 {

    // Add a new record to the technologies table
    case "create":

       // Sanitise URL supplied values
       $title = filter_var($_REQUEST['title'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
       $thumbnail = filter_var($_REQUEST['thumb'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW); 
       $url = filter_var($_REQUEST['url'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
       $tags = filter_var($_REQUEST['tags'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
       $type = filter_var($_REQUEST['type'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
       $description   = filter_var($_REQUEST['description'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
       $visibility = filter_var($_REQUEST['visible'], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ENCODE_LOW);

       // Attempt to run PDO prepared statement
       try {
          $sql  = "INSERT INTO `content` (`id`, `title`, `thumbnail`, `url`, `tags`, `type`, `description`, `visibility`) VALUES(NULL, :title, :thumb, :url, :tags, :type, :description, :visible)";
          $stmt    = $pdo->prepare($sql);
          $stmt->bindParam(':title', $title, PDO::PARAM_STR);
          $stmt->bindParam(':thumb', $thumbnail, PDO::PARAM_STR);
          $stmt->bindParam(':url', $url, PDO::PARAM_STR);
          $stmt->bindParam(':tags', $tags, PDO::PARAM_STR);
          $stmt->bindParam(':type', $type, PDO::PARAM_STR);
          $stmt->bindParam(':description', $description, PDO::PARAM_STR);
          $stmt->bindParam(':visible', $visibility, PDO::PARAM_INT);
          $stmt->execute();

          echo json_encode(array('message' => 'Congratulations the record ' . $title . ' was added to the database'));
       }
       // Catch any errors in running the prepared statement
       catch(PDOException $e)
       {
          echo $e->getMessage();
       }

    break;



    // Update an existing record in the technologies table
    case "update":

       // Sanitise URL supplied values
       $recordID = filter_var($_REQUEST['recordID'], FILTER_SANITIZE_NUMBER_INT);
       $title = filter_var($_REQUEST['title'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
       $thumbnail = filter_var($_REQUEST['thumb'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
       $url = filter_var($_REQUEST['url'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
       $tags = filter_var($_REQUEST['tags'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
       $type = filter_var($_REQUEST['type'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
       $description   = filter_var($_REQUEST['description'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
       $visibility = filter_var($_REQUEST['visible'], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ENCODE_LOW);
       

       // Attempt to run PDO prepared statement
       try {
          $sql  = "UPDATE content SET title = :title, thumb = :thumb, url = :url, tags = :tags, type = :type, description = :description, visible = :visible WHERE id = :recordID";
          $stmt =  $pdo->prepare($sql);
          $stmt->bindParam(':recordID', $recordID, PDO::PARAM_INT);
          $stmt->bindParam(':title', $title, PDO::PARAM_STR);
          $stmt->bindParam(':thumb', $thumbnail, PDO::PARAM_STR);
          $stmt->bindParam(':url', $url, PDO::PARAM_STR);
          $stmt->bindParam(':tags', $tags, PDO::PARAM_STR);
          $stmt->bindParam(':type', $type, PDO::PARAM_STR);
          $stmt->bindParam(':description', $description, PDO::PARAM_STR);
          $stmt->bindParam(':visible', $visibility, PDO::PARAM_INT);
          $stmt->execute();

          echo json_encode('Congratulations the record ' . $title . ' was updated');
       }
       // Catch any errors in running the prepared statement
       catch(PDOException $e)
       {
          echo $e->getMessage();
       }

    break;



    // Remove an existing record in the technologies table
    case "delete":

       // Sanitise supplied record ID for matching to table record
       $recordID   =  filter_var($_REQUEST['recordID'], FILTER_SANITIZE_NUMBER_INT);

       // Attempt to run PDO prepared statement
       try {
          $pdo  = new PDO($dsn, $un, $pwd);
          $sql  = "DELETE FROM content WHERE id = :recordID";
          $stmt = $pdo->prepare($sql);
          $stmt->bindParam(':recordID', $recordID, PDO::PARAM_INT);
          $stmt->execute();

          echo json_encode('Congratulations the record ' . $name . ' was removed');
       }
       // Catch any errors in running the prepared statement
       catch(PDOException $e)
       {
          echo $e->getMessage();
       }

    break;
 }

?>