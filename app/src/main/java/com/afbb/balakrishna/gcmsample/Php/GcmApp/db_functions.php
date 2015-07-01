<?php
require_once 'DBCnf.php';
class DB_Functions {
	
	/**
	 * Storing new user
	 * returns user details
	 */
	public function storeUser($name, $email,$regid) {
		$con = DBCnf::getConnection ();
		$sql = "insert into gcm_users set name=" . "'" . $name . "',email=" . "'" . $email . "',gcm_regid=" . "'" . $regid . "',created_at=NOW()";
		$result = mysqli_query ( $con, $sql );
		if ($result) {
			$id = mysqli_insert_id ( $con ); // last inserted id
			$result = mysqli_query ( $con, "SELECT * FROM gcm_users WHERE id = $id" ) or die ( mysql_error () );
			if (mysqli_num_rows ( $result ) > 0) {
				return mysqli_fetch_array ( $result );
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	/**
	 * Getting all users
	 */
	public function getAllUsers() {
		$result = mysqli_query ( "select * FROM gcm_users" );
		return $result;
	}
}

?>