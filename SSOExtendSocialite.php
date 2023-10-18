<?php

/**
 * User: Katzen48
 * Date: 10/18/2023
 * Time: 4:08 PM
 */

namespace Katzen48\Socialite\SSO;

use SocialiteProviders\Manager\SocialiteWasCalled;

class SSOExtendSocialite
{
    /**
     * Register the provider.
     *
     * @param  \SocialiteProviders\Manager\SocialiteWasCalled  $socialiteWasCalled
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite('sso', Provider::class);
    }
}