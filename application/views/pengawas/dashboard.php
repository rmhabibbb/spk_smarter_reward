  
    <section class="content">
        
        <?= $this->session->flashdata('msg') ?>
          <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ol class="breadcrumb breadcrumb-bg-indigo align-left">
                    <li><a href="<?=base_url()?>"><i class="material-icons">apps</i> Beranda</a></li> 
                </ol>
                    <div class="card">
                        
                      <div class="header">
                            <center><h2>DAFTAR PENILAIAN YANG BELUM SELESAI</h2></center>                          
                        </div>
                        <div class="body">
                          <a   data-toggle="modal" data-target="#tambah"  href=""><button class="btn bg-indigo">Tambah Penialaian</button></a> 
                        <br><br>
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
                                                  $x = 0;
                                                    foreach ($list_karyawan as $k) {
                                                      if ($this->DP_m->get_num_row(['id_karyawan' => $k->id_karyawan,'id_penilaian' => $row->id_penilaian]) != 0) { 
                                                        $x++;
                                                      }
                                                    }
                                                  $n = $this->Karyawan_m->get_num_row(['']);
                                                  echo "Proses Input Nilai <br> " . $x . ' / ' . $n .' Karyawan ' ;
                                                }else{
                                                  echo "Selesai";
                                                }

                                              ?></td>    
                                              
                                               <td style="vertical-align: middle;">
                                                 
                                                  <a href="<?=base_url('pengawas/inputnilai/'.$row->id_penilaian)?>"> 
                                                       <button class="btn bg-indigo">Input Nilai</button>
                                                   </a>

                                                    <a data-toggle="modal" data-target="#delete-<?=$row->id_penilaian?>"  href=""><button class="btn bg-red">Hapus</button></a>
                                                  
                                               </td>        
                                          </tr>
                                      <?php endforeach; ?>
                                    </tbody>
                                </table>

     
                            </div>
                        </div>
                    </div>

              
       
    </section>

     <div class="modal fade" id="tambah" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="defaultModalLabel"><center>Form Tambah Penilaian</center></h4>
                        </div>
                        <div class="modal-body">
                          <form action="<?= base_url('pengawas/penilaian')?>" method="Post"  >  
                         
                                 <table class="table table-bordered"> 
                                        <tr>   
                                            <th>Bulan</th> 
                                            <th>
                                               <select class="form-control" required name="bulan">
                                                 <option value="">-- Pilih Bulan -- </option>
                                                 <option value="1">Januari</option>
                                                 <option value="2">Februari</option>
                                                 <option value="3">Maret</option>
                                                 <option value="4">April</option>
                                                 <option value="5">Mei</option>
                                                 <option value="6">Juni</option>
                                                 <option value="7">Juli</option>
                                                 <option value="8">Agustus</option>
                                                 <option value="9">September</option>
                                                 <option value="10">Oktober</option>
                                                 <option value="11">November</option>
                                                 <option value="12">Desember</option>
                                               </select>
                                            </th>  
                                        </tr> 
                                        <tr>   
                                            <th>Tahun</th> 
                                            <th>
                                               <input type="number" class="form-control" name="tahun"   required autofocus  >
                                            </th>  
                                        </tr> 
                                </table>
                         
                        <input  type="submit" class="btn bg-indigo btn-block"  name="tambah" value="Tambah">  <br><br>
                  
                            <?php echo form_close() ?> 
                        </div> 
                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
</div> 


 <?php $i = 1; foreach ($list_penilaian as $row): ?> 
 <div class="modal fade" id="delete-<?=$row->id_penilaian?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="defaultModalLabel"><center>Hapus Data Penilaian?</center></h4> 
                            <center><span style="color :red"><i>Semua data yang terkait dengan data ini akan dihapus.</i></span></center>
                        </div>
                        <div class="modal-body"> 
                       
                         <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                                        <form action="<?= base_url('pengawas/penilaian')?>" method="Post" > 
                                        <input type="hidden" value="<?=$row->id_penilaian?>" name="id_penilaian">  
                                        <input  type="submit" class="btn bg-red btn-block "  name="hapus" value="Ya">
                                         
                                    </div>
                                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                          <button type="button"  class="btn bg-green btn-block" data-dismiss="modal">Tidak</button>
                                    </div>
                            <?php echo form_close() ?> 
                                </div>
                        </div> 
                    </div>
                </div>
    </div>
<?php endforeach; ?>