<?php
/**
 * @desc: 版权所有，翻版必究，未经同意不得用于商业项目
 * @author: 樊亚磊
 * @mail:fanyalei@aliyun.com
 * @QQ:451802973
 */
class User extends Abst {

    public function index() {
        include VIEW_PATH . 'login.php';
    }

    public function login() {
        $name = self::trimSpace($_REQUEST['userName']);
        $pwd  = self::trimSpace($_REQUEST['passWord']);
        $remember = (int)$_REQUEST['remember'];
        $res = Factory::getInstance('User')->login($name, $pwd, $remember);
        if ($res) {
            $_SESSION['CLOUD_UID'] = $res;
            setcookie('CLOUD_UID', $res, time() + 3600 * 24);
            if ($remember && $name && $pwd) {
                setcookie('token', sha1($name . substr(md5($pwd . PWD), 6, 20)), time() + 3600 * 24 * 7);
            }
            Factory::getInstance('User')->setLoginTime($res);
            echo Response::json(SUCC, array(tip('登录成功')));
        } else {
            echo Response::json(FAIL, array(tip('登录失败')));
        }
    }

    public function regist() {
        $name = self::trimSpace($_REQUEST['userName']);
        $pwd  = self::trimSpace($_REQUEST['passWord']);
        $role = $_REQUEST['role'] ? (int)$_REQUEST['role'] : 0;
        if (!$name || !$pwd) {
            echo Response::json(LACK, array(tip('用户名密码都不能为空')));
            exit;
        }
        $res = Factory::getInstance('User')->regist($name, $pwd, $role);
        if ($res) {
            $_SESSION['CLOUD_UID'] = $res;
            setcookie('CLOUD_UID', $res, time() + 3600 * 24);
            echo Response::json(SUCC, array(tip('注册成功')));
        } else {
            echo Response::json(FAIL, array(tip('注册失败')));
        }
    }

    public function isLogin() {
        $uid = $_SESSION['CLOUD_UID'];
        if ($uid) {
            if ($_COOKIE['CLOUD_UID'] == $uid) {
                return Response::json(SUCC, array(tip('登录状态')));
            } else {
				unset($_SESSION['CLOUD_UID']);
                setcookie('CLOUD_UID', NULL, time() - 3600);
                return Response::json(FAIL, array(tip('非登录状态')));
            }
        } elseif ($_COOKIE['token']) {
            $res = Factory::getInstance('User')->checkToken($_COOKIE['token']);
            if ($res) {
                $_SESSION['CLOUD_UID'] = $res;
                setcookie('CLOUD_UID', $res, time() + 3600 * 24);
                return Response::json(SUCC, array(tip('登录状态')));
            } else {
				setcookie('token', NULL, time() - 3600);
                return Response::json(FAIL, array(tip('非登录状态')));
            }
        }
    }

    public function logout() {
        unset($_SESSION['CLOUD_UID']);
        setcookie('CLOUD_UID', NULL, time() - 3600);
        setcookie('token', NULL, time() - 3600);
        header('Location: index.php?m=user');
        exit;
    }

    public function quota() {
        $uid = (int)$_REQUEST['uid'];
        $quota = (int)$_REQUEST['quota'];
        if (!$uid) {
            echo Response::json(LACK, array(tip('用户ID不能为空')));
            exit;
        }
        $res = Factory::getInstance('user')->quota($uid, $quota);
        if ($res) {
            echo Response::json(SUCC, array(tip('分配成功')));
        } else {
            echo Response::json(FAIL, array(tip('分配失败')));
        }
    }

    public function getUseSpace() {
        $uid = (int)$_REQUEST['uid'];
        if ($uid) {
            $res = Factory::getInstance('user')->getUseSpace($uid);
        }
        return array('space' => (int)$res, 'spaceFormat' => self::formatBytes((int)$res));
    }

    public function getUserInfo() {
        $uid = (int)$_REQUEST['uid'];
        return Factory::getInstance('user')->getUserInfo($uid);
    }
}
?>