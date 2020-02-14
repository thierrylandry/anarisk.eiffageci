<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body class="bg-dark">


<div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container">
        <div class="login-content">
            <div class="login-logo">
                <a href="index.html">
                    <img class="align-content" src="{{ asset('images/Eiffage_2400_03_white_RGB.png')}}" alt="">
                </a>
            </div>
            <div class="login-form">
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Mot de passe</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" value="{{ old('password') }}" required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="select" class=" form-control-label">chantiers</label></div>
                        <div class="col-12 col-md-9">

                            <select data-placeholder="Sélectionner un pays..." class="standardSelect form-control" tabindex="1" name="id_chantier" id="chantier" required>

                            </select>
                        </div>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Se souvenir de moi
                        </label>
                        <label class="pull-right">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ 'Mot de passe oublié?' }}
                                </a>
                            @endif
                        </label>

                    </div>
                    <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">SE CONNECTER</button>
                    <div class="register-link m-t-15 text-center">
                        <p>Vous n'avez pas de compte ? <a href="{{route('register')}}"> S'inscrire</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>

<script>

    jQuery(document).ready(function() {

        jQuery("#email").change(function (){
           var email=jQuery('#email').val();
            jQuery("#chantier").html('');
            jQuery.get("liste_chantier/"+email,function(data) {
                console.log(data);
             //   console.log(data);

                var option="";
                jQuery.each(data,function(index, value){
                    option+="<option value='"+value.id+"'>"+value.libelle+"</opption>"
                });
                //alert(option);

                jQuery("#chantier").html(option);

            });
        })
        jQuery("#password").change(function (){
           var email=jQuery('#email').val();
            jQuery("#chantier").html('');
            jQuery.get("liste_chantier/"+email,function(data) {
                console.log(data);
             //   console.log(data);

                var option="";
                jQuery.each(data,function(index, value){
                    option+="<option value='"+value.id+"'>"+value.libelle+"</opption>"
                });
                //alert(option);

                jQuery("#chantier").html(option);

            });
        })
        jQuery("#chantier").click(function (){
           var email=jQuery('#email').val();
            jQuery("#chantier").html('');
            jQuery.get("liste_chantier/"+email,function(data) {
                console.log(data);
             //   console.log(data);

                var option="";
                jQuery.each(data,function(index, value){
                    option+="<option value='"+value.id+"'>"+value.libelle+"</opption>"
                });
                //alert(option);

                jQuery("#chantier").html(option);

            });
        })
    });
</script>


</body>
</html>
