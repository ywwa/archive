<?php

require_once __DIR__ . '/__resources/php/render.php';


render( '__header', array( 'title' => "Rick&Morty API" ) );

render( '__home', array(
    'heading' => "Rick&Morty API"
) );

render( '__footer', array( 'strMethod' => 'endpoints' ) );