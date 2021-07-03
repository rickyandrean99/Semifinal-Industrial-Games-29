<?php

namespace App\Http\Controllers;

use App\Panitia;
use App\Team;
use App\Product;
use App\Forecast;
use App\Promotion;
use App\Region;
use App\Regiondetail;
use App\Customer;
use App\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Events\UpdateSiklus;
use Auth;
use DB;

class PanitiaController extends Controller
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

    public function dashboardPanitia() {
        if(Auth::user()->role == "panitia"){
            return view('panitia.dashboard', ['remaining_time' => $this->getRemainingTime(), 'remaining_cooldown' => $this->getRemainingCooldown(), 'siklus' => $this->getSiklus()]);
        } else {
            return redirect()->back();
        }
    }

    public function posRating() {
        if(Auth::user()->role == "panitia"){
            $team_list = Team::all()->take(25);
            return view('panitia.rating.index', ['daftarTim' => $team_list, 'remaining_time' => $this->getRemainingTime(), 'remaining_cooldown' => $this->getRemainingCooldown(), 'siklus' => $this->getSiklus()]);
        } else {
            return redirect()->back();
        }
    }

    public function posProduk() {
        if(Auth::user()->role == "panitia"){
            $siklus = Session::find(1);
            $team_list = Team::all()->take(25);

            if ($siklus->sesi > 4) {
                $product_list = Product::all();
            } else {
                $product_list = Product::all()->take(5);
            }
            
            return view('panitia.produk.index', ['daftarTim' => $team_list, 'daftarProduk' => $product_list, 'remaining_time' => $this->getRemainingTime(), 'remaining_cooldown' => $this->getRemainingCooldown(), 'siklus' => $this->getSiklus()]);
        } else {
            return redirect()->back();
        }
    }

    public function posForecasting() {
        if(Auth::user()->role == "panitia"){ 
            $team_list = Team::all()->take(25);
            $forecast_list = Forecast::all();
            return view('panitia.forecasting.index', ['daftarTim' => $team_list, 'daftarForecast' => $forecast_list, 'remaining_time' => $this->getRemainingTime(), 'remaining_cooldown' => $this->getRemainingCooldown(), 'siklus' => $this->getSiklus()]);
        } else {
            return redirect()->back();
        }
    }

    public function posPromosi() {
        if(Auth::user()->role == "panitia"){ 
            $team_list = Team::all()->take(25);
            $promotion_list = Promotion::all();
            return view('panitia.promosi.index', ['daftarTim' => $team_list, 'daftarPromotion' => $promotion_list, 'remaining_time' => $this->getRemainingTime(), 'remaining_cooldown' => $this->getRemainingCooldown(), 'siklus' => $this->getSiklus()]);
        } else {
            return redirect()->back();
        }
    }

    public function posWilayah() {
        if(Auth::user()->role == "panitia" && (Auth::user()->akses == "map" || Auth::user()->akses == "si")){ 
            $team_list = Team::all()->take(25);
            $region_list = Region::all()->whereIn('id', [2,3,4]);
            return view('panitia.wilayah.index', ['daftarTim' => $team_list, 'daftarRegion' => $region_list, 'remaining_time' => $this->getRemainingTime(), 'remaining_cooldown' => $this->getRemainingCooldown(), 'siklus' => $this->getSiklus()]);
        } else {
            return redirect()->back();
        }
    }

    public function miniGames() {
        if(Auth::user()->role == "panitia"){ 
            $team_list = Team::all()->take(25);
            return view('panitia.minigames.index', ['daftarTim' => $team_list, 'remaining_time' => $this->getRemainingTime(), 'remaining_cooldown' => $this->getRemainingCooldown(), 'siklus' => $this->getSiklus()]);
        } else {
            return redirect()->back();
        }
    }

    public function inputCustomer() {
        if(Auth::user()->role == "panitia" && (Auth::user()->akses == "input_customer" || Auth::user()->akses == "si")){ 
            $team_list = Team::all()->take(25);
            $customer_store_app = Customer::all()->where('tipecustomers_id', 1);
            $customer_store_list = Customer::all()->where('tipecustomers_id', 2);

            return view('panitia.inputcustomer.index', ['daftarTim' => $team_list, 'daftarCustomerApp' => $customer_store_app, 'daftarCustomerStore' => $customer_store_list, 'remaining_time' => $this->getRemainingTime(), 'remaining_cooldown' => $this->getRemainingCooldown(), 'siklus' => $this->getSiklus()]);
        } else {
            return redirect()->back();
        }
    }

    public function franchise() {
        if(Auth::user()->role == "panitia"){ 
            $team_list = Team::all()->take(25);
            return view('panitia.franchise.index', ['daftarTim' => $team_list, 'remaining_time' => $this->getRemainingTime(), 'remaining_cooldown' => $this->getRemainingCooldown(), 'siklus' => $this->getSiklus()]);
        } else {
            return redirect()->back();
        }
    }

    public function updateSiklus() {
        if(Auth::user()->role == "panitia" && Auth::user()->akses == "si"){ 
            return view('panitia.siklus.index', ['remaining_time' => $this->getRemainingTime(), 'remaining_cooldown' => $this->getRemainingCooldown(), 'siklus' => $this->getSiklus()]);
        } else {
            return redirect()->back();
        }
    }

    public function updateSiklusTimer() {
        $siklus = Session::find(1);

        if ($siklus->sesi == -1) {
            $next_end = Carbon::now()->addMinutes(10);
            $cooldown_end = Carbon::now()->addMinutes(12);
            $end = 600;
        } else if ($siklus->sesi != 3) {
            $next_end = Carbon::now()->addMinutes(18);
            $cooldown_end = Carbon::now()->addMinutes(20);
            $end = 1080;
        } else {
            $next_end = Carbon::now()->addMinutes(23);
            $cooldown_end = Carbon::now()->addMinutes(25);
            $end = 1380;
        }

        // // Update Siklus 
        $update_siklus = DB::table('sessions')->where('id', 1)->update(['sesi' => $siklus->sesi + 1, 'timer_limit' => $next_end, 'cooldown_end' => $cooldown_end]);
        
        // Hapus produk yang expired
        $siklus = Session::find(1);
        $reset_produk = DB::table('product_team')->where('sesi_beli', '<=', $siklus->sesi - 2)->update(['quantity' => 0]);

        // Kembalikan Harga Produk ke Normal 
        $update_produk_1 = DB::table('products')->where('id', 1)->update(['harga_beli' => 10]);
        $update_produk_2 = DB::table('products')->where('id', 2)->update(['harga_beli' => 15]);
        $update_produk_3 = DB::table('products')->where('id', 3)->update(['harga_beli' => 15]);
        $update_produk_4 = DB::table('products')->where('id', 4)->update(['harga_beli' => 20]);
        $update_produk_5 = DB::table('products')->where('id', 5)->update(['harga_beli' => 20]);
        $update_produk_6 = DB::table('products')->where('id', 6)->update(['harga_beli' => 10]);

        // Tambah Bunga bank
        $bank_list = DB::table('banks')->get();
        foreach($bank_list as $bank) {
            if($bank->jumlah_pinjaman != 0 || $bank->total_bunga != 0) {
                $tambah_bunga = DB::table('banks')->where('teams_id', $bank->teams_id)->where('siklus', $bank->siklus)->update(['total_bunga' => $bank->total_bunga + $bank->bunga]);
            }
        }

        // Royalty Fee Franchise
        $teams = Team::all()->take(25);
        foreach ($teams as $key => $value) {
            $update_royalty = DB::table('teams')->where('id', $value->id)->update(['saldo' => $value->saldo + ($value->franchise * 50)]);
        }

        // Update Timer pada peserta dan panitia
        $siklus = Session::find(1);
        event(new UpdateSiklus($siklus->sesi, true, false, $end));

        return ["success" => true];
    }

    public function getTimer() {
        $siklus = Session::find(1);
        $difference = strtotime($siklus->timer_limit) - strtotime(date("Y-m-d H:i:s"));

        return response()->json(array(
            'status'=> 'oke',
            'time' => $difference
        ), 200);
    }

    public function mapWilayah() {
        if(Auth::user()->role == "panitia" && (Auth::user()->akses == "map_main" || Auth::user()->akses == "si")){
            return view('panitia.maps.index', ['remaining_time' => $this->getRemainingTime(), 'remaining_cooldown' => $this->getRemainingCooldown(), 'siklus' => $this->getSiklus()]);
        } else {
            return redirect()->back();
        }
    }

    public function customerList() {
        if(Auth::user()->role == "panitia" && (Auth::user()->akses == "customer_main" || Auth::user()->akses == "si")){
            return view('panitia.customer.index', ['remaining_time' => $this->getRemainingTime(), 'remaining_cooldown' => $this->getRemainingCooldown(), 'siklus' => $this->getSiklus()]);
        } else {
            return redirect()->back();
        }
    }

    public function updateHargaProduk() {
        $update_produk_1 = DB::table('products')->where('id', 1)->update(['harga_beli' => 13]);
        $update_produk_2 = DB::table('products')->where('id', 2)->update(['harga_beli' => 18]);
        $update_produk_3 = DB::table('products')->where('id', 3)->update(['harga_beli' => 18]);
        $update_produk_4 = DB::table('products')->where('id', 4)->update(['harga_beli' => 28]);
        $update_produk_5 = DB::table('products')->where('id', 5)->update(['harga_beli' => 28]);
        $update_produk_6 = DB::table('products')->where('id', 6)->update(['harga_beli' => 13]);

        return response()->json(array(
            'status'=> 'oke'
        ), 200);
    }
}