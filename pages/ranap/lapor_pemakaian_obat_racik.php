<link rel="stylesheet" href="asset/datepicker/datepicker.min.css">
<div class="page-content">
  <div class="row">
    <div class="col-6"><h4>Laporan Pemakaian Obat Racik</h4></div>
    <div class="col-6 text-right">
      <a href="?page=entry_datapenjualan">
        <button class="btn btn-sm btn-info">Data Penjualan</button>
      </a>
    </div>
  </div>

<?php
 
$hari_ini = date("d-m-Y");

$hari_sem = date("01-m-Y");
?>

 <form role="form" class="form-horizontal" method="GET" action="laporan/laporan_pemakaianobat_racik.php" target="_blank">
                    <div class="row data-tindakan">
                        <div class="position-relative form-group col-md-2">
                            <label for="dokter" class="">Tgl Awal Penjualan </label>
                            <div class="input-group input-group-sm">
                <input type="text" value="<?php echo $hari_sem; ?>" class="form-control datepicker" data-date-format="dd-mm-yyyy" name="tgl_awal" autocomplete="off" required>

</div>

</div>
              
                        <div class="position-relative form-group col-md-2">
                            <label for="no_daftar" class="">Tgl Akhir Penjualan</label>
                            <div class="input-group input-group-sm">
                <input  type="text" value="<?php echo $hari_ini; ?>" class="form-control datepicker" data-date-format="dd-mm-yyyy" name="tgl_akhir" autocomplete="off" required>

                                </div>
                           
                        </div>
                        <div class="position-relative form-group col-md-2">
                            <label for="no_daftar" class="">Cetak</label>
                                                      <div class="input-group input-group-sm">
                <button type="submit" class="btn btn-primary btn-submit">
                  <i class="fa fa-print"></i> Cetak
                </button>
              </div>
            </div>
          </div>
        </form>
      </div><!-- /.box -->
    </div><!--/.col -->
  </div>   <!-- /.row -->
</section><!-- /.content -->


 <script src="asset/datepicker/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
 $(function(){
  $(".datepicker").datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true,
      todayHighlight: true,
  });
 });
</script>