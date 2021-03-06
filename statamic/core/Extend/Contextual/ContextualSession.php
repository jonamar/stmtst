<?php

namespace Statamic\Extend\Contextual;

use Statamic\Extend\Contextual\ContextualObject;

class ContextualSession extends ContextualObject
{
    /**
     * Save a key to the session
     *
     * @param string $key   Key to save under
     * @param mixed  $data  Data to store
     */
    public function put($key, $data)
    {
        session()->put($this->contextualize($key), $data);
    }

    /**
     * Get a key from the session
     *
     * @param string $key      Key to retrieve
     * @param null   $default  Fallback data if the value doesn't exist
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return session()->get($this->contextualize($key), $default);
    }

    /**
     * Check if a key exists in the flash
     *
     * @param string $key  Key to check
     * @return bool
     */
    public function exists($key)
    {
        return session()->has($this->contextualize($key));
    }
}
