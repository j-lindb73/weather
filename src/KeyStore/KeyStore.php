<?php

namespace Lefty\KeyStore;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */


class KeyStore implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $keys = [];

    public function setKeys($keys)
    {
        $this->keys = $keys;
    }

    public function getKey($key)
    {
        // var_dump($this->keys);
        // var_dump($key);
        return $this->keys[$key] ?? "default key is missing";
    }
}
