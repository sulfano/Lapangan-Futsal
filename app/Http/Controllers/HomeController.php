<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Acara;
use App\Models\Lapangan;
use App\Models\Lap_rating;
use App\User;
use App\Role;

class HomeController extends Controller
{
    public function home(){
        return view('welcome');
    }
    public function alihkan(){
        return view('pages/umum/lain/switch');
    }
    public function index(){
        $lapangan = DB::table('lapangan')
                                ->leftJoin('lap_rating','lapangan.kodelapangan','=','lap_rating.kodelapangan')
                                ->select('lapangan.*',DB::raw('avg(lap_rating.rating) as rating'))
                                ->groupBy('lapangan.kodelapangan')
                                ->orderBy('rating','DESC')
                                ->limit(5)
                                ->get();
     $acara = DB::table('acara')->join('users','acara.idpeople','=','users.id')
                                ->select('acara.*','users.nama as nama')
                                ->where('status',1)
                                ->orderBy('created_at','DESC')
                                ->paginate(10);
     $terdekat = DB::table('acara')->join('users','acara.idpeople','=','users.id')
                                ->select('acara.*','users.nama as nama')
                                ->where('status',1)
                                ->orderBy('tanggalmulai','ASC')
                                ->limit(5)
                                ->get();
    $lapangantop = DB::table('lapangan')
                                ->leftJoin('lap_rating','lapangan.kodelapangan','=','lap_rating.kodelapangan')
                                ->select('lapangan.*',DB::raw('avg(lap_rating.rating) as rating'),DB::raw('count(lap_rating.rating) as voter'))
                                ->groupBy('lapangan.kodelapangan')
                                ->orderBy('rating','DESC')
                                ->limit(5)
                                ->get();                                
     return view('index',['acara'=>$acara,'lapangan'=>$lapangan,'terdekat'=>$terdekat,'top'=>$lapangantop]);
    }
    public function masuk(){
        return view('pages/umum/lain/form');
    }    
    public function acara(){
        $acara = DB::table('acara')->join('users','acara.idpeople','=','users.id')
                                ->select('acara.*','users.nama as nama')
                                //->where('status',1)
                                ->orderBy('created_at','DESC')
                                ->paginate(10);
        return view('pages/umum/acara/index',['acara'=>$acara]);
    }    
    public function acaraFilter($id){
        $acara = Acara::join('users','acara.idpeople','=','users.id')
                        ->select('acara.*','users.nama as nama')
                        ->whereMonth('tanggalmulai',$id)
                        ->orderBy('id','desc')
                        ->get();
        return view('pages/umum/acara/filter',['acara'=>$acara]);
    }    
    public function acaraRead($id){
        $acara = DB::table('acara')->where('id',$id)->get();
        return view('pages/umum/acara/read',['id'=>$id,'acara'=>$acara]);
    } 
    public function lapangan(){
        $lapangan = Lapangan::All();
        $lapanganbaru = DB::table('lapangan')
                        ->join('users','lapangan.idpeople','=','users.id')
                        ->select('lapangan.*','users.nama as uploader')
                        ->orderBy('created_at','desc')
                        ->paginate(10);
        $kecamatan = DB::table('data_kecamatan')->get();

        return view('pages/umum/lapangan/index',[
                                    'lapangan'=>$lapangan,
                                    'lapanganbaru'=>$lapanganbaru,
                                    //'lapangantop'=>$lapangantop,
                                    'kecamatan'=>$kecamatan
                                    ]);   
    }
    public function lapanganFilter($id){
        $lapangan = DB::table('lapangan')
                                ->join('data_kelurahan','data_kelurahan.id','=','lapangan.kelurahan')
                                ->join('users','lapangan.idpeople','=','users.id')
                                ->select('lapangan.*','users.nama as uploader')
                                ->where('data_kelurahan.idkecamatan',$id)
                                ->get();
        $kecamatan = DB::table('data_kecamatan')->get();

        return view('pages/umum/lapangan/filter',[
                                    'lapanganbaru'=>$lapangan,
                                    'kecamatan'=>$kecamatan
                                    ]);   
    }

    public function lapanganRead($id){
        $lapangan = DB::table('lapangan')->where('kodelapangan',$id)->get();
        $rating = DB::table('lap_rating')->where('kodelapangan',$id)
                                         ->avg('rating');
                                         
        return view('pages/umum/lapangan/read',['id'=>$id,'lapangan'=>$lapangan,'rating'=>$rating]);
    }      
    public function peta(){
        $lapangan = Lapangan::all();
        $kecamatan = DB::table('data_kecamatan')->get();
        return view('pages/umum/lapangan/peta',['lapangan'=>$lapangan,'kecamatan'=>$kecamatan]);
    }
    public function petaFilter($id){
        $lapangan = DB::table('lapangan')
                                ->join('data_kelurahan','data_kelurahan.id','=','lapangan.kelurahan')
                                ->select('lapangan.*')
                                ->where('data_kelurahan.idkecamatan',$id)
                                ->get();
        $kecamatan = DB::table('data_kecamatan')->get();
        $center = DB::table('data_kecamatan')->where('id',$id)->first();
        return view('pages/umum/lapangan/petaFilter',['lapangan'=>$lapangan,'kecamatan'=>$kecamatan,'center'=>$center]);
    }
    public function rating(Request $request){

        $data=Lap_rating::select('*')
                            ->where('kodelapangan',$request->input('kodelapangan'))
                            ->where('email',$request->input('email'))
                            ->get();
        $id=$request->input('kodelapangan');
        $count = count($data);
        if($count==0){
            $rate = new Lap_rating();
            $id = $request->input('kodelapangan');
            $email = $request->input('email');
            $rate->kodelapangan = $request->input('kodelapangan');
            $rate->rating = $request->input('rating');
            $rate->email = $request->input('email');
           
            $rate->save();
            return redirect()->route('lapangan.read', ['id' => $id]); 
        } elseif ($count==1){
             $data=DB::table('lap_rating')
                            ->select('*')
                            ->where('kodelapangan',$request->input('kodelapangan'))
                            ->where('email',$request->input('email'))
                            ->update([
                            'rating' => $request->input('rating')]);
                            return redirect()->route('lapangan.read', ['id' => $id]); 
        }

        // $rate = new Lap_rating();
        // $id = $request->input('kodelapangan');
        // $email = $request->input('email');
        // $rate->kodelapangan = $request->input('kodelapangan');
        // $rate->rating = $request->input('rating');
        // $rate->email = $request->input('email');
       
        // $rate->save();

        // return redirect()->route('lapangan.read', ['id' => $id]); 
    }
    public function image1($id){
        return view('image',['id'=>$id]);
    }
    public function register(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'alamat'=>'required',
            'jk'=>'required',
            'tanggallahir'=>'required',
            'nomorhp'=>'required',
            'email'=>'required',
            'password'=>'required',
            'level'=>'required',
            ]);
        $user = new User();

        $user->nama = $request->input('name');
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

        return redirect()->route('login')->with('message','Register Success, Please Login');     
    }     
}

/* Query
SELECT lapangan.nama,AVG(lap_rating.rating) as rate FROM lapangan, lap_rating WHERE lapangan.kodelapangan=lap_rating.kodelapangan GROUP BY lap_rating.kodelapangan ORDER BY rate DESC
*/