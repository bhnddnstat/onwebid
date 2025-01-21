<?php
$comp_model = new SharedController;
$page_element_id = "list-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data From Controller
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_footer = $this->show_footer;
$show_pagination = $this->show_pagination;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="grid" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="p-2">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-6 col-border alert-primary col-radius comp-grid">
                    <div  class="">
                        <div class="container-fluid">
                            <div class="row justify-content-center">
                                <div class="col comp-grid">
                                    <h3 class="mt-2 mb-3 font-weight-bold text-center">DATA LAYANAN</h3>
                                    <a  class="btn btn-primary mb-2" href="<?php print_link("layanan/add") ?>">
                                        <i class="material-icons ">add</i>                              
                                        TAMBAH LAYANAN 
                                    </a>
                                    <?php $this :: display_page_errors(); ?>
                                    <div  class=" animated fadeIn page-content">
                                        <div id="layanan-list-records">
                                            <?php
                                            if(!empty($records)){
                                            ?>
                                            <div id="page-report-body">
                                                <div class="row justify-content-center page-data" id="page-data-<?php echo $page_element_id; ?>">
                                                    <!--record-->
                                                    <?php
                                                    $counter = 0;
                                                    foreach($records as $data){
                                                    $rec_id = (!empty($data['id_layanan']) ? urlencode($data['id_layanan']) : null);
                                                    $counter++;
                                                    ?>
                                                    <div class="col">
                                                        <div class="card alert-light p-3 mb-3 col-radius text-center">
                                                            <div class="mb-2 text-center" style="pointer-events: none;">
                                                                <?php Html::page_img($data['gambar'], 100, 100, 1); ?>
                                                            </div>
                                                            <div><h6 class="text-center font-weight-bold"><?php echo $data['pilihan_layanan']; ?></h6></div>
                                                            <div>
                                                                <a href="<?php echo $data['contoh_layanan']; ?>" class="col btn btn-primary font-weight-bold mt-2 mb-2" target="_blank">
                                                                    LIHAT CONTOH
                                                                </a>
                                                            </div>
                                                            <div class="text-justify font-weight-bold">Durasi : <?php echo $data['durasi_layanan']; ?></div>
                                                            <div class="text-justify font-weight-bold mb-3">Harga : Rp. <?php 
                                                            echo number_format($data['harga_layanan'], 0, ',', '.'); ?></div>
                                                            <div class="td-btn">
                                                                <a class="btn btn-sm btn-info has-tooltip" title="Edit This Record" href="<?php print_link("layanan/edit/$rec_id"); ?>">
                                                                    <i class="material-icons">edit</i> 
                                                                </a>
                                                                <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("layanan/delete/$rec_id/?csrf_token=$csrf_token"); ?>" data-prompt-msg="Yakin menghapus data ini ?" data-display-style="modal">
                                                                    <i class="material-icons">clear</i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php 
                                                    }
                                                    ?>
                                                    <!--endrecord-->
                                                </div>
                                                <div class="row justify-content-center search-data" id="search-data-<?php echo $page_element_id; ?>"></div>
                                                <div>
                                                </div>
                                            </div>
                                            <?php
                                            if($show_footer == true){
                                            ?>
                                            <div class=" border-top mt-2">
                                                <div class="row justify-content-center">    
                                                    <div class="col-md-auto">   
                                                    </div>
                                                    <div class="col">   
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            }
                                            else{
                                            ?>
                                            <div class="text-muted  animated bounce p-3">
                                                <h4><i class="material-icons">block</i> DATA MASIH KOSONG</h4>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</section>
