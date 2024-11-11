# CHANGELOG

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com), and this project adheres to [Semantic Versioning](https://semver.org).

## [Unreleased]
### Added
* *Nothing*

### Changed
* Update to PHPStan 2.0

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* *Nothing*


## [4.2.0] - 2024-11-09
### Added
* Add new `DatabaseTestCase::createRepository()` protected method to create default or custom repositories without duplicating code.

### Changed
* Update shlinkio coding standard to v2.4

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* *Nothing*


## [4.1.1] - 2024-10-23
### Added
* *Nothing*

### Changed
* *Nothing*

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* Make sure child processes run for CLI tests inherit parent process env vars


## [4.1.0] - 2024-02-26
### Added
* Support providing request options when calling `ApiTestCase::callShortUrl`

### Changed
* *Nothing*

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* *Nothing*


## [4.0.0] - 2024-02-20
### Added
* Add support for PHPUnit 11

### Changed
* Simplify generating code coverage for CLI and API tests

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* *Nothing*


## [3.11.1] - 2024-02-18
### Added
* *Nothing*

### Changed
* *Nothing*

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* Skip capturing coverage in `CoverageMiddleware` if coverage ID cannot be resolved


## [3.11.0] - 2024-02-17
### Added
* Add support for Doctrine ORM 3.0

### Changed
* *Nothing*

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* *Nothing*


## [3.10.0] - 2024-02-17
### Added
* Add helpers to build and export code coverage

### Changed
* *Nothing*

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* *Nothing*


## [3.9.0] - 2024-02-16
### Added
* Add coverage helpers for E2E tests (CLI and API)

### Changed
* *Nothing*

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* *Nothing*


## [3.8.1] - 2024-01-03
### Added
* *Nothing*

### Changed
* *Nothing*

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* Make sure CLI tests run provided commands with `--no-ansi`


## [3.8.0] - 2023-11-25
### Added
* Add support for PHP 8.3

### Changed
* *Nothing*

### Deprecated
* Deprecated support for openswoole.

### Removed
* Drop support for PHP 8.1

### Fixed
* *Nothing*


## [3.7.1] - 2023-06-18
### Added
* *Nothing*

### Changed
* *Nothing*

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* Make sure ApiTests send coverage ID for short URL calls


## [3.7.0] - 2023-06-11
### Added
* Improve code coverage resolution for API and CLI tests

### Changed
* *Nothing*

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* *Nothing*


## [3.6.0] - 2023-04-18
### Added
* *Nothing*

### Changed
* Add support for `shlinkio/shlink-json`.

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* *Nothing*


## [3.5.0] - 2023-02-08
### Added
* *Nothing*

### Changed
* Updated to PHPUnit 10

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* *Nothing*


## [3.4.0] - 2023-01-21
### Added
* Allowed User Agent to be provided to `ApiTestCase::callShortUrl`.

### Changed
* Updated dependencies

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* *Nothing*


## [3.3.0] - 2022-09-18
### Added
* Allowed to overwrite db commands for drop schema and run SQL on the TestHelper.

### Changed
* *Nothing*

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* *Nothing*


## [3.2.0] - 2022-08-13
### Added
* Added support to provide already prefixed URLs on API tests.

### Changed
* *Nothing*

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* *Nothing*


## [3.1.0] - 2022-08-07
### Added
* *Nothing*

### Changed
* *Nothing*

### Deprecated
* *Nothing*

### Removed
* Dropped support for PHP 8.0

### Fixed
* *Nothing*


## [3.0.1] - 2022-04-09
### Added
* *Nothing*

### Changed
* *Nothing*

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* Fixed database deletion being run as mandatory, while it might not exist


## [3.0.0] - 2022-01-21
### Added
* [#5](https://github.com/shlinkio/shlink-test-utils/issues/5) Added new `CliTestCase` with helper functions to E2E test Shlink from the CLI.

### Changed
* Explicitly added trusted plugins to composer.json

### Deprecated
* *Nothing*

### Removed
* Dropped support for Symfony 5

### Fixed
* *Nothing*


## [2.5.0] - 2021-12-10
### Added
* Added `X-Coverage-Id` header that is sent on every request to Shlink with the FQCN of the tests.

### Changed
* *Nothing*

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* *Nothing*


## [2.4.0] - 2021-12-02
### Added
* Added support for symfony/process 6.0
* Added support for PHP 8.1

### Changed
* Updated to phpstan 1.2

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* *Nothing*


## [2.3.0] - 2021-10-23
### Added
* Allowed to customize the commands to run when invoking `TestHelper::createTestDb`.

### Changed
* *Nothing*

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* *Nothing*


## [2.2.0] - 2021-08-04
### Added
* *Nothing*

### Changed
* Improved error handling on dependencies provided via setter for ApiTestCase and DatabaseTestCase
* Added experimental builds under PHP 8.1
* Increased required phpstan level to 8

### Deprecated
* *Nothing*

### Removed
* Dropped support for PHP 7.4

### Fixed
* *Nothing*


## [2.1.0] - 2021-03-12
### Added
* Improved `TestHelper::createTestDb` method, so that it tries to run the migrations too, which helps spot issues on them.

### Changed
* *Nothing*

### Deprecated
* *Nothing*

### Removed
* Dropped support for guzzle 6.*

### Fixed
* *Nothing*


## [2.0.0] - 2021-01-13
### Added
* [#17](https://github.com/shlinkio/shlink-test-utils/issues/17) Update `DatabaseTestCase` so that it wraps every test in a transaction that is then rolled back.

### Changed
* *Nothing*

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* *Nothing*


## [1.7.0] - 2021-01-10
### Added
* Update `ApiTestCase` so that it allows providing the API key value when calling `callApiWithKey`.

### Changed
* Migrated build to Github Actions.

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* *Nothing*


## [1.6.0] - 2020-11-01
### Added
* Explicitly added PHP 8 as a supported PHP version.

### Changed
* Added PHP 8 to the build matrix, allowing failures on it.

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* *Nothing*


## [1.5.0] - 2020-06-28
### Added
* Added support for Guzzle 7.

### Changed
* *Nothing*

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* *Nothing*


## [1.4.0] - 2020-02-15
### Added
* Updated to PHPUnit 9.

### Changed
* *Nothing*

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* *Nothing*


## [1.3.0] - 2020-01-03
### Added
* *Nothing*

### Changed
* [#6](https://github.com/shlinkio/shlink-test-utils/issues/6) API tests will now perform API requests to v2 endpoints.
* [#8](https://github.com/shlinkio/shlink-test-utils/issues/8) Updated coding-standard (v2.1) and phpstan (v0.12) dependencies.

### Deprecated
* *Nothing*

### Removed
* [#7](https://github.com/shlinkio/shlink-test-utils/issues/7) Dropped support for PHP 7.2 and 7.3

### Fixed
* *Nothing*


## [1.2.0] - 2019-11-30
### Added
* Updated dependencies.

### Changed
* *Nothing*

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* *Nothing*


## [1.1.0] - 2019-11-21
### Added
* Improved `ApiTestCase::getJsonResponsePayload` so that it throws an error if provided response's body could not be parsed.

### Changed
* *Nothing*

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* *Nothing*


## [1.0.0] - 2019-08-11
### Added
* First release

### Changed
* *Nothing*

### Deprecated
* *Nothing*

### Removed
* *Nothing*

### Fixed
* *Nothing*
