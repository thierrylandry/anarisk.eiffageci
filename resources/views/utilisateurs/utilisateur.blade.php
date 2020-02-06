@extends('layouts.app')
@section('utilisateur_depli')
    show
@endsection
@section('analyses_actif')
    active
@endsection
@section('page')
    <div class="breadcrumbs" style="max-height:300px">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>GESTION UTILISATEURS</h1>
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
            <form method="post" action="{{route('save_analyse')}}">
                @csrf
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Utilisateur</strong> Création
                        </div>
                        <div class="card-body card-block">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="row form-group">
                                    <div class="col col-md-3"><label class=" form-control-label">Static</label></div>
                                    <div class="col-12 col-md-9">
                                        <p class="form-control-static">Username</p>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nom</label></div>
                                    <div class="col-12 col-md-9"><input type="text" name="nom" placeholder="Nom" class="form-control"><small class="form-text text-muted">This is a help text</small></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Prenoms</label></div>
                                    <div class="col-12 col-md-9"><input type="text"  name="prenoms" placeholder="Prenom" class="form-control"><small class="form-text text-muted">This is a help text</small></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="email-input" class=" form-control-label">Email</label></div>
                                    <div class="col-12 col-md-9"><input type="email" id="email-input" name="email" placeholder="Enter Email" class="form-control"><small class="help-block form-text">Please enter your email</small></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="password-input" class=" form-control-label">Password</label></div>
                                    <div class="col-12 col-md-9"><input type="password" id="password-input" name="password" placeholder="Password" class="form-control"><small class="help-block form-text">Please enter a complex password</small></div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="select" class=" form-control-label">Sélectionner un roles</label></div>
                                    <div class="col-12 col-md-9">
                                        <select name="select" id="select" class="form-control">
                                            <option value="0">Please select</option>
                                            <option value="1">Option #1</option>
                                            <option value="2">Option #2</option>
                                            <option value="3">Option #3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Select Large</label></div>
                                    <div class="col-12 col-md-9">
                                        <select name="selectLg" id="selectLg" class="form-control-lg form-control">
                                            <option value="0">Please select</option>
                                            <option value="1">Option #1</option>
                                            <option value="2">Option #2</option>
                                            <option value="3">Option #3</option>
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

        </div>
        <script src="{{ asset("assets/js/vendor/jquery-2.1.4.min.js") }}"></script>

        <script src="{{ asset("assets/js/lib/vector-map/country/jquery.vmap.world.js") }}"></script>

        <script>

            jQuery(document).ready(function() {
                jQuery(".standardSelect").chosen({
                    disable_search_threshold: 10,
                    no_results_text: "Oops, nothing found!",
                    width: "100%"
                });
                //en fonction du pays
                jQuery("#pays").change(function (e) {
                    var pays=jQuery("#pays").val();
                    jQuery.get("../chantierListeFonction/"+pays, function(data, status){

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
                    jQuery.get("../proprietaireListeFonction/"+chantier, function(data, status){

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
                    if(nature==1){
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


                    }else{
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