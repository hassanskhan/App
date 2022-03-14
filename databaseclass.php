<?php



$server="localhost";
$username="root";
$password="";
$dbname="blogs";
$conn=new mysqli($server,$username,$password,$dbname);
if ($conn->connect_error) {
    die("Faild To connect".$conn->connect_error);
}

class Database
{
    private $server = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "blogs";

    private $mysqli = "";
    private $result = array();
    private $conn = false;
    public function __construct()
    {
     
        if (!$this->conn) {
            $this->mysqli = new mysqli($this->server, $this->username, $this->password, $this->dbname);
            $this->conn = true;
            if ($this->mysqli->connect_error) {
                array_push($this->result, $this->mysqli->connect_error);
                return false;
            }
        } else {
            return true;
        }
    }

    //function to Insert data in Database
    public function insert($table, $param = array())
    {
        if ($this->tableExits($table)) {
            //  print_r($param);
            $table_coloum = implode(', ', array_keys($param));
            $table_values = implode("', '", $param);
            $sql = " INSERT INTO $table ($table_coloum) VALUES ('$table_values') ";
            if ($this->mysqli->query($sql)) {
                array_push($this->result, $this->mysqli->insert_id);
                return true;
            }
        } else {
            array_push($this->result, $this->mysqli->error);
            return false;
        }
    }
    //function to updatedata in database
    public function update($table, $param = array(), $where = null)
    {

        if ($this->tableExits($table)) {
            $args = array();
            foreach ($param as $key => $value) {
                $args[] = "$key = '$value'";
            }
            // print_r($args);
            $sql = "UPDATE $table SET " . implode(', ', $args);
            if ($where != null) {
                $sql .= " WHERE $where";
            }
            if ($this->mysqli->query($sql)) {
                array_push($this->result, $this->mysqli->affected_rows);
                return true;
            } else {
                array_push($this->result, $this->mysqli->error);
            }
        } else {
            return false;
        }
    }
    //function to deletedata in database
    public function delete($table, $where = null)
    {
        if ($this->tableExits($table)) {
            $sql = "DELETE FROM $table";
            if ($where != null) {
                $sql .= " WHERE $where";
            }
            if ($this->mysqli->query($sql)) {
                array_push($this->result, $this->mysqli->affected_rows);
                return true;
            } else {
                array_push($this->result, $this->mysqli->error);
            }
        } else {
            return false;
        }
    }
    //function for select in records in database
    public function select($table, $rows = "*", $join = null, $where = null, $order = null, $limit = null)
    {
        if ($this->tableExits($table)) {
            $sql = " SELECT $rows FROM $table ";
            if ($join != null) {
                $sql .= " JOIN $join";
            }
            if ($where != null) {
                $sql .= " WHERE $where";
            }
            if ($order != null) {
                $sql .= " ORDER BY $order";
            }
            if ($limit != null) {
                $sql .= " LIMIT 0,$limit";
            }
            //    echo $sql;
            $query = $this->mysqli->query($sql);
            if ($query) {
                $this->result = $query->fetch_all(MYSQLI_ASSOC);
                return true;
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }
        } else {
            return false;
        }
    }

    public function sql($sql)
    {

        $query = $this->mysqli->query($sql);
        if ($query) {
            $this->result = $query->fetch_all(MYSQLI_ASSOC);
            return true;
        } else {
            array_push($this->result, $this->mysqli->error);
            return false;
        }
    }



    // check Table Existence
    private function tableExits($table)
    {
        $sql = "Show Tables From $this->dbname LIKE '$table' ";
        $tableindb = $this->mysqli->query($sql);
        if ($tableindb) {
            if ($tableindb->num_rows == 1) {
                return  true;
            } else {
                array_push($this->result, $table . " does not exits in this database ");
                return false;
            }
        }
    }
    public function getresult()
    {
        $val = $this->result;
        $this->result = array();
        return $val;
    }

    public function __destruct()
    {
        if ($this->conn) {
            if ($this->mysqli->close()) {
                $this->conn = false;
                return true;
            }
        } else {
            return false;
        }
    }
}
