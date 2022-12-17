# Shlink test utils

Helpers and utilities to run different types of tests in Shlink.

[![Build Status](https://img.shields.io/github/actions/workflow/status/shlinkio/shlink-test-utils/ci.yml?branch=main&logo=github&style=flat-square)](https://github.com/shlinkio/shlink-test-utils/actions/workflows/ci.yml?query=workflow%3A%22Continuous+integration%22)
[![Latest Stable Version](https://img.shields.io/github/release/shlinkio/shlink-test-utils.svg?style=flat-square)](https://packagist.org/packages/shlinkio/shlink-test-utils)
[![License](https://img.shields.io/github/license/shlinkio/shlink-test-utils.svg?style=flat-square)](https://github.com/shlinkio/shlink-test-utils/blob/main/LICENSE)
[![Paypal donate](https://img.shields.io/badge/Donate-paypal-blue.svg?style=flat-square&logo=paypal&colorA=aaaaaa)](https://slnk.to/donate)

## Installation

Install this tool using [composer](https://getcomposer.org/).

    composer require shlinkio/shlink-test-utils --dev

## Base test classes

* `ApiTestCase` for API e2e tests.
* `DbTestCase` for database integration tests.

Both classes extends [phpunit]'s `TestCase` class.

## TestHelper

A `TestHelper` class is provided too. It has methods to initialize a testing database and to seed the database fixtures.
