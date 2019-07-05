@extends('layouts.app')
@section('liste_actif')
    active
@endsection
@section('page')
    <style>
        #mydiv {
            position: fixed;
            z-index: 9;
            left:0;
            top:250px;
            background-color: #f1f1f1;
            text-align: center;
            border: 1px solid #d3d3d3;
            overflow: hidden;
        }

        #mydivheader {
            padding: 10px;
            cursor: move;
            z-index: 10;
            background-color: #2196F3;
            color: #fff;
        }
        .gros {
            width: 1000px;
            height: 700px;
        }

        .grosImage {
            width: 1000px;
            height: 650px;
        }
        .petit {
            width: 10%;
            height: 300px;
        }
        .petitImage {
            width: 187px;
            height:200px;
        }
        .risk {
            background-color: #f50017d4;
        }
        .opportunite {
            background-color: #00ff7f29;
        }
    </style>
    <div class="breadcrumbs" style="max-height:300px">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>MESURES </h1>
                </div>
            </div>
        </div>
        <div class="col-sm-12">

        </div>
    </div>

    <div class="content mt-3">


        <div id="mydiv" class="petit" >
            <div id="mydivheader">Cliquer ici pour déplacer ou double cliquer pour agrandire</div>
            <img src="{{URL::asset("images/anarisk.png")}}"  class="petitImage" id="permanant"/>
            <div class="resizeUI"><i class="fa fa-arrows"></i></div>
        </div>
        <div class="animated fadeIn">

            <div class="row">
                <div class="col-sm-11">
                </div>
                <div class="col-sm-1">
                    <a class="btn btn-outline-secondary btn-sm btn-block" href="{{ route("liste") }}"><i class="menu-icon fa fa-back"></i>RETOUR</a>
                </div>

                </div>
            </br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Analyse</strong>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-4">
                                <p> Code : {{isset($analyse)? $analyse->code:''}}</p>
                                <p> Nature : <b>{{$analyse->nature->nature}}</b></p>
                                <p> Pays : <b>{{$analyse->chantier->pays->nom_fr_fr}}</b></p>
                                <p> Chantier :  {{$analyse->chantier->libelle}}</p>

                            </div>
                            <div class="col-sm-4">
                                <p> Pays :  {{$analyse->chantier->pays->nom_fr_fr}}</p>
                                <p> Proprietaire :  {{$analyse->proprietaire->nom}} {{$analyse->proprietaire->prenoms}}</p>
                                <p> Auteur :  {{$analyse->auteur->nom}} {{$analyse->auteur->prenoms}}</p>
                                <p> Description  :  {{$analyse->description}}</p>
                                <p> Detail  :  {{$analyse->detail}}</p>



                            </div>
                            <div class="col-sm-4">
                                <p> Date  :  {{$analyse->date}}</p>
                                <p> Causes  :  @if(isset($analyse->causes)) @foreach(json_decode($analyse->causes) as $cause) <p>{{$cause->libelle}}</p> @endforeach @endif</p>
                                <p> Conséquences  :  @if(isset($analyse->consequences))@foreach(json_decode($analyse->consequences) as $consequence) <p>{{$consequence->libelle}}</p> @endforeach @endif</p>
                                <p> Probabilité avant mesure  :  {{$analyse->probabiliteAvant}}</p>
                                <p> Severité avant mesure  :  {{$analyse->probabiliteAvant}}</p>
                                <p> Planing avant mesure  :  {{$analyse->planingAvant}}</p>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
</br></br>

            </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Liste des mesures</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                </div>
                            <div class="row">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Libelle</th>
                                        <th>Responsable</th>
                                        <th>Acteur</th>
                                        <th>Priorité</th>
                                        <th>Statut</th>
                                        <th>Périodicité</th>
                                        <th>Documentation</th>
                                        <th>Auteur</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($analyse->mesures()->get() as $mesure)
                                        <tr>
                                            <td>
                                                {{$mesure->libelle}}
                                            </td>
                                            <td>
                                                {{$mesure->responsable->nom}}  {{$mesure->responsable->prenoms}}
                                            </td>
                                            <td>
                                                {{$mesure->acteur()->first()->nom." ".$mesure->acteur()->first()->prenoms}}
                                            </td>
                                            <td>
                                                {{$mesure->priorite->libelle}}
                                            </td>
                                            <td>
                                                {{$mesure->statut->libelle}}
                                            </td>
                                            <td>
                                                {{$mesure->periodicite->libelle}}
                                            </td>
                                            <td>
                                                {{$mesure->documentation}}
                                            </td>
                                            <td>
                                                {{$mesure->auteur->nom}}  {{$mesure->auteur->prenoms}}
                                            </td>
                                            <td>
                                                <a href="{{route('pageModifMesure',$mesure->id)}}"> <i class="menu-icon fa fa-edit"></i> Modifier la mesure</a>
                                            </td>
                                        </tr>
                                    @endforeach


                                    </tbody>
                                </table>

                            </div>
                            </div>
                    </div>
                </div>

            </div>
            <script src="{{ asset("assets/js/vendor/jquery-2.1.4.min.js") }}"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
            <script src="{{ asset("assets/js/plugins.js") }}"></script>
            <script src="{{ asset("assets/js/main.js") }}"></script>


            <script src="{{ asset("assets/js/lib/chart-js/Chart.bundle.js") }}"></script>
            <script src="{{ asset("assets/js/dashboard.js") }}"></script>
            <script src="{{ asset("assets/js/widgets.js") }}"></script>
            <script src="{{ asset("assets/js/lib/vector-map/jquery.vmap.js") }}"></script>
            <script src="{{ asset("assets/js/lib/vector-map/jquery.vmap.min.js") }}"></script>
            <script src="{{ asset("assets/js/lib/vector-map/jquery.vmap.sampledata.js") }}"></script>
            <script src="{{ asset("assets/js/lib/vector-map/country/jquery.vmap.world.js") }}"></script>
            <script src="{{ asset("assets/js/lib/chosen/chosen.jquery.min.js")}}"></script>



            <script src="{{ asset('assets/js/lib/data-table/datatables.min.js')}}"></script>
            <script src="{{ asset('assets/js/lib/data-table/dataTables.bootstrap.min.js')}}"></script>
            <script src="{{ asset('assets/js/lib/data-table/dataTables.buttons.min.js')}}"></script>
            <script src="{{ asset('assets/js/lib/data-table/buttons.bootstrap.min.js')}}"></script>
            <script src="{{ asset('assets/js/lib/data-table/jszip.min.js')}}"></script>
            <script src="{{ asset('assets/js/lib/data-table/pdfmake.min.js')}}"></script>
            <script src="{{ asset('assets/js/lib/data-table/vfs_fonts.js')}}"></script>
            <script src="{{ asset('assets/js/lib/data-table/buttons.html5.min.js')}}"></script>
            <script src="{{ asset('assets/js/lib/data-table/buttons.print.min.js')}}"></script>
            <script src="{{ asset('assets/js/lib/data-table/buttons.colVis.min.js')}}"></script>
            <script src="{{ asset('assets/js/lib/data-table/datatables-init.js')}}"></script>
            <!-- .animated -->
            <script>

                jQuery(function($) {
                    function test(){
                        if($("#probabiliteAvant").val()!="") {
                            var luimeme = $("#probabiliteAvant").val();
                        }else{
                            var luimeme=0;
                        }
                        if($("#severiteAvant").val()!="") {
                            var severiteAvant=$("#severiteAvant").val();
                        }else{
                            var  severiteAvant=0;
                        }
                        if($("#planingAvant").val()!="") {
                            var planingAvant=$("#planingAvant").val();
                        }else{
                            var  planingAvant=0;
                        }
                        if($("#coutAvant").val()!="") {
                            var coutAvant=$("#coutAvant").val();
                        }else{
                            var coutAvant=0;
                        }

                        var res = parseInt(luimeme)+parseInt(severiteAvant)+parseInt(planingAvant)+parseInt(coutAvant);

                        $("#niveauAvant").val(res);
                    };
                    function test1(){
                        if($("#probabiliteApres").val()!="") {
                            var luimeme = $("#probabiliteApres").val();
                        }else{
                            var luimeme=0;
                        }
                        if($("#severiteApres").val()!="") {
                            var severiteApres=$("#severiteApres").val();
                        }else{
                            var  severiteApres=0;
                        }
                        if($("#planingApres").val()!="") {
                            var planingApres=$("#planingApres").val();
                        }else{
                            var  planingApres=0;
                        }
                        if($("#coutApres").val()!="") {
                            var coutApres=$("#coutApres").val();
                        }else{
                            var coutApres=0;
                        }

                        var res = parseInt(luimeme)+parseInt(severiteApres)+parseInt(planingApres)+parseInt(coutApres);

                        $("#niveauApres").val(res);
                    };

                    $(".calcule").change(function (e) {
                        test();
                    });
                    $(".calcule1").change(function (e) {
                        test1();
                    });

                    $("#addcauses").click(function (e) {
                        $($("#causestemplate").html()).appendTo($("#causes"));
                    });
                    $("#addconsequences").click(function (e) {
                        $($("#consequencestemplate").html()).appendTo($("#consequences"));
                    });

                    $( "#mydiv" ).dblclick(function() {
                        //  alert( "Handler for .dblclick() called." );
                        if($("#mydiv").hasClass('petit')) {
                            $("#mydiv").removeClass('petit');
                            $("#mydiv").addClass('gros');
                        }else{
                            $("#mydiv").removeClass('gros');
                            $("#mydiv").addClass('petit');
                        }

                        if($("#permanant").hasClass('petitImage')) {
                            $("#permanant").removeClass('petitImage');
                            $("#permanant").addClass('grosImage');
                        }else{
                            $("#permanant").removeClass('grosImage');
                            $("#permanant").addClass('petitImage');
                        }


                    });
                });

                //Make the DIV element draggagle:
                dragElement(document.getElementById("mydiv"));

                function dragElement(elmnt) {
                    var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
                    if (document.getElementById(elmnt.id + "header")) {
                        /* if present, the header is where you move the DIV from:*/
                        document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
                    } else {
                        /* otherwise, move the DIV from anywhere inside the DIV:*/
                        elmnt.onmousedown = dragMouseDown;
                    }

                    function dragMouseDown(e) {
                        e = e || window.event;
                        e.preventDefault();
                        // get the mouse cursor position at startup:
                        pos3 = e.clientX;
                        pos4 = e.clientY;
                        document.onmouseup = closeDragElement;
                        // call a function whenever the cursor moves:
                        document.onmousemove = elementDrag;
                    }

                    function elementDrag(e) {
                        e = e || window.event;
                        e.preventDefault();
                        // calculate the new cursor position:
                        pos1 = pos3 - e.clientX;
                        pos2 = pos4 - e.clientY;
                        pos3 = e.clientX;
                        pos4 = e.clientY;
                        // set the element's new position:
                        elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
                        elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
                    }

                    function closeDragElement() {
                        /* stop moving when mouse button is released:*/
                        document.onmouseup = null;
                        document.onmousemove = null;
                    }
                }
            </script>
@endsection