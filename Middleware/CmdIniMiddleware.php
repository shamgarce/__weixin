<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/22 0022
 * Time: 13:07
 */


namespace Middleware;

use Grace\Set\MiddlewareBase;
use Grace\Set\MiddlewareInterface;

class CmdIniMiddleware extends MiddlewareBase implements MiddlewareInterface
{


    /*
    |--------------------------------------------------------
    | 定义 中间件主体
    |--------------------------------------------------------
    | 命令初始化 分为主命令和参数
    */
    public function handle($request, \Closure $next)
    {
        // Perform action

        $ar = explode(' ',$request);
        $maincmd = $cmdcs = array();

        if($ar){
            $maincmd = current($ar);
            array_shift($ar);
            $cmdcs = $ar;
        }

        $cmd['command']     = $maincmd;
        $cmd['params']      = $cmdcs;
        $cmd['terminate']   = false;         //

        $request = $cmd;
        return $next($request);
    }

}
