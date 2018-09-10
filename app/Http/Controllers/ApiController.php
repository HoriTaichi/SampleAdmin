<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{

    public function __construct()
    {
        // 認証が必要
        $this->middleware('auth');
    }


    /**
     * バリデーションエラーの場合はこのメソッドが呼ばれる
     * @param $validator
     * @return mixed
     */
    protected function responseInvalidation($validator){
        $invalidParams = [];
        $errors = $validator->errors();

        $reason = [];
        // 理由情報整理
        foreach($errors->getMessages() as $key => $message){
            if(preg_match('/¥.[^.]*$/', $key)){
                $key = preg_replace('/¥.[^.]*$/', '', $key);
            }
            $reason[$key][] = $message[0];
        }
        // 返却用情報設定
        foreach ($reason as $key => $message_list){
            $invalidParams[] = [
              'name' => $key,
              'reason' => $message_list,
            ];
        }
        return Response::json($invalidParams, 400);
    }

}
