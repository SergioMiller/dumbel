<!-- HTML for static distribution bundle build -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Swagger</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('swagger-assets/swagger-ui.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('swagger-assets/favicon-32x32.png') }}" sizes="32x32"/>
    <link rel="icon" type="image/png" href="{{ asset('swagger-assets/favicon-16x16.png') }}" sizes="16x16"/>
    <style>
        html {
            box-sizing: border-box;
            overflow: -moz-scrollbars-vertical;
            overflow-y: scroll;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        body {
            margin: 0;
            background: #fafafa;
        }

        .info, .models {
            display: none !important;
        }
    </style>
</head>

<body>
<div id="swagger-ui"></div>

<script src="{{ asset('swagger-assets/swagger-ui-bundle.js') }}"></script>
<script src="{{ asset('swagger-assets/swagger-ui-standalone-preset.js') }}"></script>
<script>
  window.onload = function () {
    // Begin Swagger UI call region
    const ui = SwaggerUIBundle({
      url: window.location.protocol + "//" + window.location.hostname + ":" + window.location.port + "/swagger-assets/openapi.yaml",
      dom_id: '#swagger-ui',
      deepLinking: true,
      presets: [
        SwaggerUIBundle.presets.apis,
        SwaggerUIStandalonePreset
      ],
      plugins: [
        SwaggerUIBundle.plugins.DownloadUrl
      ],
      layout: "StandaloneLayout"
    })
    // End Swagger UI call region

    window.ui = ui
  }
</script>
</body>
</html>
