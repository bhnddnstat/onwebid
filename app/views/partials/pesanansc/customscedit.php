<?php
$comp_model = new SharedController;
$page_element_id = "edit-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="edit"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="p-2">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-7 col-border form-color col-radius ">
                    <h3 class="mt-2 mb-3 font-weight-bold text-center">EDIT PESANAN SC</h3>
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card p-3 forms-color animated fadeIn page-content">
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("pesanansc/customscedit/$page_id/?csrf_token=$csrf_token"); ?>" method="post">
                            <div>
                                <input id="ctrl-tanggal_pesanansc"  value="<?php  echo $data['tanggal_pesanansc']; ?>" type="hidden" placeholder="Enter Tanggal Pesanansc"  required="" name="tanggal_pesanansc"  class="form-control " />
                                    <input id="ctrl-kode_pesanansc"  value="<?php  echo $data['kode_pesanansc']; ?>" type="hidden" placeholder="Masukkan kode pesanan"  name="kode_pesanansc"  class="form-control " />
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="nama_pemesansc">NAMA PEMESAN <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input id="ctrl-nama_pemesansc"  value="<?php  echo $data['nama_pemesansc']; ?>" type="text" placeholder="Masukkan nama pemesan"  required="" name="nama_pemesansc"  class="form-control " />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="kontak_pemesansc">KONTAK PEMESAN <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <input id="ctrl-kontak_pemesansc"  value="<?php  echo $data['kontak_pemesansc']; ?>" type="text" placeholder="Masukkan kontak pemesan"  required="" name="kontak_pemesansc"  class="form-control " />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="email_pemesansc">EMAIL PEMESAN <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <input id="ctrl-email_pemesansc"  value="<?php  echo $data['email_pemesansc']; ?>" type="email" placeholder="Masukkan email pemesan"  required="" name="email_pemesansc"  class="form-control " />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label" for="pilihan_pesanansc">PILIHAN PESANAN <span class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="">
                                                                    <select required=""  id="ctrl-pilihan_pesanansc" name="pilihan_pesanansc"  placeholder="Pilih jenis pesanan"    class="custom-select" >
                                                                        <option value="">Pilih jenis pesanan</option>
                                                                        <?php
                                                                        $rec = $data['pilihan_pesanansc'];
                                                                        $pilihan_pesanansc_options = $comp_model -> pesanansc_pilihan_pesanansc_option_list();
                                                                        if(!empty($pilihan_pesanansc_options)){
                                                                        foreach($pilihan_pesanansc_options as $option){
                                                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                        $selected = ( $value == $rec ? 'selected' : null );
                                                                        ?>
                                                                        <option 
                                                                            <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $label; ?>
                                                                        </option>
                                                                        <?php
                                                                        }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label" for="harga_pesanansc">HARGA PESANAN <span class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="">
                                                                    <input id="ctrl-harga_pesanansc"  value="<?php  echo $data['harga_pesanansc']; ?>" type="text" placeholder=" "  readonly required="" name="harga_pesanansc"  class="form-control " />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" for="durasi_pesanansc">DURASI PESANAN <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="">
                                                                        <input id="ctrl-durasi_pesanansc"  value="<?php  echo $data['durasi_pesanansc']; ?>" type="text" placeholder=" "  readonly required="" name="durasi_pesanansc"  class="form-control " />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label" for="tarif_ppnsc">TARIF PPN 10% <span class="text-danger">*</span></label>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <div class="">
                                                                            <input id="ctrl-tarif_ppnsc"  value="<?php  echo $data['tarif_ppnsc']; ?>" type="text" placeholder=" "  readonly required="" name="tarif_ppnsc"  class="form-control " />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group ">
                                                                    <div class="row">
                                                                        <div class="col-sm-4">
                                                                            <label class="control-label" for="subtotal_hargasc">SUBTOTAL HARGA <span class="text-danger">*</span></label>
                                                                        </div>
                                                                        <div class="col-sm-8">
                                                                            <div class="">
                                                                                <input id="ctrl-subtotal_hargasc"  value="<?php  echo $data['subtotal_hargasc']; ?>" type="text" placeholder=" "  readonly required="" name="subtotal_hargasc"  class="form-control " />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group ">
                                                                        <div class="row">
                                                                            <div class="col-sm-4">
                                                                                <label class="control-label" for="request_pesanansc">REQUEST PESANAN <span class="text-danger">*</span></label>
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                                <div class="">
                                                                                    <textarea placeholder="Kosongkan jika tidak ada request" id="ctrl-request_pesanansc"  required="" rows="5" name="request_pesanansc" class=" form-control"><?php  echo $data['request_pesanansc']; ?></textarea>
                                                                                    <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-ajax-status"></div>
                                                                <div class="form-group text-center">
                                                                    <button class="btn btn-primary" type="submit">
                                                                        LANJUTKAN
                                                                        <i class="material-icons">send</i>
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                    </section>
