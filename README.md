#Hashids for Laravel 3

This bundle uses the classes made by: http://www.hashids.org/

<b>Generate hashes from numbers, like YouTube or Bitly.
Use hashids when you do not want to expose your database ids to the user.</b>

Hashids has two classes, one for PHP 5.4 and the other one for PHP 5.3.
You won't need to worry about which file is loaded, because the bundle checks
which PHP is running and then uses a class suitable for your server.

## Configuration

First you need to create a salt and/or length of the hashes.
These values can be changed in the <b>start.php</b> in the bundle directory.

```php
$config = array(
  'salt' => 'Place your salt here',
  'length' => 6
);
```

To autoload the <i>hashids</i> bundle you'll need to add it to your <b>application/bundles.php</b> array.

```php
return array(

  // ....other array items....
	'hashids' => array('auto' => true),
  // ....other array items....
  
);
```

Now you are ready to use this beast of a bundle!

## Using the bundle

### Getting an instance
Because <i>hashids</i> is registered in the IoC (Inverse of Control) container
we don't worry about passing any parameters, this is all taken care of cia Dependecy Injection
```php
$hasher = IoC::resolve('hashids');
```

### Encrypting
You can either encrypt one id...
```php
$hash = $hasher->encrypt(1);
```
...or multiple...
```php
$hash = $hasher->encrypt(1, 21, 12, 12, 666);
```

### Decrypting
Same thing but then the other way around...
```php
$hash = $hasher->decrypt(1);
```
...or multiple...
```php
$hash = $hasher->decrypt(1, 21, 12, 12, 666);
```

## That's it!
For the documentation written by the owner of hashids: https://github.com/ivanakimov/hashids.php

Hope you will enjoy this bundle
and thanks to Ivan Akimov ([@ivanakimov](http://twitter.com/ivanakimov "@ivanakimov")) for making Hashids.
