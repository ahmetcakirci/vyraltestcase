<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Verify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class VerifyController extends Controller
{
    public function smsSend(Request $request){
        $userId = $request->user()->id;
        $user=User::where('id','=',$userId)->first();

        $code=strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 8));

        $verify = Verify::create([
            'user_id' => $userId,
            'code' =>$code,
            'type' => 'sms',
            'expired_date'=>date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +2 minutes"))
        ]);

        Log::info(sprintf("Sayın %s %s , %s cep telefonu numaralı onay kodunuz :%s",$user->name,$user->surname,$user->cep_number,$code));
        return response(['success'=>true,'message' => sprintf('Sms onay kodunuz %s cep telefonunuza gönderilmiştir',$user->cep_number)]);
    }

    public function smsVerify(Request $request){
        $data = $request->only('verify_code');
        $validator = Validator::make($data, [
            'verify_code' => 'required|string|min:8|max:8'
        ]);

        if ($validator->fails()) {
            return response()->json(['success'=>false,'error' => $validator->messages()], 200);
        }

        $userId = $request->user()->id;
        $userVerify=Verify::where(['user_id'=>$userId,'type'=>'sms'])->latest()->first();

         if(is_null($userVerify) || $userVerify->expired_date<now()){
            return response()->json(['success'=>false,'error' => 'Güvenlik kod süresi geçmiştir. Yeniden güvenlik kodu gönderiniz'], 200);
        }else if($userVerify->code!=$request->verify_code){
            return response()->json(['success'=>false,'error' => 'Güvenlik kodunuz yanlıştır.'], 200);
        }

        $user=User::find($userId);
        $user->sms_verified_at=now();
        $user->save();

        return response(['success'=>true,'message' => 'Cep telefonunuz doğrulanmıştır']);
    }

    public function emailSend(Request $request){
        $userId = $request->user()->id;
        $user=User::where('id','=',$userId)->first();

        $code=strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 8));

        $verify = Verify::create([
            'user_id' => $userId,
            'code' =>$code,
            'type' => 'email',
            'expired_date'=>date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +2 minutes"))
        ]);

        Log::info(sprintf("Sayın %s %s , %s email adresinize onay kodunuz :%s",$user->name,$user->surname,$user->email,$code));
        return response(['success'=>true,'message' => sprintf('Email onay kodunuz %s email adresinize gönderilmiştir',$user->email)]);
    }

    public function emailVerify(Request $request){
        $data = $request->only('verify_code');
        $validator = Validator::make($data, [
            'verify_code' => 'required|string|min:8|max:8'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $userId = $request->user()->id;
        $userVerify=Verify::where(['user_id'=>$userId,'type'=>'email'])->latest()->first();


        if(is_null($userVerify) || $userVerify->expired_date<now()){
            return response()->json(['success'=>false,'error' => 'Güvenlik kod süresi geçmiştir. Yeniden güvenlik kodu gönderiniz'], 200);
        }else if($userVerify->code!=$request->verify_code){
            return response()->json(['success'=>false,'error' => 'Güvenlik kodunuz yanlıştır.'], 200);
        }

        $user=User::find($userId);
        $user->email_verified_at=now();
        $user->save();

        return response(['success'=>true,'message' => 'Email adresiniz doğrulanmıştır']);
    }
}
