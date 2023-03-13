@extends('layouts.app')

@section('title')
    Swagger
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        Swagger
    </li>
@endsection

@section('content')
    <div id="swagger-ui"></div>
    <script src="{{ asset('swagger-assets/swagger.js') }}" crossorigin></script>
    <script>
      window.onload = () => {
        window.ui = SwaggerUIBundle({
          url: "/swagger/openapi.yaml",
          dom_id: '#swagger-ui',
        });
      };
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('swagger-assets/swagger.css') }}"/>
    <style>
        .information-container {
            display: none;
        }

        .swagger-ui .wrapper {
            max-width: 100%;
            background: #fff;
            padding: 15px;
        }

        .scheme-container .wrapper {
            padding: 0 20px;
        }

        .swagger-ui a.nostyle, .swagger-ui a.nostyle:visited {
            font-weight: bold;
        }

        .wrapper .col-12 {
            padding: 0;
        }

        .swagger-ui .scheme-container {
            padding: 15px;
        }

        .swagger-ui * {
            font-family: Consolas, monaco, monospace !important;
        }
    </style>
@endsection