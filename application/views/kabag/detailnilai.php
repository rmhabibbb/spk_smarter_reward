 
 <section class="content" >
    <div class="container-fluid"> 
        <?= $this->session->flashdata('msg') ?>
        <div class="row clearfix">
          
               
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ol class="breadcrumb breadcrumb-bg-indigo align-left">
                        <li><a href="<?=base_url()?>"><i class="material-icons">apps</i> Beranda</a></li>
                        <li> <a href="<?=base_url('kabag/laporan')?>"><i class="material-icons">view_list</i> Kelola Data Laporan</a> </li> 
                        <li><a href="<?=base_url('kabag/laporan/'.$laporan->id_laporan)?>"> <i class="material-icons">class</i><?=$laporan->tahun?> </a></li>  
                        <li> <i class="material-icons">class</i><?=$karyawan->nama_karyawan?></li>  
                    </ol>
                    <div class="card">
                        
                        <div class="body"> 
                            <table class="table table-bordered table-striped table-hover" style="max-height: 300px">

                                <tbody>
                                    
                                     <tr>
                                         <th style="width: 30%">
                                             ID Laporan
                                         </th>
                                         <td> 
                                          
                                            <?=$laporan->id_laporan?>

                                         </td>
                                     </tr>
                                      
                                    
                                     <tr>
                                         <th style="width: 30%">
                                             Tahun
                                         </th>
                                         <td> 
                                           <?=$laporan->tahun?>
                                         </td>
                                     </tr>  
                                     <tr>
                                         <th style="width: 30%">
                                             Nama Karyawan
                                         </th>
                                         <td>  
                                           <?=$karyawan->nama_karyawan?>
                                         </td>
                                     </tr>   
                                   
                                </tbody>

                            </table>   

                            
                            <a href="<?=base_url('kabag/laporan/'.$laporan->id_laporan)?>"><button class="btn bg-indigo">Kembali</button></a>  
                         </div>
                    </div>
                    <div class="card">
                      <div class="header">
                            <center><h2>DETAIL NILAI BULANAN</h2></center>                          
                        </div>
                        <div class="body">   
                            <div class="table-responsive">
                                 <table class="table table-bordered table-striped table-hover  js-exportable dataTable">
                                    <thead>
                                        <tr>     
                                            <th>Bulan</th>  
                                            <?php  foreach ($list_kriteria as $k): ?> 
                                              <th><?=$k->nama_kriteria?></th>  
                                            <?php endforeach; ?> 
                                            <th>Pengawas</th>  
                                        </tr>
                                    </thead> 
                                    <tbody>
                                      <?php 

                                      $i = 1;   
                                      $x = 1;
                                      foreach ($list_penilaian as $row): ?>   
                                          <tr>     
                                              <td><?php
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
                                              ?></td>    
                                              <?php  foreach ($list_kriteria as $k): ?> 
                                                <td> 
                                                  <?php
                                                    $ket = $this->DP_m->get_num_row(['id_karyawan' => $karyawan->id_karyawan, 'id_penilaian' => $row->id_penilaian,'id_kriteria' => $k->id_kriteria]);
                                                    if ($ket != 0) {
                                                      echo $this->DP_m->get_row(['id_karyawan' => $karyawan->id_karyawan, 'id_penilaian' => $row->id_penilaian,'id_kriteria' => $k->id_kriteria])->keterangan;
                                                    }else{
                                                      echo "-";
                                                    }
                                                  ?>
                                                </td>  
                                              <?php endforeach; ?>

                                              <td>
                                                <?php 

                                                $ket = $this->DP_m->get_num_row(['id_karyawan' => $karyawan->id_karyawan, 'id_penilaian' => $row->id_penilaian,'id_kriteria' => 1]);
                                                    if ($ket != 0) {
                                                      echo $this->Pengawas_m->get_row(['id_pengawas' => $this->DP_m->get_row(['id_karyawan' => $karyawan->id_karyawan, 'id_penilaian' => $row->id_penilaian,'id_kriteria' => 1])->id_pengawas])->nama_pengawas;
                                                    }else{
                                                      echo "-";
                                                    }

                                                    ?>
                                              </td>


                                          </tr>
                                      <?php $x++; endforeach; ?>
                                    </tbody>
                                </table>

     
                            </div>
                        </div>
                    </div>
 
                    
                </div>
    </div>
</section>
 