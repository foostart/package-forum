<?php

namespace Foostart\Post;

use URL;
use Route;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use LaravelAcl\Authentication\Classes\Menu\SentryMenuFactory;

class ForumServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {

        //generate context key
//        $this->generateContextKey();

        // load view
        $this->loadViewsFrom(__DIR__ . '/Views', 'package-forum');

        // include view composers
        require __DIR__ . "/composers.php";

        // publish config
        $this->publishConfig();

        // publish lang
        $this->publishLang();

        // publish views
        //$this->publishViews();

        // publish assets
        $this->publishAssets();

        // public migrations
        $this->publishMigrations();

        // public seeders
        $this->publishSeeders();

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__ . '/routes.php';
    }

    /**
     * Public config to system
     * @source: vendor/foostart/package-forum/config
     * @destination: config/
     */
    protected function publishConfig()
    {
        $this->publishes([
            __DIR__ . '/config/package-forum.php' => config_path('package-forum.php'),
        ], 'config');
    }

    /**
     * Public language to system
     * @source: vendor/foostart/package-forum/lang
     * @destination: resources/lang
     */
    protected function publishLang()
    {
        $this->publishes([
            __DIR__ . '/lang' => base_path('resources/lang'),
        ]);
    }

    /**
     * Public view to system
     * @source: vendor/foostart/package-forum/Views
     * @destination: resources/views/vendor/package-forum
     */
    protected function publishViews()
    {

        $this->publishes([
            __DIR__ . '/Views' => base_path('resources/views/vendor/package-forum'),
        ]);
    }

    protected function publishAssets()
    {
        $this->publishes([
            __DIR__ . '/public' => public_path('packages/foostart/package-forum'),
        ]);
    }

    /**
     * Publish migrations
     * @source: foostart/package-forum/database/migrations
     * @destination: database/migrations
     */
    protected function publishMigrations()
    {
        $this->publishes([
            __DIR__ . '/database/migrations' => $this->app->databasePath() . '/migrations',
        ]);
    }

    /**
     * Publish seeders
     * @source: foostart/package-forum/database/seeders
     * @destination: database/seeders
     */
    protected function publishSeeders()
    {
        $this->publishes([
            __DIR__ . '/database/seeders' => $this->app->databasePath() . '/seeders',
        ]);
    }

}
