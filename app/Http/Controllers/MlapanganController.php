<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Lapangan;
use App\Models\Acara;
use App\Models\Data_kelurahan;
use App\User;

class MlapanganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }	
    public function check(Request $request){
        $akun = $request->user()->id;
        $lapangan = DB::table('lapangan')
                                ->select('lapangan.*')
                                ->where('lapangan.idpeople',$akun)
                                ->first(); 
        return $lapangan;
    }
    public function index(Request $request){
        $check = $this->check($request);
        if($check==null)
            return redirect()->route('ml.lapangan.create');
        else 
            return redirect()->route('ml.lapangan');
    }  
    
    public function akun($id){
        $user=User::find($id);
        return view('pages.lapangan.akun.update',['id'=>$id,'user'=>$user]);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'alamat' => 'required',
            'jk' => 'required',
            'tanggallahir' => 'required',
            'nomorhp' => 'required',
            'email' => 'required',
            'password' => 'required',
    ]);
        $user=User::find($id);

        $user->nama = $request->input('name');
        $user->alamat = $request->input('alamat');
        $user->jk = $request->input('jk');
        $user->tanggallahir = $request->input('tanggallahir');
        $user->nomorhp = $request->input('nomorhp');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        
        $user->save();

        return redirect()->route('ml.lapangan')
                        ->with('message','Akun Updated');
    }    
}
