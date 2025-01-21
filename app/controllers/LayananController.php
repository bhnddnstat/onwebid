<?php 
/**
 * Layanan Page Controller
 * @category  Controller
 */
class LayananController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "layanan";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("id_layanan", 
			"gambar", 
			"pilihan_layanan", 
			"contoh_layanan", 
			"durasi_layanan", 
			"harga_layanan");
		$pagination = $this->get_pagination(200); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				layanan.id_layanan LIKE ? OR 
				layanan.gambar LIKE ? OR 
				layanan.pilihan_layanan LIKE ? OR 
				layanan.contoh_layanan LIKE ? OR 
				layanan.durasi_layanan LIKE ? OR 
				layanan.harga_layanan LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "layanan/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("pilihan_layanan", "ASC");
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "LAYANAN";
		$this->render_view("layanan/list.php", $data); //render the full page
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("gambar","pilihan_layanan","durasi_layanan","harga_layanan","contoh_layanan");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'gambar' => 'required',
				'pilihan_layanan' => 'required',
				'durasi_layanan' => 'required',
				'harga_layanan' => 'required|numeric',
				'contoh_layanan' => 'required|valid_url',
			);
			$this->sanitize_array = array(
				'gambar' => 'sanitize_string',
				'pilihan_layanan' => 'sanitize_string',
				'durasi_layanan' => 'sanitize_string',
				'harga_layanan' => 'sanitize_string',
				'contoh_layanan' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("DATA BERHASIL DITAMBAH", "success");
					return	$this->redirect("layanan");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "TAMBAH LAYANAN";
		$this->render_view("layanan/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id_layanan","gambar","pilihan_layanan","durasi_layanan","harga_layanan","contoh_layanan");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'gambar' => 'required',
				'pilihan_layanan' => 'required',
				'durasi_layanan' => 'required',
				'harga_layanan' => 'required|numeric',
				'contoh_layanan' => 'required|valid_url',
			);
			$this->sanitize_array = array(
				'gambar' => 'sanitize_string',
				'pilihan_layanan' => 'sanitize_string',
				'durasi_layanan' => 'sanitize_string',
				'harga_layanan' => 'sanitize_string',
				'contoh_layanan' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("layanan.id_layanan", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("DATA BERHASIL DIUBAH", "success");
					return $this->redirect("layanan");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("layanan");
					}
				}
			}
		}
		$db->where("layanan.id_layanan", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "EDIT LAYANAN";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("layanan/edit.php", $data);
	}
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("layanan.id_layanan", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("DATA BERHASIL DIHAPUS", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("layanan");
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function cuslistlayanan($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("id_layanan", 
			"gambar", 
			"pilihan_layanan", 
			"contoh_layanan", 
			"durasi_layanan", 
			"harga_layanan");
		$pagination = $this->get_pagination(200); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				layanan.id_layanan LIKE ? OR 
				layanan.gambar LIKE ? OR 
				layanan.pilihan_layanan LIKE ? OR 
				layanan.contoh_layanan LIKE ? OR 
				layanan.durasi_layanan LIKE ? OR 
				layanan.harga_layanan LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "layanan/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("pilihan_layanan", "ASC");
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "LAYANAN DIGITAL";
		$this->render_view("layanan/cuslistlayanan.php", $data); //render the full page
	}
}
