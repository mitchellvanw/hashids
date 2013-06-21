<?php namespace Mitch\Hashids;

use Hashids\Hashids;
use Mitch\Hashids\Exceptions\UndefinedSaltException;
use Illuminate\Support\ServiceProvider;

class HashidsServiceProvider extends ServiceProvider {

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
		$this->package('mitch/hashids');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */

	public function register()
	{
		$this->registerHashidsSalt();

		$this->registerHashidsLength();

		$this->registerHashids();
	}

	protected function registerHashidsSalt()
	{
		$this->app->bind('hashids.salt', function()
		{
			return $this->getSalt();
		});
	}

	protected function registerHashidsLength()
	{
		$this->app->bind('hashids.length', function()
		{
			return $this->getLength();
		});
	}

	protected function registerHashidsAlphabet()
	{
		$this->app->bind('hashids.alphabet', function()
		{
			return $this->getAlphabet();
		});
	}

	protected function registerHashids()
	{
		$this->app['hashids'] = $this->app->share(function($app)
		{
			return new Hashids($app->make('hashids.salt'), $app->make('hashids.length'), $app->make('hashids.alphabet'));
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

		if (! $salt) {
			throw new UndefinedSaltException('No salt has been set in the configuration.');
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