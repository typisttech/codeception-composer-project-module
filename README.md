<div align="center">

# Codeception Composer Project Module

</div>

<div align="center">


[![Packagist Version](https://img.shields.io/packagist/v/typisttech/codeception-composer-project-module.svg?style=flat-square)](https://packagist.org/packages/typisttech/codeception-composer-project-module)
[![Packagist Downloads](https://img.shields.io/packagist/dt/typisttech/codeception-composer-project-module.svg?style=flat-square)](https://packagist.org/packages/typisttech/codeception-composer-project-module)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/TypistTech/codeception-composer-project-module?style=flat-square)](https://packagist.org/packages/typisttech/codeception-composer-project-module)
[![CircleCI](https://img.shields.io/circleci/build/gh/TypistTech/codeception-composer-project-module?style=flat-square)](https://circleci.com/gh/TypistTech/codeception-composer-project-module)
[![license](https://img.shields.io/github/license/TypistTech/codeception-composer-project-module.svg?style=flat-square)](https://github.com/TypistTech/codeception-composer-project-module/blob/master/LICENSE)
[![Twitter Follow @TangRufus](https://img.shields.io/twitter/follow/TangRufus?style=flat-square&color=1da1f2&logo=twitter)](https://twitter.com/tangrufus)
[![Hire Typist Tech](https://img.shields.io/badge/Hire-Typist%20Tech-ff69b4.svg?style=flat-square)](https://www.typist.tech/contact/)

</div>

<p align="center">
  <strong>Create throw away composer projects for Codeception tests.</strong>
  <br />
  <br />
  Built with ♥ by <a href="https://www.typist.tech/">Typist Tech</a>
</p>

---

**Codeception Composer Project Module** is an open source project and completely free to use.

However, the amount of effort needed to maintain and develop new features is not sustainable without proper financial backing. If you have the capability, please consider donating using the links below:

<div align="center">

[![GitHub via Sponsor](https://img.shields.io/badge/Sponsor-GitHub-ea4aaa?style=flat-square&logo=github)](https://github.com/sponsors/TangRufus)
[![Sponsor via PayPal](https://img.shields.io/badge/Sponsor-PayPal-blue.svg?style=flat-square&logo=paypal)](https://typist.tech/go/paypal-donate/)
[![More Sponsorship Information](https://img.shields.io/badge/Sponsor-More%20Details-ff69b4?style=flat-square)](https://typist.tech/donate/codeception-composer-project-module/)

</div>

---

Create throw away composer projects for Codeception tests.

## Why?

Because it's good to test your composer plugins in a more realistic environment.

## The Goals, or What This Module Does?

Create throw away composer projects for Codeception tests.


Before each test:

* Copy dummy composer project files to a temporary directory
* Config local packages paths
* Install package via composer
* Change directory into the temporary directory

After each test:

* Delete the temporary directory

## Install

```bash
composer require --dev typisttech/codeception-composer-project-module
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

---

<p align="center">
  <strong>Typist Tech is ready to build your next awesome WordPress site. <a href="https://typist.tech/contact/">Hire us!</a></strong>
</p>

---

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
// This is equivalent to running `$ composer update --verbose` in the console.
$I->runComposerCommand('update --verbose');
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

### Which composer versions are supported?

Both v1 and v2.

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

Note: These methods are not suitable for every use case.

### Do you have real life examples that use this composer plugin?

Here you go:

 * [Imposter Plugin](https://github.com/TypistTech/imposter-plugin)


 *Add your own [here](https://github.com/TypistTech/codeception-composer-project-module/edit/master/README.md)*

### Will you add support for older PHP versions?

Never! This plugin will only work on [actively supported PHP versions](https://secure.php.net/supported-versions.php).

Don't use it on **end of life** or **security fixes only** PHP versions.

### It looks awesome. Where can I find some more goodies like this

- Articles on [Typist Tech's blog](https://typist.tech)
- [Tang Rufus' WordPress plugins](https://profiles.wordpress.org/tangrufus#content-plugins) on wp.org
- More projects on [Typist Tech's GitHub profile](https://github.com/TypistTech)
- Stay tuned on [Typist Tech's newsletter](https://typist.tech/go/newsletter)
- Follow [Tang Rufus' Twitter account](https://twitter.com/TangRufus)
- **Hire [Tang Rufus](https://typist.tech/contact) to build your next awesome site**

### Where can I give 5-star reviews?

Thanks! Glad you like it. It's important to let me knows somebody is using this project. Please consider:

- [tweet](https://twitter.com/intent/tweet?url=https%3A%2F%2Fgithub.com%2FTypistTech%2Fcodeception-composer-project-module&via=tangrufus&text=Create%20throw%20away%20%23composer%20projects%20for%20%23Codeception%20tests) something good with mentioning [@TangRufus](https://twitter.com/tangrufus)
- ★ star [the Github repo](https://github.com/TypistTech/codeception-composer-project-module)
- [👀 watch](https://github.com/TypistTech/codeception-composer-project-module/subscription) the Github repo
- write tutorials and blog posts
- **[hire](https://www.typist.tech/contact/) Typist Tech**

## Testing

```bash
composer test
composer style:check
```

## Feedback

**Please provide feedback!** We want to make this project as useful as possible.
Please [submit an issue](https://github.com/TypistTech/codeception-composer-project-module/issues/new) and point out what you do and don't like, or fork the project and [send pull requests](https://github.com/TypistTech/codeception-composer-project-module/pulls/).
**No issue is too small.**

## Security Vulnerabilities

If you discover a security vulnerability within this project, please email us at [codeception-composer-project-module@typist.tech](mailto:codeception-composer-project-module@typist.tech).
All security vulnerabilities will be promptly addressed.

## Credits

[Codeception Composer Project Module](https://github.com/TypistTech/codeception-composer-project-module) is a [Typist Tech](https://typist.tech) project and maintained by [Tang Rufus](https://twitter.com/TangRufus), freelance developer for [hire](https://www.typist.tech/contact/).

Full list of contributors can be found [here](https://github.com/TypistTech/codeception-composer-project-module/graphs/contributors).

## License

[Codeception Composer Project Module](https://github.com/TypistTech/codeception-composer-project-module) is released under the [MIT License](https://opensource.org/licenses/MIT).
