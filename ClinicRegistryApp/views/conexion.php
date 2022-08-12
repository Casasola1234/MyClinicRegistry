 <?php
//class Db{
  //  private static $instance = NULL;
    //private function __construct() {}
    //private function __clone() {}
    //public static function getConnect(){
      //  try{
        //    if(!isset(self::$instance)){
          //      $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
            //    self::$instance=new PDO(
              //  'mysql:host=localhost;dbname=proyecto',
                //'root',
                //'123'
                //);
            //}
            //return self::$instance;     
        //} catch (PDOException $e) {
          //  echo 'Falló la conexión: ' . $e->getMessage();
        //}
    //}
//} 



/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'proyecto');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>