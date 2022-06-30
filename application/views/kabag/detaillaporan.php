 
 <section class="content" >
    <div class="container-fluid"> 
        <?= $this->session->flashdata('msg') ?>
        <div class="row clearfix">
          
               
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ol class="breadcrumb breadcrumb-bg-indigo align-left">
                        <li><a href="<?=base_url()?>"><i class="material-icons">apps</i> Beranda</a></li>
                        <li> <a href="<?=base_url('kabag/laporan')?>"><i class="material-icons">view_list</i> Kelola Data Laporan</a> </li> 
                        <li> <i class="material-icons">class</i><?=$laporan->tahun?></li>  
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
                                     <tr>
                                         <th style="width: 30%">
                                             Jumlah Penerima
                                         </th>
                                         <td> 
                                            <?=$laporan->jumlah_penerima_reward?> Karyawan
                                         </td>
                                     </tr>  
                                     <tr>
                                         <th style="width: 30%">
                                             Status laporan
                                         </th>
                                         <td> 
                                           <?php  
                                             if ($laporan->status == 1) {
                                               echo "Proses Laporan";
                                             }else{
                                              echo "Selesai";
                                             }
                                           ?>
                                         </td>
                                     </tr>   
                                   
                                </tbody>

                            </table>    
                         </div>
                    </div>
                    <div class="card">
                      <div class="header">
                            <center><h2>HASIL PENILAIAN</h2></center>                          
                        </div>
                        <div class="body">  
                            <a href="<?=base_url('kabag/smarter/'.$laporan->id_laporan)?>"><button class="btn bg-indigo">Hasil Perhitungan SMARTER</button></a> 
                             
                             <br><br>
                            <div class="table-responsive">
                                 <table class="table table-bordered table-striped table-hover  js-exportable dataTable">
                                    <thead>
                                        <tr>   
                                            <th style="width: 10px">Peringkat</th>
                                            <th>ID Karyawan</th> 
                                            <th>Nama Karyawan</th> 
                                            <th>Nilai Akhir</th>   
                                            <th>Reward</th>   
                                            <th>Aksi</th>   
                                        </tr>
                                    </thead> 
                                    <tbody>
                                      <?php 

                                      $i = 1;   
                                      $x = 1;
                                      foreach ($dlaporan as $row): ?>  
                                        <?php $k = $this->Karyawan_m->get_row(['id_karyawan' => $row->id_karyawan]); ?>
                                          <tr>    
                                              <td><center><?=$i++?></center></td>
                                              <td><?=$k->id_karyawan?></td>  
                                              <td><?=$k->nama_karyawan?></td>   
                                              <td><?=$row->nilai_preferensi?></td> 
                                              <td>
                                                <center>
                                                  <?php if ($row->status == 1) {
                                                    echo '<i class="material-icons" style="color : green">done</i>';
                                                  }else{

                                                    echo '<i class="material-icons" style="color : red">close</i>';
                                                  } ?>
                                                </center>
                                              </td>
                                              <td>
                                                <center>
                                                  <a href="<?=base_url('kabag/detailnilai/'.$laporan->id_laporan.'/'.$k->id_karyawan)?>"> 
                                                       <button class="btn bg-indigo">Detail Nilai</button>
                                                   </a>
                                                </center>
                                                
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
 