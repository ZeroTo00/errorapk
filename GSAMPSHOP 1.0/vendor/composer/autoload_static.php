<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit34942b4cfa21ec231632bebfa5d0cb6a
{
    public static $classMap = array (
        'AltoRouter' => __DIR__ . '/..' . '/altorouter/altorouter/AltoRouter.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit34942b4cfa21ec231632bebfa5d0cb6a::$classMap;

        }, null, ClassLoader::class);
    }
}
