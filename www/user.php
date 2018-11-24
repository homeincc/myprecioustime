<?php

include("userscore.php");

class User {

	public $id, $name, $password;
	
	
	function GetLastId($db) {
		$sql = "SELECT LAST_INSERT_ID()";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($id);
		$stmt->fetch();
		return $id;
	}
	
	function Create($name,$password) {
		$this->name = $name;
		$this->password = $password;
	}
	
	function Persist($db) {
		if ($this->id == null) { //new object
			$query = "INSERT INTO `user`
			(`name`, `password`) VALUES (?, ?)";
			$stmt = $db->prepare($query);
			$stmt->bind_param("ss",$this->name, $this->password);
			$stmt->execute();
			$this->id = $this->GetLastId($db);
		} else {
			$query = "UPDATE `user` SET `name`=?, `password`=? WHERE `id`=?";
			$stmt = $db->prepare($query);
			$stmt->bind_param("ssi",$this->name, $this->password, $this->id);
			$stmt->execute();
		}
	}
	
	function Load($db,$id) {
		$this->id = $id;
		$query = "SELECT `name`, `password` FROM `user` WHERE `id`=?";
		$stmt = $db->prepare($query);
		$stmt->bind_param("i",$this->id);
		$stmt->execute();
		$stmt->bind_result($this->name, $this->password);
		$stmt->fetch();
	}

}

?>