<?php


function render( string $strFilename, array $arrData = [] ) : void
{
    foreach ( $arrData as $key => $value )
        $$key = $value;

    require_once __DIR__ . '/../views/' . $strFilename . '.php';
}