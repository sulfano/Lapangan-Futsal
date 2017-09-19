<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Lap_member;
use App\Models\Lapangan;

class LapmemberController extends Controller
{
    var $hari = array(
            "Senin",
            "Selasa",
            "Rabu",
            "Kamis",
            "Jumat",
            "Sabtu",
            "Minggu",
            );
    public function index(Request $request){
		$akun = $request->user()->id;
    	$member = DB::table('lap_member')
    					->join('lapangan','lap_member.kodelapangan','=','lapangan.kodelapangan')
    					->select('lap_member.*')
    					->where('lapangan.idpeople',$akun)
    					->orderBy('id','desc')
    					->paginate(15);
		return view('pages.lapangan.member.index',compact('member'),['hari'=>$this->hari])
												->with('i',($request->input('page',0)));   
    }

    public function destroy($id){
        $member=Lap_member::find($id)->delete();
        return redirect()->route('ml.member')
                        ->with('message','Member Deleted');
    }
    public function create(Request $request){
        $akun = $request->user()->id;
        $lapangan = DB::table('lapangan')
                ->select('lapangan.kodelapangan')
                ->where('idpeople',$akun)
                ->first();

        return view('pages.lapangan.member.create',['hari'=>$this->hari,'lapangan'=>$lapangan]);
    }
    public function store(Request $request){
        $this->validate($request,[
            'kodelapangan'=>'required',
            'nama'=>'required',
            'hari'=>'required',
            'jam'=>'required',
            ]);

        $member = new Lap_member();

        $member->idpeople = $request->user()->id;
        $member->kodelapangan = $request->input('kodelapangan');
        $member->nama = $request->input('nama');
        $member->hari = $request->input('hari');
        $member->jam = $request->input('jam');

        $member->save();

        return redirect()->route('ml.member')
                         ->with('message','Member Registered');
    }
    public function update(Request $request,$id){
        $akun = $request->user()->id;
        $lapangan = DB::table('lapangan')
                ->select('lapangan.kodelapangan')
                ->where('idpeople',$akun)
                ->first();        
        $member=Lap_member::find($id);
        return view('pages.lapangan.member.update',['id'=>$id,'member'=>$member,'lapangan'=>$lapangan,'hari'=>$this->hari]);
    }
    public function save(Request $request, $id){
    $this->validate($request, [
            'kodelapangan'=>'required',
            'nama'=>'required',
            'hari'=>'required',
            'jam'=>'required',
    ]);
        $member=Lap_member::find($id);

        $member->kodelapangan = $request->input('kodelapangan');
        $member->nama = $request->input('nama');
        $member->hari = $request->input('hari');
        $member->jam = $request->input('jam');
 
        $member->save();

        return redirect()->route('ml.member')
                        ->with('message','Member Updated');
    }
    public function jadwal(Request $request,$id){
        $akun = $request->user()->id;
        $lapangan = DB::table('lapangan')
                ->select('lapangan.kodelapangan')
                ->where('idpeople',$akun)
                ->first(); 
        $jadwal = DB::table('lap_member')
                ->select('lap_member.jam')
                ->where('hari',$id)
                ->where('idpeople',$akun)
                ->get();        
        return view('pages.lapangan.member.jadwal',['jadwal'=>$jadwal]);
    }
}
