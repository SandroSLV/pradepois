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
    <div class='tab '>
        <a href="dashboard">Serviços</a>
    </div>
    <div class='tab'>
        <a href="#" >Vouchers</a>
    </div>
    <div class='tab selected'>
        <a href="#">PagSeguro</a>
    </div>
</div>

<div style="display: flex;flex-direction:column; align-items: center; justify-content: center;margin-top: 40px;">
    
        <?php if(isset($_GET['notificationCode'])) { ?>
            <h3>PARABÉNS!</h3><br>
            <p>Autorização aceita. Agora você já pode aceitar vendas.</p>
            <?php } else { if($content) { ?>
            <p>Sua no <strong>PagSeguro</strong> já está veinculada.</p>
            <?php } else { ?>
            <form action="<?php echo path::ROOT; ?>pagseguro/authorization" method="post">
		<input type="hidden" name="pagseguro" id="pagseguro" value="pagseguro">
                <p>Precisamos vincular sua conta no <strong>PagSeguro</strong> para realizar as vendas.</p><br>
                <p>Caso não tenha conta no <strong>PagSeguro</strong>, você poderá cadastra-la de graça.</p>
                <br><br>
                <button type="submit">AUTORIZAR</button>
            </form>          
        <?php } } ?>
</div>


