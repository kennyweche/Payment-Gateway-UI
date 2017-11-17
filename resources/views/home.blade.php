<!DOCTYPE html>
<html>
<head>
  <title>Roamtech</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <style type="text/css">

    html, body {
      height: 100%;
      font-family: "Trebuchet MS", Helvetica, sans-serif;
      width: 100%;
      position: absolute;
    }

    .navbar a {
      color: black;
    }

    .myNavbar {
        background: rgba(0,0,0,0.03);
        margin-top: 3px;
    }

    .myNavbar li>a:hover, li>a:active, li>a:focus {
      text-decoration: none;
      background: white;
      color: cyan;
    }

    .nav-btn {
      background-color: transparent;
      color: black;
      border-color: black;
    }

    .home {
      margin-top: 0px;
      width: 100%
      padding-bottom: 100px;
      margin-bottom: 5px;
    }

    .home-right-panel {
      background: rgba(0,0,0,0.03);
      margin-left: 5px;
      border-radius: 3px;
      padding-bottom: 20px;
    }

    .home-left-panel {
      font-size: 17px;
      color: black;
      align-items: center;
      text-align: center;
      padding-left: 1px;
    }

    .features-panel {
      background: rgba(0,0,0,0.03);
    }

    .features img {
      height: 160px;
      width: 300px;
    }

    #myCarousel img {
      height: 333px;
      width: 750px;
    }

    .zoom {
      position: fixed;
      bottom: 45px;
      right: 24px;
      height: 70px;
    }

    .zoom-fab {
      display: inline-block;
      width: 40px;
      height: 40px;
      line-height: 40px;
      border-radius: 50%;
      background-color: #009688;
      vertical-align: middle;
      text-decoration: none;
      text-align: center;
      transition: 0.2s ease-out;
      box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);
      cursor: pointer;
      color: #FFF;
    }

    .zoom-fab:hover {
      background-color: #4db6ac;
      box-shadow: 0 3px 3px 0 rgba(0, 0, 0, 0.14), 0 1px 7px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -1px rgba(0, 0, 0, 0.2);
    }

    .zoom-btn-large {
      width: 60px;
      height: 60px;
      line-height: 60px;
    }

    .zoom-menu {
      position: absolute;
      right: 70px;
      left: auto;
      top: 50%;
      transform: translateY(-50%);
      height: 100%;
      width: 500px;
      list-style: none;
      text-align: right;
    }

    .zoom-menu li {
      display: inline-block;
      margin-right: 10px;
    }

    .zoom-card {
      position: absolute;
      right: 150px;
      bottom: 70px;
      transition: box-shadow 0.25s;
      padding: 24px;
      border-radius: 2px;
      background-color: #009688;
      box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);
      color: #FFF;
    }

    .zoom-card ul {
      -webkit-padding-start: 0;
      list-style: none;
      text-align: left;
    }

    .zoom-btn-person { background-color: #F44336; }

    .zoom-btn-person:hover { background-color: #e57373; }

    .zoom-btn-doc { background-color: #ffeb3b; }

    .zoom-btn-doc:hover { background-color: #fff176; }

    .zoom-btn-tangram { background-color: #4CAF50; }

    .zoom-btn-tangram:hover { background-color: #81c784; }

    .zoom-btn-report { background-color: #2196F3; }

    .zoom-btn-report:hover { background-color: #64b5f6; }

    .zoom-btn-feedback { background-color: #9c27b0; }

    .zoom-btn-feedback:hover { background-color: #ba68c8; }

    .scale-transition { transition: transform 0.3s cubic-bezier(0.53, 0.01, 0.36, 1.63) !important; }

    .scale-transition.scale-out {
      transform: scale(0);
      transition: transform 0.2s !important;
    }

    .scale-transition.scale-in { transform: scale(1); }

  </style>
</head>
<body>

<div class="container">

  <!-- Landing page -->
  <section>
    <div class="container-fluid">
      <!-- Navbar -->
      <nav class="navbar myNavbar">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            </button>
            <a class="navbar-brand" href="#">Roamtech</a>
          </div>
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
            </ul>
          </div>
        </div>
      </nav>

      <div class="row home">

        <div class="col-md-8">
          <div class="home-left-panel container-fluid">
              <div id="myCarousel" class="carousel slide" data-ride="carousel">
                  <!-- Indicators -->
                  <ol class="carousel-indicators">
                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                      <li data-target="#myCarousel" data-slide-to="1"></li>
                      <li data-target="#myCarousel" data-slide-to="2"></li>
                  </ol>

                  <!-- Wrapper for slides -->
                  <div class="carousel-inner">
                      <div class="item active">
                          <img src="images/payment1.jpg" alt="Pay">
                          <div class="carousel-caption" style="color: black; font-size: 20px;">
                              <h3>Pay</h3>
                              <p>Pay for goods and services conviniently online, we secure and complete your transactions.</p>
                          </div>
                      </div>

                      <div class="item">
                          <img src="images/payment2.jpg" alt="Receive">
                          <div class="carousel-caption" style="color: black; font-size: 20px;">
                              <h3>Receive Money</h3>
                              <p>Let us enable your business to receive money from a variety of money platforms.</p>
                          </div>
                      </div>

                      <div class="item">
                          <img src="images/payment3.jpg" alt="Pay and Receive">
                          <div class="carousel-caption" style="color: black; font-size: 20px;">
                              <h3>Pay and Receive Money</h3>
                              <p>Shop online with us using your visa or mastercard.</p>
                          </div>
                      </div>
                  </div>

                  <!-- Left and right controls -->
                  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                      <span class="glyphicon glyphicon-chevron-left"></span>
                      <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#myCarousel" data-slide="next">
                      <span class="glyphicon glyphicon-chevron-right"></span>
                      <span class="sr-only">Next</span>
                  </a>
              </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="home-right-panel container-fluid">
            <h3 class="text-center">Sign In To Your Account</h3>
            <hr>
            <div class="row">
              <div class="col-md-12">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <br>

                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <div class="col-md-3">
                            <label>Email</label>
                        </div>
                        <div class="col-md-9 {{ $errors->has('email') ? 'has-error' : '' }}">
                            <input type="text" name="email" placeholder="Email" class="form-control" autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <div class="col-md-3">
                            <label>Password</label>
                        </div>
                        <div class="col-md-9 {{ $errors->has('password') ? 'has-error' : '' }}">
                            <input type="password" name="password" placeholder="Password" class="form-control" autofocus>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <input type="submit" name="login" class="btn btn-success">
                    </div>  
                    <div class="form-group text-center">

                        <div class="col-md-6">
                          <div class="checkbox">
                              <label>
                                  <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                              </label>
                          </div>
                        </div>

                        <div class="col-md-6">
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>

                    </div>

                    <div class="col-md-8 text-center">
                        <a href="{{ route('register') }}" class="text-info pull-right">Register Here!</a>
                    </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="row features">
        <div class="col-md-2">
          <div class="features-panel">
            <div class="panel-body">
              <img src="images/bitcoin.jpg" height="200px" width="300px" class="img img-responsive img-rounded" title="Bitcoin">
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="features-panel">
            <div class="panel-body">
              <img src="images/visa.png" height="200px" width="300px" class="img img-responsive img-rounded" title="Visa">
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="features-panel">
            <div class="panel-body">
              <img src="images/mpesa.jpg" height="200px" width="300px" class="img img-responsive img-rounded" title="MPesa">
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="features-panel">
            <div class="panel-body">
              <img src="images/mastercard.png" height="200px" width="300px" class="img img-responsive img-rounded" title="Mastercard">
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="features-panel">
            <div class="panel-body">
              <img src="images/equitel.jpg" height="200px" width="300px" class="img img-responsive img-rounded" title="Equitel">
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="features-panel">
            <div class="panel-body">
              <img src="images/airtel.jpg" height="200px" width="300px" class="img img-responsive img-rounded" title="Airtel Money">
            </div>
          </div>
        </div>
      </div>

        <br>
    </div>
  </section>

  <!-- Footer -->
  <nav class="navbar myNavbar">
    <div class="container-fluid text-center">
      <br>
      <p>&copy; 2017 Roamtech Solutions Limited | All rights reserved | <a href="#">Terms and Conditions</a>| <a href="#">Privacy</a></p>
    </div>
  </nav>

  <!-- Floating Buttons -->
  <div class="zoom">
      <a class="zoom-fab zoom-btn-large" id="zoomBtn">Open</a>
      <ul class="zoom-menu">
          <li><a class="zoom-fab zoom-btn-sm zoom-btn-person scale-transition scale-out">SmsLeo</a></li>
          <li><a class="zoom-fab zoom-btn-sm zoom-btn-doc scale-transition scale-out">Skiza</a></li>
          <li><a class="zoom-fab zoom-btn-sm zoom-btn-tangram scale-transition scale-out">SAMS</a></li>
          <li><a class="zoom-fab zoom-btn-sm zoom-btn-report scale-transition scale-out">SMS</a></li>
          <li><a class="zoom-fab zoom-btn-sm zoom-btn-feedback scale-transition scale-out">Action 5</a></li>
      </ul>
      <div class="zoom-card scale-transition scale-out">
      <ul class="zoom-card-content">
          <li>Content 1</li>
          <li>Content 2</li>
          <li>Content 3</li>
          <li>Content 4</li>
          <li>Content 5</li>
      </ul>
      </div>
  </div>
</div>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $('#zoomBtn').click(function() {
        $('.zoom-btn-sm').toggleClass('scale-out');
        if (!$('.zoom-card').hasClass('scale-out')) {
          $('.zoom-card').toggleClass('scale-out');
        }
    });

    $('.zoom-btn-sm').click(function() {
        var btn = $(this);
        var card = $('.zoom-card');
        if ($('.zoom-card').hasClass('scale-out')) {
          $('.zoom-card').toggleClass('scale-out');
        }
        if (btn.hasClass('zoom-btn-person')) {
          card.css('background-color', '#d32f2f');
        } else if (btn.hasClass('zoom-btn-doc')) {
          card.css('background-color', '#fbc02d');
        } else if (btn.hasClass('zoom-btn-tangram')) {
          card.css('background-color', '#388e3c');
        } else if (btn.hasClass('zoom-btn-report')) {
          card.css('background-color', '#1976d2');
        } else {
          card.css('background-color', '#7b1fa2');
        }
    });
</script>

</body>
</html>