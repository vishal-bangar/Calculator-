<?php 

class Requisition_product_manage extends CI_Model {

	

	public function __construct()

	{

		//parent::__construct();

	}			

	

	public function add_product_manage($params=array())

	{

		try {			
			//print_r($params); exit;
			$sql = "INSERT INTO `ve_requisition_product`(`product_title`, `product_thumbnail`,`product_price_per_unit`,`requisition_category_id`,`product_status`) VALUES (:product_title,:product_thumbnail,:product_price_per_unit,:requisition_category_id, :product_status)";

			$stmt1 = $this->db->conn_id->prepare($sql);		

			$stmt1->bindParam("product_title", $params['product_title']);
			$stmt1->bindParam("product_thumbnail", $params['product_thumbnail']);
			$stmt1->bindParam("product_price_per_unit", $params['formdata']['product_price_per_unit']);
			$stmt1->bindParam("requisition_category_id", $params['requisition_category_id']);
			$stmt1->bindParam("product_status", $params['product_status']);
			
			if($stmt1->execute()){

					$result['success'] = true;

					$result['message'] = "Requisition product successfully Added";

					$result['error'] = '';

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

		

		return $result;

	}

	public function formfilelist($params=array()){

			

		if(isset($params['groupuser']) && $params['groupuser']=='editform'){

			$sql = "SELECT * FROM `ve_requisition_product` p WHERE 1 ";

		}

		else{

			$sql = "SELECT * FROM `ve_requisition_product` p LEFT JOIN ve_requisition_category c ON (c.requisition_category_id = p.requisition_category_id) WHERE 1 ";

		}

		try {

			$requisition_product_id=(isset($params['requisition_product_id'])) ? $params['requisition_product_id'] : '';

			

			if(isset($requisition_product_id) && $requisition_product_id!='')

			{

				$sql.=" AND p.`requisition_product_id`='".$requisition_product_id."'";

			}

			if(isset($params['search_term']) && $params['search_term'] != ''){
					$sql.=" AND (p.`product_title` LIKE '%".$params['search_term']."%' OR c.`requisition_category_name` LIKE '%".$params['search_term']."%')";
				}

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

			$sql .= " ORDER BY p.requisition_product_id DESC";

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

	

	public function edit_product_manage($params=array())

	{		

		//print_r($params); exit;

		try {

			$requisition_product_id = $params['requisition_product_id'];

			

			$sql = "UPDATE `ve_requisition_product` SET product_title = :product_title, product_thumbnail = :product_thumbnail, product_price_per_unit = :product_price_per_unit, requisition_category_id = :requisition_category_id, product_status = :product_status WHERE requisition_product_id = :requisition_product_id";

			$stmt2 = $this->db->conn_id->prepare($sql);					

			

			$stmt2->bindParam("product_title", $params['product_title']);
			
			$stmt2->bindParam("product_thumbnail", $params['product_thumbnail']);
			
			$stmt2->bindParam("product_price_per_unit", $params['formdata']['product_price_per_unit']);
			
			$stmt2->bindParam("requisition_category_id", $params['requisition_category_id']);

			$stmt2->bindParam("product_status", $params['product_status']);

			$stmt2->bindParam("requisition_product_id",$requisition_product_id);

				

				if($stmt2->execute()){

					$result['success'] = true;

					$result['message'] = "Requisition product successfully Updated";

					$result['error'] = '';

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

		

		return $result;

	}

	public function delete_req_product($params=array()){
	    try{
				$requisition_product_id = (isset($params['requisition_product_id']) && $params['requisition_product_id']!='') ? $params['requisition_product_id'] :'';
				if(isset($requisition_product_id) && $requisition_product_id!='')
				{
				    $this->db->where('requisition_product_id',$requisition_product_id);
					$this->db->delete('ve_requisition_product');					
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