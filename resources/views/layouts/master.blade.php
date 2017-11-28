<!doctype html>
<html lang="fr">
    <head>
        <title>Intranet du Laboratoire Galaxy-Swiss Bourdin</title>
        <meta charset="UTF-8" />
{!! Html::style('assets/css/bootstrap.css') !!}
{!! Html::style('assets/css/gsb.css') !!}

    </head>
    <body class="body">
        <div class="container">
            <header class="page-header">
                <div class="col-md-3">
                    <img src="./images/logo.jpg" id="logoGSB" alt="Laboratoire Galaxy-Swiss Bourdin" title="Laboratoire Galaxy-Swiss Bourdin" />
                </div>
                <div class="col-md-9">
                    <h1>Gestion des frais visiteurs</h1>
                 </div>
            </header>
            <nav class="navbar navbar-default" role="navigation">
                
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-target">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar+ bvn"></span>
                        </button>
                    </div>
 @if (Session::get('id') == '0' || Session::get('id') == null) 
                    <a class="navbar-brand" href="#">GSB</a> 
                    <div class="collapse navbar-collapse" id="navbar-collapse-target">
                        <ul class="nav navbar-nav navbar-right">   
                            
                            <li><a href="{{ url('/getLogin') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Se connecter</a></li>
                        </ul> 
                    </div>
 
  @else  
                    <a class="navbar-brand" href="#">{{Session::get('nom')}} {{Session::get('prenom')}}</a> 
                    <div class="collapse navbar-collapse" id="navbar-collapse-target">
                        <ul class="nav navbar-nav"> 
                            <li><a href="{{ url('/saisirFraisForfait') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Saisir Frais</a></li>
                            <li><a href="{{ url('/getListeFrais') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Voir Frais</a></li>
                        </ul>  
                        <ul class="nav navbar-nav navbar-right">                             
                            <li><a href="{{ url('/Logout') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Se déconnecter</a></li>
                        </ul> 
                    </div> 
 @endif 
                </div><!--/.container-fluid -->
            </nav>
        </div> 
        <div class="container">
            @yield('content')
        </div>
{!! Html::script('assets/js/bootstrap.min.js') !!}
{!! Html::script('assets/js/jquery-2.1.3.min.js')  !!}  
{!! Html::script('assets/js/ui-bootstrap-tpls.js')  !!}
{!! Html::script('assets/js/bootstrap.js')  !!}
    </body>
</html>
