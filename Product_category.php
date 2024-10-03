<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product_category extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Product_category_manage');
		$this->load->library('session');
		if($this->session->has_userdata('AdminLogin') === FALSE){
			redirect('/Admin', 'location');
		}
	}
	public function index()
	{
		$this->form_list();
	}
	public function add_productcategory()
	{			
		//print_r($_POST); exit;
		$category_name =  $this->input->post('cat_name');
		$category_status =  $this->input->post('cat_status');
		//echo $department_name; exit;
		if(isset($category_name) && $category_name!='')
		{
			$formdata = $this->input->post(NULL, TRUE);
			$params = array(
				'category_name'=> $category_name,
				'category_status'=>$category_status,
			);
			$result = $this->Product_category_manage->add_productcategory_manage($params);
			if($result['success']==false)
			{
				$data['error_msg']	= $result['error'];
			}
			else
			{
				$data['success_msg'] = "New Product Category Added Successfully";
			}				
		}
		//$data['title'] = "Product Category Management - Vinay Electrical Admin Panel";
		$category_data= array( array(
		'category_name'=>'',
		'category_status'=>'',			
		));
		$data['product_category'] = json_decode(json_encode($category_data));
		//$data['submiturl'] = 'add_productcategory';
		$data['page_about'] = 'ATTENTION: Please follow all the rules specified for this section';
		$data['title'] = "Vinay Electricals Admin Panel :: Add New Product Category";
		$data['heading'] = "Add New Product Category";
		$this->load->view("common/head",$data);
		$this->load->view("product_category/add_productcategory",$data);
		$this->load->view("common/footer",$data);
	}
	public function form_list()
	{
		//$this->comfunction->checkuserloggedin();
		$data['title'] = "Vinay Electricals Admin Panel :: Manage Product Categories";
		if(isset($_GET['search_prodcat'])){
			$search_term = $_GET['search_prodcat'];
		}else{
			$search_term = '';
		}
		$params = array(
			'search_term' => $search_term,
		);
		$data['page'] =0;
		$form_data = $this->Product_category_manage->formfilelist($params);
		//print_r($form_data );exit;
		$data['cat_list'] = json_decode(json_encode($form_data['data']));
		$data['page_about']="ATTENTION: Please follow all the rules specified for this section";
		$this->load->view("common/head",$data);
		$this->load->view("product_category/product_catlist",$data);
		$this->load->view("common/footer",$data);
	}
	public function delete_productcategory()
	{					
		$product_category_id= $this->uri->segment(3,0);
		$params	= array(
			'product_category_id' => $product_category_id
		);
		// echo "<pre>";print_r($params);exit;
		$result = $this->Product_category_manage->delete_productcategory($params);
		// echo "<pre>";print_r($result);exit;
		$params = array(
			'product_category_id' => '',				
		);
		$result = $this->Product_category_manage->formfilelist($params);
		// echo "<pre>";print_r($result);exit;
		if($result['success'] == FALSE){
			$data['error'] = $result['error'];
		}
		else{
			$data['success_msg'] = "Product Category Deleted Successfully";
		}
		$data['cat_list']=json_decode(json_encode($result['data']), FALSE);
		// echo "<pre>";print_r($data['cat_list']);exit;
		$data['title'] = "Vinay Electricals Admin Panel :: Manage Product Categories";
		$data['page_about']="ATTENTION: Please follow all the rules specified for this section";
		$this->load->view("common/head",$data);
		$this->load->view("product_category/product_catlist",$data);
		$this->load->view("common/footer",$data);
		// redirect('feature_story');
	}	
	public function edit_productcategory()
	{
		//$this->comfunction->checkuserloggedin();
		$product_category_id = $this->uri->segment(3,0);
		$cat_name=  $this->input->post('cat_name');
		$cat_status=  $this->input->post('cat_status');
		if(isset($cat_name) && $cat_name!='')
		{
			$formdata = $this->input->post(NULL, TRUE);
			$params = array(
				'product_category_id'=> $product_category_id,
				'formdata'=>$formdata, 
				'cat_status'=>$cat_status,
			);
			$result = $this->Product_category_manage->edit_productcategory_manage($params);
			if($result['success']==false)
			{
				$data['error_msg']	= $result['error'];
			}
			else
			{
				$data['success_msg'] = "Product Category Updated Successfully";
			}
		}
		$data['title'] = "Vinay Electricals Admin Panel :: Manage Product Categories";
		$params= array('product_category_id'=>$product_category_id,'groupuser'=>'editform');
		$form_data = $this->Product_category_manage->formfilelist($params);
		$data['heading'] = "Edit Product Category";
		$data['product_category_details'] = json_decode(json_encode($form_data['data']));
		$data['submiturl'] = 'edit_productcategory/'.$product_category_id;
		$data['page_about'] = 'ATTENTION: Please follow all the rules specified for this section';
		$this->load->view("common/head",$data);
		$this->load->view("product_category/add_productcategory",$data);
		$this->load->view("common/footer",$data);
	}
	public function export_product_category_details(){
		if(isset($_GET['search_prodcat'])){
			$search_term = $_GET['search_prodcat'];
		}else{
			$search_term = '';
		}
		$params = array(
			'search_term' => $search_term,
		);
		$result = $this->Product_category_manage->formfilelist($params);
		
		//echo "<pre>";print_r($result);exit;
		
		// load the library
		$this->load->library('excel');
		// set active sheet
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Product Category worksheet');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Product Category ID');
		$this->excel->getActiveSheet()->setCellValue('B1', 'Category Name');
		$this->excel->getActiveSheet()->setCellValue('C1', 'Category Status');
		 $i=1;
		foreach($result['data'] as $rd)
		{
			$i++;				
			$this->excel->getActiveSheet()->setCellValue('A'.$i, $rd['product_category_id']);
			$this->excel->getActiveSheet()->setCellValue('B'.$i, $rd['category_name']);
			$this->excel->getActiveSheet()->setCellValue('C'.$i, $rd['category_status']);		

		} 
		//exit;
		$filename='Product Category Report'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					 
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	public function ajaxfunction()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}
		else{
			$product_category_id=$this->input->post('product_category_id');
			$count = count($product_category_id);
			for($i=0;$i<$count;$i++){
				$params	= array(
					'product_category_id' => $product_category_id[$i]
				);
				$result = $this->Product_category_manage->delete_productcategory($params);
			}
			echo json_encode($result);
			exit;
		}
	}
}