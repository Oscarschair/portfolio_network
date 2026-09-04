<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Socialite;


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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * ログイン成功時の処理（前回ログイン方法をCookieに保存）
     */
    protected function authenticated(Request $request, $user)
    {
        Cookie::queue('last_login_method', 'email', 60 * 24 * 365, null, null, false, false);
    }
    
    public function redirectToGoogle()
    {
        // Google へのリダイレクト
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            // Google 認証後の処理
            $gUser = Socialite::driver('google')->stateless()->user();

            if (!$gUser || empty($gUser->getEmail())) {
                return redirect()->route('login')->with('error', 'Googleアカウントのメールアドレスを取得できませんでした。');
            }

            // email が合致するユーザーを取得
            $user = User::where('email', $gUser->getEmail())->first();

            // 未登録の場合は自動登録
            if ($user === null) {
                $user = $this->createUserByGoogle($gUser);
            } else {
                // すでに登録済みでメール未認証の場合は、Google認証済みとして認証日時に更新
                if ($user->email_verified_at === null) {
                    $user->email_verified_at = now();
                    $user->save();
                }
            }

            // ログイン処理（ログイン状態を保持）
            \Auth::login($user, true);

            // 前回ログイン方法をCookieに保存してリダイレクト
            return redirect('/')->withCookie(cookie('last_login_method', 'google', 60 * 24 * 365, null, null, false, false));
        } catch (\Exception $e) {
            \Log::error('Google OAuth Login Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('login')->with('error', 'Googleログインに失敗しました。もう一度お試しください。');
        }
    }

    public function createUserByGoogle($gUser)
    {
        $name = $gUser->getName() ?: explode('@', $gUser->getEmail())[0];

        $user = User::create([
            'name'              => $name,
            'email'             => $gUser->getEmail(),
            'password'          => \Hash::make(uniqid('g_', true) . rand(10000, 99999)),
            'email_verified_at' => now(),
        ]);

        return $user;
    }

    public function redirectToFacebook()
    {
        // Facebook へのリダイレクト
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        // Facebook 認証後の処理
        $gUser = Socialite::driver('facebook')->user();

        dd($user); // Facebookから取得した情報を表示

        // // email が合致するユーザーを取得
        // $user = User::where('email', $gUser->email)->first();
        // // 見つからなければ新しくユーザーを作成
        // if ($user == null) {
        //     $user = $this->createUserByGoogle($gUser);

	    // DB::table('users')
        //     ->where('id', $user->id)
        //     ->update(['email_verified_at' => DB::raw('NOW()')]);
        // }
        // // ログイン処理
        // \Auth::login($user, true);


         return redirect('/');
    }


}
