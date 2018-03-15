<?php
namespace app\index\controller;
use think\Controller;

class Index extends Controller{

	private $messageDao = null;
	function _initialize()
	{
		$this->messageDao = new \app\index\model\Message();
	}
    public function index()
    {
    	$allmsg = $this->messageDao->select();

    	$show_msg = null;
    	if(!empty($allmsg))
    	{
    		$randindex = rand(1, count($allmsg));
            $show_msg = $allmsg[$randindex-1];
    	}

        $show_text = '';
    	if($show_msg == null)
    	{
    		$show_text = "还没有人留言哦，你将是第一个！";
    	}

    	if($show_text != '')
    	{
    		$this->assign('show_text', $show_text);
    		return view('showtext');
    	}
    	$this->assign('show_msg', $show_msg);
        $this->assign('count', count($allmsg));

    	return view('index');
    }

    public function addmsg()
    {
        $mcontent = input('post.mcontent', '', 'strip_tags');
        $maddby = input('post.maddby', '', 'strip_tags');
        $bgimg = input('post.bgimg', '', 'strip_tags');

        if($mcontent == '')
        {
            $this->error('请输入留言内容');
        }
        if($maddby == '')
        {
            $maddby = '匿名';
        }
        $add_data = array(
            'mcontent' => $mcontent,
            'addtime' => time(),
            'maddby' => $maddby,
            'bgimg' => $bgimg);

        $r = $this->messageDao->insert($add_data);
        if($r)
        {
            $this->success('发布成功');
        }
        else
        {
            $this->error('发布失败');
        }
    }
}
