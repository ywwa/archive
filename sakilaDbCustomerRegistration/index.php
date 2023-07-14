<?php

require_once __DIR__ . '/src/includes/renderer.php';

render( "__header", ["title"=>"Add Customer"] );

render( "home" );

render( "__footer" );