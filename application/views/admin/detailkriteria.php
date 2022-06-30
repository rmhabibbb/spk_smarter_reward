 
 <section class="content" >
    <div class="container-fluid"> 
        <?= $this->session->flashdata('msg') ?>
        <div class="row clearfix">
          
               
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ol class="breadcrumb breadcrumb-bg-indigo align-left">
                        <li><a href="<?=base_url()?>"><i class="material-icons">apps</i> Beranda</a></li>
                        <li> <a href="<?=base_url('admin/kriteria')?>"><i class="material-icons">view_list</i> Kelola Data Kriteria</a> </li> 
                        <li> <i class="material-icons">class</i> <?=$kriteria->nama_kriteria?> </li>  
                    </ol>
                    <div class="card">
                        
                        <div class="body"> 
                            <table class="table table-bordered table-striped table-hover" style="max-height: 300px">

                                <tbody>
                                    
                                     <tr>
                                         <th style="width: 30%">
                                             ID Kriteria
                                         </th>
                                         <td> 
                                          
                                            <?=$kriteria->id_kriteria?>

                                         </td>
                                     </tr>
                                     <tr>
                                         <th style="width: 30%">
                                             Nama Kriteria
                                         </th>
                                         <td> 
                                          
                                            <?=$kriteria->nama_kriteria?>
 
                                         </td>
                                     </tr>  
                                     <tr>
                                         <th style="width: 30%">
                                             Prioritas
                                         </th>
                                         <td> 
                                          
                                            <?=$kriteria->prioritas?>
 
                                         </td>
                                     </tr> 
                                     <tr>
                                         <th style="width: 30%">
                                             Bobot
                                         </th>
                                         <td> 
                                           <?php  
                                                 $n = sizeof($list_kriteria);
                                                 $x = 1;
                                                 for ($i=1; $i <= $n ; $i++) {  
                                                  $z = 0;
                                                  for ($j = $x ; $j <= $n ; $j++) { 
                                                    $z = $z + (1/$j);
                                                  }
                                                  $z = $z/$n;
                                                  if ($i == $kriteria->prioritas) {
                                                    echo number_format($z,4);
                                                  }
                                                  $x++;
                                                }
                                                ?>
                                         </td>
                                     </tr>   
                                   
                                </tbody>

                            </table>  
                            <center>
                            <a data-toggle="modal" data-target="#edit"  href=""><button class="btn bg-indigo">Edit</button></a> 
                             </center>
                         </div>
                    </div>
                    <div class="card">
                      <div class="header">
                            <center><h2>DAFTAR SUB KRITERIA</h2></center>                          
                        </div>
                        <div class="body">
                        <a data-toggle="modal" data-target="#tambahsub"  href=""><button class="btn bg-indigo">Tambah Sub kriteria</button></a>

                            <div class="table-responsive">
                                 <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>   
                                            <th>No.</th> 
                                            <th>Keterangan</th> 
                                            <th>Prioritas</th> 
                                            <th>Bobot</th> 
                                            <th>Atur Prioritas</th> 
                                            <th>Aksi</th>  
                                        </tr>
                                    </thead> 
                                    <tbody>
                                      <?php 

                                      $i = 1;  
                                      $n = sizeof($list_sub);
                                      $x = 1;
                                      foreach ($list_sub as $row): ?> 
                                          <tr>   
                                              <td><?=$i++?></a></td>  
                                              <td><?=$row->keterangan?></td>  
                                              <td><?=$row->prioritas?></td>
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
                                              <td>
                                                <?php if ($n <= 1) {
                                                  echo "-";
                                                }else { ?>
                                                 <?php if ($row->prioritas != $min_prio) { ?>
                                                    <a href="<?=base_url('admin/subup/'.$row->prioritas.'/'.$row->id_kriteria)?>"> 
                                                      <button class="btn bg-indigo btn-block " style="margin-bottom: 3px">
                                                        <i class="material-icons">keyboard_arrow_up</i>
                                                      </button>
                                                    </a> 
                                                  <?php } ?>

                                                  <?php if ($row->prioritas != $max_prio) { ?>
                                                    <a href="<?=base_url('admin/subdown/'.$row->prioritas.'/'.$row->id_kriteria)?>"> 
                                                      <button class="btn bg-indigo btn-block ">
                                                        <i class="material-icons">keyboard_arrow_down</i>
                                                      </button>
                                                    </a>
                                                  <?php } ?> 
                                                <?php } ?>
                                              </td>
                                               <td style="vertical-align: middle;"> 
                                                    <a data-toggle="modal" data-target="#edit-<?=$row->id_sub?>"  href=""><button class="btn bg-indigo">Edit</button></a>
                                                    <a data-toggle="modal" data-target="#delete-<?=$row->id_sub?>"  href=""><button class="btn bg-red">Hapus</button></a>
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
</section>
 
 
<div class="modal fade" id="edit" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header"> 
              <h4 class="modal-title" id="defaultModalLabel"><center>EDIT KRITERIA</center></h4>
          </div>
          <div class="modal-body">
            <form action="<?= base_url('admin/kriteria')?>" method="Post"  >   
                          <input type="hidden" class="form-control" name="id_kriteria" placeholder="ID Kriteria" required  value="<?=$kriteria->id_kriteria?>" > 
                           <table class="table table-bordered"> 
                          <tr>   
                              <th>Nama Kriteria</th> 
                              <th>
                                 <input type="text" class="form-control" name="nama_kriteria" placeholder="Masukkan Nama Kriteria" required autofocus  value="<?=$kriteria->nama_kriteria?>" >
                              </th>  
                          </tr> 
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
 
<div class="modal fade" id="tambahsub" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="defaultModalLabel"><center>TAMBAH SUB KRITERIA</center></h4>
                        </div>
                        <div class="modal-body">
                          <form action="<?= base_url('admin/subkriteria')?>" method="Post"  >  
                            
                            <input type="hidden" name="id_kriteria" value="<?=$kriteria->id_kriteria?>">
                          <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">assignment</i>
                                    </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="keterangan" placeholder="Keterangan" required autofocus  >
                                    </div>
                          </div>    
                                
                        <input  type="submit" class="btn bg-indigo btn-block"  name="tambah" value="Tambah">  <br><br>
                  
                            <?php echo form_close() ?> 
                        </div> 
                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
</div> 
 
 
 

<?php $i = 1; foreach ($list_sub as $row): ?> 
  <div class="modal fade" id="edit-<?=$row->id_sub?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="defaultModalLabel"><center>EDIT SUB KRITERIA</center></h4>
                        </div>
                        <div class="modal-body">
                          <form action="<?= base_url('admin/subkriteria')?>" method="Post"  > 
 
                            <input type="hidden" value="<?=$kriteria->id_kriteria?>" name="id_kriteria"> 
                            <input type="hidden" value="<?=$row->id_sub?>" name="id_sub">   
                            
                            
                          <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">assignment</i>
                                    </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="ket" placeholder="Keterangan" required autofocus value="<?=$row->keterangan?>"  >
                                    </div>
                          </div> 
 

                            <input  type="submit" class="btn bg-indigo btn-block"  name="edit" value="Simpan">  <br><br>
                      
                                <?php echo form_close() ?> 
                            </div> 
                            <div class="modal-footer"> 
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Tutup</button>
                            </div>
                    </div>
                </div>
    </div> 
<?php endforeach; ?>



<?php $i = 1; foreach ($list_sub as $row): ?> 
 <div class="modal fade" id="delete-<?=$row->id_sub?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="defaultModalLabel"><center>Hapus data subkriteria?</center></h4> 
                            <center><span style="color :red"><i>Semua data yang terkait dengan subkriteria ini akan dihapus.</i></span></center>
                        </div>
                        <div class="modal-body"> 
                       
                         <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                                        <form action="<?= base_url('admin/subkriteria')?>" method="Post" > 
                                        <input type="hidden" value="<?=$kriteria->id_kriteria?>" name="id_kriteria"> 
                                        <input type="hidden" value="<?=$row->id_sub?>" name="id_sub">  
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