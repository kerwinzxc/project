<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// |         lanfengye <zibin_5257@163.com>
// +----------------------------------------------------------------------

class Page_1 {
    
    // 分页栏每页显示的页数
    public $rollPage = 5;
    // 页数跳转时要带的参数
    public $parameter  ;
    // 分页URL地址
    public $url     =   '';
    // 默认列表每页显示行数
    public $listRows = 20;
    // 起始行数
    public $firstRow    ;
    // 分页总页面数
    protected $totalPages  ;
    // 总行数
    protected $totalRows  ;
    // 当前页数
    protected $nowPage    ;
    // 分页的栏的总页数
    protected $coolPages   ;
    // 分页显示定制
    protected $config  =    array('header'=>'条记录','prev'=>'上一页','next'=>'下一页','first'=>'第一页','last'=>'最后一页','theme'=>' %first%  %upPage%  %linkPage% %downPage% %end%');
    // 默认分页变量名
    protected $varPage;

    /**
     * 架构函数
     * @access public
     * @param array $totalRows  总的记录数
     * @param array $listRows  每页显示记录数
     * @param array $parameter  分页跳转的参数
     */
    public function __construct($totalRows,$listRows='',$parameter='',$url='') {
        $this->totalRows    =   $totalRows;
        $this->parameter    =   $parameter;
        $this->varPage      =   C('VAR_PAGE') ? C('VAR_PAGE') : 'p' ;
        if(!empty($listRows)) {
            $this->listRows =   intval($listRows);
        }
        $this->totalPages   =   ceil($this->totalRows/$this->listRows);     //总页数
        $this->coolPages    =   ceil($this->totalPages/$this->rollPage);
        $this->nowPage      =   !empty($_GET[$this->varPage])?intval($_GET[$this->varPage]):1;
        if($this->nowPage<1){
            $this->nowPage  =   1;
        }elseif(!empty($this->totalPages) && $this->nowPage>$this->totalPages) {
            $this->nowPage  =   $this->totalPages;
        }
        $this->firstRow     =   $this->listRows*($this->nowPage-1);
        if(!empty($url))    $this->url  =   $url; 
    }

    public function setConfig($name,$value) {
        if(isset($this->config[$name])) {
            $this->config[$name]    =   $value;
        }
    }

    /**
     * 分页显示输出
     * @access public
     */
    public function show($param=null) {
        if(0 == $this->totalRows) return '';
        $p              =   $this->varPage;
        $nowCoolPage    =   ceil($this->nowPage/$this->rollPage);
        // 分析分页参数
        if($this->url){
            $depr       =   C('URL_PATHINFO_DEPR');
            if(defined("ADMIN_ROOT")){
                $url        =   rtrim(U(''.$this->url,'',false),$depr).'__PAGE__';
            }else{
                $url        =   rtrim(U2(''.$this->url,'',false),$depr).'__PAGE__';
            }
        }else{
            if($this->parameter && is_string($this->parameter)) {
                parse_str($this->parameter,$parameter);
            }elseif(is_array($this->parameter)){
                $parameter      =   $this->parameter;
            }elseif(empty($this->parameter)){
                unset($_GET[C('VAR_URL_PARAMS')]);
                $var =  !empty($_POST)?$_POST:$_GET;
                if(empty($var)) {
                    $parameter  =   array();
                }else{
                    $parameter  =   $var;
                }
            }
           
            $parameter[$p]  =   '__PAGE__';
            if(defined("ADMIN_ROOT")){
                $url            =   U('',$parameter);
            }else{
                $url            =   U2('',$parameter);
            }
        }
        //上下翻页字符串
        $upRow          =   $this->nowPage-1;
        $downRow        =   $this->nowPage+1;
        if ($upRow>0){
            if($param){
            	if(is_array($param)){
            		$params = array();
            		foreach ($param as $k => $v){
            			$params[] = $k."=".$v;
            		}
            		$param = implode("&",$params);
            	}else{
            		$param = "keyword=".$param;
            	}
                $upPage     =   "<a href='".str_replace('__PAGE__',$upRow,$url).".html?".$param."'>".$this->config['prev']."</a>";
            }else{
                $upPage     =   "<a href='".str_replace('__PAGE__',$upRow,$url).".html'>".$this->config['prev']."</a>";
            }
                
        }else{
            $upPage     =   '';
        }

        if ($downRow <= $this->totalPages){
            if($param){
                $downPage   =   "<a href='".str_replace('__PAGE__',$downRow,$url).".html?keyword=".$param."'>".$this->config['next']."</a>";
            }else{
                $downPage   =   "<a href='".str_replace('__PAGE__',$downRow,$url).".html'>".$this->config['next']."</a>";
                
            }
        }else{
            $downPage   =   '';
        }
        // << < > >>
        if($nowCoolPage == 1){
            $theFirst   =   '';
            $prePage    =   '';
        }else{
            $preRow     =   $this->nowPage-$this->rollPage;
            if($param){
                $theFirst   =   "<a href='".str_replace('__PAGE__',1,$url).".html?keyword=".$param."' >".$this->config['first']."</a>";
            }else{
                $theFirst   =   "<a href='".str_replace('__PAGE__',1,$url).".html' >".$this->config['first']."</a>";
            }
        }
        if($nowCoolPage == $this->coolPages){
            $nextPage   =   '';
            $theEnd     =   '';
        }else{
            $nextRow    =   $this->nowPage+$this->rollPage;
            $theEndRow  =   $this->totalPages;
            if($param){
                $theEnd     =   "<a href='".str_replace('__PAGE__',$theEndRow,$url).".html?keyword=".$param."' >".$this->config['last']."</a>";
            }else{
                $theEnd     =   "<a href='".str_replace('__PAGE__',$theEndRow,$url).".html' >".$this->config['last']."</a>";
            }
        }
        // 1 2 3 4 5
        $linkPage = "";
        for($i=1;$i<=$this->rollPage;$i++){
            $page       =   ($nowCoolPage-1)*$this->rollPage+$i;
            if($page!=$this->nowPage){
                if($page<=$this->totalPages){
                    if($param){
                        $linkPage .= "<a href='".str_replace('__PAGE__',$page,$url).".html?keyword=".$param."'>".$page."</a>";
                    }else{
                        $linkPage .= "<a href='".str_replace('__PAGE__',$page,$url).".html'>".$page."</a>";
                    }
                }else{
                    break;
                }
            }else{
                if($this->totalPages != 1){
                    $linkPage .= "<span class='current'>".$page."</span>";
                }
            }
        }
        $pageStr     =   str_replace(
            array('%header%','%nowPage%','%totalRow%','%totalPage%','%upPage%','%downPage%','%first%','%prePage%','%linkPage%','%nextPage%','%end%'),
            array($this->config['header'],$this->nowPage,$this->totalRows,$this->totalPages,$upPage,$downPage,$theFirst,$prePage,$linkPage,$nextPage,$theEnd),$this->config['theme']);
        return $pageStr;
    }

}
