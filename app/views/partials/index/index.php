        <?php 
        $page_id = null;
        $comp_model = new SharedController;
        ?>
        

<style>
    .navbar { 
        display: none; /* Sembunyikan navbar */ 
    }
    footer { 
        display: none; /* Sembunyikan footer */ 
    }
</style>

        
        <div  class="mb-3">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-sm-6 comp-grid">
                        <div class="">
                            <div class="mb-2 text-center" style="pointer-events: none;">
                                <img src="assets/images/favicon.png" width="100" height="100" alt="Favicon">
                                </div>
                            </div><h2 class="text-center font-weight-bold mb-1">TOKO ONWEB ID</h2>
                            <div class=""><div class="opening text-center">
                                <h5>Solusi Digital untuk Kebutuhan Anda!</h5> <br>
                                    <p class="text-justify">
                                        Menyediakan berbagai layanan digital mulai dari pembuatan website untuk sekolah, usaha, dan pemerintahan hingga toko online, undangan digital, website PPOB & SMM, sistem absensi online, website penerimaan peserta didik baru (PPDB), layanan hosting RDM Madrasah, ujian online berbasis Computer Based Test (CBT) untuk semua jenjang sekolah atau madrasah, dan berbagai jenis layanan lainnya.
                                    </p>
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
        <div  class="mb-5">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col comp-grid">
                        <div class=" ">
                            <?php  
                            $this->render_page("layanansc/cuslistlayanansc?limit_count=200" , array( 'show_footer' => false,'show_pagination' => false )); 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div  class="content-center mb-5">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-sm-6 comp-grid">
                        <div class="">
                            <div class="containers">
                                <div class="tutorial tutor">
                                    <h3 class="font-weight-bold">CARA PEMESANAN</h3> <br><br>
                                        <p class="numbered-step">Cari pilihan layanan yang diinginkan</p>
                                        <p class="numbered-step">Tekan tombol pesan layanan</p>
                                        <p class="numbered-step">Mengisi formulir pesanan</p>
                                        <p class="numbered-step">Lakukan pembayaran sesuai harga</p>
                                        <p class="numbered-step">Tekan tombol konfirmasi</p>
                                        <p class="numbered-step">Admin akan memproses pesanan</p>
                                        <p class="numbered-step">Layanan siap digunakan</p>
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
        <div  class="content-center mb-3">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-sm-6 comp-grid">
                            <div class="">
                                <div class="col ">
                                    <h3 class="record-title text-center font-weight-bold mb-3 mt-3">INFO KONTAK</h3>
                                </div>
                                <div class="col-md-12 comp-grid">
                                    <div class=""><div class="text-center">
                                        <div class="row">
                                            <div class="col-sm-4 mb-2">
                                                <div class="">
                                                    <div class="kontak p-2">
                                                        <img src="https://img.icons8.com/bubbles/100/000000/phone.png" alt="Phone Icon" width="50" height="50">
                                                            <h6>0812-5517-3749 <br> 0813-5030-2764</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 mb-2">
                                                        <div class="">
                                                            <div class="kontak p-2">
                                                                <img src="https://img.icons8.com/bubbles/100/000000/new-post.png" alt="Email Icon" width="50" height="50">
                                                                    <h6>admin@onweb.id <br> cscustore@gmail.com</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 mb-2">
                                                                <div class="">
                                                                    <div class="kontak p-2">
                                                                        <img src="https://img.icons8.com/bubbles/100/000000/map-marker.png" alt="Address Icon" width="50" height="50">
                                                                            <h6>Jln. Yos Sudarso RT 006 <br>
                                                                            Kec.Sebatik, Kab.Nunukan</h6>
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
                                </div>
                            </div>
                            <div  class="">
                                <div class="container-fluid">
                                    <div class="row ">
                                        <div class="col-md-12 comp-grid">
                                            <div class="">
                                                <div>
                                                    <div>
                                                        <?php Html::page_link('home', '<button class="login-button"><i class="fas fa-user"></i>Admin</button>'); ?>
                                                    </div>
                                                    <script>
                                                        var link = document.createElement('link');
                                                        link.rel = 'stylesheet';
                                                        link.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css';
                                                        document.head.appendChild(link);
                                                    </script>
                                                </div>
                                                </div>
                                                
                                            <div class="">
                                                <div>
                                                    <button class="whatsapp-button" id="whatsapp-button">
                                                    <i class="fab fa-whatsapp"></i> Bantuan</button>
                                                </div>
                                                <script>
                                                    if (!document.querySelector('link[href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"]')) {
                                                        var newLink = document.createElement('link');
                                                        newLink.rel = 'stylesheet';
                                                        newLink.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css';
                                                        document.head.appendChild(newLink);
                                                    }
                                                    
                                                    document.getElementById('whatsapp-button').addEventListener('click', function() {
                                                        var phoneNumber = '6282197028450';
                                                        var defaultMessage = 'Halo, saya ingin konfirmasi pesanan atas nama: ';
                                                        var whatsappUrl = 'https://wa.me/' + phoneNumber + '?text=' + encodeURIComponent(defaultMessage);
                                                        window.open(whatsappUrl, '_blank');
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
<div class="footer col-sm-6 border-top mx-auto" style="background-color: #1440b8; color: #ecf0f1; padding: 20px 0; text-align: center; border-radius: 5px">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="copyright">
                    &copy; <?php echo date('Y'); ?> TOKO ONWEB ID & All Team.
                </div>
            </div>
        </div>
    </div>
</div>
                        