<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * pesanan_pilihan_pesanan_option_list Model Action
     * @return array
     */
	function pesanan_pilihan_pesanan_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT pilihan_layanan AS value,pilihan_layanan AS label FROM layanan ORDER BY pilihan_layanan ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * pesanansc_pilihan_pesanansc_option_list Model Action
     * @return array
     */
	function pesanansc_pilihan_pesanansc_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT pilihan_layanansc AS value,pilihan_layanansc AS label FROM layanansc ORDER BY pilihan_layanansc ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * user_username_value_exist Model Action
     * @return array
     */
	function user_username_value_exist($val){
		$db = $this->GetModel();
		$db->where("username", $val);
		$exist = $db->has("user");
		return $exist;
	}

	/**
     * user_email_value_exist Model Action
     * @return array
     */
	function user_email_value_exist($val){
		$db = $this->GetModel();
		$db->where("email", $val);
		$exist = $db->has("user");
		return $exist;
	}

}
