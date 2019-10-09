<?php

namespace Project\Middleware;

class AuthMiddleware
{
    /**
     * Example middleware invokable class
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke($request, $response, $next)
    {
 
        $routeName = $request->getUri()->getPath();
        if(($routeName == '/login' || $routeName == '/') && isset($_SESSION["user"]) &&  $_SESSION["user"]){
            return $response->withRedirect('/dashboard', 301);
        }else
        if((isset($_SESSION["user"]) && $_SESSION["user"]) || 
           (($routeName == '/login') && !isset($_SESSION["user"]))  ||// Caso nao tenha o login e tentar logar
           (($routeName == '/logout')) ||
           (($routeName == '/cadastro'))
        ){
            $route = $request->getAttribute('route');
            // $name = $route->getName();
            
            $response = $next($request, $response);
            // $_SESSION['redirect_uri'] = $name;
            return $response;
        }
        return $response->withRedirect('/login', 301);
    }
}