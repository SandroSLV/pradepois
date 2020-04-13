                <h2><a href="<?php echo path::ROOT; ?>dashboard" style="font-size: 45px;">&#8672;</a> Cadastro</h2>
                <br>
                <form action="<?php echo path::ROOT; ?>profile/update" method="post" ajax="true">
                    <label>Nova senha</label>
                    <input onfocus="removeError(this)" type="password" id="password" name="password">
                    <span id="span-password">Campo deve ter mais de seis caracteres.</span>
                    <br><br><br>

                    <label>Repetir senha</label>
                    <input onfocus="removeError(this)" type="password" id="repassword" name="repassword">
                    <span id="span-repassword">Senha não confere.</span>
                    <br><br><br>

                    <label>Qual sua categoria?</label>
                    <select id="category" name="category">
                        <option value="" <?php if($content['category']==='') echo 'selected'; ?>>Qual sua categoria?</option>
                        <option value="1" <?php if($content['category']==='1') echo 'selected'; ?>>Assistência Técnica</option>
                        <option value="2" <?php if($content['category']==='2') echo 'selected'; ?>>Aulas Particulares</option>
                        <option value="3" <?php if($content['category']==='3') echo 'selected'; ?>>Autos</option>
                        <option value="4" <?php if($content['category']==='4') echo 'selected'; ?>>Construção Manutenção Reforma</option>
                        <option value="5" <?php if($content['category']==='5') echo 'selected'; ?>>Consultoria</option>
                        <option value="6" <?php if($content['category']==='6') echo 'selected'; ?>>Design e Tecnologia</option>
                        <option value="7" <?php if($content['category']==='7') echo 'selected'; ?>>Eventos</option>
                        <option value="8" <?php if($content['category']==='8') echo 'selected'; ?>>Moda e Beleza</option>
                        <option value="9" <?php if($content['category']==='9') echo 'selected'; ?>>Saúde</option>
                        <option value="10" <?php if($content['category']==='10') echo 'selected'; ?>>Serviços Domésticos</option>
                    </select>
                    <span id="span-category"></span>
                    <br><br><br>
                    <label>Seu nome</label>
                    <input onfocus="removeError(this)" type="text" id="name" name="name" placeholder="Ex: Pedro Costa" value="<?php echo $content['name']; ?>" required>
                    <span id="span-name">Campo deve ter mais de três caracteres.</span>
                    <br><br><br>

                    <label>Nome da empresa</label>
                    <input onfocus="removeError(this)" type="text" id="company" name="company" placeholder="Ex: Salão Deusas" value="<?php echo $content['company']; ?>" required>
                    <span id="span-company">Campo deve ter mais de três caracteres.</span>
                    <br><br><br>

                    <label>Nome de usuário</label>
                    <input onfocus="removeError(this)" onblur="getUsername()" type="text" id="username" name="username" placeholder="Ex: salaodeusas" value="<?php echo $content['username']; ?>" required>
                    <span id="span-username">Usuário inválido ou já existe.</span>
                    <br><br><br>

                    <label>CNPJ da empresa</label>
                    <input onfocus="removeError(this)" type="text" id="cnpj" name="cnpj" placeholder="Apenas números" value="<?php echo $content['cnpj']; ?>" required>
                    <span id="span-cnpj">CNPJ inválido.</span>
                    <br><br><br>

                    <label>Telefone da empresa</label>
                    <input onfocus="removeError(this);" onblur="addPhone();" type="text" id="phone" name="phone" placeholder="Telefone com DDD" value="<?php echo $content['phone']; ?>" required>
                    <span id="span-phone">Telefone inválido.</span>
                    <br><br><br>

                    <label>CEP da empresa</label>
                    <input onfocus="removeError(this);" onblur="addAddressByCEP();" type="text" id="zipcode" name="zipcode" placeholder="Apenas números" value="<?php echo $content['zipcode']; ?>" required>
                    <span id="span-zipcode">CEP inválido.</span>
                    <br><br><br>

                    <label>Endereço da empresa</label>
                    <input onfocus="removeError(this)" type="text" id="address" name="address" placeholder="Ex: Rua Norte" value="<?php echo $content['address']; ?>" required>
                    <span id="span-address">Campo deve ter mais de três caracteres.</span>
                    <br><br><br>              

                    <label>Número da empresa</label>
                    <input onfocus="removeError(this)" type="text" id="number" name="number" placeholder="Ex: 64" value="<?php echo $content['number']; ?>" required>
                    <span id="span-number"></span>
                    <br><br><br> 

                    <label>Complemento da empresa</label>
                    <input onfocus="removeError(this)" type="text" id="complement" name="complement" placeholder="Ex: Sala 20" value="<?php echo $content['complement']; ?>">
                    <span id="span-complement"></span>
                    <br><br><br> 

                    <label>Bairro da empresa</label>
                    <input onfocus="removeError(this)" type="text" id="district" name="district" placeholder="Ex: Limoeiro"  value="<?php echo $content['district']; ?>" required>
                    <span id="span-district"></span>
                    <br><br><br>

                    <label>Estado da empresa</label>
                    <input onfocus="removeError(this)" type="text" id="state" name="state" placeholder="Estado" value="<?php echo $content['state']; ?>" required>
                    <span id="span-state"></span>
                    <br><br><br> 

                    <label>Cidade da empresa</label>
                    <input onfocus="removeError(this)" type="text" id="city" name="city" placeholder="Cidade" value="<?php echo $content['city']; ?>" required>
                    <span id="span-city"></span>
                    <br><br><br> 
                 <button>ATUALIZAR</button>   
                </form>
                <br>

                <script type="text/javascript">
                    
                    // Monta o resultado
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
                                    console.log(response.message);
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