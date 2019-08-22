<?php

use \Illuminate\Auth\Events\Registered;
use \Illuminate\Auth\Listeners\SendEmailVerificationNotification;

return [
	Registered::class => [
		SendEmailVerificationNotification::class,
	],
];
