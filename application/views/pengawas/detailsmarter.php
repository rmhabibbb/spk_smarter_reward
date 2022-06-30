 
 <section class="content" >
    <div class="container-fluid"> 
        <?= $this->session->flashdata('msg') ?>
        <div class="row clearfix">
          
               
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ol class="breadcrumb breadcrumb-bg-indigo align-left">
                        <li><a href="<?=base_url()?>"><i class="material-icons">apps</i> Beranda</a></li>
                        <li> <a href="<?=base_url('pengawas/laporan')?>"><i class="material-icons">view_list</i> Kelola Data Laporan</a> </li> 
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
 
                            
                            <a href="<?=base_url('pengawas/laporan/'.$laporan->id_laporan)?>"><button class="btn bg-indigo">Kembali</button></a>  
                         </div>
                    </div>
                    <div class="card">
                      <div class="header">
                            <center><h2>DETAIL PERHITUNGAN SMARTER</h2></center>                         
                        </div>
                        <div class="body">  
                            <?php $list_penilaian = $this->Penilaian_m->get(['tahun' => $laporan->tahun])?>
                            <h3>1. Data Awal (<?= sizeof($list_penilaian)?> Bulan)</h3>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist"> 
                                <?php $b=1; foreach ($list_penilaian as $p): ?> 
                                  <li role="presentation" <?php if($b==1){ echo 'class="active"'; $b++; } ?>>
                                    <a href="#datawal-<?=$p->bulan?>" data-toggle="tab">
                                      <?php 
                                        if ($p->bulan == 1) {
                                          echo "Januari";
                                        }elseif($p->bulan == 2){
                                          echo "Februari";
                                        }elseif($p->bulan == 3){
                                          echo "Maret";
                                        }elseif($p->bulan == 4){
                                          echo "April";
                                        }elseif($p->bulan == 5){
                                          echo "Mei";
                                        }elseif($p->bulan == 6){
                                          echo "Juni";
                                        }elseif($p->bulan == 7){
                                          echo "Juli";
                                        }elseif($p->bulan == 8){
                                          echo "Agustus";
                                        }elseif($p->bulan == 9){
                                          echo "September";
                                        }elseif($p->bulan == 10){
                                          echo "Oktober";
                                        }elseif($p->bulan == 11){
                                          echo "November";
                                        }elseif($p->bulan == 12){
                                          echo "Desember";
                                        }
                                      ?>
                                    </a>
                                  </li> 
                                <?php endforeach; ?>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">

                                <?php $b=1; foreach ($list_penilaian as $p): ?> 
                                <div role="tabpanel" class="tab-pane fade in <?php if($b==1){ echo 'active'; $b++; } ?>" id="datawal-<?=$p->bulan?>">
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
                                                <?php if ($this->DP_m->get_num_row(['id_karyawan' => $row->id_karyawan,'id_penilaian' => $p->id_penilaian]) != 0) { ?>
                                                  <tr>    
                                                      <td><?=$row->id_karyawan?></td>  
                                                      <td><?=$row->nama_karyawan?></td>  
                                                      <?php  foreach ($list_kriteria as $k): ?> 
                                                        <td>
                                                          <?=$this->DP_m->get_row(['id_karyawan' => $row->id_karyawan, 'id_penilaian' => $p->id_penilaian,'id_kriteria' => $k->id_kriteria])->keterangan?>
                                                        </td>  
                                                      <?php endforeach; ?>
                                                                
                                                  </tr>
                                              <?php } endforeach; ?>
                                            </tbody>
                                        </table>

             
                                    </div>
                                </div>  
                                <?php endforeach; ?>
                            </div>
                            <hr>

                            <h3>2. Prioritas dan Pembobotan ROC pada Kriteria </h3>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped  ">
                                    <thead>
                                        <tr>   
                                            <th>NO</th> 
                                            <th>Nama Kriteria</th>
                                            <th>Prioritas</th>   
                                            <th>ROC</th>
                                            <th>Bobot</th>      
                                        </tr>
                                    </thead> 
                                    <tbody>
                                      <?php 

                                       $i = 1;
                                       $n = sizeof($list_kriteria);
                                       $x = 1; 
                                       $s = 1;
                                       $nn = sizeof($list_kriteria);
                                       foreach ($list_kriteria as $row): ?> 
                                          <tr>   
                                              <td><?=$i++?> </td>  
                                              <td><?=$row->nama_kriteria?>  </td> 
                                              <td><?=$row->prioritas?></td>  

                                              <td>
                                                 <?php  
                                                    echo "("; 
                                                    $a = $s; 
                                                    for ($k= 1; $k <= $nn; $k++) { 
                                                      echo '(1/' .$a.')';
                                                      if ($k != $nn) {
                                                        echo "+";
                                                      }
                                                      $a++;
                                                    }
                                                    echo ")/".$n; 
                                                  $nn--; 
                                                  $s++;
                                                ?>

                                               </td>


                                              <td>
                                                <?php 
                                                  $z = 0;
                                                  for ($j = $x ; $j <= $n ; $j++) { 
                                                    $z = $z + (1/$j);
                                                  }
                                                  $z = $z/$n;
                                                  echo number_format($z,4);
                                                  $x++;
                                                ?>

                                              </td>  
                                          </tr>
                                      <?php endforeach; ?>
                                    </tbody>
                                </table> 
                            </div>
                            <hr>

                            <h3>3. Prioritas dan Pembobotan ROC pada Sub Kriteria </h3>
                            <div class="table-responsive"> 
                              <?php foreach ($list_kriteria as $row): ?> 
                              <table class="table table-bordered table-striped ">
                                  <thead>
                                      <tr>   
                                          <th colspan="5"><center ><?=$row->nama_kriteria?></center></th>  
                                      </tr>
                                      <tr>   
                                          <th>NO</th> 
                                          <th>Nama Sub Kriteria</th>
                                          <th>Prioritas</th>   
                                          <th>ROC</th>
                                          <th>Bobot</th>      
                                      </tr>
                                  </thead> 
                                  <tbody>
                                      <?php $list_sub = $this->Subkriteria_m->get_by_order('prioritas','asc',['id_kriteria' => $row->id_kriteria ]);    ?>
                                        <?php 

                                    $i = 1;  
                                    $n = sizeof($list_sub);
                                    $x = 1;
                                    $s = 1;
                                    $nn = sizeof($list_sub);
                                    foreach ($list_sub as $row): ?> 
                                        <tr>   
                                            <td><?=$i++?></a></td>  
                                            <td><?=$row->keterangan?></td>  
                                            <td><?=$row->prioritas?></td>
                                             <td>
                                               <?php  
                                                  echo "("; 
                                                  $a = $s; 
                                                  for ($k= 1; $k <= $nn; $k++) { 
                                                    echo '(1/' .$a.')';
                                                    if ($k != $nn) {
                                                      echo "+";
                                                    }
                                                    $a++;
                                                  }
                                                  echo ")/".$n; 
                                                $nn--; 
                                                $s++;
                                              ?>

                                             </td>
                                            <td> 
                                              <?php 
                                               $z = 0;
                                                for ($j = $x ; $j <= $n ; $j++) { 
                                                  $z = $z + (1/$j);
                                                }
                                                $z = $z/$n; 
                                                  echo number_format($z,4); 
                                                $x++;
                                              ?>


                                            </td>
                                             
                                        </tr>
                                    <?php endforeach; ?>
                                  </tbody>
                              </table>
                              <?php endforeach; ?>
                            </div>
                            <hr>


                            <h3>4. Data Transformasi Alternatif berdasarkan nilai ROC pada sub kriteria (<?= sizeof($list_penilaian)?> Bulan)</h3>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist"> 
                                <?php $b=1; foreach ($list_penilaian as $p): ?> 
                                  <li role="presentation" <?php if($b==1){ echo 'class="active"'; $b++; } ?>>
                                    <a href="#datatran-<?=$p->bulan?>" data-toggle="tab">
                                      <?php 
                                        if ($p->bulan == 1) {
                                          echo "Januari";
                                        }elseif($p->bulan == 2){
                                          echo "Februari";
                                        }elseif($p->bulan == 3){
                                          echo "Maret";
                                        }elseif($p->bulan == 4){
                                          echo "April";
                                        }elseif($p->bulan == 5){
                                          echo "Mei";
                                        }elseif($p->bulan == 6){
                                          echo "Juni";
                                        }elseif($p->bulan == 7){
                                          echo "Juli";
                                        }elseif($p->bulan == 8){
                                          echo "Agustus";
                                        }elseif($p->bulan == 9){
                                          echo "September";
                                        }elseif($p->bulan == 10){
                                          echo "Oktober";
                                        }elseif($p->bulan == 11){
                                          echo "November";
                                        }elseif($p->bulan == 12){
                                          echo "Desember";
                                        }
                                      ?>
                                    </a>
                                  </li> 
                                <?php endforeach; ?>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">

                                <?php $b=1; foreach ($list_penilaian as $p): ?> 
                                <div role="tabpanel" class="tab-pane fade in <?php if($b==1){ echo 'active'; $b++; } ?>" id="datatran-<?=$p->bulan?>">
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
                                                <?php if ($this->DP_m->get_num_row(['id_karyawan' => $row->id_karyawan,'id_penilaian' => $p->id_penilaian]) != 0) { ?>
                                                  <tr>    
                                                      <td><?=$row->id_karyawan?></td>  
                                                      <td><?=$row->nama_karyawan?></td>  
                                                      <?php  foreach ($list_kriteria as $k): ?> 
                                                        <td>
                                                          <?=$this->DP_m->get_row(['id_karyawan' => $row->id_karyawan, 'id_penilaian' => $p->id_penilaian,'id_kriteria' => $k->id_kriteria])->nilai?>
                                                        </td>  
                                                      <?php endforeach; ?>
                                                                
                                                  </tr>
                                              <?php } endforeach; ?>
                                            </tbody>
                                        </table>

             
                                    </div>
                                </div>  
                                <?php endforeach; ?>
                            </div>
                            <hr>



                            <h3>5. Nilai Rata-rata Alternatif setiap kriteria</h3>
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
                            <hr>
                            <h3>6. Nilai Utility </h3>
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

                            <hr>
                            <h3>7. Nilai Preferensi </h3>
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
                            <hr>

                            <h3>8. Perangkingan</h3>
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

<div class="modal fade" id="selesai" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header"> 
              <h4 class="modal-title" id="defaultModalLabel"><center>PROSES LAPORAN ?</center></h4>
          </div>

                        <div class="modal-body">
                         <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                                        <form action="<?= base_url('pengawas/laporan')?>" method="Post" > 
                                        <input type="hidden" value="<?=$laporan->id_laporan?>" name="id_laporan">  
                                        <input  type="submit" class="btn bg-green btn-block "  name="Proses" value="PROSES">
                                         
                                    </div>
                                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                          <button type="button"  class="btn bg-red btn-block" data-dismiss="modal">BATAL</button>
                                    </div>
                                        <?php echo form_close() ?> 
                                </div> 
                            </div> 
          </div> 
          
      </div>
  </div>
</div> 