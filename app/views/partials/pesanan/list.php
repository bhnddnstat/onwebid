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
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="p-2">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col col-border alert-primary col-radius comp-grid">
                    <div  class="">
                        <div class="container-fluid">
                            <div class="row justify-content-center">
                                <div class="col comp-grid">
                                    <h3 class="mt-2 mb-3 font-weight-bold text-center">DATA PESANAN</h3>
                                    <a  class="btn btn-primary mb-2" href="<?php print_link("pesanan/add") ?>">
                                        <i class="material-icons">add</i>                               
                                        TAMBAH PESANAN 
                                    </a>
                                    <?php $this :: display_page_errors(); ?>
                                    <div  class=" animated fadeIn page-content">
                                        <div id="pesanan-list-records">
                                            <div id="page-report-body" class="table-fixed">
                                                <table class="table  table-striped table-sm text-justified table-bordered">
                                                    <thead class="table-header bg-light">
                                                        <tr>
                                                            <th class="td-sno">#</th>
                                                            <th  class="td-tanggal_pesanan"> TANGGAL PESANAN</th>
                                                            <th  class="td-kode_pesanan"> KODE PESANAN</th>
                                                            <th  class="td-nama_pemesan"> NAMA PEMESAN</th>
                                                            <th  class="td-kontak_pemesan"> KONTAK PEMESAN</th>
                                                            <th  class="td-pilihan_pesanan"> PILIHAN PESANAN</th>
                                                            <th  class="td-durasi_pesanan"> DURASI PESANAN</th>
                                                            <th  class="td-status_pembayaran"> PEMBAYARAN</th>
                                                            <th class="td-btn"></th>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                    if(!empty($records)){
                                                    ?>
                                                    <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                                        <!--record-->
                                                        <?php
                                                        $counter = 0;
                                                        foreach($records as $data){
                                                        $rec_id = (!empty($data['id_pesanan']) ? urlencode($data['id_pesanan']) : null);
                                                        $counter++;
                                                        ?>
                                                        <tr>
                                                            <th class="td-sno"><?php echo $counter; ?></th>
                                                            <td class="td-tanggal_pesanan"> <?php echo $data['tanggal_pesanan']; ?></td>
                                                            <td class="td-kode_pesanan"><span><?php
                                                                $tanggal = date("d", strtotime($data['tanggal_pesanan']));
                                                                $bulan = date("m", strtotime($data['tanggal_pesanan']));
                                                                $data['kode_pesanan'] = "ONWEBID-{$tanggal}{$bulan}-{$data['id_pesanan']}";
                                                            echo $data['kode_pesanan']; ?></span></td>
                                                            <td class="td-nama_pemesan"> <?php echo $data['nama_pemesan']; ?></td>
                                                            <td class="td-kontak_pemesan"> <?php echo $data['kontak_pemesan']; ?></td>
                                                            <td class="td-pilihan_pesanan"> <?php echo $data['pilihan_pesanan']; ?></td>
                                                            <td class="td-durasi_pesanan"> <span><?php echo $data['durasi_pesanan']; ?> Bulan</span></td>
                                                            <td class="td-status_pembayaran">    <?php if ($data['status_pembayaran'] == "LUNAS") { ?>
                                                                <span class="badge badge-success p-2"><?php echo $data['status_pembayaran']; ?></span>
                                                                <?php } elseif ($data['status_pembayaran'] == "BELUM LUNAS") { ?>
                                                                <span class="badge badge-danger p-2"><?php echo $data['status_pembayaran']; ?></span>
                                                                <?php } ?>
                                                            </td>
                                                            <th class="td-btn">
                                                                <a class="btn btn-sm btn-success has-tooltip" title="View Record" href="<?php print_link("pesanan/view/$rec_id"); ?>">
                                                                    <i class="material-icons">visibility</i> 
                                                                </a>
                                                                <a class="btn btn-sm btn-info has-tooltip" title="Edit This Record" href="<?php print_link("pesanan/edit/$rec_id"); ?>">
                                                                    <i class="material-icons">edit</i> 
                                                                </a>
                                                                <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("pesanan/delete/$rec_id/?csrf_token=$csrf_token"); ?>" data-prompt-msg="Yakin batalkan pesanan ini ?" data-display-style="modal">
                                                                    <i class="material-icons">clear</i>
                                                                </a>
                                                            </th>
                                                        </tr>
                                                        <?php 
                                                        }
                                                        ?>
                                                        <!--endrecord-->
                                                    </tbody>
                                                    <tbody class="search-data" id="search-data-<?php echo $page_element_id; ?>"></tbody>
                                                    <?php
                                                    }
                                                    ?>
                                                </table>
                                                <?php 
                                                if(empty($records)){
                                                ?>
                                                <h4 class="bg-light text-center border-top text-muted animated bounce  p-3">
                                                    <i class="material-icons">block</i> DATA MASIH KOSONG
                                                </h4>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <?php
                                            if( $show_footer && !empty($records)){
                                            ?>
                                            <div class=" border-top mt-2">
                                                <div class="row justify-content-center">    
                                                    <div class="col-md-auto justify-content-center">    
                                                        <div class="p-3 d-flex justify-content-between">    
                                                            <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("pesanan/delete/{sel_ids}/?csrf_token=$csrf_token"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                                                                <i class="material-icons">clear</i> Delete Selected
                                                            </button>
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
                                                                </div>
                                                            </div>
                                                            <div class="col">   
                                                            </div>
                                                        </div>
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
