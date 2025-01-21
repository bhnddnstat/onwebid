<?php
$comp_model = new SharedController;
$page_element_id = "add-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="add"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="p-2">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-7 col-border alert-primary col-radius ">
                    <h3 class="mt-2 mb-3 font-weight-bold text-center">TAMBAH DATA LAYANAN</h3>
                

                    <?php $this :: display_page_errors(); ?>
                    <div  class="card p-3 animated fadeIn page-content">
                        <form id="layanan-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="<?php print_link("layanan/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="gambar">GAMBAR LAYANAN <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                <div class="dropzone required" input="#ctrl-gambar" fieldname="gambar"    data-multiple="false" dropmsg="Geser dan arahkan file kesini"    btntext="Browse" filesize="3" maximum="1">
                                                    <input name="gambar" id="ctrl-gambar" required="" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('gambar',""); ?>" type="text"  />
                                                        <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                        <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="pilihan_layanan">PILIHAN LAYANAN <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input id="ctrl-pilihan_layanan"  value="<?php  echo $this->set_field_value('pilihan_layanan',""); ?>" type="text" placeholder="Masukkan pilihan layanan"  required="" name="pilihan_layanan"  class="form-control " />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="durasi_layanan">DURASI LAYANAN <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input id="ctrl-durasi_layanan"  value="<?php  echo $this->set_field_value('durasi_layanan',""); ?>" type="text" placeholder="Masukkan durasi layanan"  required="" name="durasi_layanan"  class="form-control " />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="harga_layanan">HARGA LAYANAN <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <input id="ctrl-harga_layanan"  value="<?php  echo $this->set_field_value('harga_layanan',""); ?>" type="number" placeholder="Masukkan harga layanan" step="1"  required="" name="harga_layanan"  class="form-control " />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="contoh_layanan">CONTOH LAYANAN <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <input id="ctrl-contoh_layanan"  value="<?php  echo $this->set_field_value('contoh_layanan',""); ?>" type="url" placeholder="Masukkan link contoh"  required="" name="contoh_layanan"  class="form-control " />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group form-submit-btn-holder text-center mt-3">
                                                    <div class="form-ajax-status"></div>
                                                    <button class="btn btn-primary" type="submit">
                                                        TAMBAH
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
