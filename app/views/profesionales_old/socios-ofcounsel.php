<?php //var_dump($preguntas); ?>
<?php $contador=0; ?>
<div class="contenido_preguntas">
    <div class="row contenido-edd">
        <div class="col-9 preguntas">
            <div class="row">
                <div class="col-8">
                    <p style="color:#af204e; font-weight:bold">Estructura del despacho</p>
                    <h3 style="margin-top:-10px">Of Counsel</h3>
                </div>
                <div class="col-4 ">
                    <div class="row">
                        <button class="btn-replicar-info" type="button" name="button">Replicar informarción</button>
                        <button class="btn-replicar-info-tip" type="button" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">

                        </button>
                    </div>

                </div>
            </div>
            <hr>



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
