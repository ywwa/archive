<?php

require_once __DIR__ . "/../__resources/php/render.php";

render( "__header", array( "title" => "Rick&Morty Locations" ) );

render( "location" );

render( "__footer", array( "strMethod" => "locs" ) );