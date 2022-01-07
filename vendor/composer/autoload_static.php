<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4f02abb7d5f73f584434438a4f02d544
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4f02abb7d5f73f584434438a4f02d544::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4f02abb7d5f73f584434438a4f02d544::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4f02abb7d5f73f584434438a4f02d544::$classMap;

        }, null, ClassLoader::class);
    }
}
