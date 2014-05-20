<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
            try {
                /*
                $user = new User;
                $user->username = 'philipbrown';
                $user->email = 'phil@ipbrown.com';
                $user->password = 'deadgiveaway';
                $user->password_confirmation = 'deadgiveaway';
                $user->save(); // returns false  
                 */
                // Create a new Post
                $post = new Post(array('body' => 'Yada yada yada'));
                // Grab User 1
                $user = User::find(1);
                // Save the Post
                $user->posts()->save($post);
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
            
            
            return View::make('hello');
	}

}
