
    
<section class="content">
    <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row clearfix">
                 
            <div class="col-xs-12   col-sm-12  col-md-12   col-lg-12 ">
                <ol class="breadcrumb breadcrumb-bg-indigo align-left">
                    <li><a href="<?=base_url()?>"><i class="material-icons">apps</i> Beranda</a></li>
                    <li> <i class="material-icons">assignment</i> Kelola Data Penialaian </li> 
                </ol>
                <div class="card">
                      <div class="header">
                            <center><h2>KELOLA DATA PENIALAIAN</h2></center>                          
                        </div>
                        <div class="body">
                         

                            <div class="table-responsive">
                                 <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>   
                                            <th>No.</th> 
                                            <th>Bulan</th>
                                            <th>Tahun</th>   
                                            <th>Status</th>        
                                            <th>Aksi</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                      <?php 
                                       $i = 1; 
                                       foreach ($list_penilaian as $row): ?> 
                                          <tr>   
                                              <td><?=$i++?> </td>  
                                              <td>
                                                <?php
                                                    if ($row->bulan == 1) {
                                                      echo "Januari";
                                                    }elseif($row->bulan == 2){
                                                      echo "Februari";
                                                    }elseif($row->bulan == 3){
                                                      echo "Maret";
                                                    }elseif($row->bulan == 4){
                                                      echo "April";
                                                    }elseif($row->bulan == 5){
                                                      echo "Mei";
                                                    }elseif($row->bulan == 6){
                                                      echo "Juni";
                                                    }elseif($row->bulan == 7){
                                                      echo "Juli";
                                                    }elseif($row->bulan == 8){
                                                      echo "Agustus";
                                                    }elseif($row->bulan == 9){
                                                      echo "September";
                                                    }elseif($row->bulan == 10){
                                                      echo "Oktober";
                                                    }elseif($row->bulan == 11){
                                                      echo "November";
                                                    }elseif($row->bulan == 12){
                                                      echo "Desember";
                                                    }

                                                  ?>
                                              </td> 
                                              <td>
                                                 <?=$row->tahun?>
                                              </td>  
                                              <td>
                                              <?php
                                                if ($row->status == 1) {
                                                  echo "Proses Input Nilai";
                                                }else{
                                                  echo "Selesai";
                                                }

                                              ?></td>    
                                              
                                               <td style="vertical-align: middle;">
                                                  <a href="<?=base_url('pengawas/penilaian/'.$row->id_penilaian)?>"> 
                                                       <button class="btn bg-indigo">Lihat Detail</button>
                                                   </a>
                                               </td>        
                                          </tr>
                                      <?php endforeach; ?>
                                    </tbody>
                                </table>

     
                            </div>
                        </div>
                    </div>
            </div>
           
          </div>
        </div>
    </section> 