# Hashids for Laravel 4

This package uses the classes created by [hashids.org](http://www.hashids.org/ "http://www.hashids.org/")

<b>Generate hashes from numbers, like YouTube or Bitly.
Use hashids when you do not want to expose your database ids to the user.</b>

## Installation
Begin by installing the package through Composer. Edit your project's `composer.json` file to require `mitch/hashids`.

  ```php
  "require": {
    "mitch/hashids": "1.x"
  }
  ```

Next use Composer to update your project from the the Terminal:

  ```php
  php composer.phar update
  ```

Once the package has been installed you'll need to add the service provider. Open your `app/config/app.php` configuration file, and add a new item to the `providers` array.

  ```php
  'Mitch\Hashids\HashidsServiceProvider'
  ```

After doing this you also need to add an alias. In your `app/config/app.php` file, add this to the `aliases` array.

  ```php
  'Hashids' => 'Mitch\Hashids\Hashids'
  ```

Now last but not least you need to publish to package configuration from your Terminal:

  ```php
  php artisan config:publish mitch/hashids
  ```

## Usage
Once you've followed all the steps and completed the installation you can use Hashids.

### Encoding
You can simply encrypt on id:

  ```php
  Hashids::encode(1); // Creating hash... Ri7Bi
  ```

or multiple..

  ```php
  Hashids::encode(1, 21, 12, 12, 666); // Creating hash... MMtaUpSGhdA
  ```

### Decoding
It's the same thing but the other way around:

  ```php
  Hashids::decode('Ri7Bi');

  // Returns
  array (size=1)
    0 => int 1
  ```

or multiple..

  ```php
  Hashids::decode('MMtaUpSGhdA');

  // Returns
  array (size=5)
    0 => int 1
    1 => int 21
    2 => int 12
    3 => int 12
    4 => int 666
  ```
### Injecting Hashids
Now it's also possible to have Hashids injected into your class.
Lets look at this controller as an example..

  ```php
  class ExampleController extends BaseController
  {
      protected $hashids;

      public function __construct(Hashids\Hashids $hashids)
      {
          $this->hashids = $hashids;
      }

      public function getIndex()
      {
          $hash = $this->hashids->encode(1);
          return View::make('example.index', compact('hash'));
      }
  }
  ```
The original classname and namespace has been bound in the IoC container to return our instantiated Hashids class.

### Using IoC
Create a Hashids instance with the IoC

  ```php
  App::make('Hashids\Hashids')->encode(1);
  ```

## That's it!
Documentation about [Hashids can be found here](https://github.com/ivanakimov/hashids.php).

Thanks to Ivan Akimov (@ivanakimov) for making Hashids. All credits for the Hashids package go to him.
