@extends('layouts.app')
@section('liste_actif')
    active
@endsection
@section('page')

    <div class="breadcrumbs" style="max-height:300px">
        <div class="col-sm-4 text_center" >
            <div class="page-header float-left" >
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
                <a href="javascript:window.print()" id="btnprint" class="btn btn-info"><i class="fa fa-print"></i> Imprimer</a>
            </div>
            <div class="col-sm-1">
                <a class="btn btn-outline-secondary btn-sm btn-block" href="{{ URL::previous() }}"><i class="menu-icon fa fa-back"></i>RETOUR</a>
            </div>

        </div>
        <div class="row" id="page">
            <div class="col-md-12">
                <div class="card " id="page">
                    <div class="card-body">
                        <table border="1" align="center" style="text-align: center" width="100%">
                            <tr style="">
                                <td   style="{{$analyse->nature->id==1?'color:red':'color:green'}}" colspan="2"><b>{{$analyse->nature->nature}}</b></td>
                                <td><b>Date</b></td>
                                <td><b>Pays</b></td>
                                <td><b>Chantier</b></td>
                                <td><b>Propriétaire</b></td>
                                <td><b>Code</b></td>
                            </tr>
                            <tr>
                                <td style="text-align: left !important" width="5%">&nbsp;Description</td>
                                <td style="text-align: left;">&nbsp;{{$analyse->description}}</td>
                                <td>{{$analyse->date}}</td>
                                <td>{{$analyse->chantier->pays->nom_fr_fr}}</td>
                                <td>{{$analyse->chantier->libelle}}</td>
                                <td>                                            @foreach($responsables as $responsable)
                                        @if($responsable->id==$analyse->id_proprietaire)
                                            <?php $proprietaire_nom=$responsable->nom;?>
                                            <?php $proprietaire_prenoms=$responsable->prenoms;?>
                                            {{$responsable->nom." ".$responsable->prenoms}}
                                        @endif
                                        @break
                                    @endforeach</td>
                                <td>{{isset($analyse)? $analyse->code:''}}</td>
                            </tr>
                            <tr>
                                <td style="text-align: left !important">&nbsp;Détail</td>
                                <td colspan="6" style="text-align: left;">&nbsp;{{$analyse->detail}}</td>
                            </tr>
                            <tr>
                                <td colspan="4"><b>{{$analyse->id_nature==1?'Causes':'Facteurs'}}</b></td>
                                <td colspan="3"><b>{{$analyse->id_nature==1?'Conséquences':'Conséquences'}}</b></td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: left !important">@if(isset($analyse->causes)) @foreach(json_decode($analyse->causes) as $cause) <p>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;{{$cause->libelle}}</p> @endforeach @endif</td>
                                <td colspan="3" style="text-align: left !important">@if(isset($analyse->consequences))@foreach(json_decode($analyse->consequences) as $consequence)  <p>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;{{$consequence->libelle}}</p> @endforeach @endif</td>
                            </tr>
                            <tr>
                                <td colspan="7"><b>Evaluation</b></td>
                            </tr>
                            <tr>
                                <td colspan="4" style="{{$analyse->nature->id==1?'color:red':'color:green'}}"><b>{{($analyse->nature->id==1)?"Niveau du risque":"Niveau  de l'opportunité"}}</b></td>
                                <td colspan="3" style="{{$analyse->nature->id==1?'color:red':'color:green'}}"><b>{{($analyse->nature->id==1)?"Après mesure(s) préventive(s)":"après action(s) favorisante(s)"}}</b></td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <table style="width: 80%">
                                        <tr><td>Probabilité d'occurence</td><td></td><td>{{$analyse->probabiliteAvant}}</td></tr>
                                        <tr><td rowspan="4">Impact</td><td>{{$analyse->id_nature==1?'Sévérité':'Bénéfice'}}</td><td>{{$analyse->severiteAvant}}</td></tr>
                                        <tr><td>Planning</td><td>{{$analyse->planingAvant}}</td></tr>
                                        <tr><td>{{$analyse->id_nature==1?'Coût':'Gain'}}</td><td>{{$analyse->coutAvant}}</td></tr>
                                        <tr><td>Niveau</td><td style="{{$analyse->nature->id==1?'color:red':'color:green'}}">
                                                <b>{{$analyse->probabiliteAvant*max(array($analyse->severiteAvant,$analyse->planingAvant,$analyse->coutAvant))}}</b>
                                            </td></tr>
                                    </table>
                                </td>
                                <td colspan="3">                                    <table style="width: 80%">
                                        <tr><td>Probabilité d'occurence</td><td></td><td>{{$analyse->probabiliteApres}}</td></tr>
                                        <tr><td rowspan="4">Impact</td><td>{{$analyse->id_nature==1?'Sévérité':'Bénéfice'}}</td><td>{{$analyse->severiteApres}}</td></tr>
                                        <tr><td>Planning</td><td>{{$analyse->planingApres}}</td></tr>
                                        <tr><td>{{$analyse->id_nature==1?'Coût':'Gain'}}</td><td>{{$analyse->coutApres}}</td></tr>
                                        <tr><td>Niveau</td><td style="{{$analyse->nature->id==1?'color:red':'color:green'}}">
                                                <b> {{$analyse->probabiliteApres*max(array($analyse->severiteApres,$analyse->planingApres,$analyse->coutApres))}}</b>
                                            </td></tr>
                                    </table></td>
                            </tr>
                            <tr>
                                <td rowspan="2" ><b>Mesures préventives</b></td>
                                <td rowspan="2"><b>Responsable</b></td>
                                <td rowspan="2"><b>Acteur</b></td>
                                <td colspan="3"><b>Etat</b></td>
                                <td rowspan="2"><b>Documentation</b></td>
                            </tr>
                            <tr>
                                <td><strong>Planifié</strong></td>
                                <td><strong>Statut</strong></td>
                                <td><strong>Terminé</strong></td>

                            </tr>
                            @foreach($analyse->mesures()->get() as $mesure)

                            <tr>
                                <td>{{$mesure->libelle}}</td>
                                <td>   @foreach($responsables as $responsable)
                                        @if($responsable->id==$mesure->id_responsable)
                                            <?php $proprietaire_nom=$responsable->nom;?>
                                            <?php $proprietaire_prenoms=$responsable->prenoms;?>
                                            {{$responsable->nom." ".$responsable->prenoms}}
                                        @endif
                                        @break
                                    @endforeach</td>
                                <td>{{$mesure->acteur->libelle}}</td>
                                <td>{{$mesure->dateplanifie}}</td>
                                <td>{{isset($mesure->statut->libelle)?$mesure->statut->libelle:''}}</td>
                                <td>{{$mesure->dateEffective}}</td>
                                <td>{{$mesure->documentation}}</td>

                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="4">Calcul impact financier :</td>
                                <td colspan="3">{{number_format($analyse->cout,0,',',' ')}} MCFA</td>
                            </tr>
                            <tr>
                                <td colspan="7" style="text-align: left !important">&nbsp;&nbsp;&nbsp;{!! nl2br($analyse->brouillon) !!}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <script src="{{ asset("assets/js/vendor/jquery-2.1.4.min.js") }}"></script>



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