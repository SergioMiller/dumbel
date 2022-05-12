<?php
declare(strict_types=1);

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="Swagger Petstore",
 *         description="This is a sample server Petstore server.  You can find out more about Swagger at [http://swagger.io](http://swagger.io) or on [irc.freenode.net, #swagger](http://swagger.io/irc/).  For this sample, you can use the api key `special-key` to test the authorization filters.",
 *         termsOfService="http://swagger.io/terms/",
 *         @OA\Contact(
 *             email="apiteam@swagger.io"
 *         ),
 *         @OA\License(
 *             name="Apache 2.0",
 *             url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *         )
 *     ),
 *     @OA\Server(
 *         description="Api localhost",
 *         url="http://localhost:8000/"
 *     ),
 *     @OA\Server(
 *         description="Api localhost",
 *         url="http://localhost/"
 *     ),
 *     @OA\ExternalDocumentation(
 *         description="Find out more about Swagger",
 *         url="http://swagger.io"
 *     ),
 *     @OA\Components(
 *         @OA\SecurityScheme(
 *             securityScheme="bearerAuth",
 *             in="header",
 *             name="Authorization",
 *             type="http",
 *             scheme="bearer",
 *             bearerFormat="JWT",
 *         ),
 *     )
 * )
 */
