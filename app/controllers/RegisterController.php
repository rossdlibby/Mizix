<?php
use Cribbb\Storage\User\UserRepository as User;

class RegisterController extends BaseController {

    /**
     * User Repository
     */
    protected $user;
    
    public function __construct(User $user) {
        $this->user = $user;
    }
    
    public function index()
    {
        return View::make('register.index');
    }
    
    public function store()
    {
        $email = Input::get('email','');
        
        $isExists = $this->user->findByEmail();
        if($isExists !== null) {
            return Redirect::route('users.index')
            ->with('flash', '이미 가입된 이메일 주소입니다.');
        }
        
        $s = null;
        try {
            $s = $this->user->create(Input::all());
            return Redirect::route('users.index')
            ->with('flash', 'The new user has been created');
        } catch (Exception $ex) {
            
            return Redirect::route('register.index')
            ->withInput()
            ->withErrors($s->errors());
        } 

        
    }
        
}