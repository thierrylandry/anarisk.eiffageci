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
            background-color: #f50017d4 !important;
            color:white;
        }
        .opportunite {
            background-color: #00ff7f29 !important;
            color:black;
        }
    </style>
    <div class="breadcrumbs" style="max-height:300px">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>ANALYSES</h1>
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
                        <input type="hidden" id="id_analyse" name="id_analyse" value="" />
                    <div class="form-group">
                        <label class=" form-control-label">Priorité</label>
                        <div class="input-group">
                            <select data-placeholder="Sélectionner une priorité..." class="standardSelect form-control" tabindex="1" name="priorite" id="priorite" required>
                               <option></option>
                                @foreach($priorites as $priorite)
                                    <option value="{{$priorite->id}}">{{$priorite->libelle}}</option>
                                    @endforeach
                            </select>
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
                        <label class=" form-control-label">Périodicité</label>
                        <div class="input-group">

                            <select data-placeholder="Sélectionner une périodicité..." class="standardSelect form-control" tabindex="1" name="periodicite" id="periodicite" required>
                                <option></option>
                                @foreach($periodicites as $periodicite)
                                    <option value="{{$periodicite->id}}">{{$periodicite->libelle}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
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
                        <label class=" form-control-label">Date de planification</label>
                        <div class="input-group">

                            <input type="date" class="form-control" name="datePlanifie" value="" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" form-control-label">Date de réalisation effective</label>
                        <div class="input-group">

                            <input type="date" class="form-control" name="dateEffective" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" form-control-label">Documentation</label>
                        <div class="input-group">

                            <input type="text" class="form-control" name="documentation" value="" required/>
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Liste des risques/opportunités</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table1" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Code</th>
                                <th>Nature</th>
                                <th>Pays</th>
                                <th>Chantier</th>
                                <th>Proprietaire</th>
                                <th>Auteur</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                               @foreach($analyses as $analyse)
                                   <tr class="{{$analyse->id_nature==1?'risk':'opportunite'}}" >
                                       <td>
                                           {{$analyse->id}}
                                       </td>
                                       <td>
                                           {{$analyse->code}}
                                       </td>
                                       <td>
                                          {{$analyse->nature()->first()->nature}}
                                       </td>
                                       <td>
                                           {{$analyse->chantier()->first()->libelle}}
                                       </td>
                                       <td>
                                           {{$analyse->chantier()->first()->pays()->first()->nom_fr_fr}}
                                       </td>
                                       <td>
                                           {{$analyse->proprietaire()->first()->nom." ".$analyse->proprietaire()->first()->prenoms}}
                                       </td>
                                       <td>
                                           {{$analyse->auteur()->first()->nom." ".$analyse->auteur()->first()->prenoms}}
                                       </td>
                                        <td>

                                            <a href="#" data-toggle="modal" data-target="#smallmodal" class="ajouterMesure"> <i class="menu-icon fa fa-plus"></i> Ajouter une mesure</a>
                                            <a href="{{route('mesures',$analyse->id)}}"> <i class="menu-icon fa fa-list"></i> Lister les mesures</a>
                                        </td>
                                   </tr>
                                   @endforeach


                            </tbody>
                        </table>
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
                });

            jQuery(function($) {
                var table= $('#bootstrap-data-table1').DataTable({
                    language: {
                        url: "{{ URL::asset('js/French.json') }}"
                    },
                    "ordering":true,
                    "createdRow": function( row, data, dataIndex){

                    },
                    responsive: false,
                }).column(0).visible(false);

                $('.ajouterMesure').click(function(){
                    var data = table.row($(this).closest('tr')).data();
                    //alert(data[Object.keys(data)[0]]);
                    $("#id_analyse").val(data[Object.keys(data)[0]]);
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