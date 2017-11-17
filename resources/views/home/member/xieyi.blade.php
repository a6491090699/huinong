<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>用户服务协议 - 竞苗平台</title>
<meta name="keywords" content="用户服务协议" />
<meta name="description" content="使用本平台服务时，必须先详细阅读本《用户服务协议》，以下简称《协议》，您只有接受本协议内容才能使用本平台所有服务。您的使用行为，也被视为您已经接受本协议。 ..." />
    <link rel="stylesheet"  href="/css/mobile-select-area.css">
    <!--<link rel="stylesheet" href="/css/larea.css">-->
    <link rel="stylesheet" href="/css/style.css"/>
    <link rel="stylesheet" href="/css/index.css"/>
    <!--<link rel="stylesheet" href="/css/sm.min.css">-->
    <!--<script type='text/javascript' src='/js/zepto.min.js' charset='utf-8'></script>-->
    <!--<script type='text/javascript' src='/js/sm.min.js' charset='utf-8'></script>-->
    <script src="/js/jquery-1.11.2.js" type="text/javascript"></script>
    <script src="/js/layer.js"></script>
    <script type="text/javascript" src="/js/index.js"></script>
    <script src="/js/mlselection.js"></script>
    <script src="/js/huamu.js" type="text/javascript"></script>
    <script src="/js/jquery.validate.js" type="text/javascript"></script>
    <script src="/js/jquery.validate.extend.js" type="text/javascript"></script>
    <script src="/js/additional-methods-huamu.js" type="text/javascript"></script>
    <script src="/js/index.js" type="text/javascript"></script>
    <script src="/js/common.js" type="text/javascript"></script>
    <script type="text/javascript" src="/js/dialog.js"></script>
    <script type="text/javascript" src="/js/mobile-select-area.js"></script>
    <script type="text/javascript" src="/js/json2.js" ></script>
    <script type="text/javascript" src="/js/underscore-min.js" ></script>
    <script src="/js/ydbonline.js" type="text/javascript"></script>
    <script>
        //模板设置
        _.templateSettings = {
            interpolate: /\{(.+?)}/g
        };
        var SITE_URL = "/";
        var REAL_SITE_URL = "/";
        var PRICE_FORMAT = '¥%s';

    </script>
    <script type="text/javascript">
        var lat = 0;
        var lon = 0;
        function getCookie(c_name)
        {
            if (document.cookie.length>0)
            {
                c_start=document.cookie.indexOf(c_name + "=");
                if (c_start!=-1)
                {
                    c_start=c_start + c_name.length+1;
                    c_end=document.cookie.indexOf(";",c_start);
                    if (c_end==-1) c_end=document.cookie.length;
                    return unescape(document.cookie.substring(c_start,c_end));
                }
            }
            return "";
        }

        function setCookie(c_name,value,expiredays)
        {
            var exdate=new Date();
            exdate.setDate(exdate.getDate()+expiredays);
            document.cookie=c_name+ "=" +escape(value)+
                ((expiredays==null) ? "" : ";expires="+exdate.toGMTString());
        }

        function checkCookie(ll_name)
        {
            cookie_v=getCookie(ll_name);
            if (cookie_v!=null && cookie_v!="")
            {
                if(ll_name=="lat"){
                    lat=cookie_v;
                } else if(ll_name=="lon"){
                    lon=cookie_v;
                }
            }
        }
    </script>

</head>
<body class="bg-f8">
<header class="user_center_header color_34 bd_bottom-eee">
    <a class="go_back_btn" href="javascript:history.go(-1)">
        <span class="iconfont">&#xe698;</span>
    </a>
    <h1>服务协议</h1>
</header>
<div class="padding_container">
    <h1 class="font_33r color_34 fontWeight_5">用户服务协议</h1>
    <p class="text_right padding_top_bottom font_2r color_9a">2013.10.05</p>
    <div class="padding_top_bottom news_main">
        使用本平台服务时，必须先详细阅读本《用户服务协议》，以下简称《协议》，您只有接受本协议内容才能使用本平台所有服务。您的使用行为，也被视为您已经接受本协议。<div><br></div><div>一、定义</div><div><blockquote style="margin: 0 0 0 40px; border: none; padding: 0px;"><div>“用户”是指符合本协议规定的条件，同时遵守本平台各种规则、条款，使用本平台服务的个人或组织；</div><div>“卖家”是指在本平台销售商品的用户；</div><div>“买家”是指在本平台购买商品的用户；</div><div>“交易”是指本平台买家和卖家之间根据双方共识达成的商品买卖行为；</div><div><span style="line-height: 1.8em;"><br></span></div></blockquote></div><div><div><span style="line-height: 1.8em;">二、用户资格</span></div></div><div><blockquote style="margin: 0 0 0 40px; border: none; padding: 0px;"><div>年满十八周岁的，具体民事行为能力的自然人</div><div>合法存在的公司、企事业单位、合作社、社团组织或其它组织</div><div><br></div></blockquote>三、用户的权利和义务</div><div><blockquote style="margin: 0 0 0 40px; border: none; padding: 0px;"><div><div><ol><li><span style="line-height: 1.8em;">用户有权根据本协议的规定及本平台发布的相关规则，利用本平台网上交易平台登录物品、发布交易信息、查询物品信息、购买物品、与其他用户订立物品买卖合同、在本平台社区发帖、参加本平台的有关活动及有权享受本平台提供的其他的有关资讯及信息服务。</span></li><li><span style="line-height: 1.8em;">用户有权根据需要更改密码和交易密码。用户应对以该用户名进行的所有活动和事件负全部责任。</span></li><li><span style="line-height: 1.8em;">用户有义务确保向本平台提供的任何资料、注册信息真实准确，包括但不限于真实姓名、身份证号、联系电话、地址、邮政编码等。保证平台站及其他用户可以通过上述联系方式与自己进行联系。同时，用户也有义务在相关资料实际变更时及时更新有关注册资料。</span></li><li><span style="line-height: 1.8em;">用户不得以任何形式擅自转让或授权他人使用自己在本平台的用户帐号。</span></li><li><span style="line-height: 1.8em;">用户有义务确保在本平台网上交易平台上登录物品、发布的交易信息真实、准确，无误导性。</span></li><li><span style="line-height: 1.8em;">用户不得在本平台网上交易平台买卖国家禁止销售的或限制销售的物品、不得买卖侵犯他人知识产权或其他合法权益的物品，也不得买卖违背社会公共利益或公共道德的物品。</span></li><li><span style="line-height: 1.8em;">用户不得在本平台发布各类违法或违规信息。包括但不限于物品信息、交易信息、社区帖子、物品留言，店铺留言，评价内容等。</span></li><li><span style="line-height: 1.8em;">用户在本平台交易中应当遵守诚实信用原则，不得以干预或操纵物品价格等不正当竞争方式扰乱网上交易秩序，不得从事与网上交易无关的不当行为，不得在交易平台上发布任何违法信息。</span></li><li><span style="line-height: 1.8em;">用户不应采取不正当手段（包括但不限于虚假交易、互换好评等方式）提高自身或他人信用度，或采用不正当手段恶意评价其他用户，降低其他用户信用度。</span></li><li><span style="line-height: 1.8em;">用户承诺自己在使用本平台网上交易平台实施的所有行为遵守国家法律、法规和本平台的相关规定以及各种社会公共利益或公共道德。对于任何法律后果的发生，用户将以自己的名义独立承担所有相应的法律责任。</span></li><li><span style="line-height: 1.8em;">用户在本平台网上交易过程中如与其他用户因交易产生纠纷，可以请求本平台从中予以协调。用户如发现其他用户有违法或违反本协议的行为，可以向本平台举报。如用户因网上交易与其他用户产生诉讼的，用户有权通过司法部门要求本平台提供相关资料。</span></li><li><span style="line-height: 1.8em;">用户应自行承担因交易产生的相关费用，并依法纳税。</span></li><li><span style="line-height: 1.8em;">未经本平台书面允许，用户不得将本平台资料以及在交易平台上所展示的任何信息以复制、修改、翻译等形式制作衍生作品、分发或公开展示。</span></li><li><span style="line-height: 1.8em;">用户同意接收来自本平台的信息，包括但不限于活动信息、交易信息、促销信息等。</span></li></ol></div></div></blockquote></div><div>四、本平台的权利和义务</div><div><blockquote style="margin: 0 0 0 40px; border: none; padding: 0px;"><ul><li><span style="line-height: 1.8em;">本网站不是传统意义上的"销售商"，仅为用户提供一个信息交流、进行物品买卖的平台，充当买卖双方之间的交流媒介，而非买主或卖主的代理商、合伙 人、雇员或雇主等经营关系人。公布在本网站上的交易物品是用户自行上传进行交易的物品，并非本网站所有。对于用户刊登物品、提供的信息或参与竞标的过程， 本网站均不加以监视或控制，亦不介入物品的交易过程，包括运送、付款、退款、瑕疵担保及其它交易事项，且不承担因交易物品存在品质、权利上的瑕疵以及交易方履行交易协议的能力而产生的任何责任，对于出现在平台上的物品品质、安全性或合法性，本平台均不予保证；</span></li><li><span style="line-height: 1.8em;">本平台有义务在现有技术水平的基础上努力确保整个网上交易平台的正常运行，尽力避免服务中断或将中断时间限制在最短时间内，保证用户网上交易活动的顺利进行；</span></li><li><span style="line-height: 1.8em;">本网站有义务对用户在注册使用本网站网上交易平台中所遇到的问题及反映的情况及时作出回复；</span></li><li><span style="line-height: 1.8em;">本网站有权对用户的注册资料进行查阅，对存在任何问题或怀疑的注册资料，本网站有权发出通知询问用户并要求用户做出解释、改正，或直接做出处罚、删除等处理。</span></li><li><span style="line-height: 1.8em;">用户因在本网站网上交易与其他用户产生纠纷的，用户通过司法部门或行政部门依照法定程序要求本网站提供相关资料，本网站将积极配合并提供有关资料；用户将纠纷告知本网站，或本网站知悉纠纷情况的，经审核后，本网站有权通过电子邮件及电话联系向纠纷双方了解纠纷情况，并将所了解的情况通过电子邮件互相通知对方。</span></li><li><span style="line-height: 1.8em;">因网上交易平台的特殊性，本网站没有义务对所有用户的注册资料、所有的交易行为以及与交易有关的其他事项进行事先审查，但如发生以下情形，本网站有权限制用户的活动、向用户核实有关资料、发出警告通知、暂时中止、无限期地中止及拒绝向该用户提供服务：</span></li></ul><span style="line-height: 1.8em;"><ul><ul><li><span style="line-height: 1.8em;">用户违反本协议或因被提及而纳入本协议的文件；</span></li><li><span style="line-height: 1.8em;">存在用户或其他第三方通知本网站，认为某个用户或具体交易事项存在违法或不当行为，并提供相关证据，而本网站无法联系到该用户核证或验证该用户向本网站提供的任何资料；</span></li><li><span style="line-height: 1.8em;">存在用户或其他第三方通知本网站，认为某个用户或具体交易事项存在违法或不当行为，并提供相关证据。本网站以普通非专业交易者的知识水平标准对相关内容进行判别，可以明显认为这些内容或行为可能对本网站用户或本网站造成财务损失或法律责任。</span></li></ul></ul></span><ul><li><span style="line-height: 1.8em;">在反网络欺诈行动中，本着保护广大用户利益的原则，当用户举报自己交易可能存在欺诈而产生交易争议时，本网站有权通过表面判断暂时冻结相关用户账号，并有权核对当事人身份资料及要求提供交易相关证明材料。</span></li><li><span style="line-height: 1.8em;">根据国家法律法规、本协议的内容和本网站所掌握的事实依据，可以认定用户存在违法或违反本协议行为以及在本网站交易平台上的其他不当行为，本网站有权在本网站交易平台及所在网站上以网络发布形式公布用户的违法行为，并有权随时作出删除相关信息，而无须征得用户的同意。</span></li><li><span style="line-height: 1.8em;">本 网站有权在不通知用户的前提下删除或采取其他限制性措施处理下列信息：包括但不限于以规避费用为目的；以炒作信用为目的；存在欺诈等恶意或虚假内容；与网 上交易无关或不是以交易为目的；存在恶意竞价或其他试图扰乱正常交易秩序因素；该信息违反公共利益或可能严重损害本网站和其他用户合法利益的。</span></li><li><span style="line-height: 1.8em;">本平台对用户发布的信息拥有独家的、全球通用的、永久的、免费的信息许可使用权利，本平台有权对该权利进行再授权，依此授权本网站有权(全部或部分的) 使用、复制、修订、改写、发布、翻译、分发、执行和展示用户公示于网站的各类信息或制作其派生作品，以现在已知或日后开发的任何形式、媒体或技术，将上述信息纳入其他作品内。</span></li></ul></blockquote></div><div><blockquote style="margin: 0 0 0 40px; border: none; padding: 0px;"><div><br></div></blockquote></div><div>五、服务的中断和中止</div><div><blockquote style="margin: 0 0 0 40px; border: none; padding: 0px;"><div>对于免费用户，本平台有权决定在发出出或未发出通知的情况下，以任何理由、任何时间对用户中止全部或部分服务，并不做出任何的补偿及赔偿。服务中止后，本平台也可自行决定是否保留用户的数据（包括但不限于：用户资料、商品信息、店铺资料、交易信息等）；</div><div>对于付费用户</div></blockquote></div><blockquote style="margin: 0 0 0 40px; border: none; padding: 0px;"><blockquote style="margin: 0 0 0 40px; border: none; padding: 0px;"><ul><li><span style="line-height: 1.8em;">当用户违反本协议内容或本平台其它规则、协议时，本平台有权对用户警告、处罚，直至注销该用户或中止该用户的部分或全部服务，并不退还任何费用；</span></li><li><span style="line-height: 1.8em;">当用户发布的商品、信息违反国家相关法律法规时，</span><span style="line-height: 1.8em;">本平台有权对用户警告、处罚，直至注销该用户或中止该用户的部分或全部服务，并不退还任何费用；</span></li><li><span style="line-height: 1.8em;">中止服务后，平台应该通过网站公告、站内信、邮件、电话、短信等方式中的一种或几种通知用户；</span></li><li><span style="line-height: 1.8em;">因本平台原因，需要中断服务的，需要提前通过</span><span style="line-height: 1.8em;">网站公告、站内信、邮件、电话、短信等方式中的一种或几种通知用户</span><span style="line-height: 1.8em;">（不可抗力除外）；</span></li><li><span style="line-height: 1.8em;">因本平台原因，需要中止服务的，需要</span><span style="line-height: 1.8em;">提前通过</span><span style="line-height: 1.8em;">网站公告、站内信、邮件、电话、短信等方式中的一种或几种通知用户</span><span style="line-height: 1.8em;">（不可抗力除外），并根据用户付费的剩余有效期退还相关费用；</span></li><li><span style="line-height: 1.8em;">服务中止后，本平台也可自行决定是否保留用户的数据（包括但不限于：用户资料、商品信息、店铺资料、交易信息等）。</span></li></ul></blockquote></blockquote><div><blockquote style="margin: 0 0 0 40px; border: none; padding: 0px;"><div><br></div></blockquote></div><div>六、免责条款</div><blockquote style="margin: 0 0 0 40px; border: none; padding: 0px;"><div><ol><li><span style="line-height: 1.8em;">因不可抗力或者其他意外事件，使得本协议的履行不可能、不必要或者无意义的，双方均不承担责任。本协议所称之不可抗力意指不能预见、不能避免并不能克服的 客观情况，包括但不限于战争、台风、水灾、火灾、雷击或地震、罢工、暴动、法定疾病、黑客攻击、网络病毒、电信部门技术管制、政府行为或任何其它自然或人 为造成的灾难等客观情况；</span></li><li><span style="line-height: 1.8em;">本平台致力于为用户提供最真实有效的信息，但仍无法保证信息100%的真实有效，请用户自行判断信息的真实性。因使用本平台信息，或购买本平台商品造成的损失，本不台不负补偿或赔偿责任；</span></li><li><span style="line-height: 1.8em;">本平台只是用户提供的一个交易的平台，无法对用户刊登商品的合法性、真实性、品质负责，也无法对用户的履约能力负责；</span></li><li><span style="line-height: 1.8em;">担保交易，只是本平台保障买家权益的一种手段，通过担保交易，我们能最大限度的保证交易双方权益，但平台不是执法部门，也只能充当一个争议调解的角色，争议的最终裁决权在相关的法律部门，本平台无法对担保交易现完全责任；</span></li><li><span style="line-height: 1.8em;">因网络服务的不可预知性，因本平台中断造成的用户直接或间接损失，本不台不负责任；</span></li><li><span style="line-height: 1.8em;">本平台提供的链接可能会</span><span style="line-height: 1.8em;">连结至其它运营商经营的网站，但不表示本平台与这些运营商有任何关系。其它运营商经营的网站均由各经营者自行负责，不属于本平台控制及负责范围之内。因使用或依赖任何此类网站内容、物品或服务所产生的任何损害或损失，本平台不负任何直接或间接的责任。</span></li></ol></div></blockquote><div><blockquote style="margin: 0 0 0 40px; border: none; padding: 0px;"><div><br></div></blockquote></div><div>七、协议修定</div><div><blockquote style="margin: 0 0 0 40px; border: none; padding: 0px;"><div>本协议可由本平台随时修订，并将修订后的协议公告于本平台之上，修订后的条款内容自公告时起生效，并成为本协议的一部分。用户若在本协议修改之后，仍继续使用本平台，则视为用户接受和自愿遵守修订后的协议。本平台行使修改或中断服务时，不需对任何第三方负责。</div><div><br></div></blockquote></div><div>八、争议解决</div><div><blockquote style="margin: 0 0 0 40px; border: none; padding: 0px;"><div>本协议受中华人民共和国法律管辖，任何争议仅适用中华人民共和国法律。</div><div>因使用本平台服务所引起与本平台的任何争议，均应提交郑州市仲裁委员会按照该会届时有效的仲裁规则进行仲裁。相关争议应单独仲裁，不得与任何其它方的争议在任何仲裁中合并处理，该仲裁裁决是终局，对各方均有约束力。如果所涉及的争议不适于仲裁解决，用户同意一切争议由人民法院管辖。</div></blockquote></div>    </div>
</div>
@include('home.common.footer')
</body>
</html>
