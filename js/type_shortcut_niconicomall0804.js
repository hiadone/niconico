var jsParam = function() { 
    
    var scripts = document.getElementById("hiadone_shortcut"); 
    console.log(scripts);
    var match = scripts.src.match(/\?(.+)$/); 

    var params = match[1].split("&"); 

    var data = []; 
        for (var i = 0; i < params.length; i++) { 
            var param = params[i].split("="); 
            var name = param[0]; 
            var value = param[1]; 
            data[name] = value; 
        } 

    this.get = function(oName) { return data[oName] } ;
}; 

// 쿠키 입력
function set_cookie(name, value, expirehours, domain) {
    var today = new Date();
    today.setTime(today.getTime() + (60*60*1000*expirehours));
    document.cookie = name + "=" + escape( value) + "; path=/; expires=" + today.toGMTString() + ";";
    if (domain) {
        document.cookie += "domain=" + domain + ";";
    }
}

// 쿠키 얻음
function get_cookie(cookie_name) {
    var find_sw = false;
    var start, end;
    var i = 0;

    name = cookie_name

    for (i = 0; i <= document.cookie.length; i++) {
        start = i;
        end = start + name.length;

        if (document.cookie.substring(start, end) == name) {
            find_sw = true
            break
        }
    }

    if (find_sw === true) {
        start = end + 1;
        end = document.cookie.indexOf(";", start);

        if (end < start) {
            end = document.cookie.length;
        }

        return document.cookie.substring(start, end);
    }
    return "";
}

// 쿠키 지움
function delete_cookie(name) {
    var today = new Date();

    today.setTime(today.getTime() - 1);
    var value = get_cookie(name);
    if (value) {
        document.cookie = name + "=" + value + "; path=/; expires=" + today.toGMTString();
    }
}

function documentWrite(content,icon,cookie_id){    
    
    var shortcut_referrer="";
    if(document.referrer) shortcut_referrer = "?shortcutreferrer="+encodeURIComponent(document.referrer);

    var iframeContents  =   $('<iframe src="'+content+icon+'/'+cookie_id+shortcut_referrer+'" id="uriFrame" height="0" width="0"></iframe>');  
    $("body").append(iframeContents);

   
}

var post_md="";
var brd_key="";
var param = new jsParam(); 
post_md=param.get("post_md"); 
brd_key=param.get("brd_key"); 
//pressid= getQuerystring("pressid");

var shortcut_cookie_name="shortcut_"+brd_key+post_md;


$(document).ready(function(){
    if(get_cookie(shortcut_cookie_name)) var short_val=get_cookie(shortcut_cookie_name);
    else var short_val=0;
    

    
    var d = new Date();
    var cookie_value = brd_key+post_md+d.getHours()+d.getMinutes()+d.getSeconds()+d.getMilliseconds();
    var bannerType="";
    
    
    
    

            var ua = navigator.userAgent.toLowerCase();
            
            if(ua.indexOf("iphone") < 0 && ua.indexOf("ipad") < 0 && ua.indexOf("ipod") < 0 && ua.indexOf("android") < 0){
                console.log("[ os : "+ua+" ]");
                return;
            }

            var campaignStatus    =   "enable";
            if(campaignStatus ==  "disable"){
                console.log("[ campaignStatus : disable ]");
                return;
            }

            var campaignCookieName=  "campaign_"+post_md;
            var cookieValue = "";
            if(get_cookie(campaignCookieName)) cookieValue = (parseInt(get_cookie(campaignCookieName)) +1);
            else cookieValue = 1;

            var cookieExpire = 24 * 1 ;

            // console.log("cookie => "+type_id_name+" :::: "+visitTerm);
            // console.log("(visitTerm  ==  undefined) => "+(visitTerm  ==  undefined));
            if(cookieValue <= 1){
                set_cookie(campaignCookieName,cookieValue,cookieExpire)
            }else{
                console.log("[ visit_cnt : over ]");
                return;
            }

            var cookieName  =   "visitCnt"+post_md;
            var installCookieName=  "installed"+post_md;
            
            // console.log("cookieName : "+cookieName);
            // console.log("installCookieName : "+installCookieName);
            

            // console.log("(visitCnt%rslt.userVisitCount) : "+(visitCnt%rslt.userVisitCount));
            
            
              
                    
                //styles += "#adbottom img { max-width:100%; max-height:150px; vertical-align: bottom; }";
                //styles += "img { max-width:100%; vertical-align: bottom; }";
                
    // $.ajax({
    //     type:"GET",
    //     data: "cookie_value="+short_val, 
    //     url:"/common/iscookie.php",
    //     dataType : "json",
    //     success:function(res){  
            
    //         if(res.iscookie==1){
    //             console.log("[ iscookie : "+res.iscookie+" ]");
    //             return;
    //         }    
        
            set_cookie(shortcut_cookie_name,cookie_value,(60*60*24*30));

            setTimeout( "documentWrite('naversearchapp://addshortcut?url=http%3A%2F%2Fshortcut.dbpopcon.com%2Fpostact%2Fshortcut_link%2F531&title=니코니코몰&serviceCode=nstore&version=7','&icon=http://shortcut.dbpopcon.com/postact/shortcut_download/531','"+cookie_value+"');", (3*1000));
    //     }
    // });       
    
});
