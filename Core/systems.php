<?php
// function checkControllerName(string $name)
// {
//     return (bool)preg_match('/^[a-z0-9_]+$/', $name);
// } 
// не нужен

function render(string $path, array $vars = []): string
{
    extract($vars);
    ob_start();
    include("views/$path.php");
    return ob_get_clean();
}

function header403()
{
    $protocolHttp = $_SERVER['SERVER_PROTOCOL'];
    return header("$protocolHttp 403 Forbidden");
}

function header404()
{
    $protocolHttp = $_SERVER['SERVER_PROTOCOL'];
    return header("$protocolHttp 404 Not Found");
}

function header301()
{
    $protocolHttp = $_SERVER['SERVER_PROTOCOL'];
    return header("$protocolHttp 301 Moved Permanently");
}


function parseUrl(string $url,  array $routes): array
{
    $res = [
        'controller' => 'errors/e404',
        'params' => []

    ];
    foreach ($routes as $route) {
        $matches = [];
        if (preg_match($route['pattern'], $url, $matches)) {
            $res['controller'] = $route['controller'];
            if (isset($route['params'])) {
                foreach ($route['params'] as $name => $num) {
                    $res['params'][$name] = $matches[$num];
                }
            }
            break;
        }
    }
    //  find route, parse params
    return $res;
}

function hasDoubleSlashes(string $uri): bool
{
    $pattern = '/\/{2,}/';
    return !!preg_match($pattern, $uri);
}

//отделить базовую часть url от части с GET параметрами
function getUriParts(string $uri): array
{
    $parts = explode('?', $uri);
    return [
        'url' => $parts[0] ?? '',
        'get' => $parts[1] ?? ''
    ];
}

function getUrl()
{
    $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $url = explode('?', $url);
    return $url = $url[0];
}

function selectOption(int $selector, int $option)
{
    if ($selector == $option)
        return "selected";
}
