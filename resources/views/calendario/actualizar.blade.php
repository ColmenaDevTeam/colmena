@extends('layouts.main_layout')
@section('contenido')
    <section id="inner-headline" @if(count($fechasGuardadas)) onLoad="alert('Esto es el onload con registros')"@endif>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="pageTitle">Actualizacion de Calendario {{date('Y')}}</h2>
                </div>
            </div>
        </div>
    </section>
    <section id="content">
        <div class="container">
            @if(session()->has('estado'))
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <p> </p>
                        @if(session('estado')=="realizado")
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Muy Bien!</strong> El calendario se ha actualizado con exito!.
                            </div>
                        @else
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>¡Error!</strong> Ocurrió un error al actualizar. Por favor intentelo de nuevo
                            </div>
                        @endif
                    </div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12-->
                </div><!-- /.row-->
            @endif

            <div class="form-group has-feedback">
                <span class="help-block">
                    <p class="" style="font-weight: bold;">
                        *Al actualizar el calendario, puede seleccionar un conjunto de
                        fechas. Estas fechas representan los dias que seran tomados
                        como laborables.
                    </p>
                    <p style="font-weight: bold;">
                        *Si deselecciona un dia laborable las tareas que fueron asignadas
                        para dicha fecha seran reasignadas a la siguiente fecha laborable.
                    </p>
                    <p style="font-weight: bold;">
                        *Tome en cuenta que el sistema solo permitira la modificacion de las
                        fechas que se encuentren en un rango de dos(2) semanas antes de la fecha
                        actual.
                    </p>
                    <p style="font-weight: bold;">
                        *Al seleccionar una fecha, esta es marcada en color <font color="#6198fd" size="5">AZUL</font>.
                    </p>
                </span>

            </div>

            <?php $m=0; ?>
            <form id="calendar-form" role="form" method="post" name="formularioCalendario" action="/calendario/actualizar">
            {!! csrf_field() !!}
                <?php $dmonth="" ?>
                @foreach ($months as $weeks)

                    <div class="row">
                        <div class="table-responsive">
                            <table class="table" align="center">

                                <tr>
                                    <td></td><td></td><td></td><td></td>
                                    <td align="center" ><i class="fa fa-calendar" value="">  {{$meses[$m]}}</td>
                                    <td></td><td></td> <td></td>
                                </tr>
                                <tr>
                                    <td align="center">Lunes</td>
                                    <td align="center">Martes</td>
                                    <td align="center">Miércoles</td>
                                    <td align="center">Jueves</td>
                                    <td align="center">Viernes</td>
                                    <td align="center">
                                        <font color="#7C0101">Sábado</font>
                                    </td>
                                    <td align="center">
                                        <font color="#7C0101">Domingo</font>
                                    </td>
                                </tr>

                                @foreach ($weeks as $days)
                                    <?php $week ="" ?>
                                    <tr>
                                        @for ($i=1;$i<=7;$i++)

                                            @if ($i==6 or $i==7)
                                                <td align="center">
                                                    <font color="#7C0101"> {{isset($days[$i]) ? $days[$i] : ''}}</font>
                                                </td>
                                            @else
                                                <td align="center" >
                                                    @if(isset($days[$i]))
                                                        <a href="#{{$days[$i]}}" onClick="setCheck('{{$days[$i]}}-{{$m+1}}','{{$days[$i]}}-{{$m+1}}-{{date('Y')}}')" class="list-group-item">
                                                            <div id="{{$days[$i]}}-{{$m+1}}-{{date('Y')}}">
                                                                <input type="checkbox" id="{{$days[$i]}}-{{$m+1}}" name="fechas[]" value="{{$days[$i]}}-{{$m+1}}-{{date('Y')}}" hidden="">
                                                                    {{$days[$i]}}
                                                            </div>
                                                        </a>
                                                        <?php $week=$week.$days[$i]." " ?>
                                                    @endif
                                                </td>
                                            @endif
                                        @endfor
                                        <?php $dmonth=$dmonth.$week."-" ?>
                                        <td align="center" >
                                        Semana

                                            <button class="btn" name="seleccionarSemana" onClick="checkWeek('{{$week}}', '{{$m+1}}')" type="button">
                                                <i class="fa fa-check"></i>
                                            </button>
                                        </td>
                                    </tr>

                                @endforeach
                                <tr>
                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                    <td>
                                        Seleccionar {{$meses[$m]}}
                                        <button class="btn" id="CheckMeses" onClick="checkMonth('{{$dmonth}}','{{$m+1}}')" type="button">
                                            <i class="fa fa-check" la cantivalue=""></i>
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </div><!--"table responsive"-->
                    </div><!-- /.row -->
                    <?php $m+=1; ?>
                    <?php $dmonth="" ?>
                @endforeach
                <button type="button" class="btn" onClick="validar()">Actualizar Calendario</button>
            </form>
        </div><!-- /.container-->
    </section>
@endsection
<script type="text/javascript">
    function setCheck(item,item2){
        if(document.getElementById(item).checked){
            document.getElementById(item).checked = false;
            document.getElementById(item2).style.background="#FFF";
        }
        else{
            document.getElementById(item).checked = true;
            document.getElementById(item2).style.background="#6198fd";
        }
    }

    function checkWeek (week,month){
        var dia="";
        var div="";
        if (!week) {}
        else{
            semana = week.split(" ");
            d = new Date();
            year = d.getFullYear();
            for(var i=0; i<semana.length-1; i++){
                dia = semana[i]+"-"+month;
                div = dia+"-"+year;
                setCheck(dia,div);
            }
        }
    }

    function checkMonth(dmonth, month){
        var aux = "";
        mWeeks = dmonth.split("-");
        for(var q=0; q<(mWeeks.length-1); q++){
            aux=mWeeks[q];
            checkWeek(aux,month);
        }
    }
    function checkYear(dates){
        aDates= dates.split(" ")
    }

    function validar(){
        //Validar las fechas
        var fechas = document.getElementsByName("fechas[]");
        var contieneFechas = false;
        for(var i = 0; i < fechas.length; i++){
            //Si existe alguna fecha "checkeada", digamos qque
            //contiene fechas y rompemos el ciclo
            if(fechas[i].checked == true){
                contieneFechas = true;
                break;
            }
        }
        //Si no fue seleccionada ninguna fecha
        if(!contieneFechas){
            //Lanzar dialogo de alerta para que seleccione fechas
            alert("Debe seleccionar las fechas del calendario");
            return false;
        }
        else{
            document.formularioCalendario.submit();
            return true;
        }
    }
</script>
