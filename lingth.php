<?php

/**
 * Check line lengths
 *
 * Options are as follows:
 *
 * 'tw' int     Tab Width; how many spaces does a single tab represent
 * 'fn' boolean FileName; whether or not to output the relevant filename
 * 'ln' boolean Line Number; whether to output the line number of long lines
 * 'sl' boolean Show Length; whether to output the actual length of long lines
 * 'lm' int     LiMit; the maximum length of a line before it's considered long
 * 'tr' boolean Tab Replace; whether to output spaces instead of tabs
 *
 * @param $filename Name representing the file being checked
 * @param $contents Contents of the file
 * @param $options Array of options/flags to control behaviour (see above)
 *
 * @return string Report containing info for each instance of a long line
 */
function check_line_lengths($filename, $contents, $options)
{
    $defaults = array(
        'tw' => 4,
        'fn' => false,
        'ln' => true,
        'sl' => true,
        'lm' => 80,
        'tr' => true
    );

    $options = array_merge($defaults, $options);
    $lines = explode("\n", $contents);
    $encoding = mb_detect_encoding($contents);
    $out = '';

    foreach ($lines as $line_number => $line) {
// Replace TABs with SPACEs so we can count them properly
        $line_tr = preg_replace_callback(
            '/^\t+/',
            function($matches) use($line_number, $options) {
                return str_repeat(' ', $options['tw'] * strlen($matches[0]));
            },
            $line
        );

        if (($len = mb_strlen($line_tr, $encoding)) > $options['lm']) {
            $out .= ($options['fn'] ? $filename.':' : '')
                .($options['ln'] ? ($line_number + 1).' ' : '')
                .($options['tr'] ? $line_tr : $line)
                .($options['sl'] ? " $len" : '')
                ."\n";
        }
    }

    return $out;
}
