<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Account;
use Illuminate\Support\Facades\Validator;
use App\Utils\StringUtil;
use DB;


class AccountsApiController extends ApiController
{
    /**
     * アカウントリスト取得
     *
     * @param Request $request
     * @return array|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'role' => [''],
                'status' => ['']
            ]
        );
        if($validator->fails()){
            return $this->responseInvalidation($validator);
        }

        $account = Account::query();
        if(StringUtil::isNotEmpty($request->input('role'))){
            $account->where('role', '=', $request->input('role'));
        }
        if(StringUtil::isNotEmpty($request->input('status'))){
            $account->where('status', '=', $request->input('status'));
        }

        return $account->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'accountName' => ['required'],
                'loginId' => ['required'],
                'password' => ['required'],
                'role' => ['required'],
                'status' => ['required'],
            ]
        );
        if($validator->fails()){
            return $this->responseInvalidation($validator);
        }

        // 登録
        DB::table('accounts')->insert([
            'role' => $request->input('role'),
            'status' => $request->input('status'),
            'login_id' => $request->input('loginId'),
            'account_name' => $request->input('accountName'),
            'password_hash' => password_hash($request->input('password'), PASSWORD_BCRYPT)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
