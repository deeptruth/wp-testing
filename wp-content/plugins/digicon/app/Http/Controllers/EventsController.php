<?php

namespace Digicon\Http\Controllers;

use Digicon\Models\Event;
use Digicon\Listables\EventListTable;

/**
 *
 */
class EventsController
{
    /**
     * Bootstrap plugin dependencies
     *
     * @return  $this
     */
    public function make()
    {
        add_action('admin_menu', array($this, 'buildMenu'));

        add_action('set-screen-option', array($this, 'test_table_set_option'), 10, 3);
    }

    /**
     * Build Menu
     *
     * @return void
     */
    public function buildMenu()
    {
        $menu = add_menu_page(__('Digicon Events', 'events'), 'Digicon Event', 'administrator', 'digicon-events', array($this, 'registerGetActions'), 'dashicons-calendar');

        add_action("load-$menu", array($this, 'addOptions'));

        //Create and Save Form
        $add = add_submenu_page(
            'digicon-events',
            __('Create', 'create-event'),
            __('Create', 'create-event'),
            'administrator',
            'create-event',
            array($this, 'createView')
        );

        add_action("load-$add", array($this, 'storeEvent'));

        //Edit and Update
        $edit = add_submenu_page(
            'digicon-events',
            '',
            '',
            'administrator',
            'edit-event',
            array($this, 'editView')
        );

        add_action("load-$edit", array($this, 'updateEvent'));

        //Delete confirmation and delete
        $delete = add_submenu_page(
            'digicon-events',
            '',
            '',
            'administrator',
            'delete-event',
            array($this, 'deleteConfirmationView')
        );

        add_action("load-$delete", array($this, 'deleteEvent'));
    }

    /**
     * Listing View
     *
     * @return mixed
     */
    public function registerGetActions()
    {
        $myListTable = new EventListTable();

        return view('events.list', ['myListTable' => $myListTable]);
    }

    /**
     * Create View
     *
     * @return mixed
     */
    public function createView()
    {

        return view('events.form', [
            'title' => 'Creates'
        ]);
    }

    /**
     * Edit View
     *
     * @return mixed
     */
    public function editView()
    {

        $event = Event::findOrFail($_GET['id']);

        return view('events.form', ['event' => $event, 'title' => 'Edit']);
    }

    /**
     * delete Confirmation view
     * @return [type] [description]
     */
    public function deleteConfirmationView()
    {
        $event = Event::findOrFail($_GET['id']);

        return view('events.delete_confirmation', ['event' => $event]);
    }

    /**
     * Store Event
     *
     * @return Digicon\Models\Event $event
     */
    public function storeEvent()
    {
        if (!isset($_POST['submit'])) {
            return;
        }

        $event = new Event($_POST);

        $event->save();

        wp_redirect(self_admin_url('admin.php?page=digicon-events&id=' . $event->id));

        return $event;
    }

    /**
     * Update Event
     *
     * @return Digicon\Models\Event $event
     */
    public function updateEvent()
    {

        if (!isset($_POST['submit']) && !isset($_POST['id'])) {
            return;
        }

        $event = Event::findOrFail($_POST['id']);

        $event->fill($_POST);

        $event->save();

        wp_redirect(self_admin_url('admin.php?page=edit-event&action=edit&id=' . $event->id));

        return $event;
    }

    /**
     * Update Event
     *
     * @return Digicon\Models\Event $event
     */
    public function deleteEvent()
    {

        if (!isset($_POST['submit']) && !isset($_POST['id'])) {
            return;
        }

        $event = Event::findOrFail($_POST['id']);

        $event->delete();

        wp_redirect(self_admin_url('admin.php?page=digicon-events'));

        return $event;
    }

    /**
     * [addOptions description]
     */
    public function addOptions()
    {
        $option = 'per_page';
        $args = array(
            'label' => 'Events',
            'default' => 2,
            'option' => 'events_per_page',
        );

        add_screen_option($option, $args);
    }

    /**
     * @inheritDoc
     */
    public function test_table_set_option($status, $option, $value)
    {
        return $value;
    }
}
