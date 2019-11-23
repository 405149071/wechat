<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>分享的习惯</title>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
    <script Language= javascript>
        var appId,timestamp,nonceStr,signature;
        appId = "<?php echo $sign['appId'] ?>";
        timestamp = "<?php echo $sign['timestamp'] ?>";
        nonceStr = "<?php echo $sign['nonceStr'] ?>";
        signature = "<?php echo $sign['signature'] ?>";

        // 这里尝试使用新方法去做分享
        // 微信分享
        var weixinShareImgUrl = "http://preview.qiantucdn.com/58pic/35/47/96/28v58PICib8dd58PICtBXy171_PIC2018.jpg!qt324new_nowater";
        var weixinShareLineLink = location.href;
        var weixinShareShareTitle = '微信演练new';
        var weixinShareDescContent = '微信演练微信演练微信演练微信演练new';


        /*$.ajax({
            url:'http://share.youxiduo.com/weixin/shareinfo',
            type:'GET',
            async:false,
            dataType: "json",
            data: {'url': encodeURI(encodeURI(weixinShareLineLink))},
            success:function(data){
                appId = data.appid;
                timestamp = data.timestamp;
                nonceStr = data.noncestr;
                signature = data.ticket;
            }
        });*/

        wx.config({
            debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
            appId: appId, // 必填，公众号的唯一标识
            timestamp: timestamp, // 必填，生成签名的时间戳
            nonceStr: nonceStr, // 必填，生成签名的随机串
            signature: signature,// 必填，签名，见附录1
            jsApiList: ['onMenuShareAppMessage','onMenuShareTimeline','hideMenuItems'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
        });

        wx.ready(function () {   //需在用户可能点击分享按钮前就先调用
            // 自定义“分享给朋友”及“分享到QQ”按钮的分享内容（1.4.0）
            wx.updateAppMessageShareData({
                title: weixinShareShareTitle, // 分享标题
                desc: weixinShareDescContent, // 分享描述
                link: weixinShareLineLink, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                imgUrl: weixinShareImgUrl, // 分享图标
                success: function (res) {
                    alert('设置成功,已分享');
                },
                cancel: function (res) {
                    alert('已取消');
                },
                fail: function (res) {
                    alert(JSON.stringify(res));
                }
            });
            // 自定义“分享到朋友圈”及“分享到QQ空间”按钮的分享内容（1.4.0）
            wx.updateTimelineShareData({
                title: weixinShareShareTitle, // 分享标题
                link: weixinShareLineLink, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                imgUrl: weixinShareImgUrl, // 分享图标
                success: function (res) {
                    alert('设置成功,已分享');
                },
                cancel: function (res) {
                    alert('已取消');
                },
                fail: function (res) {
                    alert(JSON.stringify(res));
                }
            });
            // 获取“分享到腾讯微博”按钮点击状态及自定义分享内容接口
            wx.onMenuShareWeibo({
                title: weixinShareShareTitle, // 分享标题
                desc: weixinShareDescContent, // 分享描述
                link: weixinShareLineLink, // 分享链接
                imgUrl: weixinShareImgUrl, // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });


        });



        //自定义“分享给朋友”及“分享到QQ”按钮的分享内容（1.4.0）
        wx.ready(function(){
            wx.onMenuShareTimeline({
                title: weixinShareShareTitle,
                link: weixinShareLineLink,
                imgUrl: weixinShareImgUrl,
                trigger: function (res) {
                    // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
                    alert('用户点击分享到朋友圈');
                },
                success: function (res) {
                    alert('已分享');
                },
                cancel: function (res) {
                    alert('已取消');
                },
                fail: function (res) {
                    alert(JSON.stringify(res));
                }
            });
            wx.onMenuShareAppMessage({
                title: weixinShareShareTitle,
                link: weixinShareLineLink,
                desc: weixinShareDescContent,
                imgUrl: weixinShareImgUrl,
                trigger: function (res) {
                    // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
                    alert('用户点击发送给朋友');
                },
                success: function (res) {
                    alert('已分享');
                },
                cancel: function (res) {
                    alert('已取消');
                },
                fail: function (res) {
                    alert(JSON.stringify(res));
                }
            });
            wx.hideMenuItems({
                menuList: [
                    'menuItem:readMode', // 阅读模式
                    'menuItem:share:timeline', // 分享到朋友圈
                    'menuItem:copyUrl' // 复制链接
                ],
                success: function (res) {
                    alert('已隐藏“阅读模式”，“分享到朋友圈”，“复制链接”等按钮');
                },
                fail: function (res) {
                    alert(JSON.stringify(res));
                }
            });
        });
    </script>
    <style>
    .test {
        background-color: blue;
        font-size: 50px;
    }
</style>
</head>
<body>
<div class="test">
haha
</div>
</body>
