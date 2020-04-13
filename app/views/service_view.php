                <h2><a href="<?php echo path::ROOT; ?>dashboard" style="font-size: 45px;">&#8672;</a> Serviços</h2><br>
                
                <form action="<?php echo path::ROOT.$content['page']; ?>" method="post" ajax="true">
                    <input type="hidden" id="id" name="id" name="type" value="<?php echo $content['id']; ?>">
                    <label>Nome do serviço</label>
                    <input onfocus="removeError(this)" type="text" id="service" name="service" placeholder="Ex: Corte feminino" value="<?php echo $content['service']; ?>" required>
                    <span id="span-service">Campo deve ter mais de três caracteres.</span>
                    <br><br><br>
                    <label>Descrição do serviço</label>
                    <input onfocus="removeError(this)" type="text" id="description" name="description" placeholder="Ex: Corte simples de cabelo feminino" value="<?php echo $content['description']; ?>">
                    <span id="span-description">Campo deve ter mais de três caracteres.</span>
                    <br><br><br>
                    <label>Valor do serviço</label>
                    <input onfocus="removeError(this)" type="text" id="value" name="value" placeholder="30,00" value="<?php echo $content['value']; ?>" required>
                    <span id="span-value">Campo deve ter mais de três caracteres.</span>
                    <br><br>                    

                 <button>OK</button>   
                </form>
                <?php if($content['id']!=='') { ?>
                <br>
                <button class="error" onclick="document.getElementById('modal_service').style.display = 'block';">APAGAR</button>
                <?php } ?>
                <div id="modal_service">
                    <div>
                        <h3>Apagar</h3><br>
                        <p>Os vouchers vendidos com esse serviço ainda serão válidos.</p><br>
                        <button class="error" onclick="requestContent('<?php echo path::ROOT; ?>service/delete', 'POST', 'id=<?php echo $content['id']; ?>', 'delete');">APAGAR</button> <br><br>
                        <button onclick="document.getElementById('modal_service').style.display = 'none';">CANCELAR</button>   
                    </div>
                </div>

                <script type="text/javascript">


                        

                    
                    // Monta o resultado
                    function mountResult (response, requester){
                        switch (requester) {
                            case 'delete':
                                if(response.message === 'SUCCESS'){
                                    redirectPage('<?php echo path::ROOT; ?>dashboard');
                                } else {
                                    showModal('error', 'Falha na sua solicitação.');
                                }
                                break;
                            default:
                                if(response.type==='result'){
                                    if(response.message === 'SUCCESS'){
                                        redirectPage('<?php echo path::ROOT; ?>dashboard');
                                    } else {
                                        showModal('error', 'Falha na sua solicitação.');
                                    }
                                } else {
                                    showModal(response.type, response.message);
                                }
                        }
                    };                
                </script>