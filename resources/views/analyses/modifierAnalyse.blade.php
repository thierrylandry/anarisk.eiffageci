@extends('layouts.app')
@section('analyses_actif')
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

    <div class="content mt-3">
        <div id="mydiv" class="petit" >
            <div id="mydivheader">Cliquer ici pour déplacer ou double cliquer pour agrandir</div>
            <img src="{{URL::asset("images/anarisk.png")}}" class="petitImage" id="permanant"/>
            <div class="resizeUI"><i class="fa fa-arrows"></i></div>
        </div>
        <div class="animated fadeIn">
            <form method="post" action="{{route('modifier_analyse')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" class="form-control" name="id" value="{{isset($analyse)?$analyse->id:''}}" required/>
                <div class="row">
                    <div class="col-sm-12">

                        <div class="table-data__tool-right" style="text-align: right">
                            <a href="{{ route('liste') }}" class="btn btn-success">
                                <i class="zmdi zmdi-arrow-back"></i>RETOUR</a>
                        </div>
                    </div>
                    </br>
                    </br>
                    </br>
                    <div class="col-xs-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Analyses</strong> <small> Modification</small>
                            </div>
                            <div class="card-body card-block">
                                <div class="row">
                                    <div class="form-group col-sm-2">
                                        <label class=" form-control-label">Nature</label>
                                        <div class="input-group">

                                            <select data-placeholder="Sélectionner une nature" class="standardSelect form-control" tabindex="1" name="nature" id="nature" required>
                                                <option value=""></option>
                                                @foreach($natures as $nature)
                                                    <option value="{{$nature->id}}"  {{isset($analyse) && $analyse->id_nature==$nature->id?'selected':''}}>{{$nature->nature}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label class=" form-control-label">Date</label>
                                        <div class="input-group">

                                            <input type="date" class="form-control" name="date" value="{{isset($analyse)?$analyse->date:''}}" required/>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label class=" form-control-label">Pays</label>
                                        <div class="input-group">

                                            <select data-placeholder="Sélectionner un pays..." class="standardSelect form-control" tabindex="1" name="pays" id="pays" required>
                                                @foreach($payss as $pays)
                                                    <option {{isset($analyse) && $analyse->chantier->id_pays==$pays->id?'selected':''}} value="{{$pays->id}}">{{$pays->nom_fr_fr." (".$pays->alpha2.")"}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label class=" form-control-label">Chantier</label>
                                        <div class="input-group">

                                            <select data-placeholder="Sélectionner un chantier..." class="standardSelect form-control" tabindex="1" name="chantier" id="chantier" required>
                                                @foreach($chantiers as $chantier)
                                                    <option value="{{$chantier->id}}" {{isset($analyse) && $analyse->chantier->id==$chantier->id?'selected':''}}>{{$chantier->libelle}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label class=" form-control-label">Propriétaire</label>
                                        <div class="input-group">

                                            <select data-placeholder="Choose a Country..." class="standardSelect form-control" tabindex="1" name="proprietaire" id="proprietaire">
                                                @foreach($responsables as $responsable)
                                                    <option  value="{{$responsable->id}}">{{$responsable->nom.' '.$responsable->prenoms}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label class=" form-control-label">Description</label>
                                        <div class="input-group">

                                            <input type="text" id="description"name="description" class="form-control" value="{{isset($analyse)?$analyse->description:''}}"/>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-8">
                                        <label class=" form-control-label">Détail</label>
                                        <div class="input-group">

                                            <input type="text" id="detail" name="detail" class="form-control" value="{{isset($analyse)?$analyse->detail:''}}"/>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title" id="causer">Causes </strong>
                            </div>
                            <div class="card-body">

                                Ajouter
                                <button type="button" class="btn bg-teal btn-circle waves-effect waves-circle waves-float" id="addcauses">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                </button>
                                </br>
                                </br>
                                <div id="causes" class="">

                                    @if(isset($analyse->causes))
                                    @foreach(json_decode($analyse->causes) as $cause)
                                    <div class=" form-control-label">

                                        <div class="form-group">
                                            <input name="causes[]" class="form-control" style="" type="text" value="{{$cause->libelle}}"/>
                                        </div>

                                    </div>
                                    @endforeach
                                    @endif
                                    <hr width="100%" color="blue">
                                </div>
                                <div id="causestemplate" class="row clearfix" style="display: none">
                                    <div class=" form-control-label">
                                        <div class="form-group">
                                            <input name="causes[]" class="form-control" style="" type="text"/>
                                        </div>
                                    </div>
                                    <hr width="100%" color="blue">
                                </div>
                            </div>
                        </div>


                    </div>


                    <div class="col-xs-6 col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"  id="consequence">Conséquences </strong>
                            </div>
                            <div class="card-body">

                                Ajouter
                                <button type="button" class="btn bg-teal btn-circle waves-effect waves-circle waves-float" id="addconsequences">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                </button>
                                </br>
                                </br>
                                <div id="consequences" class="">
                                    @if(isset($analyse->consequences))
                                    @foreach(json_decode($analyse->consequences) as $consequence)
                                    <div class=" form-control-label">
                                        <label for="consequences[]"></label>
                                        <div class="form-group">
                                            <input name="consequences[]" class="form-control" style="" type="text" value="{{$consequence->libelle}}"/>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif

                                    <hr width="100%" color="blue">
                                </div>
                                <div id="consequencestemplate" class="row clearfix" style="display: none">
                                    <div class=" form-control-label">
                                        <label for="consequences[]"></label>
                                        <div class="form-group">
                                            <input name="consequences[]" class="form-control" style="" type="text"/>
                                        </div>
                                    </div>
                                    <hr width="100%" color="blue">
                                </div>
                            </div>
                        </div>



                    </div>

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
                                        <th class="severite">Sévérité</th>
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
                                            <input name="probabiliteAvant" id="probabiliteAvant" class="form-control calcule" type="number" min="1" max="5" value="{{isset($analyse)?$analyse->probabiliteAvant:''}}" required/>
                                        </td>
                                        <td>
                                            <input name="severiteAvant" id="severiteAvant" class="form-control calcule" type="number" min="1" max="5" value="{{isset($analyse)?$analyse->severiteAvant:''}}" required/>
                                        </td>
                                        <td>
                                            <input name="planingAvant" id="planingAvant" class="form-control calcule" type="number" min="1" max="5" value="{{isset($analyse)?$analyse->planingAvant:''}}" required/>
                                        </td>
                                        <td>
                                            <input name="coutAvant" id="coutAvant"  class="form-control calcule" type="number" min="1" max="5" value="{{isset($analyse)?$analyse->coutAvant:''}}" required/>
                                        </td>
                                        <td>
                                            <input name="niveauAvant" id="niveauAvant" class="form-control calcule" type="number" min="1" required readonly/>
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
                                        <th >Planning</th>
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
                                            <input name="probabiliteApres" id="probabiliteApres" class="form-control calcule1" type="number" min="1" max="5" value="{{isset($analyse)?$analyse->probabiliteApres:''}}"  />
                                        </td>
                                        <td>
                                            <input name="severiteApres" id="severiteApres" class="form-control calcule1" type="number" min="1" max="5" value="{{isset($analyse)?$analyse->severiteApres:''}}"/>
                                        </td>
                                        <td>
                                            <input name="planingApres" id="planingApres" class="form-control calcule1" type="number" min="1" max="5" value="{{isset($analyse)?$analyse->planingApres:''}}"/>
                                        </td>
                                        <td>
                                            <input name="coutApres" id="coutApres"  class="form-control calcule1" type="number" min="1" max="5" value="{{isset($analyse)?$analyse->coutApres:''}}"/>
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
                    <div class="col-xs-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <strong></strong>
                            </div>
                            <div class="card-body card-block">
                                <div class="form-inline col-sm-4">
                                    <label class=" form-control-label cout">Coût: </label>&nbsp;
                                    <div class="input-group">

                                        <input name="cout" class="form-control" type="text"  id="cout"value="{{isset($analyse)?number_format($analyse->cout,0, ',', ' '):''}}"/>
                                    </div> <label class=" form-control-label"> &nbsp;MFCFA </label>
                                </div>
                                </br>
                                </br>
                                </br>
                                <div class="form-group col-sm-12">

                                    <div class="input-group">

                                        <textarea name="brouillon" class="form-control" style="height: 318px; margin-top: 0px; margin-bottom: 0px;">{{isset($analyse)?$analyse->brouillon:''}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12">
                                    <div class="input-group">
                                        @if(!empty($analyse->nomfichier))
                                        <a href="{{route('supprimer_pj',$analyse->id)}}" class="btn btn-danger">Supprimer toute les pièces jointes</a>
                                            @endif
                                    </div>
                                       </br>
                                    <div class="input-group">
                                        <input type="file" id="nomfichier" name="nomfichier[]" multiple placeholder="nomfichier" class="form-control">
                                        @if(!empty($analyse->nomfichier))
                                            <ul>
                                            @foreach(explode(',',$analyse->nomfichier) as $nomfichier)
                                                @if($nomfichier!="")
                                           <li><a href="{{route('download_doc',$nomfichier)}}"><i class="menu-icon fa fa-file"></i>{{$nomfichier}}</a>  <a href="{{route('supprimer_pj_unique',[$analyse->id,$nomfichier])}}" class="btn btn-danger">Supprimer la pièce jointe</a>
                                           </li>
                                                    @endif
                                            @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer pull-right">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> modifier
                    </button>
                </div>
            </form>

        </div>
        <script src="{{ asset("assets/js/vendor/jquery-2.1.4.min.js") }}"></script>



        <script src="{{ asset("assets/js/lib/chart-js/Chart.bundle.js") }}"></script>
        <script src="{{ asset("assets/js/dashboard.js") }}"></script>
        <script src="{{ asset("assets/js/widgets.js") }}"></script>
        <script src="{{ asset("assets/js/lib/vector-map/jquery.vmap.js") }}"></script>
        <script src="{{ asset("assets/js/lib/vector-map/jquery.vmap.min.js") }}"></script>
        <script src="{{ asset("assets/js/lib/vector-map/jquery.vmap.sampledata.js") }}"></script>
        <script src="{{ asset("assets/js/lib/vector-map/country/jquery.vmap.world.js") }}"></script>

        <script>

            var nature =jQuery("#nature").val();
            var route='{{URL::asset('')}}';
            if(nature==1){
                jQuery('#permanant').attr('src',route+'images/anarisk.png');
                jQuery("#titreeval").empty();
                jQuery("#titreeval").append(" Evaluation du niveau de risque");

                jQuery("#titreeval1").empty();
                jQuery("#titreeval1").append(" Evaluation après mesure(s) préventive(s)");


                if(jQuery(".right-panel").hasClass('opportunite')){
                    jQuery(".right-panel").removeClass('opportunite');
                    jQuery(".right-panel").addClass('risk');
                }else{
                    jQuery(".right-panel").addClass('risk');
                }

                jQuery("#causer").empty();
                jQuery("#causer").append( "Causes");
                jQuery("#consequence").empty();
                jQuery("#consequence").append( "Conséquences");

                jQuery(".severite").empty();
                jQuery(".severite").append( "Sévérité");
                jQuery(".cout").empty();
                jQuery(".cout").append( "Coût");
            }else{
                jQuery('#permanant').attr('src',route+'images/anarisk_opportunite.jpg');
                jQuery("#titreeval").empty();
                jQuery("#titreeval").append( "Evaluation du niveau de l'opportunité");

                jQuery("#titreeval1").empty();
                jQuery("#titreeval1").append(" Evaluation après action(s) favorisante(s)");

                if(jQuery(".right-panel").hasClass('risk')) {
                    jQuery(".right-panel").removeClass('risk');
                    jQuery(".right-panel").addClass('opportunite');
                }else{
                    jQuery(".right-panel").addClass('opportunite');
                }
                jQuery("#causer").append( "Facteurs");
                jQuery("#consequence").empty();
                jQuery("#consequence").append( "Conséquences");
                jQuery(".severite").empty();
                jQuery(".severite").append("Bénéfice");
                jQuery(".cout").empty();
                jQuery(".cout").append( "Gain");
            }



            jQuery(document).ready(function() {
                jQuery(".standardSelect").chosen({
                    disable_search_threshold: 10,
                    no_results_text: "Oops, nothing found!",
                    width: "100%"
                });
                //en fonction du pays
                jQuery("#pays").change(function (e) {
                    var pays=jQuery("#pays").val();
                    jQuery.get("../../chantierListeFonction/"+pays, function(data, status){

                        //console.log(data[0]);
                        var lesOptions="";
                        jQuery.each(data, function( index, value ) {
                            lesOptions+="<option value='"+value.id+"'>"+value.libelle+"</option>" ;
                        });
                        jQuery("#chantier").empty();
                        jQuery("#chantier").append(lesOptions);
                        jQuery("#chantier").trigger("chosen:updated");

                    });
                });

                jQuery("#chantier").change(function (e) {
                    var chantier=jQuery("#chantier").val();
                    jQuery.get("../../proprietaireListeFonction/"+chantier, function(data, status){

                        //console.log(data[0]);
                        var lesOptions="";
                        jQuery.each(data, function( index, value ) {
                            lesOptions+="<option value='"+value.id+"'>"+value.nom+' '+value.prenoms+"</option>" ;
                        });
                        jQuery("#proprietaire").empty();
                        jQuery("#proprietaire").append(lesOptions);
                        jQuery("#proprietaire").trigger("chosen:updated");

                    });
                });

                jQuery("#nature").change(function (e) {

                    var nature =jQuery("#nature").val();
                    var route='{{URL::asset('')}}';
                    if(nature==1){
                        jQuery('#permanant').attr('src',route+'images/anarisk.png');
                        jQuery("#titreeval").empty();
                        jQuery("#titreeval").append(" Evaluation du niveau de risque");

                        jQuery("#titreeval1").empty();
                        jQuery("#titreeval1").append(" Evaluation après mesure(s) préventive(s)");


                        if(jQuery(".right-panel").hasClass('opportunite')){
                            jQuery(".right-panel").removeClass('opportunite');
                            jQuery(".right-panel").addClass('risk');
                        }else{
                            jQuery(".right-panel").addClass('risk');
                        }

                        jQuery("#causer").empty();
                        jQuery("#causer").append( "Causes");
                        jQuery("#consequence").empty();
                        jQuery("#consequence").append( "Conséquences");

                        jQuery(".severite").empty();
                        jQuery(".severite").append( "Sévérité");
                        jQuery(".cout").empty();
                        jQuery(".cout").append( "Coût");
                    }else{
                        jQuery('#permanant').attr('src',route+'images/anarisk_opportunite.jpg');
                        jQuery("#titreeval").empty();
                        jQuery("#titreeval").append( "Evaluation du niveau de l'opportunité");

                        jQuery("#titreeval1").empty();
                        jQuery("#titreeval1").append(" Evaluation après action(s) favorisante(s)");
                        jQuery("#causer").empty();
                        jQuery("#causer").append( "Facteurs");
                        jQuery("#consequence").empty();
                        jQuery("#consequence").append( "Conséquences");

                        if(jQuery(".right-panel").hasClass('risk')) {
                            jQuery(".right-panel").removeClass('risk');
                            jQuery(".right-panel").addClass('opportunite');
                        }else{
                            jQuery(".right-panel").addClass('opportunite');
                        }
                        jQuery(".severite").empty();
                        jQuery(".severite").append("Bénéfice");
                        jQuery(".cout").empty();
                        jQuery(".cout").append( "Gain");
                    }

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

                $('#cout').on('change',function(){var valeur=$('#cout').val();
                    for(var i=valeur.length-1; i>=0; i-- ){valeur=valeur.replace(' ','');}
                    var res=  lisibilite_nombre(valeur);  $('#cout').val(res);
                })
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
                test();
                test1();
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