<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['ipaymu'] = [
    'va'         => getenv('IPAYMU_VA') ?: '0000005136510899',
    'api_key'    => getenv('IPAYMU_API_KEY') ?: 'CHANGE_ME_IPAYMU_API_KEY',
    'is_sandbox' => (bool) (getenv('IPAYMU_IS_SANDBOX') ?: true),
];
