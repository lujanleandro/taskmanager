<?php

class User{
    var $db;
    var $dbTable;
    var $dbAdminsTable = 'fit_admin';
    var $id;
    var $username;
    var $password;
	var $data=array();
	var $encryptKey = "frooit";


    function User ($db=false, $username=false, $password=false){
        $this->id=false;
        $this->db=$db;
        if ($username && $password) {
            $this->getbyname($username, $password);
        }
    }

    function setdb($db){
        $this->db=$db;
    }

	function getuservalue ($value){
		return $this->$value;
	}

    function getbyname($username, $password, $cleartext=true){
        if (!($this->db))
            return false;
        $fields = array('username','password','id','uniq_id');

        if (!$cleartext) {
            $password=$this->encrypt($password);
		}
        $filters=array('username='.$this->db->quote($username),'password='.$this->db->quote($password));
        if ($result=$this->db->getdata($this->dbAdminsTable, $fields, $filters)) {
            $this->id=$result[0]['id'];
            $this->username=$result[0]['username'];
            $this->password=$result[0]['password'];
			$this->uniq_id=$result[0]['uniq_id'];
            $this->valid=1;
        } else {
            $this->valid=false;
        }
    }

    function getadmin ($username, $password, $cleartext=true){
        if (!($this->db))
            return false;

		$adminTable = $this->dbAdminsTable;
        $fields = array('username','password','id','uniq_id');

        if (!$cleartext){
            $password=$this->encrypt($password);
		}

		//$this->db->debug = true;
		
		//$usernameq = $this->db->quote($username);
		//$passwordq = $this->db->quote($password);
		$filters = array('username='.$username,'password='.$password);
			
        if ($result=$this->db->getdata($adminTable, $fields, $filters)) {
            $this->id=$result[0]['id'];
            $this->username=$result[0]['username'];
            $this->password=$result[0]['password'];
			$this->uniq_id=$result[0]['uniq_id'];
            $this->valid=1;
        }else{
            $this->valid=false;
        }
    }

    function getuser ($username, $password, $cleartext=true){
        if (!($this->db)){
            return false;
		}

        $fields = array('usuario','clave','usuarioId');
        $table = 'usuarios';
        if (!$cleartext){
            $password=$this->encrypt($password);
		}
        $filters=array('email='.$this->db->quote($username),'clave='.$this->db->quote($password));
        if ($result=$this->db->getdata($table,$fields,$filters)) {
            $this->id=$result[0]['usuarioId'];
            $this->username=$result[0]['usuario'];
            $this->password=$result[0]['clave'];
            $this->valid=1;
        }else{
            $this->valid=false;
        }
    }


	function getbyid($id,$cleartext){
        if (!($this->db))
            return false;
        $table='users';
        $fields=array('*');
        if ($cleartext)
            $password=$this->encrypt($password);
        $filters=array('id='.$id);
        if ($result=$this->db->getdata($table,$fields,$filters)) {
            $this->id=$result[0]['id'];
            $this->username				= $result[0]['username'];
            $this->password				= $result[0]['password'];
			$this->data['name']			= $result[0]['name'];
			$this->data['lastname']		= $result[0]['lastname'];
            $this->data['email']		= $result[0]['email'];
            $this->data['birthday']		= $result[0]['birthday'];
			$this->data['gender']		= $result[0]['gender'];
			$this->data['country']		= $result[0]['country'];
			$this->data['city']			= $result[0]['city'];
			$this->data['address']		= $result[0]['address'];
			$this->data['zipcode']		= $result[0]['zipcode'];
			$this->data['phone']		= $result[0]['phone'];
			$this->data['ocupation']	= $result[0]['ocupation'];
			$this->data['likesee']		= $result[0]['likesee'];
			$this->data['news']			= $result[0]['news'];
			$this->data['offers']		= $result[0]['offers'];
            $this->valid=true;
        } else {
            $this->valid=false;
        }
    }

    function reload() {
        $this->getbyid($this->id);
    }

    function encrypt($password) {
        return crypt($password,$this->encryptKey.$password.$this->encryptKey);
    }


    function getlastmodification() {
        if ((!($this->id)) || (!($this->db))) {
            return false;
        }
        $table='users';
        $fields=array('lastmodification');
        $filters=array('id='.$this->id);
        if ($result=$this->db->getdata($table,$fields,$filters)) {
            $this->data['lastmodification']=$result[0]['lastmodification'];
            return true;
        } else {
            return false;
        }
    }

    function updatemodificationdate() {
        $table='users';
        $fields=array('lastmodification'=>$this->db->quote($this->db->generatedate()));
        $filters=array('id='.$this->id);
        $this->db->updatedata($table,$fields,$filters);
    }

	function updatepassword($passwords){
		$table = 'usuarios';
		if ($passwords["newpassword"] == $passwords["renewpassword"])
		{
			$fields=array('password' => encrypt($passwords['newpassword']));
        	$filters=array('id='.$this->id);
	        $this->db->updatedata($table,$fields,$filters);
		}
	}

    function getservices(){
        if ((!($this->id)) || (!($this->db))) {
            return false;
        }
        $this->getgroups();
        if ($result=$this->db->getservices_per_user($this->id,getids($this->groups))) {
            $this->sites=array();
            foreach($result as $value)
                array_push($this->sites, array('id'=>$value['id'],'name'=>$value['name']));
            return $this->sites;
        } else {
            return false;
        }
    }

	function getgroups(){
        if ((!($this->id)) || (!($this->db))) {
            return false;
        }
        $table='usersbygroup';
        $fields=array('group_id');
        $filters=array('user_id='.$this->id);
        if ($result=$this->db->getdata($table,$fields,$filters)) {
            $this->groups=array();
            foreach($result as $value)
                array_push($this->groups, array('id'=>$value['group_id'],'name'=>$value['name']));
            return $this->groups;
        } else {
            return false;
        }
    }

	function saveUser($user){
		if(!$user || !$user['usuario'] ) {
			return false;
		}

		$table = 'usuarios';
		$this->db->insertdata($table,$user);
	}
}
