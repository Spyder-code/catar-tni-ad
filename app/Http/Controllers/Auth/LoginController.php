<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pokok;
use App\Models\Setting;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password'])))
        {
            return redirect()->route('home');
        }else{
            return redirect()->route('login.admin')
                ->with('danger','Email or Username And Password Are Wrong.');
        }
    }

    public function loginCalon(Request $request)
    {
        $credentials = $request->validate([
            'no_animo' => 'required|string|max:255',
            'tgl_lahir' => 'required|date_format:Y-m-d',
        ]);

        $tgl = date('d-m-Y', strtotime($credentials['tgl_lahir']));
        $user = Pokok::where('no_animo', trim($credentials['no_animo']))
            ->where('tgl_lahir', $tgl)->first();
        if ($user === null) {
            return redirect()->route('login')
                ->with('danger', 'No Animo dan tanggal lahir tidak cocok dengan data kami. Silakan menghubungi admin!');
        }

        Auth::guard('calon')->login($user);

        return redirect()->route('calon.form');
    }

    public function takeUser(Request $request)
    {
        $credentials = $request->validate([
            'no_animo' => 'required|string|max:255',
        ]);

        $data = Pokok::where('no_animo', trim($credentials['no_animo']))->get();
        if ($data->isEmpty()) {
            return back()->withInput()->with('danger', 'No Animo tidak ditemukan dalam data kami.');
        }

        $setting = Setting::first();

        return view('auth.takeUser', compact('data', 'setting'));
    }

}
