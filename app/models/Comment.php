<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Comment extends Eloquent {
 
    public function commentable()
    {
        return $this->morphTo();
    }
 
}
