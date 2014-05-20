<?php

/* 
 * Post Class
 */
class Post extends Eloquent {
 
  protected $fillable = array('body');
 
  public function user()
  {
    return $this->belongsTo('User');
  }
   
}