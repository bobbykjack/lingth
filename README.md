# lingth

A simple line-length checker

## Features

- Handles multiple files and redirected input
- Flexible output options
- Handles tabs and unicode
- Includes command-line wrapper and core library function

## Installation

1. Simply copy `lingth` and `lingth.php` to a directory — any directory, but the
same one.

2. Run by specifying full path to `lingth` command, adding its directory to your
`PATH` environment variable, or symlinking from a directory already in `PATH`

## Examples

    lingth *.php

    lingth -m22 /usr/share/dict/words

    echo foo | lingth -hln -m 2

    echo '😊😊' | lingth -m1
