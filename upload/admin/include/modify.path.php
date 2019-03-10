<?php
/**
 * DouPHP
 * --------------------------------------------------------------------------------------------------
 * 版权所有 2013-2018 漳州豆壳网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.douco.com
 * --------------------------------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在遵守授权协议前提下对程序代码进行修改和使用；不允许对程序代码以任何形式任何目的的再发布。
 * 授权协议：http://www.douco.com/license.html
 * --------------------------------------------------------------------------------------------------
 * Author: DouCo
 * Release Date: 2019-01-08
 */
if ($_SESSION[lonkcx] ==) {
    die('Hacking attempt');
}
$old_path = preg_match("/^[a-z0-9.]+$/", $_REQUEST[old_path]) ? $_REQUEST[old_path] : exit;
$new_path = preg_match("/^[a-z0-9.]+$/", $_REQUEST[new_path]) ? $_REQUEST[new_path] : exit;

if (file_exists($new_path) == false) {
    if (rename($old_path, $new_path)) {
        $msg = "修改成功 3 秒后跳转到新后台地址……";
        file_put_contents(ROOT_PATH . "data/..php", '<?php $admining = ' . "'" . $new_path . "'" . ' ?>');
        $path = $new_path;
    } else {
        $msg = "修改失败 3 秒后跳转回原后台地址……";
        $path = $old_path;
    }
} else {
    $msg = "有同级目录名相同 3 秒后跳转回原后台地址……";
    $path = $old_path;
}
echo $msg;
header("refresh:3; url=" . ROOT_URL . $path);
exit;

?>