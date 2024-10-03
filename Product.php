

<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Product extends CI_Controller {

	

	public function __construct() {

		parent::__construct();

		$this->load->model('Product_manage');

		$this->load->library('session');

		if($this->session->has_userdata('AdminLogin') === FALSE){

			redirect('/Admin', 'location');

		}

	}

	

	public function index()

	{

		$this->form_list();

	}

	

	public function getSubcategories()

	{

		$cat_id = $this->input->post('cat_id');

			

		$result= $this->State_country_list->getproduct_subcategory_list($cat_id);	

		$initial = $this->input->post('sub_cat_id') == 0 ? 'selected' : '';

		$html = '<option value="" disabled '.$initial.'>Please select product subcategory </option>';

        foreach ($result as $key => $value) { 

			$selected = ((int)$this->input->post('sub_cat_id') == (int)$key ? 'selected' : '');

            $html .= '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';

        }

        echo $html;    

	}

	

	public function add_product()

		{			

			//print_r($_POST); exit;

			//echo $_FILES['product_file']['name']; exit;

		//	$product_name =  $this->input->post('product_name');

			$product_category_id =  $this->input->post('cat_id');

			$product_sub_category_id =  $this->input->post('subcat_id');

			//$product_quantity =  $this->input->post('product_quantity');

		//	$brand_id = $this->input->post('brand_id');

			$product_status =  $this->input->post('product_status');

			$download_type =  $this->input->post('download_type');

			

			if(isset($product_category_id) && $product_category_id!='' && isset($product_sub_category_id) && $product_sub_category_id!='')

			{

				$formdata = $this->input->post(NULL, TRUE);

				$imgFile = $_FILES['product_file']['name'];

				$tmp_dir = $_FILES['product_file']['tmp_name'];

				$imgSize = $_FILES['product_file']['size'];

				//echo $imgFile; exit;

				if($imgFile)

				  {

				   $upload_dir = 'assets/media/datafiles/productfile/'; // upload directory 

				   $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension

				   $valid_extensions = array('xlsx','pdf','doc','docx','mp3','mp4','jpeg', 'jpg', 'png', 'gif'); // valid extensions

				   //$file_name = rand(1000,1000000).".".$imgExt;					  

				   $file_name = $imgFile;					  

					

				   if(in_array($imgExt, $valid_extensions))

				   {   

					if($imgSize < 500000)

						{	

							//echo $file_name; exit;

							move_uploaded_file($tmp_dir,$upload_dir.$file_name);

						}

						else

						{

						 $data['error_msg'] = "Sorry, your file is too large it should be less then 5MB";

						}

				   }

				   else

				   {

					$data['error_msg'] = "Sorry, only Excel, PDF, DOC, DOCX, MP3, MP4, JPG, JPEG, PNG & GIF files are allowed.";  

				   } 

				  }

				  else

				  {

				   // if no image selected the old image remain as it is.

				   $file_name = $form_data['file_name']; // old image from database

				  } 

				$params = array(

					//'product_name'=> $product_name,

					'product_category_id'=> $product_category_id,

					'product_sub_category_id'=> $product_sub_category_id,

					//'product_quantity'=> $product_quantity,

					//'brand_id'=> $brand_id,

					'product_status'=>$product_status,

					'download_type'=>$download_type,

					'download_path'=>$file_name

				);

				//print_r($params); exit;

				$result = $this->Product_manage->add_product_manage($params);

			    //	print_r($result); exit;

				if($result['success']==false)

				{

					$data['error_msg']	= $result['error'];

				}

				else

				{

					$data['success_msg'] = "New Download Added Successfully";

				}				

			}

			

			//$data['title'] = "Company Location Management - Vinay Electrical Admin Panel";

			

			$product_data= array( array(

		//	'product_name'=>'',

			'product_category_id'=>'',

			'product_sub_category_id'=>'',			

			//'product_quantity'=>'',			

		//	'brand_id'=>'',			

			'product_status'=>'',		

			'download_type'=>'',

			'download_path'=>''		

			));

			

			$data['product_details'] = json_decode(json_encode($product_data));

			$data['page_about'] = 'ATTENTION: Please follow all the rules specified for this section';

			$data['title'] = "Vinay Electrical Admin Panel :: Add New Product Range";

			$data['heading'] = "Add New Download";

			$this->load->view("common/head",$data);

			$this->load->view("product/add_product",$data);

			$this->load->view("common/footer",$data);

		}

		

		public function form_list()

		{

			//$this->comfunction->checkuserloggedin();

			$data['title'] = "Vinay Electrical Admin Panel :: Manage Downloads";

			

			$data['page'] =0;

			if(isset($_GET['search_product'])){

				$search_term = $_GET['search_product'];

			}else{

				$search_term = '';

			}

		$params = array(

			'search_term' => $search_term,

		);

			$form_data = $this->Product_manage->formfilelist($params);

			//print_r($form_data );exit;

			$data['product_list'] = json_decode(json_encode($form_data['data']));

			$data['page_about']="ATTENTION: Please follow all the rules specified for this section";

			$this->load->view("common/head",$data);

			$this->load->view("product/product_list",$data);

			$this->load->view("common/footer",$data);

		}

		

		public function delete_product()

		{					

			$product_id= $this->uri->segment(3,0);

			$params	= array(

				'product_id' => $product_id

			);

			// echo "<pre>";print_r($params);exit;

			$result = $this->Product_manage->delete_product($params);

			// echo "<pre>";print_r($result);exit;

			$params = array(

				'product_id' => '',				

			);

			$result = $this->Product_manage->formfilelist($params);

			// echo "<pre>";print_r($result);exit;

			if($result['success'] == FALSE){

				$data['error'] = $result['error'];

			}

			else{

				$data['success_msg'] = "Download Deleted Successfully";

			}

			$data['product_list']=json_decode(json_encode($result['data']), FALSE);

			// echo "<pre>";print_r($data['product_list']);exit;

			$data['title'] = "Vinay Electrical Admin Panel :: Manage Downloads";

			$data['page_about']="ATTENTION: Please follow all the rules specified for this section";

			$this->load->view("common/head",$data);

			$this->load->view("product/product_list",$data);

			$this->load->view("common/footer",$data);

			// redirect('feature_story');

		}	

	

		public function edit_product()

		{

			//$this->comfunction->checkuserloggedin();

			$product_id= $this->uri->segment(3,0);
		
            $product_status=  $this->input->post('product_status');
            $download_type=  $this->input->post('download_type');
            $product_category_id =  $this->input->post('cat_id');
            
           // echo $product_id;
          
             	if(isset($product_category_id) && $product_category_id!='')

			{
			   

				$formdata = $this->input->post(NULL, TRUE);

				

				$imgFile = $_FILES['product_file']['name'];

				$tmp_dir = $_FILES['product_file']['tmp_name'];

				$imgSize = $_FILES['product_file']['size'];

				//echo $imgFile; exit;

				if($imgFile != '' && isset($imgFile))

				{

				   $upload_dir = 'assets/media/datafiles/productfile/'; // upload directory 

				   $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension

				   $valid_extensions = array('xlsx','pdf','doc','docx','mp3','mp4','jpeg', 'jpg', 'png', 'gif'); // valid extensions

				   //$file_name = rand(1000,1000000).".".$imgExt;					  

				   $file_name = $imgFile;				

					

				   if(in_array($imgExt, $valid_extensions))

				   {   

					if($imgSize < 500000)

						{

							//echo $file_name; exit;

							//$form_data = $this->Product_manage->formfilelist(); 

							if(isset($form_data['data'][0]['download_path']) && $form_data['data'][0]['download_path']!=''){

								move_uploaded_file($tmp_dir,$upload_dir.$file_name);

							}else{

								unlink($upload_dir.$form_data['data'][0]['download_path']);		

								move_uploaded_file($tmp_dir,$upload_dir.$file_name);

							}

						}

						else

						{

						 $data['error_msg'] = "Sorry, your file is too large it should be less then 5MB";

						}

				   }

				   else

				   {

					$data['error_msg'] = "Sorry, only Excel, PDF, DOC, DOCX, MP3, MP4, JPG, JPEG, PNG & GIF files are allowed.";  

				   } 

				  }

				  else

				  {

				   // if no image selected the old image remain as it is.

				   $file_name = $form_data['data'][0]['download_path']; // old image from database

				  } 

				$params = array(

				'product_id'=> $product_id,

				'formdata'=>$formdata, 

				'product_status'=>$product_status,

				'download_type'=>$download_type,

				'download_path'=>$file_name

				);

			

				//print_r($params);exit;

				$result = $this->Product_manage->edit_product_manage($params);

				

				if($result['success']==false)

				{

					$data['error_msg']	= $result['error'];

				}
				

				else

				{

					$data['success_msg'] = "Download Updated Successfully";

				}

				

			}

			

			$data['title'] = "Vinay Electrical Admin Panel :: Manage Downloads";

			

		

			//print_r($form_data );exit;

	        $params= array('product_id'=>$product_id,'groupuser'=>'editform');
            $form_data = $this->Product_manage->formfilelist($params);
			$data['product_details'] = json_decode(json_encode($form_data['data']));
				

			$data['submiturl'] = 'edit_product/'.$product_id;

			$data['page_about'] = 'ATTENTION: Please follow all the rules specified for this section';

			$data['edit'] = 1;

			$data['heading'] = "Edit Download";

			$this->load->view("common/head",$data);

			$this->load->view("product/add_product",$data);

			$this->load->view("common/footer",$data);

		}
		
		
		
		
		
		
		
		
		
		
		
		
		public function export_product_details(){
		if(isset($_GET['search_product'])){
				$search_term = $_GET['search_product'];
			}else{
				$search_term = '';
			}
		$params = array(
			'search_term' => $search_term,
		);
		$result = $this->Product_manage->formfilelist($params);
		
		//echo "<pre>";print_r($result);exit;
		
		// load the library
		$this->load->library('excel');
		// set active sheet
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Product Download worksheet');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Product ID');
		$this->excel->getActiveSheet()->setCellValue('B1', 'Product Name');
		$this->excel->getActiveSheet()->setCellValue('C1', 'Product Category Name');
		$this->excel->getActiveSheet()->setCellValue('D1', 'Product Sub-Category Name');
		$this->excel->getActiveSheet()->setCellValue('E1', 'Product Brand Name');
		$this->excel->getActiveSheet()->setCellValue('F1', 'Product Status');
		 $i=1;
		foreach($result['data'] as $rd)
		{
			$i++;				
			$this->excel->getActiveSheet()->setCellValue('A'.$i, $rd['product_id']);
			$this->excel->getActiveSheet()->setCellValue('B'.$i, $rd['product_name']);
			$this->excel->getActiveSheet()->setCellValue('C'.$i, $rd['category_name']);		
			$this->excel->getActiveSheet()->setCellValue('D'.$i, $rd['sub_category_name']);		
			$this->excel->getActiveSheet()->setCellValue('E'.$i, $rd['ve_brand_name']);		
			$this->excel->getActiveSheet()->setCellValue('F'.$i, $rd['product_status']);		

		} 
		//exit;
		$filename='Product Download Report'.time().'.xls'; //save our workbook as this file name
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
			$product_id=$this->input->post('product_id');
			$count = count($product_id);
			for($i=0;$i<$count;$i++){
				$params	= array(
					'product_id' => $product_id[$i]
				);
				$result = $this->Product_manage->delete_product($params);
			}
			echo json_encode($result);
			exit;
		}
	}

}



