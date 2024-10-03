<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Products_download extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Product_manage');
		$this->load->model('User_model');
		$this->load->library('session');
		//print_r($this->session->userdata('LoginDetails'));exit;
		if($this->session->has_userdata('LoginDetails') === FALSE){
			redirect('/', 'location');
		}
	}
	
	public function index()
	{
	//	echo 'herer';exit;
		$data['page_active'] = 'Products';
		$data['employee_details'] = $this->User_model->getUserDetails($this->session->userdata('LoginDetails'))['data'];
		
		$data['website_url'] = base_url();
		$this->load->model('Product_manage');
		//$data['requisitions_approval'] = $this->->getMyRequisitions($this->session->userdata('LoginDetails'));
		$params= array();
		$form_data = $this->Product_manage->productlist($params);
		$data['product_list'] = json_decode(json_encode($form_data['data']));
		//echo '<pre>';print_r($data['product_list']);exit;
		$data['title'] = "Vinay Electricals :: Product Downloads";
		$this->load->view("common/webheader",$data);
		$this->load->view('product/products');
		$this->load->view("common/webfooter",$data);
	}
	protected function getChainAbove(){
		$chain_array = $this->User_model->getImmediateChainAbove($this->session->userdata('LoginDetails'));
		$user_array = array();
		if(count($chain_array) > 0){
			foreach($chain_array as $c){
				array_push($user_array,$c);
			}
		}
		while(count($chain_array) > 0){
			$user_chain_future_id = $chain_array[count($chain_array)-1]->reporting_head_id;
			//echo 'chain to be got of'.$user_chain_future_id;
			array_pop($chain_array);
			//echo '<pre> Pop';print_r($chain_array);
			$next_chain = $this->User_model->getImmediateChainAbove($user_chain_future_id);
			
			if(count($next_chain) > 0){
				//echo '<pre>next chain';print_r($next_chain);
				foreach($next_chain as $c){
					array_push($user_array,$c);
					array_push($chain_array,$c);
				}
			}
		}
		return $user_array;
	}	
	public function getRequisitionForm(){
		$data['page_active'] = 'Products';
		if(isset($_POST['category_id']) && !empty($_POST['category_id'])){
			$this->load->model('Requisitions_model');
			$products = $this->Requisitions_model->getRequisitionProducts($_POST['category_id']);
			if(count($products) > 0){
			$html ="<div class='table-responsive cart_info'>
							<table class='table table-condensed'>";
			foreach($products as $product){
				$html .="<tr>";
				$html .="<td><img src='assets/media/datafiles/product/".$product->product_thumbnail."' alt='' style='max-width:100px;' class='requisition_image'></td>";
				$html .="<td>".$product->product_title."</td>";
				$html .="<td><input class='cart_quantity_input' type='text' name='quantity[".$product->requisition_product_id."]' value='0' autocomplete='off'></td>";
				$html .="</tr>";				
				
			}
			$html .="	</table>
						</div>
						<input type='submit' name='requisition_form_button' id='requisition_form_button'>";
			} else {
				$html = "No products for this requisition";
			}			
			echo $html;				
		}
	}
	
	public function view(){
		$data['page_active'] = 'Products';
		$requisition_id = $this->uri->segment(3, 0);
		
		if($requisition_id != 0 && $requisition_id != ''){

			$data['requisition_id'] = $requisition_id;
			
			$data['employee_details'] = $this->User_model->getUserDetails($this->session->userdata('LoginDetails'))['data'];
			
			$data['product_details'] = $this->Requisitions_model->getproductdetails($requisition_id);
			
			$data['requisitions'] = $this->Requisitions_model->getMyRequisitions($this->session->userdata('LoginDetails'),$requisition_id);
			
			$data['website_url'] = base_url();

			$data['title'] = "Vinay Electricals :: Requisitions Details";
			$this->load->view("common/webheader",$data);
			$this->load->view('requisitions/requisition_detail');
			$this->load->view("common/webfooter",$data);

		} else {

		$this->load->view("common/webheader",$data);
		$this->load->view('errors/html/error_404',$data);
		$this->load->view("common/webfooter",$data);

		}
	}
}