<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
// Add this line
use LaravelBook\Ardent\Ardent;

class User extends Ardent implements UserInterface, RemindableInterface {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    protected $fillable = array('username', 'email');

    protected $guarded = array('id', 'password');

    // password_confirmation이 실제 필드에 있는것이 아님. 비밀번호 확인 역활을 하는 부분임.
    // 그래서 model에 해당 부분 추가 해줘야함.
    public $autoPurgeRedundantAttributes = true;

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
            return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
            return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
            return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
            $this->remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
            return 'remember_token';
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
            return $this->email;
    }

    /**
     * Ardent validation rules
     * Ardent 필드 검사 룰
     */
    public static $rules = array(
        'username' => 'required|between:4,16',
        'email' => 'required|email',
        'password' => 'required|alpha_num|min:8|confirmed',
        'password_confirmation' => 'required|alpha_num|min:8',
    );

    /**
     * Factory
     */
    public static $factory = array(
        'username' => 'string',
        'email' => 'email',
        'password' => 'password',
        'password_confirmation' => 'password'
    );

    /**
     * Post relationship
     * Post 관계설정.
    */
    public function posts()
    {
        return $this->hasMany('Post');
    }

    /**
     * User following relationship
     * 팔로잉 관계.
     */
   public function follow()
   {
        return $this->belongsToMany('User', 'user_follows', 'user_id', 'follow_id');
   }

   /**
    * User followers relationship
    * 팔로워 관계
    */
   public function followers()
   {
        return $this->belongsToMany('User', 'user_follows', 'follow_id', 'user_id');
   }

   /**
    * Clique relationship
    */
   public function clique(){
        return $this->belongsToMany('Clique');
   }

}
