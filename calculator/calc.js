
$("#error1 > img").click(function(){
    $("#error1").css("display","none");
})
function update_link(){
    	        link="";
    if ($('#t1_status').is(':checked'))  link+="&t1="+$("#t1").val();
    if ($('#fi1_status').is(':checked')) link+="&fi1="+$("#fi1").val();
    if ($('#d1_status').is(':checked'))  link+="&d1="+$("#d1").val();
    if ($('#i1_status').is(':checked'))  link+="&i1="+$("#i1").val();
    if ($('#p1_status').is(':checked'))  link+="&p1="+$("#p1").val();
    if ($('#tr1_status').is(':checked')) link+="&tr1="+$("#tr1").val();
    if ($('#t2_status').is(':checked')) link+="&t2="+$("#t2").val(); else
        if ($('#fi2_status').is(':checked')) link+="&fi2="+$("#fi2").val(); else
            if ($('#d2_status').is(':checked')) link+="&d2="+$("#d2").val(); else
                if ($('#i2_status').is(':checked')) link+="&i2="+$("#i2").val(); else
                    if ($('#p2_status').is(':checked')) link+="&p2="+$("#p2").val(); else
                        if ($('#tr2_status').is(':checked')) link+="&tr2="+$("#tr2").val(); else
                            if ($('#W2_status').is(':checked')) link+="&W2="+$("#W2").val(); else
                                if ($('#N2_status').is(':checked')) link+="&N2="+$("#N2").val();
    $("#copy_link").val('https://aboutdc.ru/page/1720.php'+"?type="+$('input[name="type"]:checked').prop("id")+"&G1="+$("#G1").val()+link+"#calculator");
}

$ (function() {
    TmaxDef=40;
    TminDef=-20;
    DmaxDef=30;
    DminDef=0;
    TmaxMax=100;
    TminMin=-100;
    DmaxMax=100;
    DminMin=0;

    chk_value1=2;
    function pt (t) {
        if (t>=0) return 6.1121*Math.exp((18.678-t/234.5)*t/(257.14+t*1))*100;
        else return 6.1115*Math.exp((23.036-t/333.7)*t/(279.82+t*1))*100;
    }
    function tdfi (d1,fi1) {
        var tp_tmin=TminMin;
        var tp_tmax=TmaxMax;
        tp_t=(tp_tmin+tp_tmax)/2;
        for (var tp_i=1;tp_i<=20;tp_i++) {
            fi11=d1*101375/(622+d1*1)/pt(tp_t)*100;
            tp_t1=tp_t;
            if (fi11<fi1) {tp_t=(tp_t+tp_tmin)/2; tp_tmax=tp_t1;}
            if (fi11>fi1) {tp_t=(tp_t+tp_tmax)/2; tp_tmin=tp_t1;}
            if (fi11==fi1) return tp_t;
        }
        return tp_t;
    }
    function dp (p) {
        return 622*p/(101325-p*1);
    }

    $("[name=type]").click(function() {
        $("#N2").prop('disabled', $("#ad").is(':checked'));
        $("#i2").prop('disabled', $("#ad").is(':checked'));
        $("#t2").prop('disabled', !$("#ad").is(':checked'));
        $("#N2_status").prop('disabled', $("#ad").is(':checked'));
        $("#i2_status").prop('disabled', $("#ad").is(':checked'));
        $("#t2_status").prop('disabled', !$("#ad").is(':checked'));
    });
    $(".point1").on('input', function() {
        if (document.getElementById($(this).attr("id")+'_status').checked==false) {
            document.getElementById($(this).attr("id")+'_status').checked=true;
            $('#'+$(this).attr("id")+'_status').trigger('click');
            document.getElementById($(this).attr("id")+'_status').checked=true;
        } else {
            recount_id();
        }
    });
    $(".point2").on('input', function() {
        if (document.getElementById($(this).attr("id")+'_status').checked==false) document.getElementById($(this).attr("id")+'_status').checked=true;
        recount_id();
    });
    $(".par").on('input', function() {
        recount_id();
    });
    $(".point1_status").click(function(){
        ide3=$(this).attr("id").replace('_status','');
        e1=document.querySelector('input[value="c'+(chk_value1-1)+'"]');
        ide1=e1.getAttribute("id").replace('_status','');
        e2=document.querySelector('input[value="c'+chk_value1+'"]');
        ide2=e2.getAttribute("id").replace('_status','');
        e3=document.getElementById(ide3+'_status');
        var arr=['d1','p1','tr1'];
        var arr1=[]; arr1['d1']='влагосодержание'; arr1['p1']='парциальное давление'; arr1['tr1']='точку росы';
        if (e3.checked==false) {
            e3.checked=true;
            alert ('Нельзя снимать галочки. Просто выберите другие параметры')
        } else if ((arr.indexOf(ide3)!=-1) && (arr.indexOf(ide2)!=-1)) {
            e3.checked=false;
            alert ('Нельзя выбрать '+arr1[ide2]+' и '+arr1[ide3]+', так как это взаимосвязанные параметры')
        } else {
            e1.checked=false;
            chk_value1++;
            e3.value='c'+chk_value1;
            e3.checked=true;
            
            if (arr.indexOf(ide3)!=-1) {
                for (var j=0;j<=2;j++) {
                    if (ide3!=arr[j]) {
                        document.getElementById(arr[j]+'_status').disabled=true;
                        document.getElementById(arr[j]).disabled=true;
                    }
                }
            } else {
                for (var j=0;j<=2;j++) {
                    document.getElementById(arr[j]+'_status').disabled=false;
                    document.getElementById(arr[j]).disabled=false;
                }
            }
        }
        recount_id();
    });
    function recount_id() {
        e1=document.querySelector('input[value="c'+(chk_value1-1)+'"]');
        ide1=e1.getAttribute("id").replace('_status','');
        e2=document.querySelector('input[value="c'+chk_value1+'"]');
        ide2=e2.getAttribute("id").replace('_status','');
        idi1=document.getElementById(ide1).value;
        idi2=document.getElementById(ide2).value;
        $.post('https://app.antarctis.ru/calculate', {ide1 : ide1, ide2 : ide2, idi1 : idi1, idi2 : idi2, ajax : 1}, function(ret){
            ret1=ret.split("|");
            $('#t1').val(ret1[0]);  t1=ret1[0];
            $('#fi1').val(ret1[1]);
            $('#d1').val(ret1[2]);  d1=ret1[2];
            $('#i1').val(ret1[3]);  i1=ret1[3];
            $('#p1').val(ret1[4]);
            $('#tr1').val(ret1[5]);
    		data[point1].data=[[d1,t1]];

            e2=document.querySelector("input.point2_status[type='radio']:checked");
            ide2=e2.getAttribute("id").replace('_status','');
            idi2=document.getElementById(ide2).value;
            if ($("#ad").is(':checked')==true) type=1; else type=0;
            $.post('https://app.antarctis.ru/calculate', {t1 : t1, d1 : d1, i1 : i1, G1 : $("#G1").val(), ide2 : ide2, idi2 : idi2, type: type, proc : 'humi', ajax : 2}, function(ret){
                ret1=ret.split("|");
                $('#t2').val(ret1[0]);  t2=ret1[0];
                $('#fi2').val(ret1[1]);
                $('#d2').val(ret1[2]);  d2=ret1[2];
                $('#i2').val(ret1[3]);
                $('#p2').val(ret1[4]);
                $('#tr2').val(ret1[5]);
                $('#N2').val(ret1[6]);
                $('#W2').val(ret1[7]);
                data[point2].data=[[d2,t2]];
                data[line1].data=[[d1,t1],[d2,t2]];
                
                $('#tmax').val(Math.max(TmaxDef, Math.min(TmaxMax, Math.max(Math.ceil(t1/5)*5, Math.ceil(t2/5)*5))));
                $('#tmin').val(Math.min(TminDef, Math.max(TminMin, Math.min(Math.floor(t1/5)*5, Math.floor(t2/5)*5))));
                $('#dmax').val(Math.max(DmaxDef, Math.min(DmaxMax, Math.max(Math.ceil(d1/5)*5, Math.ceil(d2/5)*5))));
                $('#dmin').val(Math.min(DminDef, Math.max(DminMin, Math.min(Math.floor(d1/5)*5, Math.floor(d2/5)*5))));
                id_draw();
                $('#error1').text(ret1[8]);
            });
        });
        update_link();
	}
	function id_draw() {
        
    	data = new Array();

        for (var i=0; i<=9; i+=1) {
            data[i] = {color: 'black', lines: {lineWidth: (i==9)?1:0.5}, shadowSize:0, data: []};
        }
        
        tmin=$('#tmin').val()*1;
        tmax=$('#tmax').val()*1;
    	for (var t = tmin; t <= tmax; t += 0.5) {
    	    for (var i=0; i<=9; i+=1) {
    	        if ((t>=0) || ((t<0) && (i%2==1))) data[i].data.push([dp(pt(t)*(i+1)/10), t]);
    	    }
    	}

        imin=$('#tmin').val();
        imax=(1.01+0.00197*$('#dmax').val())*$('#tmax').val()+2.493*$('#dmax').val();
    	for (var i=imin; i<=imax; i++) {
    	    d1=i/(2.493+1/2.493);
    	    if (i>-30) d1+=10;
    	    if (i>-25) d1-=1;
    	    if (i>-20) d1-=1;
    	    if (i>-10) d1-=2.5;
    	    if (i>0) d1-=2;
    	    if (i>10) d1-=2;
    	    if (i>20) d1-=2;
    	    if (i>30) d1-=1.5;
    	    if (i>50) d1-=1.5;
    	    if (i>80) d1-=1.5;
            if (i>=250) d1+=1.5;
    	    if (i<=-20) d1=1.43;
    	    if (i%5==0) d1+=0.15;
    	    if (i%10==0) d1+=0.15;
    	    data.push({color: 'black', lines: {lineWidth: (i%10==0)?1:0.5}, shadowSize:0, data: [[0,i/1.01],[d1/3, (i-2.493*d1/3)/(1.01+0.00197*d1/3)],[d1*2/3, (i-2.493*d1*2/3)/(1.01+0.00197*d1*2/3)],[d1, (i-2.493*d1)/(1.01+0.00197*d1)]]});
    	}
    	    
    	t1 = $('#t1').val();
    	d1 = $('#d1').val();
    	t2 = $('#t2').val();
    	d2 = $('#d2').val();
    	point1=data.length;
        data.push({color: 'red',  points: {show: true}, lines: {lineWidth: 1}, shadowSize:0, data: [[d1,t1]]});
    	point2=data.length;
        data.push({color: 'blue',  points: {show: true}, lines: {lineWidth: 1}, shadowSize:0, data: [[d2,t2]]});
    	line1=data.length;
        data.push({color: 'green',  points: {show: false}, lines: {lineWidth: 2}, shadowSize:0, data: [[d1,t1],[d2,t2]]});
		plot = $.plot($("#placeholder"), data, {
            xaxis: {min:$('#dmin').val(), max:$('#dmax').val()},    
            yaxis: {min:$('#tmin').val(), max:$('#tmax').val()},
        });
        label_draw();
        update_link();
	}
	function label_draw() {
	    o = plot.pointOffset({x:$('#d1').val(),y:$('#t1').val()});
        $("#placeholder").append("<div id='point1_label' style='position:absolute;left:"+(Math.min(659,Math.max(0,o.left))+5)+"px;top:"+(Math.min(763,Math.max(0,o.top))-17)+"px;color:red'><b>т.1</b></div>");
	    o = plot.pointOffset({x:$('#d2').val(),y:$('#t2').val()});
        $("#placeholder").append("<div id='point2_label' style='position:absolute;left:"+(Math.min(659,Math.max(0,o.left))+5)+"px;top:"+(Math.min(763,Math.max(0,o.top))-17)+"px;color:blue'><b>т.2</b></div>");
        for (var i=0; i<=9; i+=1) {
            x1=dp(pt($('#tmax').val())*(i+1)/10);
            if ((x1>$('#dmin').val())&&(x1<$('#dmax').val())) {
                o = plot.pointOffset({x:x1,y:$('#tmax').val()});
                $("#placeholder").append("<div style='position:absolute;left:"+(o.left-5)+"px;top:"+(o.top-17)+"px;color:#666;font-size:smaller'>"+(i+1)*10+"%</div>");
            } else {
                y1=tdfi($('#dmax').val(),(i+1)*10);
                if ((y1>$('#tmin').val())&&(y1<$('#tmax').val())) {
                    o = plot.pointOffset({x:$('#dmax').val(),y:y1});
                    $("#placeholder").append("<div style='position:absolute;left:"+(o.left+5)+"px;top:"+(o.top-5)+"px;color:#666;font-size:smaller'>"+(i+1)*10+"%</div>");
                }
            }
        }
    	for (var i=imin; i<=imax; i++) {
    	    d1=i/(2.493+1/2.493);
    	    if (i>-30) d1+=10;
    	    if (i>-25) d1-=1;
    	    if (i>-20) d1-=1;
    	    if (i>-10) d1-=2.5;
    	    if (i>0) d1-=2;
    	    if (i>10) d1-=2;
    	    if (i>20) d1-=2;
    	    if (i>30) d1-=1.5;
    	    if (i>50) d1-=1.5;
    	    if (i>80) d1-=1.5;
    	    if (i>=250) d1+=1.5;
    	    if (i<=-20) d1=1.43;
    	    if (i%5==0) d1+=0.15;
    	    if (i%10==0) d1+=0.15;
    	    t1=(i-2.493*d1)/(1.01+0.00197*d1);

    	    if ((i%10==0)&&(d1<$('#dmax').val())&&(d1>$('#dmin').val())&&(t1>($('#tmin').val()*1+1)&&(t1<($('#tmax').val()*1+1)))) {
                o = plot.pointOffset({x:d1,y:t1});
                $("#placeholder").append("<div style='position:absolute;left:"+(o.left-2)+"px;top:"+(o.top+2)+"px;color:#666;font-size:smaller'>"+i+"</div>");
    	    }
    	}
	}
	
    $('#tmax').val(TmaxDef); $('#tmin').val(TminDef); $('#dmax').val(DmaxDef); $('#dmin').val(DminDef);
    $(".sel").click(function(){$(this).select()});
    $(".dot").click(function(){$('#tmax').val(TmaxDef); $('#tmin').val(TminDef); $('#dmax').val(DmaxDef); $('#dmin').val(DminDef); id_draw();});
    $("#tmin").on('input', function(){if(this.value<TminMin)this.value=TminMin;   if(this.value*1>=$('#tmax').val()*1)this.value=$('#tmax').val()*1-1; id_draw()});
    $("#tmax").on('input', function(){if(this.value>TmaxMax)this.value=TmaxMax;   if(this.value*1<=$('#tmin').val()*1)this.value=$('#tmin').val()*1+1; id_draw()});
    $("#dmin").on('input', function(){if(this.value<DminMin)this.value=DminMin;   if(this.value*1>=$('#dmax').val()*1)this.value=$('#dmax').val()*1-1; id_draw()});
    $("#dmax").on('input', function(){if(this.value>DmaxMax)this.value=DmaxMax;   if(this.value*1<=$('#dmin').val()*1)this.value=$('#dmin').val()*1+1; id_draw()});
	id_draw();
	recount_id();
});