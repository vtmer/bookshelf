<?php

class Verify extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index($uid,$activationkey)
	{
		$this->user_model->activate($uid);
		$activationkey_db = $this->user_model->get_active($uid);
		if($activationkey == $activationkey_db)
		{
			$content = "<p>至 ".$this->session->userdata('truename').":</p>
			<p>&nbsp&nbsp你好，欢迎加入 工大书架 ，这是一个致力于让广工的同学们快捷放心的借到教材书的平台。<p/>
			<p>&nbsp&nbsp在这里，你可以轻松查看自己下学期所需要的的教材，然后系统会主动向您推送适合的借书人。<p/>
			<p>当然，你还可以直接搜索教材名称，找到自己想要的教材，然后进行借书。<p/>
			<p>&nbsp&nbsp同时，为了让更多的同学可以借到想要的书，请您将自己手头多余或者不需要的教材进行网上捐书，<p/>
			<p>你所捐的书将为我们广工学子们共同所有，在一届一届中交接下去，你更可以在书籍中夹入自己的心语、对学习的建议，<p/>
			<p>让更多的师弟师妹能够感受到我们广工师兄师姐的关怀和我们广工人之间的团结互助。<p/>
			<p>而且，如果你觉得 工大书架 的确可以帮助到学生解决问题，请将它进行推广，只有更多的人加入进来，我们借书的渠道<p/>
			<p>和数量才会更加宽广，同学们借书才会更加轻松和保障。或者，如果你对我们有什么建议，请在网页下方点击留言，联系我们。<p/>
			<p>&nbsp&nbsp感谢你对本书架的支持，希望你可以愉快地借到所需要的教材！<p/>
			<p>&nbsp&nbsp谢谢!<p/>
			 <br/>                                                    
			<p>&nbsp&nbsp--数字中心&维生数工作室<p/>
			";
			$this->user_model->send_sys_msg($uid,$content);
			$this->session->unset_userdata('username');//从session删除用户名
			echo "<script>alert('验证成功！');</script>";
		}
		$this->user_model->activate($uid);
		redirect('login','refresh');
	}

	/*  利用jq在views页面显示提示信息
	private json_response($issuccessful,$message)
	{
		return json_encode(array(
			   'issuccessful' => $issuccessful,
			   'message' => $message
		   ));	
	}
	*/

	//判断是否为登陆状态
	private function is_logged_in()
	{
		return $this->session->userdata('is_logged_in');
	}
}

/*End of file verify.php*/
