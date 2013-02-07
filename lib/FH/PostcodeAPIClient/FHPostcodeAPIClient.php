<?php

namespace FH\PostcodeAPIClient;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;

/**
 * Client library for postcodeapi.nu web service.
 *
 * @author Joost Farla <joost.farla@freshheads.com>
 */
class FHPostcodeAPIClient extends Client
{
    const DEFAULT_BASE_URL = '{scheme}://api.postcodeapi.nu/';

    /**
     * Factory method to create a new MyServiceClient
     *
     * The following array keys and values are available options:
     * - base_url: Base URL of web service
     * - scheme:   URI scheme: http or https
     * - api_key:  API key
     *
     * @param array|Collection $config Configuration data
     * @return self
     */
    static public function factory($config = array())
    {
        $default = array(
            'base_url' => self::DEFAULT_BASE_URL,
            'scheme'   => 'http'
        );

        $required = array('base_url', 'scheme', 'api_key');

        $config = Collection::fromConfig($config, $default, $required);
        $client = new self($config->get('base_url'), $config);

        return $client;
    }

    /**
     * {@inheritdoc}
     */
    public function createRequest($method = RequestInterface::GET, $uri = null, $headers = null, $body = null)
    {
        $request = parent::createRequest($method, $uri, $headers, $body);
        $request->addHeader('Api-Key', $this->getConfig('api_key'));

        return $request;
    }
}