# Contributing

Contributions are **welcome** and will be fully **credited**.

We accept contributions via Merge Requests on [Gitlab](https://gitlab.com/jbtcd/fitbit-sdk-php).


## Merge Requests

- **[PSR-2 Coding Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)** - The easiest way to apply the conventions is to install [PHP Code Sniffer](http://pear.php.net/package/PHP_CodeSniffer).

- **Add tests** - Your patch won't be accepted if it doesn't have tests. We want a minimum code coverage of 95%.

- **Document any change in behaviour** - Make sure the README and any other relevant documentation are kept up-to-date.

- **Create topic branches** - Don't ask us to pull from your master branch.

- **One merge request per feature** - If you want to do more than one thing, send multiple merge requests.

- **Ensure tests pass!** - Please run the tests (see below) before submitting your pull request, and make sure they pass. We won't accept a patch until all tests pass.


## Testing

The following tests must pass for a build to be considered successful. If contributing, please ensure these pass before submitting a pull request.

``` bash
$ composer run tests
```

**Thank you and happy coding**!
