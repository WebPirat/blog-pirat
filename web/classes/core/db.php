<?php
namespace core;
#https://codeshack.io/super-fast-php-mysql-database-class/
class db
{
    protected $connection;
    protected $query;
    protected $database;
    protected $blacklist;
    protected $show_errors = TRUE;
    protected $query_closed = TRUE;
    public $query_count = 0;

    public function __construct() {
        $db = $this->getVar();
        $this->blacklist = ['ID','created_At','updated_At', 'deleted_At'];
        if(!empty($db)) {
            $this->connection = new \mysqli($db['host'], $db['user'], $db['pass'], $db['name']);
            if ($this->connection->connect_error) {
                $this->error('Failed to connect to MySQL - ' . $this->connection->connect_error);
            }
            $this->connection->set_charset($db['charset']);
            $this->database = $db['name'];
        }else{
            $this->error('No DB config!');
        }
    }
    private function getVar(){
        if (file_exists("./settings.ini")) {
                $vars = parse_ini_file("./settings.ini");
         }else{
            if(($_SERVER['SERVER_NAME'] === 'localhost')) {
                if (file_exists("./sample.ini")) {
                    $vars = parse_ini_file("./sample.ini");
                }
            }else{
                return false;
            }
        }

        $vars['charset'] = 'utf8';
        return $vars;

    }
    public function query($query) {
        echo '';
        if (!$this->query_closed) {
            $this->query->close();
        }
        if ($this->query = $this->connection->prepare($query)) {
            if (func_num_args() > 1) {
                $x = func_get_args();
                $args = array_slice($x, 1);
                $types = '';
                $args_ref = array();
                foreach ($args as $k => &$arg) {
                    if (is_array($args[$k])) {
                        foreach ($args[$k] as $j => &$a) {
                            $types .= $this->_gettype($args[$k][$j]);
                            $args_ref[] = &$a;
                        }
                    } else {
                        $types .= $this->_gettype($args[$k]);
                        $args_ref[] = &$arg;
                    }
                }
                array_unshift($args_ref, $types);
                call_user_func_array(array($this->query, 'bind_param'), $args_ref);
            }
            $this->query->execute();
            if ($this->query->errno) {
                $this->error('Unable to process MySQL query (check your params) - ' . $this->query->error);
            }
            $this->query_closed = FALSE;
            $this->query_count++;
        } else {
            $this->error('Unable to prepare MySQL statement (check your syntax) - ' . $this->connection->error);
        }
        return $this;
    }


    public function fetchAll($callback = null) {
        $params = array();
        $row = array();
        $this->query->store_result();
        $meta = $this->query->result_metadata();
        while ($field = $meta->fetch_field()) {
            $params[] = &$row[$field->name];
        }
        call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
        while ($this->query->fetch()) {
            $r = array();
            foreach ($row as $key => $val) {
                $r[$key] = $val;
            }
            if ($callback != null && is_callable($callback)) {
                $value = call_user_func($callback, $r);
                if ($value == 'break') break;
            } else {
                $result[] = $r;
            }
        }
        $this->query->close();
        $this->query_closed = TRUE;
        return $result;
    }

    public function fetchArray() {
        $params = array();
        $row = array();
        $this->query->store_result();
        $meta = $this->query->result_metadata();
        while ($field = $meta->fetch_field()) {
            $params[] = &$row[$field->name];
        }
        call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
        while ($this->query->fetch()) {
            foreach ($row as $key => $val) {
                $result[$key] = $val;
            }
        }
        $this->query->close();
        $this->query_closed = TRUE;
        return $result;
    }
    public function fetchString($column) {
        $params = array();
        $row = array();
        $this->query->store_result();
        $meta = $this->query->result_metadata();
        while ($field = $meta->fetch_field()) {
            $params[] = &$row[$field->name];
        }
        call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
        while ($this->query->fetch()) {
            foreach ($row as $key => $val) {
                if($key === $column) {
                    $result = $val;
                }
            }
        }
        $this->query->close();
        $this->query_closed = TRUE;
        return $result;
    }
    public function rawQuery($query){
        if (!$this->query_closed) {
            $this->query->close();
        }
        return $this->connection->query($query);
    }

    public function getSchema($table){
        $schema = $this->query("SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='".$this->database."' AND `TABLE_NAME`='".$table."'")->fetchAll();
        foreach ($schema as $column){
            if(!in_array($column['COLUMN_NAME'], $this->blacklist)) {
                $response[] = $column['COLUMN_NAME'];
            }
        }
        return $response;
    }



    public function close() {
        return $this->connection->close();
    }

    public function numRows() {
        $this->query->store_result();
        return $this->query->num_rows;
    }

    public function affectedRows() {
        return $this->query->affected_rows;
    }

    public function lastInsertID() {
        return $this->connection->insert_id;
    }

    public function error($error) {
        if ($this->show_errors) {
            exit($error);
        }
    }

    private function _gettype($var) {
        if (is_string($var)) return 's';
        if (is_float($var)) return 'd';
        if (is_int($var)) return 'i';
        return 'b';
    }

}