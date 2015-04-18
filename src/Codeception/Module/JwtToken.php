<?php

namespace Codeception\Module;

use Codeception\Module;
use JWT;

/**
 * Class JwtToken module for usage jwt auth
 */
class JwtToken extends Module
{

    protected $config = array(
        'life_time'   => 86400,
        'secret_key'  => 'VERY_SECRET_SIGNING_KEY',
        'header_name' => 'X-NH-Access-Token'
    );

    /**
     * Add header for authentificated
     *
     * @param array  $payload Params for array
     * @param string $key     secret key for encode token
     *
     * @throws \Codeception\Exception\Module
     */
    public function amJWTAuthenticated($payload, $key = null)
    {
        $payload['exp'] = time() + $this->config['life_time'];

        if (null === $key) {
            $key = $this->config['secret_key'];
        }

        $this->getModule('PhpBrowser')->setHeader($this->config['header_name'], JWT::encode($payload, $key));
    }
}
