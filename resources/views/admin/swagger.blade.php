@extends('layouts.app')

@section('title')
    Swagger
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="#">Swagger</a>
    </li>
@endsection

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/swagger-ui-dist@4.5.0/swagger-ui.css"/>
    <style>
        .information-container {
            display: none;
        }

        .swagger-ui .wrapper {
            max-width: 100%;
        }

        .swagger-ui a.nostyle, .swagger-ui a.nostyle:visited {
            font-weight: bold;
        }

        .wrapper .col-12 {
            padding: 0;
        }
    </style>
@endsection

@section('content')

    <div id="swagger-ui"></div>
    <script src="https://unpkg.com/swagger-ui-dist@4.5.0/swagger-ui-bundle.js" crossorigin></script>
    <script>
      window.onload = () => {
        window.ui = SwaggerUIBundle({
          url: "/openapi.yaml",
          dom_id: '#swagger-ui',
        });
      };
    </script>
@endsection