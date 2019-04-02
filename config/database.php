<?php
/**
 * Created by PhpStorm.
 * User: mohamadzaki
 * Date: 23/03/2019
 * Time: 8:07 PM
 */

/**
 * Class Database
 */
class Database
{

    private $host = "localhost";
    private $username = "root";
    private $password = "password";//"<YOUR_DB_PASSWORD>";
    private $database = "meeting_room";//"<YOUR_DB_NAME>";

    public $connection;

    // get the database connection
    public function getConnection()
    {

        $this->connection = null;

        try {
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
            $this->connection->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage();
        }

        return $this->connection;
    }
}

/**
 * Initialize session data
 * @return bool This function returns true if a session was successfully started,
 */
session_start();

function validation_msg($msg = '', $class = 'success')
{

    return '<div class="alert alert-' . $class . '">' . $msg . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
}

function redirect($url, $msg = null, $class = 'success')
{
    if ($msg) {
        $_SESSION['message'] = array($msg, $class);
    }

    header("Location: $url");

}

function redirect_flash()
{
    if (!empty($_SESSION['message'])) {
        echo validation_msg($_SESSION['message'][0], $_SESSION['message'][1]);
        unset($_SESSION['message']);
    }
}

function dd($data)
{
    echo '<pre style="color : #aed581; background: black">';
    print_r($data);
    exit;
}