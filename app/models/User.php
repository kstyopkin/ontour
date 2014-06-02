<?php

//use Jenssegers\Mongodb\Model as Eloquent;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Support\Facades\Validator;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

    protected $primaryKey = 'id';

	protected $fillable = array(
        'password', 'email', 'login',
        'first_name', 'last_name', 'sex',
        'location', 'phone', 'photo',
        'confirmation', 'confirmed'
    );

	public $timestamps = false;

    public static $rules = [
        'email'     => 'required | email | unique:users',
        'password'  => 'required | alpha_num | between:6,12 | confirmed',
        'password_confirmation' => 'required | alpha_num | between:6,12'
    ];

    public static $editRules = [
        'email'      => 'required | email',
        'login'      => 'alpha_num',
        'first_name' => 'alpha',
        'last_name'  => 'alpha',
        'location'   => 'alpha_num',
        'phone'      => 'numeric',
        'userfile'   => 'image | mimes:jpeg,bmp,png | max:2048'
    ];

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
     * @param  string $value
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

    public function getPhoto()
    {
        return $this->photo ? 'uploads/user_'.Auth::user()->id.'/'.$this->photo : 'nopic.png';
    }

    public function events()
    {
        return $this->hasMany('Event');
    }

}