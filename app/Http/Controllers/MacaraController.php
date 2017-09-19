<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Acara;

class MacaraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }	
    public function index(Request $request){
        $id = $request->user()->id;
        $acara = Acara::where('idpeople',$id)
                        ->orderBy('id','ASC')
                        ->paginate(10);
        //$acara = Acara::All();
        return view('pages.acara.acara.index',compact('acara'))
                            ->with('i',($request->input('page',0)));   
    }
    public function akun($id){
    	$user=User::find($id);
    	return view('pages.acara.akun.update',['id'=>$id,'user'=>$user]);
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

        return redirect()->route('ma.acara')
                        ->with('message','Akun Updated');
    } 
}
