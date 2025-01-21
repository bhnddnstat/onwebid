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
                <div class="col-sm-7 col-border form-color col-radius ">
                    <h3 class="mt-2 mb-3 font-weight-bold text-center">RINCIAN PESANAN</h3>
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card p-3 forms-color animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['id_pesanan']) ? urlencode($data['id_pesanan']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table  table-bordered table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-tanggal_pesanan">
                                        <th class="title"> TANGGAL PESANAN: </th>
                                        <td class="value"> <?php echo $data['tanggal_pesanan']; ?></td>
                                    </tr>
                                    <tr  class="td-kode_pesanan">
                                        <th class="title"> KODE PESANAN </th>
                                        <td class="value"><?php
                                            $tanggal = date("d", strtotime($data['tanggal_pesanan']));
                                            $bulan = date("m", strtotime($data['tanggal_pesanan']));
                                            $data['kode_pesanan'] = "ONWEBID-{$tanggal}{$bulan}-{$data['id_pesanan']}";
                                        echo $data['kode_pesanan']; ?></td>
                                    </tr>
                                    <tr  class="td-nama_pemesan">
                                        <th class="title"> NAMA PEMESAN </th>
                                        <td class="value"><?php echo $data['nama_pemesan']; ?></td>
                                    </tr>
                                    <tr  class="td-kontak_pemesan">
                                        <th class="title"> KONTAK PEMESAN </th>
                                        <td class="value"><?php echo $data['kontak_pemesan']; ?></td>
                                    </tr>
                                    <tr  class="td-email_pemesan">
                                        <th class="title"> EMAIL PEMESAN </th>
                                        <td class="value"><?php echo $data['email_pemesan']; ?></td>
                                    </tr>
                                    <tr  class="td-pilihan_pesanan">
                                        <th class="title"> PILIHAN LAYANAN </th>
                                        <td class="value"><?php echo $data['pilihan_pesanan']; ?></td>
                                    </tr>
                                    <tr  class="td-harga_pesanan">
                                        <th class="title"> HARGA LAYANAN </th>
                                        <td class="value"><strong><?php echo $data['harga_pesanan']; ?></strong></td>
                                    </tr>
                                    <tr  class="td-durasi_pesanan">
                                        <th class="title"> DURASI LAYANAN </th>
                                        <td class="value"><?php echo $data['durasi_pesanan']; ?> Bulan</td>
                                    </tr>
                                    <?php
                                    $durasi_pesanan = $data['durasi_pesanan']; // Asumsikan Anda sudah memiliki variabel ini
                                    $tarif_ppn = $data['tarif_ppn'];
                                    $style = '';
                                    if ($durasi_pesanan == 24) {
                                    $style = 'style="color: red; text-decoration: line-through;"';
                                    } else
                                    $style = 'style="color: red;"';
                                    ?>
                                    <tr class="td-tarif_ppn">
                                        <th class="title"> TARIF PPN 12% </th>
                                        <td class="value" <?php echo $style; ?>><strong><?php echo $tarif_ppn; ?></strong></td>
                                    </tr>
                                    <tr class="td-subtotal_harga">
                                        <th class="title">SUBTOTAL HARGA</th>
                                        <td class="value"><strong><?php echo $data['subtotal_harga']; ?></strong><span class="icon ceklis"><i class="fas fa-check-circle"></i></span></td>
                                    </tr>
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
                                    <tr  class="td-request_pesanan">
                                        <th class="title"> REQUEST PESANAN </th>
                                        <td class="value"><?php echo $data['request_pesanan']; ?></td>
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
                        
                        <div class="text-center p-2 mt-4">
                            <a class="btn btn-sm btn-primary" href="<?php print_link("pesanan/customedit/$rec_id"); ?>">
                                <i class="material-icons">edit</i><strong>EDIT PESANAN</strong>
                            </a>
                            <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("index"); ?>" data-prompt-msg="Yakin batalkan pesanan ini ?" data-display-style="modal">
                                <i class="material-icons">clear</i><strong>BATALKAN PESANAN</strong>
                            </a>
                        </div>
                        
                        <div  class="content-center mt-5 mb-3">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col p-1 comp-grid">
                        <div class="">
                            <div class="containers">
                                <div class="tutorial tutor">
                                    <h4 class="font-weight-bold">PEMBAYARAN</h4> <br>
                                        <p class="text-center">Silahkan lakukan transaksi sesuai dengan subtotal harga pesanan anda ke nomor rekening di bawah ini :</p><br>
                                        <strong><p class="text-center">BANK MANDIRI : 1490014469755</p></strong>
                                        <strong><p class="text-center">ATAS NAMA : BURHANUDDIN</p></strong><br>
                                        <p class="text-center">Setelah melakukan transaksi, silahkan tekan tombol konfirmasi agar admin segera memproses pembelian layanan. Terima kasih...</p>
                                    </div>
                                    <script>
                                        // Load Font Awesome
                                        const link = document.createElement('link');
                                        link.rel = 'stylesheet';
                                        link.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css';
                                        document.head.appendChild(link);
                                    </script>
                                </div>
                            </div>
                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        <div class="text-center p-3">
                            <a class="btn btn-sm btn-success p-2"  href="https://wa.me/+6281255173749">
                                <i class="material-icons">check</i> <strong>KONFIRMASI</strong>
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
