URI parser benchmark
=======

[![Build Status](https://travis-ci.org/nyamsprod/uri-parser-benchmarks.svg?branch=master)](https://travis-ci.org/nyamsprod/uri-parser-benchmarks)
[![Latest Version](https://img.shields.io/github/release/nyamsprod/uri-parser-benchmarks.svg?style=flat-square)](https://github.com/nyamsprod/uri-parser-benchmarks/releases)

Motivation
-------

While developing [League URI](https://github.com/thephpleague/uri/) version 4, the need for replacing PHP `parse_url` function with a userland version which is more RFC3986 compliant was obvious.

This package sole purpose is to:

- compare different PHP userland parser against any submitted URI.
- test the resulting code overhead (speed + memory usage) vs PHP's `parse_url` function.

This is a work in progress. Feel free to update or improve the tests. It will help everyone get better compliant RFC3986 URI parser.

**Of note: we are only testing URI parser NOT URI validation which is a different topic**.

Tested implementations
-------

This package run the tests against the following implementations (order alphabetically):

- [Kit-UrlParser](https://github.com/Riimu/Kit-UrlParser)
- [League URI](https://github.com/thephpleague/uri/) (version 4.x)
- [Pear::Net_URL2](https://github.com/pear/Net_URL2)
- [Zend URI](https://github.com/zendframework/zend-uri)

And of course

- [parse_url](http://php.net/parse_url)

System Requirements
-------

You need:

- **PHP >= 5.5.0** or **HHVM >= 3.6**, but the latest stable version of PHP/HHVM is recommended
- the `mbstring` extension
- the `intl` extension

Install
-------

Clone this repo on a composer installed box and run the following command from the project folder.

``` bash
$ composer install
```

Scripts
-------

There's two scripts in the package `bin` directory:

### Parsing capabilities

The `parser.php` script returns the results from parsing a given URI with one of the available parser.

In the root directory run the following command:

``` bash
$ php bin/parser --parser=league --uri="scheme://host:/path?#fragment"
```

The above command will output the result from parsing the given URI with the `League\Uri\UriParser` class.

You can of course change the parser by providing the parser "nickname".

- *native* : `parse_url`
- *league* : `League\Uri\UriParser`
- *pear*   : `Net_URL2` 
- *zend*   : `Zend\Uri\Uri`
- *riimu*  : `Riimu\Kit\UrlParser\UriParser`

For more options you can issue the following command to display the script help message:

``` bash
$ php bin/parser --help
```

### Overhead capabilities

The `benchmark` script runs the benchmark against one implementation with a given URI.

``` bash
$ php bin/benchmark --parser=zend --uri="scheme://host:/path?#fragment"
```

The above benchmark will use the `Zend\Uri\Uri` parsing capabilities and the submitted URI will be parsed 100 times with 3 iterations.

For more options you can issue the following command to display the script help message:

``` bash
$ php bin/benchmark --help
```

Contributing
-------

Contributions are welcome and will be fully credited. Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

Credits
-------

- [ignace nyamagana butera](https://github.com/nyamsprod)
- [All Contributors](https://github.com/nyamsprod/uri-parser-benchmarks/contributors)

License
-------

The MIT License (MIT). Please see [License File](LICENSE) for more information.
