<?php 
/**
 * Layanansc Page Controller
 * @category  Controller
 */
class LayananscController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "layanansc";
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
		$fields = array("id_layanansc", 
			"gambarsc", 
			"pilihan_layanansc", 
			"contoh_layanansc", 
			"durasi_layanansc", 
			"harga_layanansc");
		$pagination = $this->get_pagination(200); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				layanansc.id_layanansc LIKE ? OR 
				layanansc.gambarsc LIKE ? OR 
				layanansc.pilihan_layanansc LIKE ? OR 
				layanansc.contoh_layanansc LIKE ? OR 
				layanansc.durasi_layanansc LIKE ? OR 
				layanansc.harga_layanansc LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "layanansc/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("pilihan_layanansc", "ASC");
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
		$page_title = $this->view->page_title = "LAYANAN SC";
		$this->render_view("layanansc/list.php", $data); //render the full page
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
			$fields = $this->fields = array("gambarsc","pilihan_layanansc","durasi_layanansc","harga_layanansc","contoh_layanansc");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'gambarsc' => 'required',
				'pilihan_layanansc' => 'required',
				'durasi_layanansc' => 'required',
				'harga_layanansc' => 'required|numeric',
				'contoh_layanansc' => 'required|valid_url',
			);
			$this->sanitize_array = array(
				'gambarsc' => 'sanitize_string',
				'pilihan_layanansc' => 'sanitize_string',
				'durasi_layanansc' => 'sanitize_string',
				'harga_layanansc' => 'sanitize_string',
				'contoh_layanansc' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("DATA BERHASIL DITAMBAH", "success");
					return	$this->redirect("layanansc");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "TAMBAH LAYANAN SC";
		$this->render_view("layanansc/add.php");
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
		$fields = $this->fields = array("id_layanansc","gambarsc","pilihan_layanansc","durasi_layanansc","harga_layanansc","contoh_layanansc");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'gambarsc' => 'required',
				'pilihan_layanansc' => 'required',
				'durasi_layanansc' => 'required',
				'harga_layanansc' => 'required|numeric',
				'contoh_layanansc' => 'required|valid_url',
			);
			$this->sanitize_array = array(
				'gambarsc' => 'sanitize_string',
				'pilihan_layanansc' => 'sanitize_string',
				'durasi_layanansc' => 'sanitize_string',
				'harga_layanansc' => 'sanitize_string',
				'contoh_layanansc' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("layanansc.id_layanansc", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("DATA BERHASIL DIUBAH", "success");
					return $this->redirect("layanansc");
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
						return	$this->redirect("layanansc");
					}
				}
			}
		}
		$db->where("layanansc.id_layanansc", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "EDIT LAYANAN SC";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("layanansc/edit.php", $data);
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
		$db->where("layanansc.id_layanansc", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("DATA BERHASIL DIHAPUS", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("layanansc");
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function cuslistlayanansc($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("id_layanansc", 
			"gambarsc", 
			"pilihan_layanansc", 
			"contoh_layanansc", 
			"durasi_layanansc", 
			"harga_layanansc");
		$pagination = $this->get_pagination(200); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				layanansc.id_layanansc LIKE ? OR 
				layanansc.gambarsc LIKE ? OR 
				layanansc.pilihan_layanansc LIKE ? OR 
				layanansc.contoh_layanansc LIKE ? OR 
				layanansc.durasi_layanansc LIKE ? OR 
				layanansc.harga_layanansc LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "layanansc/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("pilihan_layanansc", "ASC");
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
		$page_title = $this->view->page_title = "LAYANAN SOURCE CODE";
		$this->render_view("layanansc/cuslistlayanansc.php", $data); //render the full page
	}
}
