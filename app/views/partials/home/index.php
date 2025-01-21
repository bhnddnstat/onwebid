<?php 
$page_id = null;
$comp_model = new SharedController;
$current_page = $this->set_current_page_link();
?>
<div>
    <div  class="mb-3">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-6 comp-grid">
                    <div class="">
                        <div class="mb-2 text-center" style="pointer-events: none;">
                            <img src="assets/images/favicon.png" width="100" height="100" alt="Favicon">
                            </div>
                        </div><h2 class="text-center font-weight-bold mb-1">TOKO ONWEB ID</h2>
                        <div class=""><div class="text-center">
                            <h5>Solusi Digital untuk Kebutuhan Anda!</h5> <br>
                                <h6 class="text-justify">
                                    Kami menyediakan berbagai layanan digital mulai dari pembuatan website untuk sekolah, usaha, dan pemerintahan hingga toko online, undangan digital, website PPOB & SMM, sistem absensi online, website penerimaan peserta didik baru (PPDB), layanan hosting RDM Madrasah, ujian online berbasis Computer Based Test (CBT) untuk semua jenjang sekolah atau madrasah, dan masih banyak lagi. Temukan layanan yang tepat untuk Anda dan nikmati kemudahan serta keandalan teknologi digital bersama kami.
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div  class="mb-2">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col comp-grid">
                        <div class=" ">
                            <?php  
                            $this->render_page("layanan/cuslistlayanan?limit_count=200" , array( 'show_footer' => false,'show_pagination' => false )); 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div  class="mb-2">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-sm-6 comp-grid">
                        <div class=""><div>
                            <p class="font-weight-bold mt-4"><marquee class="custom-marquee">TEMUKAN POTONGAN HARGA DI SETIAP TANGGAL TERTENTU !!!</marquee></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  class="mb-2">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 comp-grid">
                    <div class=" ">
                        <?php  
                        $this->render_page("layanansc/cuslistlayanansc?limit_count=200" , array( 'show_footer' => false,'show_pagination' => false )); 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
