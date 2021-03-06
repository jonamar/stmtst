<?php

namespace Statamic\Addons\Protect\Protectors;

use Statamic\API\Str;
use Statamic\Exceptions\RedirectException;

class PasswordProtector extends AbstractProtector
{
    /**
     * Whether or not this provides protection.
     *
     * @return bool
     */
    public function providesProtection()
    {
        return array_key_exists('password', $this->scheme)
               && !empty(array_get($this->scheme, 'password.allowed', []));
    }

    /**
     * Provide protection
     *
     * @return void
     */
    public function protect()
    {
        if (! $this->hasPassword()) {
            $this->redirectToPasswordForm();
        }
    }

    public function isValidPassword($password)
    {
        return in_array($password, $this->getAllowedPasswords());
    }

    public function hasPassword()
    {
        return ! empty(array_intersect($this->getUserPasswords(), $this->getAllowedPasswords()));
    }

    protected function getUserPasswords()
    {
        return array_get(
            session()->get('protect.passwords'),
            md5($this->url),
            []
        );
    }

    protected function getAllowedPasswords()
    {
        return array_get($this->scheme, 'password.allowed', []);
    }

    protected function redirectToPasswordForm()
    {
        $e = new RedirectException;

        $e->setUrl($this->getRedirectUrl());

        throw $e;
    }

    protected function getRedirectUrl()
    {
        $default = '/'; // @todo

        $url = array_get($this->scheme, 'password.form_url', $default);

        $url .= '?token=' . $this->generateToken();

        return $url;
    }

    protected function generateToken()
    {
        $token = Str::random(32);

        session()->put("protect.scheme.$token", ['scheme' => $this->scheme, 'url' => $this->url]);

        return $token;
    }
}