<?php 
/**
 * Pesanan Page Controller
 * @category  Controller
 */
class PesananController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "pesanan";
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
		$fields = array("id_pesanan", 
			"tanggal_pesanan", 
			"kode_pesanan", 
			"nama_pemesan", 
			"kontak_pemesan", 
			"pilihan_pesanan", 
			"durasi_pesanan", 
			"status_pembayaran");
		$pagination = $this->get_pagination(2000); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				pesanan.id_pesanan LIKE ? OR 
				pesanan.tanggal_pesanan LIKE ? OR 
				pesanan.kode_pesanan LIKE ? OR 
				pesanan.nama_pemesan LIKE ? OR 
				pesanan.kontak_pemesan LIKE ? OR 
				pesanan.email_pemesan LIKE ? OR 
				pesanan.pilihan_pesanan LIKE ? OR 
				pesanan.harga_pesanan LIKE ? OR 
				pesanan.durasi_pesanan LIKE ? OR 
				pesanan.tarif_ppn LIKE ? OR 
				pesanan.subtotal_harga LIKE ? OR 
				pesanan.request_pesanan LIKE ? OR 
				pesanan.status_pembayaran LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "pesanan/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("tanggal_pesanan", "DESC");
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
				$record['tanggal_pesanan'] = format_date($record['tanggal_pesanan'],'d-m-Y');
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
		$page_title = $this->view->page_title = "PESANAN";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("pesanan/list.php", $data); //render the full page
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
		$fields = array("id_pesanan", 
			"tanggal_pesanan", 
			"kode_pesanan", 
			"nama_pemesan", 
			"kontak_pemesan", 
			"email_pemesan", 
			"pilihan_pesanan", 
			"harga_pesanan", 
			"durasi_pesanan", 
			"tarif_ppn", 
			"subtotal_harga", 
			"request_pesanan", 
			"status_pembayaran");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("pesanan.id_pesanan", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$record['tanggal_pesanan'] = format_date($record['tanggal_pesanan'],'d-m-Y');
			$page_title = $this->view->page_title = "DETAIL PESANAN";
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
		return $this->render_view("pesanan/view.php", $record);
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
			$fields = $this->fields = array("tanggal_pesanan","kode_pesanan","nama_pemesan","kontak_pemesan","email_pemesan","pilihan_pesanan","harga_pesanan","durasi_pesanan","tarif_ppn","subtotal_harga","request_pesanan","status_pembayaran");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tanggal_pesanan' => 'required',
				'nama_pemesan' => 'required',
				'kontak_pemesan' => 'required|numeric',
				'email_pemesan' => 'required|valid_email',
				'pilihan_pesanan' => 'required',
				'harga_pesanan' => 'required',
				'durasi_pesanan' => 'required',
				'tarif_ppn' => 'required',
				'subtotal_harga' => 'required',
				'status_pembayaran' => 'required',
			);
			$this->sanitize_array = array(
				'tanggal_pesanan' => 'sanitize_string',
				'kode_pesanan' => 'sanitize_string',
				'nama_pemesan' => 'sanitize_string',
				'kontak_pemesan' => 'sanitize_string',
				'email_pemesan' => 'sanitize_string',
				'pilihan_pesanan' => 'sanitize_string',
				'harga_pesanan' => 'sanitize_string',
				'durasi_pesanan' => 'sanitize_string',
				'tarif_ppn' => 'sanitize_string',
				'subtotal_harga' => 'sanitize_string',
				'request_pesanan' => 'sanitize_string',
				'status_pembayaran' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("PESANAN BERHASIL DITAMBAH", "success");
					return	$this->redirect("pesanan");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "FORMULIR PESANAN";
		$this->render_view("pesanan/add.php");
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
		$fields = $this->fields = array("id_pesanan","tanggal_pesanan","kode_pesanan","nama_pemesan","kontak_pemesan","email_pemesan","pilihan_pesanan","harga_pesanan","durasi_pesanan","tarif_ppn","subtotal_harga","request_pesanan","status_pembayaran");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tanggal_pesanan' => 'required',
				'nama_pemesan' => 'required',
				'kontak_pemesan' => 'required|numeric',
				'email_pemesan' => 'required|valid_email',
				'pilihan_pesanan' => 'required',
				'harga_pesanan' => 'required',
				'durasi_pesanan' => 'required',
				'tarif_ppn' => 'required',
				'subtotal_harga' => 'required',
				'status_pembayaran' => 'required',
			);
			$this->sanitize_array = array(
				'tanggal_pesanan' => 'sanitize_string',
				'kode_pesanan' => 'sanitize_string',
				'nama_pemesan' => 'sanitize_string',
				'kontak_pemesan' => 'sanitize_string',
				'email_pemesan' => 'sanitize_string',
				'pilihan_pesanan' => 'sanitize_string',
				'harga_pesanan' => 'sanitize_string',
				'durasi_pesanan' => 'sanitize_string',
				'tarif_ppn' => 'sanitize_string',
				'subtotal_harga' => 'sanitize_string',
				'request_pesanan' => 'sanitize_string',
				'status_pembayaran' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("pesanan.id_pesanan", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("PESANAN BERHASIL DIUBAH", "success");
					return $this->redirect("pesanan");
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
						return	$this->redirect("pesanan");
					}
				}
			}
		}
		$db->where("pesanan.id_pesanan", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "EDIT PESANAN";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("pesanan/edit.php", $data);
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
		$db->where("pesanan.id_pesanan", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("PESANAN BERHASIL DIBATALKAN", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("pesanan");
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function customadd($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("tanggal_pesanan","kode_pesanan","nama_pemesan","kontak_pemesan","email_pemesan","pilihan_pesanan","harga_pesanan","durasi_pesanan","tarif_ppn","subtotal_harga","request_pesanan","status_pembayaran");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tanggal_pesanan' => 'required',
				'nama_pemesan' => 'required',
				'kontak_pemesan' => 'required|numeric',
				'email_pemesan' => 'required|valid_email',
				'pilihan_pesanan' => 'required',
				'harga_pesanan' => 'required',
				'durasi_pesanan' => 'required',
				'tarif_ppn' => 'required',
				'subtotal_harga' => 'required',
			);
			$this->sanitize_array = array(
				'tanggal_pesanan' => 'sanitize_string',
				'kode_pesanan' => 'sanitize_string',
				'nama_pemesan' => 'sanitize_string',
				'kontak_pemesan' => 'sanitize_string',
				'email_pemesan' => 'sanitize_string',
				'pilihan_pesanan' => 'sanitize_string',
				'harga_pesanan' => 'sanitize_string',
				'durasi_pesanan' => 'sanitize_string',
				'tarif_ppn' => 'sanitize_string',
				'subtotal_harga' => 'sanitize_string',
				'request_pesanan' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['status_pembayaran'] = "BELUM LUNAS";
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("PESANAN BERHASIL DITAMBAH", "success");
					return	$this->redirect("pesanan/customview/$rec_id");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "FORMULIR PESANAN";
		$this->render_view("pesanan/customadd.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function customedit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id_pesanan","tanggal_pesanan","kode_pesanan","nama_pemesan","kontak_pemesan","email_pemesan","pilihan_pesanan","harga_pesanan","durasi_pesanan","tarif_ppn","subtotal_harga","request_pesanan","status_pembayaran");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tanggal_pesanan' => 'required',
				'nama_pemesan' => 'required',
				'kontak_pemesan' => 'required|numeric',
				'email_pemesan' => 'required|valid_email',
				'pilihan_pesanan' => 'required',
				'harga_pesanan' => 'required',
				'durasi_pesanan' => 'required',
				'tarif_ppn' => 'required',
				'subtotal_harga' => 'required',
			);
			$this->sanitize_array = array(
				'tanggal_pesanan' => 'sanitize_string',
				'kode_pesanan' => 'sanitize_string',
				'nama_pemesan' => 'sanitize_string',
				'kontak_pemesan' => 'sanitize_string',
				'email_pemesan' => 'sanitize_string',
				'pilihan_pesanan' => 'sanitize_string',
				'harga_pesanan' => 'sanitize_string',
				'durasi_pesanan' => 'sanitize_string',
				'tarif_ppn' => 'sanitize_string',
				'subtotal_harga' => 'sanitize_string',
				'request_pesanan' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['status_pembayaran'] = "BELUM LUNAS";
			if($this->validated()){
				$db->where("pesanan.id_pesanan", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("PESANAN BERHASIL DIUBAH", "success");
					return $this->redirect("pesanan/customview/$rec_id");
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
						return	$this->redirect("pesanan/customview/$rec_id");
					}
				}
			}
		}
		$db->where("pesanan.id_pesanan", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "EDIT PESANAN";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("pesanan/customedit.php", $data);
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function customview($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("id_pesanan", 
			"tanggal_pesanan", 
			"kode_pesanan", 
			"nama_pemesan", 
			"kontak_pemesan", 
			"email_pemesan", 
			"pilihan_pesanan", 
			"harga_pesanan", 
			"durasi_pesanan", 
			"tarif_ppn", 
			"subtotal_harga", 
			"request_pesanan", 
			"status_pembayaran");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("pesanan.id_pesanan", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$record['tanggal_pesanan'] = format_date($record['tanggal_pesanan'],'d-m-Y');
			$page_title = $this->view->page_title = "DETAIL PESANAN";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("pesanan/customview.php", $record);
	}
}
