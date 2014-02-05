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
		$this->package('mitch/hashids');
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
		$this->app->bind('Hashids\Hashids', function ($app) {
			return new Hashids(
				$app['config']['app.key'],
				$app['config']['hashids::length'],
				$app['config']['hashids::alphabet']
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
