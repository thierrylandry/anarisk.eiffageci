@extends('layouts.teteetat')
@section('liste_actif') active @endsection
@section('page')

    <style>
        .tableau{text-align: center; border:  1px solid black;
        border-collapse: collapse;}
    </style>

    <div class="breadcrumbs row" style="max-height:300px">
        <div class="col-sm-12" style="text-align: center">
            <div class="page-header align-items-center">
                <div class="page-title" >
                    <h1>ANALYSES TERMINEES</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-11 ne_pas_afficher">
                <a href="javascript:window.print()" id="btnprint" class="btn btn-info"><i class="fa fa-print"></i> Imprimer</a>
            </div>
        </div>
    </div>
    <div class="content mt-3">
        <div class="animated fadeIn">
             <form method="post" action="{{route('saveEtat')}}">
                @csrf
<input type="hidden" value="@foreach($risques as $risque){{$risque->id.','}}@endforeach" name="list_risk"/>
<input type="hidden" value="@foreach($opportunites as $opportunite){{$opportunite->id.','}}@endforeach" name="list_opportunite"/>
            <div class="row " >
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header risk" style="text-align: center">
                            <strong class="card-title">RISQUES</strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table1" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th >Code</th>
                                    <th>Pays</th>
                                    <th>Chantier</th>
                                    <th>Proprietaire</th>
                                    <th>Plan au plutot</th>
                                    <th>Evènements</th>
                                    <th>Montant</th>
                                    <th>Devise</th>


                                </tr>
                                </thead>
                                <tbody>
                                <?php $montanttot=0;?>
                                @foreach($risques as $risque)
                                    <tr >
                                        <td>
                                            {{$risque->id}}
                                        </td>
                                        <td>
                                            {{$risque->code}}
                                        </td>
                                        <td>
                                            {{$risque->chantier()->first()->pays()->first()->nom_fr_fr}}
                                        </td>
                                        <td>
                                            {{$risque->chantier()->first()->libelle}}
                                        </td>
                                        <td>
                                            @foreach($responsables as $responsable)
                                                @if($responsable->id==$risque->id_proprietaire)
                                                    <?php $proprietaire_nom=$responsable->nom;?>
                                                    <?php $proprietaire_prenoms=$responsable->prenoms;?>
                                                    {{$responsable->nom." ".$responsable->prenoms}}
                                                @endif
                                                @break
                                            @endforeach
                                        </td>
                                        <td>
                                            @if(isset($risque->mesures()->orderBy('dateplanifie','ASC')->first()->dateplanifie))
                                                {{date("d-m-Y",strtotime($risque->mesures()->orderBy('dateplanifie','ASC')->first()->dateplanifie))}}
                                            @endif
                                        </td>
                                        <td> {{$risque->description}} </td>
                                        <td>
                                            <?php $montanttot-=$risque->coutreel;?>
                                            -{{number_format($risque->coutreel, 0, ',', ' ')}}
                                        </td>
                                        <td>
                                            M FCFA
                                        </td>
                                    </tr>

                                @endforeach


                                </tbody>
                                <tfooter>
                                    <tr> <th colspan="6" style="text-align:right" >M FCFA Budget :</th> <th  style="text-align: left">{{number_format($montanttot, 0, ',', ' ')}}</th><th style="text-align: left">M FCFA</th></tr>
                                </tfooter>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row " >
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header opportunite" style="text-align: center">
                            <strong class="card-title">OPPORTUNITE</strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table2" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th class="colonne"  >Code</th>
                                    <th class="colonne">Pays</th>
                                    <th>Chantier</th>
                                    <th>Proprietaire</th>
                                    <th>Plan au plutot</th>
                                    <th>Evènements</th>
                                    <th>Montant</th>
                                    <th>Devise</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php $montanttot=0;?>
                                @foreach($opportunites as $opportunite)
                                    <tr >
                                        <td>
                                            {{$opportunite->id}}
                                        </td>
                                        <td>
                                            {{$opportunite->code}}
                                        </td>
                                        <td>
                                            {{$opportunite->chantier()->first()->pays()->first()->nom_fr_fr}}
                                        </td>
                                        <td>
                                            {{$opportunite->chantier()->first()->libelle}}
                                        </td>
                                        <td>
                                            @foreach($responsables as $responsable)
                                                @if($responsable->id==$opportunite->id_proprietaire)
                                                    <?php $proprietaire_nom=$responsable->nom;?>
                                                    <?php $proprietaire_prenoms=$responsable->prenoms;?>
                                                    {{$responsable->nom." ".$responsable->prenoms}}
                                                @endif
                                                @break
                                            @endforeach
                                        </td>
                                        <td>
                                            @if(isset($opportunite->mesures()->orderBy('dateplanifie','ASC')->first()->dateplanifie))
                                                {{date("d-m-Y",strtotime($opportunite->mesures()->orderBy('dateplanifie','ASC')->first()->dateplanifie))}}
                                            @endif
                                        </td>
                                        <td> {{$opportunite->description}} </td>
                                        <td>
                                            <?php $montanttot+=$opportunite->coutreel;?>
                                            {{number_format($opportunite->coutreel, 0, ',', ' ')}}
                                        </td>
                                        <td>
                                            M FCFA
                                        </td>
                                    </tr>

                                @endforeach


                                </tbody>
                                <tfooter>
                                    <tr> <th colspan="6" style="text-align:right" >M FCFA Budget :</th> <th id="tot_aupire1" style="text-align: left">{{number_format($montanttot, 0, ',', ' ')}}</th><th style="text-align: left">M FCFA</th> </tr>
                                </tfooter>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
             </form>
                 <script src="{{ asset("assets/js/vendor/jquery-2.1.4.min.js") }}"></script>




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
                    var table= $('#bootstrap-data-table1').DataTable({
                        "order": [[ 0, "desc" ]],
                        language: {
                            url: "{{ URL::asset('js/French.json') }}"
                        },
                        "ordering":true,
                        "autoWidth": false,
                        "paging": false,
                        "searching": false,
                        "createdRow": function( row, data, dataIndex){

                        },
                        "footerCallback": function ( row, data, start, end, display ) {
                            var api = this.api(), data;

                            // Remove the formatting to get integer data for summation
                            var intVal = function ( i ) {
                                return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '')*1 :
                                        typeof i === 'number' ?
                                                i : 0;
                            };
                            // Total over all pages
                            totalaupire = api
                                    .column( 13 )
                                    .data()
                                    .reduce( function (a, b) {
                                       return intVal(ilisibilite_nombre(a)) + intVal(ilisibilite_nombre(b));
                                    }, 0 );
                            pagetotalaupire = api
                                    .column( 4, { page: 'current'} )
                                    .data()
                                    .reduce( function (a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0 );

                            // Total over this page
                            totalaujuste = api
                                    .column( 14, { page: 'current'} )
                                    .data()
                                    .reduce( function (a, b) {
                                        return intVal(ilisibilite_nombre(a)) + intVal(ilisibilite_nombre(b));
                                    }, 0 );
                            // Total tva
                            totalaumieux = api
                                    .column( 15, { page: 'current'} )
                                    .data()
                                    .reduce( function (a, b) {
                                        return intVal(ilisibilite_nombre(a)) + intVal(ilisibilite_nombre(b));
                                    }, 0 );

                            // Update footer
                            $( api.column( 13 ).footer() ).html(
                                    '$'+pagetotalaupire +' ( $'+ totalaupire +' total)'
                            );
                            // Update footer
                            $( api.column( 14 ).footer() ).html(
                                    '$'+totalaujuste
                            );
                            // Update footer
                            $( api.column( 15 ).footer() ).html(
                                    '$'+totalaumieux
                            );
                            $('#tot_aupire').html(lisibilite_nombre(Math.round(totalaupire)));
                            $('#tot_aujuste').html(lisibilite_nombre(Math.round(totalaujuste)));
                            $('#tot_aumieux').html(lisibilite_nombre(Math.round(totalaumieux)));
                        },
                        responsive:false,
                    }).column(0).visible(false);
                    var table2= $('#bootstrap-data-table2').DataTable({
                        "order": [[ 0, "desc" ]],
                        "paging": false,
                        "searching": false,
                        language: {
                            url: "{{ URL::asset('js/French.json') }}"
                        },
                        "ordering":true,
                        "autoWidth": true,
                        "responsive":true,
                        "columnDefs": [
                            { "width": "20%", "targets": 7 }
                        ],
                        "createdRow": function( row, data, dataIndex){

                        },
                        "footerCallback": function ( row, data, start, end, display ) {
                            var api = this.api(), data;

                            // Remove the formatting to get integer data for summation
                            var intVal = function ( i ) {
                                return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '')*1 :
                                        typeof i === 'number' ?
                                                i : 0;
                            };
                            // Total over all pages
                            totalaupire = api
                                    .column( 8 )
                                    .data()
                                    .reduce( function (a, b) {
                                       return intVal(ilisibilite_nombre(a)) + intVal(ilisibilite_nombre(b));
                                    }, 0 );

                            // Update footer
                            $( api.column( 8 ).footer() ).html(
                                    '$'+pagetotalaupire +' ( $'+ totalaupire +' total)'
                            );
                        },
                        responsive:false,
                    }).column(0).visible(false);

                    function lisibilite_nombre(nbr){
                        var nombre = ''+nbr;
                        var retour = '';
                        var count=0;
                        for(var i=nombre.length-1 ; i>=0 ; i--)
                        {
                            if(count!=0 && count % 3 == 0)
                                retour = nombre[i]+' '+retour ;
                            else
                                retour = nombre[i]+retour ;
                            count++;
                        }
                        //          alert('nb : '+nbr+' => '+retour);
                        return retour;
                    }
                    function ilisibilite_nombre(valeur){
                            if(valeur!=null){
                                for(var i=valeur.length-1; i>=0; i-- ){valeur=valeur.toString().replace(' ','');

                                }
                            }else{
                                valeur=0;
                            }


                        return valeur;

                    }

                    function checkifOnEstDansLesBonnesValeurs(tthis){
                        var valeur=$(tthis).val();
                        var res=0;
                        if(valeur<=100 && valeur>=0 ){
                            res=1;
                        }
                        return res;
                    }
                    function calculeValorisation(tthis,aupire_ou_aujuste_ou_aumieux,nomtableau){

                        var prob=$(tthis).val();
                        var data;
                        if(nomtableau=='risque'){
                             data = table.row($(tthis).parents('tr')).data();
                        }else if(nomtableau=='opportunite'){
                             data = table2.row($(tthis).parents('tr')).data();
                        }

                    //    console.log(data[8]);
                        var val=(parseInt(data[8].replace(/ /g,''))*prob)/100;
                        //console.log('#'+val_aupire+data[0]);


                        if(aupire_ou_aujuste_ou_aumieux=='val_aupire' || aupire_ou_aujuste_ou_aumieux=='val_aupire_opportunite'){
                            data[13]=val;
                        }else if(aupire_ou_aujuste_ou_aumieux=='val_aujuste' || aupire_ou_aujuste_ou_aumieux=='val_aujuste_opportunite'){
                            data[14]=val;
                        }else if(aupire_ou_aujuste_ou_aumieux=='val_aumieux' || aupire_ou_aujuste_ou_aumieux=='val_aumieux_opportunite'){
                            data[15]=val;
                        }

                        console.log(data[13]);

                        if(nomtableau=='risque'){
                            table.draw();
                            $('#'+aupire_ou_aujuste_ou_aumieux+data[0]).empty();
                            $('#'+aupire_ou_aujuste_ou_aumieux+data[0]).append(lisibilite_nombre(Math.round(val)));
                        }else if(nomtableau=='opportunite'){
                            table2.draw();
                            $('#'+aupire_ou_aujuste_ou_aumieux+'_opportunite'+data[0]).empty();
                            $('#'+aupire_ou_aujuste_ou_aumieux+'_opportunite'+data[0]).append(lisibilite_nombre(Math.round(val)));
                        }

                        calculedynamique();
                    }

                    function calculedynamique(){

                        var intVal = function ( i ) {
                            return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                                    typeof i === 'number' ?
                                            i : 0;
                        };



                        var val= intVal(ilisibilite_nombre($('#tot_aupire1').html()))+intVal(ilisibilite_nombre($('#tot_aupire').html()));
                               $('#aupire_aupire').html(lisibilite_nombre(Math.round(val)));
                               $('#aupire_aupire_input').val(Math.round(val));

                        var val= intVal(ilisibilite_nombre($('#tot_aupire1').html()))+intVal(ilisibilite_nombre($('#tot_aujuste').html()));
                               $('#aupire_juste').html(lisibilite_nombre(Math.round(val)));
                                 $('#aupire_juste_input').val(Math.round(val));

                        var val= intVal(ilisibilite_nombre($('#tot_aupire1').html()))+intVal(ilisibilite_nombre($('#tot_aumieux').html()));
                               $('#aupire_aumieux').html(lisibilite_nombre(Math.round(val)));
                               $('#aupire_aumieux_input').val(Math.round(val));


                       var val= intVal(ilisibilite_nombre($('#tot_aujuste1').html()))+intVal(ilisibilite_nombre($('#tot_aupire').html()));
                        $('#juste_aupire').html(lisibilite_nombre(Math.round(val)));
                        $('#juste_aupire_input').val(Math.round(val));

                        var val= intVal(ilisibilite_nombre($('#tot_aujuste1').html()))+intVal(ilisibilite_nombre($('#tot_aujuste').html()));
                        $('#juste_juste').html(lisibilite_nombre(Math.round(val)));
                        $('#juste_juste_input').val(Math.round(val));

                        var val= intVal(ilisibilite_nombre($('#tot_aujuste1').html()))+intVal(ilisibilite_nombre($('#tot_aumieux').html()));
                        $('#juste_aumieux').html(lisibilite_nombre(Math.round(val)));
                        $('#juste_aumieux_input').val(Math.round(val));


                        var val= intVal(ilisibilite_nombre($('#tot_aumieux1').html()))+intVal(ilisibilite_nombre($('#tot_aumieux').html()));
                        $('#aumieux_aupire').html(lisibilite_nombre(Math.round(val)));
                        $('#aumieux_aupire_input').val(Math.round(val));

                        var val= intVal(ilisibilite_nombre($('#tot_aumieux1').html()))+intVal(ilisibilite_nombre($('#tot_aumieux').html()));
                        $('#aumieux_juste').html(lisibilite_nombre(Math.round(val)));
                        $('#aumieux_juste_input').val(Math.round(val));

                        var val= intVal(ilisibilite_nombre($('#tot_aumieux1').html()))+intVal(ilisibilite_nombre($('#tot_aumieux').html()));
                        $('#aumieux_aumieux').html(lisibilite_nombre(Math.round(val)));
                        $('#aumieux_aumieux_input').val(Math.round(val));


                    }

                    setInterval(calculedynamique, 1500);

                    $('.prob_aupire').change( function(){

                        //
                        //alert(checkifOnEstDansLesBonnesValeurs(this));
                        if(checkifOnEstDansLesBonnesValeurs(this)==1){
                            calculeValorisation(this,'val_aupire','risque');
                        }else{
                            $(this).val(0);
                            calculeValorisation(this,'val_aupire','risque');
                        }



                    });
                    $('.prob_aujuste').change( function(){

                        //
                        if(checkifOnEstDansLesBonnesValeurs(this)==1){
                        calculeValorisation(this,'val_aujuste','risque');
                        }else{
                            $(this).val(0);
                            calculeValorisation(this,'val_aujuste','risque');
                        }

                        //
                    })

                    $('.prob_aumieux').change( function(){

                        //
                        if(checkifOnEstDansLesBonnesValeurs(this)==1){
                        calculeValorisation(this,'val_aumieux','risque');
                        }else{
                            $(this).val(0);
                            calculeValorisation(this,'val_aumieux','risque');
                        }
                        //
                    })

                    $('.prob_aupire1').change( function(){

                        //
                        //alert(checkifOnEstDansLesBonnesValeurs(this));
                        if(checkifOnEstDansLesBonnesValeurs(this)==1){
                            calculeValorisation(this,'val_aupire','opportunite');
                        }else{
                            $(this).val(0);
                            calculeValorisation(this,'val_aupire','opportunite');
                        }



                    })
                    $('.prob_aujuste1').change( function(){

                        //
                        if(checkifOnEstDansLesBonnesValeurs(this)==1){
                            calculeValorisation(this,'val_aujuste','opportunite');
                        }else{
                            $(this).val(0);
                            calculeValorisation(this,'val_aujuste','opportunite');
                        }

                        //
                    })

                    $('.prob_aumieux1').change( function(){

                        //
                        if(checkifOnEstDansLesBonnesValeurs(this)==1){
                            calculeValorisation(this,'val_aumieux','opportunite');
                        }else{
                            $(this).val(0);
                            calculeValorisation(this,'val_aumieux','opportunite');
                        }
                        //
                    })


                    //exécuer automatiquement
                    //alert(checkifOnEstDansLesBonnesValeurs(this));
                    if(checkifOnEstDansLesBonnesValeurs(this)==1){
                        calculeValorisation(this,'val_aupire','risque');
                    }else{
                        $(this).val(0);
                        calculeValorisation(this,'val_aupire','risque');
                    }


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
               // calculedynamique();

            </script>
@endsection