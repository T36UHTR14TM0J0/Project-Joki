<?php

class ModelPosyandu extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    public function getData($tableName,$data,$where=""){
		$data = $this -> db ->query('SELECT '.$data.' FROM '.$tableName." ".$where);
		return $data -> result_array();
	}

	public function cekId($tableName,$where=""){
		$data = $this -> db ->query('SELECT * FROM '.$tableName." ".$where);
  		return $data->num_rows();
 
	}
	public function dataTerakhirpasien(){
		$data = $this->db->query("SELECT MAX(RIGHT(id_pasien,3)) AS id_pasien FROM pasien");
		return $data;
	}
	public function dataTerakhir($table,$where){
		$data = $this->db->query("SELECT MAX(RIGHT($where,3)) AS last FROM $table");
		return $data;
	}
    public function addData($tableName,$data){
		$res = $this ->db-> insert($tableName,$data);
		return $res;
	}
	public function HapusData($tableName, $where){
		$res = $this ->db-> delete($tableName,$where);
		return $res;
	}
	public function UpdateData($tableName,$data,$where){
		$res = $this ->db-> update($tableName,$data,$where);
		return $res;
	}
}

?>