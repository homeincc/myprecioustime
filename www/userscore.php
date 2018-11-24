<?php


class UserScore {

	public $id, $males, $females, $age_young, $age_mid, $age_old, $body_slim, $body_mid, $body_fat, $soft, $hard, $profi, $amateur, $white, $black, $asian, $couple, $threesome, $group;
	
	
	function Create($males, $females, $age_young, $age_mid, $age_old, $body_slim, $body_mid, $body_fat, $soft, $hard, $profi, $amateur, $white, $black, $asian, $couple, $threesome, $group)
	{
		$this->males = $males;
		$this->females = $females;
		$this->age_young = $age_young;
		$this->age_mid = $age_mid;
		$this->age_old = $age_old;
		$this->body_slim = $body_slim;
		$this->body_mid = $body_mid;
		$this->body_fat = $body_fat;
		$this->soft = $soft;
		$this->hard = $hard;
		$this->profi = $profi;
		$this->amateur = $amateur;
		$this->white = $white;
		$this->black = $black;
		$this->asian = $asian;
		$this->couple = $couple;
		$this->threesome = $threesome;
		$this->group = $group;
	}
	
	function Persist($db) {
		$query = "UPDATE `user` SET
			`males`=?,
			`females`=?,
			`age_young`=?,
			`age_mid`=?,
			`age_old`=?,
			`body_slim`=?,
			`body_mid`=?,
			`body_fat`=?,
			`soft`=?,
			`hard`=?,
			`profi`=?,
			`amateur`=?,
			`white`=?,
			`black`=?,
			`asian`=?,
			`couple`=?,
			`threesome`=?,
			`group`=?
			WHERE `id`=?";
		$stmt = $db->prepare($query);
		$stmt->bind_param("iiiiiiiiiiiiiiiiiii",
			$this->males,
			$this->females,
			$this->age_young,
			$this->age_mid,
			$this->age_old,
			$this->body_slim,
			$this->body_mid,
			$this->body_fat,
			$this->soft,
			$this->hard,
			$this->profi,
			$this->amateur,
			$this->white,
			$this->black,
			$this->asian,
			$this->couple,
			$this->threesome,
			$this->group,
			$this->id);
		$stmt->execute();
	}

}

?>