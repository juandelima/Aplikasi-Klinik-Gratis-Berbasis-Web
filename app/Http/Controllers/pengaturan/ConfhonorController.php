<?php

namespace App\Http\Controllers\pengaturan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Confhonor;
use App\Petugas;
use App\Honor;
class ConfhonorController extends Controller
{
    public function index() {
    	$conf = Confhonor::orderBy('id','DESC')->get();
    	return view('conf.honor.index')->withConf($conf);
    }

    public function create() {
    	$category = Petugas::all();
    	return view('conf.honor.create')->withCategory($category);
    }

    public function save(Request $req) {
    	$this->validateWith(array(
    		'tgl' => 'required',
    		'petugas_id' => 'required|integer',
    		'honor' => 'required'
    	));
    	$data = $req->all();
    	Confhonor::create([
    		'tgl' => date('Y-m-d', strtotime($data['tgl'])),
    		'petugas_id' => $data['petugas_id'],
    		'honor' => str_replace(',', '', $data['honor'])
    	]);

    	return redirect()->route('pengaturan.honor.index')->with('message','Pengaturan honor berhasil disimpan');
    }

    public function edit($id) {
    	$petugas = Petugas::all();
    	$conf = Confhonor::find($id);
    	return view('conf.honor.edit', get_defined_vars());
    }

    public function update(Request $req, $id) {
    	$this->validateWith(array(
    		'tgl' => 'required',
    		'petugas_id' => 'required|integer',
    		'honor' => 'required'
    	));
    	$data = $req->all();
    	Confhonor::find($id)->update([
    		'tgl' => date('Y-m-d', strtotime($data['tgl'])),
    		'petugas_id' => $data['petugas_id'],
    		'honor' => str_replace(',', '', $data['honor'])
    	]);
    	return redirect()->route('pengaturan.honor.index')->with('message','Pengaturan honor berhasil diubah');
    }

    public function doDelete($id) {
    	$conf = Confhonor::find($id);
        if ($conf->honors->count() > 0) {
            return redirect()->back()->with('message2','DATA INI TIDAK DAPAT DIHAPUS KARENA BERHUBUNGAN DENGAN DATA LAIN!');
        } else {
            $conf->delete();
            return redirect()->route('pengaturan.honor.index')->with('message','PENGATURAN HONOR '.$conf->petugas->nama.' BERHASIL DIHAPUS!');
        }
    }
}
