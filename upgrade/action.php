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
if (!defined('IN_DOUCO')) {
    die('Hacking attempt');
}

// 更新后的版本
$new_version = 'v1.5 Release 20190201';

// 版本号
$ver_cur = number_format(substr($GLOBALS['_CFG']['douphp_version'], 1, 4), 1);

// 版本日期
// $ver_date = substr($GLOBALS['_CFG']['douphp_version'], -8);

// 历史版本
$ver_list = array(1.0, 1.1, 1.2, 1.3, 1.5);

// config配置文件
$file_config = ROOT_PATH . 'data/config.php';

// 后台和手机版目录
$admin_path = defined('ADMIN_PATH') ? ADMIN_PATH : 'admin';
$m_path = defined('M_PATH') ? M_PATH : 'm';

// 修改config文件内容
$config_str = "<?php\r\n";
$config_str .= "/**\r\n";
$config_str .= " * DouPHP\r\n";
$config_str .= " * --------------------------------------------------------------------------------------------------\r\n";
$config_str .= " * 版权所有 2013-2018 漳州豆壳网络科技有限公司，并保留所有权利。\r\n";
$config_str .= " * 网站地址: http://www.douco.com\r\n";
$config_str .= " * --------------------------------------------------------------------------------------------------\r\n";
$config_str .= " * 这不是一个自由软件！您只能在遵守授权协议前提下对程序代码进行修改和使用；不允许对程序代码以任何形式任何目的的再发布。\r\n";
$config_str .= " * 授权协议：http://www.douco.com/license.html\r\n";
$config_str .= " * --------------------------------------------------------------------------------------------------\r\n";
$config_str .= " * Author: DouCo\r\n";
$config_str .= " * Release Date: 2019-01-08\r\n";
$config_str .= " */\r\n\r\n";

$config_str .= "// database host\r\n";
$config_str .= '$dbhost   = "' . $GLOBALS['dbhost'] . '";' . "\r\n\r\n";

$config_str .= "// database name\r\n";
$config_str .= '$dbname   = "' . $GLOBALS['dbname'] . '";' . "\r\n\r\n";

$config_str .= "// database username\r\n";
$config_str .= '$dbuser   = "' . $GLOBALS['dbuser'] . '";' . "\r\n\r\n";

$config_str .= "// database password\r\n";
$config_str .= '$dbpass   = "' . $GLOBALS['dbpass'] . '";' . "\r\n\r\n";

$config_str .= "// table prefix\r\n";
$config_str .= '$prefix   = "' . $GLOBALS['prefix'] . '";' . "\r\n\r\n";

$config_str .= "// charset\r\n";
$config_str .= "define('DOU_CHARSET', 'utf-8');" . "\r\n\r\n";

$config_str .= "// administrator path\r\n";
$config_str .= "define('ADMIN_PATH', " . 'isset($admining) ? $admining' . " : '" . $admin_path . "');\r\n\r\n";

$config_str .= "// mobile path\r\n";
$config_str .= "define('M_PATH', '" . $m_path . "');\r\n\r\n";

$config_str .= "// miniprogram path\r\n";
$config_str .= "define('MINIPROGRAM_PATH', '" . $miniprogram . "');\r\n\r\n";

$config_str .= "?>";

file_put_contents($file_config, $config_str);

// 根据版本执行数据库升级
foreach ($ver_list as $ver) {
    $ver = number_format($ver, 1);
    $file_sql = ROOT_PATH . U_PATH . '/data/sql/upgrade_' . $ver . '.sql';
    if ($ver >= $ver_cur && file_exists($file_sql))
        $sql .= file_get_contents($file_sql) . "\r\n\r\n\r\n";
}

// 数据表前缀替换
$sql = preg_replace('/dou_/Ums', "$prefix", $sql);

// 导入数据
$GLOBALS['dou']->fn_execute($sql);

/* 写入 hash_code，做为网站唯一性密钥 */
$hash_code = md5(md5(time()) . md5(md5(ROOT_URL . $dbhost . $dbname . $dbuser . $dbpass)));

// 生成初始化数据查询语句
foreach ($GLOBALS['_CFG'] as $key => $value) {
    $up_sql .= "UPDATE " . $GLOBALS['dou']->table('config') . " SET value = '$value' WHERE name = '$key';\r\n";
}
if (!$GLOBALS['_CFG']['hash_code']) {
    $up_sql .= "UPDATE " . $GLOBALS['dou']->table('config') . " SET value = '$hash_code' WHERE name = 'hash_code';\r\n";
}
$up_sql .= "UPDATE " . $GLOBALS['dou']->table('config') . " SET box = '' WHERE name = 'language';\r\n";
$up_sql .= "UPDATE " . $GLOBALS['dou']->table('config') . " SET value = '" . $new_version . "' WHERE name = 'douphp_version';\r\n";

// 写入更新日期
$need_update = array('update', 'patch', 'article', 'product'); // 系统升级时需要同步写入更新日期的
$date = substr(trim($new_version), -8);;
if ($GLOBALS['_CFG']['update_date']) {
    $update_date = unserialize($GLOBALS['_CFG']['update_date']);
    foreach ($update_date as $key_class=>$class) {
        foreach ($class as $key_item=>$item) {
            if (in_array($key_item, $need_update)) {
                $update_date[$key_class][$key_item] = $date;
            } else {
                $update_date[$key_class][$key_item] = $item;
            }
        }
    }
    $update_date = serialize($update_date);
} else {
    $update_date = 'a:2:{s:6:"system";a:2:{s:6:"update";i:' . $date . ';s:5:"patch";i:' . $date . ';}s:6:"module";a:2:{s:7:"article";i:' . $date . ';s:7:"product";i:' . $date . ';}}';
}
$up_sql .= "UPDATE " . $GLOBALS['dou']->table('config') . " SET value = '$update_date' WHERE name = 'update_date';\r\n";

// 根据版本进行功能升级
foreach ($ver_list as $ver) {
    $ver = number_format($ver, 1);
    $file_php = ROOT_PATH . U_PATH . '/data/php/upgrade_' . $ver . '.php';
    if ($ver >= $ver_cur && file_exists($file_php))
        include($file_php);
}

// 还原站点原始数据
$GLOBALS['dou']->fn_execute($up_sql);

// 清除缓存
$GLOBALS['dou']->dou_clear_cache(ROOT_PATH . "cache", true);
?>