@extends('template')
@section('main')
<style>
.col-sm-1 {
    width: 45px;
}
</style>
<div class="row">
    <h2 align="center">Laporan Neraca</h2>
    <br/>
    <br/>
</div>
<div>
    <form role="form" class="form-horizontal" action="">
        @if(session('message'))
        <script type="text/javascript">
                    jQuery(document).ready(function($)
                    {
                        setTimeout(function()
                        {
                            var opts = {
                                "closeButton": true,
                                "debug": false,
                                "positionClass": rtl() || public_vars.$pageContainer.hasClass('right-sidebar') ? "toast-top-left" : "toast-top-right",
                                "toastClass": "black",
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            };
                    
                            toastr.error("{{session('message')}}", opts);
                        }, 5);
                    });
                </script>
        @endif
        <div class="form-group">
            <label class="col-md-3 control-label">Periode Laporan :</label>
            <div class="col-md-2">
                <div class="input-group">
                    <input type="text" class="form-control datepicker" id="tanggal_awal" name="tanggal_awal" data-format="dd-mm-yyyy" value="01-01-<?= date('Y'); ?>" />
                    <div class="input-group-addon">
                        <a href="#"><i class="entypo-calendar"></i></a>
                    </div>
                </div>
            </div>
            <label class="col-sm-2 control-label"><center>s/d</center></label>
            <div class="col-md-2">
                <div class="input-group">
                    <input type="text" class="form-control datepicker" id="tanggal_akhir" name="tanggal_akhir" data-format="dd-mm-yyyy" value="<?= date('d-m-Y'); ?>" />
                    <div class="input-group-addon">
                        <a href="#"><i class="entypo-calendar"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <br />
            <div class="col-sm-12">
                <center>
                    <button type="button" id="print" class="btn btn-green btn-icon icon-left">
                        Cetak Laporan
                        <i class="entypo-print"></i>
                    </button>
                </center>
            </div>
            <br />
        </div>
    </form>
</div>
<script type="text/javascript">
$(document).ready(function() {

    $('#print').click(function() {
        var tanggal_awal = $('#tanggal_awal').val();
        var tanggal_akhir = $('#tanggal_akhir').val();
        
        window.location.href = home_url + '/laporan/akunting/neraca/' + tanggal_awal + '/' + tanggal_akhir + '/pdf';
    });
});
</script>
@endsection
