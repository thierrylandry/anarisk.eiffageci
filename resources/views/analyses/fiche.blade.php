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
            <div class="page-header float-left {{($analyse->nature->id==1)?'risk':'opportunite'}}" >
                <div class="page-title">
                    <h1>FICHE ANALYSE </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">


        <div id="mydiv" class="petit ne_pas_afficher" >
            <div id="mydivheader">Cliquer ici pour déplacer ou double cliquer pour agrandire</div>
            <img src="{{URL::asset("images/anarisk.png")}}"  class="petitImage" id="permanant"/>
            <div class="resizeUI"><i class="fa fa-arrows"></i></div>
        </div>
        <div class="row ne_pas_afficher">
            <div class="col-sm-11">
                <a href="javascript:window.print()" id="btnprint" target="_blank" class="btn btn-info"><i class="fa fa-print"></i> Imprimer</a>
            </div>
            <div class="col-sm-1">
                <a class="btn btn-outline-secondary btn-sm btn-block" href="{{ URL::previous() }}"><i class="menu-icon fa fa-back"></i>RETOUR</a>
            </div>

        </div>
        </br>
        <div class="row" id="page">
            <div class="col-md-12">
                <div class="card " id="page">
                    <div class="row">
                        <div class="col-sm-12" style="text-align: center">
                            <img src="{{URL::asset("images/anarisk.png")}}" width="800px" align="center" class="push-right"/>
                        </div>
                    </div>

                    <div class="card-body">
                        <table border="1" align="center" style="text-align: center" width="100%">
                            <tr>
                                <td   style="{{$analyse->nature->id==1?'color:red':'color:green'}}" colspan="2"><b>{{$analyse->nature->nature}}</b></td>
                                <td>Date</td>
                                <td>Pays</td>
                                <td>Chantier</td>
                                <td>Propriétaire</td>
                                <td>Code</td>
                            </tr>
                            <tr>
                                <td style="text-align: left !important" width="5%">&nbsp;Description</td>
                                <td>{{$analyse->description}}</td>
                                <td>{{$analyse->date}}</td>
                                <td>{{$analyse->chantier->pays->nom_fr_fr}}</td>
                                <td>{{$analyse->chantier->libelle}}</td>
                                <td>{{$analyse->proprietaire->nom}} {{$analyse->proprietaire->prenoms}}</td>
                                <td>{{isset($analyse)? $analyse->code:''}}</td>
                            </tr>
                            <tr>
                                <td style="text-align: left !important">&nbsp;Détail</td>
                                <td colspan="6">{{$analyse->detail}}</td>
                            </tr>
                            <tr>
                                <td colspan="4"><b>Causes</b></td>
                                <td colspan="3"><b>Conséquences</b></td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: left !important">@if(isset($analyse->causes)) @foreach(json_decode($analyse->causes) as $cause) <p>&nbsp;&nbsp;&nbsp; - {{$cause->libelle}}</p> @endforeach @endif</td>
                                <td colspan="3">@if(isset($analyse->consequences))@foreach(json_decode($analyse->consequences) as $consequence)  <p>&nbsp;&nbsp;&nbsp; - {{$consequence->libelle}}</p> @endforeach @endif</td>
                            </tr>
                            <tr>
                                <td colspan="7"><b>EVALUATION</b></td>
                            </tr>
                            <tr>
                                <td colspan="4" style="{{$analyse->nature->id==1?'color:red':'color:green'}}"><b>{{($analyse->nature->id==1)?"Niveau du risque":"Niveau  de l'opportunité"}}</b></td>
                                <td colspan="3" style="{{$analyse->nature->id==1?'color:red':'color:green'}}"><b>{{($analyse->nature->id==1)?"Après mesure(s) préventive(s)":"après action(s) favorisante(s)"}}</b></td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <table style="width: 80%">
                                        <tr><td>Probabilité d'occurence</td><td></td><td>{{$analyse->probabiliteAvant}}</td></tr>
                                        <tr><td rowspan="4">Impact</td><td>Sévérité</td><td>{{$analyse->severiteAvant}}</td></tr>
                                        <tr><td>Planning</td><td>{{$analyse->planingAvant}}</td></tr>
                                        <tr><td>Coût</td><td>{{$analyse->coutAvant}}</td></tr>
                                        <tr><td>Niveau</td><td style="{{$analyse->nature->id==1?'color:red':'color:green'}}">
                                                <b>{{$analyse->probabiliteAvant*max(array($analyse->severiteAvant,$analyse->planingAvant,$analyse->coutAvant))}}</b>
                                            </td></tr>
                                    </table>
                                </td>
                                <td colspan="3">                                    <table style="width: 80%">
                                        <tr><td>Probabilité d'occurence</td><td></td><td>{{$analyse->probabiliteApres}}</td></tr>
                                        <tr><td rowspan="4">Impact</td><td>Sévérité</td><td>{{$analyse->severiteApres}}</td></tr>
                                        <tr><td>Planning</td><td>{{$analyse->planingApres}}</td></tr>
                                        <tr><td>Coût</td><td>{{$analyse->coutApres}}</td></tr>
                                        <tr><td>Niveau</td><td style="{{$analyse->nature->id==1?'color:red':'color:green'}}">
                                                <b> {{$analyse->probabiliteApres*max(array($analyse->severiteApres,$analyse->planingApres,$analyse->coutApres))}}</b>
                                            </td></tr>
                                    </table></td>
                            </tr>
                            <tr>
                                <td >Mesures préventives</td>
                                <td >Responsable</td>
                                <td >Acteur</td>
                                <td colspan="3">Statut Date planifi. Priorité & Périodicité</td>
                                <td >Documentation</td>
                            </tr>

                            @foreach($analyse->mesures()->get() as $mesure)

                            <tr>
                                <td>{{$mesure->libelle}}</td>
                                <td>{{$mesure->responsable->nom}} {{$mesure->responsable->prenoms}}</td>
                                <td>{{$mesure->acteur->libelle}}</td>
                                <td>{{$mesure->statut->libelle}}</td>
                                <td>{{$mesure->dateplanifie}}</td>
                                <td>{{$mesure->priorite->libelle}} & {{$mesure->periodicite->libelle}}</td>
                                <td>{{$mesure->documentation}}</td>

                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="4">Calcul impact financier :</td>
                                <td colspan="3">{{$analyse->coute}}</td>
                            </tr>
                            <tr>
                                <td colspan="7">{!! nl2br($analyse->brouillon) !!}</td>
                            </tr>
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
            jQuery(".standardSelect").chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, nothing found!",
                width: "100%"
            });
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