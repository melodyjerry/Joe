<?php

/* 过滤短代码 */
require_once('short.php');

/* 过滤评论回复 */
function _parseCommentReply($text)
{
    $text = _parseReply($text);
    $text = preg_replace('/\{!{(.*?)\}!}/', '<img src="$1" class="draw_image" alt="画图"/>', $text);
    echo $text;
}

/* 过滤表情 */
function _parseReply($text)
{
    $text = preg_replace_callback(
        '/\:\:\(\s*(呵呵|哈哈|吐舌|太开心|笑眼|花心|小乖|乖|捂嘴笑|滑稽|你懂的|不高兴|怒|汗|黑线|泪|真棒|喷|惊哭|阴险|鄙视|酷|啊|狂汗|what|疑问|酸爽|呀咩爹|委屈|惊讶|睡觉|笑尿|挖鼻|吐|犀利|小红脸|懒得理|勉强|爱心|心碎|玫瑰|礼物|彩虹|太阳|星星月亮|钱币|茶杯|蛋糕|大拇指|胜利|haha|OK|沙发|手纸|香蕉|便便|药丸|红领巾|蜡烛|音乐|灯泡|开心|钱|咦|呼|冷|生气|弱|吐血)\s*\)/is',
        function ($match) {
            return '<img class="owo_image" alt="表情" src="/usr/themes/joe/assets/owo/paopao/' . str_replace('%', '', urlencode($match[1])) . '_2x.png" />';
        },
        $text
    );
    $text = preg_replace_callback(
        '/\:\@\(\s*(高兴|小怒|脸红|内伤|装大款|赞一个|害羞|汗|吐血倒地|深思|不高兴|无语|亲亲|口水|尴尬|中指|想一想|哭泣|便便|献花|皱眉|傻笑|狂汗|吐|喷水|看不见|鼓掌|阴暗|长草|献黄瓜|邪恶|期待|得意|吐舌|喷血|无所谓|观察|暗地观察|肿包|中枪|大囧|呲牙|抠鼻|不说话|咽气|欢呼|锁眉|蜡烛|坐等|击掌|惊喜|喜极而泣|抽烟|不出所料|愤怒|无奈|黑线|投降|看热闹|扇耳光|小眼睛|中刀)\s*\)/is',
        function ($match) {
            return '<img class="owo_image" alt="表情" src="/usr/themes/joe/assets/owo/aru/' . str_replace('%', '', urlencode($match[1])) . '_2x.png">';
        },
        $text
    );
    return $text;
}

/* 格式化侧边栏回复 */
function _parseAsideReply($text, $type = true)
{
    if ($type) echo _parseReply(preg_replace('~{!{.*~', '# 图片回复', strip_tags($text)));
    else echo preg_replace('~{!{.*~', '# 图片回复', strip_tags($text));
}

/* 过滤侧边栏最新回复的跳转链接 */
function _parseAsideLink($link)
{
    echo str_replace("#", "?scroll=", $link);
}
