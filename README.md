[![GitHub license][License img]][License src]

php-bench
=========

Console tools for benchmark PHP algorithms.

![Alt php-bench](https://github.com/nafigator/php-bench/raw/master/screen.png)

###Requirements:

* PHP CLI 5.4+
* Bash shell

###Installation:

	git clone https://github.com/nafigator/php-bench.git
	cd php-bench
	git submodule init
	git submodule update

###Usage:

Create copy of test executable and modify your local settings:

    cp test-example test

Show available tests:

	./test-list
Create test skeleton:

    ./test-new <Test name> [<Block count>]
**Test name** - name of new test class.<br>
**Block count** - how much test blocks generate

Run test:

	./test <Class>

**Class** - class name from Tests directory.

###Examples:

	./test CloneVsNew
	./test IncludeVsRequire
***
If you'd like to see other PHP-algorithm comparison in this collection, feel
free to create a new issue. Thanks!

  [License img]: https://img.shields.io/badge/license-BSD3-brightgreen.svg
  [License src]: https://tldrlegal.com/license/bsd-3-clause-license-(revised)
