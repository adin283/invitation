<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

	private $_title = "我们结婚啦！-李雷 & 韩梅梅";

    public function index() {
		$this->assign("title", $this->_title);
        $this->display("index");
    }

	public function detail() {
		//0 新郎，1 新娘
		$type = I("type", 0);
		$tag = I("tag", 1);

		if ($type == 0) {
			$time = "17点00分";
			$hotelName = "xx大酒店";
			$hotelAddress = "浙江省杭州市xxxx";
			$mapAddress= "杭州近郊建德市";
		} else {
			$time = "11点28分";
			$hotelName = "xxx大酒店";
			$hotelAddress = "浙江省xxxxx";
			$mapAddress= "龙洲街道";
		}

		//获取用户上传的照片
		$livePic = M("UploadPic")->order("ctime DESC")->select();
		$this->assign("livePic", $livePic);

		//获取婚纱照
		$weddingPhoto = M("WeddingPhoto")->order("order_id ASC")->select();
		$this->assign("weddingPhoto", $weddingPhoto);

		//获取祝福
		$commentList = M("Comment")->order("ctime DESC")->select();
		//替换表情
		foreach ($commentList as $key => $value) {
			$commentList[$key]["content"] = $this->_parseContent($commentList[$key]["content"]);
		}
		$this->assign("commentList", $commentList);

		$this->assign("type", $type);
		$this->assign("tag", $tag);
		$this->assign("time", $time);
		$this->assign("hotelName", $hotelName);
		$this->assign("hotelAddress", $hotelAddress);
		$this->assign("mapAddress", $mapAddress);
		$this->assign("title", $this->_title);

		$presentMap = array(
			0 => "新郎方",
			1 => "新娘方",
			2 => "两方都出席"
		);
		$this->assign("presentMap", $presentMap);

		$this->display("detail");
	}

	public function upload() {
		//获取上传者IP地址
		$ipAddress = get_client_ip(1, true);

		$rootPath = PUBLIC_PATH . "images/upload/";
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =     10485760 ;// 设置附件上传大小单位字节，10M
		$upload->exts      =     array("jpg", "jpeg");// 设置附件上传类型
		$upload->rootPath  =     $rootPath; // 设置附件上传根目录
		$upload->savePath  =     ""; // 设置附件上传（子）目录
		// 上传文件
		$info   =   $upload->uploadOne($_FILES["upfile"]);

		if(!$info) {// 上传错误提示错误信息
			$this->error($upload->getError());
		}else{// 上传成功
			//上传成功数据写入数据库
			$path = str_replace('.', '', $rootPath) . $info["savepath"] . $info["savename"];
			$data = array(
				"ctime"			=> date("Y-m-d H:i:s"),
				"pic_path"		=> $path,
				"ip_address"	=> $ipAddress
			);
			M("UploadPic")->add($data);
			$this->success("上传成功！");
		}
	}

	public function comment() {
		$name = I("name", "游客");
		$replyNum = I("reply_num", 1);
		$content = I("content", "");
		$presentAddress = I("present_address", 0);
		$ipAddress = get_client_ip(1, true);

		$data = array(
			"ctime"				=> date("Y-m-d H:i:s"),
			"name" 				=> $name,
			"reply_num"			=> $replyNum,
			"present_address"	=> $presentAddress,
			"content"			=> $content,
			"ip_address"		=> $ipAddress
		);

		$result = M("Comment")->add($data);
		if ($result > 0) {
			$this->success("发表成功！", "/home/Index/detail/tag/3", 1);
		} else {
			$this->error("发表失败！", "/home/Index/detail/tag/3", 3);
		}

	}

	private function _parseContent($content) {
		$map = array(
			"[爱情]" => '<img src="' . C('IMAGES_PATH') .'expression/aiqing.png" alt="爱情">',
			"[蛋糕]" => '<img src="' . C('IMAGES_PATH') .'expression/dangao.png" alt="蛋糕">',
			"[发财]" => '<img src="' . C('IMAGES_PATH') .'expression/facai.png" alt="发财">',
			"[给力]" => '<img src="' . C('IMAGES_PATH') .'expression/geili.gif" alt="给力">',
			"[恭喜]" => '<img src="' . C('IMAGES_PATH') .'expression/gongxi.png" alt="恭喜">',
			"[鼓掌]" => '<img src="' . C('IMAGES_PATH') .'expression/guzhang.gif" alt="鼓掌">',
			"[坏笑]" => '<img src="' . C('IMAGES_PATH') .'expression/huaixiao.gif" alt="坏笑">',
			"[婚纱]" => '<img src="' . C('IMAGES_PATH') .'expression/hunsha.png" alt="婚纱">',
			"[婚鞋]" => '<img src="' . C('IMAGES_PATH') .'expression/hunxie.png" alt="婚鞋">',
			"[脚印]" => '<img src="' . C('IMAGES_PATH') .'expression/jiaoyin.png" alt="脚印">',
			"[礼花]" => '<img src="' . C('IMAGES_PATH') .'expression/lihua.png" alt="礼花">',
			"[玫瑰]" => '<img src="' . C('IMAGES_PATH') .'expression/meigui.png" alt="玫瑰">',
			"[闪电]" => '<img src="' . C('IMAGES_PATH') .'expression/shandian.png" alt="闪电">',
			"[帅]" => '<img src="' . C('IMAGES_PATH') .'expression/shuai.png" alt="帅">',
			"[喜庆]" => '<img src="' . C('IMAGES_PATH') .'expression/xiqing.png" alt="喜庆">',
			"[携手]" => '<img src="' . C('IMAGES_PATH') .'expression/xieshou.gif" alt="携手">',
			"[心形]" => '<img src="' . C('IMAGES_PATH') .'expression/xinxing.png" alt="心形">',
			"[心意]" => '<img src="' . C('IMAGES_PATH') .'expression/xinyi.png" alt="心意">',
			"[信]" => '<img src="' . C('IMAGES_PATH') .'expression/xin.gif" alt="信">',
			"[钻戒]" => '<img src="' . C('IMAGES_PATH') .'expression/zuanjie.png" alt="钻戒">',
			"[棒棒糖]" => '<img src="' . C('IMAGES_PATH') .'expression/bangbangtang.png" alt="棒棒糖">',
			"[气球]" => '<img src="' . C('IMAGES_PATH') .'expression/qiqiu.png" alt="气球">',
			"[飞机]" => '<img src="' . C('IMAGES_PATH') .'expression/feiji.png" alt="飞机">',
			"[钞票]" => '<img src="' . C('IMAGES_PATH') .'expression/chaopiao.png" alt="钞票">'
		);

		foreach ($map as $key => $value) {
			$content = str_replace($key, $value, $content);
		}
		return $content;
	}
}