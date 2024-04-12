<h1 align="center">MarkShust_SpecialRouter</h1> 

<div align="center">
  <p>Adds the ability to use special characters in URLs.</p>
  <img src="https://img.shields.io/badge/magento-^2.4.5-brightgreen.svg?logo=magento&longCache=true&style=flat-square" alt="Supported Magento Versions" />
  <a href="https://packagist.org/packages/markshust/magento2-module-specialrouter" target="_blank"><img src="https://img.shields.io/packagist/v/markshust/magento2-module-specialrouter.svg?style=flat-square" alt="Latest Stable Version" /></a>
  <a href="https://packagist.org/packages/markshust/magento2-module-specialrouter" target="_blank"><img src="https://poser.pugx.org/markshust/magento2-module-specialrouter/downloads" alt="Composer Downloads" /></a>
  <a href="https://GitHub.com/Naereen/StrapDown.js/graphs/commit-activity" target="_blank"><img src="https://img.shields.io/badge/maintained%3F-yes-brightgreen.svg?style=flat-square" alt="Maintained - Yes" /></a>
  <a href="https://opensource.org/licenses/MIT" target="_blank"><img src="https://img.shields.io/badge/license-MIT-blue.svg" /></a>
</div>

## Table of contents

- [Summary](#summary)
- [Installation](#installation)
- [Usage](#usage)
- [Credits](#credits)
- [License](#license)

## Summary

Magento does not provide the ability to set special characters on controller or action names. This module fixes that by providing the ability to use `-`, `.`, `~`, `_` within a URL.

## Installation

```
composer require markshust/magento2-module-specialrouter
bin/magento module:enable MarkShust_SpecialRouter
bin/magento setup:upgrade
```

## Usage

This module is really simple to use. All you need to do is use the appropriate "name" that matches the symbol you'd like to use in the URL.

- Symbol: `-`, Name: `Dash`
- Symbol: `.`, Name: `Period`
- Symbol: `~`, Name: `Tilda`
- Symbol: `_`, Name: `Underscore`

For example, to respond to a request with a `frontName` of `foo` at the following location:

```
/foo/alpha-beta/charlie-delta
```

Use a PHP class named:

```
Controller/AlphaDashBeta/CharlieDashDelta.php
```

The `-` in the URL will be translated to `dash` in the actionPath and actionName, so if we create files using `Dash` in the controller and action name, they will respond to these requests.

## Credits

### M.academy

This course is sponsored by <a href="https://m.academy" target="_blank">M.academy</a>, the simplest way to learn Magento.

<a href="https://m.academy" target="_blank"><img src="docs/macademy-logo.png" alt="M.academy"></a>

### Mark Shust

My name is Mark Shust and I'm the creator of this repo. I'm a <a href="https://www.credly.com/users/mark-shust/badges" target="_blank">6X Adobe Commerce Certified Developer</a> and have been involved with Magento since the early days (v0.8!). I create technical education courses full-time for my company, <a href="https://m.academy" target="_blank">M.academy</a>.

- <a href="https://m.academy/courses" target="_blank">🖥️ See my Magento lessons & courses</a>
- <a href="https://m.academy/articles" target="_blank">📖 Read my technical articles</a>
- <a href="https://youtube.com/markshust" target="_blank">🎥 Watch my YouTube videos</a>
- <a href="https://www.linkedin.com/in/MarkShust/" target="_blank">🔗 Connect on LinkedIn</a>
- <a href="https://twitter.com/MarkShust" target="_blank">🐦 Follow me on X</a>
- <a href="mailto:mark@m.academy">💌 Contact me</a>

## License

[MIT](https://opensource.org/licenses/MIT)
