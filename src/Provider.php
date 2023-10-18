<?php
/**
 * User: Katzen48
 * Date: 10/18/2023
 * Time: 4:10 PM
 */

namespace Katzen48\Socialite\SSO;

use GuzzleHttp\RequestOptions;
use SocialiteProviders\Manager\OAuth2\AbstractProvider;
use SocialiteProviders\Manager\OAuth2\User;

class Provider extends AbstractProvider
{
    /**
     * Unique Provider Identifier.
     */
    const IDENTIFIER = 'SSO';

    /**
     * {@inheritdoc}
     */
    protected $scopes = ['user_identify', 'user_email'];

    /**
     * {@inheritdoc}
     */
    protected $scopeSeparator = ' ';

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://sso.katzen48.de/oauth/authorize', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return 'https://sso.katzen48.de/oauth/token';
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get('https://sso.katzen48.de/api/user/', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$token,
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        $data = $user['data'];

        $map = [
            // General User Info
            'id'            => $data['id'],
            'nickname'      => $data['name'],
            'name'          => $data['name'],
        ];

        if(array_key_exists('email', $data))
            $map['email'] = $data['email'];

        return (new User())->setRaw($user['data'])->map($map);
    }
}