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
                                    <h3 class="mt-2 mb-3 font-weight-bold text-center">DATA PESANAN SC</h3>
                                    <a  class="btn btn-primary mb-2" href="<?php print_link("pesanansc/add") ?>">
                                        <i class="material-icons">add</i>                               
                                        TAMBAH PESANAN SC 
                                    </a>
                                    <?php $this :: display_page_errors(); ?>
                                    <div  class=" animated fadeIn page-content">
                                        <div id="pesanansc-list-records">
                                            <div id="page-report-body" class="table-fixed">
                                                <table class="table  table-striped table-sm text-justified table-bordered">
                                                    <thead class="table-header bg-light">
                                                        <tr>
                                                            <th class="td-sno">#</th>
                                                            <th  class="td-tanggal_pesanansc"> TANGGAL PESANAN</th>
                                                            <th  class="td-kode_pesanansc"> KODE PESANAN</th>
                                                            <th  class="td-nama_pemesansc"> NAMA PEMESAN</th>
                                                            <th  class="td-kontak_pemesansc"> KONTAK PEMESAN</th>
                                                            <th  class="td-pilihan_pesanansc"> PILIHAN PESANAN</th>
                                                            <th  class="td-durasi_pesanansc"> DURASI PESANAN</th>
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
                                                        $rec_id = (!empty($data['id_pesanansc']) ? urlencode($data['id_pesanansc']) : null);
                                                        $counter++;
                                                        ?>
                                                        <tr>
                                                            <th class="td-sno"><?php echo $counter; ?></th>
                                                            <td class="td-tanggal_pesanansc"> <?php echo $data['tanggal_pesanansc']; ?></td>
                                                            <td class="td-kode_pesanansc">
                                                                <span><?php
                                                                    $tanggal = date("d", strtotime($data['tanggal_pesanansc']));
                                                                    $bulan = date("m", strtotime($data['tanggal_pesanansc']));
                                                                    $data['kode_pesanansc'] = "ONWEBIDSC-{$tanggal}{$bulan}-{$data['id_pesanansc']}";
                                                                echo $data['kode_pesanansc']; ?></span></td>
                                                                <td class="td-nama_pemesansc"> <?php echo $data['nama_pemesansc']; ?></td>
                                                                <td class="td-kontak_pemesansc"> <?php echo $data['kontak_pemesansc']; ?></td>
                                                                <td class="td-pilihan_pesanansc"> <?php echo $data['pilihan_pesanansc']; ?></td>
                                                                <td class="td-durasi_pesanansc"> <?php echo $data['durasi_pesanansc']; ?></td>
                                                                <td class="td-status_pembayaran">
                                                                    <?php if ($data['status_pembayaransc'] == "LUNAS") { ?>
                                                                    <span class="badge badge-success p-2"><?php echo $data['status_pembayaransc']; ?></span>
                                                                    <?php } elseif ($data['status_pembayaransc'] == "BELUM LUNAS") { ?>
                                                                    <span class="badge badge-danger p-2"><?php echo $data['status_pembayaransc']; ?></span>
                                                                    <?php } ?>
                                                                </td>
                                                                <th class="td-btn">
                                                                    <a class="btn btn-sm btn-success has-tooltip" title="View Record" href="<?php print_link("pesanansc/view/$rec_id"); ?>">
                                                                        <i class="material-icons">visibility</i> 
                                                                    </a>
                                                                    <a class="btn btn-sm btn-info has-tooltip" title="Edit This Record" href="<?php print_link("pesanansc/edit/$rec_id"); ?>">
                                                                        <i class="material-icons">edit</i> 
                                                                    </a>
                                                                    <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("pesanansc/delete/$rec_id/?csrf_token=$csrf_token"); ?>" data-prompt-msg="Yakin batalkan pesanan ini ?" data-display-style="modal">
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
                                                                <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("pesanansc/delete/{sel_ids}/?csrf_token=$csrf_token"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                                                                    <i class="material-icons">clear</i> Delete Selected
                                                                </button>
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
