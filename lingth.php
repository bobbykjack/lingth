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
        'ln' => true,
        'lm' => 80,
    );

    $options = array_merge($defaults, $options);
    $lines = explode("\n", $contents);
    $encoding = mb_detect_encoding($contents);
    $out = array();

    foreach ($lines as $line_number => $line) {
// Replace TABs with SPACEs so we can count them properly
        $line_tr = replace_leading_tabs_with_spaces($line, $options["tw"]);

        if (($len = mb_strlen($line_tr, $encoding)) > $options['lm']) {
            $result = array("line" => $line);

            if ($options['ln']) {
                $result['ln'] = $line_number + 1;
            }

            if ($options['sl']) {
                $result['sl'] = $len;
            }

            $out[] = $result;
        }
    }

    return $out;
}

/**
 */
function replace_leading_tabs_with_spaces($str, $tw)
{
    return preg_replace_callback(
        '/^\t+/',
        function($matches) use($tw) {
            return str_repeat(' ', $tw * strlen($matches[0]));
        },
        $str
    );
}

