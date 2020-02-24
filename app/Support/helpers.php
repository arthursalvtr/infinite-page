<?php
declare(strict_types=1);


/**
 * User: ERIC
 * Date: 2/24/2020
 * Time: 8:55 AM
 */

if (!function_exists('view')) {
    function view(string $name, array $data = [])
    {
        $template = print_path([
            __ROOT__, 'resources', 'views',
        ]);
        $loader = new \Twig\Loader\FilesystemLoader($template);
        $twig = new \Twig\Environment($loader, [
//            'cache' => print_path([
//                __ROOT__, 'public', 'cache',
//            ]),
        ]);
        return $twig->load($name.'.sky.php')->render($data);
    }
}

if (!function_exists('print_path')) {
    /**
     * Concatenate given paths with PHP built-in DIRECTORY_SEPARATOR
     * @param array $paths
     *
     * @return string
     */
    function print_path(array $paths): string
    {
        return implode(DIRECTORY_SEPARATOR, $paths);
    }
}

if (! function_exists('slug')) {
    /**
     * Slugify give text
     *
     * @param string $text
     *
     * @return string
     */
    function slug(string $text): string
    {
        return mb_ereg_replace(" ", "-", mb_strtolower($text));
    }
}
