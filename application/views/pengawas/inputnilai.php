 
 <section class="content" >
    <div class="container-fluid"> 
        <?= $this->session->flashdata('msg') ?>
        <div class="row clearfix">
          
               
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ol class="breadcrumb breadcrumb-bg-indigo align-left">
                        <li><a href="<?=base_url()?>"><i class="material-icons">apps</i> Beranda</a></li>
                        <li> <a href="<?=base_url('pengawas/')?>"><i class="material-icons">view_list</i>Input Nilai</a> </li> 
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
                            <center>
                            <a data-toggle="modal" data-target="#selesai"  href=""><button class="btn bg-indigo">Selesai Proses Input</button></a> 
                             </center>
                         </div>
                    </div>
                    <div class="card">
                      <div class="header">
                            <center><h2>NILAI KARYAWAN</h2></center>                          
                        </div>
                        <div class="body">
                        <a data-toggle="modal" data-target="#input"  href=""><button class="btn bg-indigo">Input Nilai</button></a>

                            <div class="table-responsive">
                                 <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>   
                                            <th>ID Karyawan</th> 
                                            <th>Nama Karyawan</th> 

                                            <?php  foreach ($list_kriteria as $k): ?> 
                                              <th><?=$k->nama_kriteria?></th>  
                                            <?php endforeach; ?>
                                            <th>Aksi</th>  
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
                                                
                                               <td style="vertical-align: middle;"> 
                                                    <a data-toggle="modal" data-target="#edit-<?=$row->id_karyawan?>"  href=""><button  class="btn btn-block bg-indigo" style="margin-bottom: 4px">Edit</button></a>
                                                    <a data-toggle="modal" data-target="#delete-<?=$row->id_karyawan?>"  href=""><button  class="btn btn-block bg-red">Hapus</button></a>
                                               </td>             
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
 
 
<div class="modal fade" id="selesai" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header"> 
              <h4 class="modal-title" id="defaultModalLabel"><center>SELESAI INPUT NILAI ?</center></h4>
          </div>

                        <div class="modal-body">
                         <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                                        <form action="<?= base_url('pengawas/inputnilai')?>" method="Post" > 
                                        <input type="hidden" value="<?=$penilaian->id_penilaian?>" name="id_penilaian">  
                                        <input  type="submit" class="btn bg-green btn-block "  name="selesai" value="SELESAI">
                                         
                                    </div>
                                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                          <button type="button"  class="btn bg-red btn-block" data-dismiss="modal">BELUM</button>
                                    </div>
                                        <?php echo form_close() ?> 
                                </div> 
                            </div> 
          </div> 
          
      </div>
  </div>
</div> 
 
<div class="modal fade" id="input" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="defaultModalLabel"><center>FORM INPUT NILAI</center></h4>
                        </div>
                        <div class="modal-body">
                          <form action="<?= base_url('pengawas/inputnilai')?>" method="Post"  >  
                            
                            <input type="hidden" name="id_penilaian" value="<?=$penilaian->id_penilaian?>">
                            <table class="table table-bordered">
                              <tr>
                                <th style="width: 30%">Nama Karyawan</th>
                                <td>
                                  <select class="form-control" name="id_karyawan" required>
                                    <option value="">Pilih Karyawan</option>
                                    <?php  foreach ($list_karyawan as $k): ?> 
                                    <?php if ($this->DP_m->get_num_row(['id_karyawan' => $k->id_karyawan,'id_penilaian' => $penilaian->id_penilaian]) == 0) { ?>
                                      <option value="<?=$k->id_karyawan?>"><?=$k->nama_karyawan?></option>
                                    <?php } endforeach; ?>
                                  </select>
                                </td>
                              </tr>
                              <?php $i= 1; foreach ($list_kriteria as $row): ?>  
 
                                <tr>
                                    <th><?=$row->nama_kriteria?></th>
                                    <td>
                                        <select class="form-control"  required name="kriteria_<?=$row->id_kriteria?>">
                                            <option value="">- Pilih -</option> 
                                            <?php $list_param = $this->Subkriteria_m->get(['id_kriteria' => $row->id_kriteria]);?>
                                              <?php foreach ($list_param as $row2): ?>  
                                                <option value="<?=$row2->id_sub?>"><?=$row2->keterangan?></option> 
                                              <?php endforeach; ?> 
                                         </select> 
                                    </td>
                                </tr>
                                <?php   endforeach; ?>
                              
                            </table>
                                
                        <input  type="submit" class="btn bg-indigo btn-block"  name="input" value="Input">  <br><br>
                  
                            <?php echo form_close() ?> 
                        </div> 
                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
</div> 
 
 
 

<?php $i = 1; foreach ($list_karyawan as $row): ?> 
<?php if ($this->DP_m->get_num_row(['id_karyawan' => $row->id_karyawan,'id_penilaian' => $penilaian->id_penilaian]) != 0) { ?>
  <div class="modal fade" id="edit-<?=$row->id_karyawan?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="defaultModalLabel"><center>EDIT NILAI</center></h4>
                        </div>
                        <div class="modal-body">
                          <form action="<?= base_url('pengawas/inputnilai')?>" method="Post"  > 
 
                            <input type="hidden" value="<?=$penilaian->id_penilaian?>" name="id_penilaian">  
                          <table class="table table-bordered">
                              <tr>
                                <th style="width: 30%">Nama Karyawan</th>
                                <td>
                                  <input type="hidden" name="id_karyawan" value="<?=$row->id_karyawan?>">
                                  <?=$row->nama_karyawan?>
                                </td>
                              </tr>
                              <?php $i= 1; foreach ($list_kriteria as $row2): ?>  
 
                                <tr>
                                    <th><?=$row2->nama_kriteria?></th>
                                    <td>
                                        <select class="form-control"  required name="kriteria_<?=$row2->id_kriteria?>">
                                             
                                              <?php $nilaix = $this->DP_m->get_row(['id_kriteria' => $row2->id_kriteria, 'id_penilaian' => $penilaian->id_penilaian, 'id_karyawan' => $row->id_karyawan])->sub; ?>


                                            <option value="<?=$nilaix?>"><?=$this->Subkriteria_m->get_row(['id_sub' => $nilaix])->keterangan?></option> 
                                            <?php $list_param = $this->Subkriteria_m->get(['id_kriteria' => $row2->id_kriteria]);?>
                                              <?php foreach ($list_param as $row3): ?> 
                                              <?php if ($row3->id_sub != $nilaix) { ?>
                                                <option value="<?=$row3->id_sub?>"><?=$row3->keterangan?></option> 
                                              <?php } endforeach; ?> 
                                         </select> 
                                    </td>
                                </tr>
                                <?php   endforeach; ?>
                              
                            </table>
 

                            <input  type="submit" class="btn bg-indigo btn-block"  name="edit" value="Simpan">  <br><br>
                      
                                <?php echo form_close() ?> 
                            </div> 
                            <div class="modal-footer"> 
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Tutup</button>
                            </div>
                    </div>
                </div>
    </div> 
<?php } endforeach; ?>



<?php $i = 1; foreach ($list_karyawan as $row): ?>  
<?php if ($this->DP_m->get_num_row(['id_karyawan' => $row->id_karyawan,'id_penilaian' => $penilaian->id_penilaian]) != 0) { ?>
 <div class="modal fade" id="delete-<?=$row->id_karyawan?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="defaultModalLabel"><center>Hapus Nilai?</center></h4> 
                            <center><span style="color :red"><i>Nilai <?=$row->nama_karyawan?> ini akan dihapus.</i></span></center>
                        </div>
                        <div class="modal-body"> 
                       
                         <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                                        <form action="<?= base_url('pengawas/inputnilai')?>" method="Post" > 
                                        <input type="hidden" value="<?=$penilaian->id_penilaian?>" name="id_penilaian"> 
                                        <input type="hidden" value="<?=$row->id_karyawan?>" name="id_karyawan">  
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
<?php } endforeach; ?>