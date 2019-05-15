<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Auth;
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
     * Auth guard
     *
     * @var
     */
    protected $auth;
     
     /**
     * lockoutTime
     *
     * @var
     */
    protected $lockoutTime;
     
    /**
     * maxLoginAttempts
     *
     * @var
     */
    protected $maxLoginAttempts;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '';
    
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
        $this->validateLogin($request);

       /* If the class is using the ThrottlesLogins trait, we can automatically throttle
        the login attempts for this application. We'll key this by the username and
        the IP address of the client making these requests into this application. */

        /*if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }*/
        
      /**
       * Create a new controller instance.
       *
       * LoginController constructor.
       * @param Guard $auth
       */
        function __construct(Guard $auth)
      {
          $this->middleware('guest', ['except' => 'logout']);
          $this->auth = $auth;
          $this->lockoutTime  = 1;    //lockout for 1 minute (value is in minutes)
          $this->maxLoginAttempts = 3;    //lockout after 3 attempts
      }
      
      /**
       * Determine if the user has too many failed login attempts.
       *
       * @param  \Illuminate\Http\Request  $request
       * @return bool
       */
       function hasTooManyLoginAttempts(Request $request)
      {
          return $this->limiter()->tooManyAttempts(
              $this->throttleKey($request), $this->maxLoginAttempts, $this->lockoutTime
          );
      }

        if ($this->attemptLogin($request)) {
           //to sure admin or not
              if(Auth::user()->role == 1){
                return redirect('/administration/dashboard');
                  }
                  elseif(Auth::user()->role == 0)
                      {
                        return redirect('/employee_dashboard');
                      }
                      else
                      {
                        return redirect('/login');
                      }
           // return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}
