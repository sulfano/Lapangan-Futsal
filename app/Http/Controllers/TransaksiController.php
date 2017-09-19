<?php
/*	
	status 1 = piutang
	status 2 = lunas
	status 3 = batal
	status 4 = hutang
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Lapangan;
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

use Barryvdh\DomPDF\Facade as PDF;


class TransaksiController extends Controller
{
//MEMBOOKING=============================================================================================
    public function bookingIndex(Request $request){
		date_default_timezone_set("Asia/Jakarta");
        $akun = $request->user()->id;
        $now = date("Y-m-d");
        $date = strtotime($now);
        $booking = Trans_booking::join('trans_booking_p','trans_booking.id','=','trans_booking_p.idbooking')
            ->select('trans_booking.*',DB::raw('sum(trans_booking_p.nominal) as piutang'))
            ->where('trans_booking.idpeople',$akun)
			->orderBy('id','desc')
			->groupBy('trans_booking.id')
            ->paginate(15);
        $transaksi = Trans_booking::where('status','<>',2)
			->Where('status','<>',3)
            ->where('idpeople',$akun)
			->orderBy('id','desc')
            ->paginate(15);
        $today = Trans_booking::join('trans_booking_p','trans_booking.id','=','trans_booking_p.idbooking')
            ->select('trans_booking.*',DB::raw('sum(trans_booking_p.nominal) as piutang'))
            ->where('trans_booking.idpeople',$akun)
            ->where('trans_booking.tanggal','=',$now)
			->orderBy('id','desc')
			->groupBy('trans_booking.id')
            ->paginate(15);
        $tomorrow = Trans_booking::join('trans_booking_p','trans_booking.id','=','trans_booking_p.idbooking')
            ->select('trans_booking.*',DB::raw('sum(trans_booking_p.nominal) as piutang'))
            ->where('trans_booking.idpeople',$akun)
            ->where('trans_booking.tanggal','>',$now)
			->orderBy('id','desc')
			->groupBy('trans_booking.id')
            ->paginate(15);
    	return view('pages.lapangan.transaksi.bookingIndex',['booking'=>$booking,'transaksi'=>$transaksi,'bookingtoday'=>$today,'tomorrow'=>$tomorrow])
            ->with('i',($request->input('page',0)));
    }
    public function bookingCreate(Request $request){
        date_default_timezone_set("Asia/Jakarta");
        $akun = $request->user()->id;
        
        $lapangan = DB::table('lapangan')
                        ->select('lapangan.*')
                        ->where('idpeople',$akun)
                        ->first();         
        return view('pages.lapangan.transaksi.bookingCreate',['lapangan'=>$lapangan]);
    }
    public function bookingStore(Request $request){
        $akun = $request->user()->id;
        $lapangan = DB::table('lapangan')
                        ->select('lapangan.*')
                        ->where('idpeople',$akun)
                        ->first();
        $this->validate($request,[
            'nama'=>'required',
            'tanggal'=>'required',
            'jam'=>'required',
            'lama'=>'required',
            'nominal'=>'required',
            ]);
		$waktu = $request->input('jam');
        $batas = '19:00:00';
		$lama = $request->input('lama');
		
        if($waktu>=$batas){
            $harga = $lapangan->hargamalam;
			//echo $harga;
			//echo $waktu;
			//echo $batas;
		}
        else{
            $harga = $lapangan->hargasiang;
			//echo $harga;
			//echo $waktu;
			//echo $batas;
		}
		$total = $harga * $lama;
		$pt = $total - $request->input('nominal');
		
        $booking = new Trans_booking();

        $booking->kodelapangan = $lapangan->kodelapangan;
        $booking->idpeople = $akun;
        $booking->pembooking = $request->input('nama');
        $booking->tanggal = $request->input('tanggal');
        $booking->jam = $request->input('jam');
        $booking->lama =  $request->input('lama');
        $booking->nominal = $request->input('nominal');
		$booking->total = $total;
        $booking->status = 1;

        if($booking->save()){
            $id = DB::table('trans_booking')->max('id');
            $piutang = new Trans_booking_p();

            $piutang->kodelapangan = $lapangan->kodelapangan;
            $piutang->idpeople = $akun;
            $piutang->idbooking = $id;
            $piutang->nominal = $pt;
            $piutang->status = 1;

            $piutang->save();
			
			$log_pengunjung = new Log_pengunjung();
			$log_pengunjung->kodelapangan = $lapangan->kodelapangan;
			$log_pengunjung->idpeople = $akun;
			$log_pengunjung->nama = $request->input('nama');
			$log_pengunjung->tanggal = $request->input('tanggal');
			$log_pengunjung->kategori = 'Booking';
			$log_pengunjung->save();
			
			$log_transaksi = new Log_transaksi();
			$log_transaksi->kodelapangan = $lapangan->kodelapangan;
			$log_transaksi->idpeople = $akun;
			$log_transaksi->perkiraan = 'Booking Oleh '.$request->input('nama');
			$log_transaksi->debit = $request->input('nominal');
			$log_transaksi->save();
			
			$log_transaksi1 = new Log_transaksi();
			$log_transaksi1->kodelapangan = $lapangan->kodelapangan;
			$log_transaksi1->idpeople = $akun;
			$log_transaksi1->perkiraan = 'Piutang Booking Oleh '.$request->input('nama');
			$log_transaksi1->piutang = $pt;
			$log_transaksi1->save();
        }

    	return redirect()->route('ml.booking');
    }
    public function bookingDestroy($id){
		$booking1 = Trans_booking::find($id)->delete();
		$booking2 = Trans_booking_p::where('idbooking',$id)->delete();
		$booking3 = Trans_booking_h::where('idbooking',$id)->delete();
        return redirect()->route('ml.booking')
									->with('message','Booking Deleted');
    }
    public function bookingUpdate(Request $request,$id){
        date_default_timezone_set("Asia/Jakarta");
        $akun = $request->user()->id;
        $waktu = date("h:i:s a");
        $batas = '07:00:00 pm';
        $lapangan = DB::table('lapangan')
                        ->select('lapangan.*')
                        ->where('idpeople',$akun)
                        ->first();  
        if($waktu>$batas)
            $harga = $lapangan->hargamalam;
        else
            $harga = $lapangan->hargasiang;		
		$booking = Trans_booking::find($id);
        return view('pages.lapangan.transaksi.bookingUpdate',['booking'=>$booking,'harga'=>$harga]);
    }
    public function bookingSave(Request $request,$id){
        $akun = $request->user()->id;
        $lapangan = DB::table('lapangan')
                        ->select('lapangan.*')
                        ->where('idpeople',$akun)
                        ->first();
        $this->validate($request,[
            'nama'=>'required',
            'tanggal'=>'required',
            'jam'=>'required',
            'lama'=>'required',
            'nominal'=>'required',
            ]);
		$waktu = $request->input('tanggal');
        $batas = '19:00:00';
		$lama = $request->input('lama');
        if($waktu>$batas)
            $harga = $lapangan->hargamalam;
        else
            $harga = $lapangan->hargasiang;
		$total = $harga * $lama;
		$pt = $total - $request->input('nominal');
		
        $booking = Trans_booking::find($id);

        $booking->kodelapangan = $lapangan->kodelapangan;
        $booking->idpeople = $akun;
        $booking->pembooking = $request->input('nama');
        $booking->tanggal = $request->input('tanggal');
        $booking->jam = $request->input('jam');
        $booking->lama =  $request->input('lama');
        $booking->nominal = $request->input('nominal');
        $booking->total = $total;
        $booking->status = 1;

        if($booking->save()){
            $piutang = Trans_booking_p::where('idbooking',$id)->first();

            $piutang->kodelapangan = $lapangan->kodelapangan;
            $piutang->idpeople = $akun;
            $piutang->idbooking = $id;
            $piutang->nominal = $request->input('piutang');
            $piutang->status = 1;

            $piutang->save();
        }

    	return redirect()->route('ml.booking');
    }
	public function bookingProses(Request $request,$id){
		$booking = Trans_booking::join('trans_booking_p','trans_booking.id','trans_booking_p.idbooking')
								->select('trans_booking.*',DB::raw('sum(trans_booking_p.nominal) as piutang'))
								->where('trans_booking.id',$id)	
								->first();
		$booking1 = Trans_booking::join('trans_booking_p','trans_booking.id','trans_booking_p.idbooking')
								->select('trans_booking.*',DB::raw('sum(trans_booking_p.nominal) as piutang'))
								->where('trans_booking.id',$id)	
								->where('trans_booking_p.status',2)
								->first();
		$booking2 = Trans_booking::join('trans_booking_p','trans_booking.id','trans_booking_p.idbooking')
								->select('trans_booking.*',DB::raw('sum(trans_booking_p.nominal) as piutang'))
								->where('trans_booking.id',$id)	
								->where('trans_booking_p.status',1)
								->first();
		$booking3 = Trans_booking::join('trans_booking_h','trans_booking.id','trans_booking_h.idbooking')
								->select('trans_booking.*',DB::raw('sum(trans_booking_h.nominal) as hutang'))
								->where('trans_booking.id',$id)	
								->where('trans_booking_h.status',1)
								->first();
		$total = $booking->nominal + $booking->piutang;
		$dibayar = $booking1->nominal + $booking1->piutang;
		$piutang = $booking2->piutang;
		$hutang = $booking3->hutang;
        return view('pages.lapangan.transaksi.bookingProses',['booking'=>$booking,'piutang'=>$piutang,'hutang'=>$hutang,'booking1'=>$booking1,'total'=>$total,'dibayar'=>$dibayar]);		
	}
	public function bookingChange(Request $request, $id){
        $akun = $request->user()->id;
        $lapangan = DB::table('lapangan')
                        ->select('lapangan.*')
                        ->where('idpeople',$akun)
                        ->first();
						
		$total = $request->input('total');
		$dibayar = $request->input('nominal');
		$piutang_awal = $request->input('piutangb');				
		$piutang_bayar = $request->input('piutang');
		$hutang_awal = $request->input('hutangb');
		$hutang_bayar = $request->input('hutang');
		
		$nilaipiutang = $piutang_bayar - $piutang_awal;
		$nilaihutang = $hutang_bayar - $hutang_awal;
		
		$total_bayar = $piutang_bayar - $hutang_bayar + $dibayar;
		if($total!=$dibayar){
			if($nilaipiutang==0){
				$booking = Trans_booking::find($id);
				$piutang = Trans_booking_p::where('idbooking',$id)->where('status',1)->first();
				$piutang->status = 2;
				if($piutang->save()){
					$booking->status=2; //lunas piutang
					$booking->save();
					
					$log_transaksi1 = new Log_transaksi();
					$log_transaksi1->kodelapangan = $lapangan->kodelapangan;
					$log_transaksi1->idpeople = $akun;
					$log_transaksi1->perkiraan = 'Bayar Piutang Booking Oleh '.$request->input('nama');
					$log_transaksi1->bayar_piutang = $request->input('piutang');
					$log_transaksi1->save();
					
				}
			}else if ($nilaipiutang>0){
				$booking = Trans_booking::find($id);
				$booking1 = Trans_booking_p::where('idbooking',$id)->first();;
				
				$hutang = new Trans_booking_h();
				$hutang->kodelapangan = $lapangan->kodelapangan;
				$hutang->idpeople = $akun;
				$hutang->idbooking = $id;
				$hutang->nominal = $nilaipiutang;
				$hutang->status = 1;
				
				if($hutang->save()){
					$booking->status = 4; //berhutang
					$booking1->status = 2;
					$booking->save();
					$booking1->save();	
					$log_transaksi = new Log_transaksi();
					$log_transaksi->kodelapangan = $lapangan->kodelapangan;
					$log_transaksi->idpeople = $akun;
					$log_transaksi->perkiraan = 'Bayar Piutang Oleh '.$request->input('nama');
					$log_transaksi->bayar_piutang = $request->input('piutang')-$request->input('hutang');
					$log_transaksi->save();
					
					$log_transaksi1 = new Log_transaksi();
					$log_transaksi1->kodelapangan = $lapangan->kodelapangan;
					$log_transaksi1->idpeople = $akun;
					$log_transaksi1->perkiraan = 'Hutang Booking Kepada '.$request->input('nama');
					$log_transaksi1->hutang = $request->input('hutang');
					$log_transaksi1->save();
				}
			}else if($nilaipiutang<0){
				$piutang1 = Trans_booking_p::find($id);
				$piutang2 = new Trans_booking_p();
				$piutang1->nominal = $piutang_bayar;
				$piutang1->status = 2;
				if($piutang1->save()){
					$piutang2->kodelapangan = $lapangan->kodelapangan;
					$piutang2->idpeople = $akun;
					$piutang2->idbooking = $id;
					$piutang2->nominal = $nilaipiutang*(-1);
					$piutang2->status = 1;
					$piutang2->save();
					$log_transaksi1 = new Log_transaksi();
					$log_transaksi1->kodelapangan = $lapangan->kodelapangan;
					$log_transaksi1->idpeople = $akun;
					$log_transaksi1->perkiraan = 'Bayar Piutang Booking Oleh '.$request->input('nama');
					$log_transaksi1->bayar_piutang = $request->input('piutang');
					$log_transaksi1->save();
				}
			}
		} else if ($total==$dibayar){
			if($nilaihutang==0){
				$hutang = Trans_booking_h::where('idbooking',$id)->where('status',1)->first();
				$hutang->status=2;
				if($hutang->save()){
					$booking = Trans_booking::find($id);
					$booking->status=2;
					$booking->save();
					$log_transaksi1 = new Log_transaksi();
					$log_transaksi1->kodelapangan = $lapangan->kodelapangan;
					$log_transaksi1->idpeople = $akun;
					$log_transaksi1->perkiraan = 'Bayar Hutang Booking Kepada '.$request->input('nama');
					$log_transaksi1->bayar_hutang = $request->input('hutang');
					$log_transaksi1->save();
				}
			}
		}
		
		return redirect()->route('ml.booking');
	}
	public function bookingBatal(Request $request, $id){
		$akun = $request->user()->id;
        $lapangan = DB::table('lapangan')
                        ->select('lapangan.*')
                        ->where('idpeople',$akun)
                        ->first();	
							
		$nama = Trans_booking::where('id',$id)->value('pembooking');
		$piutang = Trans_booking_p::where('idbooking',$id)->first();
		$piutang->status = 3;
		if($piutang->save()){
			$booking = Trans_booking::find($id);
			$booking->status = 3;
			$booking->save();
			$log_transaksi1 = new Log_transaksi();
			$log_transaksi1->kodelapangan = $lapangan->kodelapangan;
			$log_transaksi1->idpeople = $akun;
			$log_transaksi1->perkiraan = 'Pembatalan Booking Oleh '.$nama;
			$log_transaksi1->piutang = $piutang->nominal*(-1);
			$log_transaksi1->save();
		}
		return redirect()->route('ml.booking');
	}
//Menyewa=============================================================================================[
    public function sewaIndex(Request $request){
		date_default_timezone_set("Asia/Jakarta");
        $akun = $request->user()->id;
        $now = date("Y-m-d");
        $month = date("m");
        $transaksi = Trans_sewa::where('status','<>',2)
			->Where('status','<>',3)
            ->where('idpeople',$akun)
			->orderBy('id','desc')
            ->paginate(15);		
        $sewa = Trans_sewa::join('trans_sewa_p','trans_sewa.id','=','trans_sewa_p.idsewa')
            ->select('trans_sewa.*',DB::raw('sum(trans_sewa_p.nominal) as piutang'))
            ->where('trans_sewa.idpeople',$akun)
			->orderBy('id','desc')
			->groupBy('trans_sewa.id')
            ->paginate(15);
        $thismonth = Trans_sewa::join('trans_sewa_p','trans_sewa.id','=','trans_sewa_p.idsewa')
            ->select('trans_sewa.*',DB::raw('sum(trans_sewa_p.nominal) as piutang'))
            ->where('trans_sewa.idpeople',$akun)
            ->whereMonth('trans_sewa.tanggalawal','=',$month)
			->orderBy('id','desc')
			->groupBy('trans_sewa.id')
            ->paginate(15);
    	return view('pages.lapangan.transaksi.sewaIndex',['sewa'=>$sewa,'transaksi'=>$transaksi,'thismonth'=>$thismonth])
            ->with('i',($request->input('page',0)));
    }
    public function sewaCreate(Request $request){
        date_default_timezone_set("Asia/Jakarta");
        $akun = $request->user()->id;
        $waktu = date("h:i:s a");
        $batas = '07:00:00 pm';
        $lapangan = DB::table('lapangan')
                        ->select('lapangan.*')
                        ->where('idpeople',$akun)
                        ->first();  
		$harga = $lapangan->hargasewa;
        return view('pages.lapangan.transaksi.sewaCreate',['harga'=>$harga]);
    }
    public function sewaStore(Request $request){
        $akun = $request->user()->id;
        $lapangan = DB::table('lapangan')
                        ->select('lapangan.*')
                        ->where('idpeople',$akun)
                        ->first();
        $this->validate($request,[
            'nama'=>'required',
            'tanggalawal'=>'required',
            'jamawal'=>'required',
            'jamakhir'=>'required',
            'lama'=>'required',
            'nominal'=>'required',
            ]);
        $sewa = new Trans_sewa();

        $sewa->kodelapangan = $lapangan->kodelapangan;
        $sewa->idpeople = $akun;
        $sewa->penyewa = $request->input('nama');
        $sewa->tanggalawal = $request->input('tanggalawal');
        $sewa->jamawal = $request->input('jamawal');
        $sewa->jamakhir = $request->input('jamakhir');
        $sewa->lama =  $request->input('lama');
        $sewa->nominal = $request->input('nominal');
        $sewa->status = 1;

        if($sewa->save()){
            $id = DB::table('trans_sewa')->max('id');
            $piutang = new Trans_sewa_p();

            $piutang->kodelapangan = $lapangan->kodelapangan;
            $piutang->idpeople = $akun;
            $piutang->idsewa = $id;
            $piutang->nominal = $request->input('piutang');
            $piutang->status = 1;

            $piutang->save();
			
			$log_pengunjung = new Log_pengunjung();
			$log_pengunjung->kodelapangan = $lapangan->kodelapangan;
			$log_pengunjung->idpeople = $akun;
			$log_pengunjung->nama = $request->input('nama');
			$log_pengunjung->tanggal = $request->input('tanggalawal');
			$log_pengunjung->kategori = 'Sewa';
			$log_pengunjung->save();	

			$log_transaksi = new Log_transaksi();
			$log_transaksi->kodelapangan = $lapangan->kodelapangan;
			$log_transaksi->idpeople = $akun;
			$log_transaksi->perkiraan = 'Sewa Oleh '.$request->input('nama');
			$log_transaksi->debit = $request->input('nominal');
			$log_transaksi->save();
			
			$log_transaksi1 = new Log_transaksi();
			$log_transaksi1->kodelapangan = $lapangan->kodelapangan;
			$log_transaksi1->idpeople = $akun;
			$log_transaksi1->perkiraan = 'Piutang Sewa Oleh '.$request->input('nama');
			$log_transaksi1->piutang = $request->input('piutang');
			$log_transaksi1->save();
			
        }

    	return redirect()->route('ml.sewa');
    }
    public function sewaDestroy($id){
		$sewa1 = Trans_sewa::find($id)->delete();
		$sewa2 = Trans_sewa_p::where('idsewa',$id)->delete();
		$sewa3 = Trans_sewa_h::where('idsewa',$id)->delete();
        return redirect()->route('ml.sewa')
									->with('message','sewa Deleted');
    }
    public function sewaUpdate(Request $request,$id){
        date_default_timezone_set("Asia/Jakarta");
        $akun = $request->user()->id;
        $waktu = date("h:i:s a");
        $batas = '07:00:00 pm';
        $lapangan = DB::table('lapangan')
                        ->select('lapangan.*')
                        ->where('idpeople',$akun)
						->first();
        $harga = $lapangan->hargasewa;	
		$sewa = Trans_sewa::find($id);
        return view('pages.lapangan.transaksi.sewaUpdate',['sewa'=>$sewa,'harga'=>$harga]);
    }
    public function sewaSave(Request $request,$id){
        $akun = $request->user()->id;
        $lapangan = DB::table('lapangan')
                        ->select('lapangan.*')
                        ->where('idpeople',$akun)
                        ->first();
        $this->validate($request,[
            'nama'=>'required',
            'tanggalawal'=>'required',
            'jamawal'=>'required',
            'jamakhir'=>'required',
            'lama'=>'required',
            'nominal'=>'required',
            ]);
        $sewa = Trans_sewa::find($id);

        $sewa->kodelapangan = $lapangan->kodelapangan;
        $sewa->idpeople = $akun;
        $sewa->penyewa = $request->input('nama');
        $sewa->tanggalawal = $request->input('tanggalawal');
        $sewa->jamawal = $request->input('jamawal');
        $sewa->jamakhir = $request->input('jamakhir');
        $sewa->lama =  $request->input('lama');
        $sewa->nominal = $request->input('nominal');
        $sewa->status = 1;

        if($sewa->save()){
            $piutang = Trans_sewa_p::where('idsewa',$id)->first();

            $piutang->kodelapangan = $lapangan->kodelapangan;
            $piutang->idpeople = $akun;
            $piutang->idsewa = $id;
            $piutang->nominal = $request->input('piutang');
            $piutang->status = 1;

            $piutang->save();
        }

    	return redirect()->route('ml.sewa');
    }
	public function sewaProses(Request $request,$id){
		$sewa = Trans_sewa::join('trans_sewa_p','trans_sewa.id','trans_sewa_p.idsewa')
								->select('trans_sewa.*',DB::raw('sum(trans_sewa_p.nominal) as piutang'))
								->where('trans_sewa.id',$id)	
								->first();
		$sewa1 = Trans_sewa::join('trans_sewa_p','trans_sewa.id','trans_sewa_p.idsewa')
								->select('trans_sewa.*',DB::raw('sum(trans_sewa_p.nominal) as piutang'))
								->where('trans_sewa.id',$id)	
								->where('trans_sewa_p.status',2)
								->first();
		$sewa2 = Trans_sewa::join('trans_sewa_p','trans_sewa.id','trans_sewa_p.idsewa')
								->select('trans_sewa.*',DB::raw('sum(trans_sewa_p.nominal) as piutang'))
								->where('trans_sewa.id',$id)	
								->where('trans_sewa_p.status',1)
								->first();
		$sewa3 = Trans_sewa::join('trans_sewa_h','trans_sewa.id','trans_sewa_h.idsewa')
								->select('trans_sewa.*',DB::raw('sum(trans_sewa_h.nominal) as hutang'))
								->where('trans_sewa.id',$id)	
								->where('trans_sewa_h.status',1)
								->first();
		$total = $sewa->nominal + $sewa->piutang;
		$dibayar = $sewa1->nominal + $sewa1->piutang;
		$piutang = $sewa2->piutang;
		$hutang = $sewa3->hutang;
        return view('pages.lapangan.transaksi.sewaProses',['sewa'=>$sewa,'piutang'=>$piutang,'hutang'=>$hutang,'sewa1'=>$sewa1,'total'=>$total,'dibayar'=>$dibayar]);		
	}
	public function sewaChange(Request $request, $id){
        $akun = $request->user()->id;
        $lapangan = DB::table('lapangan')
                        ->select('lapangan.*')
                        ->where('idpeople',$akun)
                        ->first();
						
		$total = $request->input('total');
		$dibayar = $request->input('nominal');
		$piutang_awal = $request->input('piutangb');				
		$piutang_bayar = $request->input('piutang');
		$hutang_awal = $request->input('hutangb');
		$hutang_bayar = $request->input('hutang');
		
		$nilaipiutang = $piutang_bayar - $piutang_awal;
		$nilaihutang = $hutang_bayar - $hutang_awal;
		
		$total_bayar = $piutang_bayar - $hutang_bayar + $dibayar;
		if($total!=$dibayar){
			if($nilaipiutang==0){
				$sewa = Trans_sewa::find($id);
				$piutang = Trans_sewa_p::where('idsewa',$id)->where('status',1)->first();
				$piutang->status = 2;
				if($piutang->save()){
					$sewa->status=2; //lunas
					$sewa->save();
					$log_transaksi1 = new Log_transaksi();
					$log_transaksi1->kodelapangan = $lapangan->kodelapangan;
					$log_transaksi1->idpeople = $akun;
					$log_transaksi1->perkiraan = 'Bayar Piutang Sewa Oleh '.$request->input('nama');
					$log_transaksi1->bayar_piutang = $request->input('piutang');
					$log_transaksi1->save();
				}
			}else if ($nilaipiutang>0){
				$sewa = Trans_sewa::find($id);
				$sewa1 = Trans_sewa_p::where('idsewa',$id)->first();;
				
				$hutang = new Trans_sewa_h();
				$hutang->kodelapangan = $lapangan->kodelapangan;
				$hutang->idpeople = $akun;
				$hutang->idsewa = $id;
				$hutang->nominal = $nilaipiutang;
				$hutang->status = 1;
				
				if($hutang->save()){
					$sewa->status = 4; //berhutang
					$sewa1->status = 2;
					$sewa->save();
					$sewa1->save();
					
					$log_transaksi = new Log_transaksi();
					$log_transaksi->kodelapangan = $lapangan->kodelapangan;
					$log_transaksi->idpeople = $akun;
					$log_transaksi->perkiraan = 'Bayar Piutang Oleh '.$request->input('nama');
					$log_transaksi->bayar_piutang = $request->input('piutang')-$request->input('hutang');
					$log_transaksi->save();
					
					$log_transaksi1 = new Log_transaksi();
					$log_transaksi1->kodelapangan = $lapangan->kodelapangan;
					$log_transaksi1->idpeople = $akun;
					$log_transaksi1->perkiraan = 'Hutang Sewa Kepada '.$request->input('nama');
					$log_transaksi1->hutang = $request->input('hutang');
					$log_transaksi1->save();					
				}
			}else if($nilaipiutang<0){
				$piutang1 = Trans_sewa_p::find($id);
				$piutang2 = new Trans_sewa_p();
				$piutang1->nominal = $piutang_bayar;
				$piutang1->status = 2;
				if($piutang1->save()){
					$piutang2->kodelapangan = $lapangan->kodelapangan;
					$piutang2->idpeople = $akun;
					$piutang2->idsewa = $id;
					$piutang2->nominal = $nilaipiutang*(-1);
					$piutang2->status = 1;
					$piutang2->save();
					$log_transaksi1 = new Log_transaksi();
					$log_transaksi1->kodelapangan = $lapangan->kodelapangan;
					$log_transaksi1->idpeople = $akun;
					$log_transaksi1->perkiraan = 'Bayar Piutang Sewa Oleh '.$request->input('nama');
					$log_transaksi1->bayar_piutang = $request->input('piutang');
					$log_transaksi1->save();					
				}
			}
		} else if ($total==$dibayar){
			if($nilaihutang==0){
				$hutang = Trans_sewa_h::where('idsewa',$id)->where('status',1)->first();
				$hutang->status=2;
				if($hutang->save()){
					$sewa = Trans_sewa::find($id);
					$sewa->status=2;
					$sewa->save();
					$log_transaksi1 = new Log_transaksi();
					$log_transaksi1->kodelapangan = $lapangan->kodelapangan;
					$log_transaksi1->idpeople = $akun;
					$log_transaksi1->perkiraan = 'Bayar Hutang Sewa Kepada '.$request->input('nama');
					$log_transaksi1->bayar_hutang = $request->input('hutang');
					$log_transaksi1->save();
				}
			}
		}
		
		return redirect()->route('ml.sewa');
	}
	public function sewaBatal(Request $request, $id){
		$akun = $request->user()->id;
        $lapangan = DB::table('lapangan')
                        ->select('lapangan.*')
                        ->where('idpeople',$akun)
                        ->first();	
							
		$nama = Trans_sewa::where('id',$id)->value('penyewa');		
		$piutang = Trans_sewa_p::where('idsewa',$id)->first();
		$piutang->status = 3;
		if($piutang->save()){
			$sewa = Trans_sewa::find($id);
			$sewa->status = 3;
			$sewa->save();
			$log_transaksi1 = new Log_transaksi();
			$log_transaksi1->kodelapangan = $lapangan->kodelapangan;
			$log_transaksi1->idpeople = $akun;
			$log_transaksi1->perkiraan = 'Pembatalan Booking Oleh '.$nama;
			$log_transaksi1->piutang = $piutang->nominal*(-1);
			$log_transaksi1->save();
		}
		return redirect()->route('ml.sewa');
		//]
	}
//BIAYA==================================================================================================
    public function biayaIndex(Request $request){
        $akun = $request->user()->id;
        $now = date("m");
        $date = strtotime($now);
        $biaya = Trans_lain::where('trans_lain.idpeople',$akun)
							->orderBy('id','desc')
							->paginate(15);
        $month = Trans_lain::where('trans_lain.idpeople',$akun)
            ->where('trans_lain.bulan','=',$now)
			->orderBy('id','desc')
            ->paginate(15);

        return view('pages.lapangan.transaksi.biayaIndex',['biaya'=>$biaya,'month'=>$month])
            ->with('i',($request->input('page',0)));
    }
    public function biayaCreate(){
        return view('pages.lapangan.transaksi.biayaCreate');
    }
    public function biayaStore(Request $request){
        $this->validate($request,[
            'keterangan'=>'required',
            'nominal'=>'required',
            ]);
        $akun = $request->user()->id;
        $lapangan = DB::table('lapangan')
                                ->select('lapangan.*')
                                ->where('lapangan.idpeople',$akun)
                                ->first();  
        $biaya = new Trans_lain();

        $biaya->kodelapangan = $lapangan->kodelapangan;
        $biaya->idpeople = $akun;
        $biaya->keterangan = $request->input('keterangan');
        $biaya->nominal = $request->input('nominal');
        $biaya->tanggalbayar = date('Y-m-d');
        $biaya->bulan = date('m');
        $biaya->status = 1;

        if($biaya->save()){
			$log_transaksi = new Log_transaksi();
			$log_transaksi->kodelapangan = $lapangan->kodelapangan;
			$log_transaksi->idpeople = $akun;
			$log_transaksi->perkiraan = $request->input('keterangan');
			$log_transaksi->kredit = $request->input('nominal');
			$log_transaksi->save();
		}

        return redirect()->route('ml.biaya')->with('message','Biaya Created');
    }
    public function biayaDestroy($id){
        $biaya=Trans_lain::find($id)->delete();
        return redirect()->route('ml.biaya')
                        ->with('message','Biaya Deleted');
    }
    public function biayaUpdate(Request $request,$id){
        $biaya=Trans_lain::find($id);
        $pengguna = $request->user()->id;
        if($pengguna!=$biaya->idpeople)
            return redirect()->route('ml.biaya');
        else
            return view('pages.lapangan.transaksi.biayaUpdate',['id'=>$id,'biaya'=>$biaya]);
    }
    public function biayaSave(Request $request,$id){
        $this->validate($request,[
            'keterangan'=>'required',
            'kodelapangan'=>'required',
            'nominal'=>'required',
            ]);
        $biaya=Trans_lain::find($id);

        $biaya->nominal = $request->input('nominal');

        $biaya->save();

        return redirect()->route('ml.biaya')->with('message','Biaya Updated');        
    }    
//PRIVE=================================================================================================
	public function prive(Request $request){
        $akun = $request->user()->id;
        $lapangan = DB::table('lapangan')
                        ->select('lapangan.*')
                        ->where('idpeople',$akun)
                        ->first();		
		$prive = new Modul_prive();
		$prive->kodelapangan = $lapangan->kodelapangan;
		$prive->idpeople = $akun; 
		$prive->nominal = $request->input('nominal');
		$prive->bulan = date('m');
		$prive->tahun = date('Y');
		$prive->save();
		return redirect()->route('ml.lapangan')->with('message','Prive created');
	}
//LAPORAN================================================================================================
    public function laporanIndex(){
		return view('pages.lapangan.laporan.index');
	}
    public function laporanKeuangan(Request $request){
		date_default_timezone_set("Asia/Jakarta");
		$akun = $request->user()->id;
		$month = date('m');
		$year = date('Y');
		$kodelapangan = Lapangan::where('idpeople',$akun)->value('kodelapangan');
		$namalapangan = Lapangan::where('idpeople',$akun)->value('nama');
		$akumulasi = $this->laporanAkumulasiPenyusutan($kodelapangan);		
		$labarugi = $this->laporanLabaRugi($kodelapangan,$month,$year,$akumulasi);		
		$aruskas = $this->laporanArusKas($kodelapangan,$month,$year,$labarugi['totalbeban'],$akumulasi);	
		$perubahanmodal = $this->laporanPerubahanModal($kodelapangan,$month,$year,$labarugi['lababersih'],$aruskas['prive']);
		$neraca = $this->laporanNeraca($kodelapangan,$month,$year,$aruskas['kasakhirperiode'],$perubahanmodal['modalakhir'],$labarugi['akumulasi']);
		return view('pages.lapangan.laporan.laporan',['akun'=>$akun,'month'=>$month,'year'=>$year,'kodelapangan'=>$kodelapangan,'nama'=>$namalapangan,'labarugi'=>$labarugi,'aruskas'=>$aruskas,'perubahanmodal'=>$perubahanmodal,'neraca'=>$neraca]);
	}
    public function laporanDetail(Request $request){
		date_default_timezone_set("Asia/Jakarta");
		$akun = $request->user()->id;
		$month = date('m');
		$year = date('Y');
		$kodelapangan = Lapangan::where('idpeople',$akun)->value('kodelapangan');
		$nama = Lapangan::where('idpeople',$akun)->value('nama');

		$sum['1'] = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->value(DB::raw('sum(debit)'));		//Jumlah debit di log
		$sum['2'] = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->value(DB::raw('sum(kredit)'));		//jumlah kredit di log
		$sum['3'] = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->value(DB::raw('sum(hutang)'));		//jumlah hutang di log
		$sum['4'] = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->value(DB::raw('sum(bayar_hutang)')); //jumlah pembayaran hutang di log
		$sum['5'] = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->value(DB::raw('sum(piutang)'));		//jumlah piutang di log
		$sum['6'] = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->value(DB::raw('sum(bayar_piutang)'));//jumlah pembayaran piutang di log
		
		$sum['7'] = DB::table('modul_kas')														//kas awal
						->select(DB::raw('(kas+investasi) as kas'),DB::raw('max(created_at)'))
						->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)
						->value('kas');		
		$sum['8'] = DB::table('modul_prive')														//prive
						->select(DB::raw('sum(nominal) as prive'))
						->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)
						->value('prive');	
								
		$sum['9'] = $sum['1']-$sum['2']+$sum['7']-$sum['8']+$sum['3']+$sum['6']-$sum['4'];		//kas
		$sum['10'] = $sum['3']-$sum['4'];
		$sum['11'] = $sum['5']-$sum['6'];								
		$laporan = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->get();
		
		return view('pages.lapangan.laporan.detail',['laporan'=>$laporan,'nama'=>$nama,'sum'=>$sum]);
	}
    
	public function laporanLabaRugi($kodelapangan,$month,$year,$akumulasi){
		$labarugi['booking'] 	= DB::table('trans_booking')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->whereYear('created_at',$year)->value(DB::raw('sum(nominal)'));
		$labarugi['booking_p'] 	= DB::table('trans_booking_p')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->whereYear('created_at',$year)->value(DB::raw('sum(nominal)'));
		$labarugi['sewa']	 	= DB::table('trans_sewa')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->whereYear('created_at',$year)->value(DB::raw('sum(nominal)'));
		$labarugi['sewa_p']	 	= DB::table('trans_sewa_P')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->whereYear('created_at',$year)->value(DB::raw('sum(nominal)'));
	
		$labarugi['gaji']	 	= DB::table('trans_lain')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->whereYear('created_at',$year)->where('keterangan','Gaji')->value(DB::raw('sum(nominal)'));
		$labarugi['listrik']	= DB::table('trans_lain')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->whereYear('created_at',$year)->where('keterangan','Listrik')->value(DB::raw('sum(nominal)'));
		$labarugi['air']	 	= DB::table('trans_lain')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->whereYear('created_at',$year)->where('keterangan','Air')->value(DB::raw('sum(nominal)'));
		$labarugi['perawatan']	= DB::table('trans_lain')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->whereYear('created_at',$year)->where('keterangan','Perawatan')->value(DB::raw('sum(nominal)'));
		$labarugi['pajak']	 	= DB::table('trans_lain')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->whereYear('created_at',$year)->where('keterangan','Pajak')->value(DB::raw('sum(nominal)'));
		
		$labarugi['akumulasi']	= $akumulasi;
		
		$labarugi['pendapatan'] = $labarugi['booking']+$labarugi['booking_p']+$labarugi['sewa']+$labarugi['sewa_p'];
		$labarugi['totalbeban'] = $labarugi['gaji']+$labarugi['listrik']+$labarugi['air']+$labarugi['perawatan']+$labarugi['pajak']	+$labarugi['akumulasi'];
		$labarugi['lababersih'] = $labarugi['pendapatan'] - $labarugi['totalbeban'];		
		
		return $labarugi;
	}
    public function laporanArusKas($kodelapangan,$month,$year,$labarugi,$akumulasi){
		$sum['booking']	  = DB::table('trans_booking')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->whereYear('created_at',$year)->value(DB::raw('sum(nominal)'));
		$sum['booking_h'] = DB::table('trans_booking_h')->where('kodelapangan', $kodelapangan)->where('status', 1)->whereMonth('created_at',$month)->whereYear('created_at',$year)->value(DB::raw('sum(nominal)'));
		$sum['booking_p'] = DB::table('trans_booking_p')->where('kodelapangan', $kodelapangan)->where('status', 2)->whereMonth('created_at',$month)->whereYear('created_at',$year)->value(DB::raw('sum(nominal)'));
		$sum['sewa']	  = DB::table('trans_sewa')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->whereYear('created_at',$year)->value(DB::raw('sum(nominal)'));
		$sum['sewa_h']	  = DB::table('trans_sewa_h')->where('kodelapangan', $kodelapangan)->where('status', 1)->whereMonth('created_at',$month)->whereYear('created_at',$year)->value(DB::raw('sum(nominal)'));
		$sum['sewa_p']	  =	DB::table('trans_sewa_p')->where('kodelapangan', $kodelapangan)->where('status', 2)->whereMonth('created_at',$month)->whereYear('created_at',$year)->value(DB::raw('sum(nominal)'));
		
		$sum['pajak']	  =	DB::table('trans_lain')->where('kodelapangan', $kodelapangan)->where('keterangan', 'Pajak')->whereMonth('created_at',$month)->whereYear('created_at',$year)->value(DB::raw('sum(nominal)'));
		$sum['perlengkapan'] = DB::table('trans_lain')->where('kodelapangan', $kodelapangan)->where('keterangan', 'Perlengkapan')->whereMonth('created_at',$month)->whereYear('created_at',$year)->value(DB::raw('sum(nominal)'));
		$sum['beban'] = $labarugi-$akumulasi;
		$sum['investasi'] = DB::table('modul_kas')														//investasi
				->select('investasi')
				->where('kodelapangan', $kodelapangan)
				->where('bulan',$month)
				//->orderBy('created_at','desc')
				->limit(1)
				->value('investasi');		
		$sum['kas'] = DB::table('modul_kas')														//kas
				->select('kas')
				->where('kodelapangan', $kodelapangan)
				->where('bulan',$month)
				//->orderBy('created_at','desc')
				->limit(1)
				->value('kas');		
		$sum['prive'] = DB::table('modul_prive')														//prive
					->select(DB::raw('sum(nominal) as prive'))
					->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)
					->value('prive');			
		
		$sum['penerimaankas'] = $sum['booking']+$sum['booking_h']+$sum['booking_p']+$sum['sewa']+$sum['sewa_h']+$sum['sewa_p']; //penerimaan jas dari pelanggan
		$sum['kashasiloperasi'] = $sum['penerimaankas'] - $sum['beban'] + $sum['pajak'];
		$sum['kasbersihoperasi'] = $sum['kashasiloperasi'] - $sum['pajak'];
		$sum['kasbersihinvestasi'] = $sum['kasbersihoperasi'] - $sum['perlengkapan'];
		$sum['sisainvestasi'] = $sum['investasi'] - $sum['prive'];
		$sum['kenaikankas'] = $sum['kasbersihinvestasi'] + $sum['sisainvestasi'];
		$sum['kasakhirperiode'] = $sum['kenaikankas']+$sum['kas'];	
			
		return $sum;
	}
    public function laporanPerubahanModal($kodelapangan,$month,$year,$lababersih,$prive){
		$sum['modalawal'] = DB::table('modul_modal')														//kas
				->select('nominal')
				->where('kodelapangan', $kodelapangan)
				->where('bulan',$month)
				//->orderBy('created_at','desc')
				->limit(1)
				->value('nominal');	

		$sum['modalsebelumprive'] = $sum['modalawal'] + $lababersih;

		$sum['modalakhir'] = $sum['modalsebelumprive'] - $prive;	
		
		return $sum;
	}
    public function laporanNeraca($kodelapangan,$month,$year,$kasakhirperiode,$modalakhir,$akumulasi){
	$sum['kas'] = $kasakhirperiode;
	//$sum['perlengkapan'] = $beliperlengkapan;
	$sum['perlengkapan'] = DB::table('trans_lain')->where('kodelapangan', $kodelapangan)->where('keterangan', 'Perlengkapan')->value(DB::raw('sum(nominal)'));
	
	$sum['akumulasi'] = $akumulasi;

	$sum['peralatan'] = DB::table('modul_peralatan')
					->select('nominal')
					->where('kodelapangan', $kodelapangan)
					->where('bulan',$month)
					//->orderBy('created_at','desc')
					->limit(1)
					->value('nominal');
	
	$sum['booking_p'] = DB::table('trans_booking_p')->where('kodelapangan', $kodelapangan)->where('status', 1)->whereMonth('created_at',$month)->whereYear('created_at',$year)->value(DB::raw('sum(nominal)'));
	$sum['booking_h'] = DB::table('trans_booking_h')->where('kodelapangan', $kodelapangan)->where('status', 1)->whereMonth('created_at',$month)->whereYear('created_at',$year)->value(DB::raw('sum(nominal)'));
	$sum['sewa_p'] = DB::table('trans_sewa_p')->where('kodelapangan', $kodelapangan)->where('status', 1)->whereMonth('created_at',$month)->whereYear('created_at',$year)->value(DB::raw('sum(nominal)'));
	$sum['sewa_h'] = DB::table('trans_sewa_h')->where('kodelapangan', $kodelapangan)->where('status', 1)->whereMonth('created_at',$month)->whereYear('created_at',$year)->value(DB::raw('sum(nominal)'));

	$sum['hutang'] = $sum['booking_h']+$sum['sewa_h'] ;
	$sum['piutang'] = $sum['booking_p']+$sum['sewa_p'] ;

	$sum['aktiva'] =$sum['kas']+$sum['piutang']+$sum['perlengkapan']+$sum['peralatan']-$akumulasi;
	
	$sum['modal'] = $modalakhir;
	$sum['passiva'] = $sum['hutang']+$sum['modal'];	

	return $sum;
	}
    public function laporanAkumulasiPenyusutan($kodelapangan){ //metode garis lurus
		 $peralatan = DB::table('modul_peralatan')
				->select('nominal',DB::raw('min(created_at)'))
				->where('kodelapangan', $kodelapangan)
				->value('nominal');	
		 $masa = DB::table('lapangan')->where('kodelapangan',$kodelapangan)->value('perkiraan_masa');
		 $lamaMasa = $masa*12;
		 $akumulasi = number_format($peralatan/$lamaMasa,0,",","");
		 return $akumulasi;
	}
    
	public function laporanKeuanganS(Request $request){
		date_default_timezone_set("Asia/Jakarta");
		$akun = $request->user()->id;
		$month = $request->input('bulan');
		$year = $request->input('tahun');
		$kodelapangan = Lapangan::where('idpeople',$akun)->value('kodelapangan');
		$namalapangan = Lapangan::where('idpeople',$akun)->value('nama');
		$akumulasi = $this->laporanAkumulasiPenyusutan($kodelapangan);		
		$labarugi = $this->laporanLabaRugi($kodelapangan,$month,$year,$akumulasi);		
		$aruskas = $this->laporanArusKas($kodelapangan,$month,$year,$labarugi['totalbeban'],$akumulasi);	
		$perubahanmodal = $this->laporanPerubahanModal($kodelapangan,$month,$year,$labarugi['lababersih'],$aruskas['prive']);
		$neraca = $this->laporanNeraca($kodelapangan,$month,$year,$aruskas['kasakhirperiode'],$perubahanmodal['modalakhir'],$labarugi['akumulasi']);
		return view('pages.lapangan.laporan.laporan1',['akun'=>$akun,'month'=>$month,'year'=>$year,'kodelapangan'=>$kodelapangan,'nama'=>$namalapangan,'labarugi'=>$labarugi,'aruskas'=>$aruskas,'perubahanmodal'=>$perubahanmodal,'neraca'=>$neraca]);
	}
    public function laporanDetailS(Request $request){
		date_default_timezone_set("Asia/Jakarta");
		$akun = $request->user()->id;
		$month = $request->input('bulan');
		$year = $request->input('tahun');
		$kodelapangan = Lapangan::where('idpeople',$akun)->value('kodelapangan');
		$nama = Lapangan::where('idpeople',$akun)->value('nama');

		$sum['1'] = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->value(DB::raw('sum(debit)'));		//Jumlah debit di log
		$sum['2'] = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->value(DB::raw('sum(kredit)'));		//jumlah kredit di log
		$sum['3'] = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->value(DB::raw('sum(hutang)'));		//jumlah hutang di log
		$sum['4'] = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->value(DB::raw('sum(bayar_hutang)')); //jumlah pembayaran hutang di log
		$sum['5'] = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->value(DB::raw('sum(piutang)'));		//jumlah piutang di log
		$sum['6'] = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->value(DB::raw('sum(bayar_piutang)'));//jumlah pembayaran piutang di log
		
		$sum['7'] = DB::table('modul_kas')														//kas awal
						->select(DB::raw('(kas+investasi) as kas'),DB::raw('max(created_at)'))
						->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)
						->value('kas');		
		$sum['8'] = DB::table('modul_prive')														//prive
						->select(DB::raw('sum(nominal) as prive'))
						->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)
						->value('prive');	
								
		$sum['9'] = $sum['1']-$sum['2']+$sum['7']-$sum['8']+$sum['3']+$sum['6']-$sum['4'];		//kas
		$sum['10'] = $sum['3']-$sum['4'];
		$sum['11'] = $sum['5']-$sum['6'];								
		$laporan = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->get();
		
		return view('pages.lapangan.laporan.detail1',['laporan'=>$laporan,'nama'=>$nama,'sum'=>$sum,'year'=>$year,'month'=>$month]);
	}
    	
	public function laporanSave(Request $request){
		date_default_timezone_set("Asia/Jakarta");
		$akun = $request->user()->id;
		$month = $request->input('bulan');
		$year = $request->input('tahun');
		$kodelapangan = Lapangan::where('idpeople',$akun)->value('kodelapangan');
		
		$kas = new Modul_kas();
		$peralatan = new Modul_peralatan();
		$modal = new Modul_modal();
		
		$kas->kodelapangan = $kodelapangan;
		$kas->idpeople = $akun;
		$kas->investasi = 0;
		$kas->kas = $request->input('kas');
		$kas->bulan = $month;
		$kas->tahun = $year;
		
		$peralatan->kodelapangan = $kodelapangan;
		$peralatan->idpeople = $akun;
		$peralatan->nominal = $request->input('peralatan');
		$peralatan->perubahan = $request->input('penyusutan');
		$peralatan->bulan = $month;
		$peralatan->tahun = $year;
		 
		$modal->kodelapangan = $kodelapangan;
		$modal->idpeople = $akun;
		$modal->nominal = $request->input('modal');
		$modal->bulan = $month;
		$modal->tahun = $year;
		
		$kas->save();
		$peralatan->save();
		$modal->save();
		
		return redirect()->route('ml.laporan')->with('message','Data saved');
	}				
		
    public function laporanCetakKeuangan(Request $request){
		date_default_timezone_set("Asia/Jakarta");
		$akun = $request->user()->id;
		$month = date('m');
		$year = date('Y');
		$kodelapangan = Lapangan::where('idpeople',$akun)->value('kodelapangan');
		$namalapangan = Lapangan::where('idpeople',$akun)->value('nama');
		$akumulasi = $this->laporanAkumulasiPenyusutan($kodelapangan);		
		$labarugi = $this->laporanLabaRugi($kodelapangan,$month,$year,$akumulasi);		
		$aruskas = $this->laporanArusKas($kodelapangan,$month,$year,$labarugi['totalbeban'],$akumulasi);	
		$perubahanmodal = $this->laporanPerubahanModal($kodelapangan,$month,$year,$labarugi['lababersih'],$aruskas['prive']);
		$neraca = $this->laporanNeraca($kodelapangan,$month,$year,$aruskas['kasakhirperiode'],$perubahanmodal['modalakhir'],$labarugi['akumulasi']);
		
		$pdf = PDF::loadView('pages.lapangan.laporan.cetakKeuangan',['akun'=>$akun,'month'=>$month,'year'=>$year,'kodelapangan'=>$kodelapangan,'nama'=>$namalapangan,'labarugi'=>$labarugi,'aruskas'=>$aruskas,'perubahanmodal'=>$perubahanmodal,'neraca'=>$neraca])->setPaper('a4', 'potrait');
		
		return $pdf->download('laporan.pdf');
	}	
    public function laporanCetakDetail(Request $request){
		date_default_timezone_set("Asia/Jakarta");
		$akun = $request->user()->id;
		$month = date('m');
		$year = date('Y');
		$kodelapangan = Lapangan::where('idpeople',$akun)->value('kodelapangan');
		$nama = Lapangan::where('idpeople',$akun)->value('nama');

		$sum['1'] = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->value(DB::raw('sum(debit)'));		//Jumlah debit di log
		$sum['2'] = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->value(DB::raw('sum(kredit)'));		//jumlah kredit di log
		$sum['3'] = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->value(DB::raw('sum(hutang)'));		//jumlah hutang di log
		$sum['4'] = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->value(DB::raw('sum(bayar_hutang)')); //jumlah pembayaran hutang di log
		$sum['5'] = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->value(DB::raw('sum(piutang)'));		//jumlah piutang di log
		$sum['6'] = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->value(DB::raw('sum(bayar_piutang)'));//jumlah pembayaran piutang di log
		
		$sum['7'] = DB::table('modul_kas')														//kas awal
						->select(DB::raw('(kas+investasi) as kas'),DB::raw('max(created_at)'))
						->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)
						->value('kas');		
		$sum['8'] = DB::table('modul_prive')														//prive
						->select(DB::raw('sum(nominal) as prive'))
						->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)
						->value('prive');	
								
		$sum['9'] = $sum['1']-$sum['2']+$sum['7']-$sum['8']+$sum['3']+$sum['6']-$sum['4'];		//kas
		$sum['10'] = $sum['3']-$sum['4'];
		$sum['11'] = $sum['5']-$sum['6'];								
		$laporan = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->get();
		
		$pdf = PDF::loadView('pages.lapangan.laporan.cetakDetail',['laporan'=>$laporan,'nama'=>$nama,'sum'=>$sum])->setPaper('a4', 'potrait');
		
		return $pdf->download('detail.pdf');
	}
	
	public function laporanCetakKeuanganS(Request $request){
		date_default_timezone_set("Asia/Jakarta");
		$akun = $request->user()->id;
		$month = $request->input('bulan');
		$year = $request->input('tahun');
		$kodelapangan = Lapangan::where('idpeople',$akun)->value('kodelapangan');
		$namalapangan = Lapangan::where('idpeople',$akun)->value('nama');
		$akumulasi = $this->laporanAkumulasiPenyusutan($kodelapangan);		
		$labarugi = $this->laporanLabaRugi($kodelapangan,$month,$year,$akumulasi);		
		$aruskas = $this->laporanArusKas($kodelapangan,$month,$year,$labarugi['totalbeban'],$akumulasi);	
		$perubahanmodal = $this->laporanPerubahanModal($kodelapangan,$month,$year,$labarugi['lababersih'],$aruskas['prive']);
		$neraca = $this->laporanNeraca($kodelapangan,$month,$year,$aruskas['kasakhirperiode'],$perubahanmodal['modalakhir'],$labarugi['akumulasi']);
		$pdf = PDF::loadView('pages.lapangan.laporan.cetakKeuangan1',['akun'=>$akun,'month'=>$month,'year'=>$year,'kodelapangan'=>$kodelapangan,'nama'=>$namalapangan,'labarugi'=>$labarugi,'aruskas'=>$aruskas,'perubahanmodal'=>$perubahanmodal,'neraca'=>$neraca])->setPaper('a4', 'potrait');
		
		return $pdf->download('laporan1.pdf');
	}
    public function laporanCetakDetailS(Request $request){
		date_default_timezone_set("Asia/Jakarta");
		$akun = $request->user()->id;
		$month = $request->input('bulan');
		$year = $request->input('tahun');
		$kodelapangan = Lapangan::where('idpeople',$akun)->value('kodelapangan');
		$nama = Lapangan::where('idpeople',$akun)->value('nama');

		$sum['1'] = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->value(DB::raw('sum(debit)'));		//Jumlah debit di log
		$sum['2'] = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->value(DB::raw('sum(kredit)'));		//jumlah kredit di log
		$sum['3'] = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->value(DB::raw('sum(hutang)'));		//jumlah hutang di log
		$sum['4'] = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->value(DB::raw('sum(bayar_hutang)')); //jumlah pembayaran hutang di log
		$sum['5'] = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->value(DB::raw('sum(piutang)'));		//jumlah piutang di log
		$sum['6'] = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->value(DB::raw('sum(bayar_piutang)'));//jumlah pembayaran piutang di log
		
		$sum['7'] = DB::table('modul_kas')														//kas awal
						->select(DB::raw('(kas+investasi) as kas'),DB::raw('max(created_at)'))
						->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)
						->value('kas');		
		$sum['8'] = DB::table('modul_prive')														//prive
						->select(DB::raw('sum(nominal) as prive'))
						->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)
						->value('prive');	
								
		$sum['9'] = $sum['1']-$sum['2']+$sum['7']-$sum['8']+$sum['3']+$sum['6']-$sum['4'];		//kas
		$sum['10'] = $sum['3']-$sum['4'];
		$sum['11'] = $sum['5']-$sum['6'];								
		$laporan = DB::table('log_transaksi')->where('kodelapangan', $kodelapangan)->whereMonth('created_at',$month)->get();
		
		$pdf = PDF::loadView('pages.lapangan.laporan.cetakDetail1',['laporan'=>$laporan,'nama'=>$nama,'sum'=>$sum,'year'=>$year,'month'=>$month])->setPaper('a4', 'potrait');
		
		return $pdf->download('detail1.pdf');
	}
    
    

}



















