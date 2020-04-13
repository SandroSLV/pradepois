                <div style="text-align: center;">
                <a href="../">
                    <img src="<?php echo path::ROOT; ?>imgs/logo_pra_depois.svg" style="width: 260px; margin-bottom: 40px;">
                    </a>
                </div>
                <h2>Login</h2><br>
                <form action="<?php echo path::ROOT; ?>login/validate" method="post" ajax="true">
                    <label>E-mail</label>
                    <input onfocus="removeError(this)" type="email" id="email" name="email" required>
                    <span id="span-email">Não é um e-mail valido</span>
                    <br><br><br>
                    <label>Senha</label>
                    <input onfocus="removeError(this)" type="password" id="password" name="password" required>
                    <span id="span-password">Mínimo de 6 caracteres</span>
                    <br><br>
                    <button>ENTRAR</button>
                </form>
                <div style="margin-top: 50px; text-align: center;">
                    Não tem cadastro? <a href="register">Clique aqui</a>
                </div>

                <script type="text/javascript">
                    function mountResult (response){

                        if(response.type==='result'){
                            if(response.message === 'ERROR'){
                                showModal('error', 'Falha na sua solicitação.');
                            } else {
                                if(typeof response.message[0].id !== 'undefined'){
                                    redirectPage('<?php echo path::ROOT; ?>dashboard');
                                } else {
                                    switch (response.message) {
                                        case 'CONFIRMATION':
                                            redirectPage('<?php echo path::ROOT; ?>confirmation');
                                            break;
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
