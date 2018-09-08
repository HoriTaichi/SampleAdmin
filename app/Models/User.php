<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * ロール
     */
    const ROLE_VIEW_ONLY = 10;
    const ROLE_ADVERTISER = 20;
    const ROLE_AGENCY = 30;
    const ROLE_MEDIA = 40;
    const ROLE_ADMIN = 50;

    /**
     * ステータス
     */
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;
    const STATUS_DELETE = 99;

    /**
     * accountsテーブルに変更
     * @var string
     */
    protected $table = 'accounts';


    /**
     * プライマリキー
     * @var string
     */
    protected $primaryKey = 'account_id';


    /**
     * 参照禁止項目
     * @var array
     */
    protected $hidden = [
      'password_hash'
    ];


    /**
     * ユーザーの主キーを取得
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'account_id';
    }

    /**
     * 認証時のパスワード（ハッシュ化済）を取得
     * @return mixed|string
     */
    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    /**
     * ※RemenberTokenは使用しない
     * @param string $value
     * @return bool|void
     */
    public function setRememberToken($value)
    {
        return true;
    }

    /**
     * ※RemenberTokenは使用しない
     * @return null|string
     */
    public function getRememberToken()
    {
        return null;
    }
}
