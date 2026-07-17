<?php

declare(strict_types=1);

namespace Tests;

use Parroquia\Support\Config;
use Parroquia\Support\Env;
use Parroquia\Support\Lang;
use Parroquia\Support\Vite;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected static bool $booted = false;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        if (self::$booted) {
            return;
        }

        $base = dirname(__DIR__);
        Env::load($base);
        Config::load($base.'/config');
        Lang::setLocale('es');
        Lang::load($base.'/lang');
        Vite::load($base.'/public/build/.vite/manifest.json');

        self::$booted = true;
    }
}
