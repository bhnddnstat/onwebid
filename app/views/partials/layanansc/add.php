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
                    <h3 class="mt-2 mb-3 font-weight-bold text-center">TAMBAH DATA LAYANAN SC</h3>
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card p-3 animated fadeIn page-content">
                        <form id="layanansc-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="<?php print_link("layanansc/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="gambarsc">GAMBAR LAYANAN SC <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                <div class="dropzone required" input="#ctrl-gambarsc" fieldname="gambarsc"    data-multiple="false" dropmsg="Geser dan arahkan file kesini"    btntext="Browse" filesize="3" maximum="1">
                                                    <input name="gambarsc" id="ctrl-gambarsc" required="" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('gambarsc',""); ?>" type="text"  />
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
                                                <label class="control-label" for="pilihan_layanansc">PILIHAN LAYANAN SC <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input id="ctrl-pilihan_layanansc"  value="<?php  echo $this->set_field_value('pilihan_layanansc',""); ?>" type="text" placeholder="Masukkan pilihan layanan sc"  required="" name="pilihan_layanansc"  class="form-control " />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="durasi_layanansc">DURASI LAYANAN SC <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input id="ctrl-durasi_layanansc"  value="<?php  echo $this->set_field_value('durasi_layanansc',""); ?>" type="text" placeholder="Masukkan durasi layanan sc"  required="" name="durasi_layanansc"  class="form-control " />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="harga_layanansc">HARGA LAYANAN SC <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <input id="ctrl-harga_layanansc"  value="<?php  echo $this->set_field_value('harga_layanansc',""); ?>" type="number" placeholder="Masukkan harga layanan sc" step="1"  required="" name="harga_layanansc"  class="form-control " />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="contoh_layanansc">CONTOH LAYANAN SC <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <input id="ctrl-contoh_layanansc"  value="<?php  echo $this->set_field_value('contoh_layanansc',""); ?>" type="url" placeholder="Masukkan link contoh sc"  required="" name="contoh_layanansc"  class="form-control " />
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
