<?php

use Ethereal\Foundation\Application;

if (!function_exists('env')) {
    function env(string $name, $default = null)
    {
        return $_ENV[$name] ?? getenv($name) ?: $default;
    }
}

if (!function_exists('app')) {
    function app(string $accessor = null)
    {
        if (!key_exists('app', $GLOBALS)) {
            throw new RuntimeException('Undefined variable [app] in global scope');
        }

        if ($accessor) {
            return $GLOBALS['app']->get($accessor);
        }

        if (!$GLOBALS['app'] instanceof Application) {
            throw new TypeError(
                sprintf('app() must be return the type of %s, %s given', Application::class, gettype($GLOBALS['app']))
            );
        }

        return $GLOBALS['app'];
    }
}

if (!function_exists('db')) {
    function db(): PDO
    {
        if (!app()->has('database')) {
            $dsn = 'mysql:host=localhost;port=3306;dbname=achievement crm';
            $user = 'root';
            $password = '';

            app()->bind('database', new PDO($dsn, $user, $password));
        }

        return app('database');
    }
}

if (!function_exists('dump')) {
    /**
     * @return void
     */
    function dump($var, ...$vars)
    {
        if (key_exists('argc', $_SERVER)) {
            var_dump($var, ...$vars);
            return;
        }
        echo '<pre>', var_dump($var, ...$vars), '</pre>';
    }
}

if (!function_exists('dd')) {
    function dd($var, ...$vars)
    {
        return dump($var, ...$vars) | die(0);
    }
}