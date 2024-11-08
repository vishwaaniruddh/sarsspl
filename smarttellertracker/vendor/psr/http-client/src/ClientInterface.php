<?php

namespace<?phpPsr\Http\Client;

use<?phpPsr\Http\Message\RequestInterface;
use<?phpPsr\Http\Message\ResponseInterface;

interface<?phpClientInterface
{
<?php<?php<?php<?php/**
<?php<?php<?php<?php<?php*<?phpSends<?phpa<?phpPSR-7<?phprequest<?phpand<?phpreturns<?phpa<?phpPSR-7<?phpresponse.
<?php<?php<?php<?php<?php*
<?php<?php<?php<?php<?php*<?php@param<?phpRequestInterface<?php$request
<?php<?php<?php<?php<?php*
<?php<?php<?php<?php<?php*<?php@return<?phpResponseInterface
<?php<?php<?php<?php<?php*
<?php<?php<?php<?php<?php*<?php@throws<?php\Psr\Http\Client\ClientExceptionInterface<?phpIf<?phpan<?phperror<?phphappens<?phpwhile<?phpprocessing<?phpthe<?phprequest.
<?php<?php<?php<?php<?php*/
<?php<?php<?php<?phppublic<?phpfunction<?phpsendRequest(RequestInterface<?php$request):<?phpResponseInterface;
}
