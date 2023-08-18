<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Orden;
use App\Models\Usuario;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

      /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
			session()->put('error', 'error');
            return redirect()->back();
		}
        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){			
			session()->put('response', 'true');
			Auth::login($existingUser);            
        } else {
            // create a new user
            $newUser                  = new User;
            $newUser->name            = $user->name;
            $newUser->email           = $user->email;  
            $newUser->password = $user->email;                                  
			$newUser->save();

            $usuario = new Usuario();
        	$usuario->user_id = $newUser->id;        	
			$usuario->img = $user->avatar;
            $usuario->medico_id = 1;
            $usuario->save();

			session()->put('response', 'true');
			Auth::login($newUser);			
		}		
            $ordenes = Orden::all();	
			return view('dashboard', ['ordenes' => $ordenes])->with('login', 'true');
		}

        public function dashboard(){
            $ordenes = Orden::all();
            return view('dashboard', ['ordenes' => $ordenes]);
        }
}
