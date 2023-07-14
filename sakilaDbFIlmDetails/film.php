<?php

require_once __DIR__ . '/includes/view.php';

render( "__header", ['title' => "Film: "]);

render( "filmBody" );

render( "__footer" );