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
                    <h3 class="mt-2 mb-3 font-weight-bold text-center">EDIT PESANAN</h3>
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card p-3 forms-color animated fadeIn page-content">
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("pesanan/customedit/$page_id/?csrf_token=$csrf_token"); ?>" method="post">
                            <div>
                                <input id="ctrl-tanggal_pesanan"  value="<?php  echo $data['tanggal_pesanan']; ?>" type="hidden" placeholder=" "  readonly required="" name="tanggal_pesanan"  class="form-control " />
                                    <input id="ctrl-kode_pesanan"  value="<?php  echo $data['kode_pesanan']; ?>" type="hidden" placeholder="Enter Kode Pesanan"  name="kode_pesanan"  class="form-control " />
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="nama_pemesan">NAMA PEMESAN <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input id="ctrl-nama_pemesan"  value="<?php  echo $data['nama_pemesan']; ?>" type="text" placeholder="Masukkan nama pemesan"  required="" name="nama_pemesan"  class="form-control " />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="kontak_pemesan">KONTAK PEMESAN <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <input id="ctrl-kontak_pemesan"  value="<?php  echo $data['kontak_pemesan']; ?>" type="number" placeholder="Masukkan kontak pemesan" step="1"  required="" name="kontak_pemesan"  class="form-control " />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="email_pemesan">EMAIL PEMESAN <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <input id="ctrl-email_pemesan"  value="<?php  echo $data['email_pemesan']; ?>" type="email" placeholder="Masukkan email pemesan"  required="" name="email_pemesan"  class="form-control " />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label" for="pilihan_pesanan">PILIHAN LAYANAN <span class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="">
                                                                    <select required=""  id="ctrl-pilihan_pesanan" name="pilihan_pesanan"  placeholder="Pilih jenis layanan"    class="custom-select" >
                                                                        <option value="">Pilih jenis layanan</option>
                                                                        <?php
                                                                        $rec = $data['pilihan_pesanan'];
                                                                        $pilihan_pesanan_options = $comp_model -> pesanan_pilihan_pesanan_option_list();
                                                                        if(!empty($pilihan_pesanan_options)){
                                                                        foreach($pilihan_pesanan_options as $option){
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
                                                                <label class="control-label" for="harga_pesanan">HARGA PESANAN <span class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="">
                                                                    <input id="ctrl-harga_pesanan"  value="<?php  echo $data['harga_pesanan']; ?>" type="text" placeholder=" "  readonly required="" name="harga_pesanan"  class="form-control " />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" for="durasi_pesanan">DURASI LAYANAN <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="">
                                                                        <select required=""  id="ctrl-durasi_pesanan" name="durasi_pesanan"  placeholder="Pilih durasi layanan"    class="custom-select" >
                                                                            <option value="">Pilih durasi layanan</option>
                                                                            <?php
                                                                            $durasi_pesanan_options = Menu :: $durasi_pesanan;
                                                                            $field_value = $data['durasi_pesanan'];
                                                                            if(!empty($durasi_pesanan_options)){
                                                                            foreach($durasi_pesanan_options as $option){
                                                                            $value = $option['value'];
                                                                            $label = $option['label'];
                                                                            $selected = ( $value == $field_value ? 'selected' : null );
                                                                            ?>
                                                                            <option <?php echo $selected ?> value="<?php echo $value ?>">
                                                                                <?php echo $label ?>
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
                                                                    <label class="control-label" for="tarif_ppn">TARIF PPN 12% <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="">
                                                                        <input id="ctrl-tarif_ppn"  value="<?php  echo $data['tarif_ppn']; ?>" type="text" placeholder=" "  readonly required="" name="tarif_ppn"  class="form-control " />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label" for="subtotal_harga">SUBTOTAL HARGA <span class="text-danger">*</span></label>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <div class="">
                                                                            <input id="ctrl-subtotal_harga"  value="<?php  echo $data['subtotal_harga']; ?>" type="text" placeholder=" "  readonly required="" name="subtotal_harga"  class="form-control " />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group ">
                                                                    <div class="row">
                                                                        <div class="col-sm-4">
                                                                            <label class="control-label" for="request_pesanan">REQUEST PESANAN </label>
                                                                        </div>
                                                                        <div class="col-sm-8">
                                                                            <div class="">
                                                                                <textarea placeholder="Kosongkan jika tidak ada request" id="ctrl-request_pesanan"  rows="5" name="request_pesanan" class=" form-control"><?php  echo $data['request_pesanan']; ?></textarea>
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
