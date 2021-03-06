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

        #bootstrap-data-table1 {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #bootstrap-data-table1 td, #bootstrap-data-table1 th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #bootstrap-data-table1 tr:nth-child(even){background-color: #f2f2f2;}

        #bootstrap-data-table1 tr:hover {background-color: #ddd;}

        #bootstrap-data-table1 th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: black;
        }
        .risk {
            background-color: rgba(212, 17, 31, 0.96)!important;
            color:white ;
        }
        .opportunite {
            background-color: #00bf8f;
        }
        @media print {
            .risk {
                background-color: rgba(212, 17, 31, 0.96);
                color:white ;
            }
            .opportunite {
                background-color: #00bf8f;
            }
        }
    </style>

    <div class="breadcrumbs" style="max-height:300px">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Tableau récapitulatif des mesures</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-12">

        </div>
    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
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
                                           <!-- <th>Evaluation</th>-->
                                            <th>PJ</th>
                                            <th>id_analyse</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($mesures as $mesure)
                                            <tr   {{isset($mesure->statut->id)&& $mesure->statut->id==30?"style=background-color:darkgrey":''}}>
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
                                                <td style="@if($mesure->libellestatut=="Fait" ||  $mesure->libellestatut=="permanente" ||  $mesure->libellestatut=="régulière" ||  $mesure->libellestatut=="Prêt") background-color:green;color: white @endif">
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
                                                    @if(!empty($mesure->nomfichier))
                                                        <a href="{{route('download_doc',str_replace(",","",$mesure->nomfichier))}}"><i class="menu-icon fa fa-file"></i>{{$mesure->nomfichier}}</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$mesure->id_analyse}}
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
    <!-- .animated -->
    <script>


        jQuery(function($) {
            var date =new Date();
            var table= $('#bootstrap-data-table1').DataTable({
                "order": [[ 15, "asc" ]],
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
                    var col_name = 15;
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
                "searching": false,
                paginate: false,
                rowGroup: {
                    startRender: function ( rows, group ) {
                        return 'Nombre de mesure '+' ('+rows.count()+')';

                    },
                    endRender: null,

                    dataSrc: [0]
                },
            }).column(0).visible(false).column(15).visible(false).column(1).visible(false).column(2).visible(false).column(3).visible(false).column(4).visible(false).visible(false).column(5).visible(false).visible(false).column(7).visible(false);

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
        });

        setTimeout(function(){  window.print(); }, 3000);
    </script>