<?php

namespace App\Http\Controllers;

use App\Team;
use App\Customer;
use App\Product;
use App\Forecast;
use App\Promotion;
use App\Region;
use App\Regiondetail;
use App\Question;
use App\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use DB;

class TeamController extends Controller
{
    public function getRemainingTime() {
        $siklus = Session::find(1);
        $difference = strtotime($siklus->timer_limit) - strtotime(date("Y-m-d H:i:s"));
        return $difference;
    }

    public function getRemainingCooldown() {
        $siklus = Session::find(1);
        $cooldown = strtotime($siklus->cooldown_end) - strtotime(date("Y-m-d H:i:s"));
        return $cooldown;
    }

    public function getSiklus() {
        $siklus = Session::find(1);
        return $siklus->sesi;
    }

    public function login() {
        return view ("peserta.index");
    }

    public function dashboard() {
        if(Auth::user()->role == "peserta"){
            return view("peserta.dashboard", ['remaining_time' => $this->getRemainingTime(), 'remaining_cooldown' => $this->getRemainingCooldown(), 'siklus' => $this->getSiklus()]);
        } else {
            return redirect()->back();
        }
    }

    public function app() {
        if(Auth::user()->role == "peserta"){
            $team = DB::table('teams')
            ->where('id', Auth::user()->tim) 
            ->select('level_app', 'promotions_id')
            ->get();
            return view("peserta.app.index", ['tim' => $team, 'remaining_time' => $this->getRemainingTime(), 'remaining_cooldown' => $this->getRemainingCooldown(), 'siklus' => $this->getSiklus()]);
        } else {
            return redirect()->back();
        }
    }

    public function modalAwal() {
        if(Auth::user()->role == "peserta"){
            $team = Team::find(Auth::user()->tim);
            $question = Question::all();
            $siklus = Session::find(1);

            if($team->modal == false && $siklus->sesi == 0){
                return view("peserta.modalawal.index", ['question' => $question, 'remaining_time' => $this->getRemainingTime(), 'remaining_cooldown' => $this->getRemainingCooldown(), 'siklus' => $this->getSiklus()]);
            } else {
                return redirect()->route('dashboardpeserta');
            }
        } else {
            return redirect()->back();
        }
    } 

    public function forecast() {
        if(Auth::user()->role == "peserta"){
            $siklus = Session::find(1);

            $team_forecast = DB::select(DB::raw("
            SELECt f.nama as nama_forecast, df.siklus as siklus_forecast, df.link as link_forecast FROM detail_forecasts AS df INNER JOIN (forecasts AS f INNER JOIN forecast_team AS ft ON f.id = ft.forecasts_id) ON df.forecasts_id = f.id WHERE ft.teams_id = ".(Auth::user()->tim)." AND df.siklus >= ft.sesi_beli AND df.siklus <= ".$siklus->sesi));

            return view("peserta.forecast.index", ['tim' => $team_forecast, 'remaining_time' => $this->getRemainingTime(), 'remaining_cooldown' => $this->getRemainingCooldown(), 'siklus' => $this->getSiklus()]);
        } else {
            return redirect()->back();
        }
    }

    public function upgradeLevel(Request $request) {
        $id = $request->get('id');
        $team = Team::find($id);
        $upgrade = false;

        $jumlah_customer = $team->jumlah_customer_app + $team->jumlah_customer_store;
        if ($team->level_app == 1) {
            if ($jumlah_customer >= 6) {
                $upgrade = true;
            }
        } else if ($team->level_app == 2) {
            if ($jumlah_customer >= 12) {
                $upgrade = true;
            }
        } else if ($team->level_app == 3) {
            if ($jumlah_customer >= 18) {
                $upgrade = true;
            }
        } else if ($team->level_app == 4) {
            if ($jumlah_customer >= 24) {
                $upgrade = true;
            }
        } else if ($team->level_app == 5) {
            if ($jumlah_customer >= 30) {
                $upgrade = true;
            }
        } else if ($team->level_app == 6) {
            $upgrade = false;

            return response()->json(array(
                'status'=> 'tidak',
                'msg'=> 'Level App sudah Max'
            ), 200);
        }

        if ($upgrade) {
            $update_team = DB::table('teams')->where('id', $id)->update(['level_app' => $team->level_app + 1]);

            // Tambah history naik level
            $new_id = DB::table('histories')->where('teams_id', $id)->max('id');
            $current_time = Carbon::now();
            $session = Session::find(1);

            $insert_history = DB::table('histories')->insert([
                'teams_id' => $id,
                'id' => $new_id + 1,
                'siklus' => $session->sesi,
                'waktu' => $current_time,
                'riwayat' => "Berhasil Upgrade App ke Level ".($team->level_app + 1),
                'tipe' => 'upgrade'
            ]);

            $status = "oke";
            $message = "Berhasil Upgrade App";
        } else {
            $status = "tidak";
            $message = "Tidak memenuhi syarat upgrade App";
        }

        return response()->json(array(
            'status'=> $status,
            'msg'=> $message
        ), 200);
    }

    public function inputForecast(Request $request) {
        $idTeam = $request->get('idTim');
        $idWilayah = $request->get('idWilayah');
        $team = Team::find($idTeam);
        $forecast = Forecast::find($idWilayah);
        $session = Session::find(1);

        $check = DB::table('forecast_team')->where('forecasts_id', $idWilayah)->where('teams_id', $idTeam)->get();

        if (count($check) > 0) {
            return response()->json(array(
                'status'=>'fail',
                'msg'=> 'Data Forecast sudah pernah dibeli'
            ), 200);
        } else {
            if ($team->saldo >= $forecast->harga) {
                $forecast_team = DB::table('forecast_team')->insert([
                    'forecasts_id' => $idWilayah,
                    'teams_id' => $idTeam,
                    'sesi_beli' => $session->sesi
                ]);
    
                $affected = DB::table('teams')->where('id', $idTeam)->update(['saldo' => $team->saldo - $forecast->harga]);
        
                // Tambah history forecast
                $new_id = DB::table('histories')->where('teams_id', $idTeam)->max('id');
                $current_time = Carbon::now();
                $session = Session::find(1);
    
                $insert_history = DB::table('histories')->insert([
                    'teams_id' => $idTeam,
                    'id' => $new_id + 1,
                    'siklus' => $session->sesi,
                    'waktu' => $current_time,
                    'riwayat' => "Membeli Forecast ".$forecast->nama,
                    'tipe' => 'forecasting'
                ]);
    
                return response()->json(array(
                    'status'=>'oke',
                    'msg'=> 'Data Forecast berhasil dibeli'
                ), 200);
            } else {
                return response()->json(array(
                    'status'=>'fail',
                    'msg'=> 'Saldo tidak mencukupi'
                ), 200);
            }
        }
    }

    public function inputPromosi(Request $request) {
        $idTeam = $request->get('id');
        $promosiBeli = $request->get('promosi');
        
        $promotion = DB::table('promotions')->where('id', $promosiBeli)->get();
        $team = Team::find($idTeam);
        $session = Session::find(1);

        // Cek FC
        if ($team->saldo >= $promotion[0]->harga) {
            $team_update = DB::table('teams')->where('id', $idTeam)->update(['saldo' => $team->saldo - $promotion[0]->harga, 'poin_promosi' => $team->poin_promosi + $promotion[0]->poin_promosi, 'promotions_id' => $promosiBeli]);
            
            // Update poin ketertarikan
            $team = Team::find($idTeam);
            $update_poin_ketertarikan = DB::table('teams')->where('id', $idTeam)->update(['poin_ketertarikan' => $team->poin_promosi * $team->jumlah_customer]);
      
            // Tambah history beli promosi
            $new_id = DB::table('histories')->where('teams_id', $idTeam)->max('id');
            $current_time = Carbon::now();

            $insert_history = DB::table('histories')->insert([
                'teams_id' => $idTeam,
                'id' => $new_id + 1,
                'siklus' => $session->sesi,
                'waktu' => $current_time,
                'riwayat' => "Membeli Promosi",
                'tipe' => 'promosi'
            ]);

            $status = "oke";
            $message = "Promosi berhasil dibeli";
        } else {
            $status = "tidak";
            $message = "Saldo tidak mencukupi";
        }
        
        return response()->json(array(
            'status'=> $status,
            'msg'=> $message
        ), 200);
    }

    public function inputProduk(Request $request) {
        $idTeam = $request->get('id');
        $produkBeli = $request->get('produk');
        $team = Team::find($idTeam);
        $price = 0;
        $session = Session::find(1);
        $transaction_id = DB::table('product_team')->where('teams_id', $idTeam)->max('id');
        
        // Cek Siklus > 4
        if ($session->sesi > 4) {
            $product_list = Product::all();

            if ($team->level_app < 4 && $produkBeli[5] > 0) {
                return response()->json(array(
                    'status' => 'tidak',
                    'msg' => 'Tidak memenuhi syarat untuk membeli produk special'
                ), 200);
            }
        } else {
            $product_list = Product::all()->take(5);
        }

        // Hitung FC yang diperlukan
        foreach($product_list as $key=>$product) {
            $price += ($product->harga_beli * $produkBeli[$key]);
        }

        if ($team->saldo >= $price) {
            $kurangi_saldo = DB::table('teams')->where('id', $idTeam)->update(['saldo' => $team->saldo - $price]);
            $produk_riwayat = "Membeli ";
            $arr_produk = array();
            
            foreach($product_list as $key=>$product) {
                if($produkBeli[$key] > 0) {
                    $product_team = DB::table('product_team')->insert([
                        'teams_id' => $idTeam,
                        'id' => $transaction_id + 1,
                        'products_id' => $key + 1,
                        'harga_jual' => $product->harga_jual,
                        'quantity' => $produkBeli[$key],
                        'sesi_beli' => $session->sesi
                    ]);

                    $arr_produk[] = $produkBeli[$key]." ".$product->nama;
                }
            }

            // Tambah history beli produk
            $new_id = DB::table('histories')->where('teams_id', $idTeam)->max('id');
            $current_time = Carbon::now();
            $session = Session::find(1);
            $produk_riwayat .= implode(", ", $arr_produk);

            $insert_history = DB::table('histories')->insert([
                'teams_id' => $idTeam,
                'id' => $new_id + 1,
                'siklus' => $session->sesi,
                'waktu' => $current_time,
                'riwayat' => $produk_riwayat,
                'tipe' => 'produk'
            ]);

            $status = "oke";
            $message = "Produk berhasil dibeli";
        } else {
            $status = "tidak";
            $message = "Saldo tidak mencukupi";
        }

        return response()->json(array(
            'status' => $status,
            'msg' => $message
        ), 200);
    }

    public function pinjamBank(Request $request) {
        $id = $request->get('id');
        $nominal = $request->get('jumlahFC');
        $session = Session::find(1);
        $team = Team::find($id);

        if($nominal > 500) {
            $status = "tidak";
            $message = "Pinjaman FC melewati batas";
        } else if($team->jumlah_pinjam < 3) {
            $get_debt_list = DB::table('banks')->where('teams_id', $id)->select('siklus')->get();
            $allow = true;

            foreach($get_debt_list as $value) {
                if($value->siklus == $session->sesi) {
                    $allow = false;
                    break;
                }
            }

            if($allow) {
                $team_update = DB::table('teams')->where('id', $id)->update(['jumlah_pinjam' => $team->jumlah_pinjam + 1, 'saldo' => $team->saldo + $nominal]);
                $insert_debt = DB::table('banks')->insert([
                    'teams_id' => $id,
                    'siklus' => $session->sesi,
                    'jumlah_pinjaman' => $nominal,
                    'bunga' => ceil($nominal * 0.03),
                    'total_bunga' => 0
                ]);

                // Tambah history pinjam FC
                $new_id = DB::table('histories')->where('teams_id', $id)->max('id');
                $current_time = Carbon::now();

                $insert_history = DB::table('histories')->insert([
                    'teams_id' => $id,
                    'id' => $new_id + 1,
                    'siklus' => $session->sesi,
                    'waktu' => $current_time,
                    'riwayat' => "Meminjam ".$nominal." FC",
                    'tipe' => 'bank'
                ]);

                $status = "oke";
                $message = "Berhasil Meminjam FC";
            } else {
                $status = "tidak";
                $message = "Tim sudah meminjam di siklus ini";
            }
        } else {
            $status = "tidak";
            $message = "Tim sudah mencapai batas maksimal meminjam FC";
        }

        return response()->json(array(
            'status'=> $status,
            'msg'=> $message
        ), 200);
    }

    public function bayarBank(Request $request) {
        $id = $request->get('id');
        $nominal = $request->get('jumlahFC');
        $team = Team::find($id);

        // Cek Jumlah Hutang
        $team_bank = DB::table('banks')->where('teams_id', $id)->orderBy('siklus', 'asc')->get();
        $debt = 0;

        foreach($team_bank as $value) {
            $debt += $value->jumlah_pinjaman;
            $debt += $value->total_bunga;
        }

        // Lunasi Hutang
        if($nominal <= $debt) {
            $nominal_bayar = $nominal;
            foreach($team_bank as $value) {
                // Kurangi hutang bagian Jumlah Pinjaman awalnya
                if ($nominal_bayar > $value->jumlah_pinjaman) {
                    $update_bank_debt = DB::table('banks')->where('teams_id', $id)->where('siklus', $value->siklus)->update(['jumlah_pinjaman' => 0]);
                    $nominal_bayar -= $value->jumlah_pinjaman;
                } else {
                    $update_bank_debt = DB::table('banks')->where('teams_id', $id)->where('siklus', $value->siklus)->update(['jumlah_pinjaman' => ($value->jumlah_pinjaman - $nominal_bayar)]);
                    $nominal_bayar = 0;
                    break;
                }

                // Kurangi hutang bagian Total Bunga
                if ($nominal_bayar > $value->total_bunga) {
                    $update_bank_debt = DB::table('banks')->where('teams_id', $id)->where('siklus', $value->siklus)->update(['total_bunga' => 0]);
                    $nominal_bayar -= $value->total_bunga;
                } else {
                    $update_bank_debt = DB::table('banks')->where('teams_id', $id)->where('siklus', $value->siklus)->update(['total_bunga' => ($value->total_bunga - $nominal_bayar)]);
                    $nominal_bayar = 0;
                    break;
                }
            }

            $update_team = DB::table('teams')->where('id', $id)->update(['saldo' => ($team->saldo - $nominal)]);

            // Tambah history bayar hutang FC
            $new_id = DB::table('histories')->where('teams_id', $id)->max('id');
            $current_time = Carbon::now();
            $session = Session::find(1);

            $insert_history = DB::table('histories')->insert([
                'teams_id' => $id,
                'id' => $new_id + 1,
                'siklus' => $session->sesi,
                'waktu' => $current_time,
                'riwayat' => "Membayar Hutang sebesar ".$nominal." FC",
                'tipe' => 'bank'
            ]);
            
            $status = "oke";
            $message = "Hutang berhasil dibayar";
        } else {
            $status = "tidak";
            $message = "Jumlah FC yang dibayarkan melebihi hutang";
        }

        return response()->json(array(
            'status'=> $status,
            'msg'=> $message
        ), 200);
    }

    public function klaimWilayah(Request $request) {
        $idTeam = $request->get('idTim');
        $idWilayah = $request->get('idWilayah');
        $koordinat = $request->get('koordinat');
        $teams = Team::find($idTeam);

        $region_detail = DB::table('regiondetails')->where('regions_id', $idWilayah)->where('id', $koordinat)->get();

        foreach ($region_detail as $rd) {
            if ($rd->teams_id != null) {
                $status = "tidak";
                $message = "Wilayah ini sudah ditempati oleh tim lain";
            } else {
                if ($teams->saldo >= 50) {
                    $region_detail = DB::table('regiondetails')->where('regions_id', $idWilayah)->where('id', $koordinat)->update(['teams_id' => $idTeam, 'jumlah_klaim' => $rd->jumlah_klaim + 1]);
                    $teams = DB::table('teams')->where('id', $idTeam)->update(['saldo' => $teams->saldo - 50]);

                    // Tambah history klaim wilayah
                    $new_id = DB::table('histories')->where('teams_id', $idTeam)->max('id');
                    $current_time = Carbon::now();
                    $session = Session::find(1);
                    $wilayah = Region::find($idWilayah);
        
                    $insert_history = DB::table('histories')->insert([
                        'teams_id' => $idTeam,
                        'id' => $new_id + 1,
                        'siklus' => $session->sesi,
                        'waktu' => $current_time,
                        'riwayat' => "Mengklaim wilayah ".$wilayah->nama." ".$koordinat,
                        'tipe' => 'wilayah'
                    ]);

                    $status = "oke";
                    $message = "Wilayah berhasil ditempati";
                } else {
                    $status = "tidak";
                    $message = "Saldo tidak mencukupi";
                }
            }

            break;
        }

        return response()->json(array(
            'status'=> $status,
            'msg'=> $message
        ), 200);
    }

    public function rebutWilayah(Request $request) {
        $idTeam = $request->get('idTim');
        $idWilayah = $request->get('idWilayah');
        $koordinat = $request->get('koordinat');
        $teams = Team::find($idTeam);
        $siklus = Session::find(1);

        $region_details = DB::table('regiondetails')->where('regions_id', $idWilayah)->where('id', $koordinat)->get();
        
        foreach ($region_details as $rd) {
            $team_now = $rd->teams_id;

            if ($rd->teams_id == null) {
                $status = "tidak";
                $message = "Wilayah ini masih kosong. Tidak bisa direbut";
            } else {
                if ($koordinat == 12) {
                    if ($siklus->sesi != 4) {
                        $status = "tidak";
                        $message = "Belum memasuki siklus competitor";
                    } else if ($teams->poin_ketertarikan < 150) {
                        $status = "tidak";
                        $message = "Poin ketertarikan tidak mencukupi";
                    } else {
                        $region_detail = DB::table('regiondetails')->where('regions_id', $idWilayah)->whereIn('id', [12,13,14,15,16])->get();
                        foreach($region_detail as $key => $value) {
                            if ($value->teams_id == $idTeam) {
                                $status = "tidak";
                                $message = "Tim sudah memiliki wilayah kompetitor di wilayah ini";
                                break;
                            }

                            if ($value->teams_id == 26 || $value->teams_id == null) { 
                                // Rebut Competitor
                                $region_detail = DB::table('regiondetails')->where('regions_id', $idWilayah)->where('id', $value->id)->update(['teams_id' => $idTeam]);
                                $teams_update = DB::table('teams')->where('id', $idTeam)->update(['jumlah_rebut_competitor' => $teams->jumlah_rebut_competitor + 1]);
    
                                // Tambah history rebut wilayah competitor
                                $new_id = DB::table('histories')->where('teams_id', $idTeam)->max('id');
                                $current_time = Carbon::now();
                                $session = Session::find(1);

                                $region = DB::table('regions')->where('id', $idWilayah)->get();
                                $riwayat = "Mengambil wilayah Competitor di ".$region[0]->nama;

                                $insert_history = DB::table('histories')->insert([
                                    'teams_id' => $idTeam,
                                    'id' => $new_id + 1,
                                    'siklus' => $session->sesi,
                                    'waktu' => $current_time,
                                    'riwayat' => $riwayat,
                                    'tipe' => 'wilayah'
                                ]);

                                $status = "oke";
                                $message = "Wilayah Competitor berhasil direbut";
                                break;
                            } else {
                                $status = "tidak";
                                $message = "Wilayah Competitor hanya bisa ditempati 5 Tim";
                            }
                        }
                    }
                } else {
                    $price = 50 * ($rd->jumlah_klaim + 1);
                    if ($teams->saldo >= $price) {
                        // Update player yang direbut
                        $team_before = Team::find($team_now);
                        $teams_update = DB::table('teams')->where('id', $team_now)->update(['saldo' => $team_before->saldo + ($price / 2)]);

                        // Update Region Detail
                        $region_detail = DB::table('regiondetails')->where('regions_id', $idWilayah)->where('id', $koordinat)->update(['teams_id' => $idTeam, 'jumlah_klaim' => $rd->jumlah_klaim + 1]);

                        // Update data tim perebut
                        $teams_update = DB::table('teams')->where('id', $idTeam)->update(['jumlah_rebut_wilayah' => $teams->jumlah_rebut_wilayah + 1, 'saldo' => $teams->saldo - $price]);
                        
                        // Tambah history rebut wilayah
                        $new_id = DB::table('histories')->where('teams_id', $idTeam)->max('id');
                        $current_time = Carbon::now();
                        $session = Session::find(1);

                        $region = DB::table('regions')->where('id', $idWilayah)->get();
                        $riwayat = "Merebut wilayah ".$team_before->nama." di ".$region[0]->nama." ".$koordinat;

                        $insert_history = DB::table('histories')->insert([
                            'teams_id' => $idTeam,
                            'id' => $new_id + 1,
                            'siklus' => $session->sesi,
                            'waktu' => $current_time,
                            'riwayat' => $riwayat,
                            'tipe' => 'wilayah'
                        ]);

                        $status = "oke";
                        $message = "Wilayah berhasil direbut";
                    } else {
                        $status = "tidak";
                        $message = "Saldo tidak mencukupi";
                    }
                }
            }

            break;
        }
        
        return response()->json(array(
            'status'=> $status,
            'msg'=> $message
        ), 200);
    }

    public function inputModalAwal(Request $request) {
        $id = Auth::user()->tim;
        $jawaban = $request->get('jawaban');
        $team = Team::find($id);
        $kunci = Question::all();
        $fc = 0;
        $siklus = Session::find(1);

        if($siklus->sesi == 0 && $team->modal == 0) {
            foreach($kunci as $key=>$value) {
                if(strtolower($jawaban[$key]) == strtolower($value->jawaban)) {
                    $fc += 20;
                }
            }
    
            $affected = DB::table('teams')->where('id', $id)->update(['saldo' => $team->saldo + $fc, 'modal' => true]);
            
            // Tambah history modal awal
            $new_id = DB::table('histories')->where('teams_id', $id)->max('id');
            $current_time = Carbon::now();
            $session = Session::find(1);
    
            $insert_history = DB::table('histories')->insert([
                'teams_id' => $id,
                'id' => $new_id + 1,
                'siklus' => $session->sesi,
                'waktu' => $current_time,
                'riwayat' => "Mendapatkan ".$fc." FC dari modal awal",
                'tipe' => 'modal'
            ]);
    
            $status = 'oke';
            $message = 'Jawaban berhasil disimpan';
        } else {
            $status = 'tidak';
            $message = 'Sesi modal awal telah berakhir atau sudah mengerjakan modal awal';
        }

        return response()->json(array(
            'status'=> $status,
            'msg'=> $message
        ), 200);
    }

    public function cekModalAwal(Request $request) {
        $id = Auth::user()->tim;
        $team = Team::find($id);
        $siklus = Session::find(1);

        return response()->json(array(
            'status'=> 'oke',
            'msg'=> $team,
            'siklus'=> $siklus
        ), 200);
    }

    public function realTimeMap(Request $request) {
        $region_details = DB::table('regiondetails')->join('teams', 'regiondetails.teams_id', '=', 'teams.id')->whereIn('regions_id', [2,3,4])->select('regions_id','regiondetails.id','teams_id', 'jumlah_klaim','nama')->get();

        return response()->json(array(
            'status'=> 'oke',
            'daftarRegionDetails' => $region_details
        ), 200);
    }

    public function realTimeCustomer(Request $request) {
        $siklus = Session::find(1);
        $customer_app_list = DB::table('customers')->join('tipecustomers', 'customers.tipecustomers_id', '=', 'tipecustomers.id')->join('products', 'customers.syarat_produk', '=', 'products.id')->where('tipecustomers_id', 1)->where('customers.kuota', '>', 0)->where('customers.siklus','=', $siklus->sesi)->select('tipecustomers.nama as nama_customer', 'products.nama as nama_produk', 'customers.*')->orderBy('id', 'asc')->get();

        $customer_store_list = DB::table('customers')->join('tipecustomers', 'customers.tipecustomers_id', '=', 'tipecustomers.id')->join('products', 'customers.syarat_produk', '=', 'products.id')->join('regions', 'customers.syarat_wilayah', '=', 'regions.id')->where('tipecustomers_id', 2)->where('customers.kuota', '>', 0)->where('customers.siklus','=', $siklus->sesi)->select('tipecustomers.nama as nama_customer', 'products.nama as nama_produk', 'customers.*', 'regions.nama as nama_wilayah')->orderBy('id', 'asc')->get();

        return response()->json(array(
            'status'=> 'oke',
            'daftarCustomerApp' => $customer_app_list,
            'daftarCustomerStore' => $customer_store_list
        ), 200);
    }

    public function inputClaimCustomer(Request $request) {
        $team_id = $request->get('team_id');
        $customer_id = $request->get('customer_id');
        $message = "";
        $check = true;

        $team = Team::find($team_id);
        $customer = Customer::find($customer_id);
        $cek_customer_team = DB::table('customer_team')->where('teams_id', $team_id)->where('customers_id', $customer_id)->get();
        $jumlah_produk_team = DB::table('product_team')->where('teams_id', $team_id)->where('products_id', $customer->syarat_produk)->sum('quantity');

        if (count($cek_customer_team) > 0) {
            return response()->json(array(
                'status'=> 'tidak',
                'msg' => 'Tim sudah pernah membeli customer ini sebelumnya!'
            ), 200);
        }

        // Memastikan customer terkait masih tersedia
        if ($customer->kuota > 0) {
            // Cek syarat jumlah produk
            if ($jumlah_produk_team < $customer->jumlah_produk) { 
                $message .= "Jumlah produk yang dimiliki tidak cukup.\n"; 
                $check = false;
            }

            // Cek level app untuk customer app
            if ($customer->tipecustomers_id == 1) {
                if ($team->level_app < $customer->syarat_bintang) {
                    $message .= "Level App tidak memenuhi syarat. \n";
                    $check = false;
                } 
            }

            // Cek syarat untuk customer store
            if ($customer->tipecustomers_id == 2) {
                $exist = false;

                // Cek syarat wilayah untuk customer store
                if ($customer->competitor == true) {
                    $region_detail_competitor_list = DB::table('regiondetails')->where('regions_id', $customer->syarat_wilayah)->whereIn('id', [12,13,14,15,16])->get();

                    foreach ($region_detail_competitor_list as $rdcl) {
                        if ($rdcl->teams_id == $team_id) {
                            $exist = true;
                            break;
                        }
                    }

                    if (!$exist) {
                        $message .= "Tim tidak memiliki wilayah competitor di wilayah ini. \n";
                        $check = false;
                    }
                } else {
                    $region_detail_list = Regiondetail::all()->where('teams_id', $team_id);
    
                    foreach ($region_detail_list as $rdl) {
                        if ($rdl->regions_id == $customer->syarat_wilayah) {
                            $exist = true;
                            break;
                        }
                    }
    
                    if (!$exist) {
                        $message .= "Wilayah yang dimiliki tidak memenuhi syarat. \n";
                        $check = false;
                    }
                }

                // Cek syarat poin ketertarikan
                if ($team->poin_ketertarikan < $customer->syarat_tertarik) {
                    $message .= "Poin ketertarikan yang dimiliki tidak memenuhi syarat. \n";
                    $check = false;
                }
            }

            // Sukses klaim customer
            if ($check) {
                // Kurangi kuota customer
                $kurangi_customer = DB::table('customers')->where('id', $customer_id)->update(['kuota' => $customer->kuota - 1]);

                // Kurangi produk yang dimiliki team
                $produk_butuh = $customer->jumlah_produk;
                $daftar_produk_team = DB::table('product_team')->where('teams_id', $team_id)->where('products_id', $customer->syarat_produk)->orderBy('id', 'asc')->get();

                foreach($daftar_produk_team as $dpt) {
                    if ($dpt->quantity >= $produk_butuh) {
                        $update_produk = DB::table('product_team')->where('teams_id', $team_id)->where('id', $dpt->id)->where('products_id', $dpt->products_id)->update(['quantity' => $dpt->quantity - $produk_butuh]);
                        break;
                    } else {
                        $update_produk = DB::table('product_team')->where('teams_id', $team_id)->where('id', $dpt->id)->where('products_id', $dpt->products_id)->update(['quantity' => 0]);
                        $produk_butuh -= $dpt->quantity;
                    }
                }

                // Tambah FC yang dimiliki team
                $product_related = DB::table('products')->where('id', $customer->syarat_produk)->select('harga_jual')->get();
                foreach($product_related as $p){
                    $price_per_item = $p->harga_jual;
                    break;
                }
                $total_price = $price_per_item * $customer->jumlah_produk;

                if ($customer->tipecustomers_id == 1) {
                    $update_team = DB::table('teams')->where('id', $team_id)->update(['jumlah_customer' => $team->jumlah_customer + $team->level_app, 'jumlah_customer_app' => $team->jumlah_customer_app + 1, 'saldo' => $team->saldo + $total_price]);
                } else if ($customer->tipecustomers_id == 2) {
                    $update_team = DB::table('teams')->where('id', $team_id)->update(['jumlah_customer' => $team->jumlah_customer + 1, 'jumlah_customer_store' => $team->jumlah_customer_store + 1, 'saldo' => $team->saldo + $total_price]);
                }
                
                // Update poin ketertarikan
                $team = Team::find($team_id);
                $update_poin_ketertarikan = DB::table('teams')->where('id', $team_id)->update(['poin_ketertarikan' => $team->poin_promosi * $team->jumlah_customer]);

                // Insert Customer Team Bridge
                $insert_history = DB::table('customer_team')->insert([
                    'teams_id' => $team_id,
                    'customers_id' => $customer_id
                ]);
                
                // Tambah history klaim customer
                $new_id = DB::table('histories')->where('teams_id', $team_id)->max('id');
                $current_time = Carbon::now();
                $session = Session::find(1);
                $customer_type = ($customer->tipecustomers_id == 1) ? "App" : "Store";
                $history = "Mengklaim Customer ".$customer_type;
                $insert_history = DB::table('histories')->insert([
                    'teams_id' => $team_id,
                    'id' => $new_id + 1,
                    'siklus' => $session->sesi,
                    'waktu' => $current_time,
                    'riwayat' => $history,
                    'tipe' => 'klaim_customer'
                ]);

                $status = "oke";
                $message = "Berhasil beli customer";
            } else {
                $status = "tidak";
            }
        } else {
            $status = "tidak";
            $message = "Customer terkait sudah tidak tersedia";
        }

        return response()->json(array(
            'status'=> $status,
            'msg' => $message
        ), 200);
    }

    public function showTeamPromotion(Request $request) {
        $id = $request->get('id');
        $team_promotion = DB::table('teams')->where('id', $id)->select('promotions_id')->get();

        foreach($team_promotion as $value) {
            $buy = (($value->promotions_id == null)?true:false);
            break;
        }

        return response()->json(array(
            'status'=> 'oke',
            'allow'=> $buy
        ), 200);
    }

    public function showHistory(Request $request) {
        $id = $request->get('id');
        $tipe = $request->get('tipe');
        $riwayat = DB::table('histories')->where('teams_id', $id)->where('tipe', $tipe)->orderBy('waktu', 'desc')->get();
        $nama_tim = DB::table('teams')->where('id', $id)->get();

        return response()->json(array(
            'status'=> 'oke',
            'riwayat' => $riwayat,
            'nama_tim' => $nama_tim
        ), 200);
    }

    public function realTimePlayerDetail(Request $request) {
        $team_id = Auth::user()->tim;
        $team = DB::table('teams')->join('regiondetails', 'teams.id', '=', 'regiondetails.teams_id')->where('teams.id', $team_id)->select('teams.*', 'regiondetails.regions_id', 'regiondetails.id as koordinat')->get();

        $produk_team_1 = DB::table('product_team')
        ->join('products', 'product_team.products_id', '=', 'products.id')
        ->where('teams_id', $team_id)
        ->where('sesi_beli', 1)
        ->select("products.id", "products.nama as nama_produk", "products.image_url as image", "product_team.harga_jual",  DB::raw("sum(quantity) as quantity"), "sesi_beli")
        ->orderBy('sesi_beli', 'asc')
        ->orderBy('products.id', 'asc')
        ->groupBy('products.id', 'products.nama', 'products.image_url','product_team.harga_jual', 'sesi_beli')
        ->get();

        $produk_team_2 = DB::table('product_team')
        ->join('products', 'product_team.products_id', '=', 'products.id')
        ->where('teams_id', $team_id)
        ->where('sesi_beli', 2)
        ->select("products.id", "products.nama as nama_produk", "products.image_url as image", "product_team.harga_jual",  DB::raw("sum(quantity) as quantity"), "sesi_beli")
        ->orderBy('sesi_beli', 'asc')
        ->orderBy('products.id', 'asc')
        ->groupBy('products.id', 'products.nama', 'products.image_url','product_team.harga_jual', 'sesi_beli')
        ->get();

        $produk_team_3 = DB::table('product_team')
        ->join('products', 'product_team.products_id', '=', 'products.id')
        ->where('teams_id', $team_id)
        ->where('sesi_beli', 3)
        ->select("products.id", "products.nama as nama_produk", "products.image_url as image", "product_team.harga_jual",  DB::raw("sum(quantity) as quantity"), "sesi_beli")
        ->orderBy('sesi_beli', 'asc')
        ->orderBy('products.id', 'asc')
        ->groupBy('products.id', 'products.nama', 'products.image_url','product_team.harga_jual', 'sesi_beli')
        ->get();

        $produk_team_4 = DB::table('product_team')
        ->join('products', 'product_team.products_id', '=', 'products.id')
        ->where('teams_id', $team_id)
        ->where('sesi_beli', 4)
        ->select("products.id", "products.nama as nama_produk", "products.image_url as image", "product_team.harga_jual",  DB::raw("sum(quantity) as quantity"), "sesi_beli")
        ->orderBy('sesi_beli', 'asc')
        ->orderBy('products.id', 'asc')
        ->groupBy('products.id', 'products.nama', 'products.image_url','product_team.harga_jual', 'sesi_beli')
        ->get();

        $produk_team_5 = DB::table('product_team')
        ->join('products', 'product_team.products_id', '=', 'products.id')
        ->where('teams_id', $team_id)
        ->where('sesi_beli', 5)
        ->select("products.id", "products.nama as nama_produk", "products.image_url as image", "product_team.harga_jual",  DB::raw("sum(quantity) as quantity"), "sesi_beli")
        ->orderBy('sesi_beli', 'asc')
        ->orderBy('products.id', 'asc')
        ->groupBy('products.id', 'products.nama', 'products.image_url','product_team.harga_jual', 'sesi_beli')
        ->get();

        $produk_team_6 = DB::table('product_team')
        ->join('products', 'product_team.products_id', '=', 'products.id')
        ->where('teams_id', $team_id)
        ->where('sesi_beli', 6)
        ->select("products.id", "products.nama as nama_produk", "products.image_url as image", "product_team.harga_jual",  DB::raw("sum(quantity) as quantity"), "sesi_beli")
        ->orderBy('sesi_beli', 'asc')
        ->orderBy('products.id', 'asc')
        ->groupBy('products.id', 'products.nama', 'products.image_url','product_team.harga_jual', 'sesi_beli')
        ->get();

        $produk_team_7 = DB::table('product_team')
        ->join('products', 'product_team.products_id', '=', 'products.id')
        ->where('teams_id', $team_id)
        ->where('sesi_beli', 7)
        ->select("products.id", "products.nama as nama_produk", "products.image_url as image", "product_team.harga_jual",  DB::raw("sum(quantity) as quantity"), "sesi_beli")
        ->orderBy('sesi_beli', 'asc')
        ->orderBy('products.id', 'asc')
        ->groupBy('products.id', 'products.nama', 'products.image_url','product_team.harga_jual', 'sesi_beli')
        ->get();

        $team_bank = DB::table('banks')->where('teams_id', $team_id)->get();
        $debt = 0;

        foreach($team_bank as $value) {
            $debt += $value->jumlah_pinjaman;
            $debt += $value->total_bunga;
        }

        return response()->json(array(
            'status'=> 'oke',
            'team' => $team,
            'produk_team_1' => $produk_team_1,
            'produk_team_2' => $produk_team_2,
            'produk_team_3' => $produk_team_3,
            'produk_team_4' => $produk_team_4,
            'produk_team_5' => $produk_team_5,
            'produk_team_6' => $produk_team_6,
            'produk_team_7' => $produk_team_7,
            'debt' => $debt
        ), 200);
    }

    public function showDebt(Request $request) {
        $id = $request->get('id');
        $team_bank = DB::table('banks')->where('teams_id', $id)->get();
        $debt = 0;

        foreach($team_bank as $value) {
            $debt += $value->jumlah_pinjaman;
            $debt += $value->total_bunga;
        }

        return response()->json(array(
            'status'=> 'oke',
            'debt'=> $debt
        ), 200);
    }

    public function getProductTeamDetail(Request $request) {
        $id = $request->get('id');

        $product_team_detail_1 = DB::table('product_team')->where('teams_id', $id)->where('products_id', 1)->sum('quantity');
        $product_team_detail_2 = DB::table('product_team')->where('teams_id', $id)->where('products_id', 2)->sum('quantity');
        $product_team_detail_3 = DB::table('product_team')->where('teams_id', $id)->where('products_id', 3)->sum('quantity');
        $product_team_detail_4 = DB::table('product_team')->where('teams_id', $id)->where('products_id', 4)->sum('quantity');
        $product_team_detail_5 = DB::table('product_team')->where('teams_id', $id)->where('products_id', 5)->sum('quantity');

        $product_list = Product::all();

        return response()->json(array(
            'status'=> 'oke',
            'product_team_detail'=> [$product_team_detail_1, $product_team_detail_2, $product_team_detail_3, $product_team_detail_4, $product_team_detail_5],
            'product_list'=> $product_list
        ), 200);
    }

    public function sellProductCompetitor(Request $request) {
        $team_id = $request->get('id');
        $teams = Team::find($team_id);
        $product_team = $request->get('products');
        $product_team_for_calculation = $product_team;
        $customer = Customer::find(121);
        $product_list = Product::all();

        $product_team_detail_1 = DB::table('product_team')->where('teams_id', $team_id)->where('products_id', 1)->sum('quantity');
        $product_team_detail_2 = DB::table('product_team')->where('teams_id', $team_id)->where('products_id', 2)->sum('quantity');
        $product_team_detail_3 = DB::table('product_team')->where('teams_id', $team_id)->where('products_id', 3)->sum('quantity');
        $product_team_detail_4 = DB::table('product_team')->where('teams_id', $team_id)->where('products_id', 4)->sum('quantity');
        $product_team_detail_5 = DB::table('product_team')->where('teams_id', $team_id)->where('products_id', 5)->sum('quantity');

        if ($customer->kuota > 0) {
            $access = true;

            if ($product_team_detail_1 < $product_team[0]) { $access = false; }
            if ($product_team_detail_2 < $product_team[1]) { $access = false; }
            if ($product_team_detail_3 < $product_team[2]) { $access = false; }
            if ($product_team_detail_4 < $product_team[3]) { $access = false; }
            if ($product_team_detail_5 < $product_team[4]) { $access = false; }

            if ($access) {
                $daftar_produk_team_1 = DB::table('product_team')->where('teams_id', $team_id)->where('products_id', 1)->orderBy('id', 'asc')->get();
                $daftar_produk_team_2 = DB::table('product_team')->where('teams_id', $team_id)->where('products_id', 2)->orderBy('id', 'asc')->get();
                $daftar_produk_team_3 = DB::table('product_team')->where('teams_id', $team_id)->where('products_id', 3)->orderBy('id', 'asc')->get();
                $daftar_produk_team_4 = DB::table('product_team')->where('teams_id', $team_id)->where('products_id', 4)->orderBy('id', 'asc')->get();
                $daftar_produk_team_5 = DB::table('product_team')->where('teams_id', $team_id)->where('products_id', 5)->orderBy('id', 'asc')->get();

                // Eliminasi Produk Pertama
                foreach($daftar_produk_team_1 as $dpt) {
                    if ($dpt->quantity >= $product_team[0]) {
                        $update_produk = DB::table('product_team')->where('teams_id', $team_id)->where('id', $dpt->id)->where('products_id', $dpt->products_id)->update(['quantity' => $dpt->quantity - $product_team[0]]);
                        break;
                    } else {
                        $update_produk = DB::table('product_team')->where('teams_id', $team_id)->where('id', $dpt->id)->where('products_id', $dpt->products_id)->update(['quantity' => 0]);
                        $product_team[0] -= $dpt->quantity;
                    }
                }

                // Eliminasi Produk Kedua
                foreach($daftar_produk_team_2 as $dpt) {
                    if ($dpt->quantity >= $product_team[1]) {
                        $update_produk = DB::table('product_team')->where('teams_id', $team_id)->where('id', $dpt->id)->where('products_id', $dpt->products_id)->update(['quantity' => $dpt->quantity - $product_team[1]]);
                        break;
                    } else {
                        $update_produk = DB::table('product_team')->where('teams_id', $team_id)->where('id', $dpt->id)->where('products_id', $dpt->products_id)->update(['quantity' => 0]);
                        $product_team[1] -= $dpt->quantity;
                    }
                }

                // Eliminasi Produk Ketiga
                foreach($daftar_produk_team_3 as $dpt) {
                    if ($dpt->quantity >= $product_team[2]) {
                        $update_produk = DB::table('product_team')->where('teams_id', $team_id)->where('id', $dpt->id)->where('products_id', $dpt->products_id)->update(['quantity' => $dpt->quantity - $product_team[2]]);
                        break;
                    } else {
                        $update_produk = DB::table('product_team')->where('teams_id', $team_id)->where('id', $dpt->id)->where('products_id', $dpt->products_id)->update(['quantity' => 0]);
                        $product_team[2] -= $dpt->quantity;
                    }
                }

                // Eliminasi Produk Keempat
                foreach($daftar_produk_team_4 as $dpt) {
                    if ($dpt->quantity >= $product_team[3]) {
                        $update_produk = DB::table('product_team')->where('teams_id', $team_id)->where('id', $dpt->id)->where('products_id', $dpt->products_id)->update(['quantity' => $dpt->quantity - $product_team[3]]);
                        break;
                    } else {
                        $update_produk = DB::table('product_team')->where('teams_id', $team_id)->where('id', $dpt->id)->where('products_id', $dpt->products_id)->update(['quantity' => 0]);
                        $product_team[3] -= $dpt->quantity;
                    }
                }

                // Eliminasi Produk Kelima
                foreach($daftar_produk_team_5 as $dpt) {
                    if ($dpt->quantity >= $product_team[4]) {
                        $update_produk = DB::table('product_team')->where('teams_id', $team_id)->where('id', $dpt->id)->where('products_id', $dpt->products_id)->update(['quantity' => $dpt->quantity - $product_team[4]]);
                        break;
                    } else {
                        $update_produk = DB::table('product_team')->where('teams_id', $team_id)->where('id', $dpt->id)->where('products_id', $dpt->products_id)->update(['quantity' => 0]);
                        $product_team[4] -= $dpt->quantity;
                    }
                }

                // Update Saldo & Jumlah Customer
                $total_harga_jual = 0;
                foreach($product_list as $key=>$value) {
                    $total_harga_jual += ($product_team_for_calculation[$key] * $value->harga_jual);
                }

                $teams_update = DB::table('teams')->where('id', $team_id)->update(['saldo' => $teams->saldo + $total_harga_jual, 'jumlah_customer_store' => $teams->jumlah_customer_store + 1, 'jumlah_customer' => $teams->jumlah_customer + 1]);

                // Update poin ketertarikan
                $team = Team::find($team_id);
                $update_poin_ketertarikan = DB::table('teams')->where('id', $team_id)->update(['poin_ketertarikan' => $team->poin_promosi * $team->jumlah_customer]);

                // Kurangi kuota customer
                $kurangi_customer = DB::table('customers')->where('id', 121)->update(['kuota' => $customer->kuota - 1]);

                // Tambah history klaim customer competitor
                $new_id = DB::table('histories')->where('teams_id', $team_id)->max('id');
                $current_time = Carbon::now();
                $session = Session::find(1);
                
                $insert_history = DB::table('histories')->insert([
                    'teams_id' => $team_id,
                    'id' => $new_id + 1,
                    'siklus' => $session->sesi,
                    'waktu' => $current_time,
                    'riwayat' => "Mengklaim Customer Store Competitor",
                    'tipe' => 'klaim_customer'
                ]);


                $status = "oke";
                $message = "Produk berhasil dijual";
            } else {
                $status = "tidak";
                $message = "Produk yang dimiliki tidak mencukupi";
            }
        } else {
            $status = "tidak";
            $message = "Customer terkait sudah tidak tersedia";
        }
        
        return response()->json(array(
            'status'=> $status,
            'msg'=> $message
        ), 200);
    }

    public function openFranchise(Request $request) {
        $team_id = $request->get('id');
        $teams = Team::find($team_id);

        if ($teams->poin_ketertarikan >= (($teams->franchise + 1) * 500)) {
            $update_team = DB::table('teams')->where('id', $team_id)->update(['saldo' => $teams->saldo + 100, 'franchise' => $teams->franchise + 1]);

            // Tambah history buka frnachise
            $new_id = DB::table('histories')->where('teams_id', $team_id)->max('id');
            $current_time = Carbon::now();
            $session = Session::find(1);
            
            $insert_history = DB::table('histories')->insert([
                'teams_id' => $team_id,
                'id' => $new_id + 1,
                'siklus' => $session->sesi,
                'waktu' => $current_time,
                'riwayat' => "Membuka Franchise",
                'tipe' => 'franchise'
            ]);

            $status = "oke";
            $message = "Berhasil membuka Franchise";
        } else {
            $status = "tidak";
            $message = "Poin ketertarikan tidak mencukupi untuk membuka Franchise";
        }
        
        return response()->json(array(
            'status'=> $status,
            'msg'=> $message
        ), 200);
    }

    public function realTimeProduk(Request $request) {
        $siklus = Session::find(1);

        if ($siklus->sesi > 4) {
            $product_list = Product::select('id', 'nama', 'harga_beli')->get();
        } else {
            $product_list = Product::select('id', 'nama', 'harga_beli')->take(5)->get();
        }

        return response()->json(array(
            'status'=> "oke",
            'produk'=> $product_list
        ), 200);
    }
}