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
                <div class="col-sm-6 tutors col-border col-radius comp-grid">
                    <div  class="">
                        <div class="container-fluid">
                            <div class="row justify-content-center">
                                <div class="col content-center comp-grid">
                                    <h3 class="mt-2 mb-3 font-weight-bold text-center">LAYANAN SOURCE CODE</h3>
                                    <a  class="btn col-sm-5 btn-pesan mb-3 font-weight-bold" href="<?php print_link("pesanansc/customscadd") ?>">
                                        <i class="material-icons ">local_grocery_store</i>                              
                                        PESAN SOURCE CODE 
                                    </a>
                                    <?php $this :: display_page_errors(); ?>
                                    <div  class=" animated fadeIn page-content">
                                        <div id="layanansc-cuslistlayanansc-records">
                                            <?php
                                            if(!empty($records)){
                                            ?>
                                            <div id="page-report-body">
                                                <div class="row justify-content-center page-data" id="page-data-<?php echo $page_element_id; ?>">
                                                    <!--record-->
                                                    <?php
                                                    $counter = 0;
                                                    foreach($records as $data){
                                                    $rec_id = (!empty($data['id_layanansc']) ? urlencode($data['id_layanansc']) : null);
                                                    $counter++;
                                                    ?>
                                                    <div class="col">
                                                        <div class="card alert-light p-3 mb-3 col-radius text-center">
                                                            <div class="mb-2 text-center" style="pointer-events: none;">
                                                                <?php Html::page_img($data['gambarsc'], 100, 100, 1); ?>
                                                            </div>
                                                            <div><h6 class="text-center font-weight-bold"><?php echo $data['pilihan_layanansc']; ?></h6></div>
                                                            <div>
                                                                <a href="<?php echo $data['contoh_layanansc']; ?>" class="col btn btn-demo font-weight-bold mt-2 mb-2" target="_blank">
                                                                    LIHAT CONTOH
                                                                </a>
                                                            </div>
                                                            <div class="text-justify font-weight-bold">Durasi : <?php echo $data['durasi_layanansc']; ?></div>
                                                            <div class="text-justify font-weight-bold mb-3">Harga : Rp. <?php 
                                                            echo number_format($data['harga_layanansc'], 0, ',', '.'); ?></div>
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
