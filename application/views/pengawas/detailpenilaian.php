 
 <section class="content" >
    <div class="container-fluid"> 
        <?= $this->session->flashdata('msg') ?>
        <div class="row clearfix">
          
               
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ol class="breadcrumb breadcrumb-bg-indigo align-left">
                        <li><a href="<?=base_url()?>"><i class="material-icons">apps</i> Beranda</a></li>
                        <li> <a href="<?=base_url('pengawas/penilaian')?>"><i class="material-icons">view_list</i> Kelola Data penilaian</a> </li> 
                        <li> <i class="material-icons">class</i> <?=$penilaian->bulan?>/<?=$penilaian->tahun?></li>  
                    </ol>
                    <div class="card">
                        
                        <div class="body"> 
                            <table class="table table-bordered table-striped table-hover" style="max-height: 300px">

                                <tbody>
                                    
                                     <tr>
                                         <th style="width: 30%">
                                             ID Penilaian
                                         </th>
                                         <td> 
                                          
                                            <?=$penilaian->id_penilaian?>

                                         </td>
                                     </tr>
                                      
                                     <tr>
                                         <th style="width: 30%">
                                             Bulan
                                         </th>
                                         <td> 
                                          
                                           <?php
                                              if ($penilaian->bulan == 1) {
                                                echo "Januari";
                                              }elseif($penilaian->bulan == 2){
                                                echo "Februari";
                                              }elseif($penilaian->bulan == 3){
                                                echo "Maret";
                                              }elseif($penilaian->bulan == 4){
                                                echo "April";
                                              }elseif($penilaian->bulan == 5){
                                                echo "Mei";
                                              }elseif($penilaian->bulan == 6){
                                                echo "Juni";
                                              }elseif($penilaian->bulan == 7){
                                                echo "Juli";
                                              }elseif($penilaian->bulan == 8){
                                                echo "Agustus";
                                              }elseif($penilaian->bulan == 9){
                                                echo "September";
                                              }elseif($penilaian->bulan == 10){
                                                echo "Oktober";
                                              }elseif($penilaian->bulan == 11){
                                                echo "November";
                                              }elseif($penilaian->bulan == 12){
                                                echo "Desember";
                                              }

                                            ?>
 
                                         </td>
                                     </tr> 
                                     <tr>
                                         <th style="width: 30%">
                                             Tahun
                                         </th>
                                         <td> 
                                           <?=$penilaian->tahun?>
                                         </td>
                                     </tr>  
                                     <tr>
                                         <th style="width: 30%">
                                             Status Penilaian
                                         </th>
                                         <td> 
                                           <?php  
                                              $n = $this->Karyawan_m->get_num_row(['']);
                                              echo  $x . ' / ' . $n .' Karyawan ' ;
                                           ?>
                                         </td>
                                     </tr>   
                                   
                                </tbody>

                            </table>   
                         </div>
                    </div>
                    <div class="card">
                      <div class="header">
                            <center><h2>NILAI KARYAWAN</h2></center>                          
                        </div>
                        <div class="body"> 
                            <div class="table-responsive">
                                 <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>   
                                            <th>ID Karyawan</th> 
                                            <th>Nama Karyawan</th> 

                                            <?php  foreach ($list_kriteria as $k): ?> 
                                              <th><?=$k->nama_kriteria?></th>  
                                            <?php endforeach; ?> 
                                        </tr>
                                    </thead> 
                                    <tbody>
                                      <?php 

                                      $i = 1;   
                                      foreach ($list_karyawan as $row): ?> 
                                        <?php if ($this->DP_m->get_num_row(['id_karyawan' => $row->id_karyawan,'id_penilaian' => $penilaian->id_penilaian]) != 0) { ?>
                                          <tr>    
                                              <td><?=$row->id_karyawan?></td>  
                                              <td><?=$row->nama_karyawan?></td>  
                                              <?php  foreach ($list_kriteria as $k): ?> 
                                                <td>
                                                  <?=$this->DP_m->get_row(['id_karyawan' => $row->id_karyawan, 'id_penilaian' => $penilaian->id_penilaian,'id_kriteria' => $k->id_kriteria])->keterangan?>
                                                </td>  
                                              <?php endforeach; ?>
                                                        
                                          </tr>
                                      <?php } endforeach; ?>
                                    </tbody>
                                </table>

     
                            </div>
                        </div>
                    </div>
 
                    
                </div>
    </div>
</section>
  