<?php
/**
 * Created by PhpStorm.
 * User: mohamadzaki
 * Date: 23/03/2019
 * Time: 8:09 PM
 */

/**
 * Class Rooms
 */
class Rooms
{
    // Connection instance
    private $connection;

    // table name
    private $table_name = "rooms";

    // table columns
    public $id;
    public $name;
    public $capacity;
    public $description;
    public $status;
    public $created;
    public $modified;

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
            $query = "SELECT `Room`.`id`,
                        `Room`.`name`,
                        `Room`.`capacity`,
                        `Room`.`description`,
                        `Room`.`status`,
                        `Room`.`created`,
                        `Room`.`modified`
                    FROM {$this->table_name} Room";

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
            $capacity = $this->capacity;
            $status = $this->status;
            $modified = date('Y-m-d H:i:s');

            $stmt = $this->connection->prepare("UPDATE {$this->table_name} SET name=:name, description=:description, capacity=:capacity, status=:status, modified=:modified WHERE id=:id");
            $stmt->bindparam(':id', $id, PDO::PARAM_INT);
            $stmt->bindparam(':name', $name, PDO::PARAM_STR);
            $stmt->bindparam(':description', $description, PDO::PARAM_STR);
            $stmt->bindparam(':capacity', $capacity, PDO::PARAM_INT);
            $stmt->bindparam(':status', $status, PDO::PARAM_INT);
            $stmt->bindparam(':modified', $modified);
            $stmt->execute();
            return true;
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
            $capacity = $this->capacity;
            $status = $this->status;
            $created = date('Y-m-d H:i:s');
            $modified = date('Y-m-d H:i:s');

            $stmt = $this->connection->prepare("INSERT INTO {$this->table_name} (name,description,capacity,status,created,modified) VALUES(:name, :description, :capacity, :status,:created,:modified)");
            $stmt->bindparam(':name', $name, PDO::PARAM_STR);
            $stmt->bindparam(':description', $description, PDO::PARAM_STR);
            $stmt->bindparam(':capacity', $capacity, PDO::PARAM_INT);
            $stmt->bindparam(':status', $status, PDO::PARAM_INT);
            $stmt->bindparam(':created', $created);
            $stmt->bindparam(':modified', $modified);
            $stmt->execute();
            return true;
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

            $stmt = $this->connection->prepare("DELETE FROM {$this->table_name} WHERE id =:id");
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

    }

    public function findList()
    {
        try {
            $query = "SELECT `Room`.`id`,`Room`.`name` FROM {$this->table_name} Room";

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