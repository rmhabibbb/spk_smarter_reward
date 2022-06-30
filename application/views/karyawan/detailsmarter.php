 
 <section class="content" >
    <div class="container-fluid"> 
        <?= $this->session->flashdata('msg') ?>
        <div class="row clearfix">
          
               
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ol class="breadcrumb breadcrumb-bg-indigo align-left">
                        <li><a href="<?=base_url()?>"><i class="material-icons">apps</i> Beranda</a></li>
                        <li> <a href="<?=base_url('kabag/laporan')?>"><i class="material-icons">view_list</i> Kelola Data Laporan</a> </li> 
                        <li> Detail Perhitungan SMARTER </li>  
                        <li>  <?=$laporan->tahun?></li>  
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
                                             Tanggal Buat
                                         </th>
                                         <td> 
                                           <?=date('d-m-Y' ,strtotime($laporan->tgl_buat)) ?>
                                         </td>
                                     </tr>  
                                   
                                </tbody>

                            </table>   
 
                            
                            <a href="<?=base_url('kabag/laporan/'.$laporan->id_laporan)?>"><button class="btn bg-indigo">Kembali</button></a>  
                         </div>
                    </div>
                    <div class="card">
                      <div class="header">
                            <center><h2>DETAIL PERHITUNGAN SMARTER</h2></center>                         
                        </div>
                        <div class="body">  
                             
                            <h3>1. Nilai Awal </h3>
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
                                      $x = 1;
                                      foreach ($nilai_awal as $row): ?>  
                                        <?php $k = $this->Karyawan_m->get_row(['id_karyawan' => $row['id_karyawan']]); ?>
                                          <tr>     
                                              <td><?=$k->id_karyawan?></td>  
                                              <td><?=$k->nama_karyawan?></td>   
                                              <?php 
                                      $c = 1; foreach ($list_kriteria as $k): ?> 
                                                <td><?=$row['nilai'][$c]?></td>  
                                              <?php $c++; endforeach; ?>
                                              
                                          </tr>
                                      <?php $x++; endforeach; ?>
                                    </tbody>
                                </table>

     
                            </div>

                            <h3>2. Nilai Utility </h3>
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
                                      $x = 1;
                                      foreach ($nilai_utility as $row): ?>  
                                        <?php $k = $this->Karyawan_m->get_row(['id_karyawan' => $row['id_karyawan']]); ?>
                                          <tr>     
                                              <td><?=$k->id_karyawan?></td>  
                                              <td><?=$k->nama_karyawan?></td>   
                                              <?php 
                                      $c = 1; foreach ($list_kriteria as $k): ?> 
                                                <td><?=$row['utility'][$c]?></td>  
                                              <?php $c++; endforeach; ?>
                                              
                                          </tr>
                                      <?php $x++; endforeach; ?>
                                    </tbody>
                                </table>

     
                            </div>

                            <h3>3. Nilai Preferensi </h3>
                            <div class="table-responsive">
                                 <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>    
                                            <th>ID Karyawan</th> 
                                            <th>Nama Karyawan</th> 
                                            <th>Nilai Preferensi</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                      <?php 

                                      $i = 1;   
                                      $x = 1;
                                      foreach ($nilai_pre as $row): ?>  
                                        <?php $k = $this->Karyawan_m->get_row(['id_karyawan' => $row['id_karyawan']]); ?>
                                          <tr>     
                                              <td><?=$k->id_karyawan?></td>  
                                              <td><?=$k->nama_karyawan?></td>  
                                                <td><?=$row['nilai'] ?></td>   
                                              
                                          </tr>
                                      <?php $x++; endforeach; ?>
                                    </tbody>
                                </table>

     
                            </div>

                            <h3>4. Perangkingan</h3>
                            <div class="table-responsive">
                                 <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>   
                                            <th style="width: 10px">Peringkat</th>
                                            <th>ID Karyawan</th> 
                                            <th>Nama Karyawan</th> 
                                            <th>Nilai Akhir</th>    
                                        </tr>
                                    </thead> 
                                    <tbody>
                                      <?php 

                                      $i = 1;   
                                      $x = 1;
                                      foreach ($nilai_akhir as $row): ?>  
                                        <?php $k = $this->Karyawan_m->get_row(['id_karyawan' => $row['id_karyawan']]); ?>
                                          <tr>    
                                              <td><center><?=$i++?></center></td>
                                              <td><?=$k->id_karyawan?></td>  
                                              <td><?=$k->nama_karyawan?></td>   
                                              <td><?=$row['nilai']?></td>  
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

 