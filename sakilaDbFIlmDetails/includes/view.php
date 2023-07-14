<?php

function render( string $strFileName, array $arrData = [] ): void
{
    foreach( $arrData as $key => $value )
        $$key = $value;

    require_once getcwd() . '/pages/' . $strFileName . '.php';
}