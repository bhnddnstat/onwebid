<?php
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
if (!empty($records)) {
?>
<!--record-->
<?php
$counter = 0;
foreach($records as $data){
$rec_id = (!empty($data['id_layanan']) ? urlencode($data['id_layanan']) : null);
$counter++;
?>
<div class="">
    <div class="">
        <div class="mb-2">  <?php Html :: page_img($data['gambar'],100,100,1); ?></div>
        <span><?php echo $data['pilihan_layanan']; ?></span>
        <div class="mb-2">  
            <span class="font-weight-light text-muted ">
                Durasi Layanan:  
            </span>
        <?php echo $data['durasi_layanan']; ?></div>
        <div class="mb-2">  
            <span class="font-weight-light text-muted ">
                Keterangan:  
            </span>
        <?php echo $data['keterangan']; ?></div>
        <div class="mb-2">  
            <span class="font-weight-light text-muted ">
                Harga Layanan:  
            </span>
        <?php echo $data['harga_layanan']; ?></div>
        <div class="mb-2">  
            <span class="font-weight-light text-muted ">
                Contoh Layanan:  
            </span>
        <?php echo $data['contoh_layanan']; ?></div>
        <div class="td-btn">
            <a class="btn btn-sm btn-info has-tooltip" title="Edit This Record" href="<?php print_link("layanan/edit/$rec_id"); ?>">
                <i class="material-icons">edit</i> EDIT
            </a>
            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("layanan/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Yakin menghapus data ini ?" data-display-style="modal">
                <i class="material-icons">clear</i>
                HAPUS
            </a>
        </div>
    </div>
</div>
<?php 
}
?>
<?php
} else {
?>
<td class="no-record-found col-12" colspan="100">
    <h4 class="text-muted text-center ">
        No Record Found
    </h4>
</td>
<?php
}
?>
