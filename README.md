# StyleCI Cache ![Analytics](https://ga-beacon.appspot.com/UA-60053271-6/StyleCI/Cache?pixel)


<a href="https://travis-ci.org/StyleCI/Cache"><img src="https://img.shields.io/travis/StyleCI/Cache/master.svg?style=flat-square" alt="Build Status"></img></a>
<a href="https://scrutinizer-ci.com/g/StyleCI/Cache/code-structure"><img src="https://img.shields.io/scrutinizer/coverage/g/StyleCI/Cache.svg?style=flat-square" alt="Coverage Status"></img></a>
<a href="https://scrutinizer-ci.com/g/StyleCI/Cache"><img src="https://img.shields.io/scrutinizer/g/StyleCI/Cache.svg?style=flat-square" alt="Quality Score"></img></a>
<a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Software License"></img></a>
<a href="https://github.com/StyleCI/Cache/releases"><img src="https://img.shields.io/github/release/StyleCI/Cache.svg?style=flat-square" alt="Latest Version"></img></a>


## Installation

[PHP](https://php.net) 5.5+ or [HHVM](http://hhvm.com) 3.6+, and [Composer](https://getcomposer.org) are required.

To get the latest version of StyleCI Cache, simply add the following line to the require block of your `composer.json` file:

```
"styleci/cache": "~1.0"
```

You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

If you're using Laravel 5, then you can register our service provider. Open up `config/app.php` and add the following to the `providers` key.

* `'StyleCI\Cache\CacheServiceProvider'`


## Documentation

StyleCI Cache is an analysis cache system.

Feel free to check out the [releases](https://github.com/StyleCI/Cache/releases), [license](LICENSE), and [contribution guidelines](CONTRIBUTING.md).


## License

StyleCI Cache is licensed under [The MIT License (MIT)](LICENSE).
