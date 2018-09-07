<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit85bbc14db732d067fcdc8f8307a0d260
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Pds\\Skeleton\\' => 13,
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Pds\\Skeleton\\' => 
        array (
            0 => __DIR__ . '/..' . '/pds/skeleton/src',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit85bbc14db732d067fcdc8f8307a0d260::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit85bbc14db732d067fcdc8f8307a0d260::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
