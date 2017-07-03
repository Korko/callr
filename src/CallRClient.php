<?php

namespace Korko\CallR;

use CALLR\API\Client as CallR;
use CALLR\API\Authentication\LoginPasswordAuth as CallRAuth;

/**
 * CallR Client for Laravel
 *
 * @author Jeremy Lemesle <jeremy.lemesle@korko.fr>
 */
class CallRClient
{
    const ALERTING = 'ALERTING';
    const MARKETING = 'MARKETING';

    protected $api;
    protected $sender;

    public function __construct($username, $password, $alias = '', $sender = '')
    {
        $this->api = new CallR();

        $auth = new CallRAuth($username, $password);
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

    public function message($to, $text, $mode = CallRClient::ALERTING)
    {
        $options = new \stdClass;
        $options->nature = $mode;

        return $this->api->call('sms.send', [$this->sender, $to, $text, $options]);
    }
}


