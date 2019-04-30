
// API改版,主要修改这个文件
var mapCfgs, mapApis = {};

// 配置
mapCfgs = {
    init_level: 15, // 17
    so_items: { // house_near_merge
        loupan: ['楼盘'], 
        traffic: ['公交', '地铁', '加油站', "停车场", '厕所'],
        fun: ["ktv", "酒吧", "电影院", "美容院", "咖啡厅", '厕所'],        
        shop: ["超市"],
        eat: ["餐饮"],
        bank: ["银行"],
        hos: ["医院"],
        park: ["公园"],
        school: ['幼儿园','小学','中学','大学']
    },
    so_res: {}, // 缓存,搜索结果
    so_dots: {}, // 缓存,坐标点
    so_list: {}, // 缓存,列表
    so_infos: {}, // 缓存,信息窗口
    end: 'yes'
};


// 复杂的自定义覆盖物
function ComplexCustomOverlay(point, text, pos){
    this._point = point;
    this._text = text;
    this._pos = pos; // 自定义属性...
    this.enableMassClear = false;
}
ComplexCustomOverlay.prototype = new BMap.Overlay();
ComplexCustomOverlay.prototype.initialize = function(map){
    this._map = map;
    var pos = this._pos ? this._pos : [22,12]; //console.log(pos);
    var div = this._div = document.createElement("div");
    div.style.position = "absolute";
    div.style.zIndex = BMap.Overlay.getZIndex(this._point.lat);
    var arrow = this._arrow = document.createElement("div");
    arrow.style.position = "absolute";
    arrow.style.top = pos[0]+"px";
    arrow.style.left = pos[1]+"px";
    div.appendChild(arrow);
    $(this._text).appendTo(div);
    map.getPanes().labelPane.appendChild(div);
    return div;
}
ComplexCustomOverlay.prototype.draw = function(){
    var map = this._map;
    var pixel = map.pointToOverlayPixel(this._point);
    this._div.style.left = pixel.x - parseInt(this._arrow.style.left) + "px";
    this._div.style.top  = pixel.y - 30 + "px";
}
/*ComplexCustomOverlay.prototype.addEventListener = function (event, fun) {
    this._div['on' + event] = fun;
}*/

// 模板解析
mapApis.tplParse = function(id, row, tpl){
    html = id ? $(id).html() : tpl; 
    for (var i in row) {
        html = html.replace(/\(([^\)]+)\)/ig, function(m, p) {
            return row[p] || '';
        });
    }
    return html;
}

// 信息窗
mapApis.markInfo = function(itm) {
    var html = mapApis.tplParse('#markDetail', itm); 
    //itm['thumb'] = 'http://lbsyun.baidu.com/img/baidu.jpg';
    if((typeof itm['thumb']=='undefined')){
        html = html.replace('_none', 'hide');
    }else{
        html = html.replace('_thumb', itm['thumb']);
    } //console.log(itm);
    var soInfo = new BMapLib.SearchInfoWindow(map, html, {
        title  : itm.title,      //标题
        width  : 290,             //宽度
        //height : 50,              //高度
        //offset: {width:5, height:5},
        panel  : "panel",         //检索结果面板
        enableAutoPan : true,     //自动平移
        searchTypes   :[
            BMAPLIB_TAB_SEARCH,   //周边检索
            BMAPLIB_TAB_TO_HERE,  //到这里去
            BMAPLIB_TAB_FROM_HERE //从这里出发
        ]
    }); 
    return soInfo;
}
// 标点
mapApis.iconMarker = function(kw, itm, id) {
    var _key = (kw+'_'+itm.p.lng+'_'+itm.p.lat).replace(/\./g,'-');
    if(!(typeof mapCfgs.so_dots[_key]=='undefined')){
        $('#p'+_key).show();
        //mapCfgs.so_dots[_key].show(); // 显示缓存,不重复标点
        return;
    }
    var chr = String.fromCharCode(65+id);
    var _trow = {title:itm.title, C:chr, id:_key};
    var html = mapApis.tplParse('#mark1Piont',_trow);
    var mark = new ComplexCustomOverlay(itm.p, html);
    //mark.disableMassClear();
    mapCfgs.so_infos[_key] = mapApis.markInfo(itm);
    /*
    mark.addEventListener("click", function(e){
        alert('a'); // 自定义覆盖物,事件也要自定义...
        info.open(mark);
    });*/
    mapCfgs.so_dots[_key] = mark;
    map.addOverlay(mark);
}

// 线路搜索
mapApis.soRouter = function(start, end, type, no) {
    var rPolicy = [];
    rPolicy['1'] = [BMAP_TRANSIT_POLICY_LEAST_TIME,BMAP_TRANSIT_POLICY_LEAST_TRANSFER,BMAP_TRANSIT_POLICY_LEAST_WALKING,BMAP_TRANSIT_POLICY_AVOID_SUBWAYS];
    rPolicy['2'] = [BMAP_DRIVING_POLICY_LEAST_TIME,BMAP_DRIVING_POLICY_LEAST_DISTANCE,BMAP_DRIVING_POLICY_AVOID_HIGHWAYS];
    var transit = new BMap.TransitRoute(map, {
            renderOptions: {map: map},
            policy: 0
        });
    map.clearOverlays(); 
    var i = no ? no : '1'; 
    function search(start,end,route){ 
        transit.setPolicy(route);
        transit.search(start,end);
    }
    search(start,end,rPolicy[type][i]);
}

// Local搜索;
mapApis.soPiont = function(kw, cb){
    // 有缓存,直接返回
    if(!(typeof mapCfgs.so_res[kw]=='undefined')){
        // cb && cb(mapCfgs.so_res[kw]);
        sre = mapCfgs.so_res[kw];
        sre['cache'] = 1; // 缓存标记
        var options = {
                pageCapacity: 25,
                onSearchComplete:sre
            };
    }
    var sre, // 结果
            options = {
                pageCapacity: 25,
                onSearchComplete: function (ire) {
                    // 判断状态是否正确
                    if (local.getStatus() == BMAP_STATUS_SUCCESS) {
                        var rows = [];
                        for (var i = 0; i < ire.getCurrentNumPois(); i++) {
                            var itm = ire.getPoi(i);
                            var row = {
                                title: itm.title, p: itm.point, addr: itm.address,
                                tel: itm.phoneNumber, url: itm.url,style:'display:none'
                            }; //console.log(row);
                            rows.push(row);
                        }

                        var usrRows = [];
                        if(kw == '楼盘') {
                            for (var i = 0; i < usrData.length; i++) {
                                var itm = usrData[i];
                                var _point = new BMap.Point(itm.point.lng, itm.point.lat);
                                var row = {
                                    title: itm.title, p: _point, addr: itm.address,
                                    tel: itm.phoneNumber, url: itm.url,thumb: itm.thumb,style:''
                                }; //console.log(row);
                                usrRows.push(row);
                            }
                        }
                        sre = {erno: 0, kw: kw, rows: checkHouse(rows,usrRows)};
                    } else {
                        sre = {erno: 1, kw: kw, ermsg: '搜索错误'};
                    }
                    mapCfgs.so_res[kw] = sre;
                    // 缓存,回调,返回...
                    cb && cb(sre);
                    return sre;
                }
            };
    var local = new BMap.LocalSearch(map, options);
        //local.setPageCapacity(sre);
        //local.search(kw);
        local.searchNearby(kw, new BMap.Point(row.x, row.y));
        //local.searchInBounds(kw, map.getBounds());

}

// 创建地图,标基础点;
mapApis.create = function(title){
    map = new BMap.Map("mapObj");
    var point = new BMap.Point(row.x, row.y);
    map.centerAndZoom(point, mapCfgs.init_level);
    map.addControl(new BMap.NavigationControl({type:BMAP_NAVIGATION_CONTROL_ZOOM})); //缩放
    map.addControl(new BMap.ScaleControl()); // 比例尺
    map.addControl(new BMap.MapTypeControl()); //添加地图类型控件
    map.enableScrollWheelZoom();
    // 标注
    var elm = $(title);
    if(elm.length>0){ // 自定义覆盖物
        var html = elm.html().replace('(price)',row.price); 
        var myCompOverlay = new ComplexCustomOverlay(point, html, [22,10]);
        map.addOverlay(myCompOverlay);
    }else{ // 文字标注
        var marker = new BMap.Marker(point);
        map.addOverlay(marker);
        var label = new BMap.Label(title, {offset:new BMap.Size(15,-10)});
        marker.setLabel(label);
    }
}


// 计算两点距离 posDistance(a.map.citycenter.lng, a.map.citycenter.lat, l.lng, l.lat),
mapApis.disPos2 = function(e, a, t, n) {
    var i,s,r,o,p,l,d,u,
        pi = 3.14159265359,
        p2 = 6.28318530712,
        rad = 0.01745329252, // 1°=pi/180 rad=3.141592653589793/180=0.01745329252
        R = 6370693.5;
    return i = e * rad,
        s = a * rad,
        r = t * rad,
        o = n * rad,
        d = i - r,
        d > pi ? d = p2 - d : -pi > d && (d = p2 + d),
        p = R * Math.cos(s) * d,
        l = R * (s - o),
        u = Math.sqrt(p * p + l * l),
        parseInt(u)
} 

// 鼠标测距工具
mapApis.openDtools = function(){
    $.getScript(
        'http://api.map.baidu.com/library/DistanceTool/1.2/src/DistanceTool_min.js',
        function() {
            var myDis = new BMapLib.DistanceTool(map);
            myDis.open(); 
        }
    ); 
}

/*
* 楼盘对比
* */
function checkHouse(baidu,fzg){

    if(fzg.length < 25){
        var arr = fzg.concat(baidu);
        arr = distinct(arr);//再引用上面的任意一个去重方法
        return arr;
    }else{
        return fzg;
    }
}

function distinct(arr){
       var len = arr.length;
    arr.sort(function(a,b){  //对数组进行排序才能方便比较
        return a - b;
    })
    function loop(index){
        if(index >= 1){
            if(arr[index] === arr[index-1]){
                arr.splice(index,1);
            }
            loop(index - 1); //递归loop函数进行去重
        }
    }
    loop(len-1);
    return arr.slice(0,24);
};

/*

*/