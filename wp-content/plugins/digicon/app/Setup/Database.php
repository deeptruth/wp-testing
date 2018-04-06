<?php

namespace Digicon\Setup;

require_once ABSPATH . 'wp-admin/includes/upgrade.php';

/**
 *
 */

class Database
{
    public static function init()
    {
        self::install();
        self::unInstall();
    }

    public function install()
    {
        register_activation_hook(DIGICON_EVENTS_INIT_FILE, array(__CLASS__, 'registerTables'));
    }

    /**
     * 
     * @return void
     */
    public function registerTables()
    {
        if (get_option('create_events_table')) {
            return;
        }

        update_option('create_events_table', 1);

        global $wpdb;

        // creates wp_awesomeness in database if not exists
        $table = $wpdb->prefix . "events";
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE IF NOT EXISTS $table (
            `id` int(9) NOT NULL AUTO_INCREMENT,
            `code` char(10) NOT NULL,
            `title` varchar(30) NOT NULL,
            `deleted_at` timestamp NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
        UNIQUE (`id`)
        ) $charset_collate;";
        dbDelta($sql);

    }

    /**
     * Uninstall hook
     * 
     * @return void
     */
    public function unInstall()
    {
        register_deactivation_hook(DIGICON_EVENTS_INIT_FILE, array(__CLASS__, 'removeTables'));
    }


    /**
     * Unintstall function
     * 
     * @return void
     */
    public function removeTables()
    {
        global $wpdb;

        delete_option('create_events_table');

        // creates wp_awesomeness in database if not exists
        $table = $wpdb->prefix . "events";

        $sql = "DROP TABLE `$table`";

        $wpdb->query($sql);
    }
}