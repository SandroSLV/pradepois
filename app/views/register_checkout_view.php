                <h2>Cadastro - checkout</h2><br>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                <form action="<?php echo path::ROOT.$content['page'];?>" method="post" ajax="true">
                    <input type="hidden" id="provider" name="provider" value="false">


                    <?php if($content['name']==='') { ?>
                    <input onfocus="removeError(this)" type="email" id="email" name="email" placeholder="E-mail" required>
                    <label id="label_email">Não é um e-mail valido</label>
                    <br><br>

                    <input onfocus="removeError(this)" type="password" id="password" name="password" placeholder="Senha" required>
                    <label id="label_password">Mínimo de 6 caracteres</label>
                    <br><br>
                    
                    <?php }  ?>

                    <input onfocus="removeError(this)" type="text" id="name" name="name" placeholder="Seu nome" value="<?php echo $content['name']; ?>" required>
                    <label id="label_name">Campo deve ter mais de três caracteres.</label>
                    <br><br>

                    <input onfocus="removeError(this)" type="text" id="cpf" name="cpf" placeholder="CPF" value="<?php echo $content['cpf']; ?>" required>
                    <label id="label_cpf">CPF inválido.</label>
                    <br><br>

                    <input onfocus="removeError(this);" onblur="addAddressByCEP()" type="text" id="zipcode" name="zipcode" value="<?php echo $content['zipcode']; ?>" placeholder="CEP" required>
                    <label id="label_zipcode">CEP inválido.</label>
                    <br><br>

                    <input onfocus="removeError(this)" type="text" id="address" name="address" placeholder="Endereço" value="<?php echo $content['address']; ?>" required>
                    <label id="label_address">Campo deve ter mais de três caracteres.</label>
                    <br><br>              


                    <input onfocus="removeError(this)" type="text" id="number" name="number" placeholder="Número" value="<?php echo $content['number']; ?>" required>
                    <label id="label_number"></label>
                    <br><br> 

                    <input onfocus="removeError(this)" type="text" id="complement" name="complement" value="<?php echo $content['complement']; ?>" placeholder="Complemento">
                    <label id="label_complement"></label>
                    <br><br> 

                    <input onfocus="removeError(this)" type="text" id="district" name="district" placeholder="Bairro" value="<?php echo $content['district']; ?>" required>
                    <label id="label_district"></label>
                    <br><br> 

                    <input onfocus="removeError(this)" type="text" id="state" name="state" placeholder="Estado" value="<?php echo $content['state']; ?>" required>
                    <label id="label_state"></label>
                    <br><br> 

                    <input onfocus="removeError(this)" type="text" id="city" name="city" placeholder="Cidade" value="<?php echo $content['city']; ?>" required>
                    <label id="label_city"></label>
                    <br><br>
                 <button>CONTINUAR</button>   
                </form>

                <script type="text/javascript">
                    function mountResult (response, requester){
                        switch (requester) {
                            case 'cep':
                                if(response.erro !== true ){
                                    document.getElementById('address').value = response.logradouro;
                                    document.getElementById('district').value = response.bairro;
                                    document.getElementById('state').value = response.uf;
                                    document.getElementById('city').value = response.localidade;
                                }
                                break;
                            case 'username':
                                if(response.message !== 'EMPTY'){
                                    document.getElementById('username').placeholder = document.getElementById('username').value;
                                    document.getElementById('username').value = '';
                                    addError('username');

                                }
                                break;
                            default:
                                if(response.type==='result'){
                                    if(response.message === 'SUCCESS'){
                                        redirectPage('<?php echo path::ROOT; ?>payment');
                                    } else {
                                        showModal('error', 'Falha na sua solicitação.');
                                    }
                                } else {
                                    showModal(response.type, response.message);
                                }
                        }
                    };                
           
                </script>