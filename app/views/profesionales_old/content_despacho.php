<?php //var_dump($respuestas); ?>
<?php $contador=0; ?>
<div class="contenido_preguntas">
    <div class="row menu2-socios-activo">
        <div class="col-3 item-m2-socios item-m2-socios-activo" id="despacho">
            <div class="row">
                <div class="col-10">
                    <h5><?php echo $categorias[3]->nombre; ?></h5>
                </div>
                <div class="col-2">
                    <i class="far fa-check-circle paloma-activo"></i>
                </div>
            </div>
        </div>
        <div class="col-3 item-m2-socios" id="sueldos">
            <div class="row">
                <div class="col-10">
                    <h5><?php echo $categorias[4]->nombre; ?></h5>
                </div>
                <div class="col-2">
                    <i class=""></i>
                </div>
            </div>
        </div>
        <div class="col-3 item-m2-socios" id="vacaciones">
            <div class="row">
                <div class="col-10">
                    <h5><?php echo $categorias[5]->nombre; ?></h5>
                </div>
                <div class="col-2">
                    <i class=""></i>
                </div>
            </div>
        </div>

        </br>

        <?php //for($i=3; $i<6; $i++){ ?>
        <!--<div class="col-3 item-m2-socios" id="<?php //echo $categorias[$i]->nombre;?>">
            <div class="row">
                <div class="col-10">
                    <h5><?php //echo $categorias[$i]->nombre; ?></h5>
                </div>
                <div class="col-2">
                    <i class=""></i>
                </div>
            </div>
        </div>-->
        <?php //} ?>





    </div>

    <div class="row contenido-edd">
    <div class="col-12 preguntas">
        <div class="row">
            <div class="col-8">
                <p style="color:#af204e; font-weight:bold">ESTRUCTURA DESPACHO</p>
                <h3 style="margin-top:-10px">Titulo 2</h3>
            </div>
            <div class="col-4 ">
                <div class="row">
                    <button class="btn-replicar-info" type="button" name="button">Replicar informarción</button>
                    <button class="btn-replicar-info-tip" type="button" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">
                        ?
                    </button>
                </div>

            </div>
        </div>
        <hr>

        <!--preguntas-->
       <form id="myform">
        <?php foreach ($preguntas as $item):?>
            <?php $contador++;?>
            <div class="row">
                <div style="text-align:right" class="col-7">
                    <p3><?php echo $item->etiqueta_numeracion_pregunta. ". " . $item->pregunta;?></p3>
                </div>
                <div style="text-align:center" class="col-3">
                    <label id="lastname-error" class="error" for="c1"></label>
                    <input type="text" name="<?php echo 'c'.$contador;?>" value="" placeholder="<?php echo $item->placeholder;?>" id="<?php echo 'c'.$contador;?>">
                </div>
                <div class="col-2">
                    <p>%</p>
                </div>
            </div>
        <?php endforeach;?>
       </form>
        <!--FIN preguntas -->



        <!--btn siguiente-->
        <div class="row">
            <div style="text-align:right" class="col-7">

            </div>
            <div style="text-align:center" class="col-3">
                <button class="btn-siguiente" type="button" name="button">Siguiente</button>
            </div>
            <div class="col-2">

            </div>
        </div>
        <!--FIN btn siguiente-->

    </div> <!--FIN preguntas-->
</div>
</div>
<script>
 $(document).ready(function () {
    $("#myform").validate({
        errorClass: "invalid",
        onfocusout: false,
        rules: {
            c1: "required",
            c2: {
                required: true,
                minlength: 2
            },

        },
        messages: {
            c1: "Please enter your firstname",
            c2: {
                required: "Please enter a username",
                minlength: "Your username must consist of at least 2 characters"
            },
        }

    });
 });
</script>