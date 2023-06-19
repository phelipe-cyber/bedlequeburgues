<?php

include 'vendor/autoload.php';
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
$renderer = new ImageRenderer(
    new RendererStyle(400),
    new SvgImageBackEnd()
);
$writer = new Writer($renderer);
//Exibe o QR code na tela
$data = 'pdv/?view=cardapio';

echo ($writer->writeString($data,'mvc/common/img/lanche/kisabor.png'));