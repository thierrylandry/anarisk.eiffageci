@extends('layouts.app')
@section('parametrage')
    show active
@endsection
@section('analyses_actif')
    active
@endsection
@section('page')
    <div class="breadcrumbs" style="max-height:300px">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>GESTION DE CHANTIERS</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-12">

        </div>
    </div>

    <div class="content mt-3">


        <div id="mydiv" class="petit" >
            <div id="mydivheader">Cliquer ici pour déplacer ou double cliquer pour agrandir</div>
            <img src="{{URL::asset("images/anarisk.png")}}" class="petitImage" id="permanant"/>
            <div class="resizeUI"><i class="fa fa-arrows"></i></div>
        </div>
        <div class="animated fadeIn">
            <form method="post" action="{{isset($chantier)?route('modifier_chantier'):route('save_chantier')}}">
                @csrf
                <input type="hidden" name="id" value="{{isset($chantier)?$chantier->id:''}}"/>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Chantier</strong> {{isset($chantier)?'Modification':'Création'}} @if(isset($chantier)) <a href="{{route('chantiers')}}">Ajouter un chantier</a>@endif
                        </div>
                        <div class="card-body card-block">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">libelle</label></div>
                                    <div class="col-12 col-md-9"><input type="text" name="nom" value="{{isset($chantier)?$chantier->libelle:''}}" placeholder="Nom" class="form-control"><small class="form-text text-muted"></small></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="select" class=" form-control-label">Pays</label></div>
                                    <div class="col-12 col-md-9">

                                        <select data-placeholder="Sélectionner un pays..." class="standardSelect form-control" tabindex="1" name="id_pays" id="pays" required>
                                            @foreach($payss as $pays)
                                                <option @if($pays->alpha2=="CI") {{'selected'}}@endif value="{{$pays->id}}">{{$pays->nom_fr_fr." (".$pays->alpha2.")"}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Enregistrer
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>

            </form>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Liste des chantier</strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>libelle</th>
                                    <th>Pays</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                   @foreach($chantiers as $chantier)
                                       <tr>
                                           <td>{{$chantier->libelle}}</td>
                                           <td>{{$chantier->pays->nom_fr_fr}}</td>
                                           <td>
                                               <a href="{{route('voir_chantier',$chantier->id)}}" class="btn btn-info col-sm-4 pull-right">
                                                   <i class=" fa fa-pencil"></i>
                                               </a>
                                               <a href="{{route('supprimer_chantier',$chantier->id)}}" class="btn btn-danger col-sm-4 pull-right">
                                                   <i class=" fa fa-trash"></i>
                                               </a>
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

        <script>

            jQuery(document).ready(function() {
                $('#bootstrap-data-table-export').DataTable();
                jQuery(".standardSelect").chosen({
                    disable_search_threshold: 10,
                    no_results_text: "Oops, nothing found!",
                    width: "100%"
                });
            });
        </script>
        <!-- .animated -->
        <script>
            jQuery(function($) {
                function lisibilite_nombre(nbr)
                {
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
                $('.password').change(function(){
                     var password=   $('#password').val();
                     var confirmer=   $('#confirmer').val();

                    if(password!=confirmer){
                        $('#confirmer').val('');
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
        <script type="text/javascript">
            $(document).ready(function() {

            } );
        </script>
@endsection