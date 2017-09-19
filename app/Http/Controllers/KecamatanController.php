<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data_kecamatan;
//use App\DataKecamatan;
use DB;


class KecamatanController extends Controller
{
	public function index(Request $request){
		$kecamatan = Data_kecamatan::orderBy('id','desc')->paginate(15);
    	return view('pages.admin.kecamatan.index',compact('kecamatan'))
                            ->with('i',($request->input('page',0)));   
	}
    public function create(){
    	return view('pages.admin.kecamatan.create');
    }
    public function store(Request $request){
    	$this->validate($request,[
    		'nama'=>'required',
    		'latitude'=>'required',
    		'longitude'=>'required'
    		]);
		// DataKecamatan::create($request->all());
        $kecamatan = new Data_kecamatan();

        $kecamatan->nama = $request->input('nama');
        $kecamatan->latitude = $request->input('latitude');
        $kecamatan->longitude = $request->input('longitude');

        $kecamatan->save();

		return redirect()->route('admin.kecamatan')
						->with('message','Kecamatan Created');
    }
    public function read($id){
        $kec = Data_kecamatan::find($id);
        return view('pages.admin.kecamatan.read',['id'=>$id,'kecamatan'=>$kec]);
    }
    public function destroy($id)
    {
        $kecamatan=Data_kecamatan::find($id)->delete();
        return redirect()->route('admin.kecamatan')
                        ->with('message','Kecamatan Deleted');
    }     
    public function update($id)
    {
        $kecamatan=Data_kecamatan::find($id);
        return view('pages.admin.kecamatan.update',['id'=>$id,'kecamatan'=>$kecamatan]);
    }   
    public function save(Request $request, $id)
    {
        $this->validate($request, [
            'nama'=>'required',
            'latitude'=>'required',
            'longitude'=>'required',
    ]);
        $kecamatan=Data_kecamatan::find($id);

        $kecamatan->nama = $request->input('nama');
        $kecamatan->latitude = $request->input('latitude');
        $kecamatan->longitude = $request->input('longitude');
        
 
        $kecamatan->save();

        return redirect()->route('admin.kecamatan')
                        ->with('message','Kecamatan Updated');
    } 
}
