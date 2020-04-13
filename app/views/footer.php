        </div>
        
        <div id="modal" onclick="hideModal()">
            <strong id="modal_type"></strong><span id="modal_message"></span>
            <div class="close">&times;</div>
        </div>
        <div id="wait">
            <span></span>
            <img src="<?php echo path::ROOT; ?>imgs/loading.gif">
        </div>
        <script type="text/javascript">

            let timerModal;

            // Pega a acao submit do formulario
            $(document).ready(function(e) {
                $("form[ajax=true]").submit(function(e) {
                    e.preventDefault();

                    let url = $(this).attr("action");
                    let method = $(this).attr("method").toUpperCase();
                    let data = $(this).serialize();

                    requestContent(url, method, data, 'form');

                });
            });

            // MODAL
            function showModal(type, message){
                clearTimeout(timerModal);
                
                let modal = document.getElementById("modal");
                let modal_type = document.getElementById("modal_type");
                let modal_message = document.getElementById("modal_message");
                
                switch (type) {
                    case 'error':
                        modal.className = modal.className.replace(/\bsuccess\b/g, "");
                        modal.className = modal.className.replace(/\bwarning\b/g, "");
                        modal.classList.add("error");
                        modal_type.innerHTML = "ERRO:";
                        modal_message.innerHTML = message;
                        break;
                    case 'success':
                        modal.className = modal.className.replace(/\bwarning\b/g, "");
                        modal.className = modal.className.replace(/\berror\b/g, "");
                        modal.classList.add("success");
                        modal_type.innerHTML = "OK:";
                        modal_message.innerHTML = message;                        
                        break;
                    case 'warning':
                        modal.className = modal.className.replace(/\bsuccess\b/g, "");
                        modal.className = modal.className.replace(/\berror\b/g, "");
                        modal.classList.add("warning");
                        modal_type.innerHTML = "ATENCAO:";
                        modal_message.innerHTML = message; 
                        break;
                } 
                    
                modal.style.right = "0";
                modal.style.top = "0";

                timerModal = setTimeout(hideModal, 6000);
            }
            
            function hideModal(){
                clearTimeout(timerModal);
                let modal = document.getElementById("modal");
                modal.style.right = "-460px";
                modal.style.top = "-130px";
            }


            // Tela de loading
            function showLoading(){
                document.getElementById("wait").style.display = "flex";
                document.getElementById("wait").style.flexDirection = "row";
                document.getElementById("wait").style.alignItems = "center";
                document.getElementById("wait").style.justifyContent = "center";
            }
            
            function hideLoading(){
                document.getElementById("wait").style.display = "none";
            }

            // Solicitar conteudo
            function requestContent(url, method, data, requester){
                if(validateForm(data)){
                    $.ajax({
                        url: url, 
                        type: method,      
                        data: data,     
                        cache: false,
                        beforeSend: function(){
                            showLoading();
                        },
                        success: function(response){
                            console.log(response);
                            mountResult (response, requester);
                        },
                        error: function (xhr, desc, err){
                            showModal('error', 'Falha na sua solicitação.');
                        },
                        complete: function(){
                            hideLoading();
                        }
                    });
                }
            }

            // Validar formulario
            function validateForm(data){
                let validate = data.split("&");
                let response = true;
                validate.forEach(function (itens, index, arr) {
                    let item = itens.split("=");
                    if(!validateInput(item[0], item[1])){
                        addError(item[0]);
                        response = false;
                    }
                });
                return response;
            }

            // Validar Entrada
            function validateInput(key, value){
                switch (key) {
                    case 'email':
                        return checkEmail(value.replace(/%40/g, '@'));
                        break;
                    case 'cep':
                        return checkCEP(value);
                        break;
                    case 'card':
                        return checkCard(value);
                        break;
                    case 'cpf':
                        return checkCPF(value);
                        break;
                    case 'cnpj':
                        return checkCNPJ(value);
                        break;
                    case 'password':
                        return checkPassword(value);
                        break;
                    case 'repassword':
                        return checkRePassword(value);
                        break;
                    case 'name':
                        return checkName(value);
                        break;
                    case 'username':
                        return checkUsername(value);
                        break;
                    default:
                        return true;
                }
            }

            function checkCard(card){
                const reg = /^[0-9]{16}$/;
                card = card.replace(/[^\d]+/g,'');
                document.getElementById('card').value = card;
                return reg.test(card);
            }

            function checkPhone(phone){
                phone = phone.replace(/[^\d]+/g,'');
                if(phone.length < 10 || phone.length > 11){
                    return false;
                } else {
                    const DDD = phone[0]+phone[1];
                    const number = phone.substr(2);
                    document.getElementById('phone').value = '('+DDD+') '+ number;
                    return true;
                }
            }

            function checkCEP(cep){
                const reg = /^[0-9]{8}$/;
                cep = cep.replace(/[^\d]+/g,'');
                document.getElementById('zipcode').value = cep;
                return reg.test(cep);
            }

            function checkEmail(email){
                const reg = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
                return reg.test(email);
            }

            function checkPassword(password){
                if(password.length < 6){
                    return false;
                } else {
                    return true;
                }
            }

            function checkRePassword(password){
                if(password.length < 6 || password!==document.getElementById('password').value){
                    return false;
                } else {
                    return true;
                }
            }

            function checkName(name){
                if(name.length < 3){
                    return false;
                } else {
                    return true;
                }
            }

            function checkCNPJ(cnpj) {

                cnpj = cnpj.replace(/[^\d]+/g,'');
                
                if (cnpj.length != 14)
                    return false;

                if (cnpj == "00000000000000" || 
                    cnpj == "11111111111111" || 
                    cnpj == "22222222222222" || 
                    cnpj == "33333333333333" || 
                    cnpj == "44444444444444" || 
                    cnpj == "55555555555555" || 
                    cnpj == "66666666666666" || 
                    cnpj == "77777777777777" || 
                    cnpj == "88888888888888" || 
                    cnpj == "99999999999999")
                    return false;

                size = cnpj.length - 2
                numbers = cnpj.substring(0,size);
                digits = cnpj.substring(size);
                sum = 0;
                pos = size - 7;
                for (i = size; i >= 1; i--) {
                sum += numbers.charAt(size - i) * pos--;
                if (pos < 2)
                        pos = 9;
                }
                result = sum % 11 < 2 ? 0 : 11 - sum % 11;
                if (result != digits.charAt(0))
                    return false;
                    
                size = size + 1;
                numbers = cnpj.substring(0,size);
                sum = 0;
                pos = size - 7;
                for (i = size; i >= 1; i--) {
                sum += numbers.charAt(size - i) * pos--;
                if (pos < 2)
                        pos = 9;
                }
                result = sum % 11 < 2 ? 0 : 11 - sum % 11;
                if (result != digits.charAt(1))
                    return false;
                
                document.getElementById('cnpj').value = cnpj;        
                return true;
            }

            function checkCPF(cpf) {
                let sum = 0;
                let rest;

                cpf = cpf.replace(/[^\d]+/g,'');
                
                if (cpf.length != 11)
                    return false;

                if (cpf == "00000000000" || 
                    cpf == "11111111111" || 
                    cpf == "22222222222" || 
                    cpf == "33333333333" || 
                    cpf == "44444444444" || 
                    cpf == "55555555555" || 
                    cpf == "66666666666" || 
                    cpf == "77777777777" || 
                    cpf == "88888888888" || 
                    cpf == "99999999999")
                    return false;
                
                for (i=1; i<=9; i++) sum = sum + parseInt(cpf.substring(i-1, i)) * (11 - i);
                rest = (sum * 10) % 11;
                
                    if ((rest == 10) || (rest == 11))  rest = 0;
                    if (rest != parseInt(cpf.substring(9, 10)) ) return false;
                
                sum = 0;
                    for (i = 1; i <= 10; i++) sum = sum + parseInt(cpf.substring(i-1, i)) * (12 - i);
                    rest = (sum * 10) % 11;
                
                    if ((rest == 10) || (rest == 11))  rest = 0;
                    if (rest != parseInt(cpf.substring(10, 11) ) ) return false;

                    document.getElementById('cpf').value = cpf;
                    return true;
            }

            function checkUsername(username) {
                username = username.replace(/\s/g, '');
                username = username.replace(/[^a-z0-9]/gi,'');
                username = username.toLowerCase();
                document.getElementById('username').value = username;
                if(username.length < 3){
                    return false;
                } else {
                    return true;
                }

            }
            // Outras funcoes

            function getUsername() {
                let username = document.getElementById('username').value;
                username = username.replace(/\s/g, '');
                username = username.replace(/[^a-z0-9]/gi,'');
                username = username.toLowerCase();
                requestContent('<?php echo path::ROOT; ?>username/select', 'POST', 'username='+username, 'username');
            }

            function redirectPage(page){
                window.location.replace(page);
            }

            function addError(id){
                document.getElementById('span-'+id).style.display = 'block';
                addClass(id, 'inputError');  
            }

            function addClass(id, name) {
                const element = document.getElementById(id);
                let arr;
                arr = element.className.split(" ");
                if (arr.indexOf(name) == -1) {
                    element.className += " " + name;
                }
            }

            function removeError(e){
                const id = e.name;
                document.getElementById('span-'+id).style.display = 'none';
                removeClass(id, 'inputError');  
            }

            function removeClass(id, name) {
                const element = document.getElementById(id);
                element.className = element.className.replace(name, "");
            }

            function addPhone(){
                let phone = document.getElementById('phone').value;
                if(!checkPhone(phone)){
                    addError('phone');
                    return false;
                }
            }

            function addAddressByCEP(){
                let cep = document.getElementById('zipcode').value;
                cep = cep.replace(/[^\d]+/g,'');

                if(!checkCEP(cep)){
                    addError('zipcode');
                    return false;
                }
                requestContent('https://viacep.com.br/ws/'+cep+'/json/unicode/', 'GET', '', 'cep');
            }
        
        </script>
    </div>
</body></html>
