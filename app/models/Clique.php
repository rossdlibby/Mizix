<?php
use LaravelBook\Ardent\Ardent;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Clique extends Ardent {
    /**
     * Properties that can be mass assigned
     *
     * @var array
     */
   protected $fillable = array('name');

    /**
     * Ardent validation rules
     */
    public static $rules = array(
        'name' => 'required',
    );
   
    /**
     * Factory
     */
    public static $factory = array(
        'name' => 'string'
    );
    
    /**
     * User relationship
     */
    public function users(){
        return $this->belongsToMany('User');
    }
   
    /**
     * Post relationship
     */
    public function posts()
    {
        return $this->hasMany('Post');
    }
}

