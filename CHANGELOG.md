# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [3.0.0] - 2026-04-27
### Removed
- **BC break:** Removed underscore (`_`) handling, since underscore has special meaning in Magento's routing convention (e.g. `paypal/billing_agreement/view` resolves to `\Magento\Paypal\Controller\Billing\Agreement\View`). Continuing to rewrite underscores would shadow this convention and break core frontend routes. Any controller previously named with `Underscore` to serve `/foo/bar_baz` URLs will need to be renamed or restructured. See #6.

## [2.0.1] - 2026-04-27
### Fixed
- Limit rewrite scope to actionPath and actionName so URL arguments are preserved, fixing the store switcher and other URLs with special characters in arguments [PR #8](https://github.com/markshust/magento2-module-specialrouter/pull/8).

## [2.0.0] - 2024-04-13
### Updated
- Refactored router to implement RouterInterface [PR #4](https://github.com/markshust/magento2-module-specialrouter/pull/4).

## [1.0.1] - 2024-04-12
### Updated
- Set router sort order to 25 to precede standard router processing [PR #1](https://github.com/markshust/magento2-module-specialrouter/pull/1).
- Updated code for best practices and coding standards [PR #2](https://github.com/markshust/magento2-module-specialrouter/pull/2).

### Added
- Add security-advisories package [PR #3](https://github.com/markshust/magento2-module-specialrouter/pull/3).

## [1.0.0] - 2022-12-16
- Initial release.
