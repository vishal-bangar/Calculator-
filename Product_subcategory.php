<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product_subcategory extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Product_subcategory_manage');
		$this->load->library('session');
		if($this->session->has_userdata('AdminLogin') === FALSE){
			redirect('/Admin', 'location');
		}
	}
	public function index()
	{		
		$this->form_list();
	}
	public function add_productsubcategory()
	{			
		//print_r($_POST); exit;
		$sub_category_name =  $this->input->post('subcat_name');
		$product_category_id =  $this->input->post('cat_id');
		$sub_category_status =  $this->input->post('subcategory_status');
		if(isset($sub_category_name) && $sub_category_name!='' && isset($product_category_id) && $product_category_id!='')
		{
			$formdata = $this->input->post(NULL, TRUE);
			$params = array(
				'sub_category_name'=> $sub_category_name,
				'product_category_id'=> $product_category_id,
				'sub_category_status'=>$sub_category_status
			);
			$result = $this->Product_subcategory_manage->add_subcategory_manage($params);
			if($result['success']==false)
			{
				$data['error_msg']	= $result['error'];
			}
			else
			{
				$data['success_msg'] = "New Product Type Added Successfully";
			}				
		}
		//$data['title'] = "Company Location Management - Vinay Electrical Admin Panel";
		$subcat_data= array( array(
		'sub_category_name'=>'',
		'product_category_id'=>'',
		'sub_category_status'=>'',			
		));
		$data['product_subcategory'] = json_decode(json_encode($subcat_data));
		$data['page_about'] = 'ATTENTION: Please follow all the rules specified for this section';
		$data['title'] = "Vinay Electricals Admin Panel:: Add New Product Subcategory";
		$data['heading'] = "Add New Product Type";
		$this->load->view("common/head",$data);
		$this->load->view("product_category/add_productsubcategory",$data);
		$this->load->view("common/footer",$data);
	}
	public function form_list()
	{
		//$this->comfunction->checkuserloggedin();
		$data['title'] = "Vinay Electricals Admin Panel :: Manage Product Type";
		$data['page'] =0;
		if(isset($_GET['search_type'])){
			$search_term = $_GET['search_type'];
		}else{
			$search_term = '';
		}
		$params = array(
			'search_term' => $search_term,
		);
		$form_data = $this->Product_subcategory_manage->formfilelist($params);
		//print_r($form_data );exit;
		$data['subcat_list'] = json_decode(json_encode($form_data['data']));
		$data['page_about']="ATTENTION: Please follow all the rules specified for this section";
		$this->load->view("common/head",$data);
		$this->load->view("product_category/product_subcatlist",$data);
		$this->load->view("common/footer",$data);
	}
	public function delete_productsubcategory()
	{					
		$product_sub_category_id= $this->uri->segment(3,0);
		$params	= array(
			'product_sub_category_id' => $product_sub_category_id
		);
		// echo "<pre>";print_r($params);exit;
		$result = $this->Product_subcategory_manage->delete_productsubcategory($params);
		// echo "<pre>";print_r($result);exit;
		$params = array(
			'product_sub_category_id' => '',				
		);
		$result = $this->Product_subcategory_manage->formfilelist($params);
		// echo "<pre>";print_r($result);exit;
		if($result['success'] == FALSE){
			$data['error'] = $result['error'];
		}
		else{
			$data['success_msg'] = "Product Type Deleted Successfully";
		}
		$data['subcat_list']=json_decode(json_encode($result['data']), FALSE);
		// echo "<pre>";print_r($data['subcat_list']);exit;
		$data['title'] = "Vinay Electricals Admin Panel :: Manage Product Type";
		$data['page_about']="ATTENTION: Please follow all the rules specified for this section";
		$this->load->view("common/head",$data);
		$this->load->view("product_category/product_subcatlist",$data);
		$this->load->view("common/footer",$data);
		// redirect('feature_story');
	}		
	public function edit_productsubcategory()
	{
		//$this->comfunction->checkuserloggedin();
		$product_sub_category_id = $this->uri->segment(3,0);
		$subcat_name =  $this->input->post('subcat_name');
		$subcategory_status =  $this->input->post('subcategory_status');
		if(isset($subcat_name) && $subcat_name!='')
		{
			$formdata = $this->input->post(NULL, TRUE);
			$params = array(
				'product_sub_category_id'=> $product_sub_category_id,
				'formdata'=>$formdata, 
				'subcategory_status'=>$subcategory_status,
			);
			$result = $this->Product_subcategory_manage->edit_productsubcategory_manage($params);
			if($result['success']==false)
			{
				$data['error_msg']	= $result['error'];
			}
			else
			{
				$data['success_msg'] = "Product Type Updated Successfully";
			}
		}
		$data['title'] = "Vinay Electricals Admin Panel :: Manage Product Type";
		$params= array('product_sub_category_id'=>$product_sub_category_id,'groupuser'=>'editform');
		$form_data = $this->Product_subcategory_manage->formfilelist($params);
		//print_r($form_data );exit;
		$data['product_subcategory_details'] = json_decode(json_encode($form_data['data']));
		$data['heading'] = "Edit Product Type";

		$data['submiturl'] = 'edit_productsubcategory/'.$product_sub_category_id;
		$data['page_about'] = 'ATTENTION: Please follow all the rules specified for this section';
		$this->load->view("common/head",$data);
		$this->load->view("product_category/add_productsubcategory",$data);
		$this->load->view("common/footer",$data);
	}
	public function export_product_sub_category_details(){
		if(isset($_GET['search_type'])){
			$search_term = $_GET['search_type'];
		}else{
			$search_term = '';
		}
		$params = array(
			'search_term' => $search_term,
		);
		$result = $this->Product_subcategory_manage->formfilelist($params);
		
		//echo "<pre>";print_r($result);exit;
		
		// load the library
		$this->load->library('excel');
		// set active sheet
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Product Type worksheet');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Product Type ID');
		$this->excel->getActiveSheet()->setCellValue('B1', 'Product Type Name');
		$this->excel->getActiveSheet()->setCellValue('C1', 'Product Type Category');
		$this->excel->getActiveSheet()->setCellValue('D1', 'Product Type Status');
		 $i=1;
		foreach($result['data'] as $rd)
		{
			$i++;				
			$this->excel->getActiveSheet()->setCellValue('A'.$i, $rd['product_sub_category_id']);
			$this->excel->getActiveSheet()->setCellValue('B'.$i, $rd['sub_category_name']);
			$this->excel->getActiveSheet()->setCellValue('C'.$i, $rd['category_name']);		
			$this->excel->getActiveSheet()->setCellValue('D'.$i, $rd['sub_category_status']);		

		} 
		//exit;
		$filename='Product Type Report'.time().'.xls'; //save our workbook as this file name
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
			$product_sub_category_id=$this->input->post('product_sub_category_id');
			$count = count($product_sub_category_id);
			for($i=0;$i<$count;$i++){
				$params	= array(
					'product_sub_category_id' => $product_sub_category_id[$i]
				);
				$result = $this->Product_subcategory_manage->delete_productsubcategory($params);
			}
			echo json_encode($result);
			exit;
		}
	}
}