<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Validator;
use App\Utils\DateUtil;
use DB;


class ReportMediaForTagFailApiController extends ApiController
{
    /**
     * レポートメディア（タグ落ち確認用)
     *
     * @param Request $request
     * @return array|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'date' => [''],
            ]
        );
        if($validator->fails()){
            return $this->responseInvalidation($validator);
        }

        // 月次の場合
        $startDate = DateUtil::getStartDateForMonth($request->input('date'));
        $endDate = DateUtil::getEndDateForMonth($request->input('date'));

        // 日付リスト　
        $allDateList = DateUtil::getAllDateListForMonth($startDate, $endDate);


        // 取得したデータ(MySQLでとったという定)
        $reports = [
            0 => [
                'widget_id' => 1,
                'widget_name' => 'ウィジェット１',
                'staff_id' => 1,
                'status' => 1,
                'imp' => 10,
                'click' => 5,
                'cv' => 5,
                'inview' => 3,
                'target_year' => 2018,
                'target_month' => 1,
            ],
            1 => [
                'widget_id' => 1,
                'widget_name' => 'ウィジェット１',
                'staff_id' => 1,
                'status' => 1,
                'imp' => 1,
                'click' => 0,
                'cv' => 0,
                'inview' => 0,
                'target_year' => 2018,
                'target_month' => 2,
            ],
            2 => [
                'widget_id' => 7,
                'widget_name' => 'ウィジェット7',
                'staff_id' => 1,
                'status' => 1,
                'imp' => 1,
                'click' => 0,
                'cv' => 0,
                'inview' => 0,
                'target_year' => 2018,
                'target_month' => 2,
            ]
        ];

        //---------------------
        // date部作成
        //---------------------

        // widget_idのリスト取得
        $widget_id_list = array_values(array_unique(array_column($reports, 'widget_id')));



        // 初期化
        $logs = [];
        foreach($allDateList as $currentDate){
            $logs[$currentDate['date']] = [
                'imp' => 0,
                'click' => 0,
                'cv' => 0,
                'inview' => 0
            ];
        }


        $result = [];
        foreach($widget_id_list as $widget_id){

            $datas = [
                'logs' => $logs
            ];

            // 選択しているwidget_idのレポートデータを抽出
            $filtered_lists = array_filter($reports, function($row) use ($widget_id){
                return $row['widget_id'] === $widget_id;
            });

            // データ
            foreach($filtered_lists as $filtered_list){
                $currentDate = sprintf('%04d-%02d', $filtered_list['target_year'], $filtered_list['target_month']);
                $datas['logs'][$currentDate]['imp'] = $filtered_list['imp'];
                $datas['logs'][$currentDate]['click'] = $filtered_list['click'];
                $datas['logs'][$currentDate]['cv'] = $filtered_list['cv'];
                $datas['logs'][$currentDate]['inview'] = $filtered_list['inview'];
                $datas['widget_id'] = $widget_id;
                $datas['widget_name'] = $filtered_list['widget_name'];
                $datas['staff_id'] = $filtered_list['staff_id'];
                $datas['status'] = $filtered_list['status'];
            }
            $result[] = $datas;
        }

        return [
            'dateLists' => $allDateList,
            'details' => $result
        ];
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
