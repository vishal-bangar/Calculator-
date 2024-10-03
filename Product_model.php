<?php 
	class Product_model extends CI_Model {
		
		public function __construct()
		{
			//parent::__construct();
		}			
		public function getProducts(){
			$sql = "SELECT * FROM `ve_product_master` WHERE product_status = 1";
			$stmt = $this->db->conn_id->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
		public function getCategories(){
			$sql8 = "SELECT * FROM `ve_product_category` WHERE category_status = 1";			//echo $sql;exit;
			$stmt8 = $this->db->conn_id->prepare($sql8);
			$stmt8->execute();			$datalist = $stmt8->fetchAll(PDO::FETCH_OBJ);		//	print_r($datalist);exit;
			return $datalist;
		}
		public function getBrands(){
			$sql = "SELECT * FROM `ve_brands` WHERE ve_brand_status = 1";
			$stmt = $this->db->conn_id->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
		
		
		
	}	