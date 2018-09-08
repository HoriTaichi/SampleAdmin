<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * 認証成功した時に遷移するリダイレクト先
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * 認証する際、loginIdフィールドを認証に利用
     *
     * @return string
     */
    public function username()
    {
        return 'login_id';
    }

    /**
     * ログイン
     * @return string
     */
    public function login()
    {
        $login_id = request('login_id');
        $password = request('password');

        // TODO: 全ロール対応の管理画面にする
        if (Auth::attempt(['login_id' => $login_id, 'password' => $password, 'role' => 50])) {
            return redirect()->intended('/');
        } else {
            throw ValidationException::withMessages([
                $this->username() => [trans('auth.failed')],
            ]);
        }
    }

    /**
     * ログアウト
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->intended('login');

    }
}
