<?php

require_once __DIR__ . '/includes/view.php';

render('__header', ['title'=>'localhost']);

render("home");

render( '__footer' );