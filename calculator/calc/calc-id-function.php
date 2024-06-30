<?
    function pt ($t) {
        if ($t>=0) return 6.1121*exp((18.678-$t/234.5)*$t/(257.14+$t*1))*100;
        else return 6.1115*exp((23.036-$t/333.7)*$t/(279.82+$t*1))*100;
    }
    function tp ($tp_p) {
        $tp_tmin=-100;
        $tp_tmax=100;
        $tp_t=($tp_tmin+$tp_tmax)/2;
        for ($tp_i=1;$tp_i<=20;$tp_i++) {
            $tp_p1=pt($tp_t);
            $tp_t1=$tp_t;
            if ($tp_p1>$tp_p) {$tp_t=($tp_t+$tp_tmin)/2; $tp_tmax=$tp_t1;}
            if ($tp_p1<$tp_p) {$tp_t=($tp_t+$tp_tmax)/2; $tp_tmin=$tp_t1;}
            if ($tp_p1==$tp_p) return $tp_t;
        }
        return $tp_t;
    }
    function tifi ($i1,$fi1) {
        $tp_tmin=-100;
        $tp_tmax=100;
        $tp_t=($tp_tmin+$tp_tmax)/2;
        for ($tp_i=1;$tp_i<=20;$tp_i++) {
            $fi11=pd(dit($i1,$tp_t))/pt($tp_t)*100;
            $tp_t1=$tp_t;
            if ($fi11<$fi1) {$tp_t=($tp_t+$tp_tmin)/2; $tp_tmax=$tp_t1;}
            if ($fi11>$fi1) {$tp_t=($tp_t+$tp_tmax)/2; $tp_tmin=$tp_t1;}
            if ($fi11==$fi1) return $tp_t;
        }
        return $tp_t;
    }
    function tdfi ($d1,$fi1) {
        $tp_tmin=-100;
        $tp_tmax=100;
        $tp_t=($tp_tmin+$tp_tmax)/2;
        for ($tp_i=1;$tp_i<=20;$tp_i++) {
            $fi11=pd($d1)/pt($tp_t)*100;
            $tp_t1=$tp_t;
            if ($fi11<$fi1) {$tp_t=($tp_t+$tp_tmin)/2; $tp_tmax=$tp_t1;}
            if ($fi11>$fi1) {$tp_t=($tp_t+$tp_tmax)/2; $tp_tmin=$tp_t1;}
            if ($fi11==$fi1) return $tp_t;
//            document.getElementById('zzz').innerHTML += $tp_i+'. Надо '+$fi1+'. При '+$tp_t1+' имеем '+$fi11+'. Будем проверять при '+$tp_t+' (от '+$tp_tmin+' до '+$tp_tmax+')<br>';
        }
        return $tp_t;
    }
    function dp ($p) {
        return 622*$p/(101325-$p*1);
    }
    function pd ($d) {
        return $d*101325/(622+$d*1);
    }
    function idt ($d,$t) {
        return (1.01+0.00197*$d)*$t+2.493*$d;
    }
    function tid ($i,$d) {
        return ($i-2.493*$d)/(1.01+0.00197*$d);
    }
    function dit ($i,$t) {
        return ($i*1-1.01*$t)/(0.00197*$t+2.493);
    }
    function fidt ($d,$t) {
        return $d*101325/(622+$d)/pt($t)*100;
    }
?>