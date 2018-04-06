<?php


function view($path, $data = array()){
    if (!empty($data)) {
        extract($data);
    }

    include DIGICON_EVENTS_PLUGIN_DIR.'resources/views/'.implode('/', explode('.', $path)).'.php';

}