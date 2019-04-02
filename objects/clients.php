<?php
/**
 * Created by PhpStorm.
 * User: mohamadzaki
 * Date: 24/03/2019
 * Time: 12:40 PM
 */

/**
 * Class Clients
 */
class Clients
{
// Connection instance
    private $connection;

    // table name
    private $table_name = "clients";

    // table columns
    public $id;
    public $title;
    public $name;
    public $email;
    public $phone;
    public $company;
    public $address;
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
            $query = "SELECT * FROM {$this->table_name} Client";

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
            $email = $this->email;
            $phone = $this->phone;
            $company = $this->company;
            $address = $this->address;
            $status = $this->status;
            $modified = date('Y-m-d H:i:s');

            $stmt = $this->connection->prepare("UPDATE {$this->table_name} SET name=:name, email=:email, phone=:phone, company=:company, address=:address, status=:status, modified=:modified WHERE id=:id");

            $stmt->bindparam(':id', $id, PDO::PARAM_INT);
            $stmt->bindparam(':name', $name, PDO::PARAM_STR);
            $stmt->bindparam(':email', $email, PDO::PARAM_STR);
            $stmt->bindparam(':phone', $phone, PDO::PARAM_STR);
            $stmt->bindparam(':company', $company, PDO::PARAM_STR);
            $stmt->bindparam(':address', $address, PDO::PARAM_STR);
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
            $email = $this->email;
            $phone = $this->phone;
            $company = $this->company;
            $address = $this->address;
            $status = $this->status;
            $created = date('Y-m-d H:i:s');
            $modified = date('Y-m-d H:i:s');

            if ($this->findByEmail($email)) {

                $stmt = $this->connection->prepare("INSERT INTO {$this->table_name} (name,email,phone,company,address,status,created,modified) VALUES(:name, :email, :phone,:company,:address, :status,:created,:modified)");

                $stmt->bindparam(':name', $name, PDO::PARAM_STR);
                $stmt->bindparam(':email', $email, PDO::PARAM_STR);
                $stmt->bindparam(':phone', $phone, PDO::PARAM_STR);
                $stmt->bindparam(':company', $company, PDO::PARAM_STR);
                $stmt->bindparam(':address', $address, PDO::PARAM_STR);
                $stmt->bindparam(':status', $status, PDO::PARAM_INT);
                $stmt->bindparam(':created', $created);
                $stmt->bindparam(':modified', $modified);
                //dd($stmt);
                if ($stmt->execute()) {
                    $lastInsertId = $this->connection->lastInsertId();
                    $data = array(
                        'id' => $lastInsertId,
                        'name' => $name,
                        'email' => $email,
                        'phone' => $phone,
                        'address' => $address,
                        'status' => $status,
                        'created' => $created,
                        'modified' => $modified);
                    return $data;
                }
                return false;
            } else {
                return 'exists';
            }

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
            $query = "SELECT `Client`.`id`,`Client`.`name` FROM {$this->table_name} Client";

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

    private function findByEmail($email)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM {$this->table_name} WHERE email = :email LIMIT 1");
            $stmt->bindparam(':email', $email, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() == 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}