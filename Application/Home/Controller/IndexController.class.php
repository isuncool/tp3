<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{

    //http://workerman.com/home/index/index
    public function index()
    {
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }

    //http://workerman.com/home/index/test
    //多语言请求路径 http://workerman.com/home/index/test?l=en-us
    public function test()
    {
        header('X-Powered-By: PHP/7.4.0');
        header('Content-language: en');
        $this->display('index/index');
        //exit(__METHOD__);
    }

    //http://workerman.com/home/index/hello?id=thinkphp
    //http://workerman.com/home/index/hello/id/world
    public function hello($id)
    {
        $image = 'Hello '.$id; //数据量
        exit($image);
    }

    //http://workerman.com/home/index/download/id/world
    public function download($id)
    {
        $image = 'Hello '.$id; //数据量

        //生成下载文件
        if(file_exists("download\sitemap.123.txt")){
            unlink('"download\sitemap.123.txt"');
        }else{
            file_put_contents("download\sitemap.123.txt", $image, FILE_APPEND);
        }

        $file = 'download\sitemap.123.txt';// 文件地址是服务器保存路径，如 ./file/a.jpg
        if (!is_file($file)) {
            exit('没有文件');
        }

        sleep(1);//暂停1s

        //实现下载，可以下载大文件
        header("Content-type:application/octet-stream");
        header("Content-Disposition:attachment;filename = " . basename($file));
        header("Accept-ranges:bytes");
        header("Accept-length:" . filesize($file));
        $handle = fopen($file, 'rb');
        while (!feof($handle)) {
            echo fread($handle, 102400);
        }
        fclose($handle);
        exit();
    }

    //http://workerman.com/home/index/localFunName/
    public function localFunName(){
        exit(__METHOD__);
    }
}