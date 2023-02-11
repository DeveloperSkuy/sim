<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-align-left"></i> Form Perawatan</li>
  </ol>
</nav>

<div class="page-content">
  <div class="row">
    <div class="col-6"><h4>Bank Data & Pendaftaran Pasien</h4></div>
    <div class="col-6 text-right">
      <a href="?page=perawatan">
        <button class="btn btn-sm btn-info">Data Perawatan</button>
      </a>
            <a href="?page=datapasien">
        <button class="btn btn-sm btn-success">Data Pasien</button>
      </a>
    </div>
  </div>

<div class="form-container">
        <div class="row" style="padding: 0 16px;">
            <div class="col-md-12 vertical-form">


                    <div class="row data-pengobatan">
                        <div class="position-relative form-group col-md-3">
                            <label for="no_daftar" class="">Cari dengan Nama, No. RM, HP (tekan Enter) </label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm" id="search"   >

                              </div>
                            </div>
                          </div>

                        <div class="position-relative form-group col-md-12">
                                <ul id="result"></ul>
                                
                            </div>
   
                        </div>



                </form>
      </div>
    </div>
  </div>
</div>

        <script type="text/javascript">
            $(document).ready(function(){
                 
                 function search(){

                      var nama_racikan=$("#search").val();
                      var kd_racik=$("#search").val();
                       var kd_obat=$("#search").val();

                      if(kd_racik!=""){
                        $("#result").html("<img src='img/ajax-loader.gif'/>");
                         $.ajax({
                            type:"post",
                            url:"ajax/search_racikan.php",
                            data:"kd_racik="+kd_racik+"&nama_racikan="+nama_racikan+"&kd_obat="+kd_obat,
                            success:function(data){
                                $("#result").html(data);
                                $("#search").val("");
                             }
                          });
                      }
                      

                     
                 }

                  $("#button").click(function(){
                     search();
                  });

                  $('#search').keyup(function(e) {
                     if(e.keyCode == 13) {
                        search();
                      }
                  });
            });
        </script>
