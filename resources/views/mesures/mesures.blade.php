@extends('layouts.app')
@section('liste_actif')
    active
@endsection
@section('page')
    <style>
        .rating {
            direction: rtl;
        }
        .rating a {
            color: #aaa;
            text-decoration: none;
            font-size: 3em;
            transition: color .4s;
        }
        .rating a:hover,
        .rating a:focus,
        .rating a:hover ~ a,
        .rating a:focus ~ a {
            color: orange;
            cursor: pointer;
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
    <div class="modal fade" id="smallmodal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">Ajouter une  mesure</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('SaveMesure')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="id_analyse" name="id_analyse" value="{{$analyse->id}}" />
                        <div class="form-group">
                            <label class=" form-control-label">Libelle</label>
                            <div class="input-group">

                                <input type="text" class="form-control" name="libelle" value="" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Responsable</label>
                            <div class="input-group">

                                <select data-placeholder="Sélectionner une responsable..." class="standardSelect form-control" tabindex="1" name="responsable" id="responsable" required>
                                    <option></option>
                                    @foreach($responsables as $responsable)
                                        <option value="{{$responsable->id}}">{{$responsable->nom.' '.$responsable->prenoms}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Acteur</label>
                            <div class="input-group">

                                <select data-placeholder="Sélectionner un acteur..." class="standardSelect form-control" tabindex="1" name="acteur" id="acteur" required>
                                    <option></option>
                                    @foreach($acteurs as $acteur)
                                        <option value="{{$acteur->id}}">{{$acteur->libelle}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class=" form-control-label">Planifié</label>
                            <div class="input-group">

                                <input type="date" class="form-control" name="datePlanifie" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Statut</label>
                            <div class="input-group">

                                <select data-placeholder="Sélectionner une statut..." class="standardSelect form-control" tabindex="1" name="statut" id="statut" required>
                                    <option></option>
                                    @foreach($statuts as $statut)
                                        <option value="{{$statut->id}}">{{$statut->libelle}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Terminé</label>
                            <div class="input-group">

                                <input type="date" class="form-control" name="dateEffective" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Documentation</label>
                            <div class="input-group">

                                <input type="text" class="form-control" name="documentation" value="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="file" id="nomfichier" name="nomfichier[]" multiple placeholder="nomfichier" class="form-control">
                            @if(!empty($mesure->nomfichier))
                                <ul>
                                    @foreach(explode(',',$mesure->nomfichier) as $nomfichier)
                                        @if($nomfichier!="")
                                            <li><a href="{{route('download_doc',$nomfichier)}}"><i class="menu-icon fa fa-file"></i>{{$nomfichier}}</a>  <a href="{{route('supprimer_pj_mesure_unique',[$mesure->id,$nomfichier])}}" class="btn btn-danger">Supprimer la pièce jointe</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">ENREGISTRER</button>
                </div>
                </form>
            </div>
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
                <div class="col-md-12" >
                    <div class="card">
                        <div class="card-header {{($analyse->nature->id==1)?'risk':'opportunite'}}">
                            <strong class="card-title">Analyse</strong>
                        </div>
                        <div class="card-body" style="color: black !important">
                            <div class="col-sm-4">
                                <p><b> Code : </b>{{isset($analyse)? $analyse->code:''}}</p>
                                <p> <b>Nature : </b>{{$analyse->nature->nature}}</p>
                                <p> <b>Pays : </b>{{$analyse->chantier->pays->nom_fr_fr}}</p>
                                <p> <b>Chantier : </b> {{$analyse->chantier->libelle}}</p>

                            </div>
                            <div class="col-sm-4">
                                <p><b> Pays : </b> {{$analyse->chantier->pays->nom_fr_fr}}</p>
                                <p> <b>Proprietaire :  </b>                                            @foreach($responsables as $responsable)
                                        @if($responsable->id==$analyse->id_proprietaire)
                                            <?php $proprietaire_nom=$responsable->nom;?>
                                            <?php $proprietaire_prenoms=$responsable->prenoms;?>
                                            {{$responsable->nom." ".$responsable->prenoms}}
                                        @endif
                                        @break
                                    @endforeach</p>
                                <p> <b>Auteur : </b> {{$analyse->auteur->nom}} {{$analyse->auteur->prenoms}}</p>
                                <p> <b>Description  : </b> {{$analyse->description}}</p>
                                <p><b> Detail  :  </b>{{$analyse->detail}}</p>



                            </div>
                            <div class="col-sm-4">
                                <p><b> Date  : </b> {{$analyse->date}}</p>
                                <p><b> Probabilité avant mesure  : </b> {{$analyse->probabiliteAvant}}</p>
                                <p> <b>Severité avant mesure  :</b>  {{$analyse->probabiliteAvant}}</p>
                                <p> <b>Planing avant mesure  :</b>  {{$analyse->planingAvant}}</p>
                            </div>

                            <div class="col-sm-6">
                                <p> <b>Causes  : </b> @if(isset($analyse->causes)) @foreach(json_decode($analyse->causes) as $cause) <p>&nbsp;&nbsp;&nbsp; - {{$cause->libelle}}</p> @endforeach @endif</p>
                            </div>
                            <div class="col-sm-6">
                                <p><b> Conséquences  : </b> @if(isset($analyse->consequences))@foreach(json_decode($analyse->consequences) as $consequence)  <p>&nbsp;&nbsp;&nbsp; - {{$consequence->libelle}}</p> @endforeach @endif</p>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
</br></br>

            </div>


        <!-- Modal -->
        <div id="teminer" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <form method="post" action="{{route('terminer_mesure')}}">
                        @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class=" form-control-label">Terminé</label>
                            <div class="input-group">
                                <input type="hidden" id="id_mesure" name="id_mesure"/>

                                <input type="date" class="form-control" name="dateEffective" value="{{date("Y-m-d")}}" required/>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3"><label class=" form-control-label">Efficacité</label></div>
                            <div class="col col-md-9">
                                <div class="form-check-inline form-check">
                                    <label for="inline-checkbox1" class="form-check-label ">
                                        <input type="radio" id="inline-checkbox1" name="efficacite" value="1" class="form-check-input">  Oui
                                    </label>
                                    &nbsp;
                                    <label for="inline-checkbox2" class="form-check-label ">
                                        <input type="radio" id="inline-checkbox2" name="efficacite" value="0" checked class="form-check-input">  Non
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Evaluer</label></div>
                            <div class="rating"><!--
                                 --><a href="#5" onclick="document.getElementById('evaluer').value=5;" title="Donner 5 étoiles">☆</a><!--
                                 --><a href="#4" onclick="document.getElementById('evaluer').value=4;" title="Donner 4 étoiles">☆</a><!--
                                 --><a href="#3"  onclick="document.getElementById('evaluer').value=3;" title="Donner 3 étoiles">☆</a><!--
                                 --><a href="#2" onclick="document.getElementById('evaluer').value=2;" title="Donner 2 étoiles">☆</a><!--
                                 --><a href="#1" onclick="document.getElementById('evaluer').value=1;" title="Donner 1 étoile">☆</a>
                            </div>
                        </div>
                        <input type="hidden" name="evaluer" id="evaluer" />
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>

            </div>
        </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Liste des mesures</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-11">
                                    <a href="#" data-toggle="modal" data-target="#smallmodal" class="ajouterMesure btn btn-success btn-sm"> <i class="ti-ruler-pencil"></i> Ajouter une mesure</a>
                                </div>
                                </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="bootstrap-data-table1" class="table table-striped table-bordered" style="width: 100%">
                                        <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Efficacité</th>
                                            <th>Evaluation</th>
                                            <th>Libelle</th>
                                            <th>Responsable</th>
                                            <th>Acteur</th>
                                            <th>Statut</th>
                                            <th>Documentation</th>
                                            <th>Date de planification</th>
                                            <th>Date effective</th>
                                            <th>Auteur</th>
                                            <th>Action</th>
                                            <th>PJ</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($analyse->mesures()->get() as $mesure)
                                            <tr   {{isset($mesure->statut->id)&& $mesure->statut->id==30?"style=background-color:darkgrey":''}}>
                                                <td>
                                                    {{$mesure->id}}
                                                </td>
                                                <td>
                                                    {{$mesure->efficacite==1?'OUI':'NON'}}
                                                </td>
                                                <td>
                                                    <div class="row form-group">
                                                      <div style=" text-decoration: none; font-size: 1em;color:orange;cursor: pointer;"><!--
                                    --><a href="#1"  title="Donner 1 étoile" @if($mesure->evaluation>=1) style="color: orange" @endif>☆</a><!--
                                    --><a href="#2"  title="Donner 2 étoiles" @if($mesure->evaluation>=2) style="color: orange" @endif>☆</a><!--
                                    --><a href="#3"  title="Donner 3 étoiles" @if($mesure->evaluation>=3) style="color: orange" @endif>☆</a><!--
                                    --><a href="#4"  title="Donner 4 étoiles" @if($mesure->evaluation>=4) style="color: orange" @endif>☆</a><!--
                                 --><a href="#5"  title="Donner 5 étoiles"  @if($mesure->evaluation==5) style="color: orange" @endif>☆</a>




                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{$mesure->libelle}}
                                                </td>
                                                <td>
                                                    @foreach($responsables as $responsable)
                                                        @if($responsable->id==$analyse->id_proprietaire)
                                                            <?php $proprietaire_nom=$responsable->nom;?>
                                                            <?php $proprietaire_prenoms=$responsable->prenoms;?>
                                                            {{$responsable->nom." ".$responsable->prenoms}}
                                                        @endif
                                                        @break
                                                    @endforeach
                                                </td>
                                                <td>
                                                    {{$mesure->acteur->libelle}}
                                                </td>
                                                <td>
                                                    {{$mesure->statut->libelle}}
                                                </td>
                                                <td>
                                                    {{$mesure->documentation}}
                                                </td>
                                                <td>
                                                    {{ isset($mesure->dateplanifie)?date("d-m-Y",strtotime($mesure->dateplanifie)):'' }}
                                                </td>
                                                <td>
                                                    {{ isset($mesure->dateEffective)?date("d-m-Y",strtotime($mesure->dateEffective)):'' }}
                                                </td>
                                                <td>
                                                    {{$mesure->auteur->nom}}  {{$mesure->auteur->prenoms}}
                                                </td>
                                                <td>
                                                        @if(isset($mesure->statut->id)&& $mesure->statut->id!=10)
                                                            <a href="{{route('pageModifMesure',$mesure->id)}}" class="btn btn-primary btn-sm"> <i class="menu-icon fa fa-edit"></i> Modifier la mesure</a>
                                                            @if($mesure->statut->id!=10)
                                                                <a href="#" class="btn btn-success btn-sm terminerClass" data-toggle="modal" data-target="#teminer"> <i class="menu-icon fa fa-key"></i> terminé</a>
                                                                <a href="{{route("supprimer_mesure",$mesure->id)}}" class="btn btn-danger btn-sm terminerClass confirmons"> <i class="menu-icon fa fa-trash"></i> Supprimer</a>
                                                            @endif
                                                         @else
                                                        <a href="#" class="btn btn-primary btn-sm terminerClass" data-toggle="modal" data-target="#teminer"> <i class="menu-icon fa fa-key"></i> Modifier l'évalutaion</a>

                                                         @endif
                                                </td>
                                                <td>
                                                    @if(!empty($mesure->nomfichier))
                                                        @foreach(explode(',',$mesure->nomfichier) as $nomfichier)
                                                            @if($nomfichier!="")
                                                                <li><a href="{{route('download_doc',$nomfichier)}}"><i class="menu-icon fa fa-file"></i>{{$nomfichier}}</a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    @endif
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

            </div>




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
                jQuery(document).ready(function() {
                    jQuery(".standardSelect").chosen({
                        disable_search_threshold: 10,
                        no_results_text: "Oops, nothing found!",
                        width: "100%"
                    });

                    jQuery("#responsable").change(function (e) {
                        var responsable=jQuery("#responsable").val();
                        jQuery.get("../../acteurFonctionResponsable/"+responsable, function(data, status){


                            jQuery("#acteur").val(data);
                            jQuery("#acteur").trigger("chosen:updated");
                        });
                    });
                });
                jQuery(function($) {
                    var table= $('#bootstrap-data-table1').DataTable({
                        "order": [[ 0, "desc" ]],
                        language: {
                            url: "{{ URL::asset('js/French.json') }}"
                        },
                        "ordering":true,
                        "createdRow": function( row, data, dataIndex){

                        },
                        responsive: false,
                    }).column(0).visible(false);
                    $(".terminerClass").click(function (){
                        var data = table.row($(this).parents('tr')).data();

                        $("#id_mesure").val(data[0]);
                        if(data[1]=="OUI"){
                            $("#inline-checkbox1").prop('checked',true);
                        }else{
                            $("#inline-checkbox2").prop('checked',true);
                        }




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
                    $('.confirmons').click( function (e) {
                        //   table.row('.selected').remove().draw( false );
                        if(confirm('Voulez vous supprimer.?')){}else{e.preventDefault(); e.returnValue = false; return false; }
                    } );
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