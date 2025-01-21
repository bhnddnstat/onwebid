<?php 
/**
 * Pesanansc Page Controller
 * @category  Controller
 */
class PesananscController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "pesanansc";
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
		$fields = array("id_pesanansc", 
			"tanggal_pesanansc", 
			"kode_pesanansc", 
			"nama_pemesansc", 
			"kontak_pemesansc", 
			"pilihan_pesanansc", 
			"durasi_pesanansc", 
			"status_pembayaran");
		$pagination = $this->get_pagination(2000); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				pesanansc.id_pesanansc LIKE ? OR 
				pesanansc.tanggal_pesanansc LIKE ? OR 
				pesanansc.kode_pesanansc LIKE ? OR 
				pesanansc.nama_pemesansc LIKE ? OR 
				pesanansc.kontak_pemesansc LIKE ? OR 
				pesanansc.email_pemesansc LIKE ? OR 
				pesanansc.pilihan_pesanansc LIKE ? OR 
				pesanansc.harga_pesanansc LIKE ? OR 
				pesanansc.durasi_pesanansc LIKE ? OR 
				pesanansc.tarif_ppnsc LIKE ? OR 
				pesanansc.subtotal_hargasc LIKE ? OR 
				pesanansc.request_pesanansc LIKE ? OR 
				pesanansc.status_pembayaran LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "pesanansc/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("tanggal_pesanansc", "DESC");
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
		if(	!empty($records)){
			foreach($records as &$record){
				$record['tanggal_pesanansc'] = format_date($record['tanggal_pesanansc'],'d-m-Y');
			}
		}
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "PESANAN SC";
		$this->render_view("pesanansc/list.php", $data); //render the full page
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("id_pesanansc", 
			"tanggal_pesanansc", 
			"kode_pesanansc", 
			"nama_pemesansc", 
			"kontak_pemesansc", 
			"email_pemesansc", 
			"pilihan_pesanansc", 
			"harga_pesanansc", 
			"durasi_pesanansc", 
			"tarif_ppnsc", 
			"subtotal_hargasc", 
			"request_pesanansc", 
			"status_pembayaran");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("pesanansc.id_pesanansc", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$record['tanggal_pesanansc'] = format_date($record['tanggal_pesanansc'],'d-m-Y');
			$page_title = $this->view->page_title = "DETAIL PESANAN SC";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("pesanansc/view.php", $record);
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
			$fields = $this->fields = array("tanggal_pesanansc","kode_pesanansc","nama_pemesansc","kontak_pemesansc","email_pemesansc","pilihan_pesanansc","harga_pesanansc","durasi_pesanansc","tarif_ppnsc","subtotal_hargasc","request_pesanansc","status_pembayaran");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tanggal_pesanansc' => 'required',
				'nama_pemesansc' => 'required',
				'kontak_pemesansc' => 'required',
				'email_pemesansc' => 'required|valid_email',
				'pilihan_pesanansc' => 'required',
				'harga_pesanansc' => 'required',
				'durasi_pesanansc' => 'required',
				'tarif_ppnsc' => 'required',
				'subtotal_hargasc' => 'required',
				'request_pesanansc' => 'required',
				'status_pembayaran' => 'required',
			);
			$this->sanitize_array = array(
				'tanggal_pesanansc' => 'sanitize_string',
				'kode_pesanansc' => 'sanitize_string',
				'nama_pemesansc' => 'sanitize_string',
				'kontak_pemesansc' => 'sanitize_string',
				'email_pemesansc' => 'sanitize_string',
				'pilihan_pesanansc' => 'sanitize_string',
				'harga_pesanansc' => 'sanitize_string',
				'durasi_pesanansc' => 'sanitize_string',
				'tarif_ppnsc' => 'sanitize_string',
				'subtotal_hargasc' => 'sanitize_string',
				'request_pesanansc' => 'sanitize_string',
				'status_pembayaran' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("PESANAN BERHASIL DITAMBAH", "success");
					return	$this->redirect("pesanansc/view/$rec_id");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "FORMULIR PESANAN";
		$this->render_view("pesanansc/add.php");
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
		$fields = $this->fields = array("id_pesanansc","tanggal_pesanansc","kode_pesanansc","nama_pemesansc","kontak_pemesansc","email_pemesansc","pilihan_pesanansc","harga_pesanansc","durasi_pesanansc","tarif_ppnsc","subtotal_hargasc","request_pesanansc","status_pembayaran");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tanggal_pesanansc' => 'required',
				'nama_pemesansc' => 'required',
				'kontak_pemesansc' => 'required',
				'email_pemesansc' => 'required|valid_email',
				'pilihan_pesanansc' => 'required',
				'harga_pesanansc' => 'required',
				'durasi_pesanansc' => 'required',
				'tarif_ppnsc' => 'required',
				'subtotal_hargasc' => 'required',
				'request_pesanansc' => 'required',
				'status_pembayaran' => 'required',
			);
			$this->sanitize_array = array(
				'tanggal_pesanansc' => 'sanitize_string',
				'kode_pesanansc' => 'sanitize_string',
				'nama_pemesansc' => 'sanitize_string',
				'kontak_pemesansc' => 'sanitize_string',
				'email_pemesansc' => 'sanitize_string',
				'pilihan_pesanansc' => 'sanitize_string',
				'harga_pesanansc' => 'sanitize_string',
				'durasi_pesanansc' => 'sanitize_string',
				'tarif_ppnsc' => 'sanitize_string',
				'subtotal_hargasc' => 'sanitize_string',
				'request_pesanansc' => 'sanitize_string',
				'status_pembayaran' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("pesanansc.id_pesanansc", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("PESANAN BERHASIL DIUBAH", "success");
					return $this->redirect("pesanansc/view/$rec_id");
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
						return	$this->redirect("pesanansc/view/$rec_id");
					}
				}
			}
		}
		$db->where("pesanansc.id_pesanansc", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "EDIT PESANAN SC";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("pesanansc/edit.php", $data);
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
		$db->where("pesanansc.id_pesanansc", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("PESANAN BERHASIL DIBATALKAN", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("pesanansc");
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function customscview($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("id_pesanansc", 
			"tanggal_pesanansc", 
			"kode_pesanansc", 
			"nama_pemesansc", 
			"kontak_pemesansc", 
			"email_pemesansc", 
			"pilihan_pesanansc", 
			"harga_pesanansc", 
			"durasi_pesanansc", 
			"tarif_ppnsc", 
			"subtotal_hargasc", 
			"request_pesanansc", 
			"status_pembayaran");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("pesanansc.id_pesanansc", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$record['tanggal_pesanansc'] = format_date($record['tanggal_pesanansc'],'d-m-Y');
			$page_title = $this->view->page_title = "DETAIL PESANAN SC";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("pesanansc/customscview.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function customscadd($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("tanggal_pesanansc","kode_pesanansc","nama_pemesansc","kontak_pemesansc","email_pemesansc","pilihan_pesanansc","harga_pesanansc","durasi_pesanansc","tarif_ppnsc","subtotal_hargasc","request_pesanansc","status_pembayaran");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tanggal_pesanansc' => 'required',
				'nama_pemesansc' => 'required',
				'kontak_pemesansc' => 'required',
				'email_pemesansc' => 'required|valid_email',
				'pilihan_pesanansc' => 'required',
				'harga_pesanansc' => 'required',
				'durasi_pesanansc' => 'required',
				'tarif_ppnsc' => 'required',
				'subtotal_hargasc' => 'required',
				'request_pesanansc' => 'required',
			);
			$this->sanitize_array = array(
				'tanggal_pesanansc' => 'sanitize_string',
				'kode_pesanansc' => 'sanitize_string',
				'nama_pemesansc' => 'sanitize_string',
				'kontak_pemesansc' => 'sanitize_string',
				'email_pemesansc' => 'sanitize_string',
				'pilihan_pesanansc' => 'sanitize_string',
				'harga_pesanansc' => 'sanitize_string',
				'durasi_pesanansc' => 'sanitize_string',
				'tarif_ppnsc' => 'sanitize_string',
				'subtotal_hargasc' => 'sanitize_string',
				'request_pesanansc' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['status_pembayaran'] = "BELUM LUNAS";
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("PESANAN BERHASIL DITAMBAH", "success");
					return	$this->redirect("pesanansc/customscview/$rec_id");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "FORMULIR PESANAN";
		$this->render_view("pesanansc/customscadd.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function customscedit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id_pesanansc","tanggal_pesanansc","kode_pesanansc","nama_pemesansc","kontak_pemesansc","email_pemesansc","pilihan_pesanansc","harga_pesanansc","durasi_pesanansc","tarif_ppnsc","subtotal_hargasc","request_pesanansc","status_pembayaran");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tanggal_pesanansc' => 'required',
				'nama_pemesansc' => 'required',
				'kontak_pemesansc' => 'required',
				'email_pemesansc' => 'required|valid_email',
				'pilihan_pesanansc' => 'required',
				'harga_pesanansc' => 'required',
				'durasi_pesanansc' => 'required',
				'tarif_ppnsc' => 'required',
				'subtotal_hargasc' => 'required',
				'request_pesanansc' => 'required',
			);
			$this->sanitize_array = array(
				'tanggal_pesanansc' => 'sanitize_string',
				'kode_pesanansc' => 'sanitize_string',
				'nama_pemesansc' => 'sanitize_string',
				'kontak_pemesansc' => 'sanitize_string',
				'email_pemesansc' => 'sanitize_string',
				'pilihan_pesanansc' => 'sanitize_string',
				'harga_pesanansc' => 'sanitize_string',
				'durasi_pesanansc' => 'sanitize_string',
				'tarif_ppnsc' => 'sanitize_string',
				'subtotal_hargasc' => 'sanitize_string',
				'request_pesanansc' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['status_pembayaran'] = "BELUM LUNAS";
			if($this->validated()){
				$db->where("pesanansc.id_pesanansc", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("PESANAN BERHASIL DIUBAH", "success");
					return $this->redirect("pesanansc/customscview/$rec_id");
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
						return	$this->redirect("pesanansc/customscview/$rec_id");
					}
				}
			}
		}
		$db->where("pesanansc.id_pesanansc", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "EDIT PESANAN SC";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("pesanansc/customscedit.php", $data);
	}
}
