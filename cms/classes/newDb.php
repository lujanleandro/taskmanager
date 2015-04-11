<?php

class System_Db {

    var $params;
    var $isconnected=false;
    var $db;
    var $error=false;
	var $debug=false;

/*
	function printr($valor){
		print "<pre>";
		print_r ($valor);
		print "</pre>";
	}
*/

    // Inicio la clase
    function System_Db ($params) {
        $paramsok=(isset($params['phptype']) &&
            isset($params['hostspec']) &&
            isset($params['protocol']) &&
            isset($params['database']) &&
            isset($params['username']) &&
            isset($params['password']));
		
        if (!($paramsok))
            $this->error=true;
        $this->params=$params;
    }

	// FUNC CONNECT
    function connect() {

        $this->db=&DB::connect($this->params);

        if (DB::isError($this->db)) {
            $this->isconnected=false;
        } else {
            $this->isconnected=true;
        }
        return $this->isconnected;
    }

	// FUNC CONNECT Mysqli
	function connectMysqli() {

		//Conecto
		$mysqli = new mysqli($this->params['hostspec'],$this->params['username'],$this->params['password'],$this->params['database']);

		//Chequeo error
		if ($mysqli->connect_error) {
			$this->debug = $mysqli->connect_error;
			$this->error = true;
            $this->isconnected = false;
        } else {
            $this->isconnected=true;
        }
		return $this->isconnected;
	}
    
	// FUNC DISCONNECT Mysqli
	function disconnectMysqli() {

		// Frees the memory associated with a result
		$results->free();

		// close connection 
		$this->isconnected = false;
		$mysqli->close();

		return true;
	}

    function checkConnection(){
        if (!($this->isconnected)){
            if (!($this->connect())){
                return false;
            }
        }
    }

    /*
    function buildselect($table, $fields=array(), $filters=array(), $orderby=false, $limit=false, $exclusive=true, $groupby=true) {
        $sql="SELECT ";
        if (is_array($fields) && count($fields)) {
            foreach ($fields as $field) {
                $sql.=$field.", ";
            }
            $sql=substr($sql,0,strlen($sql)-strlen(", "));
        } else {
            $sql.="* ";
        }
        $sql.=" FROM $table ";
        if (is_array($filters) && count($filters)) {
            $sql.=" WHERE ";

			foreach($filters as $filter) {
                $sql.=$filter." ";
                if ($exclusive)
                    $sql.="AND ";
                else
                    $sql.="OR ";
            }
            $sql=substr($sql,0,strlen($sql)-strlen(" and"));
        }
        if ($groupby) {
            $sql.=" GROUP BY $groupby";
        }
        if ($orderby) {
            $sql.=" ORDER BY $orderby";
        }
        if ($limit) {
            $sql.=" LIMIT $limit";
        }
        return $sql;
    }

    function buildupdate($table, $fields=array(), $filters=array(), $exclusive=true) {
        $sql="update $table set ";
        if (is_array($fields) && count($fields)) {
            foreach ($fields as $field=>$value) {
                $sql.=" $field=$value, ";
            }
            $sql=substr($sql,0,strlen($sql)-strlen(", "));
        } else {
            return false;
        }
        if (is_array($filters) && count($filters)) {
            $sql.=" where ";
            foreach($filters as $filter) {
                $sql.="$filter ";
                if ($exclusive)
                    $sql.="and ";
                else
                    $sql.="or ";
            }
            $sql=substr($sql,0,strlen($sql)-($exclusive?strlen(" and"):strlen(" or")));
        }
        return $sql;
    }

    function buildinsert($table, $fields=array()){
        $sql="insert into $table (";
        if (is_array($fields) && count($fields)){
            foreach ($fields as $field=>$value){
                $sql.=$field.", ";
            }
            $sql=substr($sql,0,strlen($sql)-strlen(", "));
            $sql.=") values (";
            foreach ($fields as $field=>$value)
            {
                if (!(is_numeric($value)))
                    $value=$this->db->quote($value);
                $sql.=$value.", ";
            }
            $sql=substr($sql,0,strlen($sql)-strlen(", "));
            $sql.=")";
        }else{
            $sql=false;
        }
        return $sql;
    }

    function builddelete($table, $filters=array()) {
        $sql="delete from $table ";
        if (is_array($filters) && count($filters)) {
            $sql.=" where ";
            foreach($filters as $filter) {
                $sql.="$filter and ";
            }
            $sql=substr($sql,0,strlen($sql)-strlen(" and"));
        } else {
            return false;
        }
        return $sql;
    }

    function updatedata($table, $fields=array(), $filters=array()) {
        $this->checkConnection();

        $sql = $this->buildupdate($table, $fields, $filters);

		if($this->debug)
			print $sql."<br><br>";
        $result=$this->db->query($sql);
        if (DB::isError($result)) {
            return false;
        }
        return true;
    }

    function insertdata($table, $fields=array(), $idname=false){
		$this->checkConnection();

        if ($idname){
            $id=$this->db->nextId($table);
            $fields[$idname]=$id;
        }else{
            $id=true;
        }
        $sql = $this->buildinsert($table, $fields);
		if ($this->debug) print "<pre>".$sql."</pre>";

		$result = $this->db->query($sql);

		if (DB::isError($result)){
			return false;
		}else
            return $id;
    }

    function quote($string) {
		$this->checkConnection();

		return $this->db->quote($string);
    }

    function exists ($table, $filters=array()) {
        $fields=array('count(*) as c');
        $result=$this->getdata($table, $fields, $filters);
        if ($result) {
            return $result[0]['c'];
        } else {
            return 0;
        }
    }

	function count ($table, $filters=array()) {
        $fields=array('count(*) as c');
        $result=$this->getdata($table, $fields, $filters);
        if ($result) {
            return $result[0]['c'];
        } else {
            return 0;
        }
    }

    function getdata($table, $fields=array(), $filters=array(), $orderby=false, $limit=false, $exclusive = true, $groupby = false) {
		$this->checkConnection();
        $sql=$this->buildselect($table, $fields, $filters, $orderby, $limit, $exclusive, $groupby);
		if ($this->debug) print "<pre>".$sql . "<br><br></pre>";
        $this->db->setFetchMode(DB_FETCHMODE_ASSOC);
        $result=$this->db->query($sql);
        if (DB::isError($result)) {
            return $result;
        } else {
            $return=array();
            while ($row=$result->fetchRow()) {
                array_push($return,$row);
            }
        }
        return ($return);
    }

    function getdata2($table, $fields=array(), $filters=array(), $orderby=false, $limit=false, $exclusive = true, $groupby = false) {

		if (!($this->checkconnection2())){
			echo "no tengo connexion, ej connect2<br/>";
			$con = $this->connect2();
		}else{
			echo "supuestamente tengo connexion<br/>";
		}

		echo "Conection:";
		echo "<pre>";
		print_r($con);
		echo "</pre>";
		
        $sql=$this->buildselect($table, $fields, $filters, $orderby, $limit, $exclusive, $groupby);
		if ($this->debug) print "<pre>".$sql . "<br></pre>";

		$result = mysqli_query($con,$sql);

		echo "<pre>";
		print_r($result);
		echo "</pre>";
        
		$return=array();
		while($row = mysqli_fetch_array($result)) {
			array_push($return,$row);
		}

		mysqli_close($con);		
 

        return ($return);

    }

    function string_getdata ($fields,$table,$filters = false,$orderby = false,$limit = false){
		$this->checkConnection();
		$sql = "SELECT $fields FROM $table";
		if($filters){$sql.=" WHERE $filters";}
		if($orderby){$sql.=" ORDER BY $orderby";}
		if($limit){$sql.=" LIMIT $limit";}
		if ($this->debug) print "<pre>$sql</pre>";
        $this->db->setFetchMode(DB_FETCHMODE_ASSOC);
        $result=$this->db->query($sql);
        if (DB::isError($result)) {
            return false;
        } else {
            $return=array();
            while ($row=$result->fetchRow()) {
                array_push($return,$row);
            }
        }
        return ($return);
    }

    function deletedata($table, $filters=array()) {
        if (!($this->isconnected)) {
            if (!($this->connect())) {
                return false;
            }
        }
        $sql=$this->builddelete($table, $filters);

        if($this->debug)
        	print $sql."<br><br>";

        $result=$this->db->query($sql);
        if (DB::isError($result))
            return false;
        else
            return true;
    }

    function generatedate($time=0) {
        return date('YmdHis',time()-$time);
    }

	function lastinsertedid(){
		$id  = mysql_insert_id($this->db->connection);

		return $id;

	}
    */
}