<?php 
namespace Home\Model;
use Think\Model;

class TypeModel extends \Think\Model
{
	public function getTypelist($currentPage,$map=[])
	{
		$list = $this->where($map)->page($currentPage,6)
                ->order('concat(path,"-",id) asc')
                ->select();
        foreach($list as $k => &$v)
        {
            //计算下-的个数
           $countG = substr_count($v['path'],'-') +1;
           $v['name'] = str_repeat('&nbsp',($countG-1)*4).'|--'.$v['name'];
        }
        
        return $list;
	}

	//根据id拿name值
	public function getNameById($id)
	{
		return $this->where(["id"=>$id])->getField("name");
	}

	//获取分页总数
	public function getTypeTotal($map=[])
	{
		return $this->where($map)->count();
	}

	//获取所有分类
	public function getAllType()
	{
		$list = $this->where(["is_delete"=>0])
				->order("concat(path,"-",id) asc")->select();
		foreach ($list as $k => &$v) {
			//计算下-的个数
           $countG = substr_count($v['path'],'-') +1;
           $v['name'] = str_repeat('&nbsp',($countG-1)*4).'|--'.$v['name'];
		}
		return $list;
	}

	//根据pid拿到path的值
	public function getPidPath($pid)
	{
		return $this->where(["id"=>$pid])->getField("path");
	}


}