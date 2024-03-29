<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Exportify</title>
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

  <style>
    #header {
      padding: 40px 15px;
      text-align: center;
    }

    #loginButton {
      display: none;
      margin-top: 20px;
    }

    #rateLimitMessage {
      display: none;
      text-align: center;
    }

    h1 a { color: black; }
    h1 a:hover { color: black; text-decoration: none; }

    nav.paginator:nth-child(1) {
      margin-top: -74px;
    }

    table {
      float: left;
    }

    #playlists {
      display: none;
    }

    @keyframes spinner {
      to {transform: rotate(360deg);}
    }

    @-webkit-keyframes spinner {
      to {-webkit-transform: rotate(360deg);}
    }

    .spinner {
      min-width: 24px;
      min-height: 24px;
    }

    .spinner:before {
      content: 'Loading…';
      position: absolute;
      top: 240px;
      left: 50%;
      width: 100px;
      height: 100px;
      margin-top: -50px;
      margin-left: -50px;
    }

    .spinner:not(:required):before {
      content: '';
      border-radius: 50%;
      border: 4px solid rgba(236, 235, 232, 1);
      border-top-color: rgba(130, 130, 130, 1);
      animation: spinner 1s linear infinite;
      -webkit-animation: spinner 1s linear infinite;
    }
  </style>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-mockjax/1.6.2/jquery.mockjax.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script src="//cdn.rawgit.com/eligrey/FileSaver.js/babc6d9d8fc60e667ddeafb7a7d3b844ce761ab5/FileSaver.min.js"></script>

  <!-- React.js -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/react/0.13.3/react.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/react/0.13.3/JSXTransformer.js"></script>

  <script type="text/jsx" src="exportify.js"></script>
  <?php echo csrf_field(); ?>
</head>

<body>
  <div class="container">
    <div id="header">
      <h1><i class="fa fa-spotify" style="color: #84BD00"></i> <a href="exportify.html">Exportify</a></h1>
      <p id="subtitle" class="lead">Export your Spotify playlists.</p>

      <button id="loginButton" type="submit" class="btn btn-default btn-lg" onclick="window.Helpers.authorize()">
        <i class="fa fa-check-circle-o"></i> Get Started
      </button>
    </div>

    <div id="playlistsContainer"></div>

    <div id="rateLimitMessage" class="lead">
      <p><i class="fa fa-bolt" style="font-size: 50px; margin-bottom: 20px"></i></p>
      <p>Oops, Exportify has encountered a <a target="_blank" href="https://developer.spotify.com/web-api/user-guide/#rate-limiting">rate limiting</a> error while using the Spotify API. This might be because of the number of users currently exporting playlists, or perhaps because you have too many playlists to export all at once. Try <a target="_blank" href="https://github.com/watsonbox/exportify/issues/6#issuecomment-110793132">creating your own</a> Spotify application. If that doesn't work, please add a comment to <a target="_blank" href="https://github.com/watsonbox/exportify/issues/6">this issue</a> where possible resolutions are being discussed.</p>
      <p style="margin-top: 50px">It should still be possible to export individual playlists, particularly when using your own Spotify application.</p>
    <div>
  </div><!-- /.container -->
</body>
</html>
