<?php
/**
 * 获取用户UA信息
 */

// 浏览器信息
function siren_get_browsers($ua)
{
    $title = '未知';
    $icon = 'unknow';
    if (preg_match('#MSIE ([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $title = 'IE浏览器';
        if (strpos($matches[1], '10') !== false) {
            $icon = 'ie10';
        } else {
            $icon = 'ie';
        }
    } elseif (preg_match('#Edge/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $title = 'EDGE';
        $icon = 'edge';
    } elseif (preg_match('#Firefox/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $title = 'Firefox';
        $icon = 'firefox';
    } elseif (preg_match('#CriOS/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $title = 'Chrome';
        $icon = 'crios';
    } elseif (preg_match('#Chrome/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $title = 'Chrome';
        $icon = 'chrome';
        if (preg_match('#OPR/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = '欧朋浏览器';
            $icon = 'opera15';
            if (preg_match('#opera mini#i', $ua)) $title = '欧朋迷你版';
        }
    } elseif (preg_match('#Safari/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $title = 'Safari';
        $icon = 'safari';
    } elseif (preg_match('#Opera.(.*)Version[ /]([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $title = '欧朋浏览器';
        $icon = 'opera';
        if (preg_match('#opera mini#i', $ua)) $title = '欧朋迷你版';
    } elseif (preg_match('#Maxthon( |\/)([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $title = '傲游浏览器';
        $icon = 'maxthon';
    } elseif (preg_match('#360([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $title = '360浏览器';
        $icon = '360se';
    } elseif (preg_match('#SE 2([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $title = '搜狗浏览器';
        $icon = 'sogou';
    } elseif (preg_match('#UCWEB([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $title = 'UC浏览器';
        $icon = 'ucweb';
    } elseif (preg_match('#wp-(iphone|android)/([a-zA-Z0-9.]+)#i', $ua, $matches)) { // 1.2 增加 WordPres 客户端的判断
        $title = 'WordPress';
        $icon = 'wordpress';
    }
    return array(
        $title,
        $icon
    );
}

// 操作系统信息
function siren_get_os($ua)
{
    $title = '未知';
    $icon = 'unknow';
    if (preg_match('/win/i', $ua)) {
        if (preg_match('/Windows NT 10.0/i', $ua)) {
            $title = "Win 10";
            $icon = "windows_win10";
        } elseif (preg_match('/Windows NT 6.1/i', $ua)) {
            $title = "Win 7";
            $icon = "windows_win7";
        } elseif (preg_match('/Windows NT 5.1/i', $ua)) {
            $title = "Win XP";
            $icon = "windows";
        } elseif (preg_match('/Windows NT 6.2/i', $ua)) {
            $title = "Win 8";
            $icon = "windows_win8";
        } elseif (preg_match('/Windows NT 6.3/i', $ua)) {
            $title = "Win 8.1";
            $icon = "windows_win8";
        } elseif (preg_match('/Windows NT 6.0/i', $ua)) {
            $title = "Vista";
            $icon = "windows_vista";
        } elseif (preg_match('/Windows NT 5.2/i', $ua)) {
            if (preg_match('/Win64/i', $ua)) {
                $title = "Win XP x64";
            } else {
                $title = "Win S 2003";
            }
            $icon = 'windows';
        } elseif (preg_match('/Windows Phone/i', $ua)) {
            $matches = explode(';', $ua);
            $title = "Windows Phone";
            $icon = "windows_phone";
        }
    } elseif (preg_match('#iPod.*.CPU.([a-zA-Z0-9.( _)]+)#i', $ua, $matches)) {
        $title = "iPod";
        $icon = "iphone";
    } elseif (preg_match('#iPhone OS ([a-zA-Z0-9.( _)]+)#i', $ua, $matches)) {// 1.2 修改成 iPhone os 来判断
        $title = "iPhone";
        $icon = "iphone";
    } elseif (preg_match('#iPad.*.CPU.([a-zA-Z0-9.( _)]+)#i', $ua, $matches)) {
        $title = "iPad";
        $icon = "ipad";
    } elseif (preg_match('/Mac OS X.([0-9. _]+)/i', $ua, $matches)) {
        if (count(explode(7, $matches[1])) > 1) $matches[1] = 'Lion';
        elseif (count(explode(8, $matches[1])) > 1) $matches[1] = 'Mountain Lion';
        $title = "Mac OS X";
        $icon = "macos";
    } elseif (preg_match('/Macintosh/i', $ua)) {
        $title = "Mac OS";
        $icon = "macos";
    } elseif (preg_match('/CrOS/i', $ua)) {
        $title = "Chrome OS";
        $icon = "chrome";
    } elseif (preg_match('/Linux/i', $ua)) {
        $title = 'Linux';
        $icon = 'linux';
        if (preg_match('/Android.([0-9. _]+)/i', $ua, $matches)) {
            $title = "Android";
            $icon = "android";
        } elseif (preg_match('#Ubuntu#i', $ua)) {
            $title = "Ubuntu";
            $icon = "ubuntu";
        } elseif (preg_match('#Debian#i', $ua)) {
            $title = "Debian";
            $icon = "debian";
        } elseif (preg_match('#Fedora#i', $ua)) {
            $title = "Fedora";
            $icon = "fedora";
        }
    }
    return array(
        $title,
        $icon
    );
}