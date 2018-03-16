<?php
namespace app\index\controller;
use think\Controller;
use think\Session;

class Index extends Controller{

	private $messageDao = null;
	function _initialize()
	{
		$this->messageDao = new \app\index\model\Message();
	}
    public function index()
    {
    	$allmsg = $this->messageDao->select();

    	$show_msg = $this->get_randmsg($allmsg);

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

    public function addform()
    {
        return view('index/addform');
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

    public function ilikethis()
    {
        $contentid = input('contentid', 0, 'strip_tags');
        if($contentid === 0)
        {
            echo json_encode(array('result'=>0));
            return;
        }

        if(Session::get('like_'.$contentid))
        {
            echo json_encode(array('result'=>-1));
            return;
        }

        $r = $this->messageDao->where("id=$contentid")->setInc('likecount');
        if($r)
        {
            $count_now = $this->messageDao->field('likecount')->where("id=$contentid")->find();
            Session::set('like_'.$contentid, 1);
            echo json_encode(array('result'=>$count_now['likecount']));
            return;
        }
    }

    public function getnew_img()
    {
        $now_url = input('now_url', '', 'strip_tags');
        $img = $this->get_randimg($now_url);
        echo json_encode($img);
        return;
    }

    public function getnew_msg()
    {
        $now_msgid = input('now_msgid', '', 'strip_tags');
        $allmsg = $this->messageDao->where("id<>$now_msgid")->select();
        $show_msg = $this->get_randmsg($allmsg);
        if($show_msg == null)
        {
            $result = array('id' => 0);
        }

        $result = $show_msg;
        $result['addtime'] = date('Y-m-d H:i', $result['addtime']);
        echo json_encode($show_msg);
        return;
    }

    private function get_randmsg($allmsg)
    {
        if(empty($allmsg))
        {
            return null;
        }

        if(count($allmsg) == 1)
        {
            return $allmsg[0];
        }

        $rand_arr = array();
        foreach ($allmsg as $key => $o) {
            $rand_arr[] = $key;
            if($o['likecount']>10)
            {
                $rand_arr[] = $key;
            }
            if($o['likecount']>50)
            {
                $rand_arr[] = $key;
            }
            if($o['likecount']>100)
            {
                $rand_arr[] = $key;
            }
            if($o['likecount']>500)
            {
                $rand_arr[] = $key;
            }
        }

        $randindex = rand(0, count($rand_arr)-1);
        $result = $allmsg[$rand_arr[$randindex]];
        if(empty($result['bgimg']))
        {
            $bgimg = $this->get_randimg();
            $result['bgimg'] = $bgimg['url'];
        }
        return $result;
    }

    private function get_randimg($now_url = null)
    {
        $mimgDao = new \app\index\model\Mimg();

        if($now_url == null)
        {
            $allimg = $mimgDao->select();
        }
        else
        {
            $allimg = $mimgDao->where("url<>'$now_url'")->select();
        }
        if(empty($allimg))
        {
            return '';
        }
        $randindex = rand(0, count($allimg)-1);
        return $allimg[$randindex];
    }
}
