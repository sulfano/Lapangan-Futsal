<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
//use App\DataKecamatan;
use DB;
use App\Models\Lapangan;
use App\Models\Lap_rating;
use App\Models\Lap_member;
use App\Models\Log_pengunjung;
use App\Models\Log_transaksi;
use App\Models\Modul_kas;
use App\Models\Modul_modal;
use App\Models\Modul_peralatan;
use App\Models\Modul_prive;
use App\Models\Trans_booking;
use App\Models\Trans_booking_p;
use App\Models\Trans_booking_h;
use App\Models\Trans_sewa;
use App\Models\Trans_sewa_p;
use App\Models\Trans_sewa_h;
use App\Models\Trans_lain;
use App\Role;


class MemberController extends Controller
{
	public function index(Request $request){
		$member = User::where('users.level','!=',2)
						->orderBy('id','desc')
						->paginate(15);
		return view('pages.admin.member.index',compact('member'))
                            ->with('i',($request->input('page',0)));
	}
    public function read($id){
        $member = User::where('users.id',$id)
    					->get();
        return view('pages.admin.member.read',['id'=>$id,'member'=>$member]);
    }
    public function create(){
        $roles = Role::whereNotIn('id',[2])->get();
        return view('pages.admin.member.create',['role'=>$roles]);
    }
    protected function store(Request $request)
    {
    	$this->validate($request,[
    		'nama'=>'required',
    		'alamat'=>'required',
    		'jk'=>'required',
    		'tanggallahir'=>'required',
    		'nomorhp'=>'required',
    		'email'=>'required',
    		'password'=>'required',
    		'level'=>'required',
    		]);
        $user = new User();

        $user->nama = $request->input('nama');
        $user->alamat = $request->input('alamat');
        $user->jk = $request->input('jk');
        $user->tanggallahir = $request->input('tanggallahir');
        $user->nomorhp = $request->input('nomorhp');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->level = $request->input('level');

        $user->save();

        //foreach ($request->input('level') as $key => $value) {
            $user->attachRole($request->input('level'));
        //}

		return redirect()->route('admin.member')
						->with('message','Member Created');    	
    }   
 	public function destroy($id)
    {
        $lapangan = DB::table('lapangan')
                        ->select('lapangan.*')
                        ->where('idpeople',$id)
                        ->first();
                        
        $delete1  = Lapangan::where('idpeople', $id)->delete();
        $delete2  = Lap_member::where('idpeople', $id)->delete();
        if($lapangan!=null){
        $delete2  = Lap_rating::where('kodelapangan', $lapangan->kodelapangan)->delete();}
        $delete4  = Log_pengunjung::where('idpeople', $id)->delete();
        $delete5  = Log_transaksi::where('idpeople', $id)->delete();
        $delete9  = Modul_prive::where('idpeople', $id)->delete();
        $delete10 = Modul_peralatan::where('idpeople', $id)->delete();
        $delete11 = Modul_modal::where('idpeople', $id)->delete();
        $delete12 = Modul_kas::where('idpeople', $id)->delete();
        $delete13 = Trans_lain::where('idpeople', $id)->delete();
        $delete16 = Trans_sewa::where('idpeople', $id)->delete();
        $delete17 = Trans_sewa_h::where('idpeople', $id)->delete();
        $delete18 = Trans_sewa_p::where('idpeople', $id)->delete();
        $delete19 = Trans_booking::where('idpeople', $id)->delete();
        $delete20 = Trans_booking_h::where('idpeople', $id)->delete();
        $delete21 = Trans_booking_p::where('idpeople', $id)->delete();
        $delete21 = User::find($id)->delete();
        return redirect()->route('admin.member')
                        ->with('message','Member Deleted');
    } 
	public function update($id)
    {
        $user=User::find($id);
        $roles = Role::whereNotIn('id',[2])->get();
        return view('pages.admin.member.update',['id'=>$id,'user'=>$user,'role'=>$roles]);
    }   
    public function save(Request $request, $id)
    {
    	$this->validate($request,[
    		'nama'=>'required',
    		'alamat'=>'required',
    		'jk'=>'required',
    		'tanggallahir'=>'required',
    		'nomorhp'=>'required',
    		'email'=>'required',
    		'password'=>'required',
    		'level'=>'required',
    		]);
        $user = User::find($id);

        $user->nama = $request->input('nama');
        $user->alamat = $request->input('alamat');
        $user->jk = $request->input('jk');
        $user->tanggallahir = $request->input('tanggallahir');
        $user->nomorhp = $request->input('nomorhp');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->level = $request->input('level');

        $user->save();

		return redirect()->route('admin.member')
						->with('message','Member Updated'); 
    }     
}
