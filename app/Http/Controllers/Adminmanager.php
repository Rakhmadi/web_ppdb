<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\pengumuman;
use App\prodi;
use App\User;
use App\spas;
use DB;
class Adminmanager extends Controller
{
    public function addadmin(Request $r){
        $v=Validator::make($r->all(),[
            'nama'=>'required',
            'password'=>'required'
        ]);
        if ($v->fails()) {
           return response()->json($v->errors());
        } else {
            $token=bcrypt(Carbon::now());
        Admin::create([
            'nama'=>$r->nama,
            'password'=>Hash::make($r->password),
            'token'=>$token
        ])->save();
        return response()->json(['msg'=>'success','token'=>$token]);
        }
    }
    public function login(Request $r){
        $v=Validator::make($r->all(),[
            'nama'=>'required',
            'password'=>'required'
        ]);
        if ($v->fails()) {
           return response()->json($v->errors());
        } else{
            $y=Admin::where('nama','=',$r->nama)->first();
            if ( Hash::check($r->password, $y->password)) {
               return response()->json(['token'=>$y->token]);
            } else {
                return response()->json(['fail'],500);
            }
        }
    }
    public function logout( Request $r){
        if (Admin::where('token','=',$r->token)->exists()) {

        Admin::where('token','=',$r->token)->update([
            'token'=>bcrypt(Carbon::now())
        ]);
        return response()->json(['msg'=>'success']);
        } else {
        return response()->json(['msg'=>'unauth'],401);
        }
    }
    public function addUser(Request $r){
        $v=Validator::make($r->all(),[
            'name'=>'required',
        ]);
        if ($v->fails()) {
           return response()->json($v->errors());
        } else{
            $random=mt_rand('1000000','9999999');
            $rs=Admin::where('token','=',$r->token)->first();
            $ghj=Hash::make($random);
            $td='000'.mt_rand('10000','99999');
        User::create([
            'name'=>$r->name,
            'password'=>$ghj,
            'token'=>bcrypt(Carbon::now()),
            'admin_input'=>$rs->nama,
            'noreg'=>$td
        ])->save();
        spas::create([
            'name'=>$r->name,
            'pass'=>$random,
            'noreg'=>$td
        ])->save();
        return response()->json([
            'nama'=>$r->name,
            'password'=>$random,
            'noreg'=>$td
        ]);
        }

    }
    public function cekuser(Request $r){
        $fr=Admin::where('token','=',$r->token)->exists();
        if ($fr) {
            return response()->json([
                'msg'=>'ok'
            ]);
        } else {
            return response()->json([
                'msg'=>'err'
            ],401);
        }
    }
    public function alluser(){
        $tg=User::orderBy('id','desc')->get();
        return response()->json($tg);
    }
    //
    //
    //
    //
    //
    //
    //'41

    public function addpengumuman(Request $r){
        $v=Validator::make($r->all(),[
            'isi'=>'required',

        ]);
        if ($v->fails()) {
           return response()->json($v->errors());
        } else{
            pengumuman::create([
                'isi'=>$r->isi
            ])->save();
            return response()->json(['msg'=>'success']);
        }
    }
    public function deletepengumuman($id){
       try {
        pengumuman::where('id','=',$id)->delete();
        return response()->json(['msg'=>'success']);

       } catch (\Throwable $th) {
          return response()->json(['msg'=>$th]);
       }
    }
    public function pengumuman(){
        $t=pengumuman::orderBy('id','desc')->get();
        return response()->json($t);
    }
    public function addprodi(Request $r){
        $v=prodi::make($r->all(),[
            'prodi'=>'required',

        ]);
        if ($v->fails()) {
           return response()->json($v->errors());
        } else{
            prodi::create([
                'prodi'=>$r->prodi
            ])->save();
            return response()->json(['msg'=>'success']);
        }
    }
    public function deleteprodi(Request $r){
       try {
        prodi::where('id','=',$r->id)->delete();
        return response()->json(['msg'=>'success']);

       } catch (\Throwable $th) {
          return response()->json(['msg'=>$th]);
       }
    }
    public function prodi(){
        $t=prodi::orderBy('id','desc')->get();
        return response()->json($t);
    }
    public function dashboard(){
        $g =User::select(\DB::raw('DATE(created_at) as date'), \DB::raw('count(*) as totals'))
        ->groupBy('date')
        ->get();
        return  $g;
    }
    public function totals(){
       $t= User::count();
       $y = User::whereNotNull([
            'namalengkap',
            'nisn',
            'tmplahir',
            'tgllahir',
            'agama',
            'jeniskelamin',
            'asalsekolah',
            'alamat',
            'no_hp',
            'upload_kk',
            'akte',
            'prod',
            'prod1',
        ])->count();
        return response()->json([
            'total'=>$t,
            'totalhas'=>$y
        ]);

    }
    public function usrc(Request $r){
        if (Admin::where('token','=',$r->token)->exists()) {
            $t = spas::orderBy('id','desc')->get();
            return response()->json($t);

        }else{
            return response()->json([
                'msg'=>'unauth',

            ],401);

        }
    }
}
