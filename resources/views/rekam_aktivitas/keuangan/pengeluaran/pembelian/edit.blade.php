@extends('template')
@section('main')
<h2>Tambah Pembelian</h2>
<ol class="breadcrumb bc-3">
	<li>
		<a href="{{ route('pengeluaran.pembelian.index') }}"><i class="entypo-home"> Daftar Pembelian</i></a>
	</li>
	<li class="active">
		<strong>Ubah Pembelian</strong>
	</li>
</ol>
@if (count($errors) > 0)
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-body">
				<form role="form" class="form-horizontal form-groups-bordered" action="{{ route('pengeluaran.pembelian.update', $data->id) }}" method="post">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label" style="text-align:left;">&emsp;Tanggal</label>
						<div class="col-sm-5">
							<div class="input-group">
								<input type="text" class="form-control datepicker" name="tgl" data-format="dd MM yyyy" placeholder="tanggal" required="" value="{{ date("d M Y", strtotime($data->tgl)) }}">
										
								<div class="input-group-addon">
									<a href="#"><i class="entypo-calendar"></i></a>
								</div>
							</div>
						</div>
					</div>
					{{-- <div id="ket_1"> --}}
						<div class="form-group">
							<label for="field-1" class="col-sm-3 control-label" style="text-align:left;">&emsp;Vendor</label>
							<input type="hidden" name="vendor_id" id="vendor_id" value="{{$data->vendor_id}}">
							<div class="col-sm-5">
								<input type="text" class="form-control" id="vendor_1" name="vendor" placeholder="nama vendor" value="{{$data->vendor->nama_vendor}}" required readonly/>
							</div>
							<a class="btn btn-white" href="javascript:;" onclick="jQuery('#modal-5').modal('show', {backdrop: 'static'}); ">	
	                       		<i class="entypo-search" ></i>        
							</a> 
						</div>
						
						<div class="form-group">
							<label for="field-1" class="col-sm-3 control-label" style="text-align:left;">&emsp;Obat/Barang</label>
							<input type="hidden" name="obat_id" id="obat_id" value="{{$data->obat_id}}">
							<div class="col-sm-5">
								<input type="text" class="form-control" id="obat_1" name="obat" placeholder="nama obat" value="{{$data->jenisobat->nama_obat}}" required readonly/>
							</div>
							<a class="btn btn-white" href="javascript:;" onclick="jQuery('#modal-6').modal('show', {backdrop: 'static'}); ">	
	                       		<i class="entypo-search" ></i>        
							</a> 
						</div>

						<div class="form-group">
							<label for="field-1" class="col-sm-3 control-label" style="text-align:left;">&emsp;Jumlah</label>
							
							<div class="col-sm-5">
								<input type="text" class="form-control numberValidation jumlah" id="jumlah_1" name="jumlah" onkeyup="hitung_total()" placeholder="jumlah" value="{{$data->jumlah}}" required readonly />
							</div>
						</div>

						<div class="form-group">
							<label for="field-1" class="col-sm-3 control-label" style="text-align:left;">&emsp;Harga</label>
							
							<div class="col-sm-5">
								<input type="text" class="form-control numbers harga" id="harga_1" name="harga" placeholder="harga" value="{{$data->harga}}" autocomplete="off" onkeyup="hitung_total()" required readonly />
							</div>
						</div>
					{{-- </div> --}}
					{{-- <div id="tambah_list"></div>
					<div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label"></label>

						<div class="col-sm-5">
							<button type="button" id="tambah_ket" class="btn btn-blue btn-icon icon-left">
							Tambah
							<i class="entypo-plus"></i>
							</button>
						</div>
					</div> --}}
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label" style="text-align:left;">&emsp;Total</label>
							
						<div class="col-sm-5">
							<input type="text" class="form-control numbers" id="total" name="total" placeholder="total" value="{{$data->total}}" required readonly/>
						</div>
					</div>
					<div class="form-group center-block full-right" style="margin-left: 15px;">
						<button type="submit" class="btn btn-green btn-icon icon-left col-left">
						Simpan
						<i class="entypo-check"></i>
						</button>
						<a href="{{ route('pengeluaran.pembelian.index') }}" class="btn btn-red btn-icon icon-left">
								Kembali
							<i class="entypo-cancel"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal-5">
		<div class="modal-dialog" style="width: 800px;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Pilih Vendor</h4>
				</div>
				<div class="modal-body">
					<table class="table table-bordered datatable" id="table-1">
						<thead>
 							<tr>
								<th>No</th>
								<th>Nama Vendor</th>
								<th>Alamat</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1; ?>
							@foreach($vendor as $vendor)
							<tr>
								<td>{{$no++}}</td>
								<td>{{strtoupper($vendor->nama_vendor)}}</td>
								<td>{{$vendor->alamat}}</td>
								<td align="center">
									<button data-id="{{$vendor->id}}" data-name="{{$vendor->nama_vendor}}" class="btn btn-green btn-sm btn-icon icon-left addPas">
										<i class="entypo-check"></i>
										Pilih
									</button>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="modal-6">
		<div class="modal-dialog" style="width: 800px;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Pilih Obat</h4>
				</div>
				<div class="modal-body">
					<table class="table table-bordered datatable2" id="table-2">
						<thead>
 							<tr>
								<th>No</th>
								<th>Nama Obat</th>
								<th>Satuan</th>
								<th>Jumlah</th>
								<th>Harga</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1; ?>
							@foreach($jenis as $jenis)
							<tr>
								<td>{{$no++}}</td>
								<td>{{strtoupper($jenis->nama_obat)}}</td>
								<td>{{$jenis->satuan}}</td>
								<td>{{$jenis->stok}}</td>
								<td>{{number_format($jenis->harga, 0, ',', ',')}}</td>
								<td align="center">
									<button data-id="{{$jenis->id}}" data-name="{{$jenis->nama_obat}}" data-harga="{{$jenis->harga}}" data-stok="{{$jenis->stok}}" class="btn btn-green btn-sm btn-icon icon-left addObt">
										<i class="entypo-check"></i>
										Pilih
									</button>
								</td>
							</tr>
							@endforeach
						</tbody>
				</div>
			</div>
		</div>
	</div>

</div>
<script type="text/javascript">
	var loop = 2;
	function harga(e) {
		var id = e.id;
		var harga_id = $('#harga_'+id).val();
		$('#harga_'+id).val(harga_id);

		hitung_total();
	}

	function jumlah(e) {
		var id = e.id;
		var jumlah_id = $('#jumlah_'+id).val();
		$('#jumlah_'+id).val(jumlah_id);

		hitung_total();
	}

	function hitung_total() {
		var total = 0;
		$(".harga, .jumlah").each(function () {
			$('#jumlah_1, #harga_1').on('input',function() {
			    var jumlah = parseInt($('#jumlah_1').val());
			    var harga = parseFloat($('#harga_1').val());
			    $('#total').val((jumlah * harga ? jumlah * harga : 0).toFixed(0));
			});
		});
	}

	$(document).ready(function () {

		$('.datatable').DataTable({
	      "oLanguage": {
	       "sSearch": "Search:",
	       "oPaginate": {
	         "sPrevious": "Previous &emsp;",
	         "sNext": "Next"
					 }
				}
		});

		$('.datatable2').DataTable({
	      "oLanguage": {
	       "sSearch": "Search:",
	       "oPaginate": {
	         "sPrevious": "Previous &emsp;",
	         "sNext": "Next"
					 }
				 }
		});
	
		$('.datatable').on('click','.addPas', function(e){
			var nama = $(this).data('name');
			var id = $(this).data('id');
			$("#vendor_1").val(nama);
			$("#vendor_id").val(id);
			$("#modal-5").modal('hide');
		});

		$('.datatable2').on('click','.addObt', function(e){
			var nama = $(this).data('name');
			var jumlah = $(this).data('stok');
			var harga = $(this).data('harga');
			var id = $(this).data('id');
			var total = jumlah * harga;
			$("#obat_id").val(id);
			$("#obat_1").val(nama);
			$("#jumlah_1").val(jumlah);
			$("#harga_1").val(harga);
			$("#total").val(total);
			$("#modal-6").modal('hide');
		});
	});
</script>
@endsection