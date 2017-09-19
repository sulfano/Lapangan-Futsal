<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Acara;
use Illuminate\Support\Facades\Storage;

class AcaraController extends Controller
{
    public function index(Request $request){
        $acara = Acara::orderBy('id','ASC')
                        ->paginate(10);
        //$acara = Acara::All();
        return view('pages.admin.acara.index',compact('acara'))
                            ->with('i',($request->input('page',0)));   
    }
    public function read($id){
        $acara = Acara::find($id);
        return view('pages.admin.acara.read',['id'=>$id,'acara'=>$acara]);
    }
    public function create(){
        return view('pages.admin.acara.create');
    }
    public function store(Request $request){
		$date = date('Y-m-d');
        $this->validate($request,[
            'idpeople'=>'required',
            'pelaksana'=>'required',
            'namaacara'=>'required',
            //'awaldaftar'=>'required',
            //'akhirdaftar'=>'required',
            'tanggalmulai'=>'required',
            'tanggalakhir'=>'required',
            //'jammulai'=>'required',
            //'jamakhir'=>'required',
            'namakontak1'=>'required',
            'kontak1'=>'required',
            'biaya'=>'required',
            'satuan'=>'required',
            //'kuota'=>'required',
            'tempat'=>'required',
            'alamat'=>'required',
            ]);

        $acara = new Acara();

        $acara->idpeople = $request->input('idpeople');
        $acara->pelaksana = $request->input('pelaksana');
        $acara->namaacara = $request->input('namaacara');
        $acara->awal_daftar = $request->input('awaldaftar');
        $acara->akhir_daftar = $request->input('akhirdaftar');
        $acara->tanggalmulai = $request->input('tanggalmulai');
        $acara->tanggalakhir = $request->input('tanggalakhir');
        $acara->jammulai = $request->input('jammulai');
        $acara->jamakhir = $request->input('jamakhir');
        $acara->namakontak1 = $request->input('namakontak1');
        $acara->kontak1 = $request->input('kontak1');
        $acara->namakontak2 = $request->input('namakontak2');
        $acara->kontak2 = $request->input('kontak2');
        $acara->biaya = $request->input('biaya');
        $acara->satuan = $request->input('satuan');
        $acara->totalhadiah = $request->input('totalhadiah');
        $acara->hadiahutama = $request->input('hadiahutama');
        $acara->kuota = $request->input('kuota');
        $acara->tempat = $request->input('tempat');
        $acara->alamat = $request->input('alamat');
		
		if($request->hasFile('brosur')){
			$request->file('brosur');
			$ex = $request->brosur->clientExtension();
			$brosur = $request->brosur->storeAs('public/upload','acara'.$request->input('idpeople').$date.'.'.$ex);
			$acara->brosur = 'acara'.$request->input('idpeople').$date.'.'.$ex;
		} else {$acara->brosur = 'sample.png';}		
		
        $acara->detail = $request->input('detail');
        $acara->status = 1;
 
        $acara->save();

        return redirect()->route('admin.acara')
                        ->with('message','Acara Created');        
    }
    public function destroy($id)
    {
        $acara=Acara::find($id)->delete();
        return redirect()->route('admin.acara')
                        ->with('message','Acara Deleted');
    }
    public function update($id)
    {
        $acara=Acara::find($id);
        return view('pages.admin.acara.update',['id'=>$id,'acara'=>$acara]);
    }
    public function save(Request $request, $id)
    {
		$date = date('Y-m-d');
        $this->validate($request, [
            'pelaksana'=>'required',
            'namaacara'=>'required',
            //'awaldaftar'=>'required',
            //'akhirdaftar'=>'required',
            'tanggalmulai'=>'required',
            'tanggalakhir'=>'required',
            //'jammulai'=>'required',
            //'jamakhir'=>'required',
            'namakontak1'=>'required',
            'kontak1'=>'required',
            'biaya'=>'required',
            'satuan'=>'required',
            //'kuota'=>'required',
            'tempat'=>'required',
            'alamat'=>'required',
    ]);
        $acara=Acara::find($id);

        $acara->pelaksana = $request->input('pelaksana');
        $acara->namaacara = $request->input('namaacara');
        $acara->awal_daftar = $request->input('awaldaftar');
        $acara->akhir_daftar = $request->input('akhirdaftar');
        $acara->tanggalmulai = $request->input('tanggalmulai');
        $acara->tanggalakhir = $request->input('tanggalakhir');
        $acara->jammulai = $request->input('jammulai');
        $acara->jamakhir = $request->input('jamakhir');
        $acara->namakontak1 = $request->input('namakontak1');
        $acara->kontak1 = $request->input('kontak1');
        $acara->namakontak2 = $request->input('namakontak2');
        $acara->kontak2 = $request->input('kontak2');
        $acara->biaya = $request->input('biaya');
        $acara->satuan = $request->input('satuan');
        $acara->totalhadiah = $request->input('totalhadiah');
        $acara->hadiahutama = $request->input('hadiahutama');
        $acara->kuota = $request->input('kuota');
        $acara->tempat = $request->input('tempat');
        $acara->alamat = $request->input('alamat');
			
		if($request->hasFile('brosur')){
			Storage::delete('public/upload/'.$acara->brosur);
			$request->file('brosur');
			$ex = $request->brosur->clientExtension();
			$brosur = $request->brosur->storeAs('public/upload','acara'.$request->input('idpeople').$date.'.'.$ex);
			$acara->brosur = 'acara'.$request->input('idpeople').$date.'.'.$ex;
		} else {$acara->brosur = $acara->brosur;}
		
        $acara->detail = $request->input('detail');
        $acara->status = 1;
 
        $acara->save();

        return redirect()->route('admin.acara')
                        ->with('message','Acara Updated');
    }




    public function indexMA(Request $request){
        $id = $request->user()->id;
        $acara = Acara::where('idpeople',$id)
                        ->orderBy('id','ASC')
                        ->paginate(10);
        //$acara = Acara::All();
        return view('pages.acara.acara.index',compact('acara'))
                            ->with('i',($request->input('page',0)));   
    }
    
    public function readMA(Request $request,$id){
        $acara = Acara::find($id);
        $pengguna = $request->user()->id;
        if($pengguna!=$acara->idpeople)
            return redirect()->route('ma.acara');
        else
        return view('pages.acara.acara.read',['id'=>$id,'acara'=>$acara]);
    } 
       
    public function createMA(){
        return view('pages.acara.acara.create');
    }   
    
    public function storeMA(Request $request){
		$date = date('Y-m-d');
        $this->validate($request,[
            'idpeople'=>'required',
            'pelaksana'=>'required',
            'namaacara'=>'required',
            'tanggalmulai'=>'required',
            'tanggalakhir'=>'required',
            //'jammulai'=>'required',
            //'jamakhir'=>'required',
            'namakontak1'=>'required',
            'kontak1'=>'required',
            'biaya'=>'required',
            'satuan'=>'required',
            //'awaldaftar'=>'required',
            //'akhirdaftar'=>'required',
            //'kuota'=>'required',
            'tempat'=>'required',
            'alamat'=>'required',
            ]);

        $acara = new Acara();

        $acara->idpeople = $request->input('idpeople');
        $acara->pelaksana = $request->input('pelaksana');
        $acara->namaacara = $request->input('namaacara');
        $acara->awal_daftar = $request->input('awaldaftar');
        $acara->akhir_daftar = $request->input('akhirdaftar');
        $acara->tanggalmulai = $request->input('tanggalmulai');
        $acara->tanggalakhir = $request->input('tanggalakhir');
        $acara->jammulai = $request->input('jammulai');
        $acara->jamakhir = $request->input('jamakhir');
        $acara->namakontak1 = $request->input('namakontak1');
        $acara->kontak1 = $request->input('kontak1');
        $acara->namakontak2 = $request->input('namakontak2');
        $acara->kontak2 = $request->input('kontak2');
        $acara->biaya = $request->input('biaya');
        $acara->satuan = $request->input('satuan');
        $acara->totalhadiah = $request->input('totalhadiah');
        $acara->hadiahutama = $request->input('hadiahutama');
        $acara->kuota = $request->input('kuota');
        $acara->tempat = $request->input('tempat');
        $acara->alamat = $request->input('alamat');
		if($request->hasFile('brosur')){
			$request->file('brosur');
			$ex = $request->brosur->clientExtension();
			$brosur = $request->brosur->storeAs('public/upload','acara'.$request->input('idpeople').$date.'.'.$ex);
			$acara->brosur = 'acara'.$request->input('idpeople').$date.'.'.$ex;
		} else {$acara->brosur = 'sample.png';}	
        $acara->detail = $request->input('detail');
        $acara->status = 1;
 
        $acara->save();

        return redirect()->route('ma.acara')
                        ->with('message','Acara Created');        
    }
    
    public function destroyMA($id)
    {
        $acara=Acara::find($id)->delete();
        return redirect()->route('ma.acara')
                        ->with('message','Acara Deleted');
    } 
        
    public function updateMA(Request $request,$id)
    {
        $acara=Acara::find($id);
        $pengguna = $request->user()->id;
        if($pengguna!=$acara->idpeople)
            return redirect()->route('ma.acara');
        else
            return view('pages.acara.acara.update',['id'=>$id,'acara'=>$acara,'test'=>$pengguna]);
    }   
       
    public function saveMA(Request $request, $id)
    {
		$date = date('Y-m-d');
        $this->validate($request, [
            'idpeople'=>'required',
            'pelaksana'=>'required',
            'namaacara'=>'required',
            //'awaldaftar'=>'required',
            //'akhirdaftar'=>'required',
            'tanggalmulai'=>'required',
            'tanggalakhir'=>'required',
            //'jammulai'=>'required',
            //'jamakhir'=>'required',
            'namakontak1'=>'required',
            'kontak1'=>'required',
            'biaya'=>'required',
            'satuan'=>'required',
            //'kuota'=>'required',
            'tempat'=>'required',
            'alamat'=>'required',
    ]);
        $acara=Acara::find($id);

        $acara->idpeople = $request->input('idpeople');
        $acara->pelaksana = $request->input('pelaksana');
        $acara->namaacara = $request->input('namaacara');
        $acara->awal_daftar = $request->input('awaldaftar');
        $acara->akhir_daftar = $request->input('akhirdaftar');
        $acara->tanggalmulai = $request->input('tanggalmulai');
        $acara->tanggalakhir = $request->input('tanggalakhir');
        $acara->jammulai = $request->input('jammulai');
        $acara->jamakhir = $request->input('jamakhir');
        $acara->namakontak1 = $request->input('namakontak1');
        $acara->kontak1 = $request->input('kontak1');
        $acara->namakontak2 = $request->input('namakontak2');
        $acara->kontak2 = $request->input('kontak2');
        $acara->biaya = $request->input('biaya');
        $acara->satuan = $request->input('satuan');
        $acara->totalhadiah = $request->input('totalhadiah');
        $acara->hadiahutama = $request->input('hadiahutama');
        $acara->kuota = $request->input('kuota');
        $acara->tempat = $request->input('tempat');
        $acara->alamat = $request->input('alamat');
		if($request->hasFile('brosur')){
			Storage::delete('public/upload/'.$acara->brosur);
			$request->file('brosur');
			$ex = $request->brosur->clientExtension();
			$brosur = $request->brosur->storeAs('public/upload','acara'.$request->input('idpeople').$date.'.'.$ex);
			$acara->brosur = 'acara'.$request->input('idpeople').$date.'.'.$ex;
		} else {$acara->brosur = $acara->brosur;}
        $acara->detail = $request->input('detail');
        $acara->status = 1;
        
        $acara->save();

        return redirect()->route('ma.acara')
                        ->with('message','Acara Updated');
    }  



    public function indexML(Request $request){
        $id = $request->user()->id;
        $acara = Acara::where('idpeople',$id)
                        ->orderBy('id','ASC')
                        ->paginate(10);
        //$acara = Acara::All();
        return view('pages.lapangan.acara.index',compact('acara'))
                            ->with('i',($request->input('page',0)));   
    }
    
    public function readML(Request $request,$id){
        $acara = Acara::find($id);
        $pengguna = $request->user()->id;
        if($pengguna!=$acara->idpeople)
            return redirect()->route('ml.acara');
        else
        return view('pages.lapangan.acara.read',['id'=>$id,'acara'=>$acara]);
    } 
       
    public function createML(){
        return view('pages.lapangan.acara.create');
    }	
    
    public function storeML(Request $request){
		$date = date('Y-m-d');
        $this->validate($request,[
            'idpeople'=>'required',
            'pelaksana'=>'required',
            'namaacara'=>'required',
            'tanggalmulai'=>'required',
            'tanggalakhir'=>'required',
            //'jammulai'=>'required',
            //'jamakhir'=>'required',
            'namakontak1'=>'required',
            'kontak1'=>'required',
            'biaya'=>'required',
            'satuan'=>'required',
            //'awaldaftar'=>'required',
            //'akhirdaftar'=>'required',
            //'kuota'=>'required',
            'tempat'=>'required',
            'alamat'=>'required',
            ]);

        $acara = new Acara();

        $acara->idpeople = $request->input('idpeople');
        $acara->pelaksana = $request->input('pelaksana');
        $acara->namaacara = $request->input('namaacara');
        $acara->awal_daftar = $request->input('awaldaftar');
        $acara->akhir_daftar = $request->input('akhirdaftar');
        $acara->tanggalmulai = $request->input('tanggalmulai');
        $acara->tanggalakhir = $request->input('tanggalakhir');
        $acara->jammulai = $request->input('jammulai');
        $acara->jamakhir = $request->input('jamakhir');
        $acara->namakontak1 = $request->input('namakontak1');
        $acara->kontak1 = $request->input('kontak1');
        $acara->namakontak2 = $request->input('namakontak2');
        $acara->kontak2 = $request->input('kontak2');
        $acara->biaya = $request->input('biaya');
        $acara->satuan = $request->input('satuan');
        $acara->totalhadiah = $request->input('totalhadiah');
        $acara->hadiahutama = $request->input('hadiahutama');
        $acara->kuota = $request->input('kuota');
        $acara->tempat = $request->input('tempat');
        $acara->alamat = $request->input('alamat');
		if($request->hasFile('brosur')){
			$request->file('brosur');
			$ex = $request->brosur->clientExtension();
			$brosur = $request->brosur->storeAs('public/upload','acara'.$request->input('idpeople').$date.'.'.$ex);
			$acara->brosur = 'acara'.$request->input('idpeople').$date.'.'.$ex;
		} else {$acara->brosur = 'sample.png';}	
        $acara->detail = $request->input('detail');
        $acara->status = 1;
 
        $acara->save();

        return redirect()->route('ml.acara')
                        ->with('message','Acara Created');        
    }
    
    public function destroyML($id)
    {
        $acara=Acara::find($id)->delete();
        return redirect()->route('ml.acara')
                        ->with('message','Acara Deleted');
    } 
        
    public function updateML(Request $request,$id)
    {
        $acara=Acara::find($id);
        $pengguna = $request->user()->id;
        if($pengguna!=$acara->idpeople)
            return redirect()->route('ml.acara');
        else
            return view('pages.lapangan.acara.update',['id'=>$id,'acara'=>$acara,'test'=>$pengguna]);
    }   
       
    public function saveML(Request $request, $id)
    {
		$date = date('Y-m-d');
        $this->validate($request, [
            'idpeople'=>'required',
            'pelaksana'=>'required',
            'namaacara'=>'required',
            //'awaldaftar'=>'required',
            //'akhirdaftar'=>'required',
            'tanggalmulai'=>'required',
            'tanggalakhir'=>'required',
            //'jammulai'=>'required',
            //'jamakhir'=>'required',
            'namakontak1'=>'required',
            'kontak1'=>'required',
            'biaya'=>'required',
            'satuan'=>'required',
            //'kuota'=>'required',
            'tempat'=>'required',
            'alamat'=>'required',
    ]);
        $acara=Acara::find($id);

        $acara->idpeople = $request->input('idpeople');
        $acara->pelaksana = $request->input('pelaksana');
        $acara->namaacara = $request->input('namaacara');
        $acara->awal_daftar = $request->input('awaldaftar');
        $acara->akhir_daftar = $request->input('akhir_daftar');
        $acara->tanggalmulai = $request->input('tanggalmulai');
        $acara->tanggalakhir = $request->input('tanggalakhir');
        $acara->jammulai = $request->input('jammulai');
        $acara->jamakhir = $request->input('jamakhir');
        $acara->namakontak1 = $request->input('namakontak1');
        $acara->kontak1 = $request->input('kontak1');
        $acara->namakontak2 = $request->input('namakontak2');
        $acara->kontak2 = $request->input('kontak2');
        $acara->biaya = $request->input('biaya');
        $acara->satuan = $request->input('satuan');
        $acara->totalhadiah = $request->input('totalhadiah');
        $acara->hadiahutama = $request->input('hadiahutama');
        $acara->kuota = $request->input('kuota');
        $acara->tempat = $request->input('tempat');
        $acara->alamat = $request->input('alamat');
		if($request->hasFile('brosur')){
			Storage::delete('public/upload/'.$acara->brosur);
			$request->file('brosur');
			$ex = $request->brosur->clientExtension();
			$brosur = $request->brosur->storeAs('public/upload','acara'.$request->input('idpeople').$date.'.'.$ex);
			$acara->brosur = 'acara'.$request->input('idpeople').$date.'.'.$ex;
		} else {$acara->brosur = $acara->brosur;}
        $acara->detail = $request->input('detail');
        $acara->status = 1;
        
        $acara->save();

        return redirect()->route('ml.acara')
                        ->with('message','Acara Updated');
    }  
     
}
