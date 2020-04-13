                <h2>Login - CHeckout</h2><br>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                <form action="<?php echo path::ROOT; ?>login/validate" method="post" ajax="true">
                    <input onfocus="removeError(this)" type="email" id="email" name="email" placeholder="E-mail" required>
                    <label id="label_email">Não é um e-mail valido</label>
                    <br><br>
                    <input onfocus="removeError(this)" type="password" id="password" name="password" placeholder="Senha" required>
                    <label id="label_password">Mínimo de 6 caracteres</label>
                    <br><br>
                    <button>Submit</button>
                </form>
                <div style="margin-top: 50px; text-align: center;">
                    Não tem cadastro? <a href="<?php echo path::ROOT; ?>register/checkout">Cadastre-se</a>
                </div>

                <script type="text/javascript">
                    function mountResult (response){

                        if(response.type==='result'){
                            if(response.message === 'ERROR'){
                                showModal('error', 'Falha na sua solicitação.');
                            } else {
                                if(typeof response.message[0].id !== 'undefined'){
                                    redirectPage('<?php echo path::ROOT; ?>register/checkout');
                                } else {
                                    switch (response.message) {
                                        case 'EMPTY':
                                            showModal('error', 'Senha ou e-mail incorreto.');
                                            break;
                                        case 'INACTIVE':
                                            showModal('error', 'Seu usuário está inativo.');
                                            break;
                                        case 'SUSPENDED':
                                            showModal('error', 'Seu usuário está suspenso.');
                                            break;
                                        case 'DELETED':
                                            showModal('error', 'Seu usuário está apagado.');
                                            break;
                                        case 'PROFILE':
                                            redirectPage('<?php echo path::ROOT; ?>profile/add');
                                            break;
                                        default:
                                            showModal('error', 'Falha na sua solicitação.');
                                            break;
                                    } 
                                }
                            }
                        } else {
                            showModal(response.type, response.message);
                        }
                    };                
                </script>
