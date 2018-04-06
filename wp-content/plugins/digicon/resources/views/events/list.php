<div class="event-container" style="margin-top: 50px;width: 98%;">
    <h3>Event List</h3>
    <?php
        $myListTable->prepare_items(); 
        ?>
            <form method="post">
              <input type="hidden" name="page" value="my_list_test" />
              <?php $myListTable->search_box('search', 'search_id'); ?>
            </form>
    
        <?php
        $myListTable->display(); 
        echo '</div>'; 
    ?>
</div>