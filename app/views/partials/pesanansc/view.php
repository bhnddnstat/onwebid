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
    <div  class="p-2">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-7 col-border alert-primary col-radius ">
                    <h3 class="mt-2 mb-3 font-weight-bold text-center">RINCIAN PESANAN SC</h3>
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card p-3 animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['id_pesanansc']) ? urlencode($data['id_pesanansc']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-bordered table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-tanggal_pesanansc">
                                        <th class="title"> TANGGAL PESANAN: </th>
                                        <td class="value"> <?php echo $data['tanggal_pesanansc']; ?></td>
                                    </tr>
                                    <tr  class="td-kode_pesanansc">
                                        <th class="title"> KODE PESANAN </th>
                                        <td class="value"><?php
                                            $tanggal = date("d", strtotime($data['tanggal_pesanansc']));
                                            $bulan = date("m", strtotime($data['tanggal_pesanansc']));
                                            $data['kode_pesanansc'] = "ONWEBIDSC-{$tanggal}{$bulan}-{$data['id_pesanansc']}";
                                        echo $data['kode_pesanansc']; ?></td>
                                    </tr>
                                    <tr  class="td-nama_pemesansc">
                                        <th class="title"> NAMA PEMESAN </th>
                                        <td class="value"><?php echo $data['nama_pemesansc']; ?></td>
                                    </tr>
                                    <tr  class="td-kontak_pemesansc">
                                        <th class="title"> KONTAK PEMESAN </th>
                                        <td class="value"><?php echo $data['kontak_pemesansc']; ?></td>
                                    </tr>
                                    <tr  class="td-email_pemesansc">
                                        <th class="title"> EMAIL PEMESAN </th>
                                        <td class="value"><?php echo $data['email_pemesansc']; ?></td>
                                    </tr>
                                    <tr  class="td-pilihan_pesanansc">
                                        <th class="title"> PILIHAN PESANAN </th>
                                        <td class="value"><?php echo $data['pilihan_pesanansc']; ?></td>
                                    </tr>
                                    <tr  class="td-harga_pesanansc">
                                        <th class="title"> HARGA PESANAN </th>
                                        <td class="value"><strong><?php echo $data['harga_pesanansc']; ?></strong></td>
                                    </tr>
                                    <tr  class="td-durasi_pesanansc">
                                        <th class="title"> DURASI PESANAN </th>
                                        <td class="value"><?php echo $data['durasi_pesanansc']; ?></td>
                                    </tr>
                                    <?php
                                    $durasi_pesanansc = $data['durasi_pesanansc']; // Asumsikan Anda sudah memiliki variabel ini
                                    $tarif_ppnsc = $data['tarif_ppnsc'];
                                    $style = '';
                                    if ($durasi_pesanansc == 'Selamanya') {
                                    $style = 'style="color: red; text-decoration: line-through;"';
                                    } else
                                    $style = 'style="color: red;"';
                                    ?>
                                    <tr class="td-tarif_ppn">
                                        <th class="title"> TARIF PPN 10% </th>
                                        <td class="value" <?php echo $style; ?>><strong><?php echo $tarif_ppnsc; ?></strong></td>
                                    </tr>
                                    <tr class="td-subtotal_hargasc">
                                        <th class="title">SUBTOTAL HARGA</th>
                                        <td class="value"><strong><?php echo $data['subtotal_hargasc']; ?></strong><span class="icon ceklis"><i class="fas fa-check-circle"></i></span></td>
                                    </tr>
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
                                    <tr  class="td-request_pesanansc">
                                        <th class="title"> REQUEST PESANAN </th>
                                        <td class="value"><?php echo $data['request_pesanansc']; ?></td>
                                    </tr>
                                    <tr  class="td-status_pembayaran">
                                        <th class="title"> STATUS PEMBAYARAN </th>
                                        <td class="value">
                                            <?php if ($data['status_pembayaran'] == "LUNAS") { ?>
                                            <span class="badge badge-success p-2"><?php echo $data['status_pembayaran']; ?></span>
                                            <?php } elseif ($data['status_pembayaran'] == "BELUM LUNAS") { ?>
                                            <span class="badge badge-danger p-2"><?php echo $data['status_pembayaran']; ?></span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
                            <div class="dropup export-btn-holder mx-1">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">save</i> BUKTI PESANAN
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
                                    <a class="btn btn-sm btn-info"  href="<?php print_link("pesanansc/edit/$rec_id"); ?>">
                                        <i class="material-icons">edit</i> EDIT PESANAN
                                    </a>
                                    <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("pesanansc/delete/$rec_id/?csrf_token=$csrf_token"); ?>" data-prompt-msg="Yakin batalkan pesanan ini ?" data-display-style="modal">
                                        <i class="material-icons">clear</i> BATALKAN PESANAN
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
            <?php
            }
            ?>
        </section>
