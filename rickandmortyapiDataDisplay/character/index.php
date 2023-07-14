<?php

require_once __DIR__ . '/../__resources/php/render.php';

render( "__header", array( "title" => "Rick&Morty Characters" ) );

if ( count( explode("/", $_SERVER['REQUEST_URI']) ) == 2 ) {
    render( "character_list" );
    render( "__footer", array( "strMethod" => "chars" ) );

} else {
    render( "character_details" );
    render( "__footer", array( "strMethod" => "charinfo" ) );
}
