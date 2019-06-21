@extends('layouts.app')
@section('analyses_actif')
    active
@endsection
@section('page')
    <style>
        #mydiv {
            position: fixed;
            top:259px;
            left:0;
            z-index: 9;
            background-color: #f1f1f1;
            text-align: center;
            border: 1px solid #d3d3d3;
            resize: both;
            overflow: auto;
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


        <div id="mydiv" style="height: 100px;width: 300px" >
            <div id="mydivheader">Cliquer ici pour déplacer</div>
            <img src="{{URL::asset("images/anarisk.png")}}" width="100%" height="100%"/>
            <div class="resizeUI"><i class="fa fa-arrows"></i></div>
        </div>
        <div class="animated fadeIn">

            <div class="row">

                <div class="col-xs-6 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>Analyses</strong> <small> Création</small>
                        </div>
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label class=" form-control-label">Nature</label>
                                <div class="input-group">

                                    <select data-placeholder="Choose a Country..." class="standardSelect form-control" tabindex="1" name="nature">
                                        <option value=""></option>
                                        <option value="United States">United States</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" form-control-label">Date</label>
                                <div class="input-group">

                                    <input type="date" class="form-control" name="date"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" form-control-label">Pays</label>
                                <div class="input-group">

                                    <select data-placeholder="Choose a Country..." class="standardSelect form-control" tabindex="1" name="pays">
                                        <option value=""></option>
                                        <option value="United States">United States</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" form-control-label">Chantier</label>
                                <div class="input-group">

                                    <select data-placeholder="Choose a Country..." class="standardSelect form-control" tabindex="1" name="chantier">
                                        <option value=""></option>
                                        <option value="United States">United States</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" form-control-label">Propriétaire</label>
                                <div class="input-group">

                                    <select data-placeholder="Choose a Country..." class="standardSelect form-control" tabindex="1" name="proprietaire">
                                        <option value=""></option>
                                        <option value="United States">United States</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" form-control-label">Code</label>
                                <div class="input-group">

                                    <input type="text" class="form-control" name="code"/>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xs-6 col-sm-6">
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
                            <div id="causes" class="form-inline">

                                <div class=" form-control-label">
                                    <label for="observation_c[]">Cause</label>
                                    <div class="form-group">
                                        <textarea name="causes[]" class="form-control" style="width:100%"></textarea>
                                    </div>
                                </div>

                                <hr width="100%" color="blue">
                            </div>
                            <div id="piecetemplate" class="row clearfix" style="display: none">
                                <div class=" form-control-label">
                                    <label for="observation_c[]">Cause</label>
                                    <div class="form-group col-sm-12">
                                        <textarea name="causes[]" class="form-control" style="width:100%"></textarea>
                                    </div>
                                </div>
                                <hr width="100%" color="blue">
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Conséquence</strong>
                        </div>
                        <div class="card-body">

                            <select data-placeholder="Choose a country..." multiple class="standardSelect">
                                <option value=""></option>
                                <option value="United States">United States</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Aland Islands">Aland Islands</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="American Samoa">American Samoa</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Anguilla">Anguilla</option>
                                <option value="Antarctica">Antarctica</option>
                            </select>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Multi Select with Groups</strong>
                        </div>
                        <div class="card-body">

                            <select data-placeholder="Your Favorite Football Team" multiple class="standardSelect" tabindex="5">
                                <option value=""></option>
                                <optgroup label="NFC EAST">
                                    <option>Dallas Cowboys</option>
                                    <option>New York Giants</option>
                                    <option>Philadelphia Eagles</option>
                                    <option>Washington Redskins</option>
                                </optgroup>
                                <optgroup label="NFC NORTH">
                                    <option>Chicago Bears</option>
                                    <option>Detroit Lions</option>
                                    <option>Green Bay Packers</option>
                                    <option>Minnesota Vikings</option>
                                </optgroup>
                                <optgroup label="NFC SOUTH">
                                    <option>Atlanta Falcons</option>
                                    <option>Carolina Panthers</option>
                                    <option>New Orleans Saints</option>
                                    <option>Tampa Bay Buccaneers</option>
                                </optgroup>
                                <optgroup label="NFC WEST">
                                    <option>Arizona Cardinals</option>
                                    <option>St. Louis Rams</option>
                                    <option>San Francisco 49ers</option>
                                    <option>Seattle Seahawks</option>
                                </optgroup>
                                <optgroup label="AFC EAST">
                                    <option>Buffalo Bills</option>
                                    <option>Miami Dolphins</option>
                                    <option>New England Patriots</option>
                                    <option>New York Jets</option>
                                </optgroup>
                                <optgroup label="AFC NORTH">
                                    <option>Baltimore Ravens</option>
                                    <option>Cincinnati Bengals</option>
                                    <option>Cleveland Browns</option>
                                    <option>Pittsburgh Steelers</option>
                                </optgroup>
                                <optgroup label="AFC SOUTH">
                                    <option>Houston Texans</option>
                                    <option>Indianapolis Colts</option>
                                    <option>Jacksonville Jaguars</option>
                                    <option>Tennessee Titans</option>
                                </optgroup>
                                <optgroup label="AFC WEST">
                                    <option>Denver Broncos</option>
                                    <option>Kansas City Chiefs</option>
                                    <option>Oakland Raiders</option>
                                    <option>San Diego Chargers</option>
                                </optgroup>
                            </select>

                        </div>
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
       <!-- .animated -->
        <script>
            $("#addcauses").click(function (e) {
                $($("#familletemplate").html()).appendTo($("#familles"));
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