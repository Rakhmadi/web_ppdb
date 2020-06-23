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
use Illuminate\Support\Facades\File;

class Usermanager extends Controller
{
    public function login(Request $r){
        $v=Validator::make($r->all(),[
            'name'=>'required',
            'password'=>'required'
        ]);
        if ($v->fails()) {
           return response()->json($v->errors());
        } else {
           if ( Auth::attempt(['name' => $r->name, 'password' => $r->password])) {
             Return response()->json([
                 'token'=>Auth::user()->token
             ]);
           } else {
            return response()->json([
                'msg'=>'Error'
            ]);
           }
        }
    }
    public function cekuser(Request $r){
        $fr=User::where('token','=',$r->token)->exists();
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
    public function lengkapidata(Request $r){
        $ri=User::where('token',$r->token)->first();
        if ($r->hasFile('upload_kk')) {


            $kk = mt_rand('1000000','9999999').'.'.$r->upload_kk->extension();

            $r->upload_kk->move(public_path('image'), $kk);
         } else {
             $kk=$ri->upload_kk;

         }
         if ($r->hasFile('akte')) {
            $akte = mt_rand('1000000','9999999').'.'.$r->akte->extension();

            $r->akte->move(public_path('image'), $akte);
         } else {
            $akte=$ri->akte;
         }

              User::where('token',$r->token)->update([
                'namalengkap'=>$r->namalengkap,
                'nisn'=>$r->nisn,
                'tmplahir'=>$r->tmplahir,
                'tgllahir'=>$r->tgllahir,
                'agama'=>$r->agama,
                'jeniskelamin'=>$r->jeniskelamin,
                'asalsekolah'=>$r->asalsekolah,
                'alamat'=>$r->alamat,
                'no_hp'=>$r->no_hp,
                'upload_kk'=>$kk,
                'akte'=>$akte,
                'prod'=>$r->prod,
                'prod1'=>$r->prod1
              ]);
              return response()->json(['msg'=>'success']);


    }
    public function rich(Request $r){
        $y=User::where('token',$r->token)->first();
        return response()->json($y);


    }
    public function checkdata(Request $r){
       $tyyy= User::where('token','=',$r->token)->whereNotNull([
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
        ])->exists();
        return response()->json([
           'msg'=>$tyyy
        ]);
    }
    public function logout(Request $r){
        User::where('token','=',$r->token)->update([
            'token'=>bcrypt(Carbon::now())
        ]);
        return response()->json([
            'msg'=>'success'
        ]);
    }
    public function cetak($noreg){
        $t=User::where('noreg','=',$noreg)->first();
        return response()->json($t);
    }
    public function cetak2(Request $r){
        $t=User::where('token','=',$r->token)->first();
        return response()->json($t);
    }
}
