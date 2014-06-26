<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Process Payment Laravel Example</title>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <script type="text/javascript" src="https://conektaapi.s3.amazonaws.com/v0.3.0/js/conekta.js"></script>
        <script type="text/javascript">
            // Conekta Public Key
            Conekta.setPublishableKey('key_AJuCsxJrPqQrjcvv');
            // ...
        </script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <form action="/process/payment" method="POST" id="card-form" role="form">
                        <span class="card-errors"></span>
                        <div class="form-group">
                            <label for="nombretarjetahabiente">Nombre del tarjetahabiente</label>
                            <input type="text" class="form-control" id="nombretarjetahabiente" placeholder="Ej. Oscar Robles Torres" size="20" data-conekta="card[name]" />
                        </div>
                        <div class="form-group">
                            <label for="tarjeta">Número de la tarjeta de crédito</label>
                            <input type="text" class="form-control" id="tarjeta" placeholder="Ej. 87129873" size="20" data-conekta="card[number]" />
                        </div>
                        <div class="form-row">
                            <label>
                                <span>CVC</span>
                                <input type="text" size="4" data-conekta="card[cvc]"/>
                            </label>
                        </div>
                        <div class="form-row">
                            <label>
                                <span>Fecha de expiración (MM/AAAA)</span>
                                <input type="text" size="2" data-conekta="card[exp_month]"/>
                            </label>
                            <span>/</span>
                            <input type="text" size="4" data-conekta="card[exp_year]"/>
                        </div>
                        <button id="processPayment" class="btn btn-success" type="submit">Procesar pago</button>
                    </form>
                </div>
            </div>
        </div>

        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            jQuery(function($) {
                
                
                var conektaSuccessResponseHandler;
                conektaSuccessResponseHandler = function(token) {
                    var $form;
                    $form = $("#card-form");

                    /* Inserta el token_id en la forma para que se envíe al servidor */
                    $form.append($("<input type=\"hidden\" name=\"conektaTokenId\" />").val(token.id));

                    /* and submit */
                    $form.get(0).submit();
                };
                
                conektaErrorResponseHandler = function(token) {
                    console.log(token);
                };
                
                $("#card-form").submit(function(event) {
                    event.preventDefault();
                    var $form;
                    $form = $(this);

                    /* Previene hacer submit más de una vez */
                    $form.find("button").prop("disabled", true);
                    Conekta.token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
                    /* Previene que la información de la forma sea enviada al servidor */
                    return false;
                });

            });

        </script>
    </body>
</html>
