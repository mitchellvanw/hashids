<?php namespace Mitch\Hashids;

use Hashids\Hashids;
use Illuminate\Support\ServiceProvider;

class HashidsServiceProvider extends ServiceProvider {

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
		$me = $this;

		$this->app->bind('hashids', function ($app) use ($me)
		{
			return new Hashids($me->getSalt(), $me->getLength(), $me->getAlphabet());
		});
	}

	/**
	 * Get the length used for encrypting and decrypting hashes.
	 *
	 * @return string
	 */
	protected function getSalt()
	{
		$salt = $this->app['config']['hashids::salt'];

		if ( ! $salt) {
			$salt = $this->app['config']['app.key'];
		}

		return $salt;
	}

	/**
	 * Get the length used for the length of the hash.
	 *
	 * @return string
	 */
	protected function getLength()
	{
		return $this->app['config']['hashids::length'];
	}

	/**
	 * Get the alphabet used as base for encrypting and decrypting hashes.
	 *
	 * @return string
	 */
	protected function getAlphabet()
	{
		return $this->app['config']['hashids::alphabet'];
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('hashids');
	}

}