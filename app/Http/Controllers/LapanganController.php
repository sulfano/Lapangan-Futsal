<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data_kelurahan;
use App\Models\Lapangan;
use App\Models\Modul_kas;
use App\Models\Modul_modal;
use App\Models\Modul_peralatan;
use DB;
use Illuminate\Support\Facades\Storage;

class LapanganController extends Controller
{
    public function kode(){
        $kode = DB::table('Lapangan')->max('kodelapangan');
        $urut = (int) substr($kode, 3, 4);
        $urut = $urut+1;
        return $urut;
    }    
    public function index(Request $request){
        $lapangan = DB::table('lapangan')
                     ->join('data_kelurahan','lapangan.kelurahan','=','data_kelurahan.id')
                     ->select('lapangan.*','data_kelurahan.nama as namakel')
                     ->orderBy('lapangan.created_at','DESC')
                     ->paginate(15);
        return view('pages.admin.lapangan.index',compact('lapangan'))
                            ->with('i',($request->input('page',0)));   
    }
    public function create(){
        $kode = $this->kode();
        $kel=Data_kelurahan::All();
        return view('pages.admin.lapangan.create',['kode'=>$kode,'kelurahan'=>$kel]);
    }
    public function store(Request $request){
        
		$this->validate($request,[
        'idpeople'=>'required',
        'kodelapangan'=>'required',
        'nama'=>'required',
        'alamat'=>'required',
        'kelurahan'=>'required',
        'hargasiang'=>'required',
        'hargamalam'=>'required',
        'hargasewa'=>'required',
        'namapemilik'=>'required',
        'namapetugas'=>'required',
        'latitude'=>'required',
        'longitude'=>'required',
         'peralatan'=>'required',
         'kas'=>'required',
         'modal'=>'required',
         'masa'=>'required',
            ]);
        
        $lapangan = new Lapangan();
        $modal = new Modul_modal();
        $kas = new Modul_kas();
        $peralatan = new Modul_peralatan();
        $lapangan->idpeople = $request->input('idpeople');
        $lapangan->kodelapangan = $request->input('kodelapangan');
        $lapangan->nama = $request->input('nama');
        $lapangan->alamat = $request->input('alamat');
        $lapangan->kelurahan = $request->input('kelurahan');
        $lapangan->hargasiang = $request->input('hargasiang');
        $lapangan->hargamalam = $request->input('hargamalam');
        $lapangan->hargasewa = $request->input('hargasewa');
        $lapangan->lantai = $request->input('lantai');
        $lapangan->namapemilik = $request->input('namapemilik');
        $lapangan->namapetugas = $request->input('namapetugas');
        $lapangan->latitude = $request->input('latitude');
        $lapangan->longitude = $request->input('longitude');
        $lapangan->panjang = $request->input('panjang');
        $lapangan->lebar = $request->input('lebar');
        $lapangan->perkiraan_masa = $request->input('masa');
        $lapangan->status = 1;
		
		//$lapangan->foto1 = $request->file('foto1');
        //$lapangan->foto2 = $request->file('foto2');
        //$lapangan->foto3 = $request->file('foto3');
        //$lapangan->foto4 = $request->file('foto4');
		if($request->hasFile('foto1')){
			$request->file('foto1');
			$ex = $request->foto1->clientExtension();
			$foto1 = $request->foto1->storeAs('public/upload','1'.$request->input('kodelapangan').'.'.$ex);
			$lapangan->foto1 = '1'.$request->input('kodelapangan').'.'.$ex;
		} else {$lapangan->foto1 = 'sample.png';}
		if($request->hasFile('foto2')){
			$request->file('foto2');
			$ex = $request->foto2->clientExtension();
			$foto2 = $request->foto2->storeAs('public/upload','2'.$request->input('kodelapangan').'.'.$ex);
			$lapangan->foto2 = '2'.$request->input('kodelapangan').'.'.$ex;
		} else {$lapangan->foto2 = 'sample.png';}
		if($request->hasFile('foto3')){
			$request->file('foto3');
			$ex = $request->foto3->clientExtension();
			$foto3 = $request->foto1->storeAs('public/upload','3'.$request->input('kodelapangan').'.'.$ex);
			$lapangan->foto3 = '3'.$request->input('kodelapangan').'.'.$ex;
		} else {$lapangan->foto3 = 'sample.png';}
		if($request->hasFile('foto4')){
			$request->file('foto4');
			$ex = $request->foto4->clientExtension();
			$foto4 = $request->foto4->storeAs('public/upload','4'.$request->input('kodelapangan').'.'.$ex);
			$lapangan->foto4 = '4'.$request->input('kodelapangan').'.'.$ex;
		} else {$lapangan->foto4 = 'sample.png';}
			
			
        $lapangan->save();

        $modal->kodelapangan = $request->input('kodelapangan');
        $modal->idpeople = $request->input('idpeople');
        $modal->nominal = $request->input('modal');
        $modal->bulan = date('m');
        $modal->tahun = date('Y');

        $modal->save();

        $kas->kodelapangan = $request->input('kodelapangan');
        $kas->idpeople = $request->input('idpeople');
        $kas->investasi = $request->input('kas');
        $kas->bulan = date('m');
        $kas->tahun = date('Y');

        $kas->save();

        $peralatan->kodelapangan = $request->input('kodelapangan');
        $peralatan->idpeople = $request->input('idpeople');
        $peralatan->nominal = $request->input('peralatan');
        $peralatan->bulan = date('m');
        $peralatan->tahun = date('Y');

        $peralatan->save();


        return redirect()->route('admin.lapangan')
                        ->with('message','Lapangan Created');
    }
    public function read($id){
       // $lapangan = Lapangan::find($id);
        $lapangan = DB::table('lapangan')
                     ->join('data_kelurahan','lapangan.kelurahan','=','data_kelurahan.id')
                     //->join('users','lapangan.idpeople','=','users.id')
                     ->select('lapangan.*','data_kelurahan.nama as namakel')
                    // ->select('lapangan.*')
                     ->where('lapangan.kodelapangan',$id)
                     ->get();
                     
        return view('pages.admin.lapangan.read',['id'=>$id,'lapangan'=>$lapangan]);
    }
    public function destroy($id)
    {
        $lapangan=DB::table('lapangan')->select('lapangan.*')->where('lapangan.kodelapangan',$id)->delete();
        $lapangan=DB::table('lap_member')->select('lapangan.*')->where('lap_member.kodelapangan',$id)->delete();
        $lapangan=DB::table('lap_rating')->select('lapangan.*')->where('lap_rating.kodelapangan',$id)->delete();
        $lapangan=DB::table('log_pengunjung')->select('lapangan.*')->where('log_pengunjung.kodelapangan',$id)->delete();
        $lapangan=DB::table('log_transaksi')->select('lapangan.*')->where('log_transaksi.kodelapangan',$id)->delete();
        $lapangan=DB::table('modul_kas')->select('lapangan.*')->where('modul_kas.kodelapangan',$id)->delete();
        $lapangan=DB::table('modul_peralatan')->select('lapangan.*')->where('modul_peralatan.kodelapangan',$id)->delete();
        $lapangan=DB::table('modul_modal')->select('lapangan.*')->where('modul_modal.kodelapangan',$id)->delete();
        $lapangan=DB::table('modul_prive')->select('lapangan.*')->where('modul_prive.kodelapangan',$id)->delete();
        $lapangan=DB::table('trans_booking')->select('lapangan.*')->where('trans_booking.kodelapangan',$id)->delete();
        $lapangan=DB::table('trans_booking_h')->select('lapangan.*')->where('trans_booking_h.kodelapangan',$id)->delete();
        $lapangan=DB::table('trans_booking_p')->select('lapangan.*')->where('trans_booking_p.kodelapangan',$id)->delete();
        $lapangan=DB::table('trans_sewa')->select('lapangan.*')->where('trans_sewa.kodelapangan',$id)->delete();
        $lapangan=DB::table('trans_sewa_h')->select('lapangan.*')->where('trans_sewa_h.kodelapangan',$id)->delete();
        $lapangan=DB::table('trans_sewa_p')->select('lapangan.*')->where('trans_sewa_p.kodelapangan',$id)->delete();
        $lapangan=DB::table('trans_lain')->select('lapangan.*')->where('trans_lain.kodelapangan',$id)->delete();
        return redirect()->route('admin.lapangan')
                        ->with('message','Lapangan Deleted');
    }     
    public function update($id)
    {
        $lapangan=DB::table('lapangan')
                            ->select('lapangan.*')
                            ->where('lapangan.kodelapangan',$id)
                            ->get();
        $kel=Data_kelurahan::All();
        return view('pages.admin.lapangan.update',['id'=>$id,'lapangan'=>$lapangan,'kelurahan'=>$kel]);
    }   
    public function save(Request $request, $id)
    {
        $this->validate($request,[
        'kodelapangan'=>'required',
        'nama'=>'required',
        'alamat'=>'required',
        'kelurahan'=>'required',
        'hargasiang'=>'required',
        'hargamalam'=>'required',
        'hargasewa'=>'required',
        'namapemilik'=>'required',
        'namapetugas'=>'required',
        'latitude'=>'required',
        'longitude'=>'required',
        'status'=>'required',       
            ]);
			
        $lapangan1=DB::table('lapangan')
                            ->select('lapangan.*')
                            ->where('lapangan.kodelapangan',$id)
							->first();
		
			
		if($request->hasFile('fotoa')){
			Storage::delete('public/upload/'.$lapangan1->foto1);
			$request->file('fotoa');
			$ex = $request->fotoa->clientExtension();
			$request->fotoa->storeAs('public/upload','1'.$request->input('kodelapangan').'.'.$ex);
			$foto1 = '1'.$request->input('kodelapangan').'.'.$ex;
		} else {$foto1 = $lapangan1->foto1;}
		
		if($request->hasFile('fotob')){
			Storage::delete('public/upload/'.$lapangan1->foto2);
			$request->file('fotob');
			$ex = $request->fotob->clientExtension();
			$request->fotob->storeAs('public/upload','2'.$request->input('kodelapangan').'.'.$ex);
			$foto2 = '2'.$request->input('kodelapangan').'.'.$ex;
		} else {$foto2 = $lapangan1->foto2;}
		
		if($request->hasFile('fotoc')){
			Storage::delete('public/upload/'.$lapangan1->foto3);
			$request->file('fotoc');
			$ex = $request->fotoc->clientExtension();
			$request->fotoc->storeAs('public/upload','3'.$request->input('kodelapangan').'.'.$ex);
			$foto3 = '3'.$request->input('kodelapangan').'.'.$ex;
			
		} else {$foto3 = $lapangan1->foto3;}
		if($request->hasFile('fotod')){
			Storage::delete('public/upload/'.$lapangan1->foto4);
			$request->file('fotod');
			$ex = $request->fotod->clientExtension();
			$request->fotod->storeAs('public/upload','4'.$request->input('kodelapangan').'.'.$ex);
			$foto4 = '4'.$request->input('kodelapangan').'.'.$ex;
		} else {$foto4 = $lapangan1->foto4;}	
		
        $lapangan1=DB::table('lapangan')
                            ->select('lapangan.*')
                            ->where('lapangan.kodelapangan',$id)
                            ->update([
        'kodelapangan' => $request->input('kodelapangan'),
        'nama' => $request->input('nama'),
        'alamat' => $request->input('alamat'),
        'kelurahan' => $request->input('kelurahan'),
        'foto1' => $foto1,
        'foto2' => $foto2,
        'foto3' => $foto3,
        'foto4' => $foto4,
        'hargasiang' => $request->input('hargasiang'),
        'hargamalam' => $request->input('hargamalam'),
        'hargasewa' => $request->input('hargasewa'),
        'lantai' => $request->input('lantai'),
        'namapemilik' => $request->input('namapemilik'),
        'namapetugas' => $request->input('namapetugas'),
        'latitude' => $request->input('latitude'),
        'longitude' => $request->input('longitude'),
        'panjang' => $request->input('panjang'),
        'lebar' => $request->input('lebar'),
        'status' => $request->input('status')                            
                                ]);

        return redirect()->route('admin.lapangan')
                        ->with('message','Lapangan Updated');
    }    

//===========================================================================
	public function indexML(Request $request){
        $akun = $request->user()->id;
        $pengunjung = DB::table('log_pengunjung')->where('idpeople',$akun)->count();
        $lapangan = DB::table('lapangan')
                                ->leftJoin('lap_rating','lapangan.kodelapangan','=','lap_rating.kodelapangan')
                                ->select('lapangan.*',DB::raw('avg(lap_rating.rating) as rating'),DB::raw('count(lap_rating.rating) as voter'))
                                ->where('lapangan.idpeople',$akun)
                                ->get();
    	return view('pages.lapangan.index',compact('lapangan'),['pengunjung'=>$pengunjung])
                            ->with('i',($request->input('page',0)));   
	}
    public function createML(){
        $kode = $this->kode();
        $kel=Data_kelurahan::All();
    	return view('pages.lapangan.lapangan.create',['kode'=>$kode,'kelurahan'=>$kel]);
    }
    public function storeML(Request $request){
    	$this->validate($request,[
        'idpeople'=>'required',
        'kodelapangan'=>'required',
        'nama'=>'required',
        'alamat'=>'required',
        'kelurahan'=>'required',
        'hargasiang'=>'required',
        'hargamalam'=>'required',
        'hargasewa'=>'required',
        'namapemilik'=>'required',
        'namapetugas'=>'required',
        //'latitude'=>'required',
        //'longitude'=>'required',
        'peralatan'=>'required',
        'kas'=>'required',
        'masa'=>'required',
        'modal'=>'required',        
    		]);
		// DataKecamatan::create($request->all());
        $lapangan = new Lapangan();
        $modal = new Modul_modal();
        $kas = new Modul_kas();
        $peralatan = new Modul_peralatan();

        $lapangan->idpeople = $request->input('idpeople');
        $lapangan->kodelapangan = $request->input('kodelapangan');
        $lapangan->nama = $request->input('nama');
        $lapangan->alamat = $request->input('alamat');
        $lapangan->kelurahan = $request->input('kelurahan');
        $lapangan->hargasiang = $request->input('hargasiang');
        $lapangan->hargamalam = $request->input('hargamalam');
        $lapangan->hargasewa = $request->input('hargasewa');
        $lapangan->lantai = $request->input('lantai');
        $lapangan->namapemilik = $request->input('namapemilik');
        $lapangan->namapetugas = $request->input('namapetugas');
        $lapangan->latitude = $request->input('latitude');
        $lapangan->longitude = $request->input('longitude');
        $lapangan->panjang = $request->input('panjang');
        $lapangan->lebar = $request->input('lebar');
        $lapangan->perkiraan_masa = $request->input('masa');
        $lapangan->status = 1;

		if($request->hasFile('foto1')){
			$request->file('foto1');
			$ex = $request->foto1->clientExtension();
			$foto1 = $request->foto1->storeAs('public/upload','1'.$request->input('kodelapangan').'.'.$ex);
			$lapangan->foto1 = '1'.$request->input('kodelapangan').'.'.$ex;
		} else {$lapangan->foto1 = 'sample.png';}
		if($request->hasFile('foto2')){
			$request->file('foto2');
			$ex = $request->foto2->clientExtension();
			$foto2 = $request->foto2->storeAs('public/upload','2'.$request->input('kodelapangan').'.'.$ex);
			$lapangan->foto2 = '2'.$request->input('kodelapangan').'.'.$ex;
		} else {$lapangan->foto2 = 'sample.png';}
		if($request->hasFile('foto3')){
			$request->file('foto3');
			$ex = $request->foto3->clientExtension();
			$foto3 = $request->foto1->storeAs('public/upload','3'.$request->input('kodelapangan').'.'.$ex);
			$lapangan->foto3 = '3'.$request->input('kodelapangan').'.'.$ex;
		} else {$lapangan->foto3 = 'sample.png';}
		if($request->hasFile('foto4')){
			$request->file('foto4');
			$ex = $request->foto4->clientExtension();
			$foto4 = $request->foto4->storeAs('public/upload','4'.$request->input('kodelapangan').'.'.$ex);
			$lapangan->foto4 = '4'.$request->input('kodelapangan').'.'.$ex;
		} else {$lapangan->foto4 = 'sample.png';}		

        $lapangan->save();

        $modal->kodelapangan = $request->input('kodelapangan');
        $modal->idpeople = $request->input('idpeople');
        $modal->nominal = $request->input('modal');
        $modal->bulan = date('m');
        $modal->tahun = date('Y');

        $modal->save();

        $kas->kodelapangan = $request->input('kodelapangan');
        $kas->idpeople = $request->input('idpeople');
        $kas->investasi = $request->input('kas');
        $kas->bulan = date('m');
        $kas->tahun = date('Y');

        $kas->save();

        $peralatan->kodelapangan = $request->input('kodelapangan');
        $peralatan->idpeople = $request->input('idpeople');
        $peralatan->nominal = $request->input('peralatan');
        $peralatan->bulan = date('m');
        $peralatan->tahun = date('Y');

        $peralatan->save();
		return redirect()->route('memberlapangan')
						->with('message','Lapangan Created');
    }    
    public function updateML(Request $request,$id)    {
        $lapangan=DB::table('lapangan')
                            ->select('lapangan.*')
                            ->where('lapangan.kodelapangan',$id)
                            ->get();
        $kel=Data_kelurahan::All();
        $pengguna = $request->user()->id;
        foreach ($lapangan as $lapangans) {
            if($pengguna!=$lapangans->idpeople)
                return redirect()->route('ml.lapangan');
            else
                return view('pages.lapangan.lapangan.update',['id'=>$id,'lapangan'=>$lapangan,'kelurahan'=>$kel]);
        }

    }   
    public function saveML(Request $request, $id)    {
        $this->validate($request,[
        'idpeople'=>'required',
        'kodelapangan'=>'required',
        'nama'=>'required',
        'alamat'=>'required',
        'kelurahan'=>'required',
        'hargasiang'=>'required',
        'hargamalam'=>'required',
        'hargasewa'=>'required',
        'namapemilik'=>'required',
        'namapetugas'=>'required',
        'latitude'=>'required',
        'longitude'=>'required',
            ]);
	$lapangan1=DB::table('lapangan')
                            ->select('lapangan.*')
                            ->where('lapangan.kodelapangan',$id)
							->first();
		
			
		if($request->hasFile('fotoa')){
			Storage::delete('public/upload/'.$lapangan1->foto1);
			$request->file('fotoa');
			$ex = $request->fotoa->clientExtension();
			$request->fotoa->storeAs('public/upload','1'.$request->input('kodelapangan').'.'.$ex);
			$foto1 = '1'.$request->input('kodelapangan').'.'.$ex;
		} else {$foto1 = $lapangan1->foto1;}
		
		if($request->hasFile('fotob')){
			Storage::delete('public/upload/'.$lapangan1->foto2);
			$request->file('fotob');
			$ex = $request->fotob->clientExtension();
			$request->fotob->storeAs('public/upload','2'.$request->input('kodelapangan').'.'.$ex);
			$foto2 = '2'.$request->input('kodelapangan').'.'.$ex;
		} else {$foto2 = $lapangan1->foto2;}
		
		if($request->hasFile('fotoc')){
			Storage::delete('public/upload/'.$lapangan1->foto3);
			$request->file('fotoc');
			$ex = $request->fotoc->clientExtension();
			$request->fotoc->storeAs('public/upload','3'.$request->input('kodelapangan').'.'.$ex);
			$foto3 = '3'.$request->input('kodelapangan').'.'.$ex;
			
		} else {$foto3 = $lapangan1->foto3;}
		if($request->hasFile('fotod')){
			Storage::delete('public/upload/'.$lapangan1->foto4);
			$request->file('fotod');
			$ex = $request->fotod->clientExtension();
			$request->fotod->storeAs('public/upload','4'.$request->input('kodelapangan').'.'.$ex);
			$foto4 = '4'.$request->input('kodelapangan').'.'.$ex;
		} else {$foto4 = $lapangan1->foto4;}	
		
        $lapangan=DB::table('lapangan')
                            ->select('lapangan.*')
                            ->where('lapangan.kodelapangan',$id)
                            ->update([
        'idpeople' => $request->input('idpeople'),
        'kodelapangan' => $request->input('kodelapangan'),
        'nama' => $request->input('nama'),
        'alamat' => $request->input('alamat'),
        'kelurahan' => $request->input('kelurahan'),
        'foto1' => $foto1,
        'foto2' => $foto2,
        'foto3' => $foto3,
        'foto4' => $foto4,
        'hargasiang' => $request->input('hargasiang'),
        'hargamalam' => $request->input('hargamalam'),
        'hargasewa' => $request->input('hargasewa'),
        'lantai' => $request->input('lantai'),
        'namapemilik' => $request->input('namapemilik'),
        'namapetugas' => $request->input('namapetugas'),
        'latitude' => $request->input('latitude'),
        'longitude' => $request->input('longitude'),
        'panjang' => $request->input('panjang'),
        'lebar' => $request->input('lebar'),                           
                          
                                ]);

        return redirect()->route('ml.lapangan')
                        ->with('message','Lapangan Updated');
    } 

}
