@extends('template')
@section('main')
<h2>Data Rekam Medis</h2>
<h5>Menu ini untuk melihat data rekam medis pasien sekaligus melakukan pemeriksaan pasien</h5><br/>
<a class="btn btn-blue btn-sm btn-icon icon-left" href="{{route('rekam_medis.create')}}">
	<i class="entypo-user-add"></i>Tambah Rekam Medis
</a>
<br/>
<br/>
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
					
							toastr.success("{{session('message')}}", opts);
						}, 5);
					});
    			</script>
@endif
<div class="row">
	<div class="col-md-12">
		<br/>
		<script type="text/javascript">
				jQuery( document ).ready( function( $ ) {
					var $table4 = jQuery( "#table-1" );
					$table4.DataTable( {
						dom: 'Bfrtip',
						buttons: [
							'copyHtml5',
							'excelHtml5',
							'csvHtml5',
							'pdfHtml5'
						]
					} );
						} );
		</script>
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th width="1%">No</th>
					<th>Tanggal</th>
					<th>Nama Pasien</th>
					<th>Nama Dokter</th>
					<th>Poli</th>
					<th width="10%">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; ?>
				@foreach($rekam as $rekam_medis)
				<tr>
					<td><center>{{$no++}}</center></td>
					<td>{{date('d M Y', strtotime($rekam_medis->tgl))}}</td>
					<td>{{$rekam_medis->reservasi->pasien->nama_pasien}}</td>
					<td>{{$rekam_medis->reservasi->dokter->nama}}</td>
					<td>{{$rekam_medis->reservasi->poli->nama_poli}}</td>
					<td>
						<div align="center">
							{{-- <a href="{{route('rekam_medis.edit', ['id'=>$rekam_medis->id_rm])}}" class="btn btn-sm btn-blue btn-icon icon-left">
								<i class="entypo-pencil"></i>
								Ubah
							</a> --}}
							<a href="{{route('rekam_medis.show', ['id'=>$rekam_medis->id_rm])}}" class="btn btn-sm btn-info btn-icon icon-left">
								<i class="entypo-eye"></i>
								Detail
							</a>
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection