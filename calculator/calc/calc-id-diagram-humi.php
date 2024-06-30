<?
//header('Content-type: text/html; charset=UTF-8');
//mb_internal_encoding('UTF-8');

require "calc-id-function.php";
$ajax = (int)$_POST['ajax'];

if ($ajax==1) {

    function round1($n, $m) {
        return number_format($n, floor(max(0, $m-log($n)/log(10))), '.', ' ');//  round($n, floor(max(0, $m-log($n)/log(10))));
    }

    $par = array((string)$_POST['ide1'],(string)$_POST['ide2']);
    $val = array((float)$_POST['idi1'],(float)$_POST['idi2']);
	${$par[0]} = $val[0];
	${$par[1]} = $val[1];

    if ((isset($t1)) && (isset($fi1))) {
		$p1=pt($t1)*$fi1/100;
		$d1=dp($p1);
		$i1=idt($d1,$t1);
		$tr1=tp($p1);
    } else if ((isset($t1)) && (isset($d1))) {
		$i1=idt($d1,$t1);
		$p1=pd($d1);
		$fi1=fidt($d1,$t1);
		$tr1=tp($p1);
    } else if ((isset($t1)) && (isset($i1))) {
		$d1=dit($i1,$t1);
		$p1=pd($d1);
		$fi1=fidt($d1,$t1);
		$tr1=tp($p1);
    } else if ((isset($t1)) && (isset($p1))) {
        $p1=$p1*1000;
		$d1=dp($p1);
		$i1=idt($d1,$t1);
		$fi1=fidt($d1,$t1);
		$tr1=tp($p1);
    } else if ((isset($t1)) && (isset($tr1))) {
		$p1=pt($tr1);
		$d1=dp($p1);
		$i1=idt($d1,$t1);
		$fi1=fidt($d1,$t1);
    } else if ((isset($fi1)) && (isset($d1))) {
		$p1=pd($d1);
		$tr1=tp($p1);
		$t1=tp($p1*100/$fi1);
		$i1=idt($d1,$t1);
    } else if ((isset($fi1)) && (isset($i1))) {
		$t1=tifi($i1,$fi1);
		$d1=dit($i1,$t1);
		$p1=pd($d1);
		$tr1=tp($p1);
    } else if ((isset($fi1)) && (isset($p1))) {
        $p1=$p1*1000;
		$d1=dp($p1);
		$tr1=tp($p1);
		$t1=tp($p1*100/$fi1);
		$i1=idt($d1,$t1);
    } else if ((isset($fi1)) && (isset($tr1))) {
		$p1=pt($tr1);
		$d1=dp($p1);
		$t1=tp($p1*100/$fi1);
		$i1=idt($d1,$t1);
    } else if ((isset($d1)) && (isset($i1))) {
		$t1=tid($i1,$d1);
		$p1=pd($d1);
		$fi1=fidt($d1,$t1);
		$tr1=tp($p1);
    } else if ((isset($i1)) && (isset($p1))) {
        $p1=$p1*1000;
		$d1=dp($p1);
		$t1=tid($i1,$d1);
		$fi1=fidt($d1,$t1);
		$tr1=tp($p1);
    } else if ((isset($i1)) && (isset($tr1))) {
		$p1=pt($tr1);
		$d1=dp($p1);
		$t1=tid($i1,$d1);
		$fi1=fidt($d1,$t1);
    }
//    $m=4; echo round1($t1,$m)."|".round1($fi1,$m)."|".round1($d1,$m)."|".round1($i1,$m)."|".round1($p1/1000,$m)."|".round1($tr1,$m);
//    echo "$t1|$fi1|$d1|$i1|".($p1/1000)."|$tr1";
    echo round($t1,2)."|".round($fi1,2)."|".round($d1,2)."|".round($i1,2)."|".round($p1/1000,2)."|".round($tr1,2);
} else if ($ajax==2) {
    $t1 = (float)$_POST['t1'];
    $d1 = (float)$_POST['d1'];
    $i1 = (float)$_POST['i1'];
    $fi1=fidt($d1,$t1);
    $G1 = (float)$_POST['G1'];
	${(string)$_POST['ide2']} = (float)$_POST['idi2'];
    $type = (int)$_POST['type'];
    if ((string)$_POST['proc']=='humi') {
        if ($type==1) {
            $i2=$i1;
            if (isset($t2)) {
        		$d2=dit($i2,$t2);
                $p2=pd($d2);
                $tr2=tp($p2);
    		    $fi2=fidt($d2,$t2);
        		$N2=abs(($i2-$i1)*1.2*$G1/3600);
        		$W2=abs(($d2-$d1)*1.2*$G1/1000);
            } else if (isset($fi2)) {
        		$t2=tifi($i2,$fi2);
        		$d2=dit($i2,$t2);
                $p2=pd($d2);
                $tr2=tp($p2);
        		$N2=abs(($i2-$i1)*1.2*$G1/3600);
        		$W2=abs(($d2-$d1)*1.2*$G1/1000);
            } else if (isset($d2)) {
    		    $t2=tid($i2,$d2);
    		    $fi2=fidt($d2,$t2);
                $p2=pd($d2);
                $tr2=tp($p2);
        		$N2=abs(($i2-$i1)*1.2*$G1/3600);
        		$W2=abs(($d2-$d1)*1.2*$G1/1000);
            } else if (isset($p2)) {
                $p2=$p2*1000;
        		$d2=dp($p2);
    		    $t2=tid($i2,$d2);
    		    $fi2=fidt($d2,$t2);
                $tr2=tp($p2);
        		$N2=abs(($i2-$i1)*1.2*$G1/3600);
        		$W2=abs(($d2-$d1)*1.2*$G1/1000);
            } else if (isset($tr2)) {
        		$p2=pt($tr2);
        		$d2=dp($p2);
    		    $t2=tid($i2,$d2);
    		    $fi2=fidt($d2,$t2);
        		$N2=abs(($i2-$i1)*1.2*$G1/3600);
        		$W2=abs(($d2-$d1)*1.2*$G1/1000);
            } else if (isset($W2)) {
                $d2=$d1*1 + $W2*1000/1.2/$G1;
    		    $t2=tid($i2,$d2);
                $p2=pd($d2);
                $tr2=tp($p2);
    		    $fi2=fidt($d2,$t2);
        		$N2=abs(($i2-$i1)*1.2*$G1/3600);
            } 
            if (($fi2>100) or ($fi2<$fi1)) {
                if ($fi2>100) { $fi2=100; $error="Достигнут предел увлажнения"; }
                if ($fi2<$fi1) { $fi2=$fi1; $error="Невозможно увлажнить: влажность должна быть выше начальной"; }
                $t2=tifi($i2,$fi2);
                $d2=dit($i2,$t2);
                $p2=pd($d2);
                $tr2=tp($p2);
                $N2=abs(($i2-$i1)*1.2*$G1/3600);
                $W2=abs(($d2-$d1)*1.2*$G1/1000);
            }
        } else {
            $t2=$t1;
            if (isset($fi2)) {
        		$p2=pt($t2)*$fi2/100;
        		$d2=dp($p2);
        		$i2=idt($d2,$t2);
        		$tr2=tp($p2);
        		$N2=abs(($i2-$i1)*1.2*$G1/3600);
        		$W2=abs(($d2-$d1)*1.2*$G1/1000);
            } else if (isset($d2)) {
        		$i2=idt($d2,$t2);
        		$p2=pd($d2);
        		$fi2=fidt($d2,$t2);
        		$tr2=tp($p2);
        		$N2=abs(($i2-$i1)*1.2*$G1/3600);
        		$W2=abs(($d2-$d1)*1.2*$G1/1000);
            } else if (isset($i2)) {
        		$d2=dit($i2,$t2);
        		$p2=pd($d2);
        		$fi2=fidt($d2,$t2);
        		$tr2=tp($p2);
        		$N2=abs(($i2-$i1)*1.2*$G1/3600);
        		$W2=abs(($d2-$d1)*1.2*$G1/1000);
            } else if (isset($p2)) {
                $p2=$p2*1000;
        		$d2=dp($p2);
        		$i2=idt($d2,$t2);
        		$fi2=fidt($d2,$t2);
        		$tr2=tp($p2);
        		$N2=abs(($i2-$i1)*1.2*$G1/3600);
        		$W2=abs(($d2-$d1)*1.2*$G1/1000);
            } else if (isset($tr2)) {
        		$p2=pt($tr2);
        		$d2=dp($p2);
        		$i2=idt($d2,$t2);
        		$fi2=fidt($d2,$t2);
        		$N2=abs(($i2-$i1)*1.2*$G1/3600);
        		$W2=abs(($d2-$d1)*1.2*$G1/1000);
            } else if (isset($N2)) {
                $i2=$i1*1 + $N2*3600/1.2/$G1;
        		$d2=dit($i2,$t2);
        		$fi2=fidt($d2,$t2);
        		$p2=pd($d2);
        		$tr2=tp($p2);
        		$W2=abs(($d2-$d1)*1.2*$G1/1000);
            } else if (isset($W2)) {
                $d2=$d1*1 + $W2*1000/1.2/$G1;
        		$i2=idt($d2,$t2);
        		$fi2=fidt($d2,$t2);
        		$p2=pd($d2);
        		$tr2=tp($p2);
        		$N2=abs(($i2-$i1)*1.2*$G1/3600);
            }
            if (($fi2>100) or ($fi2<$fi1)) {
                if ($fi2>100) { $fi2=100; $error="Достигнут предел увлажнения"; }
                if ($fi2<$fi1) { $fi2=$fi1; $error="Невозможно увлажнить: влажность должна быть выше начальной"; }
        		$p2=pt($t2)*$fi2/100;
        		$d2=dp($p2);
        		$i2=idt($d2,$t2);
        		$tr2=tp($p2);
        		$N2=abs(($i2-$i1)*1.2*$G1/3600);
        		$W2=abs(($d2-$d1)*1.2*$G1/1000);
            }
        }
    }
    echo round($t2,2)."|".round($fi2,2)."|".round($d2,2)."|".round($i2,2)."|".round($p2/1000,2)."|".round($tr2,2)."|".round($N2,2)."|".round($W2,2)."|".$error;
} else {?>
	<script language="javascript" type="text/javascript" src="/js/flot/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="/js/flot/jquery.flot.js"></script>

	<style>
	    input,button {box-sizing: border-box;}
		input[type="number"] {width: 70px;height:initial;}
		.dot {border-bottom: 1px dotted black; font-weight:normal; font-size:smaller; float:right;}
		.dot:hover {cursor:pointer;}
		.bez_radio {margin-left:25px;}

		table {margin: 0 auto};
		table, tr, th, td {border-collapse: collapse; border: solid #eee 1px;}
		th, td {padding: 5px;}
		th {background: #eee;}

        .demo-container {
        	box-sizing: border-box;
        	width: 696px;
        	height: 800px;
        	padding: 20px 25px 15px 10px;
        	margin: 15px auto 30px auto;
        	border: 1px solid #ddd;
        	background: linear-gradient(#f6f6f6 0, #fff 50px);
        	background: -o-linear-gradient(#f6f6f6 0, #fff 50px);
        	background: -ms-linear-gradient(#f6f6f6 0, #fff 50px);
        	background: -moz-linear-gradient(#f6f6f6 0, #fff 50px);
        	background: -webkit-linear-gradient(#f6f6f6 0, #fff 50px);
        	box-shadow: 0 3px 10px rgba(0,0,0,0.15);
        	-o-box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        	-ms-box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        	-moz-box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        	-webkit-box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        
        .demo-placeholder {
        	background: #fff;
        	background: url('/calc/logo-mkhwh-300x95.png') center repeat-y;
        	background-size: contain;
        	width: 100%;
        	height: 100%;
        	font-size: 14px;
        	line-height: 1.2em;
        }
    
    </style>
	
<script>
	    function copy_to_clipboard(){
            navigator.clipboard.writeText($("#copy_link").val())
                .then(() => {
                    $("#button_copy").html("Скопировано")
                    setTimeout(() => $("#button_copy").html("Копировать"),1000);
                })
                .catch(err => {
                    $("#is_copy").css("color","#c00").fadeIn().text("Ошибка. Скопируйте из поля самостоятельно").fadeOut(2000);
                })
	    }
	    function update_link(){
	        <?$link="https://".$_SERVER["HTTP_HOST"].(isset($_GET["id"])?"/page/".$_GET["id"].".php":$_SERVER["REQUEST_URI"]);?>
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
            $("#copy_link").val('<?=$link?>'+"?type="+$('input[name="type"]:checked').prop("id")+"&G1="+$("#G1").val()+link+"#calculator");
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
            $.post('/calc/calc-id-diagram-humi.php', {ide1 : ide1, ide2 : ide2, idi1 : idi1, idi2 : idi2, ajax : 1}, function(ret){
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
                $.post('/calc/calc-id-diagram-humi.php', {t1 : t1, d1 : d1, i1 : i1, G1 : $("#G1").val(), ide2 : ide2, idi2 : idi2, type: type, proc : 'humi', ajax : 2}, function(ret){
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
</script>

    <a name='calculator'></a>
    <table id='calc_table'><tbody>
		<tr><td colspan=4 style='text-align:center;'><a href='https://aboutdc.ru/page/1729.php' target='_blank'><span style='color:red;'><b>Хочу такой же калькулятор себе на сайт</b></span></a></td></tr>
		<tr>
			<th colspan=4>Настройка ID-диаграммы <span class='dot'>по умолчанию</span></th>
		</tr>
		<tr>
			<td colspan=2>Минимальная температура</td>
			<td><input class='sel bez_radio' type='number' id='tmin' value='-20' min='-100' max='100' step='1'/></td>
			<td>°С</td>
		</tr>
		<tr>
			<td colspan=2>Максимальная температура</td>
			<td><input class='sel bez_radio' type='number' id='tmax' value='40' min='-100' max='100' step='1'/></td>
			<td>°С</td>
		</tr>
		<tr>
			<td colspan=2>Минимальное влагосодержание</td>
			<td><input class='sel bez_radio' type='number' id='dmin' value='0' min='0' max='50' step='1'/></td>
			<td>г/кг</td>
		</tr>
		<tr>
			<td colspan=2>Максимальное влагосодержание</td>
			<td><input class='sel bez_radio' type='number' id='dmax' value='50' min='0' max='100' step='1'/></td>
			<td>г/кг</td>
		</tr>
		<tr>
			<th colspan=4>Расчет увлажнителя по ID-диаграмме</th>
		</tr>
		
		<?
		    $status=0; $d_flag=true;
		    if (isset($_GET["t1"]))                                     {$status++; $t1_status="c".$status; }               else $t1_status="c0";
		    if (isset($_GET["fi1"]))                                    {$status++; $fi1_status="c".$status;}               else $fi1_status="c0";
		    if ((isset($_GET["d1"])) and ($status<2))                   {$status++; $d1_status="c".$status; $d_flag=false;} else $d1_status="c0";
		    if ((isset($_GET["i1"])) and ($status<2))                   {$status++; $i1_status="c".$status;}                else $i1_status="c0";
		    if ((isset($_GET["p1"])) and ($status<2) and ($d_flag))     {$status++; $p1_status="c".$status; $d_flag=false;} else $p1_status="c0";
		    if ((isset($_GET["tr1"])) and ($status<2) and ($d_flag))    {$status++; $tr1_status="c".$status;$d_flag=false;} else $tr1_status="c0";
		    if (($status<2) and ($t1_status=="c0"))                     {$status++; $t1_status="c".$status; }
		    if (($status<2) and ($fi1_status=="c0"))                    {$status++; $fi1_status="c".$status;}
		    if (($status<2) and ($i1_status=="c0"))                     {$status++; $i1_status="c".$status; }
		    
		    if ((!isset($_GET["d2"]))and(!isset($_GET["i2"]))and(!isset($_GET["N2"]))) $t2_status="checked"; else $t2_status="";
		?>
		
		<tr>
			<td>Тип увлажнителя</td>
			<td colspan=3><input type='radio' id='ad' name='type' class='par' <?=($_GET["type"]=='ad')?"checked":(isset($_GET["type"])?"":"checked")?>/><label for='ad'>Адиабатический</label>&nbsp;&nbsp;&nbsp;<input type='radio' id='el' name='type' class='par' <?=($_GET["type"]=='el')?"checked":""?>/><label for='el'>Пароувлажнитель</label></td>
		</tr>
		<tr>
			<td colspan=2>Расход воздуха</td>
			<td><input type='number' id='G1' value='<?=isset($_GET["G1"])?$_GET["G1"]:1000?>' class='par bez_radio' min='0' step='1'/></td>
			<td>м<sup>3</sup>/ч</td>
		</tr>
		<tr>
			<th>Параметр</th>
			<th style='color:red;'>Точка 1</th>
			<th style='color:blue;'>Точка 2</th>
			<th></th>
		</tr>
		<tr>
			<td>Температура</td>
<!--			<td><input class='point1_status' id='t1_status' type='checkbox' value='c2' checked /> <input class='sel point1' type='number' id='t1' value='20' step='1'/></td>-->
			<td><input class='point1_status' id='t1_status' type='checkbox' value='<?=$t1_status?>' <?=($t1_status=='c0')?"":"checked"?> /><input class='sel point1' type='number' id='t1' value='<?=isset($_GET["t1"])?$_GET["t1"]:20?>' step='1'/></td>
			<td><input class='point2_status' id='t2_status' type='radio' name='radio_p2' <?=isset($_GET["t2"])?"checked":$t2_status?> /> <input class='sel point2' type='number' id='t2' value='<?=isset($_GET["t2"])?$_GET["t2"]:30?>' step='1'/></td>
			<td>°С</td>
		</tr>
		<tr>
			<td>Влажность, %</td>
<!--			<td><input class='point1_status' id='fi1_status' type='checkbox' value='c1' checked />  <input class='sel point1' type='number' id='fi1' value='50' min='0' step='1'/></td>-->
			<td><input class='point1_status' id='fi1_status' type='checkbox' value='<?=$fi1_status?>' <?=($fi1_status=='c0')?"":"checked"?> /><input class='sel point1' type='number' id='fi1' value='<?=isset($_GET["fi1"])?$_GET["fi1"]:50?>' min='0' step='1'/></td>
			<td><input class='point2_status' id='fi2_status' type='radio' name='radio_p2' <?=isset($_GET["fi2"])?"checked":$fi2_status?> /> <input class='sel point2' type='number' id='fi2' value='<?=isset($_GET["fi2"])?$_GET["fi2"]:90?>' min='0' min='100' step='1'/></td>
			<td>%</td>
		</tr>
		<tr>
			<td>Влагосодержание, г/кг</td>
<!--			<td><input class='point1_status' id='d1_status' type='checkbox' value='c0' />           <input class='sel point1' type='number' id='d1' value='' min='0' step='1'/></td>-->
			<td><input class='point1_status' id='d1_status' type='checkbox' value='<?=$d1_status?>' <?=($d1_status=='c0')?"":"checked"?> /><input class='sel point1' type='number' id='d1' value='<?=isset($_GET["d1"])?$_GET["d1"]:''?>' min='0' step='1'/></td>
			<td><input class='point2_status' id='d2_status' type='radio' name='radio_p2' <?=isset($_GET["d2"])?"checked":$d2_status?> />   <input class='sel point2' type='number' id='d2' value='<?=isset($_GET["d2"])?$_GET["d2"]:0?>' min='0' step='1'/></td>
			<td>г/кг</td>
		</tr>
		<tr>
			<td>Энтальпия</td>
<!--			<td><input class='point1_status' id='i1_status' type='checkbox' value='c0' />           <input class='sel point1' type='number' id='i1' value='' step='1'/></td>-->
			<td><input class='point1_status' id='i1_status' type='checkbox' value='<?=$i1_status?>' <?=($i1_status=='c0')?"":"checked"?> /><input class='sel point1' type='number' id='i1' value='<?=isset($_GET["i1"])?$_GET["i1"]:''?>' step='1'/></td>
			<td><input class='point2_status' id='i2_status' type='radio' name='radio_p2' <?=isset($_GET["i2"])?"checked":$i2_status?> /> <input class='sel point2' type='number' id='i2' value='<?=isset($_GET["i2"])?$_GET["i2"]:0?>' step='1' /></td>
			<td>кДж/кг</td>
		</tr>
		<tr>
			<td>Парц.давление, кПа</td>
<!--			<td><input class='point1_status' id='p1_status' type='checkbox' value='c0' />           <input class='sel point1' type='number' id='p1' value='' min='0' step='0.1'/></td>-->
			<td><input class='point1_status' id='p1_status' type='checkbox' value='<?=$p1_status?>' <?=($p1_status=='c0')?"":"checked"?> /><input class='sel point1' type='number' id='p1' value='<?=isset($_GET["p1"])?$_GET["p1"]:''?>' step='1'/></td>
			<td><input class='point2_status' id='p2_status' type='radio' name='radio_p2' <?=isset($_GET["p2"])?"checked":$p2_status?> />   <input class='sel point2' type='number' id='p2' value='<?=isset($_GET["p2"])?$_GET["p2"]:0?>' min='0' step='0.1'/></td>
			<td>кПа</td>
		</tr>
		<tr>
			<td>Точка росы, °С</td>
<!--			<td><input class='point1_status' id='tr1_status' type='checkbox' value='c0' />          <input class='sel point1' type='number' id='tr1' value='' step='1'/></td>-->
			<td><input class='point1_status' id='tr1_status' type='checkbox' value='<?=$tr1_status?>' <?=($tr1_status=='c0')?"":"checked"?> /><input class='sel point1' type='number' id='tr1' value='<?=isset($_GET["tr1"])?$_GET["tr1"]:''?>' step='1'/></td>
			<td><input class='point2_status' id='tr2_status' type='radio' name='radio_p2' <?=isset($_GET["tr2"])?"checked":$tr2_status?> />   <input class='sel point2' type='number' id='tr2' value='<?=isset($_GET["tr2"])?$_GET["tr2"]:0?>' step='1'/></td>
			<td>°С</td>
		</tr>
		<tr>
			<td colspan=2>Расход воды, кг</td>
			<td><input class='point2_status' id='W2_status' type='radio' name='radio_p2' <?=isset($_GET["N2"])?"checked":""?> />  <input class='sel point2' type='number' id='W2' value='<?=isset($_GET["W2"])?$_GET["W2"]:0?>' min='0' step='1'/></td>
			<td>кг/ч</td>
		</tr>
		<tr>
			<td colspan=2>Потребляемая мощность, кВт</td>
			<td><input class='point2_status' id='N2_status' type='radio' name='radio_p2' <?=isset($_GET["N2"])?"checked":""?> /> <input class='sel point2' type='number' id='N2' value='<?=isset($_GET["N2"])?$_GET["N2"]:0?>' min='0' step='1' /></td>
			<td>кВт</td>
		</tr>
		<tr>
            <td colspan=4 id='error1' style='color: #f00; font-size: smaller;'></td>
		</tr>
		<tr><td colspan=4 style='text-align:center;'><a href='https://aboutdc.ru/page/1729.php' target='_blank'><span style='color:red;'><b>Хочу такой же калькулятор себе на сайт</b></span></a></td></tr>
		<tr><td colspan=4><span style='color:blue;'><b>Ссылка на этот расчет: </b></span><input type='text' id='copy_link' value='' onclick='select(this)'> <button style='width:100px;height:28px;' id='button_copy' onclick='copy_to_clipboard()'>Копировать</button> <div id='is_copy'></div></td></tr>
	</tbody></table>
	<div id='zzz'></div>

	<div class="demo-container">
		<div id="placeholder" class="demo-placeholder"></div>
	</div>

<?}?>