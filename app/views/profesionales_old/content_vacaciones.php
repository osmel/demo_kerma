<div class="contenido_preguntas">
    <div class="row menu2-socios-activo">
        <div class="col-3 item-m2-socios" id="despacho">
            <div class="row">
                <div class="col-10">
                    <h5>Estructura del despacho</h5>
                </div>
                <div class="col-2">
                    <i class=""></i>
                </div>
            </div>
        </div>
        <div class="col-3 item-m2-socios" id="sueldos">
            <div class="row">
                <div class="col-10">
                    <h5>Sueldos</h5>
                </div>
                <div class="col-2">
                    <i class=""></i>
                </div>
            </div>
        </div>
        <div class="col-3 item-m2-socios item-m2-socios-activo" id="vacaciones">
            <div class="row">
                <div class="col-10">
                    <h5>Política de vacaciones</h5>
                </div>
                <div class="col-2">
                    <i class="far fa-check-circle paloma-activo"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row contenido-edd">
    <div class="col-12 preguntas">
        <div class="row">
            <div class="col-8">
                <p style="color:#af204e; font-weight:bold">POLÍTICA DE VACACIONES</p>
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
        <?php foreach ($preguntas as $item):?>
            <div class="row">
                <div style="text-align:right" class="col-7">
                    <p3><?php echo $item->etiqueta_numeracion_pregunta. ". " . $item->pregunta;?></p3>
                </div>
                <div style="text-align:center" class="col-3">
                    <input type="text" name="" value="" placeholder="<?php echo $item->placeholder;?>">
                </div>
                <div class="col-2">
                    <p>%</p>
                </div>
            </div>
        <?php endforeach;?>
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