<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['ipaymu'] = [
    'va'         => getenv('IPAYMU_VA') ?: '',
    'api_key'    => getenv('IPAYMU_API_KEY') ?: '',
    'is_sandbox' => getenv('IPAYMU_IS_SANDBOX') !== 'false',
];
