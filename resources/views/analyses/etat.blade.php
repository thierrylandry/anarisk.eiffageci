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
                    <h1>ANALYSES</h1>
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
                                <tr rowspan="2" >
                                    <th COLSPAN="10"></th>
                                    <th COLSPAN="3">Probabilité</th>
                                    <th COLSPAN="3">Valorisaion</th>
                                </tr>
                                <tr>
                                    <th>id</th>
                                    <th >Code</th>
                                    <th>Pays</th>
                                    <th>Chantier</th>
                                    <th>Proprietaire</th>
                                    <th>Plan au plutot</th>
                                    <th>Evènements</th>
                                    <th> Intégrer dans derniere</br> prévision budgétaire
                                    </th>
                                    <th>Montant</th>
                                    <th>Devise</th>


                                    <th> Au pire %</th>
                                    <th> Juste %</th>
                                    <th> Au mieux %</th>
                                    <th> Au pire</th>
                                    <th> Juste</th>
                                    <th> Au mieux</th>

                                </tr>
                                </thead>
                                <tbody>
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
                                        <td> <input type="hidden" value="{{$risque->id}}" name="risk_{{$risque->id}}"/> </td>
                                        <td>
                                            {{number_format($risque->cout, 0, ',', ' ')}}
                                        </td>
                                        <td>
                                            MFCFA
                                        </td>
                                        <td><input type="number" value="{{$risque->aupire}}" id="prob_aupire" name="prob_aupire_{{$risque->id}}" class="prob_aupire" min="0" max="100" style="width: 50px;"/></td>
                                        <td><input type="number" value="{{$risque->juste}}" id="prob_aujuste" name="prob_aujuste_{{$risque->id}}"  class="prob_aujuste" min="0" max="100" style="width: 50px;"/></td>
                                        <td><input type="number" value="{{$risque->aumieux}}"  id="prob_aumieux" name="prob_aumieux_{{$risque->id}}"  class="prob_aumieux" min="0" max="100" style="width: 50px;"/></td>
                                        <td id="val_aupire{{$risque->id}}">{{number_format(($risque->cout*$risque->aupire)/100, 0, ',', ' ')}}</td>
                                        <td id="val_aujuste{{$risque->id}}">{{number_format(($risque->cout*$risque->juste)/100, 0, ',', ' ')}} </td>
                                        <td id="val_aumieux{{$risque->id}}">{{number_format(($risque->cout*$risque->aumieux)/100, 0, ',', ' ')}}  </td>
                                    </tr>

                                @endforeach


                                </tbody>
                                <tfooter>
                                    <tr> <th colspan="11" style="text-align:right" >MFCFA Budget :</th> <th id="tot_aupire" style="text-align: left"></th><th id="tot_aujuste" style="text-align: left"></th><th id="tot_aumieux" style="text-align: left"></th> </tr>
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
                                <tr rowspan="2" >  <th COLSPAN="10"></th><th COLSPAN="3">Probabilité</th>
                                    <th COLSPAN="3">Valorisaion</th></tr>
                                <tr>
                                    <th>id</th>
                                    <th class="colonne"  >Code</th>
                                    <th class="colonne">Pays</th>
                                    <th>Chantier</th>
                                    <th>Proprietaire</th>
                                    <th>Plan au plutot</th>
                                    <th>Evènements</th>
                                    <th> Intégrer dans derniere</br> prévision budgétaire
                                    </th>
                                    <th>Montant</th>
                                    <th>Devise</th>


                                    <th> Au pire %</th>
                                    <th> Juste %</th>
                                    <th> Au mieux %</th>
                                    <th> Au pire</th>
                                    <th> Juste</th>
                                    <th> Au mieux</th>

                                </tr>
                                </thead>
                                <tbody>
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
                                        <td><input type="hidden" value="{{$opportunite->id}}" name="opportunite_{{$opportunite->id}}"/> </td>
                                        <td>
                                            {{number_format($opportunite->cout, 0, ',', ' ')}}
                                        </td>
                                        <td>
                                            MFCFA
                                        </td>
                                        <td><input type="number" value="{{$opportunite->aupire}}" id="prob_aupire1" name="prob_aupire1_{{$opportunite->id}}" class="prob_aupire1" min="0" max="100" style="width: 50px;"/></td>
                                        <td><input type="number" value="{{$opportunite->juste}}" id="prob_aujuste1"name="prob_aujuste1_{{$opportunite->id}}"  class="prob_aujuste1" min="0" max="100" style="width: 50px;"/></td>
                                        <td><input type="number" value="{{$opportunite->aumieux}}" id="prob_aumieux1"name="prob_aumieux1_{{$opportunite->id}}"  class="prob_aumieux1" min="0" max="100" style="width: 50px;"/></td>
                                        <td id="val_aupire_opportunite{{$opportunite->id}}">{{number_format(($opportunite->cout*$opportunite->aupire)/100, 0, ',', ' ')}} </td>
                                        <td id="val_aujuste_opportunite{{$opportunite->id}}">{{number_format(($opportunite->cout*$opportunite->juste)/100, 0, ',', ' ')}} </td>
                                        <td id="val_aumieux_opportunite{{$opportunite->id}}"> {{number_format(($opportunite->cout*$opportunite->aumieux)/100, 0, ',', ' ')}}</td>
                                    </tr>

                                @endforeach


                                </tbody>
                                <tfooter>
                                    <tr> <th colspan="11" style="text-align:right" >MFCFA Budget :</th> <th id="tot_aupire1" style="text-align: left"></th><th id="tot_aujuste1" style="text-align: left"></th><th id="tot_aumieux1" style="text-align: left"></th> </tr>
                                </tfooter>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row " >
                <div class="col-md-12" >
                    <div class="card">
                        <div class="card-body">

                                <table class="tablee pull-right">
                                    <tbody>
                                    <tr>
                                        <th colspan="3" rowspan="2"></th>
                                        <th colspan="3" class="tableau"> Risques</th>

                                    </tr>
                                    <tr class="tableau">

                                        <td class="tableau">Au pire</td>
                                        <td class="tableau">Juste</td>
                                        <td class="tableau">Mieux</td>
                                    </tr>
                                    <tr>
                                        <th colspan="7">&nbsp;</th>
                                    </tr>
                                    <tr>
                                        <th rowspan="5" class="tableau" id="colopportunite"> opportunite</th>
                                        <th style="text-align: center; border-top:  1px solid black;border-right:  1px solid black;border-collapse: collapse;">Au pire</th>
                                        <td rowspan="3" id="espceinutile">&nbsp;</td>
                                        <td class="tableau" style="background-color: #f31f1f; color: white" id="aupire_aupire"></td>
                                        <td class="tableau" style="background-color: #f5001775;color: white" id="aupire_juste"></td>
                                        <td class="tableau" style="background-color: #ecf4ee;" id="aupire_aumieux"></td>
                                    </tr>
                                    <tr class="tableau">
                                        <th class="tableau">Juste</th>
                                        <td class="tableau" style="background-color: #f5001775;" id="juste_aupire"></td>
                                        <td class="tableau" style="background-color: #2c76ce36;" id="juste_juste"></td>
                                        <td class="tableau" style="background-color: #a4dea8;" id="juste_aumieux"></td>
                                    </tr>
                                    <tr class="tableau">
                                        <th class="tableau">Au mieux</th>
                                        <td class="tableau" style="background-color: #b1d0ba40;" id="aumieux_aupire"></td>
                                        <td class="tableau" style="background-color: #a4dea8;" id="aumieux_juste"></td>
                                        <td class="tableau" style="background-color: #23ff32;" id="aumieux_aumieux"></td>
                                        //
                                        <input type="hidden" name="aupire_aupire" id="aupire_aupire_input"/>
                                        <input type="hidden" name="aupire_juste" id="aupire_juste_input"/>
                                        <input type="hidden" name="aupire_aumieux" id="aupire_aumieux_input"/>
                                        <input type="hidden" name="juste_aupire" id="juste_aupire_input"/>
                                        <input type="hidden" name="juste_juste" id="juste_juste_input"/>
                                        <input type="hidden" name="juste_aumieux" id="juste_aumieux_input"/>
                                        <input type="hidden" name="aumieux_aupire" id="aumieux_aupire_input"/>
                                        <input type="hidden" name="aumieux_juste" id="aumieux_juste_input"/>
                                        <input type="hidden" name="aumieux_aumieux" id="aumieux_aumieux_input"/>
                                    </tbody></table>

                        </div>
                    </div>
                </div>

            </div>
                 <input type="submit" value="ENREGISTRER" class="btn btn-success ne_pas_afficher">
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
                    }).column(0).visible(false).column(7).visible(false);
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
                            $('#tot_aupire1').html(lisibilite_nombre(Math.round(totalaupire)));
                            $('#tot_aujuste1').html(lisibilite_nombre(Math.round(totalaujuste)));
                            $('#tot_aumieux1').html(lisibilite_nombre(Math.round(totalaumieux)));
                        },
                        responsive:false,
                    }).column(0).visible(false).column(7).visible(false);

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