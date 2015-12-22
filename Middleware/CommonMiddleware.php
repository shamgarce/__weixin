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

class CommonMiddleware extends MiddlewareBase implements MiddlewareInterface
{


    /*
    |--------------------------------------------------------
    | 定义 中间件主体
    |--------------------------------------------------------
    | 命令初始化 分为主命令和参数
    */
    public function handle($request, \Closure $next)
    {
        /*
         *  ? help
         * list     列表
         * cd       更改
         * create   创建
         * delete   删除
         * path     查看
         */
        // Perform action
        $mc = trim($request['command']);
        switch($mc){
            case 'list':
                $request['data'] = 'dolist';
                $request['terminate'] = true;       //终止标记
                break;
            case 'create':
                $request['data'] = 'docreate';
                $request['terminate'] = true;       //终止标记
                break;
            case 'delete':
                $request['data'] = 'dodelete';
                $request['terminate'] = true;       //终止标记
                break;
            case 'path':
                $request['data'] = 'dopath';
                $request['terminate'] = true;       //终止标记
                break;
            case '?':
            case 'help':
                $request['data'] = '?help';
                $request['terminate'] = true;       //终止标记
                break;
            case 'cd':
                $request['data'] = 'docd';
                $request['terminate'] = true;       //终止标记
                break;
            default:
                break;
        }

        return $next($request);
    }

}
