@extends('layouts.teteetat')
@section('liste_actif') active @endsection
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
    <div class="content mt-3">
        <div class="animated fadeIn">

            <div class="row" >
                <div class="col-md-12" style="overflow: scroll;">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Liste des risques/opportunités</strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table1" class="table table-striped table-bordered">
                                <thead>
                                <tr rowspan="2" >  <th COLSPAN="10"></th><th COLSPAN="3">Probabilité</th>
                                    <th COLSPAN="3">Valorisaion</th></tr>
                                <tr>
                                    <th>id</th>
                                    <th>Code</th>
                                    <th>Pays</th>
                                    <th>Chantier</th>
                                    <th>Proprietaire</th>
                                    <th>Plan au plutot</th>
                                    <th>Evènements</th>
                                    <th> Intégrer dans derniere</br> prévision budgétaire
                                    </th>
                                    <th>Montant</th>
                                    <th>Devise</th>


                                    <th> Au pire</th>
                                    <th> Juste</th>
                                    <th> Au mieux</th>
                                    <th> Au pire</th>
                                    <th> Juste</th>
                                    <th> Au mieux</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($analyses as $analyse)
                                    <tr >
                                        <td>
                                            {{$analyse->id}}
                                        </td>
                                        <td>
                                            {{$analyse->code}}
                                        </td>
                                        <td>
                                            {{$analyse->chantier()->first()->pays()->first()->nom_fr_fr}}
                                        </td>
                                        <td>
                                            {{$analyse->chantier()->first()->libelle}}
                                        </td>
                                        <td>
                                            {{$analyse->proprietaire()->first()->nom." ".$analyse->proprietaire()->first()->prenoms}}
                                        </td>
                                        <td>
                                            @if(isset($analyse->mesures()->orderBy('dateplanifie','ASC')->first()->dateplanifie))
                                            {{date("d-m-Y",strtotime($analyse->mesures()->orderBy('dateplanifie','ASC')->first()->dateplanifie))}}
                                                @endif
                                        </td>
                                        <td> {{$analyse->description}} </td>
                                        <td><select>
                                                <option value="Intégrer - Risque/Aléas">Intégrer - Dans débours</option>
                                                <option value="Intégrer - Risque/Aléas">Intégrer - Risque/Aléas</option>
                                                <option value="Non intégrer">Intégrer - Risque/Aléas</option>
                                            </select> </td>
                                        <td>
                                            {{number_format($analyse->cout, 0, ',', ' ')}}
                                        </td>
                                        <td>
                                            FCFA
                                        </td>
                                        <td><input type="number" id="prob_aupire" name="prob_aupire" class="prob_aupire" min="0" max="100" style="width: 50px;"/>%</td>
                                        <td><input type="number" id="prob_aujuste"name="prob_aujuste"  class="prob_aujuste" min="0" max="100" style="width: 50px;"/>%</td>
                                        <td><input type="number" id="prob_aumieux"name="prob_aumieux"  class="prob_aumieux" min="0" max="100" style="width: 50px;"/>%</td>
                                        <td id="val_aupire{{$analyse->id}}"> </td>
                                        <td id="val_aujuste{{$analyse->id}}"> </td>
                                        <td id="val_aumieux{{$analyse->id}}"> </td>
                                    </tr>

                                @endforeach


                                </tbody>
                                <tfooter>
                                    <tr> <th colspan="12" style="text-align:right" >FCFA Budget :</th> <th id="tot_aupire" style="text-align: right"></th><th id="tot_aujuste" style="text-align: right"></th><th id="tot_aumieux" style="text-align: right"></th> </tr>
                                </tfooter>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
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
                            console.log(api
                                    .column( 13 )
                                    .data());
                            $('#tot_aupire').html(lisibilite_nombre(Math.round(totalaupire)));
                            $('#tot_aujuste').html(lisibilite_nombre(Math.round(totalaujuste)));
                            $('#tot_aumieux').html(lisibilite_nombre(Math.round(totalaumieux)));

                        responsive: false
                        }
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

                        for(var i=valeur.length-1; i>=0; i-- ){valeur=valeur.toString().replace(' ','');

                        }

                        return valeur;

                    }
                    function calculeValorisation(tthis,aupire_ou_aujuste_ou_aumieux){

                        var prob=$(tthis).val();
                        var data = table.row($(tthis).parents('tr')).data();

                        var val=(parseInt(data[8].replace(' ',''))*prob)/100;
                        //console.log('#'+val_aupire+data[0]);
                        $('#'+aupire_ou_aujuste_ou_aumieux+data[0]).empty();
                        $('#'+aupire_ou_aujuste_ou_aumieux+data[0]).append(lisibilite_nombre(val));

                    }
                    $('.prob_aupire').change( function(){

                        //
                        calculeValorisation(this,'val_aupire');

                        //
                    })
                    $('.prob_aujuste').change( function(){

                        //
                        calculeValorisation(this,'val_aujuste');

                        //
                    })

                    $('.prob_aumieux').change( function(){

                        //
                        calculeValorisation(this,'val_aumieux');

                        //
                    })

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

            </script>
@endsection