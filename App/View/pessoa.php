<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Lucas Barbosa Antonelli</title>
        <script src="<?= self::asset("JavaScript/jquery-2.2.4.min.js") ?>" type="text/javascript"></script>
        <link href="<?= self::asset("Library/font-awesome/css/font-awesome.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= self::asset("css/modal.css") ?>" rel="stylesheet" type="text/css"/>
        <script src="<?= self::asset("JavaScript/body.js") ?>" type="text/javascript"></script>
    </head>
    <body >
        <div style="width: 100%; padding-top: 100px;">
            <div >
                <div style="text-align: right"> 
                    <i class="fa fa-plus-circle fa-lg" id="adicionar" title="Adicionar" aria-hidden="true" style="cursor: pointer"></i>  
                </div>

                <table style="width: 100%" >
                    <thead>
                        <tr >
                            <th style="text-align: left;">Nome</th>
                            <th style="text-align: left;">Sobrenome</th>
                            <th style="text-align: left;">Endereço</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($dados)) : ?> 
                            <?php foreach ($dados as $pessoa) : ?>
                                <tr id="tr_<?= $pessoa['id'] ?>" data-id="<?= $pessoa['id'] ?>">
                                    <td><?= $pessoa['nome'] ?></td>
                                    <td><?= $pessoa['sobrenome'] ?></td>
                                    <td><?= $pessoa['endereco'] ?></td>
                                    <td style="text-align: center">
                                        <i class="fa fa-pencil-square-o fa-lg editar" title="Editar" data-id="<?= $pessoa['id'] ?>" style="cursor: pointer;"></i> 
                                        <i class="fa fa-trash fa-lg deletar" title="Remover" data-id="<?= $pessoa['id'] ?>" style="cursor: pointer"></i> 
                                    </td>
                                </tr>
                            <?php endforeach; ?> 
                        <?php endif; ?> 
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal" id="divForm">
            <div class="modal-content">
                <span class="close">&times;</span>
                <br>
                <form id="form">
                    <input type="hidden" id="id" name="id">
                    <div>
                        <label for="nome">Nome</label>
                        <br>
                        <input type="text" id="nome" name="nome">
                    </div>
                    <br>
                    <div>
                        <label for="sobrenome">Sobrenome</label>
                        <br>
                        <input type="text" id="sobrenome" name="sobrenome">
                    </div>
                    <br>
                    <div>
                        <label for="endereco">Endereço</label>
                        <br>
                        <input type="text" id="endereco" name="endereco">
                    </div>
                    <br>
                    <div class="divButton">
                        <button id="cadastar">CADASTRAR</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="deletar" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <br>
                <div style="text-align: center;">
                    Você tem certeza que deseja deletar o registro?
                </div>
                <br><br>
                <input type="hidden" id="idDeletar" name="id">
                <div class="divButton">
                    <button id="cancelar">NÃO</button>
                    <button id="sim" >SIM</button>
                </div>
            </div>
        </div>
    </body>


</html>

<?php

