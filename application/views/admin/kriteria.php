
    
<section class="content">
    <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row clearfix">
                 
            <div class="col-xs-12   col-sm-12  col-md-12   col-lg-12 ">
                <ol class="breadcrumb breadcrumb-bg-indigo align-left">
                    <li><a href="<?=base_url()?>"><i class="material-icons">apps</i> Beranda</a></li>
                    <li> <i class="material-icons">view_list</i> Kelola Data Kriteria </li> 
                </ol>
                <div class="card">
                      <div class="header">
                            <center><h2>KELOLA DATA KRITERIA</h2></center>                          
                        </div>
                        <div class="body">
                        
                        <a   data-toggle="modal" data-target="#tambah"  href=""><button class="btn bg-indigo">Tambah Kriteria</button></a> 
                        <br><br>

                            <div class="table-responsive">
                                 <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>   
                                            <th>NO</th> 
                                            <th>Nama Kriteria</th>
                                            <th>Prioritas</th>   
                                            <th>Bobot</th>     
                                            <th style="width: 100px">Atur Prioritas</th>   
                                            <th>Aksi</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                      <?php 

                                       $i = 1;
                                       $n = sizeof($list_kriteria);
                                       $x = 1;

                                       foreach ($list_kriteria as $row): ?> 
                                          <tr>   
                                              <td><?=$i++?> </td>  
                                              <td><?=$row->nama_kriteria?>  </td> 
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
                                                  <?php if ($row->prioritas != $min_prio) { ?>
                                                    <a href="<?=base_url('admin/kriteriaup/'.$row->prioritas)?>"> 
                                                      <button class="btn bg-indigo btn-block " style="margin-bottom: 3px">
                                                        <i class="material-icons">keyboard_arrow_up</i>
                                                      </button>
                                                    </a> 
                                                  <?php } ?>

                                                  <?php if ($row->prioritas != $max_prio) { ?>
                                                    <a href="<?=base_url('admin/kriteriadown/'.$row->prioritas)?>"> 
                                                      <button class="btn bg-indigo btn-block ">
                                                        <i class="material-icons">keyboard_arrow_down</i>
                                                      </button>
                                                    </a>
                                                  <?php } ?>
                                              </td>     
                                               <td style="vertical-align: middle;">
                                                  <a href="<?=base_url('admin/kriteria/'.$row->id_kriteria)?>"> 
                                                    <button class="btn bg-indigo ">
                                                      Lihat
                                                    </button>
                                                  </a>
                                                   <a data-toggle="modal" data-target="#delete-<?=$row->id_kriteria?>"  href=""><button class="btn bg-red">Hapus</button></a>
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
 
 <div class="modal fade" id="tambah" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="defaultModalLabel"><center>Form Tambah Kriteria</center></h4>
                        </div>
                        <div class="modal-body">
                          <form action="<?= base_url('admin/kriteria')?>" method="Post"  >  
                         
                                 <table class="table table-bordered"> 
                                        <tr>   
                                            <th>Nama Kriteria</th> 
                                            <th>
                                               <input type="text" class="form-control" name="nama_kriteria" placeholder="Masukkan Nama Kriteria" required autofocus >
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

<?php $i = 1; foreach ($list_kriteria as $row): ?> 
 <div class="modal fade" id="delete-<?=$row->id_kriteria?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="defaultModalLabel"><center>Hapus data kriteria?</center></h4> 
                            <center><span style="color :red"><i>Semua data yang terkait dengan <?=$row->nama_kriteria?> akan dihapus.</i></span></center>
                        </div>
                        <div class="modal-body"> 
                       
                         <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                                        <form action="<?= base_url('admin/kriteria')?>" method="Post" > 
                                        <input type="hidden" value="<?=$row->id_kriteria?>" name="id_kriteria">  
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