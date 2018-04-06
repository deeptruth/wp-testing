<?php

namespace Digicon\Listables;

/**
 *
 */
class BaseWPListTable extends \WP_List_Table
{
    /**
     * @var int
     */
    protected $limit = 10;

    /**
     * @var mixed
     */
    protected $query;

    /**
     * @inheritDoc
     */
    public function prepare_items()
    {
        //run query
        $this->query();

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();

        $this->setLimit($this->get_items_per_page('events_per_page', $this->getLimit()));

        $this->_column_headers = array($columns, $hidden, $sortable);

        $this->items = $this->data();

        $this->set_pagination_args(array(
            'total_items' => $this->countAll(), //WE have to calculate the total number of items
            'per_page' => $this->getLimit(), //WE have to determine how many items to show on a page
        ));

    }

    /**
     * @return mixed
     */
    public function data()
    {
        return $this->buildQuery()->buildLimit()->get();
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->query->get();
    }

    /**
     * Count
     *
     * @return mixed
     */
    public function count()
    {
        return $this->query->count();
    }

    /**
     * Count all for pagination
     *
     * @return mixed
     */
    public function countAll()
    {
        return $this->buildQuery()->count();
    }

    /**
     * Build query.
     *
     * @return mixed
     */
    public function buildQuery()
    {
        return $this->query()->buildSearch()->buildOrderBy();
    }

    /**
     * build order by
     *
     * @return mixed
     */
    public function buildOrderBy()
    {
        // If no sort, default to title
        $orderby = (!empty($_GET['orderby'])) ? $_GET['orderby'] : 'ID';

        // If no order, default to asc
        $order = (!empty($_GET['order'])) ? $_GET['order'] : 'asc';

        $this->query = $this->query->orderBy($orderby, $order);

        // Send final sort direction to usort
        return $this;
    }

    /**
     * build limit
     *
     * @return mixed
     */
    public function buildLimit()
    {
        $offset = 0;
        $limit = $this->getLimit();

        if (isset($_GET['paged'])) {
            $offset = ($_GET['paged'] - 1) * $this->getLimit();

            $limit = $this->getLimit();
        }

        $this->query = $this->query->skip($offset)->take($limit);

        return $this;
    }

    /**
     * Setup search
     *
     * @return mixed
     */
    public function buildSearch()
    {

        $searchableColumn = $this->searchableColumn();

        if (isset($_POST['s'])) {

            $search = $_POST['s'];

            foreach ($this->get_columns() as $key => $value) {

                if (in_array($key, $searchableColumn)) {
                    $this->query = $this->query->orWhere($key, 'LIKE', "%$search%");
                }
            }
        }

        return $this;
    }

    /**
     * Get Limit
     *
     * @return mixed
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * Set Limit
     *
     * @param $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    /**
     * @inheritDoc
     */
    public function column_default($item, $column_name)
    {
        foreach ($this->get_columns() as $key => $value) {
            if ($column_name == $key) {
                return $item[$column_name];
            }
        }

        return print_r($item, true);
    }

    /**
     * Set query property and apply scope of a class to be chain later on.
     *
     * @param $query
     * @return mixed
     */
    public function applyScope($query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Searchable columns
     * 
     * @return [type] [description]
     */
    public function searchableColumn()
    {
        return [];
    }

    /**
     * must be overidden by child class
     *
     * @return [type] [description]
     */
    public function query()
    {
        die(__METHOD__ . ' must be overidden');
    }
}