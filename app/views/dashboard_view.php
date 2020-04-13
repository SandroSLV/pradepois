<div style="display: flex;flex-direction: row; align-items: center; justify-content: space-between; margin-bottom: 40px;">
    <div><img id="logo-dashboard" src="<?php echo path::ROOT; ?>imgs/logo_pra_depois.svg" style="width: 260px; "></div>
    <div>
        <a href="<?php echo path::ROOT; ?>service/add">
            <img src="<?php echo path::ROOT; ?>imgs/icon_add.svg" style="height: 28px; margin-right: 15px;" alt="Adicionar Serviço">
        </a>
        <a href="#">
            <img src="<?php echo path::ROOT; ?>imgs/icon_share.svg" style="height: 28px; margin-right: 15px;" alt="Adicionar Serviço">
        </a>
        <a href="<?php echo path::ROOT; ?>profile/edit">
            <img src="<?php echo path::ROOT; ?>imgs/icon_setting.svg" style="height: 28px; margin-right: 15px;" alt="Editar configurações">
        </a>
        <a href="<?php echo path::ROOT; ?>logout">
            <img src="<?php echo path::ROOT; ?>imgs/icon_logout.svg" style="height: 28px;" alt="Sair">
        </a>
    </div>
</div>

<div id="tab_nav">
    <div class='tab selected'>
        <a href="#">Serviços</a>
    </div>
    <div class='tab'>
        <a href="#">Vouchers</a>
    </div>
    <div class='tab'>
        <a href="pagseguro">PagSeguro</a>
    </div>
</div>


    <?php
        if($content!==''){
            for($i = 0; $i < count($content); $i++){
                $fields = '<div class="data"><div>'.$content[$i]['service'].' (R$ '.decimalReal($content[$i]['value']).')</div>'.
                '<div><a href="'.path::ROOT.'service/edit/'.$content[$i]['id'].'"><img src="'.path::ROOT.'imgs/icon_edit.svg" style="height: 24px;"></a></div></div>'; 
                echo  $fields;
            }
        } else { ?>
            <div style="display: flex;flex-direction: row; align-items: center; justify-content: center;margin-top: 20px;">
                Clique em <img src="<?php echo path::ROOT; ?>imgs/icon_add.svg" style="height: 18px; margin: 10px;"> para adicionar seus serviços
            </div>
            
<?php } ?>


