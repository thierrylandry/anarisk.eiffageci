@extends('layouts.app')
@section('tableau_de_bord_actif')
    active
    @endsection
@section('page')
<style>
    #colopportunite{
        border:1px;
    }

    .tablee{

        border:1px;
    }
    table.tablee th td {
        width: 100%;
        border:  none;
    }
    table.tablee tbody tr th:first-child{
        border-top:none;
        border-left: none;
        border-bottom: none;
    }</style>
    <div class="breadcrumbs" style="max-height:300px">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Tableau de bord</h1>
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



        <div class="row">
            <div class="col-lg-6 tableau" id="">
                <div class="card" style="height: 100% !important">
                    <div class="card-body" >
                        <div class="table-responsive table-responsive-data2">
                            <table class="table  table-earning" id="table_employe">
                                <thead>
                                <tr>
                                    <th>Analyses</th>
                                    <th>Effectifs</th>
                                </tr>
                                </thead>
                                <tbody>
                                @for($i=0;$i<sizeof($effanalyses);$i++)
                                    <tr class="tr-shadow">
                                        <td> {{$effanalyses[$i]->name}}</td>
                                        <td> {{$effanalyses[$i]->y}}</td>
                                    </tr>
                                @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xs-6	col-sm-6	col-md-6	col-lg-6">
                <div class="au-card m-b-30">
                    <div class="au-card-inner">
                        <div id="effanalyses" style=""></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row " >
            <div class="col-md-12" >
                <div class="card">
                    <div class="card-body">

                        <table class="tablee pull-right" style="border: 1px; text-align: center;width: 100%">
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
                                <td class="tableau" style="background-color: #f31f1f; color: white" id="aupire_aupire">{{isset($tableau_recap->aupire_aupire)?number_format($tableau_recap->aupire_aupire,0,',',' '):''}}</td>
                                <td class="tableau" style="background-color: #f5001775;color: white" id="aupire_juste">{{isset($tableau_recap->aupire_aupire)?number_format($tableau_recap->aupire_juste,0,',',' '):''}}</td>
                                <td class="tableau" style="background-color: #ecf4ee;" id="aupire_aumieux">{{isset($tableau_recap->aupire_aupire)?number_format($tableau_recap->aupire_aumieux,0,',',' '):''}}</td>
                            </tr>
                            <tr class="tableau" >
                                <th class="tableau">Juste</th>
                                <td class="tableau" style="background-color: #f5001775;" id="juste_aupire">{{isset($tableau_recap->aupire_aupire)?number_format($tableau_recap->juste_aupire,0,',',' '):''}}</td>
                                <td class="tableau" style="background-color: #2c76ce36;" id="juste_juste">{{isset($tableau_recap->aupire_aupire)?number_format($tableau_recap->juste_juste,0,',',' '):''}}</td>
                                <td class="tableau" style="background-color: #a4dea8;" id="juste_aumieux">{{isset($tableau_recap->aupire_aupire)?number_format($tableau_recap->juste_aumieux,0,',',' '):''}}</td>
                            </tr>
                            <tr class="tableau">
                                <th class="tableau">Au mieux</th>
                                <td class="tableau" style="background-color: #b1d0ba40;" id="aumieux_aupire">{{isset($tableau_recap->aupire_aupire)?number_format($tableau_recap->aumieux_aupire,0,',',' '):''}}</td>
                                <td class="tableau" style="background-color: #a4dea8;" id="aumieux_juste">{{isset($tableau_recap->aupire_aupire)?number_format($tableau_recap->aumieux_juste,0,',',' '):''}}</td>
                                <td class="tableau" style="background-color: #23ff32;" id="aumieux_aumieux">{{isset($tableau_recap->aupire_aupire)?number_format($tableau_recap->aumieux_aumieux,0,',',' '):''}}</td>

                            </tbody></table>

                    </div>
                </div>
            </div>

        </div>
        <script src="{{ asset("assets/js/vendor/jquery-2.1.4.min.js") }}"></script>

        <script>
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

        <script src="{{URL::asset('code/highcharts.js')}}"></script>
        <script src="{{URL::asset('code/modules/exporting.js')}}"></script>
        <script src="{{URL::asset('code/modules/export-data.js')}}"></script>
    <script>

        var colors= [
            "#63b598", "#ce7d78", "#ea9e70", "#a48a9e", "#c6e1e8", "#648177" ,"#0d5ac1" ,
            "#f205e6" ,"#1c0365" ,"#14a9ad" ,"#4ca2f9" ,"#a4e43f" ,"#d298e2" ,"#6119d0",
            "#d2737d" ,"#c0a43c" ,"#f2510e" ,"#651be6" ,"#79806e" ,"#61da5e" ,"#cd2f00" ,
            "#9348af" ,"#01ac53" ,"#c5a4fb" ,"#996635","#b11573" ,"#4bb473" ,"#75d89e" ,
            "#2f3f94" ,"#2f7b99" ,"#da967d" ,"#34891f" ,"#b0d87b" ,"#ca4751" ,"#7e50a8" ,
            "#c4d647" ,"#e0eeb8" ,"#11dec1" ,"#289812" ,"#566ca0" ,"#ffdbe1" ,"#2f1179" ,
            "#935b6d" ,"#916988" ,"#513d98" ,"#aead3a", "#9e6d71", "#4b5bdc", "#0cd36d",
            "#250662", "#cb5bea", "#228916", "#ac3e1b", "#df514a", "#539397", "#880977",
            "#f697c1", "#ba96ce", "#679c9d", "#c6c42c", "#5d2c52", "#48b41b", "#e1cf3b",
            "#5be4f0", "#57c4d8", "#a4d17a", "#225b8", "#be608b", "#96b00c", "#088baf",
            "#f158bf", "#e145ba", "#ee91e3", "#05d371", "#5426e0", "#4834d0", "#802234",
            "#6749e8", "#0971f0", "#8fb413", "#b2b4f0", "#c3c89d", "#c9a941", "#41d158",
            "#fb21a3", "#51aed9", "#5bb32d", "#807fb", "#21538e", "#89d534", "#d36647",
            "#7fb411", "#0023b8", "#3b8c2a", "#986b53", "#f50422", "#983f7a", "#ea24a3",
            "#79352c", "#521250", "#c79ed2", "#d6dd92", "#e33e52", "#b2be57", "#fa06ec",
            "#1bb699", "#6b2e5f", "#64820f", "#1c271", "#21538e", "#89d534", "#d36647",
            "#7fb411", "#0023b8", "#3b8c2a", "#986b53", "#f50422", "#983f7a", "#ea24a3",
            "#79352c", "#521250", "#c79ed2", "#d6dd92", "#e33e52", "#b2be57", "#fa06ec",
            "#1bb699", "#6b2e5f", "#64820f", "#1c271", "#9cb64a", "#996c48", "#9ab9b7",
            "#06e052", "#e3a481", "#0eb621", "#fc458e", "#b2db15", "#aa226d", "#792ed8",
            "#73872a", "#520d3a", "#cefcb8", "#a5b3d9", "#7d1d85", "#c4fd57", "#f1ae16",
            "#8fe22a", "#ef6e3c", "#243eeb", "#1dc18", "#dd93fd", "#3f8473", "#e7dbce",
            "#421f79", "#7a3d93", "#635f6d", "#93f2d7", "#9b5c2a", "#15b9ee", "#0f5997",
            "#409188", "#911e20", "#1350ce", "#10e5b1", "#fff4d7", "#cb2582", "#ce00be",
            "#32d5d6", "#17232", "#608572", "#c79bc2", "#00f87c", "#77772a", "#6995ba",
            "#fc6b57", "#f07815", "#8fd883", "#060e27", "#96e591", "#21d52e", "#d00043",
            "#b47162", "#1ec227", "#4f0f6f", "#1d1d58", "#947002", "#bde052", "#e08c56",
            "#28fcfd", "#bb09b", "#36486a", "#d02e29", "#1ae6db", "#3e464c", "#a84a8f",
            "#911e7e", "#3f16d9", "#0f525f", "#ac7c0a", "#b4c086", "#c9d730", "#30cc49",
            "#3d6751", "#fb4c03", "#640fc1", "#62c03e", "#d3493a", "#88aa0b", "#406df9",
            "#615af0", "#4be47", "#2a3434", "#4a543f", "#79bca0", "#a8b8d4", "#00efd4",
            "#7ad236", "#7260d8", "#1deaa7", "#06f43a", "#823c59", "#e3d94c", "#dc1c06",
            "#f53b2a", "#b46238", "#2dfff6", "#a82b89", "#1a8011", "#436a9f", "#1a806a",
            "#4cf09d", "#c188a2", "#67eb4b", "#b308d3", "#fc7e41", "#af3101", "#ff065",
            "#71b1f4", "#a2f8a5", "#e23dd0", "#d3486d", "#00f7f9", "#474893", "#3cec35",
            "#1c65cb", "#5d1d0c", "#2d7d2a", "#ff3420", "#5cdd87", "#a259a4", "#e4ac44",
            "#1bede6", "#8798a4", "#d7790f", "#b2c24f", "#de73c2", "#d70a9c", "#25b67",
            "#88e9b8", "#c2b0e2", "#86e98f", "#ae90e2", "#1a806b", "#436a9e", "#0ec0ff",
            "#f812b3", "#b17fc9", "#8d6c2f", "#d3277a", "#2ca1ae", "#9685eb", "#8a96c6",
            "#dba2e6", "#76fc1b", "#608fa4", "#20f6ba", "#07d7f6", "#dce77a", "#77ecca"];

        var effanalyses=[
            @foreach($effanalyses as $res)
                    {{"{name:"}} '{{$res->name}}' {{",y:".$res->y."}"}},
            @endforeach

        ];
        // Build the chart
        Highcharts.chart('effanalyses', {
            exporting: { enabled: false },
            colors: ['red','green'],
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Risques / Opportunités'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: effanalyses
            }],
        });
    </script>

@endsection