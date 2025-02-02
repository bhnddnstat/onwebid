<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">View  Layanansc</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['id_layanansc']) ? urlencode($data['id_layanansc']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id_layanansc">
                                        <th class="title"> Id Layanansc: </th>
                                        <td class="value"> <?php echo $data['id_layanansc']; ?></td>
                                    </tr>
                                    <tr  class="td-gambarsc">
                                        <th class="title"> Gambarsc: </th>
                                        <td class="value"> <?php echo $data['gambarsc']; ?></td>
                                    </tr>
                                    <tr  class="td-pilihan_layanansc">
                                        <th class="title"> Pilihan Layanansc: </th>
                                        <td class="value"> <?php echo $data['pilihan_layanansc']; ?></td>
                                    </tr>
                                    <tr  class="td-durasi_layanansc">
                                        <th class="title"> Durasi Layanansc: </th>
                                        <td class="value"> <?php echo $data['durasi_layanansc']; ?></td>
                                    </tr>
                                    <tr  class="td-harga_layanansc">
                                        <th class="title"> Harga Layanansc: </th>
                                        <td class="value"> <?php echo $data['harga_layanansc']; ?></td>
                                    </tr>
                                    <tr  class="td-contoh_layanan">
                                        <th class="title"> Contoh Layanan: </th>
                                        <td class="value"> <?php echo $data['contoh_layanan']; ?></td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
                            <div class="dropup export-btn-holder mx-1">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">save</i> CETAK
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
                                    <a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                        <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
                                        </a>
                                        <?php $export_pdf_link = $this->set_current_page_link(array('format' => 'pdf')); ?>
                                        <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                                            <img src="<?php print_link('assets/images/pdf.png') ?>" class="mr-2" /> PDF
                                            </a>
                                        </div>
                                    </div>
                                    <a class="btn btn-sm btn-info"  href="<?php print_link("layanansc/edit/$rec_id"); ?>">
                                        <i class="material-icons">edit</i> EDIT DATA
                                    </a>
                                    <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("layanansc/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Yakin menghapus data ini ?" data-display-style="modal">
                                        <i class="material-icons">clear</i> HAPUS DATA
                                    </a>
                                </div>
                                <?php
                                }
                                else{
                                ?>
                                <!-- Empty Record Message -->
                                <div class="text-muted p-3">
                                    <i class="material-icons">block</i> No Record Found
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
