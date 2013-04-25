# Hashids for Laravel 4

This package uses the classes created by [hashids.org](http://www.hashids.org/ "http://www.hashids.org/")

<b>Generate hashes from numbers, like YouTube or Bitly.
Use hashids when you do not want to expose your database ids to the user.</b>

## Installation
Begin by installing the package through Composer. Edit your project's `composer.json` file to require `mitchellvanw/hashids`.

  "require": {
    "mitchellvanw/hashids": "dev-master"
  }

Next use Composer to update your project from the the Terminal:

  composer update

Once the package has been installed you'll need to add the service provider. Open your `app/config/app.php` configuration file, and add a new item to the `providers` array.

  'Mitchellvanw\Hashids\HashidsServiceProvider'

After doing this you also need to add an alias. In your `app/config/app.php` file, add this to the `aliases` array.

  'Hashids' => 'Mitchellvanw\Hashids\Facades\Hashids'

Now last but not least you need to publish to package configuration from your Terminal:

  php artisan config:publish mitchellvanw/hashids

And voila!

The only thing which is left to do is add a salt to the configuration and you are good to go! Add the salt here: `app/config/packages/mitchellvanw/hashids/config.php`.

## Usage
Once you've followed all the steps and completed the installation you can use Hashids.

### Encrypting
You can simply encrypt on id:

  Hashids::encrypt(1); // Creating hash... Ri7Bi

or multiple..

  Hashids::encrypt(1, 21, 12, 12, 666); // Creating hash... MMtaUpSGhdA

### Decrypting
It's the same thing but the other way around:

  Hashids::decrypt(Ri7Bi);

  // Returns
  array (size=1)
    0 => int 1

or multiple..

  Hashids::decrypt(MMtaUpSGhdA);

  // Returns
  array (size=5)
    0 => int 1
    1 => int 21
    2 => int 12
    3 => int 12
    4 => int 666

## That's it!
For documentation about Hashids itself, go to: https://github.com/ivanakimov/hashids.php.

Hopefully you'll enjoy this package and thanks to Ivan Akimov (@ivanakimov) for making Hashids. All credits for the it go to him.