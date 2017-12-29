<?php

/**
 * Plugin Name:       Modularity Checklist
 * Plugin URI:        https://github.com/helsingborg-stad/modularity-checklist
 * Description:       A module to display a checklist.
 * Version:           1.0.0
 * Author:            Jonatan Hanson
 * Author URI:        https://github.com/helsingborg-stad
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       modularity-checklist
 * Domain Path:       /languages
 */

 // Protect agains direct file access
if (! defined('WPINC')) {
    die;
}

define('MODULARITYCHECKLIST_PATH', plugin_dir_path(__FILE__));
define('MODULARITYCHECKLIST_URL', plugins_url('', __FILE__));
define('MODULARITYCHECKLIST_TEMPLATE_PATH', MODULARITYCHECKLIST_PATH . 'templates/');

load_plugin_textdomain('modularity-checklist', false, plugin_basename(dirname(__FILE__)) . '/languages');

require_once MODULARITYCHECKLIST_PATH . 'source/php/Vendor/Psr4ClassLoader.php';
require_once MODULARITYCHECKLIST_PATH . 'Public.php';

// Instantiate and register the autoloader
$loader = new ModularityChecklist\Vendor\Psr4ClassLoader();
$loader->addPrefix('ModularityChecklist', MODULARITYCHECKLIST_PATH);
$loader->addPrefix('ModularityChecklist', MODULARITYCHECKLIST_PATH . 'source/php/');
$loader->register();

// Acf auto import and export
add_action('plugins_loaded', function () {
    $acfExportManager = new \AcfExportManager\AcfExportManager();
    $acfExportManager->setTextdomain('modularity-checklist');
    $acfExportManager->setExportFolder(MODULARITYCHECKLIST_PATH . 'acf-fields/');
    $acfExportManager->autoExport(array(
        'checklist' => 'group_5a44cc421bc9e'
    ));
    $acfExportManager->import();

    modularity_register_module(
        MODULARITYCHECKLIST_PATH . 'source/php/Module',
        'Module'
    );
});