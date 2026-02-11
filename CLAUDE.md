# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Unofficial PHP API client library for the eToro trading platform (`marekskopal/etoro`). Requires PHP >= 8.4.1. Uses PSR-18 HTTP client discovery (no specific HTTP client bundled — consumers provide their own).

## Commands

```bash
# Install dependencies
composer install

# Run all tests
vendor/bin/phpunit

# Run a single test file
vendor/bin/phpunit tests/Api/MarketDataTest.php

# Run a single test method
vendor/bin/phpunit --filter testSearch tests/Api/MarketDataTest.php

# Lint (PHP_CodeSniffer with custom ruleset)
vendor/bin/phpcs

# Fix lint issues
vendor/bin/phpcbf

# Static analysis (PHPStan level 9)
vendor/bin/phpstan analyse
```

## Architecture

### Entry Point

`Etoro` (src/Etoro.php) — readonly class that takes a `Config` and exposes API group instances as public properties: `marketData`, `trading`, `watchlists`, `feeds`, `usersInfo`, `piData`, `curatedLists`, `marketRecommendations`.

### API Layer

Each API group (src/Api/) extends `EtoroApi`, which holds a `ClientInterface`. API methods call `$this->client->get/post/put/delete(...)`, then deserialize JSON responses into DTOs via static `fromJson`/`fromJsonList` factory methods. The `Trading` API also receives `Config` to build demo vs production paths.

### Client

`Client` (src/Client/) is a readonly PSR-18 wrapper. It discovers HTTP client and factories via `php-http/discovery`, adds auth headers (`x-api-key`, `x-user-key`), and handles 429 rate-limit retries based on `Config::tooManyRequestsRepeat` and `Config::tooManyRequestsWaitTime`.

### DTOs

All DTOs (src/Dto/) are readonly classes with promoted constructor properties. Each has a static `fromArray(array $data): self` factory. Response DTOs add `fromJson(string $json): self` and/or `fromJsonList(string $json): list<self>`. PHPStan type aliases are defined via `@phpstan-type` docblocks on the DTO, then imported where needed with `@phpstan-import-type`.

### Testing

Tests use `ClientFixture` (tests/Fixtures/Client/ClientFixture.php) — a `ClientInterface` implementation that returns canned JSON from files in `tests/Fixtures/Response/`. Tests construct API classes directly with this fixture, assert on deserialized DTO properties. PHPUnit requires `#[CoversClass]` and `#[UsesClass]` attributes on all test classes.

## Code Style

- All classes use `declare(strict_types=1)` and are `readonly` where possible
- PSR-12 base with Slevomat Coding Standard extensions (custom ruleset in `ruleset.xml`, referenced by `phpcs.xml`)
- PHPStan level 9 with strict rules
- 4-space indentation, UTF-8, trailing newlines (see `.editorconfig`)
