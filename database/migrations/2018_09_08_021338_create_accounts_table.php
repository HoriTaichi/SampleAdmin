<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /**
     * accountsテーブル作成
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('account_id')->comment('アカウントID');
            $table->string('role', 2)->nullable()->comment('権限：10:確認用、20:広告主、30:代理店、40:媒体社、50:管理者');
            $table->tinyInteger('status')->default(1)->comment('ステータス：1: 稼働中、2: 停止中、3: 審査中、99:削除');
            $table->string('login_id')->unique()->comment('ログインID');
            $table->string('account_name',64)->nullable()->comment('アカウント名');
            $table->string('password_hash', 128)->nullable()->comment('パスワード');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON update CURRENT_TIMESTAMP'));
        });
        DB::table('accounts')->insert([
            'role' => '50',
            'status' => 1,
            'login_id' => 'thori0802@gmail.com',
            'account_name' => '堀',
            'password_hash' => password_hash('password', PASSWORD_BCRYPT)
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
