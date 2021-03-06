@extends('template')
@section('main')

<h2>Jadwal Petugas Medis</h2>
<h5>Menu ini digunakan untuk melihat data jadwal petugas medis</h5><br/>
<a class="btn btn-blue btn-sm btn-icon icon-left" href="{{ route('masterdata.petugasmedis.jadwal.petugas') }}">
	<i class="entypo-cog"></i>Atur Jadwal Petugas Medis
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
						});
					});

					 jQuery( document ).ready( function( $ ) {
					 	var $table4 = jQuery( "#table-2" );
					 	$table4.DataTable( {
					 		dom: 'Bfrtip',
					 		buttons: [
					 			'copyHtml5',
					 			'excelHtml5',
					 			'csvHtml5',
					 			'pdfHtml5'
					 		]
					 	});
					 });

					 jQuery( document ).ready( function( $ ) {
					 	var $table4 = jQuery( "#table-3" );
					 	$table4.DataTable( {
					 		dom: 'Bfrtip',
					 		buttons: [
					 			'copyHtml5',
					 			'excelHtml5',
					 			'csvHtml5',
					 			'pdfHtml5'
					 		]
					 	});
					 });

					 jQuery( document ).ready( function( $ ) {
					 	var $table4 = jQuery( "#table-4" );
					 	$table4.DataTable( {
					 		dom: 'Bfrtip',
					 		buttons: [
					 			'copyHtml5',
					 			'excelHtml5',
					 			'csvHtml5',
					 			'pdfHtml5'
					 		]
					 	});
					 });

					 jQuery( document ).ready( function( $ ) {
					 	var $table4 = jQuery( "#table-5" );
					 	$table4.DataTable( {
					 		dom: 'Bfrtip',
					 		buttons: [
					 			'copyHtml5',
					 			'excelHtml5',
					 			'csvHtml5',
					 			'pdfHtml5'
					 		]
					 	});
					 });

					 jQuery( document ).ready( function( $ ) {
					 	var $table4 = jQuery( "#table-6" );
					 	$table4.DataTable( {
					 		dom: 'Bfrtip',
					 		buttons: [
					 			'copyHtml5',
					 			'excelHtml5',
					 			'csvHtml5',
					 			'pdfHtml5'
					 		]
					 	});
					 });

					 jQuery( document ).ready( function( $ ) {
					 	var $table4 = jQuery( "#table-7" );
					 	$table4.DataTable( {
					 		dom: 'Bfrtip',
					 		buttons: [
					 			'copyHtml5',
					 			'excelHtml5',
					 			'csvHtml5',
					 			'pdfHtml5'
					 		]
					 	});
					 });

					 jQuery( document ).ready( function( $ ) {
					 	var $table4 = jQuery( "#table-8" );
					 	$table4.DataTable( {
					 		dom: 'Bfrtip',
					 		buttons: [
					 			'copyHtml5',
					 			'excelHtml5',
					 			'csvHtml5',
					 			'pdfHtml5'
					 		]
					 	});
					 });

					 jQuery( document ).ready( function( $ ) {
					 	var $table4 = jQuery( "#table-9" );
					 	$table4.DataTable( {
					 		dom: 'Bfrtip',
					 		buttons: [
					 			'copyHtml5',
					 			'excelHtml5',
					 			'csvHtml5',
					 			'pdfHtml5'
					 		]
					 	});
					 });
</script>
<div class="row">
	<div class="col-md-12">
				<div class="scrollable" data-height="100%">
							<table class="table table-bordered datatable" id="table-3">
								<h4 class="modal-title" id="myModalLabel"><strong>{{strtoupper($days[0]->days)}}</strong></h4>
								<thead>
									<tr>
										<th width="1%">No</th>
										<th>Kategori</th>
										<th>Nama</th>
										<th>Jam Mulai</th>
										<th>Jam Selesai</th>
									</tr>
								</thead>

								<tbody>
									<?php $no=1; ?>
									@foreach($days[0]->petugas as $petugas)
									<tr>
										<td><center>{{$no++}}</center></td>
										<td><center><span class="label label-primary">{{strtoupper($petugas->category->nama_kategori)}}</span></center></td>
										<td>{{$petugas->nama}}</td>
										<td>{{$petugas->senin1}}</td>
										<td>{{$petugas->senin2}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							<br>
							<table class="table table-bordered datatable" id="table-4">
								<h4 class="modal-title" id="myModalLabel"><strong>{{strtoupper($days[1]->days)}}</strong></h4>
								<thead>
									<tr>
										<th width="1%">No</th>
										<th>Kategori</th>
										<th>Nama</th>
										<th>Jam Mulai</th>
										<th>Jam Selesai</th>
									</tr>
								</thead>

								<tbody>
									<?php $no=1; ?>
									@foreach($days[1]->petugas as $petugas)
									<tr>
										<td><center>{{$no++}}</center></td>
										<td><center><span class="label label-primary">{{strtoupper($petugas->category->nama_kategori)}}</span></center></td>
										<td>{{$petugas->nama}}</td>
										<td>{{$petugas->selasa1}}</td>
										<td>{{$petugas->selasa2}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>

					<br>
							<table class="table table-bordered datatable" id="table-5">
								<h4 class="modal-title" id="myModalLabel"><strong>{{strtoupper($days[2]->days)}}</strong></h4>
								<thead>
									<tr>
										<th width="1%">No</th>
										<th>Kategori</th>
										<th>Nama</th>
										<th>Jam Mulai</th>
										<th>Jam Selesai</th>
									</tr>
								</thead>

								<tbody>
									<?php $no=1; ?>
									@foreach($days[2]->petugas as $petugas)
									<tr>
										<td><center>{{$no++}}</center></td>
										<td><center><span class="label label-primary">{{strtoupper($petugas->category->nama_kategori)}}</span></center></td>
										<td>{{$petugas->nama}}</td>
										<td>{{$petugas->rabu1}}</td>
										<td>{{$petugas->rabu2}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						<br>
						<table class="table table-bordered datatable" id="table-6">
							<h4 class="modal-title" id="myModalLabel"><strong>{{strtoupper($days[3]->days)}}</strong></h4>
							<thead>
								<tr>
									<th width="1%">No</th>
									<th>Kategori</th>
									<th>Nama</th>
									<th>Jam Mulai</th>
									<th>Jam Selesai</th>
								</tr>
							</thead>

							<tbody>
								<?php $no=1; ?>
								@foreach($days[3]->petugas as $petugas)
								<tr>
									<td><center>{{$no++}}</center></td>
									<td><center><span class="label label-primary">{{strtoupper($petugas->category->nama_kategori)}}</span></center></td>
									<td>{{$petugas->nama}}</td>
									<td>{{$petugas->kamis1}}</td>
									<td>{{$petugas->kamis2}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					<br/>
					<table class="table table-bordered datatable" id="table-7">
						<h4 class="modal-title" id="myModalLabel"><strong>{{strtoupper($days[4]->days)}}</strong></h4>
						<thead>
							<tr>
								<th width="1%">No</th>
								<th>Kategori</th>
								<th>Nama</th>
								<th>Jam Mulai</th>
								<th>Jam Selesai</th>
							</tr>
						</thead>

						<tbody>
							<?php $no=1; ?>
							@foreach($days[4]->petugas as $petugas)
							<tr>
								<td><center>{{$no++}}</center></td>
								<td><center><span class="label label-primary">{{strtoupper($petugas->category->nama_kategori)}}</span></center></td>
								<td>{{$petugas->nama}}</td>
								<td>{{$petugas->jumat1}}</td>
								<td>{{$petugas->jumat2}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<br/>
					<table class="table table-bordered datatable" id="table-8">
						<h4 class="modal-title" id="myModalLabel"><strong>{{strtoupper($days[5]->days)}}</strong></h4>
						<thead>
							<tr>
								<th width="1%">No</th>
								<th>Kategori</th>
								<th>Nama</th>
								<th>Jam Mulai</th>
								<th>Jam Selesai</th>
							</tr>
						</thead>

						<tbody>
							<?php $no=1; ?>
							@foreach($days[5]->petugas as $petugas)
							<tr>
								<td><center>{{$no++}}</center></td>
								<td><center><span class="label label-primary">{{strtoupper($petugas->category->nama_kategori)}}</span></center></td>
								<td>{{$petugas->nama}}</td>
								<td>{{$petugas->sabtu1}}</td>
								<td>{{$petugas->sabtu2}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<br/>
					<table class="table table-bordered datatable" id="table-9">
						<h4 class="modal-title" id="myModalLabel"><strong>{{strtoupper($days[6]->days)}}</strong></h4>
						<thead>
							<tr>
								<th width="1%">No</th>
								<th>Kategori</th>
								<th>Nama</th>
								<th>Jam Mulai</th>
								<th>Jam Selesai</th>
							</tr>
						</thead>

						<tbody>
							<?php $no=1; ?>
							@foreach($days[6]->petugas as $petugas)
							<tr>
								<td><center>{{$no++}}</center></td>
								<td><center><span class="label label-primary">{{strtoupper($petugas->category->nama_kategori)}}</span></center></td>
								<td>{{$petugas->nama}}</td>
								<td>{{$petugas->minggu1}}</td>
								<td>{{$petugas->minggu2}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</di
	</div>
</div>

@endsection