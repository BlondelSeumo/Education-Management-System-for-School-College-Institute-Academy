<?php

return array(

	/* Auth key from msg91  (required) */
	'auth_key' => env('MSG91_KEY'),

	/* Default sender id (required) */
	//'sender_id' => env('MSG91_SENDER_ID', 'CLPCBS'),
	'sender_id' => env('MSG91_SENDER_ID'),

	/* Default route, 1 for promotional, 4 for transactional id (required) */
	'route' => env('MSG91_ROUTE'),

	/* Country option, 0 for international, 91 for India, 1 for US (optional) */	
	'country' => env('MSG91_COUNTRY'),

	/* Credit limit, if true message will be limted to 1 credit (optional) */
	'limit_credit' => env('MSG91_LIMIT_CREDIT', true),

);