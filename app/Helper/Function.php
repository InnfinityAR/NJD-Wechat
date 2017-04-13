<?php

require_once 'resources/org/SMS/REST.php';

use App\Http\Model\Nav;

/**
 * 根据外键到某张表中查询指定字段
 * @param int $id 外键
 * @param string $table 查询表
 * @param string $field 查询字段 默认name字段
 * 
 * @return string 
 */
function getField($value, $table, $field = "name", $condition = 'id') {
    return DB::table($table)->where($condition, $value)->pluck($field)->first();
}

/**
 * 发送短信验证码
 * 
 * @param type $to 短信接收手机号码集合,用英文逗号分开
 * @param type $datas 内容数据
 * @param type $tempId
 * @return boolean 模板Id
 */
function sendTemplateSMS($to, $datas, $tempId, $accountSid = '', $accountToken = '', $appId = '') {
    //初始化REST SDK
    $accountSid = '8a216da85b3c225d015b5ffefd3b0f57';
    $accountToken = '1997eeacb6024c7e8ebec9473e256d5e';
    $appId = '8aaf07085b5fee9a015b603c6c7f0026';

    $serverIP = 'app.cloopen.com';
    $serverPort = '8883';
    $softVersion = '2013-12-26';


    $rest = new \REST($serverIP, $serverPort, $softVersion);
    $rest->setAccount($accountSid, $accountToken);
    $rest->setAppId($appId);

    // 发送模板短信
    $result = $rest->sendTemplateSMS($to, $datas, $tempId);
    //echo "Sending TemplateSMS to $to  $result<br/>";

    if ($result == NULL) {
        //echo "result error!";
        return;
    }
    if ($result->statusCode != 0) {
        //TODO 添加错误处理逻辑
    } else {
        return true;
    }
}

/**
 * 根据权限id获取对应菜单
 * @param int $node_id 权限id
 * 
 * @retrun $string
 */
function getBackmenuByNodeId($node_id) {
    $backmenu_ids = DB::table("node_backmenu")->where("node_id", $node_id)->pluck("backmenu_id");
    $backmenus = "";
    foreach ($backmenu_ids as $backmenu_id) {
        $backmenus .= getField($backmenu_id, "backmenu") . "&nbsp;";
    }
    return $backmenus;
}

/**
 * 判断某个权限是否有某个菜单管理
 * @param type $node_id
 * @param type $backmenu_id
 */
function hasBackmenu($node_id, $backmenu_id) {
    $res = DB::table("node_backmenu")->where("node_id", $node_id)->where("backmenu_id", $backmenu_id)->first();
    if ($res) {
        return true;
    }
    return false;
}

/**
 * 根据角色id获取对应权限
 * @param int $role_id 角色id
 * 
 * @retrun $string
 */
function getNodeByRoleId($role_id) {
    $node_ids = DB::table("role_node")->where("role_id", $role_id)->pluck("node_id");
    $nodes = "";
    foreach ($node_ids as $node_id) {
        $nodes .= getField($node_id, "node") . "&nbsp;";
    }
    return $nodes;
}

/**
 * 判断某个角色是否有某个权限
 * @param type $role_id 角色id
 * @param type $node_id 权限id
 */
function hasNode($role_id, $node_id) {
    $res = DB::table("role_node")->where("node_id", $node_id)->where("role_id", $role_id)->first();
    if ($res) {
        return true;
    }
    return false;
}

/**
 * 根据用户id获取对应角色
 * @param int $user_id 用户id
 * 
 * @retrun $string
 */
function getRoleByUserId($user_id) {
    $role_ids = DB::table("role_user")->where("user_id", $user_id)->pluck("role_id");
    $roles = "";
    foreach ($role_ids as $role_id) {
        $roles .= getField($role_id, "role") . "&nbsp;";
    }
    return $roles;
}

/**
 * 判断某个用户是否有某个角色
 * @param type $role_id 角色id
 * @param type $node_id 权限id
 */
function hasRole($user_id, $role_id) {
    $res = DB::table("role_user")->where("user_id", $user_id)->where("role_id", $role_id)->first();
    if ($res) {
        return true;
    }
    return false;
}

/**
 * 下载远程图片到本地
 *
 * @param string $url 远程文件地址
 * @param string $filename 1为原文件名,0随机生成文件名
 * @param array $fileType 允许的文件类型
 * @param string $dirName 文件保存的路径（路径其余部分根据时间系统自动生成）
 * @param int $type 远程获取文件的方式
 * @return json 返回文件名、文件的保存路径
 * @author blog.snsgou.com
 */
function downloadImage($url, $dirName, $fileName = 1, $fileType = array('jpg', 'gif', 'png'), $type = 1) {
    if ($url == '') {
        return false;
    }

    // 获取文件原文件名
    $defaultFileName = basename($url);

    // 获取文件类型
    $suffix = substr(strrchr($url, '.'), 1);
    if (!in_array($suffix, $fileType)) {
        return false;
    }

    // 设置保存后的文件名
    $fileName = $fileName == 1 ? $defaultFileName : time() . rand(0, 9) . '.' . $suffix;

    // 获取远程文件资源
    if ($type) {
        $ch = curl_init();
        $timeout = 30;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $file = curl_exec($ch);
        curl_close($ch);
    } else {
        ob_start();
        readfile($url);
        $file = ob_get_contents();
        ob_end_clean();
    }

    // 设置文件保存路径
    $dirName = "." . $dirName . "/";
    if (!file_exists($dirName)) {
        mkdir($dirName, 0777, true);
    }

    // 保存文件
    $res = fopen($dirName . '/' . $fileName, 'a');
    fwrite($res, $file);
    fclose($res);

    return array(
        'fileName' => $fileName,
        'saveDir' => $dirName
    );
}

/**
 * 生成api token
 */
function getApiToken() {
    $api_key = config("api.third_api_key");
    $token = md5($api_key) . time();

    return $token;
}

function curl_post($url, $postFields) {
    //初始化curl
    $ch = curl_init();

    //参数设置
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));

    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result, true);
}

// 根据导航栏等级显示分级
function getClassification($level) {
    $string = "";

    for ($i = 0; $i < $level; $i++) {
        $string .= "—";
    }
    return $string;
}

/**
 * 把返回的数据集转换成Tree
 * @param array $list 要转换的数据集
 * @param string $pid parent标记字段
 * @param string $level level标记字段
 * @return array
 * @author jackson.xu@wemax.org
 */
function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0) {
    // 创建Tree
    $tree = array();
    if (is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] = & $list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId = $data[$pid];
            if ($root == $parentId) {
                $tree[] = & $list[$key];
            } else {
                if (isset($refer[$parentId])) {
                    $parent = & $refer[$parentId];
                    $parent[$child][] = & $list[$key];
                }
            }
        }
    }
    return $tree;
}

/**
 * @desc 面包屑导航，倒序
 * @param type $id
 */
function getCrumbs($id) {
    $crumbs = crumbs($id);
    if ($crumbs) {
        $crumbs = array_reverse($crumbs);
    }
    return $crumbs;
}

/**
 * @desc 面包屑导航
 * @param type $id
 */
function crumbs($id) {
    if (!$id) {
        return false;
    }
    static $res = array(); //静态变量  每次初始化元数据不会消失
    $info = App\Http\Model\Nav::where(["id" => $id])->first();
    $res[] = $info;
    if ($info['pid'] >= 0) {      //pid大于0  则一定是下级分类
        crumbs($info['pid']); //递归
        return $res;
    }
}

/**
 * 递归获取顶级导航栏id
 */
function getTopNavId($id) {
    $nav = Nav::where("id", $id)->first();
    if ($nav["pid"] == 0) {
        return $nav["id"];
    } else {
        return getTopNavId($nav["pid"]);
    }
}

/**
 * 递归无限级分类【先序遍历算】，获取任意节点下所有子孩子
 * @param array $arrCate 待排序的数组
 * @param int $parent_id 父级节点
 * @param int $level 层级数
 * @return array $arrTree 排序后的数组
 */
function getMenuTree($arrCat, $parent_id = 0, $level = 0) {
    static $arrTree = array(); //使用static代替global
    if (empty($arrCat))
        return false;
    $level++;
    foreach ($arrCat as $key => $value) {
        if ($value['pid'] == $parent_id) {
            $arrTree[] = $value;
            unset($arrCat[$key]); //注销当前节点数据，减少已无用的遍历
            getMenuTree($arrCat, $value['id'], $level);
        }
    }

    return $arrTree;
}

/**
 * 根据导航栏id获取对应的跳转url
 * @param int $nav_id 导航栏id
 */
function getUrl($nav_id) {
    $nav = Nav::where("id", $nav_id)->first();

    if ($nav->url) {      // 有自定义地址
        $url = "/" . $nav->url;
    } else {
        if (hasChildNav($nav_id)) {   // 存在子导航,则不跳转
            $url = "javascript:;";
        } else {      // 跳转介绍页
            $url = "/introduce/" . $nav_id;
        }
    }

    return $url;
}

/**
 * 是否存在子级分类
 */
function hasChildNav($id) {
    $data = Nav::where("pid", $id)->get();
    if (count($data) > 0) {
        return true;
    } else {
        return false;
    }
}

/**
 * 判断是否手机访问
 * 
 * @return boolean
 */
function isMobile() {
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
        return true;
    }
    //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset($_SERVER['HTTP_VIA'])) {
        //找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    }
    //脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = array(
            'nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap',
            'mobile'
        );
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return true;
        }
    }
    //协议法，因为有可能不准确，放到最后判断
    if (isset($_SERVER['HTTP_ACCEPT'])) {
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
            return true;
        }
    }
    return false;
}

/**
 * 获取客户状态
 */
function getStatus($status){
    switch ($status) {
        case 1:
            $return = "已评估";
            break;
        
        case 2:
            $return = "已申请";
            break;
        
        case 3:
            $return = "有效客户";
            break;
        
        case 4:
            $return = "无效客户";
            break;

        default:
            break;
    }
    return $return;
}