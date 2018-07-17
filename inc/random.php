<?php
function get_allfiles($path, &$files)
{
    if (is_dir($path)) {
        $dp = dir($path);
        while ($file = $dp->read()) {
            if ($file != "." && $file != "..") {
                get_allfiles($path . "/" . $file, $files);
            }
        }
        $dp->close();
    }
    if (is_file($path)) {
        $files[] = $path;
    }
}

function get_filesdir($dir)
{
    $files = array();
    get_allfiles($dir, $files);
    return $files;
}

$file_path = get_template_directory() . '/' . 'images/custom';
$file_name = get_filesdir($file_path);
