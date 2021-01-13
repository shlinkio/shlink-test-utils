# CHANGELOG

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com), and this project adheres to [Semantic Versioning](https://semver.org).

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
