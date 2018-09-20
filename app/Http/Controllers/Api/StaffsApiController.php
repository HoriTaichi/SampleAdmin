<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Staff;
use Illuminate\Support\Facades\Validator;
use DB;


class StaffsApiController extends ApiController
{
    /**
     * 社員リスト取得
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
        $staff = Staff::query();
        $staff->where('status', '<>', 99);
        return $staff->get();
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
     * 社員登録
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'staffName' => ['required'],
                'staffNameRuby' => [''],
                'slackId' => [''],
            ]
        );
        if($validator->fails()){
            return $this->responseInvalidation($validator);
        }

        // 登録
        DB::table('staffs')->insert([
            'staff_name' => $request->input('staffName'),
            'staff_name_ruby' => $request->input('staffNameRuby'),
            'slack_id' => $request->input('slackId'),
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
