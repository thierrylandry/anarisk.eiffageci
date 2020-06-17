@extends('layouts.app')
@section('liste_mesure')
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
                    <h1>Tableaau récapitulatif des mesures</h1>
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
    <div class="modal fade @if(Session::has('analyse_non_termine') && Session('analyse_non_termine')!=0)
           in show
    @endif" id="smallmodal" style="@if(Session::has('analyse_non_termine') && Session('analyse_non_termine')!=0)
            display: block;
    @endif " tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
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
                        <input type="hidden" id="id_analyse" name="id_analyse" value="@if(Session::has('analyse_non_termine') && Session('analyse_non_termine')!=0){{Session('analyse_non_termine')}}@endif" />
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
                            <input type="file" id="nomfichier" name="nomfichier"  placeholder="nomfichier" class="form-control">
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

        <div class="animated fadeIn">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Liste des mesures</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="{{route('print_tableau_recap_mesure')}}" target="_blank" class="btn btn-info">Imprimer</a>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="bootstrap-data-table1" class="table table-striped table-bordered" style="width: 100%">
                                        <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>code</th>
                                            <th>Description</th>
                                            <th>Nature</th>
                                            <th>Cout</th>
                                            <th>Etat</th>
                                            <th>Libelle</th>
                                            <th>Responsable</th>
                                            <th>Acteur</th>
                                            <th>Statut</th>
                                            <th>Documentation</th>
                                            <th>Date de planification</th>
                                            <th>Date effective</th>
                                            <th>Auteur</th>
                                            <th>Efficacité de l'action</th>
                                            <!--<th>Evaluation</th>-->
                                            <th>Action</th>
                                            <th>PJ</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($mesures as $mesure)
                                            <tr id="{{$mesure->id}}"   {{isset($mesure->statut->id)&& $mesure->statut->id==30?"style=background-color:darkgrey":''}}>
                                                <td>
                                                    {{$mesure->id}}
                                                </td>

                                                <td>
                                                    {{$mesure->code}}
                                                </td>
                                                <td>
                                                    {{$mesure->description}}
                                                </td> <td>
                                                    {{$mesure->nature}}
                                                </td>
                                                <td>
                                                    {{$mesure->cout}}
                                                </td>
                                                <td>
                                                    {{$mesure->etat}}
                                                </td>
                                                <td>
                                                    {{$mesure->libelle}}
                                                </td>
                                                <td>
                                                    @foreach($responsables as $responsable)
                                                        @if($responsable->id==$mesure->id_proprietaire)
                                                            <?php $proprietaire_nom=$responsable->nom;?>
                                                            <?php $proprietaire_prenoms=$responsable->prenoms;?>
                                                            {{$responsable->nom." ".$responsable->prenoms}}
                                                        @endif
                                                        @break
                                                    @endforeach
                                                </td>
                                                <td>
                                                    {{$mesure->libelleacteur}}
                                                </td>
                                                <td style="@if($mesure->libellestatut=="Fait" ||  $mesure->libellestatut=="permanente") background-color:green;color: white @endif">
                                                    {{$mesure->libellestatut}}
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
                                                    {{$mesure->nom}}  {{$mesure->prenoms}}
                                                </td>
                                                <td>
                                                    {{$mesure->efficacite==1?'OUI':'NON'}}
                                                </td>
                                          <!--      <td>
                                                    <div class="row form-group">
                                                        <div style=" text-decoration: none; font-size: 1em;color:orange;cursor: pointer;"><a href="#1"  title="Donner 1 étoile" @if($mesure->evaluation>=1) style="color: orange" @endif>☆</a><!--
                                    <a href="#2"  title="Donner 2 étoiles" @if($mesure->evaluation>=2) style="color: orange" @endif>☆</a><!--
                                    <a href="#3"  title="Donner 3 étoiles" @if($mesure->evaluation>=3) style="color: orange" @endif>☆</a><!--
                                    <a href="#4"  title="Donner 4 étoiles" @if($mesure->evaluation>=4) style="color: orange" @endif>☆</a><!--
                                 <a href="#5"  title="Donner 5 étoiles"  @if($mesure->evaluation==5) style="color: orange" @endif>☆</a>




                                                        </div>
                                                    </div>
                                                </td>-->
                                                <td>
                                                    @if(isset($mesure->id_statut)&& $mesure->id_statut!=10 && $mesure->nom==auth::user()->nom && $mesure->prenoms==auth::user()->prenoms)
                                                        @if($mesure->id_statut!=10)
                                                            <a href="#" class="btn btn-success btn-sm terminerClass" data-toggle="modal" data-target="#teminer"> <i class="menu-icon fa fa-key"></i> terminé</a>

                                                        @endif
                                                    @elseif($mesure->nom==auth::user()->nom && $mesure->prenoms==auth::user()->prenoms)
                                                        <a href="#" class="btn btn-primary btn-sm terminerClass" data-toggle="modal" data-target="#teminer"> <i class="menu-icon fa fa-key"></i> Modifier l'évalutaion</a>

                                                    @endif
                                                </td>
                                                <td>
                                                    @if(!empty($mesure->nomfichier))
                                                        <a href="{{route('download_doc',str_replace(",","",$mesure->nomfichier))}}"><i class="menu-icon fa fa-file"></i>{{$mesure->nomfichier}}</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach


                                        </tbody>

                                    </table>
                                    {{$mesures->links()}}
                                </div>


                            </div>
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
            <script src="{{ asset('assets/js/lib/data-table/dataTables.fixedHeader.min.js')}}"></script>
        <!-- .animated -->
    <script>
        $(document).ready(function () {
            @if(Session::has('analyse_non_termine') && Session('analyse_non_termine')!=0)


          //  $('#ajouterMesure').trigger('click');
         //   $('#smallmodal').modal('show');
            // alert("je suis icic");
            @endif
        });
    </script>
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
                var date =new Date();
                var table= $('#bootstrap-data-table1').DataTable({
                    "order": [[ 1, "asc" ]],
                    language: {
                        url: "{{ URL::asset('js/French.json') }}"
                    },
                    "ordering":true,
                    "createdRow": function( row, data, dataIndex){

                    },
                    responsive: false,

                    "createdRow": function( row, data, dataIndex){

                        if( data[0] ==  'someVal'){
                            $(row).addClass('redClass');
                        }
                    },
                    fixedHeader: true,
                    "drawCallback": function (settings){
                        var api = this.api();

                        // Zero-based index of the column containing names
                        var col_name = 1;
                        console.log(api.order());
                        // If ordered by column containing names
                        if (api.order()[0][0] === col_name) {
                            var rows = api.rows({ page: 'current' }).nodes();
                            var group_last = null;
                            api.column(col_name, { page: 'current' }).data().each(function (name, index){
                                var group = name;
                                var data = api.row(rows[index]).data();

                                if (group_last !== group) {
                                    var couleur='';
                                    if( data[3]=="Risque" &&  data[5]==1 && data[4]!=""){
                                        couleur='risk';
                                    }else if(data[3]=="Risque" &&  data[5]==2 ){
                                        couleur='riskferme';
                                    }else if( data[3]!="Risque" && data[4]!="" && data[5]==1 ){
                                        couleur='opportunitefaite';
                                    }else if( data[3]!="Risque" &&  data[5]==1 && data[4]==""){
                                        couleur='opportunite';
                                    }else if(data[3]!="Risque" &&  data[5]==2 ){
                                        couleur='opportuniteferme';
                                    }

                                   // console.log(couleur);
                               $(rows[index]).before(

                                            '<tr class="group '+couleur+'"  style=""><td colspan="13"><b>' + data[3] + ' : ' + data[1] + '  ' + data[2] + ' avec un cout de ' + data[4] + ' MFCFA</b></td></tr>'
                                    );


                                    group_last = group;
                                }
                            });
                        }
                    },
                    paginate: false,
                    rowGroup: {
                        startRender: function ( rows, group ) {
                            return 'Nombre de mesure '+' ('+rows.count()+')';

                        },
                        endRender: null,

                        dataSrc: [0]
                    },
                }).column(0).visible(false).column(1).visible(false).column(2).visible(false).visible(false).column(3).visible(false).visible(false).column(4).visible(false).column(5).visible(false);

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
                $(".terminerClass").click(function (){
                    var data = table.row($(this).parents('tr')).data();

                    $("#id_mesure").val(data[0]);
                    if(data[1]=="OUI"){
                        $("#inline-checkbox1").prop('checked',true);
                    }else{
                        $("#inline-checkbox2").prop('checked',true);
                    }




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
                $( ".close" ).click(function() {
                    //  alert( "Handler for .dblclick() called." );
                    if($("#smallmodal").hasClass('in show')) {
                        $("#smallmodal").removeClass('in show');
                        $("#smallmodal").css('display','none');

                    }


                });
                        window.location.hash = '{{Auth::user()->position_number_mesure}}';
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