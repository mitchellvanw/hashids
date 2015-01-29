<?php namespace Mitch\Hashids;

use Hashids\Hashids;
use Illuminate\Support\ServiceProvider;

class HashidsServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$configPath = __DIR__ . '/../../config/hashids.php';
		$this->mergeConfigFrom($configPath, 'hashids');
		$this->publishes([$configPath => config_path('hashids.php')]);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */

	public function register()
	{
		$this->registerHashids();
	}

	protected function registerHashids()
	{
		$this->app->bind('Hashids\Hashids', function () {
			return new Hashids(
				config('app.key'),
				config('hashids.length'),
				config('hashids.alphabet')
			);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('Hashids\Hashids');
	}
}
