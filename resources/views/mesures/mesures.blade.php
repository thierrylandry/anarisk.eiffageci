@extends('layouts.app')
@section('liste_actif')
    active
@endsection
@section('page')
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
                    <form method="post" action="{{route('SaveMesure')}}">
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

                                <input type="date" class="form-control" name="datePlanifie" value="" required/>
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
                                <p> <b>Proprietaire :  </b>{{$analyse->proprietaire->nom}} {{$analyse->proprietaire->prenoms}}</p>
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
                                            <th>Libelle</th>
                                            <th>Responsable</th>
                                            <th>Acteur</th>
                                            <th>Statut</th>
                                            <th>Documentation</th>
                                            <th>Date de planification</th>
                                            <th>Date effective</th>
                                            <th>Auteur</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($analyse->mesures()->get() as $mesure)
                                            <tr>
                                                <td>
                                                    {{$mesure->id}}
                                                </td>
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
                                                    <a href="{{route('pageModifMesure',$mesure->id)}}" class="btn btn-primary btn-sm"> <i class="menu-icon fa fa-edit"></i> Modifier la mesure</a>
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