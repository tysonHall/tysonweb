<?php
namespace app\index\controller;
use think\Controller;
use think\Session;

class Mimgmng extends Controller{

	var $big_maxwidth = 600;
	var $big_maxheight = 800;
	private $mimgDao = null;
	function _initialize()
	{
		$this->mimgDao = new \app\index\model\Mimg();
	}

	public function index()
	{
		$allimg = $this->mimgDao->select();

		$this->assign('allimg', $allimg);
		return view('index');
	}

	public function addform()
	{
		set_time_limit(0);
		if(!request()->isPost()){		
			return view('addform');
		}
		$data = array();
		$num = 0;
		$filearr = request()->file('image');
		if(count($filearr) > 9) {
			return $this->error('至多9张图片');
		}
		// ob_start();  
		// var_dump(request());  
		// $result = ob_get_clean();
		// file_put_contents('file.log', date('Y-m-d H:i:s').':'.$result."\r\n", FILE_APPEND);
		foreach($filearr as $file){
			$info = $file->validate(['ext'=>'jpg,png,gif,jpeg'])->move(ROOT_PATH . 'public' . DS . 'uploads' . DS . 'images');			

		    if($info){	
		    	$infoarr = $info->getInfo(); 
		    	//原图地址   	
				// file_put_contents('file.log', date('Y-m-d H:i:s').':'.$info->getSaveName()."\r\n", FILE_APPEND);
		        $imageurl1 = "/uploads/images/" . str_replace('\\','/',$info->getSaveName());
		        //大图详情地址
		        $imageurl3 = substr($imageurl1,0,strpos($imageurl1, '.'.$info->getExtension())) . '.' . $info->getExtension();
		        
		        $image = \think\Image::open('.'.$imageurl1);
		        //详情图片裁剪	        
		        $o_width = $image->width();
		        $o_height = $image->height();

		        $n_width = $this->big_maxwidth;
		        $rate = $o_width/$n_width;
		        $n_height = floor($o_height/$rate);
		        if($n_height > $this->big_maxheight)
		        {
		        	$n_height = $this->big_maxheight;
		        	$rate = $o_height/$n_height;
		        	$n_width = floor($o_width/$rate);
		        }
		        $image->thumb($n_width, $n_height,\think\Image::THUMB_SOUTHEAST)->save('.'.$imageurl3);

		        $data[] = array(
		        		'url'  => $imageurl3,
		        		'size'  => $infoarr['size'],
		        		'width'  => $n_width,
		        		'height'  => $n_height,
		        		'addtime'    => time(),
		        	);
		       	$num++;
		       	unset($image);
		    }else{
		        continue;
		    }
	    }
	    if($data){
	    	foreach ($data as $o) {
	    		$this->mimgDao->insert($o);
	    	}
	    	return $this->success('成功上传'.$num.'/'.count($filearr).'张图片');
	    }else{
	    	return $this->error('你没有选择图片');
	    }
		return view('addform');
	}
}