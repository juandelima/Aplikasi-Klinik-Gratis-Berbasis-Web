@extends('template')
@section('main')
<?php
$daftar_bulan = array(
  '01' => 'Januari',
  '02' => 'Februari',
  '03' => 'Maret',
  '04' => 'April',
  '05' => 'Mei',
  '06' => 'Juni',
  '07' => 'Juli',
  '08' => 'Agustus',
  '09' => 'September',
  '10' => 'Oktober',
  '11' => 'November',
  '12' => 'Desember',
);

$bulan_cetak = $daftar_bulan[date('m', strtotime($tanggal_awal))];

?>
<div class="invoice">
  <div class="row">
    <div class="col-xs-4 invoice-left">
      <span>
        Rumah Sehat | Menemani <br />
      </span>
    </div>
    <div class="col-xs-4" align="center">
      <span>
        LAPORAN KEUANGAN BERDASARKAN TIPE AKUN<br />
        @if ($bulanan == true)
        BULAN: {{ $bulan_cetak }} {{ date('Y', strtotime($tanggal_awal)) }}
        @else
        PERIODE: {{ date('d-M-Y', strtotime($tanggal_awal)) }} s/d {{ date('d-M-Y', strtotime($tanggal_akhir)) }}
        @endif
      </span>
    </div>
    <br/>
     <div class="col-xs-4 invoice-right">
      <span>
        <br />
        Hal. 01
      </span>
    </div>
  </div>
  <style>
  table,td,th{
    border-collapse :collapse;
  }
  th,td{
    padding: 3px;
  }
  </style>
  
  <table style="width: 100%; border-collapse: collapse;">
    <tbody>
      <tr>
        <td style="text-align: center; border: 1px solid;" colspan="4">{{$akun->first()->tipe_akun->nama_tipe}}</td>
      </tr>
      <tr>
        <td style="text-align: center; border: 1px solid;" width="4%"><b>No</b></td>
        <td style="text-align: center; border: 1px solid;" width="100"><b>Nama Akun</b></td>
        <td style="text-align: center; border: 1px solid;" width="50"><b>Masuk</b></td>
        <td style="text-align: center; border: 1px solid;" width="50"><b>Keluar</b></td>
      </tr>
      <?php $no=1; ?>
      @foreach($akun as $akun)
      <?php
        $total_masuk_ = 0;
        $total_keluar_ = 0;
        $total_masuk_keseluruhan = $akun->total_masuk_keseluruhan($tanggal_awal, $tanggal_akhir, $akun);
        $total_keluar_keseluruhan = $akun->total_keluar_keseluruhan($tanggal_awal, $tanggal_akhir, $akun);
      ?>
      <tr>
       <td style="border: 1px solid; text-align:center;">{{$no++}}</td>
       <td style="border: 1px solid;">{{$akun->akun->nama_akun}}</td>
       <td style="border: 1px solid; text-align: right;">{{number_format($total_masuk_keseluruhan, 0, ',', ',')}}</td>
       <td style="border: 1px solid; text-align: right;">{{number_format($total_keluar_keseluruhan, 0, ',', ',')}}</td>
      </tr>
      @endforeach
      <tr>
        <?php
          $total_masuk_keseluruhan2 = $akun->total_masuk_keseluruhan2($tanggal_awal, $tanggal_akhir, $akun);
          $total_keluar_keseluruhan2 = $akun->total_keluar_keseluruhan2($tanggal_awal, $tanggal_akhir, $akun);
        ?>
        <td style="text-align: center; border: 1px solid;" colspan="2"><center>Total</center></td>
        <td style="border: 1px solid; text-align: right;">{{number_format($total_masuk_keseluruhan2, 0, ',', ',')}}</td>
       <td style="border: 1px solid; text-align: right;">{{number_format($total_keluar_keseluruhan2, 0, ',', ',')}}</td>
      </tr>
    </tbody>
  </table>
</div>
<div class="row">&nbsp;</div>
<div class="invoice">
  <div class="invoice-right">
    <br>
          <p>
            Jakarta, {{date('d M Y')}}<br/>
                Penanggung Jawab&nbsp;&nbsp;
          </p>
          <br>
          <br>
          <br>
          <p>
            <b>&nbsp;{{Auth::user()->first_name}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
          </p>
          <br>
          <br>
    <a href="{{route('laporan.akun', ['tanggal_awal' => $tanggal_awal, 'tanggal_akhir' => $tanggal_akhir, 'akun' => $akun->id_tipe, 'tipe' => 'excel']) }}" class="btn btn-green btn-icon icon-left hidden-print">
      Export Excel
      <i class="entypo-doc-text"></i>
    </a>
    <a href="javascript:window.print();" class="btn btn-blue btn-icon icon-left hidden-print">
        Cetak PDF
      <i class="entypo-print"></i>
    </a>
  </div>
  </div>
@endsection