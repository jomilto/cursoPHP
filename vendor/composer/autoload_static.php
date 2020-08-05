<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita129d16fb2d0b832e4c2c89fdfcdb42b
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
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita129d16fb2d0b832e4c2c89fdfcdb42b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita129d16fb2d0b832e4c2c89fdfcdb42b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita129d16fb2d0b832e4c2c89fdfcdb42b::$classMap;

        }, null, ClassLoader::class);
    }
}
