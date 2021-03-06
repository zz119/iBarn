<?php
$tiplang = array(
    'Please choose the data' => '请选择资源',
    'Please try again' => '提交超时，请重试',
    'Each link is unique, once can only share a file' => '每个文件共享链接唯一，一次只能分享一个文件',
    'Please choose the data to share' => '请选择要分享资源',
    'A single data can be renamed at a time' => '一次只能重命名一个资料',
    'Choose the data you want to rename' => '请选择要重命名的资料',
    'Select the file to download' => '请选择要下载的文件',
    'Select the file to delete' => '请选择要删除的资源',
    'Select the file to recover' => '请选择要恢复的资源',
    'Select the file to share' => '请选择要分享的资源',
    'Choose a directory to be transferred' => '请选择要转入的目录',
    'Recover fail' => '还原失败，请重试',
    'upload success' => '上传成功',
    'upload fail' => '上传失败',
    'delete fail' => '删除失败，请重试',
    'cancel share fail' => '取消分享失败，请重试',
    'Password' => '密码',
    'Share link' => '分享链接',
    'Copy' => '复制',
    'Please login' => '请先登录',
    'Incomplete parameter' => '参数不全',
    'Operation Successful' => '操作成功',
    'Operation failure' => '操作失败',
    'Change failed' => '修改失败',
    'Delete success' => '删除成功',
    'Delete failed' => '删除失败',
    'Recover success' => '还原成功',
    'Recover failed' => '还原失败',
    'Move success' => '移动成功',
    'No movement' => '没有移动',
    'Move failed' => '移动失败',
    'Set success' => '设置成功',
    'Login success' => '登录成功',
    'Login failed' => '登录失败',
    'Regist success' => '注册成功',
    'Regist failed' => '注册失败',
    'Assigned success' => '分配成功',
    'Assigned failed' => '分配失败',
    'Login' => '登录状态',
    'NoLogin' => '非登录状态',
    'Username and Password can not be null' => '用户名密码都不能为空',
    'UserID can not be null' => '用户ID不能为空',
    'FileName can not be null' => '文件名不能为空',
    'Storage directory is created failed' => '存储目录创建失败',
    'Created failed' => '创建失败',
    'Validation failed' => '验证失败',
    'Password can not exceed 8b' => '密码不能超过8位',
    'File has been shared' => '文件已分享，不能重复分享',
    'The hash parameter is required' => 'hash为必填参数',
    'File path does not exist' => '文件路径不存在',
    'File storage failed' => '文件入库失败，请重试',
    'Directory level too much, more than Limited' => '目录层级过多，超过限制',
    'Folder name cannot exceed 200 characters' => '文件夹名不能超过200个字符',
    'Folder with the same name already exists' => '同名文件夹已存在',
    'File with the same name already exists' => '同名文件已存在',
    'Copy success! You can use Ctrl+V to show' => '复制成功！ 你可以利用快捷方式Ctrl+V键粘贴到QQ等聊天工具中',
    'Your browser does not support scripting replication, please try to copy the manual by [Ctrl+C]' => '你的浏览器不支持脚本复制或你拒绝了浏览器安全确认，请尝试手动[Ctrl+C]复制',
);
define('TIPLANG', json_encode(array_flip($tiplang)));
function tip($string) {
    if ($_COOKIE['lang'] == 'en') {
        $lang = array_flip(json_decode(TIPLANG, true));
        $ret = array_search($string, $lang);
        return $ret ? $ret : $string;
    } else {
        return $string;
    }
}
?>