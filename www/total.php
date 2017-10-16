<?php
include 'conn.php';

$json ="";
$data =array(); //定义好一个数组.PHP中array相当于一个数据字典.
//定义一个类,用到存放从数据库中取出的数据.
class Map
{

//总数
public $t_count ;
public $t_new_count;
public $t_resolv_count;
public $t_close_count ;

}


	
$sql ="select CONVERT('总数统计' USING utf8) as u_total,(SELECT COUNT(1) from zt_bug WHERE `status`='active') as t_active,
(SELECT COUNT(1) from zt_bug WHERE `status`='resolved') as t_resolved,
(SELECT COUNT(1) from zt_bug WHERE `status`='closed') as t_closed,
CONVERT('陈娟' USING utf8) as u_cj,(SELECT COUNT(1) from zt_bug WHERE openedBy='chenjuan1' and `status`='active') as cj_active,
(SELECT COUNT(1) from zt_bug WHERE openedBy='chenjuan1' and `status`='resolved') as cj_resolved,
(SELECT COUNT(1) from zt_bug WHERE openedBy='chenjuan1' and `status`='closed') as cj_closed,
CONVERT('王茜' USING utf8) as u_wx,(SELECT COUNT(1) from zt_bug WHERE openedBy='wangxi' and `status`='active') as wx_active,
(SELECT COUNT(1) from zt_bug WHERE openedBy='wangxi' and `status`='resolved') as wx_resolved,
(SELECT COUNT(1) from zt_bug WHERE openedBy='wangxi' and `status`='closed') as wx_closed,
CONVERT('杨倩倩' USING utf8) as u_yqq,(SELECT COUNT(1) from zt_bug WHERE openedBy='yangqianqian' and `status`='active') as yqq_active,
(SELECT COUNT(1) from zt_bug WHERE openedBy='yangqianqian' and `status`='resolved') as yqq_resolved,
(SELECT COUNT(1) from zt_bug WHERE openedBy='yangqianqian' and `status`='closed') as yqq_closed,
CONVERT('刘燕' USING utf8) as u_ly,(SELECT COUNT(1) from zt_bug WHERE openedBy='liuyan' and `status`='active') as ly_active,
(SELECT COUNT(1) from zt_bug WHERE openedBy='liuyan' and `status`='resolved') as ly_resolved,
(SELECT COUNT(1) from zt_bug WHERE openedBy='liuyan' and `status`='closed') as ly_closed,
CONVERT('李祯' USING utf8) as u_lz,(SELECT COUNT(1) from zt_bug WHERE openedBy='lizhen' and `status`='active') as lz_active,
(SELECT COUNT(1) from zt_bug WHERE openedBy='lizhen' and `status`='resolved') as lz_resolved,
(SELECT COUNT(1) from zt_bug WHERE openedBy='lizhen' and `status`='closed') as lz_closed,
CONVERT('彭艳俊' USING utf8) as u_pyj,(SELECT COUNT(1) from zt_bug WHERE openedBy='pengyanjun' and `status`='active') as pyj_active,
(SELECT COUNT(1) from zt_bug WHERE openedBy='pengyanjun' and `status`='resolved') as pyj_resolved,
(SELECT COUNT(1) from zt_bug WHERE openedBy='pengyanjun' and `status`='closed') as pyj_closed,
CONVERT('刘超' USING utf8) as u_lc,(SELECT COUNT(1) from zt_bug WHERE openedBy='liuchao' and `status`='active') as lc_active,
(SELECT COUNT(1) from zt_bug WHERE openedBy='liuchao' and `status`='resolved') as lc_resolved,
(SELECT COUNT(1) from zt_bug WHERE openedBy='liuchao' and `status`='closed') as lc_closed,
CONVERT('李舒燕' USING utf8) as u_lsy,(SELECT COUNT(1) from zt_bug WHERE openedBy='lishuyan' and `status`='active') as lsy_active,
(SELECT COUNT(1) from zt_bug WHERE openedBy='lishuyan' and `status`='resolved') as lsy_resolved,
(SELECT COUNT(1) from zt_bug WHERE openedBy='lishuyan' and `status`='closed') as lsy_closed,
CONVERT('许媛' USING utf8) as u_xy,(SELECT COUNT(1) from zt_bug WHERE openedBy='xuyuan' and `status`='active') as xy_active,
(SELECT COUNT(1) from zt_bug WHERE openedBy='xuyuan' and `status`='resolved') as xy_resolved,
(SELECT COUNT(1) from zt_bug WHERE openedBy='xuyuan' and `status`='closed') as xy_closed,
CONVERT('徐爽' USING utf8) as u_xs,(SELECT COUNT(1) from zt_bug WHERE openedBy='xushuang' and `status`='active') as xs_active,
(SELECT COUNT(1) from zt_bug WHERE openedBy='xushuang' and `status`='resolved') as xs_resolved,
(SELECT COUNT(1) from zt_bug WHERE openedBy='xushuang' and `status`='closed') as xs_closed"; //往返h5/app/微信bug总数、个人bug统计

	//echo "$sql  <br><br>";
	 
	$result = mysql_query($sql);//执行SQL

	
	
	//
	while ($row= mysql_fetch_array($result, MYSQL_ASSOC))
	{
	//总数	
	$map =new Map();
	$map->t_new_count = $row["t_active"];
	$map->t_resolv_count = $row["t_resolved"];
	$map->t_close_count = $row["t_closed"];
	$map->t_count = $row["t_active"]+$row["t_resolved"]+$row["t_closed"];
	//陈娟
	$map->cj_new_count = $row["cj_active"];
	$map->cj_resolv_count = $row["cj_resolved"];	
	$map->cj_close_count = $row["cj_closed"];
	$map->cj_count = $row["cj_active"]+$row["cj_resolved"]+$row["cj_closed"];
	//王茜
	$map->wx_new_count = $row["wx_active"];
	$map->wx_resolv_count = $row["wx_resolved"];	
	$map->wx_close_count = $row["wx_closed"];
	$map->wx_count = $row["wx_active"]+$row["wx_resolved"]+$row["wx_closed"];
	//杨倩倩
	$map->yqq_new_count = $row["yqq_active"];
	$map->yqq_resolv_count = $row["yqq_resolved"];	
	$map->yqq_close_count = $row["yqq_closed"];
	$map->yqq_count = $row["yqq_active"]+$row["yqq_resolved"]+$row["yqq_closed"];
	//刘燕
	$map->ly_new_count = $row["ly_active"];
	$map->ly_resolv_count = $row["ly_resolved"];	
	$map->ly_close_count = $row["ly_closed"];
	$map->ly_count = $row["ly_active"]+$row["ly_resolved"]+$row["ly_closed"];
	//李祯
	$map->lz_new_count = $row["lz_active"];
	$map->lz_resolv_count = $row["lz_resolved"];	
	$map->lz_close_count = $row["lz_closed"];
	$map->lz_count = $row["lz_active"]+$row["lz_resolved"]+$row["lz_closed"];
	//彭艳俊
	$map->pyj_new_count = $row["pyj_active"];
	$map->pyj_resolv_count = $row["pyj_resolved"];	
	$map->pyj_close_count = $row["pyj_closed"];
	$map->pyj_count = $row["pyj_active"]+$row["pyj_resolved"]+$row["pyj_closed"];
	//刘超
	$map->lc_new_count = $row["lc_active"];
	$map->lc_resolv_count = $row["lc_resolved"];	
	$map->lc_close_count = $row["lc_closed"];
	$map->lc_count = $row["lc_active"]+$row["lc_resolved"]+$row["lc_closed"];
	//李舒燕
	$map->lsy_new_count = $row["lsy_active"];
	$map->lsy_resolv_count = $row["lsy_resolved"];	
	$map->lsy_close_count = $row["lsy_closed"];
	$map->lsy_count = $row["lsy_active"]+$row["lsy_resolved"]+$row["lsy_closed"];
	//许媛
	$map->xy_new_count = $row["xy_active"];
	$map->xy_resolv_count = $row["xy_resolved"];	
	$map->xy_close_count = $row["xy_closed"];
	$map->xy_count = $row["xy_active"]+$row["xy_resolved"]+$row["xy_closed"];
	//徐爽
	$map->xs_new_count = $row["xs_active"];
	$map->xs_resolv_count = $row["xs_resolved"];	
	$map->xs_close_count = $row["xs_closed"];
	$map->xs_count = $row["xs_active"]+$row["xs_resolved"]+$row["xs_closed"];
	//其他人
	$map->o_new_count = $row["t_active"]-($row["cj_active"]+$row["wx_active"]+$row["yqq_active"]+$row["ly_active"]+$row["lz_active"]+$row["pyj_active"]+$row["xs_active"]+$row["lc_active"]+$row["lsy_active"]);
	$map->o_resolv_count = $row["t_resolved"]-($row["cj_resolved"]+$row["wx_resolved"]+$row["yqq_resolved"]+$row["ly_resolved"]+$row["lz_resolved"]+$row["pyj_resolved"]+$row["xs_resolved"]+$row["lc_resolved"]+$row["lsy_resolved"]);	
	$map->o_close_count = $row["t_closed"]-($row["cj_closed"]+$row["wx_closed"]+$row["yqq_closed"]+$row["ly_closed"]+$row["lz_closed"]+$row["pyj_closed"]+$row["xs_closed"]+$row["lc_closed"]+$row["lsy_closed"]);
	$map->o_count = ($row["t_active"]+$row["t_resolved"]+$row["t_closed"])-(($row["cj_active"]+$row["cj_resolved"]+$row["cj_closed"])+($row["wx_active"]+$row["wx_resolved"]+$row["wx_closed"])+($row["yqq_active"]+$row["yqq_resolved"]+$row["yqq_closed"])+($row["ly_active"]+$row["ly_resolved"]+$row["ly_closed"])+($row["lz_active"]+$row["lz_resolved"]+$row["lz_closed"])+( $row["pyj_active"]+$row["pyj_resolved"]+$row["pyj_closed"])+($row["xs_active"]+$row["xs_resolved"]+$row["xs_closed"])+($row["lc_active"]+$row["lc_resolved"]+$row["lc_closed"])+($row["lsy_active"]+$row["lsy_resolved"]+$row["lsy_closed"]));		
	$data[]=$map;
	}


//$json = json_encode($data,JSON_UNESCAPED_UNICODE);//把数据转换为JSON数据.
$json = json_encode($data);//把数据转换为JSON数据.
//echo "{".'"priv"'.":".$json."}";
echo "$json";
?>
