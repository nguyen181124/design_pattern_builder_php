<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInita78103fc5c0155c3d1ea706f49e8593f
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInita78103fc5c0155c3d1ea706f49e8593f', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInita78103fc5c0155c3d1ea706f49e8593f', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInita78103fc5c0155c3d1ea706f49e8593f::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}