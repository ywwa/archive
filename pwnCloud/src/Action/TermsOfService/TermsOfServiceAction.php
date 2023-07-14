<?php

namespace App\Action\TermsOfService;

use Slim\Views\Twig;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class TermsOfServiceAction
{

    private $twig;

    public function __construct(Twig $twig)
    {
        $this->twig = $twig;
    }
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->twig->render(
            $response,
            'views/tos.twig',
            array(
                'title' => 'pwnCloud : Terms of Service'
                // 'desc' => "b\$ckup before switching"
            )
        );
    }
}
