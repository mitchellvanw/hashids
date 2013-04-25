<<<<<<< HEAD
## Hashids for Laravel 4
=======
#Hashids for Laravel 3

This bundle uses the classes made by [hashids.org](http://www.hashids.org/ "http://www.hashids.org/")

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

### Creating an instance
Because <i>hashids</i> is registered in the IoC (Inverse of Control) container
we don't worry about passing any parameters, this is all taken care of cia Dependecy Injection
```php
$hasher = IoC::resolve('hashids');
```

### Encrypting
You can either encrypt one id...
```php
$hash = $hasher->encrypt(1); // Creating hash... zi7Bib
```
...or multiple...
```php
$hash = $hasher->encrypt(1, 21, 12, 12, 666); // Creating hash... MMtaUpSGhdA
```

### Decrypting
Same thing but then the other way around...
```php
$hash = $hasher->decrypt('zi7Bib');

// Returns
array (size=1)
  0 => int 1
```
...or multiple...
```php
$hash = $hasher->decrypt('MMtaUpSGhdA');

// Returns
array (size=5)
  0 => int 1
  1 => int 21
  2 => int 12
  3 => int 12
  4 => int 666
```

### Method chaining
If you don't want to create an instance and just keep it all on one line that is possible too.

<b>Encrypt:</b>
```php
$hash = IoC::resolve('hashids')->encrypt(1); // Creating hash... zi7Bib
```
<b>Decrypt</b>
```php
$hash = IoC::resolve('hashids')->decrypt('zi7Bib');

// Returns
array (size=1)
  0 => int 1
```

## That's it!
For the documentation written by the owner of hashids, [click here](https://github.com/ivanakimov/hashids.php "https://github.com/ivanakimov/hashids.php")

Hope you will enjoy this bundle
and thanks to Ivan Akimov ([@ivanakimov](http://twitter.com/ivanakimov "@ivanakimov")) for making Hashids.
All credits for the plugin go to him.
>>>>>>> bb71a107277d6d3d0a06bbbba3186ab850e50b21
