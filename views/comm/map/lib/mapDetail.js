
// 楼盘详情页-地图
// 内部改版,主要修改这个文件
var catMap = {};

// 全屏
/*catMap.fullScreen = function(){ t = window.parent; t.callMapFullScreen(); }*/
// 线路:公交/自驾
catMap.lineSearch = function(type){
    $('#mapTab').hide();
    var t = $('.map_lp'); 
    $(t).eq(0).hide(); $(t).eq(1).show();
    if(type=='btn_gj'){
        $('#traffic_title').html('公交'); $('#traffic_type').html('1');
    }else{
        $('#traffic_title').html('驾车'), $('#traffic_type').html('2');
    }
}
// 切换:起始点
catMap.switchPos = function(){
    var e = $('#sstartname').val(),
        a = $('#sendname').val();
    $('#sstartname').val(a),
        $('#sendname').val(e)
}
// 搜索:线路
catMap.soRouts = function(){
    var a = $('#sstartname').val(),
        b = $('#sendname').val(),
        type = $('#traffic_type').html(),
        no = 1;    
    catMap.soPre();
    mapApis.soRouter(a, b, type, no);
}
// 切换:面板
catMap.openAndclose = function(){
    var e = $('#mapsele'),
        a = $('#roundmap_map'),
        t = $('#msclose'),
        n = '-260px';
    '1' === row.vtype && (n = '-300px'),
        e.css('marginRight') == n ? (e.css('marginRight', '0px'), a.css('width', row.width), t.css('backgroundPosition', 'left')) : (e.css('marginRight', n), a.css('width', row.wfull), t.css('backgroundPosition', 'right'))
}
// 搜索:显示结果
catMap.soView = function(res){
    if(res.erno){
        //console.log(res);
    }else{ 
        $('#mapTab').hide();
        $('#near_search_wrap').show();        
        // 再显示本批次:
        var tpl = $('#markItem').html(),
            css = "icss_"+res.kw;
        if(!mapCfgs.so_list[res.kw]){ // (typeof res.cache)=='undefined'
            $('#list_cont').append("<dt class='"+css+"'>"+res.kw+"</dt>");
        }else{
            $('.'+css).show(); // 之前有的显示,后面不在append
        } // console.log(res.cache, typeof res.cache, mapCfgs.so_list[res.kw]);
        for (var i=0; i<res.rows.length; i++) {
            var itm = res.rows[i];
            mapApis.iconMarker(res.kw, itm, i);
            if(!mapCfgs.so_list[res.kw]){ 
                var dis = mapApis.disPos2(itm.p.lng,itm.p.lat, row.x,row.y);
                var _key = (res.kw+'_'+itm.p.lng+'_'+itm.p.lat).replace(/\./g,'-');
                var _trow = {title:itm.title, addr:itm.addr, id:_key, css:css, m:dis};
                var html = mapApis.tplParse(0,_trow,tpl);
                $('#list_cont').append(html);                
            }
        }
        catMap.soEnd();
        mapCfgs.so_list[res.kw] = 1;
        //console.log(res.rows);
    }
}
// 搜索之前执行:
catMap.soPre = function(){
    $('.mark1, .mark2').hide(); 
    $("dt[class^='icss_'], dd[class^='icss_']").hide();
    var point = new BMap.Point(row.x, row.y);
    map.centerAndZoom(point, mapCfgs.init_level);
    map.clearOverlays(); 
} //
// z-index
catMap.posZindex = function(e, f){
    var p = $(e).parent();
    var zno = $(p).css('z-index');
    var val = f * Math.abs(parseInt(zno));
    $(p).css('z-index', val); //console.log(val);
} 
// 搜索之后执行:
catMap.soEnd = function(){
    // 标点颜色切换, .find('.mark1-red')
    $('.mark1-red, .mark1-blue').mouseover(function(){
        $(this).removeClass('mark1-red').addClass('mark1-blue');
        catMap.posZindex($(this).parent(), 1);
    }).mouseout(function(){
        $(this).addClass('mark1-red').removeClass('mark1-blue');
        catMap.posZindex($(this).parent(), -1);
    });
    // 标点信息窗
    $('.mark1, .mark2').click(function(){
        var _id = this.id.substring(1),
            info = mapCfgs.so_infos[_id],
            mark = mapCfgs.so_dots[_id]; 
        info.open(mark._point);
    }); 
    // 列表-标点:颜色关联切换
    $('#list_cont dd').each(function(no, e){
        var _id = this.id.substring(1), 
            piont = $('#p'+_id); 
        $(this).mouseover(function(){ 
            $(piont).find('.mark1-red').removeClass('mark1-red').addClass('mark1-blue');
            catMap.posZindex(piont, 1);
        }).mouseout(function(){ 
            $(piont).find('.mark1-blue').addClass('mark1-red').removeClass('mark1-blue');
            catMap.posZindex(piont, -1);
        }).click(function(){
            $(piont).click();
        });        
    });
}
// init:标点鼠标动作,鼠标测距;
catMap.init = function(){
    var that = this;
    // 标点鼠标动作1
    $('.qp01, .qp02').mouseover(function(){ // , .qp03, .qp04, .qp05
        $(this).toggleClass('qp01').toggleClass('qp02');
        $(this).find('span').show();
    }).mouseout(function(){
        $(this).toggleClass('qp01').toggleClass('qp02');
        $(this).find('span').hide();
    });
    // 鼠标测距,全屏,公交/自驾,返回
    $('#btn_disTool').bind('click', function(){ mapApis.openDtools(); });
    //$('#btn_fullScreen').bind('click', function(){ that.fullScreen(); });
    $('#btn_gj, #btn_jc').bind('click', function(){ that.lineSearch(this.id); });
    $('.map_tit').bind('click', function() {
        $('#mapTab').show();
        $('.map_lp').hide();
    });
    $('#btn_Router').on('click', function() { that.soRouts(); });
    // 切换:起始点，面板
    $('#changeStartEnd').bind('click', function(){ that.switchPos(); });
    $('#msclose').on('click', function() { that.openAndclose(); });
    // 搜索绑定
    $('#mapTab li a').each(function(no, e){ 
        $(this).click(function(){
            var keys = mapCfgs.so_items[this.id];
            catMap.soPre();
            for (var i=0; i<keys.length; i++) {
                var kw = keys[i];  
                t = mapApis.soPiont(kw, that.soView);
            } 
            //catMap.soEnd(); // 要放到回调里面
        });
    });
    //
    if(row.full=='0'){
        $('.nmaptitle').hide();
        $('#mapsele').hide();
        row.vtype = '0';
        that.openAndclose();
        mapApis.create('#mainPiont');
        //
    }    
    // test 
    //catMap.test();
    var x = map.getBounds(), d = x.getSouthWest(), p = x.getNorthEast();
    x = [];jQuery.each([d.lng, d.lat, p.lng, p.lat], function(index, value){x[index] = parseInt(value * 1000000) / 1000000});var bounds = x.join(',');
    $.get(map_query,{action:'map',entry:'xin',bounds: bounds,type:'dmap',limit:'25'},function (data) {
        usrData = data; // map_query.indexOf('.js?')>0 ? eval(data) : data
    });

    $('#loupan').trigger("click");
};

// 偏移测试
catMap.test = function(){
    var p0 = new BMap.Point(row.x,row.y);
    map.addOverlay(new BMap.Marker(p0));   
    var p1 = new BMap.Point(113.6985,22.8411);
    map.addOverlay(new BMap.Marker(p1));
    var data = {title:'itm.title', C:'X', id:'_key'};
    var html = mapApis.tplParse('#mark1Piont',data);
    map.addOverlay(new ComplexCustomOverlay(p1,html));
};

/*

*/
