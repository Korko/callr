<?php

namespace Korko\Callr;

use CALLR\API\Client as Callr;
use CALLR\API\Authentication\LoginPasswordAuth as CallrAuth;

/**
 * Callr Client for Laravel
 *
 * @author Jeremy Lemesle <jeremy.lemesle@korko.fr>
 */
class CallrClient
{
    const ALERTING = 'ALERTING';
    const MARKETING = 'MARKETING';

    protected $api;
    protected $sender;

    public function __construct($username, $password, $alias = '', $sender = '')
    {
        $this->api = new Callr();

        $auth = new CallrAuth($username, $password);
        if (!empty($alias)) {
            $auth = $auth->logAs('User', $alias);
        }

        $this->api->setAuth($auth);

        $this->sender = $sender;
    }

    public function getApi()
    {
        return $this->api;
    }

    public function message($to, $text, $mode = CallrClient::ALERTING)
    {
        $options = new \stdClass;
        $options->nature = $mode;

        return $this->api->call('sms.send', [$this->sender, $to, $text, $options]);
    }
}


