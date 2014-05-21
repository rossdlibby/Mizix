<?php namespace Cribbb\Services\Validators;

class User extends Validator {
    public static $rules = array(
        "save" => array(
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ),
        "create" => array(
            'username' => 'unique:users',
            'email' => 'unique:users',
            'password' => 'confirmed',
            'password_confirm' => 'min:8'
        ),
        "update" => array()
    );
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

