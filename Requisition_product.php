<?php



defined('BASEPATH') OR exit('No direct script access allowed');







class Requisition_product extends CI_Controller {



	



	public function __construct() {



		parent::__construct();



		$this->load->model('Requisition_product_manage');



		$this->load->library('session');



		if($this->session->has_userdata('AdminLogin') === FALSE){



			redirect('/Admin', 'location');



		}



	}



	



	public function index()

	{

		$this->form_list();

	}



	



	public function add_req_product()



	{			



		$product_title =  $this->input->post('product_title');		



		$product_status =  $this->input->post('product_status');	

		

		$requisition_category_id =  $this->input->post('requisition_category_id');	



		if(isset($product_title) && $product_title!='')

		{

			$formdata = $this->input->post(NULL, TRUE);

			//echo $_FILES['product_thumbnail']['name']; exit;

			$imgFile = $_FILES['product_thumbnail']['name'];

			$tmp_dir = $_FILES['product_thumbnail']['tmp_name'];

			$imgSize = $_FILES['product_thumbnail']['size'];

			if($imgFile)

			  {

			   $upload_dir = 'assets/media/datafiles/product/'; // upload directory 

			   $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension

			   $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

			   $file_name = rand(1000,1000000).".".$imgExt;					  

				

			   if(in_array($imgExt, $valid_extensions))

			   {   

				if($imgSize < 100000)

					{	

						//echo $file_name; exit;

						move_uploaded_file($tmp_dir,$upload_dir.$file_name);

					}

					else

					{

					 $data['error_msg'] = "Sorry, your file is too large it should be less then 100KB";

					}

			   }

			   else

			   {

				$data['error_msg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  

			   } 

			  }

			  else

			  {

			   // if no image selected the old image remain as it is.

			   $file_name = $form_data['file_name']; // old image from database

			  } 

				

			$params = array(



				'product_title'=> $product_title,



				'product_status'=>$product_status,				



				'requisition_category_id'=> $requisition_category_id,

				

				'product_thumbnail' => $file_name,

				

				'formdata'=>$formdata,



			);



			$result = $this->Requisition_product_manage->add_product_manage($params);



			//print_r($result); exit;



			if($result['success']==false)



			{



				$data['error_msg']	= $result['error'];



			}



			else



			{



				$data['success_msg'] = "New Requisition Material Added Successfully";



			}				



		}



		



		$product_data= array( array(



		'product_title'=>'',



		'product_status'=>'',	

		

		'requisition_category_id'=>'',			



		));



		



		$data['product'] = json_decode(json_encode($product_data));

		

		//print_r($data); exit;

		$data['page_about'] = 'ATTENTION: Please follow all the rules specified for this section';			



		$data['title'] = "Vinay Electricals Admin Panel :: Add Requisition Material";



		$data['heading'] = "Add New Requisition Material";



		$this->load->view("common/head",$data);



		$this->load->view("requisition_product/add_requisition_product",$data);



		$this->load->view("common/footer",$data);



	}



	



	public function form_list()



	{



		//$this->comfunction->checkuserloggedin();



		$data['title'] = "Vinay Electricals Admin Panel:: Manage Requisition Material";		



		$data['page'] =0;



		if(isset($_GET['search_rproduct'])){

			$search_term = $_GET['search_rproduct'];

		}else{

			$search_term = '';

		}

		$params = array(

			'search_term' => $search_term,

		);



		$form_data = $this->Requisition_product_manage->formfilelist($params);



		//print_r($form_data );exit;



		$data['product_list'] = json_decode(json_encode($form_data['data']));



		$data['page_about']="ATTENTION: Please follow all the rules specified for this section";

		

		$this->load->view("common/head",$data);



		$this->load->view("requisition_product/requisition_product_list",$data);



		$this->load->view("common/footer",$data);



	}



	



	public function edit_req_product()



	{



		//$this->comfunction->checkuserloggedin();



		$requisition_product_id = $this->uri->segment(3,0);



		$product_title=  $this->input->post('product_title');



		$product_status=  $this->input->post('product_status');

		

		$requisition_category_id=  $this->input->post('requisition_category_id');



		



		if(isset($product_title) && $product_title!='')



		{



			$formdata = $this->input->post(NULL, TRUE);



			$imgFile = $_FILES['product_thumbnail']['name'];

			$tmp_dir = $_FILES['product_thumbnail']['tmp_name'];

			$imgSize = $_FILES['product_thumbnail']['size'];

			if($imgFile)

			{

			   $upload_dir = 'assets/media/datafiles/product/'; // upload directory 

			   $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension

			   $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions

			   $file_name = rand(1000,1000000).".".$imgExt;					  

				

			   if(in_array($imgExt, $valid_extensions))

			   {   

				if($imgSize < 100000)

					{

						//echo $file_name; exit;

						$form_data = $this->Requisition_product_manage->formfilelist(); 

						if(isset($form_data['data'][0]['product_thumbnail']) && $form_data['data'][0]['product_thumbnail']!=''){

							move_uploaded_file($tmp_dir,$upload_dir.$file_name);

						}else{

							unlink($upload_dir.$form_data['data'][0]['product_thumbnail']);		

							move_uploaded_file($tmp_dir,$upload_dir.$file_name);

						}

					}

					else

					{

					 $data['error_msg'] = "Sorry, your file is too large it should be less then 100kb";

					}

			   }

			   else

			   {

				$data['error_msg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  

			   } 

			  }

			  else

			  {

			   // if no image selected the old image remain as it is.

			   $file_name = $_POST['added_files']; // old image from database

			  } 					



			 $params = array(



				'requisition_product_id'=> $requisition_product_id,



				'product_title'=> $product_title,

				

				'requisition_category_id'=> $requisition_category_id,

				

				'product_thumbnail'=> $file_name,

				

				'formdata' => $formdata,



				'product_status'=>$product_status,



			);



			



			$result = $this->Requisition_product_manage->edit_product_manage($params);



			



			if($result['success']==false)



			{



				$data['error_msg']	= $result['error'];



			}



			else



			{



				$data['success_msg'] = "Requisition material Updated Successfully";



			}



			



		}



		



		$data['title'] = "Vinay Electricals Admin Panel :: Manage Requisition Material";



		



		$params= array('requisition_product_id'=>$requisition_product_id,'groupuser'=>'editform');



		$form_data = $this->Requisition_product_manage->formfilelist($params);



		$data['heading'] = "Edit Requisition Material";



		$data['product_details'] = json_decode(json_encode($form_data['data']));



		$data['submiturl'] = 'edit_req_product/'.$requisition_product_id;



		$data['page_about'] = 'ATTENTION: Please follow all the rules specified for this section';



		$this->load->view("common/head",$data);



		$this->load->view("requisition_product/add_requisition_product",$data);



		$this->load->view("common/footer",$data);



	}
	
	public function delete_req_product(){
	    $requisition_product_id= $this->uri->segment(3,0);
		$params	= array(
			'requisition_product_id' => $requisition_product_id
		);
		$result = $this->Requisition_product_manage->delete_req_product($params);
		$params = array(
			'requisition_product_id' => '',				
		);
		$result = $this->Requisition_product_manage->formfilelist($params);
		// echo "<pre>";print_r($result);exit;
		if($result['success'] == FALSE){
			$data['error'] = $result['error'];
		}
		else{
			$data['success_msg'] = "Requisition material Deleted Successfully";
		}
		$data['product_list']=json_decode(json_encode($result['data']), FALSE);
		// echo "<pre>";print_r($data['desg_list']);exit;
		$data['title'] = "Vinay Electricals Admin Panel :: Manage Requisition Material";
		$data['page_about']="ATTENTION: Please follow all the rules specified for this section";
		
		$this->load->view("common/head",$data);
        $this->load->view("requisition_product/requisition_product_list",$data);
        $this->load->view("common/footer",$data);
	}
	
	
	
	
	
	public function export_requisition_details(){
		if(isset($_GET['search_rproduct'])){
			$search_term = $_GET['search_rproduct'];
		}else{
			$search_term = '';
		}
		$params = array(
			'search_term' => $search_term,
		);
		$result = $this->Requisition_product_manage->formfilelist($params);
		
		//echo "<pre>";print_r($result);exit;
		
		// load the library
		$this->load->library('excel');
		// set active sheet
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Requisition Material worksheet');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Requisition Material ID');
		$this->excel->getActiveSheet()->setCellValue('B1', 'Requisition Material Title');
		$this->excel->getActiveSheet()->setCellValue('C1', 'Requisition Material Price');
		$this->excel->getActiveSheet()->setCellValue('D1', 'Requisition Material Category');
		$this->excel->getActiveSheet()->setCellValue('E1', 'Requisition Material Status');
		 $i=1;
		foreach($result['data'] as $rd)
		{
			$i++;				
			$this->excel->getActiveSheet()->setCellValue('A'.$i, $rd['requisition_product_id']);
			$this->excel->getActiveSheet()->setCellValue('B'.$i, $rd['product_title']);
			$this->excel->getActiveSheet()->setCellValue('C'.$i, $rd['product_price_per_unit']);		
			$this->excel->getActiveSheet()->setCellValue('D'.$i, $rd['requisition_category_name']);		
			$this->excel->getActiveSheet()->setCellValue('E'.$i, $rd['category_status']);		

		} 
		//exit;
		$filename='Requisition Material Report'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					 
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	
	


}



