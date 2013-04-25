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
		$this->app['hashids'] = $this->app->share(function($app)
		{
			return new Hashids($this->getSalt(), $this->getLength());
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

	protected function getSalt()
	{
		$salt = $this->getConfigItem('salt');
		if (! $salt) {
			throw new UndefinedSaltException('No salt has been set in the configuration.');
		}

		return $salt;
	}

	protected function getLength()
	{
		return $this->getConfigItem('length');
	}

	protected function getConfigItem($name)
	{
		return $this->app['config']->get('hashids::'.$name);
	}

}