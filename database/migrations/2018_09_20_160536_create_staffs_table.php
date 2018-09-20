<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->increments('staff_id')->comment('社員ID');
            $table->tinyInteger('status')->default(1)->comment('ステータス：1: 稼働中、99:削除');
            $table->string('staff_name',64)->nullable()->comment('社員名');
            $table->string('staff_name_ruby',64)->nullable()->comment('社員名(ふりがな)');
            $table->string('slack_id',64)->nullable()->comment('slackID');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON update CURRENT_TIMESTAMP'));
        });
        DB::table('staffs')->insert([
            'staff_id' => '1',
            'status' => 1,
            'staff_name' => '社員一号',
            'staff_name_ruby' => 'しゃいんいちごう',
            'slack_id' => ''
        ]);
        DB::table('staffs')->insert([
            'staff_id' => '2',
            'status' => 1,
            'staff_name' => '社員二号',
            'staff_name_ruby' => 'しゃいんにごう',
            'slack_id' => ''
        ]);
        DB::table('staffs')->insert([
            'staff_id' => '3',
            'status' => 1,
            'staff_name' => '社員三号',
            'staff_name_ruby' => 'しゃいんさんごう',
            'slack_id' => ''
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staffs');
    }
}
