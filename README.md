# Codeception Composer Project Module

[![Latest Stable Version](https://poser.pugx.org/typisttech/codeception-composer-project-module/v/stable)](https://packagist.org/packages/typisttech/codeception-composer-project-module)
[![Total Downloads](https://poser.pugx.org/typisttech/codeception-composer-project-module/downloads)](https://packagist.org/packages/typisttech/codeception-composer-project-module)
[![Build Status](https://travis-ci.org/TypistTech/codeception-composer-project-module.svg?branch=master)](https://travis-ci.org/TypistTech/codeception-composer-project-module)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/TypistTech/codeception-composer-project-module/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/TypistTech/codeception-composer-project-module/?branch=master)
[![PHP Versions Tested](http://php-eye.com/badge/typisttech/codeception-composer-project-module/tested.svg)](https://travis-ci.org/TypistTech/codeception-composer-project-module)
[![StyleCI](https://styleci.io/repos/85661405/shield?branch=master)](https://styleci.io/repos/85661405)
[![Dependency Status](https://gemnasium.com/badges/github.com/TypistTech/codeception-composer-project-module.svg)](https://gemnasium.com/github.com/TypistTech/codeception-composer-project-module)
[![License](https://poser.pugx.org/typisttech/codeception-composer-project-module/license)](https://packagist.org/packages/typisttech/codeception-composer-project-module)
[![Donate via PayPal](https://img.shields.io/badge/Donate-PayPal-blue.svg)](https://www.typist.tech/donate/codeception-composer-project-module/)
[![Hire Typist Tech](https://img.shields.io/badge/Hire-Typist%20Tech-ff69b4.svg)](https://www.typist.tech/contact/)

Create throw away composer projects for Codeception tests.


<!-- START doctoc generated TOC please keep comment here to allow auto update -->
<!-- DON'T EDIT THIS SECTION, INSTEAD RE-RUN doctoc TO UPDATE -->


- [Why?](#why)
- [The Goals, or What This Module Does?](#the-goals-or-what-this-module-does)
- [Install](#install)
- [Config](#config)
  - [projectRoot](#projectroot)
  - [composerInstallFlags](#composerinstallflags)
  - [symlink](#symlink)
  - [repositoryPaths](#repositorypaths)
- [API](#api)
  - [amInTmpProjectDir](#amintmpprojectdir)
  - [runComposerCommand](#runcomposercommand)
  - [runComposerInstall](#runcomposerinstall)
  - [getTmpProjectDir()](#gettmpprojectdir)
- [Frequently Asked Questions](#frequently-asked-questions)
  - [I want to see what Codeception Composer Project Module have done for me?](#i-want-to-see-what-codeception-composer-project-module-have-done-for-me)
  - [What to do when `composer install` fail or not install the latest version?](#what-to-do-when-composer-install-fail-or-not-install-the-latest-version)
  - [What to do when the tests are too slow?](#what-to-do-when-the-tests-are-too-slow)
  - [Does it works on `codeception/base`?](#does-it-works-on-codeceptionbase)
  - [Do you have an example project that use this module?](#do-you-have-an-example-project-that-use-this-module)
- [Support!](#support)
  - [Donate via PayPal *](#donate-via-paypal-)
  - [Why don't you hire me?](#why-dont-you-hire-me)
  - [Want to help in other way? Want to be a sponsor?](#want-to-help-in-other-way-want-to-be-a-sponsor)
- [Developing](#developing)
- [Running the Tests](#running-the-tests)
- [Feedback](#feedback)
- [Change log](#change-log)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)

<!-- END doctoc generated TOC please keep comment here to allow auto update -->

## Why?

Because it good to test your code in a more realistic environment.

## The Goals, or What This Module Does?

Create throw away composer projects for Codeception tests.



Before each test:

* Copy composer project files to a temporary directory
* Config local packages paths
* Install package via composer
* Change directory into the temporary directory

After each test:

* Delete the temporary directory

## Install

Installation should be done via composer, details of how to install composer can be found at [https://getcomposer.org/](https://getcomposer.org/).

``` bash
$ composer require typisttech/codeception-composer-project-module --dev
```

## Config

In your Codeception config file (e.g: `acceptance.suite.yml` or `acceptance.yml`):

*This is the minimal config:*

```yaml
modules:
    enabled:
        - ComposerProject:
            projectRoot: 'path/to/composer/project'
            depends:
                - Cli
                - Filesystem
```

*This is the full config:*

```yaml
modules:
    enabled:
        - ComposerProject:
            projectRoot: 'path/to/composer/project'
            composerInstallFlags: '--no-interaction --quiet'
            symlink: 'true'
            repositoryPaths:
                - 'tests/_data/dummy'
                - 'tests/_data/another-dummy'
            depends:
                - Cli
                - Filesystem
```

### projectRoot

**Required** String

Example: `tests/_data/project`

Path to the composer project directory, relative to the root directory (where `codeception.yml` is located).
This directory must contain a `composer.json` file.

### composerInstallFlags

*Optional* String

Example: `--no-interaction --verbose --no-ansi`

Default: `--no-interaction --quiet`

Extra flags to pass in during `composer install`.

See: [$ composer help install](https://getcomposer.org/doc/03-cli.md#install)

### symlink

*Optional* Boolean in **single quotes**

Example: `'false'`

Default: `'true'`

Should the local packages be symlink-ed or not.

See: [Composer document](https://getcomposer.org/doc/05-repositories.md#path)

### repositoryPaths

*Optional* Array of strings

Example:
```yaml
- 'tests/_data/dummy'
- 'tests/_data/another-dummy'
```

Default: The root directory (where `codeception.yml` is located).

Paths to local packages, relative to the root directory (where `codeception.yml` is located).

See: [Composer document](https://getcomposer.org/doc/05-repositories.md#path)


## API

### amInTmpProjectDir

Change directory to the temporary project directory

* @return void

Example:
```php
$I->amInTmpProjectDir();
```

### runComposerCommand

Run a composer command

*   @param string $command
  * @param bool   $failNonZero Optional. Default: true
           Fails If exit code is > 0.
  * @return void

Example:
```php
$I->runComposerCommand('update --verbose');

// This is equivalent to running `$ composer update --verbose` in the console.
```

### runComposerInstall

Run `composer install` with [`composerInstallFlags`](#composerinstallflags)

* @return void

Example:
```php
$I->runComposerInstall();
```

### getTmpProjectDir()

Get the path to the temporary project directory

Note: Return value maybe a symbolic link.

* @return string

Example:
```php
$I->getTmpProjectDir();

// To ensure real path:
$tmpProjectDir = $I->getTmpProjectDir();
$tmpProjectDir = realpath($tmpProjectDir);
```

## Frequently Asked Questions

### I want to see what Codeception Composer Project Module have done for me?

Run the tests with the [`--debug` flag](http://codeception.com/docs/reference/Commands).

Codeception Composer Project Module will log debug message to the console.

### What to do when `composer install` fail or not install the latest version?

> Your requirements could not be resolved to an installable set of packages.

Make sure you have package [version constraints](https://getcomposer.org/doc/articles/versions.md) and [minimum stability](https://getcomposer.org/doc/articles/versions.md#minimum-stability) set up correctly.

```json
{
    "require": {
        "dummy/dummy": "*"
    },
    "minimum-stability": "dev"
}
```

### What to do when the tests are too slow?

- Enable [symlink](#symlink)
- Add `--prefer-dist` to [composerInstallFlags](#composerinstallflags)
- Add `"prefer-stable": true` to `composer.json`

Note: These methods might not suitable for your use case.

### Does it works on `codeception/base`?

Yes. This module works on both [`codeception/codeception`](https://packagist.org/packages/codeception/codeception) and [`codeception/base`](https://packagist.org/packages/codeception/base)

### Do you have an example project that use this module?

Here you go: [Imposter Plugin](https://github.com/TypistTech/imposter-plugin)

## Support!

### Donate via PayPal [![Donate via PayPal](https://img.shields.io/badge/Donate-PayPal-blue.svg)](https://www.typist.tech/donate/codeception-composer-project-module/)

Love Codeception Composer Project Module? Help me maintain Codeception Composer Project Module, a [donation here](https://www.typist.tech/donate/codeception-composer-project-module/) can help with it.

### Why don't you hire me?
Ready to take freelance WordPress jobs. Contact me via the contact form [here](https://www.typist.tech/contact/) or, via email info@typist.tech

### Want to help in other way? Want to be a sponsor?
Contact: [Tang Rufus](mailto:tangrufus@gmail.com)

## Developing

To setup a developer workable version you should run these commands:

```bash
$ composer create-project --keep-vcs --no-install typisttech/codeception-composer-project-module:dev-master
$ cd codeception-composer-project-module
$ composer install
```

## Running the Tests

[Codeception Composer Project Module](https://github.com/TypistTech/codeception-composer-project-module) run tests on [Codeception](http://codeception.com/).

Run the tests:

``` bash
$ composer test
```

We also test all PHP files against [PSR-2: Coding Style Guide](http://www.php-fig.org/psr/psr-2/).

Check the code style with ``$ composer check-style`` and fix it with ``$ composer fix-style``.

## Feedback

**Please provide feedback!** We want to make this library useful in as many projects as possible.
Please submit an [issue](https://github.com/TypistTech/codeception-composer-project-module/issues/new) and point out what you do and don't like, or fork the project and make suggestions.
**No issue is too small.**

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security

If you discover any security related issues, please email codeception-composer-project-module@typist.tech instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) and [CODE_OF_CONDUCT](./CODE_OF_CONDUCT.md) for details.

## Credits

[Codeception Composer Project Module](https://github.com/TypistTech/codeception-composer-project-module) is a [Typist Tech](https://www.typist.tech) project and maintained by [Tang Rufus](https://twitter.com/Tangrufus), freelance developer for [hire](https://www.typist.tech/contact/).

Full list of contributors can be found [here](https://github.com/TypistTech/codeception-composer-project-module/graphs/contributors).

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
