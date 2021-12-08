<?php

class database{

    // public $host = "localhost";
    // public $user = "root";
    // public $pass = "";
    // public $databaseName = "";
    




    private $mysqli = "";
    private $mysqlQuery = "";
    public $result = array();
    private $con = false;
    
    //function for connect with database 
    public function __construct($host,$user,$pass,$dbname)
    {
        if (!$this->con) {
            // $this->mysqli = new mysqli($this->host,$this->user,$this->pass,$this->databaseName);
            $this->mysqli = new mysqli($host,$user,$pass,$dbname);
             $this->con = true;
            if ($this->mysqli->connect_error) {
                $this->Error('');
             }
        }else{
            return true;
        }
    }

    //function for insert data into database
    public function Insert($table , $col = array()){
        if ($this->tableExists($table)) {
            
            $table_columns = implode(', ', array_keys($col));
            $table_value = implode("', '", $col);

            $sql = "INSERT INTO $table ($table_columns) VALUES ('$table_value')";
            $affect = $this->mysqli->query($sql);

            if ($affect) {
                $this->mysqlQuery = $sql;
                echo "Data inserted successfully";
                return true;

            }else {
                $this->Error($sql);
            }
        }
    }
    
    //function for update data into database
    public function Update($table , $col = array(),$where = Null){
        if ($this->tableExists($table)) {
            $Column = array();
            foreach ($col as $key => $value) {
                $Column[] = "$key = '$value'";
            }
            $sql = "UPDATE $table SET ". implode(', ',$Column);
            if ($where != Null) {
                $sql .= " WHERE $where";
            }
            $affect = $this->mysqli->query($sql);
            if ($affect) {
                $this->mysqlQuery = $sql;
                array_push($this->result, $this->mysqli->insert_id);
                return true;
            }else {
                
                $this->Error($sql);
                
            }
        }
    }

    //function for Delete data into database
    public function Delete($table ,$where = Null){
        if ($this->tableExists($table)) {
            $sql = "DELETE FROM $table";
            if ($where != Null) {
                $sql .= " WHERE $where";
            }
            $affect = $this->mysqli->query($sql);
            if ($affect) {
                $this->mysqlQuery = $sql;
                $success=  "Data Deleted successfully";
                array_push($this->result, $success);
                return true;
            }else {
                $this->Error($sql);
            }
        }
    }

    //function for Select data into database
    public function Select($table, $col = "*", $join = null, $where = null, $order = null,$limit = null){
        if ($this->tableExists($table)) {
            
            $sql = "SELECT $col FROM $table "; 

            if ($join != Null) {
                $sql .= " JOIN $join ";
            }

            if ($where != Null) {
                $sql .= " WHERE $where ";
            }

            if ($order != Null) {
                $sql .= " ORDER BY $order ";
            }

            if ($limit != Null) {
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                }
                else{
                    $page = 1;
                }
                $start = ($page-1)* $limit;
                $sql .= " LIMIT $start, $limit ";
            }

            $query = $this->mysqli->query($sql);

            if ($query) {
                $this->mysqlQuery = $sql;
                $this->result = $query->fetch_all(MYSQLI_ASSOC);
                return true;
            }else {
                $this->Error($sql);
            }
        }
    }

    public function query($sql){

        $query = $this->mysqli->query($sql);

            if ($query) {
                $this->mysqlQuery = $sql;
                $this->result = $query->fetch_all(MYSQLI_ASSOC);
                return true;
            }else {

                $this->Error($sql);
            }
    }
//Pagination function 

public function pagination($table, $join = null, $where = null,$limit = null){
    if ($this->tableExists($table)) {
        if ($limit != null) {
            $sql = "SELECT COUNT(*) FROM $table";
            if ($join != null) {
                $sql .= "JOIN $join";
            }
            if ($where != null) {
                $sql .= "WHERE $where";
            }
            $query = $this->mysqli->query($sql);
            
            $total_record = $query->fetch_array();
            $total_record = $total_record[0];

            $total_page = ceil($total_record / $limit);

            $url = basename($_SERVER['PHP_SELF']);

            
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                }
                else{
                    $page = 1;
                }

                $output = "<ul class='pagination'> ";

                if ($page>1) {
                    $output .= "<li><a href='$url?page=".($page-1)."'>Prev</a></li>";
                }

                if ($total_page > $limit) {
                    for ($i=1; $i < $total_page; $i++) { 
                        if ($i == $page) {
                            $cls = "class='active'";
                        }else{
                            $cls = "";
                        }
                        $output .= "<li><a href='$url?page=$i'>$i</a></li>";
                    }
                }

                if ($total_page>$page) {
                    $output .= "<li><a href='$url?page=".($page+1)."' >Next</a></li>";
                }

                $output .= "</ul>";

                echo $output;
        }
        else {
            return false;
        }
    }
    else {
        return false;
    }
}

//Error function for Crud operation
    private function Error($sql){
         
        echo $this->mysqlQuery = $sql;
        array_push($this->result, $this->mysqli->error);
        return false;
    }
    
//Show result function (output)
public function getResult()
{
    echo $this->mysqlQuery."\n\n";
    echo "<pre>";
    print_r($this->result);
    echo "<pre>";
    
}
//this function/method check either the table does exists or not.
    private function tableExists($table){
        $sql = "SHOW TABLES LIKE '$table';";
        $tableExtDb = $this->mysqli->query($sql);
        if ($tableExtDb) {
            if ($tableExtDb->num_rows == 1) {
                return true;
            }else {
                array_push($this->result, $table." deos not exit in this database");
                return false;
            }
        }
    }


    public function __destruct()
    {
        if ($this->con) {
             if ($this->mysqli->close()) {
                 $this->con = false;
                return true;
             }
        }else{
            return false;
        }
    }
}
?>