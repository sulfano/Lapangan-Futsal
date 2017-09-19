<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data_kelurahan;
use App\Models\Data_kecamatan;
//use App\DataKecamatan;
use DB;


class KelurahanController extends Controller
{
	public function index(Request $request){
		$kelurahan = DB::table('data_kelurahan')
					 ->join('data_kecamatan','data_kecamatan.id','=','data_kelurahan.idkecamatan')
					 ->select('data_kelurahan.*','data_kecamatan.nama as kecamatan')
                     ->orderBy('data_kelurahan.id','DESC')
                     ->paginate(15);

		//Data_kelurahan::orderBy('id','desc')->paginate(15);
    	return view('pages.admin.kelurahan.index',compact('kelurahan'))
                            ->with('i',($request->input('page',0)));   
	}
    public function create(){
    	$kecamatan=Data_kecamatan::All();
    	return view('pages.admin.kelurahan.create',['kecamatan'=>$kecamatan]);
    }
    public function store(Request $request){
    	$this->validate($request,[
    		'nama'=>'required',
    		'idkecamatan'=>'required',
    		]);
		// DataKecamatan::create($request->all());
        $kelurahan = new Data_kelurahan();

        $kelurahan->nama = $request->input('nama');
        $kelurahan->idkecamatan = $request->input('idkecamatan');

        $kelurahan->save();

		return redirect()->route('admin.kelurahan')
						->with('message','Kelurahan Created');
    }
    public function read($id){
        $kel = DB::table('data_kelurahan')
                     ->join('data_kecamatan','data_kecamatan.id','=','data_kelurahan.idkecamatan')
                     ->select('data_kelurahan.*','data_kecamatan.nama as kecamatan')
                     ->where('data_kelurahan.id',$id)->get();
        return view('pages.admin.kelurahan.read',['id'=>$id,'kelurahan'=>$kel]);
    }
    public function destroy($id)
    {
        $kelurahan=Data_kelurahan::find($id)->delete();
        return redirect()->route('admin.kelurahan')
                        ->with('message','Kelurahan Deleted');
    }     
    public function update($id)
    {
        $kecamatan=Data_kecamatan::All();
        $kelurahan=Data_kelurahan::find($id);
        return view('pages.admin.kelurahan.update',['id'=>$id,'kelurahan'=>$kelurahan,'kecamatan'=>$kecamatan]);
    }   
    public function save(Request $request, $id)
    {
        $this->validate($request, [
            'nama'=>'required',
            'idkecamatan'=>'required',
    ]);
        $kelurahan=Data_kelurahan::find($id);

        $kelurahan->nama = $request->input('nama');
        $kelurahan->idkecamatan = $request->input('idkecamatan');
        
        $kelurahan->save();

        return redirect()->route('admin.kelurahan')
                        ->with('message','Kelurahan Updated');
    } 
}
