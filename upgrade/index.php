<?php
/**
 * DouPHP
 * --------------------------------------------------------------------------------------------------
 * 版权所有 2014-2015 漳州豆壳网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.douco.com
 * --------------------------------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在遵守授权协议前提下对程序代码进行修改和使用；不允许对程序代码以任何形式任何目的的再发布。
 * 授权协议：http://www.douco.com/license.html
 * --------------------------------------------------------------------------------------------------
 * Author: DouCo
 * Release Date: 2015-06-10
 */
define('IN_DOUCO', true);

require (dirname(__FILE__) . '/include/init.php');

// rec操作项的初始化
$step = $_REQUEST['step'] ? trim($_REQUEST['step']) : 'default';

// 更新后的版本
$new_version = 'v1.5 Release 20181217';

/**
 * +----------------------------------------------------------
 * 升级检测
 * +----------------------------------------------------------
 */
if ($step == 'default') {
    $title = $_LANG['douphp'] . " &rsaquo; " . $_LANG['upgrade'];
    
    // 版本号
    $ver_cur = number_format(substr($_CFG['douphp_version'], 1, 4), 1);
    
    // 历史版本
    $ver_list = array (1.0, 1.1, 1.2, 1.3, 1.5);
    
    // 根据版本显示升级提示
    foreach ($ver_list as $ver) {
        $ver = number_format($ver, 1);
        $file_txt = ROOT_PATH . U_PATH . '/data/txt/upgrade_' . $ver . '.txt';
        if ($ver >= $ver_cur && file_exists($file_txt))
            $up_txt .= file_get_contents($file_txt) . "\r\n";
    }
    
    $up_array = explode("\r\n", $up_txt);
    
    foreach ($up_array as $replace) {
        if (strstr($replace, '修正')) {
            $replace = '<i class="x">问题修复</i><em>' . $replace . '</em>';
        }
        if (strstr($replace, '增加') || strstr($replace, '新增')) {
            $replace = '<i class="z">新功能</i><em>' . $replace . '</em>';
        }
        if (strstr($replace, '优化')) {
            $replace = '<i class="y">优化</i><em>' . $replace . '</em>';
        }
        if (strstr($replace, '安全')) {
            $replace = '<i class="a">安全升级</i><em>' . $replace . '</em>';
        }
        
								if ($replace)
            $up_list[] = $replace;
    }
    
    $smarty->assign('title', $title);
    $smarty->assign('up_list', $up_list);
    $smarty->display('index.htm');
}

/**
 * +----------------------------------------------------------
 * 升级完成
 * +----------------------------------------------------------
 */
elseif ($step == 'action') {
    include_once (ROOT_PATH . U_PATH . '/action.php'); // 运行升级程序
    header("Location:index.php?step=finish");
}

/**
 * +----------------------------------------------------------
 * 升级完成
 * +----------------------------------------------------------
 */
elseif ($step == 'finish') {
    // 生成system.dou文件
    $system_file = ROOT_PATH . 'data/system.php';
    if (!file_exists($system_file)) {
        $content = '<?php' . "\r\n";
        $content .= "'\r\n";
        $content .= "column_module:product,article\r\n";
        $content .= "single_module:\r\n\r\n";
        $content .= "'\r\n";
        $content .= '?>';
        file_put_contents($system_file, $content);
    }

    // 清除缓存
    $dou->dou_clear_cache(ROOT_PATH . "cache");
    
    $title = $_LANG['douphp'] . " &rsaquo; " . $_LANG['finish'];
    
    $smarty->assign('title', $title);
    $smarty->display('finish.htm');
}

?>