<?php
Route::get('/', ['as' => 'welcome',
	'uses' => 'WelcomeController@welcome']);
