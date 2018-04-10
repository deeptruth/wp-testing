<?php

namespace Digicon\Listables;

use Digicon\Listables\BaseWPListTable;

use Digicon\Models\Event;

class EventListTable extends BaseWPListTable
{
    /**
     * @inheritDoc
     */
    public function get_columns()
    {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'action' => 'Actions',
            'code' => 'Code',
            'title' => 'Title',
        );
        return $columns;
    }

    /**
     * Query
     * 
     * @return [type] [description]
     */
    public function query()
    {
        return $this->applyScope(Event::query());
    }

    /**
     * @inheritDoc
     * 
     */
    public function get_sortable_columns()
    {
        $sortable_columns = array(
            'title' => array('title', false),
        );

        return $sortable_columns;
    }

    public function searchableColumn()
    {
        return [
            'code',
            'title'
        ];
    }

    /**
     * Mutator
     * 
     */
    public function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="book[]" value="%s" />', $item['ID']
        );
    }

    /**
     * Mutator
     * 
     */
    public function column_action($item)
    {
        return '<a href="'. self_admin_url('admin.php?page=edit-event&id='.$item->id) .'">
                    Edit
                </a> | 
                <a href="'. self_admin_url('admin.php?page=delete-event&id='.$item->id) .'">
                    Delete
                </a>';
    }
}