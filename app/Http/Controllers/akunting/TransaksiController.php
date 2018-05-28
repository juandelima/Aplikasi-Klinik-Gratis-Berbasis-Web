<?php

namespace App\Http\Controllers\akunting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\NamaAkun;
use App\TipeAkun;
use App\Transaksi;
use Auth;
use Excel;
class TransaksiController extends Controller
{
    public function index() {
    	$tampilan_penuh = true;
    	$transaksi = Transaksi::orderBy('id_transaksi','ASC')->get();
    	return view('akunting.transaksi.index', get_defined_vars());
    }

    public function create() {
    	$tipeAkun = TipeAkun::all();
    	$namaAkun = NamaAkun::all();
    	return view('akunting.transaksi.create', get_defined_vars());
    }

    public function save(Request $req) {
    	$data = $req->all();
        if(!isset($data['transaksi'])) return redirect()->back()->withInput()->with('status','Wajib pilih salah satu jenis transaksi!');
        $this->validateWith(array(
            'tgl' => 'required',
            'id_tipe' => 'required',
            'id_akun' => 'required'
        ));
    	$namaAkun = Transaksi::where('id_akun',$data['id_akun'])->orderBy('id_transaksi','DESC')->first();
    	if (isset($data['transaksi']['pemasukan'])) {
    		if (empty($namaAkun->id_akun)) {
    			$nominal = str_replace(',', '', $data['nominal']);
    			$jumlah = $data['jumlah'];
    			$saldo = 0 + ($nominal * $jumlah);
    		} else {
    			if($namaAkun->id_akun == $data['id_akun']) {
	    			$nominal = str_replace(',', '', $data['nominal']);
	    			$jumlah = $data['jumlah'];
	    			$saldo = ($namaAkun->saldo) + ($nominal * $jumlah);
	    		}
    		}

			Transaksi::create([
				'id_akun' => $data['id_akun'],
                'id_tipe' => $data['id_tipe'],
				'tgl' => date('Y-m-d', strtotime($data['tgl'])),
				'keterangan' => $data['keterangan'],
				'nominal' => str_replace(',', '', $data['nominal']),
				'jumlah' => $data['jumlah'],
				'pengeluaran' => 0,
				'pemasukan' =>  str_replace(',', '', $data['nominal']) * $data['jumlah'],
				'saldo' => str_replace('', '', $saldo),
				'u_id' => Auth::user()->id
    		]);

    		return redirect()->route('transaksi.index')->with('message','Transaksi berhasil ditambah!');
    	}


    	if (isset($data['transaksi']['pengeluaran'])) {
    		if (empty($namaAkun->id_akun)) {
    			$nominal = str_replace(',', '', $data['nominal']);
    			$jumlah = $data['jumlah'];
    			$saldo = 0 - ($nominal * $jumlah);
    		} else {
    			if($namaAkun->id_akun == $data['id_akun']) {
	    			$nominal = str_replace(',', '', $data['nominal']);
	    			$jumlah = $data['jumlah'];
	    			$saldo = ($namaAkun->saldo) - ($nominal * $jumlah);	
	    		}
    		}

    		Transaksi::create([
				'id_akun' => $data['id_akun'],
                'id_tipe' => $data['id_tipe'],
				'tgl' => date('Y-m-d', strtotime($data['tgl'])),
				'keterangan' => $data['keterangan'],
				'nominal' => str_replace(',', '', $data['nominal']),
				'jumlah' => $data['jumlah'],
				'pengeluaran' => str_replace(',', '', $data['nominal']) * $data['jumlah'],
				'pemasukan' =>  0,
				'saldo' => str_replace('', '', $saldo),
				'u_id' => Auth::user()->id
    		]);

    		return redirect()->route('transaksi.index')->with('message','Transaksi berhasil ditambah!');
    	}	
    }

    public function delete($id) {
        $id_transaksi = Transaksi::find($id);
        $transaksi = Transaksi::where('id_akun', $id_transaksi->id_akun)->orderBy('id_transaksi','DESC')->first();
        // dd($id_transaksi, $transaksi);
        if ($id_transaksi->id_transaksi == $transaksi->id_transaksi) {
            $transaksi->delete();
            return redirect()->route('transaksi.index')->with('message','TRANSAKSI BERHASIL DIHAPUS!');
        } else {
            return redirect()->route('transaksi.index')->with('message2','MAAF, HANYA TRANSAKSI TERAKHIR DARI TIAP AKUN YANG BISA DIHAPUS!');
        }

    }

    //Laporan Berdasarkan Akun
    public function berdasarkan_akun() {
        $tipeAkun = TipeAkun::orderBy('nama_tipe','ASC')->get();
        return view('akunting.laporan.berdasarkan_tipe_akun.index', get_defined_vars());
    }

    public function output_berdasarkan_akun($tanggal_awal, $tanggal_akhir, $akun, $tipe
    )
    {
        $tanggal_awal = date('Y-m-d', strtotime($tanggal_awal));
        $tanggal_akhir = date('Y-m-d', strtotime($tanggal_akhir));
        if ((date('d', strtotime($tanggal_awal)) == '01' AND date('d', strtotime($tanggal_akhir)) >= '30') AND date('m', strtotime($tanggal_awal)) == date('m', strtotime($tanggal_akhir))) {
            $bulanan = true;
        } else {
            $bulanan = false;
        }

        $akun = Transaksi::where('id_tipe', $akun)->whereBetween('tgl', [$tanggal_awal, $tanggal_akhir])->groupBy('id_akun')->get();
        
        if (empty($akun->first()->id_tipe)) {
            return redirect()->back()->with('message','AKUN BELUM MEMPUNYAI LAPORAN ATAU BELUM MEMPUNYAI LAPORAN PADA TANGGAL YANG DIINPUT!');
        } else {
            if ($tipe == 'pdf') {
                $tampilan_penuh = true;
                return view('akunting.laporan.berdasarkan_tipe_akun.pdf', get_defined_vars());
            } else {
                return Excel::create("Laporan Keuangan Tipe Akun".$akun->first()->tipe_akun->nama_tipe." - ".date('d-m-Y', strtotime($tanggal_awal)). "s/d" .date('d-m-Y', strtotime($tanggal_akhir)), function($excel) use ($tanggal_awal, $tanggal_akhir, $bulanan, $akun){
                    $excel->sheet('Sheet1', function($sheet) use ($tanggal_awal, $tanggal_akhir, $bulanan, $akun) {
                        $sheet->loadView('akunting.laporan.berdasarkan_tipe_akun.excel', get_defined_vars());
                    });
                })->export('xls');
            }
        }
    }
}
