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
		$this->publishes([
			__DIR__.'/../../config/config.php' => config_path('hashids.php'),
		]);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */

	public function register()
	{
		$this->mergeConfigFrom(__DIR__.'/../../config/config.php', 'hashids');

		$this->registerHashids();
	}

	protected function registerHashids()
	{
		$this->app->bind('Hashids\Hashids', function ($app) {
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
