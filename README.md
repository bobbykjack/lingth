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

## Usage

    lingth [-chHlnp] [-m num] [-t num] [file ...]
           [--help]

- `-c` Don't show content
- `-h` Don't show filenames
- `-H`  Show filenames
- `-l` Don't show length
- `-L` Show length
- `-m num` Set length limit
- `-n` Don't show line numbers
- `-N` Show line numbers
- `-p` Don't replace tabs with spaces
- `-P` Replace tabs with spaces
- `-t num` Set tab width in spaces
- `file ...` The pathnames of files to be scanned for long lines. If no file arguments are specified, the standard input is used.
- `--help` Display this help and exit

## Examples

    lingth *.php

    lingth -m22 /usr/share/dict/words

    echo foo | lingth -hln -m 2

    echo '😊😊' | lingth -m1
