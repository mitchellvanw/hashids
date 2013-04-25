<?php namespace Mitchellvanw\Hashids;

use Hashids\Hashids;
use Mitchellvanw\Hashids\Exceptions\UndefinedSaltException;
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
		$this->package('mitchellvanw/hashids');
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

	protected function registerHashids()
	{
		$this->app['hashids'] = $this->app->share(function($app)
		{
			return new Hashids($app->make('hashids.salt'), $app->make('hashids.length'));
		});
	}

	/**
	 * Get the length used for encrypting and decrypting hashes.
	 *
	 * @return string
	 */
	protected function getSalt()
	{
		$salt = $this->getConfigItem('salt');

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
		return $this->getConfigItem('length');
	}

	/**
	 * Get an item from the configuration.
	 *
	 * @return mixed
	 */
	protected function getConfigItem($name)
	{
		return $this->app['config']->get('hashids::'.$name);
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