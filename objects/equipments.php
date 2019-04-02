<?php
/**
 * Created by PhpStorm.
 * User: mohamadzaki
 * Date: 24/03/2019
 * Time: 12:40 PM
 */

/**
 * Class Equipments
 */
class Equipments
{
// Connection instance
    private $connection;

    // table name
    private $table_name = "equipments";

    // table columns
    public $id;
    public $name;
    public $description;
    public $status;

    /**
     * Rooms constructor.
     * @param $connection
     */
    public function __construct($connection)
    {
        $this->connection = $connection;
    }


    /**
     * Browse
     *
     */
    public function browse()
    {

        try {
            $query = "SELECT `Equipment`.`id`,
                        `Equipment`.`name`,
                        `Equipment`.`description`,
                        `Equipment`.`status`
                    FROM {$this->table_name} Equipment";

            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $results;
            } else {
                $results = [];//empty
                return $results;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    /**
     * Read
     *
     */
    public function read($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM {$this->table_name} WHERE id = :id LIMIT 1");
            $stmt->bindparam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $results = $stmt->fetch(PDO::FETCH_ASSOC);
                return $results;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Edit
     *
     */
    public function edit()
    {
        try {

            $id = $this->id;
            $name = $this->name;
            $description = $this->description;
            $status = $this->status;

            $stmt = $this->connection->prepare("UPDATE {$this->table_name} SET name=:name, description=:description, status=:status WHERE id=:id");

            $stmt->bindparam(':id', $id, PDO::PARAM_INT);
            $stmt->bindparam(':name', $name, PDO::PARAM_STR);
            $stmt->bindparam(':description', $description, PDO::PARAM_STR);
            $stmt->bindparam(':status', $status, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * Add
     *
     */
    public function add()
    {
        try {

            $name = $this->name;
            $description = $this->description;
            $status = $this->status;


            $stmt = $this->connection->prepare("INSERT INTO {$this->table_name} (name,description,status) VALUES(:name,:description,:status)");

            $stmt->bindparam(':name', $name, PDO::PARAM_STR);
            $stmt->bindparam(':description', $description, PDO::PARAM_STR);
            $stmt->bindparam(':status', $status, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return true;
            }
            return false;


        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * Delete
     *
     */
    public function delete($id)
    {
        try {
            $sql = "DELETE FROM {$this->table_name} WHERE id=:id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindparam(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function findList()
    {
        try {
            $query = "SELECT `Equipment`.`id`,`Equipment`.`name` FROM {$this->table_name} Equipment";

            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $results;
            } else {
                $results = [];//empty
                return $results;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}