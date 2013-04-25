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
		$salt   = $this->getSalt();
		$legnth = $this->getLength();

		$this->app['hashids'] = $this->app->share(function($app) use ($salt, $length)
		{
			return new Hashids($salt, $length);
		});
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

}