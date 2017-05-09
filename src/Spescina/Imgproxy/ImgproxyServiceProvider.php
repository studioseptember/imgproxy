<?php namespace Spescina\Imgproxy;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Spescina\Imgproxy\Imgproxy;

class ImgproxyServiceProvider extends ServiceProvider {

	/**
         * Indicates if loading of the provider is deferred.
         *
         * @var bool
         */
        protected $defer = false;

        /**
         * Bootstrap the application events.
         *
         * @return void
         */
        public function boot()
        {
	        $this->publishes([
		        dirname(dirname(__DIR__)).'/config/config.php' => config_path('imgproxy.php')
	        ], 'config');

	        $this->publishes([
		        dirname(dirname(dirname(__DIR__))).'/public' => public_path('packages/spescina/imgproxy'),
	        ], 'public');

	        $this->publishes([
		        dirname(dirname(dirname(__DIR__))).'/storage/app/cache/imgproxy' => storage_path('app/cache/imgproxy'),
	        ], 'storage');

        }

        /**
         * Register the service provider.
         *
         * @return void
         */
        public function register()
        {
                $this->registerServices();

                $this->registerAlias();
        }

        /**
         * Get the services provided by the provider.
         *
         * @return array
         */
        public function provides()
        {
                return array(
                    'imgproxy',
                );
        }

        private function registerAlias()
        {
                AliasLoader::getInstance()->alias('ImgProxy', 'Spescina\Imgproxy\Facades\ImgProxy');
        }

        private function registerServices()
        {
            $this->app->singleton('imgproxy', function($app) {
                return new Imgproxy();
            });
        }

}
