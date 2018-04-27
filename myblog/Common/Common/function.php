<?php

if(! function_exists('dd')) {
    function dd($arr, $isDie = true) {
        echo '<pre>';
        var_dump($arr);
        echo '</pre>';

        if ($isDie) {
            die;
        }
    }
}

 /**
   * 分页处理
   * @param  int     $total     总条数 
   * @param  int     $p         当前页      默认 1
   * @param  string  $pagename  分页变量    默认 p
   * @param  string  $anchor    锚点名称    默认 空
   * @param  integer $pnum      每页数据 显示多少条默认 10 条
   * @param  integer $pagenum   一次显示多少个分页 默认 5
   * @return string  $currenUrl
   */
  function page($total,$p = 1,$pnum = 6,$pagenum = 5,$currenUrl,$pagename = 'p',$anchor = ''){

        $where = [];
        foreach ($_GET as $key => $va) {
            if($key != $pagename){
                $where[]= $key .'='.$va;
            }
        }
        
        //状态保持
        $urltype = empty($where) ? (empty($currenUrl) ? '?' : $currenUrl . '&') : '?'.implode('&',$where).'&';

        //锚点
        $anchor = empty($anchor) ? '' : '#'.$anchor;

        $maxPage =  ceil($total/$pnum);

        $currentPage = $p+0 <= 0 ? 1 : ($p+0 > $maxPage ? $maxPage : $p+0);
		//$currentPage=$p;
        
        $offsetnum = $pagenum % 2 ==0 ? 1 : 0;

        $offset = floor($pagenum / 2);

        if($maxPage <= $pagenum){
            $start = 1;
            $end = $maxPage;
        }else{
            $start = $currentPage - $offset <= 0 ? 1 : $currentPage - $offset;
            $start = $start + ($offset * 2 ) - $offsetnum >= $maxPage ? $maxPage - ($offset * 2 ) + $offsetnum : $start;
            $endnum = $start + ($offset * 2 ) - $offsetnum;
            $end   = $endnum >= $maxPage ? $maxPage : $endnum;
        }

        //分页显示拼装
        $str ='<ul>';
        //第一个分页否显示 '...'
         $str .=$start > $offset ? "<ul class='cl'><li><a href='{$urltype}p=1{$anchor}'>01...</a></li>" : '<ul>';

        //主体部分分页拼装
        for($i = $start; $i <= $end; $i++){
            $i_str = $i < 10 ? '0'.$i : $i;
//			 var_dump($currentPage);
//			 var_dump($i);
//			 echo "<br>";
            $str .= $currentPage == $i ? 
                    "<li><a class='on' href='{$urltype}{$pagename}={$i}{$anchor}'>{$i_str}</a></li>" : 
                     "<li><a href='{$urltype}{$pagename}={$i}{$anchor}'>{$i_str}</a></li>";
        }

        //最后一页是否显示 '...'
         $str .=$end < $maxPage ? "<li><a href='{$urltype}{$pagename}={$maxPage}{$anchor}'>...{$maxPage}</a></li>":'';

        //拼装输入框
        
        if($maxPage > $pagenum){
                if(!empty($where)){
                    $str .="<li class='form_page'><form action='' method='get'>";
                    
                    foreach ($where as $mkey => $mvalue) {
                        $va = explode('=', $mvalue);
                        $str .="<input type='hidden' name='".$va[0]."' value='".$va[1]."'/>";
                    }
                   
                    $str .='<input class="page_input" type="text" name="'.$pagename.'"/><input type="submit" style="display:none;" /></form></li>';
                }else{
                    $urlinfo = explode('?', $currenUrl);
                    $str .="<li class='form_page'><form action='".$urlinfo[0]."?{$anchor}' method='get'>";
                    $va = explode('=', $urlinfo[1]);
                    $str .="<input type='hidden' name='".$va[0]."' value='".$va[1]."'/>";
                    $str .='<input class="page_input" type="text" name="'.$pagename.'"/><input type="submit" style="display:none;" /></form></li>';
                }
        }
        
     
       //$str .='<input class="page_input" type="text" name="'.$pagename.'" /><input type="submit" style="display:none;" /></form></li>';
        
        //下页和上一页
        $cpage = $currentPage+1;
        $str .= $currentPage<$maxPage ? "<li class='next'><a href='{$urltype}{$pagename}={$cpage}{$anchor}'><span>下一页</span><i class='icon-next'></i></a></li>":'';
        $cpage = $currentPage-1;
        $str .= $currentPage>1 ? "<li class='pre'><a href='{$urltype}{$pagename}={$cpage}{$anchor}'><span>上一页</span><i class='icon-prev'></i></a></li>":'';
        $str .= '</ul>';

        //返回处理结果
        return  $str;
    }

