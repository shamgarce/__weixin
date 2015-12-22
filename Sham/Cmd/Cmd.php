<?php

namespace Sham\Cmd;

    /*
    | --------------------------------------------------------------------------
    | AP的定义 - 对中间件进行调用和定义,执行,包括输出信息
    | --------------------------------------------------------------------------
    | 这里不对middle列表进行定义和检查,交给上层Application
    |
    */

use Sham\Set\Base;

class Cmd extends Base
{

      private $_config              = array();
      private $middlewarelist              = array();

      public function __construct($config = array()){
            $this->_config = $config;
      }
      /*
      |--------------------------------------------------------------------------
      | 执行中间件
      |--------------------------------------------------------------------------
      |            if(current($_path) == 'index.php'){
                  array_shift($_path);
      */
    public function Run($cmdstr)
    {
        return $this->Excute_ar($cmdstr);
    }

    public function Excute($cmdstr)
    {
        $ar = $this->Excute_ar($cmdstr);        //指令分析
        $vs = $ar[0];
        foreach($ar[1] as $key=>$value){
            $vs .= "\r".$value;
        }
        //返回
        return $vs;
    }

    public function Excute_ar($cmdstr)
    {
        $ar = explode(' ',$cmdstr);
        $maincmd = $cmdcs = array();
        if($ar){
            $maincmd = current($ar);
            array_shift($ar);
            $cmdcs = $ar;
        }
        $cmd[0] = $maincmd;
        $cmd[1] = $cmdcs;
        return $cmd;
    }

}


