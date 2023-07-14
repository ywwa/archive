<?php

function render( string $filename, array $arrData = [] ): void
{
    foreach ($arrData as $key => $value) {
        $$key = $value;
    }

    require_once __DIR__ . '/../../__comps/' . $filename . '.php';
}