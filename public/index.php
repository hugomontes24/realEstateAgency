<?php


// use App\Kernel;
// use Symfony\Component\Debug\Debug;
// use Symfony\Component\Dotenv\Dotenv;
// use Symfony\Component\HttpFoundation\Request;

// require __DIR__.'/../vendor/autoload.php';

// $environment = 'dev';
// $debugEnabled = false;
// echo 'hello';

// $oKernel = new Kernel($environment, $debugEnabled);

// $oRequest = Request::createFromGlobals();
// var_dump( $oRequest->getPathInfo() ); die();

// $oResponse = $oKernel->handle($oRequest);
// $oResponse->send();
// $oKernel->terminate($oRequest,$oResponse);






use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
