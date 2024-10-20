<?php

require get_template_directory() .  '/inc/plugin-update-checker/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$shopkeeper_update_checker = PucFactory::buildUpdateChecker(
    'https://getbowtied.github.io/updates/themes/shopkeeper.json',
    get_template_directory(),
    'shopkeeper'
);
