@extends('layouts.app')
@section('liste_actif')
active
@endsection
@section('page')
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

    <div class="modal fade" id="evaluationpostemesure" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">Evaluation poste mesure</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('EnregistrerEvalPosteEv')}}">
                        @csrf
                        <input type="hidden" id="id_analyse1" name="id_analyse" value="" />

                        <div class="col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong id="titreeval"></strong>
                                </div>
                                <div class="card-body card-block">

                                    <table border="1px" width="100%" style="text-align: center;">
                                        <thead>
                                        <tr>
                                            <th rowspan="2">Probabilité d'occurrence</th>
                                            <th colspan="3">Impacts</th>
                                        </tr>
                                        <tr>
                                            <th class="severite">Sévérité </th>
                                            <th>Planning</th>
                                            <th class="cout">Cout</th>
                                            <th>Niveau</th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <input name="probabiliteAvant" id="probabiliteAvant" class="form-control calcule" type="number" min="1" max="5"  readonly/>
                                            </td>
                                            <td>
                                                <input name="severiteAvant" id="severiteAvant" class="form-control calcule" type="number" min="1" max="5" readonly/>
                                            </td>
                                            <td>
                                                <input name="planingAvant" id="planingAvant" class="form-control calcule" type="number" min="1" max="5" readonly/>
                                            </td>
                                            <td>
                                                <input name="coutAvant" id="coutAvant"  class="form-control calcule" type="number" min="1" max="5" readonly/>
                                            </td>
                                            <td>
                                                <input name="niveauAvant" id="niveauAvant" class="form-control calcule" type="number" min="1"  readonly/>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong id="titreeval1"></strong>
                                </div>
                                <div class="card-body card-block">
                                    <table border="1px" width="100%" style="text-align: center;">
                                        <thead>
                                        <tr>
                                            <th rowspan="2">Probabilité d'occurrence</th>
                                            <th colspan="3">Impacts</th>
                                        </tr>
                                        <tr>
                                            <th class="severite">Sévérité </th>
                                            <th>Planning</th>
                                            <th class="cout">Coût</th>
                                            <th>Niveau</th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <input name="probabiliteApres" id="probabiliteApres" class="form-control calcule1" type="number" min="1" max="5"  />
                                            </td>
                                            <td>
                                                <input name="severiteApres" id="severiteApres" class="form-control calcule1" type="number" min="1" max="5" />
                                            </td>
                                            <td>
                                                <input name="planingApres" id="planingApres" class="form-control calcule1" type="number" min="1" max="5" />
                                            </td>
                                            <td>
                                                <input name="coutApres" id="coutApres"  class="form-control calcule1" type="number" min="1" max="5" />
                                            </td>
                                            <td>
                                                <input name="niveauApres" id="niveauApres" class="form-control calcule1" type="number" min="1"  readonly/>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
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
    </div>
    <div class="modal fade" id="terminer" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">Small Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('terminer_analyse')}}">
                <div class="modal-body">

                        @csrf
                        <div class="form-group">
                            <label class=" form-control-label" id="coutgain">Coût ou Gain réel</label>
                            <div class="input-group">
                                <input type="hidden" id="id_analyseTermi" name="id_analyse"/>

                                <input type="number" class="form-control" name="coutreel" id="coutreel" value="" required/>&nbsp;M FCFA
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
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
                        <input type="hidden" id="id_analyse" name="id_analyse" value="" />
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
                                        <option value="{{$statut->id}}" {{isset($mesure) &&$mesure->id_statut==$statut->id?'selected':''}}>{{$statut->libelle}}</option>
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
                            <input type="file" id="nomfichier" name="nomfichier[]" multiple  placeholder="nomfichier" class="form-control">
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
                            <table id="bootstrap-data-table1" class=" table table-striped table-bordered" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Etat</th>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Nature</th>
                                    <th>Pays</th>
                                    <th>Chantier</th>
                                    <th>Proprietaire</th>
                                    <th>Auteur</th>
                                    <th>Action</th>
                                    <th>Pj</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($analyses as $analyse)
                                    <tr id="{{$analyse->id}}" class=" @if( $analyse->id_nature==1 && (!empty($analyse->cout) && !empty($analyse->mesures()->get())) && $analyse->etat==1)
                                            riskfait
                                    @elseif( $analyse->id_nature==1 && ( $analyse->etat==1 && empty($analyse->cout) || empty($analyse->mesures()->get())))
                                        risk
                                    @elseif($analyse->id_nature==1 &&  $analyse->etat==2 )
                                            riskferme
                                         @elseif( $analyse->id_nature==2 && (!empty($analyse->cout) && !empty($analyse->mesures()->get())) && $analyse->etat==1 )
                                            opportunitefaite
                                    @elseif( $analyse->id_nature==2 &&  ($analyse->etat==1 && empty($analyse->cout) || empty($analyse->mesures()->get())))
                                            opportunite
                                        @elseif($analyse->id_nature==2 &&  $analyse->etat==2 )
                                            opportuniteferme
                                         @endif">
                                        <td>
                                            {{$analyse->id}}
                                        </td>
                                        <td>
                                            @if( !empty($analyse->cout) && !empty($analyse->mesures()->get()) && $analyse->etat==1 )
                                                <p class=" btn btn-link"> <i class="fa fa-arrow-circle-right"></i> Analyse faite</p>
                                            @elseif($analyse->etat==1 && empty($analyse->cout) || empty($analyse->mesures()->get()))
                                                <p class=" btn btn-link"> <i class="fa fa-spinner"></i> Analyse en cours</p>
                                                @elseif($analyse->etat==2 )
                                                <p class=" btn btn-link"> <i class="fa fa-check-circle"></i> Analyse fermée</p>
                                            @endif
                                        </td>

                                        <td>
                                            {{$analyse->code}}
                                        </td>
                                        <td>
                                            {{isset($analyse->description)?$analyse->description:''}}
                                        </td>
                                        <td>
                                            {{$analyse->nature()->first()->nature}}
                                        </td>
                                        <td>
                                            {{$analyse->chantier()->first()->pays()->first()->nom_fr_fr}}
                                        </td>
                                        <td>
                                            {{$analyse->chantier()->first()->libelle}}
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
                                            {{$analyse->auteur()->first()->nom." ".$analyse->auteur()->first()->prenoms}}
                                        </td>
                                        <td>
                                            @if($analyse->etat==1)
                                                <a href="#" data-toggle="modal" data-target="#smallmodal" class="ajouterMesure btn btn-primary btn-sm"> <i class="ti-ruler-pencil"></i> Ajouter une mesure</a>
                                                <a href="{{route('mesures',$analyse->id)}}" class="btn btn-secondary btn-sm" > <i class="menu-icon fa fa-list"></i> Lister les mesures</a>
                                                <a href="{{route('ficheAnalyse',$analyse->id)}}" class="btn btn-info btn-sm"> <i class="menu-icon fa  fa-file"></i> fiche analyse</a>
                                                @if((stristr( \Illuminate\Support\Facades\Auth::user()->nom,$proprietaire_nom) === true and stristr( \Illuminate\Support\Facades\Auth::user()->prenoms,$proprietaire_prenoms) === true )|| $analyse->auteur->id==\Illuminate\Support\Facades\Auth::user()->id || Auth::user()->hasrole('parametrage'))
                                                    <a href="{{route('pageModifierAnalyse',$analyse->id)}}"  class="btn btn-primary btn-sm"> <i class="menu-icon fa fa-update"></i>Modifier</a>
                                                    <a href="#"  data-toggle="modal" data-target="#evaluationpostemesure" class="evaluer btn btn-success btn-sm"> <i class="ti-view-grid"></i> Evaluation post mesure</a>
                                                    <a href="#" data-toggle="modal" data-target="#terminer" class="btn btn-dark btn-sm terminer"> <i class="menu-icon fa fa-update"></i>Fermer l'analyse</a>
                                                    <a href="{{route('supprimer',$analyse->id)}}"  class="btn btn-danger btn-sm confirmons"> <i class="menu-icon fa fa-trash"></i>Supprimer</a>

                                                @endif
                                                @else

                                                <a href="{{route('ficheAnalyse',$analyse->id)}}" class="btn btn-info btn-sm"> <i class="menu-icon fa  fa-file"></i> fiche analyse</a>
                                                @if((stristr( \Illuminate\Support\Facades\Auth::user()->nom,$proprietaire_nom) === true and stristr( \Illuminate\Support\Facades\Auth::user()->prenoms,$proprietaire_prenoms) === true )|| $analyse->auteur->id==\Illuminate\Support\Facades\Auth::user()->id)
                                                    <a href="{{route('supprimer',$analyse->id)}}"  class="btn btn-danger btn-sm confirmons"> <i class="menu-icon fa fa-trash"></i>Supprimer</a>

                                                @endif
                                            @endif





                                        </td>
                                        <td>
                                            @if(!empty($analyse->nomfichier))
                                                @foreach(explode(',',$analyse->nomfichier) as $nomfichier)
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
                            {{$analyses->links()}}
                            {{$analyses->currentPage()}}
                            {{$analyses->getPageName()}}
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
                    jQuery.get("../acteurFonctionResponsable/"+responsable, function(data, status){


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
                    "pageLength": 50000,
                    responsive: false,
                }).column(0).visible(false);
                $('#bootstrap-data-table1 tbody').on( 'click', 'tr', function () {
                    var d = table.row( this ).data();
                    $("#bootstrap-data-table1 tbody tr").removeClass('selected');
                    $(this).toggleClass('selected');
                    row_table=table.row( this ).index();
                    d.counter++;

                    table
                            .row( this )
                            .data( d )
                            .draw();
// Récupération numéro de page
                    table.page( num_page  ).draw( 'page' );

                    Select_rang(d[0]);
                } );

                $('.ajouterMesure').click(function(){
                    var data = table.row($(this).closest('tr')).data();
                    //alert(data[Object.keys(data)[0]]);
                    $("#id_analyse").val(data[Object.keys(data)[0]]);
                });

                $('.evaluer').click(function(){
                    var data = table.row($(this).closest('tr')).data();
                    //alert(data[Object.keys(data)[0]]);
                    $("#id_analyse1").val(data[Object.keys(data)[0]]);
                  var id_analyse =data[Object.keys(data)[0]];

                    $.get("../analyseFonctionId/"+id_analyse, function(data, status){

                        console.log(data);

                        $("#probabiliteAvant").val(data.probabiliteAvant);
                        $("#severiteAvant").val(data.severiteAvant);
                        $("#planingAvant").val(data.planingAvant);
                        $("#coutAvant").val(data.coutAvant);
                        $("#probabiliteApres").val(data.probabiliteApres);
                        $("#severiteApres").val(data.severiteApres);
                        $("#planingApres").val(data.planingApres);
                        $("#coutApres").val(data.coutApres);
                     //   $("#planingAvant").val(data.planingAvant);
                        test();
                        test1();
                        if(data.id_nature==1){
                            jQuery("#titreeval").empty();
                            jQuery("#titreeval").append(" Evaluation du niveau de risque");

                            jQuery("#titreeval1").empty();
                            jQuery("#titreeval1").append(" Evaluation après mesure(s) préventive(s)");



                            jQuery(".cout").empty();
                            jQuery(".cout").append("Coût");

                            jQuery(".severite").empty();
                            jQuery(".severite").append("Sévérité");



                        }else{
                            jQuery("#titreeval").empty();
                            jQuery("#titreeval").append( "Evaluation du niveau de l'opportunité");

                            jQuery("#titreeval1").empty();
                            jQuery("#titreeval1").append(" Evaluation après action(s) favorisante(s)");

                            jQuery(".cout").empty();
                            jQuery(".cout").append("Gain");

                            jQuery(".severite").empty();
                            jQuery(".severite").append("Bénéfice");

                        }

                    });


                });
                $('.terminer').click(function(){
                    var data = table.row($(this).closest('tr')).data();
                    //alert(data[Object.keys(data)[0]]);
                    $("#id_analyseTermi").val(data[Object.keys(data)[0]]);
                  var id_analyse =data[Object.keys(data)[0]];
                    $.get("../analyseFonctionId/"+id_analyse, function(data, status){

                        console.log(data);
                        $('#coutreel').val(data.cout);
                        if(data.id_nature==1){

                            $('#coutgain').empty();
                            $('#coutgain').append('Coût');
                        }else{

                            $('#coutgain').empty();
                            $('#coutgain').append('Gain');
                        }

                    });



                });
                $('.confirmons').click( function (e) {
                    //   table.row('.selected').remove().draw( false );
                    if(confirm('Voulez vous supprimer.?')){}else{e.preventDefault(); e.returnValue = false; return false; }
                } );

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

                    var res = parseInt(luimeme)*Math.max(parseInt(severiteAvant), parseInt(planingAvant), parseInt(coutAvant));

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

                    var res = parseInt(luimeme)*Math.max(parseInt(severiteApres), parseInt(planingApres), parseInt(coutApres));

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


            {{Auth::user()->page=$analyses->currentPage()}}
            {{Auth::user()->save()}}
            window.location.hash = '{{Auth::user()->position_number}}';
        </script>
@endsection