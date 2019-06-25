@extends('layouts.app')
@section('analyses_actif')
    active
@endsection
@section('page')
    <style>
        #mydiv {
            position: absolute;
            z-index: 9;
            left:0;
            bottom:100px;
            background-color: #f1f1f1;
            text-align: center;
            border: 1px solid #d3d3d3;
            resize: both;
            overflow: hidden;
        }

        #mydivheader {
            padding: 10px;
            cursor: move;
            z-index: 10;
            background-color: #2196F3;
            color: #fff;
        }
    </style>
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


        <div id="mydiv" style="height: 162px;width: 229px" >
            <div id="mydivheader">Cliquer ici pour déplacer</div>
            <img src="{{URL::asset("images/anarisk.png")}}" width="100%" height="100%"/>
            <div class="resizeUI"><i class="fa fa-arrows"></i></div>
        </div>
        <div class="animated fadeIn">
<form method="post" action="{{route('save_analyse')}}">
    @csrf
            <div class="row">

                <div class="col-xs-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Analyses</strong> <small> Création</small>
                        </div>
                        <div class="card-body card-block">
                            <div class="row">
                                <div class="form-group col-sm-2">
                                    <label class=" form-control-label">Nature</label>
                                    <div class="input-group">

                                        <select data-placeholder="Sélectionner une nature" class="standardSelect form-control" tabindex="1" name="nature" required>
                                            <option value=""></option>
                                            @foreach($natures as $nature)
                                            <option value="{{$nature->id}}">{{$nature->nature}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-2">
                                    <label class=" form-control-label">Date</label>
                                    <div class="input-group">

                                        <input type="date" class="form-control" name="date" required/>
                                    </div>
                                </div>
                                <div class="form-group col-sm-2">
                                    <label class=" form-control-label">Pays</label>
                                    <div class="input-group">

                                        <select data-placeholder="Sélectionner un pays..." class="standardSelect form-control" tabindex="1" name="pays" required>
                                            @foreach($payss as $pays)
                                                <option @if($pays->alpha2=="CI") {{'selected'}}@endif value="{{$pays->id}}">{{$pays->nom_fr_fr."(".$pays->alpha2.")"}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-2">
                                    <label class=" form-control-label">Chantier</label>
                                    <div class="input-group">

                                        <select data-placeholder="Sélectionner un chantier..." class="standardSelect form-control" tabindex="1" name="chantier" required>
                                            @foreach($chantiers as $chantier)
                                                <option @if($chantier->id=="CI") {{'selected'}}@endif value="{{$chantier->id}}">{{$chantier->libelle}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-2">
                                    <label class=" form-control-label">Propriétaire</label>
                                    <div class="input-group">

                                        <select data-placeholder="Choose a Country..." class="standardSelect form-control" tabindex="1" name="proprietaire">
                                            @foreach($responsables as $responsable)
                                                <option  value="{{$responsable->id}}">{{$responsable->nom.' '.$responsable->prenoms}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-2">
                                    <label class=" form-control-label">Code</label>
                                    <div class="input-group">

                                        <input type="text" class="form-control" name="code" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label class=" form-control-label">Description</label>
                                    <div class="input-group">

                                        <textarea id="description" class="form-control">

                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group col-sm-8">
                                    <label class=" form-control-label">Détail</label>
                                    <div class="input-group">

                                        <textarea id="detail" class="form-control">

                                        </textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Causes </strong>
                        </div>
                        <div class="card-body">

                            Ajouter une cause
                            <button type="button" class="btn bg-teal btn-circle waves-effect waves-circle waves-float" id="addcauses">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </button>
                            </br>
                            </br>
                            <div id="causes" class="">

                                <div class=" form-control-label">
                                    <label for="causes[]">Cause</label>
                                    <div class="form-group">
                                        <input name="causes[]" class="form-control" style="" type="text"/>
                                    </div>
                                </div>

                                <hr width="100%" color="blue">
                            </div>
                            <div id="causestemplate" class="row clearfix" style="display: none">
                                <div class=" form-control-label">
                                    <label for="causes[]">Cause</label>
                                    <div class="form-group">
                                        <input name="causes[]" class="form-control" style="" type="text"/>
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
                            <strong class="card-title">Conséquences </strong>
                        </div>
                        <div class="card-body">

                            Ajouter une conséquence
                            <button type="button" class="btn bg-teal btn-circle waves-effect waves-circle waves-float" id="addconsequences">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </button>
                            </br>
                            </br>
                            <div id="consequences" class="">

                                <div class=" form-control-label">
                                    <label for="consequences[]">Conséquence</label>
                                    <div class="form-group">
                                        <input name="consequences[]" class="form-control" style="" type="text"/>
                                    </div>
                                </div>

                                <hr width="100%" color="blue">
                            </div>
                            <div id="consequencestemplate" class="row clearfix" style="display: none">
                                <div class=" form-control-label">
                                    <label for="consequences[]">Conséquence</label>
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
                            <strong>Evaluation du neveau de risque</strong>
                        </div>
                        <div class="card-body card-block">
                            <div class="form-group col-sm-2">
                                <label class=" form-control-label">Probabilité d'occurance</label>
                                <div class="input-group">

                                    <input name="probabiliteAvant" id="probabiliteAvant" class="form-control calcule" type="number" min="1" max="5"  required/>
                                </div>
                            </div>
                            <div class="form-group col-sm-2">
                                <label class=" form-control-label"> Séverité</label>
                                <div class="input-group">

                                    <input name="severiteAvant" id="severiteAvant" class="form-control calcule" type="number" min="1" max="5" required/>
                                </div>
                            </div>

                            <div class="form-group col-sm-2">
                                <label class=" form-control-label">Planning</label>
                                <div class="input-group">

                                    <input name="planingAvant" id="planingAvant" class="form-control calcule" type="number" min="1" max="5" required/>
                                </div>
                            </div>
                            <div class="form-group col-sm-2">
                                <label class=" form-control-label">Coût</label>
                                <div class="input-group">

                                    <input name="coutAvant" id="coutAvant"  class="form-control calcule" type="number" min="1" max="5" required/>
                                </div>
                            </div>
                            <div class="form-group col-sm-2">
                                <label class=" form-control-label">Niveau</label>
                                <div class="input-group">

                                    <input name="niveauAvant" id="niveauAvant" class="form-control calcule" type="number" min="1" required readonly/>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Evaluation après mesure préventive</strong>
                        </div>
                        <div class="card-body card-block">

                            <div class="form-group col-sm-2">
                                <label class=" form-control-label">Probabilité d'occurance</label>
                                <div class="input-group">

                                    <input name="probabiliteApres" class="form-control calcule1" type="number" min="1" max="5"/>
                                </div>
                            </div>
                            <div class="form-group col-sm-2">
                                <label class=" form-control-label"> Séverité</label>
                                <div class="input-group">

                                    <input name="severiteApres" class="form-control calcule1" type="number" min="1" max="5"/>
                                </div>
                            </div>

                            <div class="form-group col-sm-2">
                                <label class=" form-control-label">Planning</label>
                                <div class="input-group">

                                    <input name="planingApres" class="form-control calcule1" type="number" min="1" max="5"/>
                                </div>
                            </div>
                            <div class="form-group col-sm-2">
                                <label class=" form-control-label">Coût</label>
                                <div class="input-group">

                                    <input name="coutApres" class="form-control calcule1" type="number" min="1" max="5"/>
                                </div>
                            </div>
                            <div class="form-group col-sm-2">
                                <label class=" form-control-label">Niveau</label>
                                <div class="input-group">

                                    <input name="niveauApres" id="niveauApres" class="form-control" type="number" min="1" readonly/>
                                </div>
                            </div>
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
                                <label class=" form-control-label">Coût: &nbsp;</label>
                                <div class="input-group">

                                    <input name="cout" class="form-control" type="number" required/>
                                </div> <label class=" form-control-label"> &nbsp;Fr </label>
                            </div>
                            </br>
                            </br>
                            </br>
                            <div class="form-group col-sm-12">

                                <div class="input-group">

                                    <textarea name="brouillon" class="form-control" style="height: 318px; margin-top: 0px; margin-bottom: 0px;"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer pull-right">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-dot-circle-o"></i> Enregistrer
                </button>
            </div>
</form>

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

        <script>

            jQuery(document).ready(function() {
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

                    var res = parseInt(luimeme)+parseInt(severiteAvant)+parseInt(planingAvant)+parseInt(coutAvant);

                    $("#niveauAvant").val(res);
                };
                function test1(){
                    if($("#probabiliteApres").val()!="") {
                        var luimeme = $("#probabiliteApres").val();
                    }else{
                        var luimeme=0;
                    }
                    if($("#severiteApres").val()!="") {
                    var severiteAvant=$("#severiteApres").val();
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

                    var res = parseInt(luimeme)+parseInt(severiteApres)+parseInt(planingApres)+parseInt(coutApres);

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