<?php

/**
 * Check line lengths
 *
 * Options are as follows:
 *
 * 'tw' int     Tab Width; how many spaces does a single tab represent
 * 'ln' boolean Line Number; whether to output the line number of long lines
 * 'sl' boolean Show Length; whether to output the actual length of long lines
 * 'lm' int     LiMit; the maximum length of a line before it's considered long
 *
 * @param string $filename Name representing the file being checked
 * @param string $contents Contents of the file
 * @param array $options Options/flags to control behaviour (see above)
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
 * Replace leading tabs with equivalent spaces
 *
 * @param string $str String to replace tabs in
 * @param int $tw Number of spaces to replace each tab with
 *
 * @return String after any and all replacements have been made
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

