                <div style="text-align: center;">
                    <img src="<?php echo path::ROOT; ?>imgs/logo_pra_depois.svg" style="width: 260px; margin-bottom: 40px;">
                </div>
                
                <h2>Cadastro</h2><br>
                <p>Crie um usuário para acessar o sistema e informe os dados de sua empresa.</p>
                <br><br>
                <form action="<?php echo path::ROOT; ?>register/insert" method="post" ajax="true">
                    <input type="hidden" id="provider" name="provider" value="true">
                    <label>E-mail</label>
                    <input onfocus="removeError(this)" type="email" id="email" name="email" placeholder="Ex: seunome@dominio.com.br" required>
                    <span id="span-email">Não é um e-mail valido</span>
                    <br><br><br>
                    <label>Senha</label>
                    <input onfocus="removeError(this)" type="password" id="password" name="password" placeholder="Pelo menos 6 caracteres" required>
                    <span id="span-password">Mínimo de 6 caracteres</span>
                    <br><br><br>
                    <label>Qual sua categoria?</label>
                    <select id="category" name="category">
                        <option value="">Escolha uma opção</option>
                        <option value="1">Assistência Técnica</option>
                        <option value="2">Aulas Particulares</option>
                        <option value="3">Autos</option>
                        <option value="4">Construção Manutenção Reforma</option>
                        <option value="5">Consultoria</option>
                        <option value="6">Design e Tecnologia</option>
                        <option value="7">Eventos</option>
                        <option value="8">Moda e Beleza</option>
                        <option value="9">Saúde</option>
                        <option value="10">Serviços Domésticos</option>
                    </select>
                    <span id="span-category"></span>
                    <br><br><br>
                    <label>Seu nome</label>
                    <input onfocus="removeError(this)" type="text" id="name" name="name" placeholder="Ex: Pedro Costa" required>
                    <span id="span-name">Campo deve ter mais de três caracteres.</span>
                    <br><br><br>

                    <label>Nome da empresa</label>
                    <input onfocus="removeError(this)" type="text" id="company" name="company" placeholder="Ex: Salão Deusas" required>
                    <span id="span-company">Campo deve ter mais de três caracteres.</span>
                    <br><br><br>

                    <label>Nome de usuário</label>
                    <input onfocus="removeError(this)" onblur="getUsername()" type="text" id="username" name="username" placeholder="Ex: salaodeusas"  required>
                    <span id="span-username">Usuário inválido ou já existe.</span>
                    <br><br><br>

                    <label>CNPJ da empresa</label>
                    <input onfocus="removeError(this)" type="text" id="cnpj" name="cnpj" placeholder="Apenas números" required>
                    <span id="span-cnpj">CNPJ inválido.</span>
                    <br><br><br>

                    <label>Telefone da empresa</label>
                    <input onfocus="removeError(this);" onblur="addPhone();" type="text" id="phone" name="phone" placeholder="Telefone com DDD" required>
                    <span id="span-phone">Telefone inválido.</span>
                    <br><br><br>

                    <label>CEP da empresa</label>
                    <input onfocus="removeError(this);" onblur="addAddressByCEP();" type="text" id="zipcode" name="zipcode" placeholder="Apenas números" required>
                    <span id="span-zipcode">CEP inválido.</span>
                    <br><br><br>

                    <label>Endereço da empresa</label>
                    <input onfocus="removeError(this)" type="text" id="address" name="address" placeholder="Ex: Rua Norte" required>
                    <span id="span-address">Campo deve ter mais de três caracteres.</span>
                    <br><br><br>              

                    <label>Número da empresa</label>
                    <input onfocus="removeError(this)" type="text" id="number" name="number" placeholder="Ex: 64" required>
                    <span id="span-number"></span>
                    <br><br><br> 

                    <label>Complemento da empresa</label>
                    <input onfocus="removeError(this)" type="text" id="complement" name="complement" placeholder="Ex: Sala 20">
                    <span id="span-complement"></span>
                    <br><br><br> 

                    <label>Bairro da empresa</label>
                    <input onfocus="removeError(this)" type="text" id="district" name="district" placeholder="Ex: Limoeiro" required>
                    <span id="span-district"></span>
                    <br><br><br>

                    <label>Estado da empresa</label>
                    <input onfocus="removeError(this)" type="text" id="state" name="state" placeholder="Estado" required>
                    <span id="span-state"></span>
                    <br><br><br> 

                    <label>Cidade da empresa</label>
                    <input onfocus="removeError(this)" type="text" id="city" name="city" placeholder="Cidade" required>
                    <span id="span-city"></span>
                    <br><br><br> 
                 <button>CADASTRAR</button>   
                </form> 

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