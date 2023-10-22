<?php

namespace App\Containers\AppSection\Timses\Providers;

use App\Ship\Parents\Providers\MainServiceProvider as ParentMainServiceProvider;
use Barryvdh\Snappy\Facades\SnappyImage;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Intervention\Image\Facades\Image;

/**
 * The Main Service Provider of this container, it will be automatically registered in the framework.
 */
class MainServiceProvider extends ParentMainServiceProvider
{
    /**
     * Container Service Providers.
     */
    public array $serviceProviders = [
        \Barryvdh\Snappy\ServiceProvider::class,
        \Intervention\Image\ImageServiceProvider::class,
    ];

    /**
     * Container Aliases
     */
    public array $aliases = [
        'PDF' => SnappyPdf::class,
        'SnappyImage' => SnappyImage::class,
        'Image' => Image::class,
    ];

    /**
     * Register anything in the container.
     */
    public function register(): void
    {
        parent::register();

        // $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        // ...
    }
}
