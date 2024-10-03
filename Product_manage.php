<?php 
	class Product_manage extends CI_Model {
		
		public function __construct()
		{
			//parent::__construct();
		}			
		
		public function add_product_manage($params=array())
		{
			try {
				//print_r($params); exit;
				$sql = "INSERT INTO `ve_product_master`(`product_category_id`,`product_sub_category_id`,product_status) VALUES (:product_category_id,:product_sub_category_id,:product_status)";
				//echo $sql;
				$stmt1 = $this->db->conn_id->prepare($sql);		
				
			    //$stmt1->bindParam("product_name", $params['product_name']);
				$stmt1->bindParam("product_category_id", $params['product_category_id']);
				$stmt1->bindParam("product_sub_category_id", $params['product_sub_category_id']);
				//$stmt1->bindParam("brand_id", $params['brand_id']);
				//$stmt1->bindParam("product_quantity", '1');
				$stmt1->bindParam("product_status", $params['product_status']);
                  //$stmt1->debugDumpParams();
				if($stmt1->execute()){
					$lastId = $this->db->insert_id();
					$sql2="INSERT INTO `ve_product_download_relation`(`product_id`, `download_path`, `download_type`) VALUES (:product_id,:download_path,:download_type)";
					$stmt = $this->db->conn_id->prepare($sql2);	
					$stmt->bindParam("product_id",$lastId);
					$stmt->bindParam("download_path",$params['download_path']);
					$stmt->bindParam("download_type",$params['download_type']);
					if($stmt->execute()){
						$result['success'] = TRUE;
						$result['message'] = "Product successfully Added";
						$result['error'] = '';
					} else{
						$result['success'] = FALSE;
						$result['message'] = "Sorry please try again";
						$result['error'] = $e->getMessage();
					}
				}else {				
						$result['success'] = FALSE;
						$result['message'] = "Sorry please try again";
				}
			}
			catch(Exception $e)
			{
				$result['success'] = false;
				$result['error'] = $e->getMessage();
			}
			
			return $result;
		}
		
		public function edit_product_manage($params=array())
		{		
		//print_r($params);exit;
			try {
			
				$product_id = $params['product_id'];
				
				$sql = "UPDATE `ve_product_master` SET  product_category_id = :product_category_id, product_sub_category_id = :product_sub_category_id, product_status = :product_status  WHERE product_id = :product_id";
				$stmt2 = $this->db->conn_id->prepare($sql);					
				
				//$stmt2->bindParam("product_name", $params['formdata']['product_name']);
				$stmt2->bindParam("product_category_id", $params['formdata']['cat_id']);
				$stmt2->bindParam("product_sub_category_id", $params['formdata']['subcat_id']);
				//$stmt2->bindParam("brand_id", $params['formdata']['brand_id']);
				$stmt2->bindParam("product_id",$product_id);
				$stmt2->bindParam("product_status",$params['product_status']);
					//$stmt2->debugDumpParams();
				//	exit;
				if($stmt2->execute()){
						$sql2="UPDATE `ve_product_download_relation` SET download_path = :download_path, download_type = :download_type WHERE product_id = :product_id";
						$stmt = $this->db->conn_id->prepare($sql2);	
						$stmt->bindParam("product_id",$product_id);
						$stmt->bindParam("download_path",$params['download_path']);
						$stmt->bindParam("download_type",$params['download_type']);
						if($stmt->execute()){
							$result['success'] = TRUE;
							$result['message'] = "Product successfully Updated";
							$result['error'] = '';
						} else{
							$result['success'] = FALSE;
							$result['message'] = "Sorry please try again";
							$result['error'] = $e->getMessage();
						}
						
					}else {
						$result['success'] = false;
						$result['message'] = "Sorry please try again";
					}
			}
			catch(Exception $e)
			{
				$result['success'] = false;
				$result['error'] = $e->getMessage();
			}
			//print_r($result); exit;
			return $result;
		}
		
		public function formfilelist($params=array()){
		
         if(isset($params['groupuser']) && $params['groupuser']=='editform'){
			$sql = "SELECT * FROM `ve_product_master` LEFT JOIN `ve_product_download_relation` ON ve_product_master.product_id = ve_product_download_relation.product_id WHERE 1";
		}
		else{
			$sql = "SELECT * FROM `ve_product_master` pr LEFT JOIN ve_product_category p ON (p.product_category_id = pr.product_category_id) LEFT JOIN ve_product_sub_category t ON (t.product_sub_category_id = pr.product_sub_category_id) LEFT JOIN ve_brands b ON (b.ve_brand_id = pr.brand_id) WHERE 1 ";
						
		}
		try {
			$product_id=(isset($params['product_id'])) ? $params['product_id'] : '';
			
			if(isset($product_id) && $product_id!='')
			{
				$sql.=" AND ve_product_master.`product_id`='".$product_id."'";
			}
			if(isset($params['search_term']) && $params['search_term'] != ''){
				$sql.=" AND (pr.`product_name` LIKE '%".$params['search_term']."%' OR t.`sub_category_name` LIKE '%".$params['search_term']."%' OR p.`category_name` LIKE '%".$params['search_term']."%' OR b.`ve_brand_name` LIKE '%".$params['search_term']."%')";
			}
			//echo $sql; 
		
			$offset=(isset($params['offset'])) ? $params['offset'] : '';
			$limit=(isset($params['limit'])) ? $params['limit'] : '';
			if(isset($offset) && $offset != '')
			{
				$sql.=" limit $offset ";
			}
			
			if(isset($limit) && $limit != '')
			{
				$sql.=" , $limit";
			}
			//$sql .=" ORDER BY `ve_product_master.product_id` DESC";
			//echo $sql;
				//exit;
			$query = $this->db->query($sql);
			//print_r($query );exit;
			
			
			$total_count=(isset($params['total_count'])) ? $params['total_count'] : '';
			if(isset($total_count) && $total_count=='yes')
			{
				$datalist = $query->num_rows();
			}
			else{
				$datalist = $query->result_array();
			}
			
			$result['success'] = true;
			$result['data'] =  $datalist;
			$result['error'] = '';
		}
		catch(Exception $e)
		{
			$result['success'] = false;
			$result['error'] = $e->getMessage();
		}
		
		return $result;
	}
	
	public function productlist($params=array()){
		
		$sql = "SELECT * FROM `ve_product_master` INNER JOIN `ve_product_download_relation` ON ve_product_master.product_id = ve_product_download_relation.product_id WHERE 1";
		
		try {
			//$product_id=(isset($params['product_id'])) ? $params['product_id'] : '';
			
			/* if(isset($product_id) && $product_id!='')
			{
				$sql.=" AND ve_product_master.`product_id`='".$product_id."'";
			} */
			//echo $sql; exit;
			$offset=(isset($params['offset'])) ? $params['offset'] : '';
			$limit=(isset($params['limit'])) ? $params['limit'] : '';
			if(isset($offset) && $offset != '')
			{
				$sql.=" limit $offset ";
			}
			
			if(isset($limit) && $limit != '')
			{
				$sql.=" , $limit";
			}
			
			//echo $sql;	
			$query = $this->db->query($sql);
			//print_r($query );exit;
			
			
			$total_count=(isset($params['total_count'])) ? $params['total_count'] : '';
			if(isset($total_count) && $total_count=='yes')
			{
				$datalist = $query->num_rows();
			}
			else{
				$datalist = $query->result_array();
			}
			
			$result['success'] = true;
			$result['data'] =  $datalist;
			$result['error'] = '';
		}
		catch(Exception $e)
		{
			$result['success'] = false;
			$result['error'] = $e->getMessage();
		}
		
		return $result;
	}
	public function delete_product($params=array()){
			
			try{
				$product_id = (isset($params['product_id']) && $params['product_id']!='') ? $params['product_id'] :'';
				if(isset($product_id) && $product_id!='')
				{
				
					$this->db->where('product_id',$product_id);
					$this->db->delete('ve_product_master');
					$this->db->where('product_id',$product_id);
					$this->db->delete('ve_product_download_relation');
				}
				
				$result['success'] = true;
				$result['error'] = '';
			}
			catch(Exception $e){
				$result['success'] = false;
				$result['error'] = $e->getMessage();
			}
			return $result;
		}
		
}	