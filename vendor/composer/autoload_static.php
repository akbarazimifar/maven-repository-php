<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit26d03c409ba72e90d7272a282aec6efa
{
    public static $files = array (
        'a2aaed1207788c936e169e8afdecd962' => __DIR__ . '/../..' . '/src/Support/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Repo\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Repo\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit26d03c409ba72e90d7272a282aec6efa::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit26d03c409ba72e90d7272a282aec6efa::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit26d03c409ba72e90d7272a282aec6efa::$classMap;

        }, null, ClassLoader::class);
    }
}
