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
                <div class="col-sm-7 col-border alert-primary col-radius comp-grid">
                    <div  class="">
                        <div class="container-fluid">
                            <div class="row justify-content-center">
                                <div class="col comp-grid">
                                    <h3 class="mt-2 mb-3 font-weight-bold text-center">DATA USER</h3>
                                    <a  class="btn btn-primary mb-2" href="<?php print_link("user/add") ?>">
                                        <i class="material-icons ">add</i>                              
                                        TAMBAH USER 
                                    </a>
                                    <?php $this :: display_page_errors(); ?>
                                    <div  class=" animated fadeIn page-content">
                                        <div id="user-list-records">
                                            <div id="page-report-body" class="table-fixed">
                                                <table class="table  table-striped table-sm text-justified table-bordered">
                                                    <thead class="table-header bg-light">
                                                        <tr>
                                                            <th class="td-sno">#</th>
                                                            <th  class="td-nama"> NAMA</th>
                                                            <th  class="td-username"> USERNAME</th>
                                                            <th  class="td-email"> EMAIL</th>
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
                                                        $rec_id = (!empty($data['id_user']) ? urlencode($data['id_user']) : null);
                                                        $counter++;
                                                        ?>
                                                        <tr>
                                                            <th class="td-sno"><?php echo $counter; ?></th>
                                                            <td class="td-nama"> <?php echo $data['nama']; ?></td>
                                                            <td class="td-username"> <?php echo $data['username']; ?></td>
                                                            <td class="td-email"><a href="<?php print_link("mailto:$data[email]") ?>"><?php echo $data['email']; ?></a></td>
                                                            <th class="td-btn">
                                                                <a class="btn btn-sm btn-info has-tooltip page-modal" title="Edit This Record" href="<?php print_link("user/edit/$rec_id"); ?>">
                                                                    <i class="material-icons">edit</i> EDIT
                                                                </a>
                                                                <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("user/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Yakin menghapus data ini ?" data-display-style="modal">
                                                                    <i class="material-icons">clear</i>
                                                                    HAPUS
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
                                                            <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("user/delete/{sel_ids}/?csrf_token=$csrf_token&redirect=$current_page"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
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
