<?php

// Define app routes

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    // Redirect to Swagger documentation
    $app->get('/', \App\Action\Home\HomeAction::class)->setName('landing');
    $app->get('/terms-of-service', \App\Action\TermsOfService\TermsOfServiceAction::class)->setName('terms-of-service');

    // API
    // $app->group(
    //     '/api',
    //     function (RouteCollectorProxy $app) {
    //         $app->get('/customers', \App\Action\Customer\CustomerFinderAction::class);
    //         $app->post('/customers', \App\Action\Customer\CustomerCreatorAction::class);
    //         $app->get('/customers/{customer_id}', \App\Action\Customer\CustomerReaderAction::class);
    //         $app->put('/customers/{customer_id}', \App\Action\Customer\CustomerUpdaterAction::class);
    //         $app->delete('/customers/{customer_id}', \App\Action\Customer\CustomerDeleterAction::class);
    //     }
    // );
    $app->group(
        '/api',
        function ( RouteCollectorProxy $app )
        {
            $app->post( '/signup', \App\Action\User\SignupAction::class );
            $app->post( '/signin', \App\Action\User\SigninAction::class );
            $app->get( '/signout', \App\Action\User\SignoutAction::class );
            $app->get( '/user', \App\Action\User\UserAction::class );
        }
    );
};
