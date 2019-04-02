<?php
/**
 * Created by PhpStorm.
 * User: mohamadzaki
 * Date: 23/03/2019
 * Time: 10:38 PM
 */

/**
 * Class Bookings
 */
class Bookings
{
    // Connection instance
    private $connection;

    // table name
    private $table_name = "bookings";

    // table columns
    public $id;
    public $client_id;
    public $attendees;
    public $room_id;
    public $equipment;
    public $date_start;
    public $date_end;
    public $notes;
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
            $query = "SELECT `Booking`.`id`,`Booking`.`client_id`,`Booking`.`room_id`,`Booking`.`date_start`,
                        `Booking`.`date_end`, `Booking`.`notes`, `Booking`.`status`, `Booking`.`created`, `Booking`.`modified`, 
                        `Client`.`name` `ClientName`,`Client`.`email` `ClientEmail`, `Room`.`name` `RoomName` FROM {$this->table_name} Booking
                      JOIN clients Client ON `Client`.`id` = `Booking`.`client_id` 
                      JOIN rooms Room ON `Room`.`id` = `Booking`.`room_id`";

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
            $stmt = $this->connection->prepare("SELECT * FROM {$this->table_name} `Booking` WHERE id = :id LIMIT 1");
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
            $client_id = $this->client_id;
            $room_id = $this->room_id;
            $attendees = $this->attendees;
            $date_start = date('Y-m-d', strtotime($this->date_start));
            $date_end = date('Y-m-d', strtotime($this->date_end));
            $notes = $this->notes;
            $equipments = $this->equipment;
            $status = $this->status;
            $modified = date('Y-m-d H:i:s');

            $stmt = $this->connection->prepare("UPDATE {$this->table_name} SET client_id=:client_id, room_id=:room_id, attendees=:attendees, date_start=:date_start, date_end=:date_end, notes=:notes, status=:status, modified=:modified WHERE id=:id");

            $stmt->bindparam(':id', $id, PDO::PARAM_INT);
            $stmt->bindparam(':client_id', $client_id, PDO::PARAM_STR);
            $stmt->bindparam(':room_id', $room_id, PDO::PARAM_STR);
            $stmt->bindparam(':attendees', $attendees, PDO::PARAM_STR);
            $stmt->bindparam(':date_start', $date_start, PDO::PARAM_STR);
            $stmt->bindparam(':date_end', $date_end, PDO::PARAM_STR);
            $stmt->bindparam(':notes', $notes, PDO::PARAM_STR);
            $stmt->bindparam(':status', $status, PDO::PARAM_INT);
            $stmt->bindparam(':modified', $modified);
            if ($stmt->execute()) {

                //Delete existing bookings_equipments and replace with new update
                $delStmt = $this->connection->prepare("DELETE FROM bookings_equipments WHERE booking_id=:id");
                $delStmt->bindparam(':id', $id, PDO::PARAM_INT);
                $delStmt->execute();

                foreach ($equipments as $equipment) {
                    $this->eqp($id, $equipment);
                }
                return true;
            }
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

            $client_id = $this->client_id;
            $room_id = $this->room_id;
            $attendees = $this->attendees;
            $date_start = date('Y-m-d', strtotime($this->date_start));
            $date_end = date('Y-m-d', strtotime($this->date_end));
            $notes = $this->notes;
            $equipments = $this->equipment;
            $status = $this->status;
            $created = date('Y-m-d H:i:s');
            $modified = date('Y-m-d H:i:s');


            $stmt = $this->connection->prepare("INSERT INTO {$this->table_name} (client_id,room_id,attendees,date_start,date_end,notes,status,created,modified) VALUES(:client_id,:room_id,:attendees,:date_start,:date_end,:notes,:status,:created,:modified)");

            $stmt->bindparam(':client_id', $client_id, PDO::PARAM_STR);
            $stmt->bindparam(':room_id', $room_id, PDO::PARAM_STR);
            $stmt->bindparam(':attendees', $attendees, PDO::PARAM_STR);
            $stmt->bindparam(':date_start', $date_start, PDO::PARAM_STR);
            $stmt->bindparam(':date_end', $date_end, PDO::PARAM_STR);
            $stmt->bindparam(':notes', $notes, PDO::PARAM_STR);
            $stmt->bindparam(':status', $status, PDO::PARAM_INT);
            $stmt->bindparam(':created', $created);
            $stmt->bindparam(':modified', $modified);
            if ($stmt->execute()) {
                $lastInsertId = $this->connection->lastInsertId();
                foreach ($equipments as $equipment) {
                    $this->eqp($lastInsertId, $equipment);
                }
                return true;
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

    public function bookings_equipments($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT equipment_id FROM bookings_equipments `Booking` WHERE booking_id = :id");
            $stmt->bindparam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $arr = array();
                foreach ($results as $result):
                    $arr[] = $result['equipment_id'];
                endforeach;
                return $arr;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    private function eqp($lastInsertId, $equipment)
    {
        $created = date('Y-m-d H:i:s');
        $modified = date('Y-m-d H:i:s');

        $stmtEqp = $this->connection->prepare("INSERT INTO bookings_equipments (booking_id,equipment_id,created,modified) VALUES (:booking_id,:equipment_id,:created,:modified)");

        $stmtEqp->bindparam(':booking_id', $lastInsertId);
        $stmtEqp->bindparam(':equipment_id', $equipment);
        $stmtEqp->bindparam(':created', $created);
        $stmtEqp->bindparam(':modified', $modified);
        $stmtEqp->execute();
    }
}