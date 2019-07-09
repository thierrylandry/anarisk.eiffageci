@extends('layouts.app')
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
                                    <th> Intégrer dans derniere prévision budgétaire
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
                                        <td><input type="text" id="evenement"  class="form-control"/> </td>
                                        <td><select>
                                                <option value="Intégrer - Risque/Aléas">Intégrer - Dans débours</option>
                                                <option value="Intégrer - Risque/Aléas">Intégrer - Risque/Aléas</option>
                                                <option value="Non intégrer">Intégrer - Risque/Aléas</option>
                                            </select> </td>
                                        <td>
                                            {{$analyse->cout}}
                                        </td>
                                        <td>
                                            FCFA
                                        </td>
                                        <td><input type="text" id="evenement"  class="form-control"/> </td>
                                        <td><input type="text" id="evenement"  class="form-control"/> </td>
                                        <td><input type="text" id="evenement"  class="form-control"/> </td>
                                        <td><input type="text" id="evenement"  class="form-control"/> </td>
                                        <td><input type="text" id="evenement"  class="form-control"/> </td>
                                        <td><input type="text" id="evenement"  class="form-control"/> </td>
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
                        responsive: false,
                    }).column(0).visible(false);


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