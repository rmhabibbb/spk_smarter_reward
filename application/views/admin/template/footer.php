<div class="modal fade" id="gantipass" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content"> 
                    <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel"><center>Ganti Kanti Sandi</center></h4>
                        </div>
                        <div class="modal-body">

                         <div class="row">
                            <form action="<?= base_url('timpenilai/profil')?>" method="Post" id="editform2"> 
                            
                           <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                      <div class="input-group">
                                          <span class="input-group-addon">
                                              <i class="material-icons">lock</i>
                                          </span>
                                          <div class="form-line">
                                              <input type="password" class="form-control" name="pass1" id="pass1_ks" placeholder="Kata Sandi Baru" required>  
                                          </div>
                                           <div class="help-info" id="pesan2_ks"> </div>
                                      </div>  
                                    </div>
                                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                      <div class="input-group">
                                          <span class="input-group-addon">
                                              <i class="material-icons">lock_outline</i>
                                          </span>
                                          <div class="form-line">
                                              <input type="password" class="form-control" name="pass2"  id="pass2_ks"  placeholder="Konfirmasi Kata Sandi" required>  
                                          </div>

                                           <div class="help-info" id="pesan3_ks"> </div>
                                      </div>  
                                    </div>
                          </div>

                           
                           <input  type="submit" class="btn bg-green btn-block btn-lg"  name="edit2" value="Ganti Kata Sandi">  <br><br>
                  
                            <?php echo form_close() ?>  
                         </div>
                        </div> 
                    </div>
                </div>
    </div>  
    <!-- Jquery Core Js -->
    <script src="<?=base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
    

    <!-- Bootstrap Core Js -->    <script src="<?=base_url('assets/js/materialize.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.js')?>"></script>
  

<script>
   function validate(evt) {

           var id = $("#cekidkaryawan");
          var theEvent = evt || window.event;

          // Handle paste
          if (theEvent.type === 'paste') {
              key = event.clipboardData.getData('text/plain');
          } else {
          // Handle key press
              var key = theEvent.keyCode || theEvent.which;
              key = String.fromCharCode(key);
          }
          var regex = /[0-9]|\./;
          if( !regex.test(key) || id.val().length >= 6) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
          }
        }
$(document).ready(function(){
  
 

   $("#editform2").change(function(){ 

        var pass = $("#passlama").val(); 
        var pass1 = $("#pass1_ks").val();  
        var pass2 = $("#pass2_ks").val(); 
        var cek1 = 1;
        var cek2 = 1;
        var cek3 = 1; 
        
        $.ajax({

                url:"<?php echo base_url(); ?>admin/cekpasslama",
                method:"post", 
                data:{pass},
                    success:function(data){ 
                     if (data != ""){ 
                      cek1 = 0 ;
                      $('#pesan4_ks').html(data); 
                    }else {
                      $('#pesan4_ks').html(data); 
                      cek1 = 1 ;
                    } 
                    if (cek1 == 0 || cek2== 0 || cek3 == 0) {
                     $(':input[type="submit"]').prop('disabled', true);
                  } else {
                     $(':input[type="submit"]').prop('disabled', false);
                  }
                }
             });


          $.ajax({

                url:"<?php echo base_url(); ?>admin/cekpass",
                method:"post", 
                data:{pass1:pass1},
                    success:function(data){ 
                     if (data != ""){ 
                      cek2 = 0 ;
                      $('#pesan2_ks').html(data); 
                    }else {
                      $('#pesan2_ks').html(data); 
                      cek2 = 1 ;
                    } 
                    if (cek1 == 0 || cek2== 0 || cek3 == 0) {
                     $(':input[type="submit"]').prop('disabled', true);
                  } else {
                     $(':input[type="submit"]').prop('disabled', false);
                  }
                }
             });
 
          $.ajax({

                url:"<?php echo base_url(); ?>admin/cekpass2",
                method:"post", 
                data:{pass1:pass1,pass2:pass2},
                    success:function(data){
                     if (data != ""){ 
                      cek3 = 0;
                      $('#pesan3_ks').html(data); 
                    }else {
                      $('#pesan3_ks').html(data); 
                      cek3 = 1 ;
                    } 
                    if (cek1 == 0 || cek2== 0 || cek3 == 0) {
                     $(':input[type="submit"]').prop('disabled', true);
                  } else {
                     $(':input[type="submit"]').prop('disabled', false);
                  }

                 }
             });

          

            


        }); 


});
</script>


 



    <!-- Slimscroll Plugin Js -->
    <script src="<?=base_url('assets/plugins/jquery-slimscroll/jquery.slimscroll.js')?>"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?=base_url('assets/plugins/node-waves/waves.js')?>"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="<?=base_url('assets/plugins/jquery-datatable/jquery.dataTables.js')?>"></script>
    <script src="<?=base_url('assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')?>"></script>
    <script src="<?=base_url('assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/jquery-datatable/extensions/export/jszip.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js')?>"></script>
    <script src="<?=base_url('assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js')?>"></script>

    <!-- Multi Select Plugin Js -->
    <script src="<?=base_url('assets/plugins/multi-select/js/jquery.multi-select.js')?>"></script>
    <!-- Custom Js -->
    <script src="<?=base_url('assets/js/admin.js')?>"></script>
    <script src="<?=base_url('assets/js/pages/tables/jquery-datatable.js')?>"></script>

    <!-- Demo Js -->
    <script src="<?=base_url('assets/js/demo.js')?>"></script>
    <script type="text/javascript">
      $('#my-select').multiSelect(); 
      $('#my-select2').multiSelect(); 
    </script> 

 
</body>

</html>
