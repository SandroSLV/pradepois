<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PraDepois - O fiado ao contrário</title>
        <link rel="icon" href="favicon.ico">
        <!-- NO CACHE -->
        <meta http-equiv="Cache" content="no-cache">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="-1">
        <!-- css -->
        <!--link rel="stylesheet" type="text/css" href="css/default.css" /-->

    </head>
    
<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;800&display=swap');
        * {
            margin: 0;
            padding:0;
            outline: 0;
            box-sizing: border-box; /* para nao aumentar o div quando aplicado o padding ou margin */
        }
        
        html, body{
            height: 100%;
        }
        
        body, input, button, select{
            font-family: Montserrat,Arial,Helvetica,sans-serif;
            color: #4f515d;
        }
        
        body{
            -webkit-font-smoothing: antialiased !important;
            -moz-osx-font-smoothing: grayscale !important;
            background-color: #fff;
        }

        a{
            text-decoration: none;
            color: #1ed3aa; 
        }
        
        h1, h2{
            font-size: 40px;
            font-weight: 800;
            color: #1ed3aa;
            margin-bottom: 20px;
        }
p{
    line-height: 1.75em;
}
        #cover{
            height: 100%;
            width: 100%;
            background: url(imgs/bg_services_0<?php echo rand(1, 5); ?>.jpg) no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            display: flex;
            flex-direction: row;
            align-items: center;

        }
        .content{
            margin: auto;
            width: 100%;
            max-width: 1024px;
            padding: 40px;
        }


        button {
            cursor: pointer;
            background-color: #1ed3aa;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            padding: 20px;
            width: 100%;
            border: 0;
        }

        .boxArrow{
                width: 36px;
                height: 3px;
                position: absolute;
                bottom: 40px;
                left: 50%;
                margin-left: -18px;
            }
        .arrow {
                opacity: 0;
                position: absolute;
                    left: 50%;
                    top: 50%;
                transform-origin: 50% 50%;
                transform: translate3d(-50%, -50%, 0);
            }

            .arrow-first {
                animation: arrow-movement 2s ease-in-out infinite;
            }
            .arrow-second {
                animation: arrow-movement 2s 1s ease-in-out infinite;
            }

            .arrow:before,
            .arrow:after {
                background: #fff;
                content: '';
                display: block;
                height: 3px; 
                position: absolute;
                    top: 0;
                    left: 0;
                width: 30px;
            }

            .arrow:before {
                transform: rotate(45deg) translateX(-23%);
                transform-origin: top left;
            }

            .arrow:after {
                transform: rotate(-45deg) translateX(23%);
                transform-origin: top right;
            }

            @keyframes arrow-movement {
                0% { 
                    opacity: 0;
                    top: 45%;
                }
                70% {
                    opacity: 1;
                }
                100% { 
                    opacity: 0;
                }
            }
#logo{
    max-width: 400px; margin-bottom: 50px;
}
            @media only screen and (max-width: 500px) {
                #logo{
                    max-width: 250px; margin-bottom: 50px;
                }
                #cover{
                    background: url(imgs/bg_services_00.jpg) no-repeat center center fixed; 
                }
            }
    </style>
    <div id="cover">
        <div class="content">
            <div style="display: flex; position:absolute; top: 40px;">
                <a href="app/login" style="color: #fff;"><strong>LOGIN</strong></a>
                
            </div>
            <img id='logo' src='imgs/logo_pra_depois.svg'>
            <h1>O fiado ao contrário</h1>
            <p style="max-width: 400px; font-size: 20px; line-height: 24px; margin-bottom: 40px;">Seu cliente compra agora e você só presta o serviço depois!</p>
            <button style="max-width: 350px;" onclick="window.location.href ='app/register';">CADASTRE-SE</button>
        </div>
        <div class="boxArrow">
            <div class="arrow arrow-first"></div>
        </div>
    </div>
    <div>
        <div class="content">
            <h2>O que é?</h2>
            <p>
                O PraDepois é uma plataforma onde micros e pequenos empresários podemos vender 
                seus serviços agora e só executá-los depois, quando tudo isso passar. A ideia é 
                garantir uma renda nesse momento tão difícil e fideliza ainda mais seus clientes.  
            </p>
            <br><br>

            <h2>Como funciona?</h2>
            <p>Você faz um cadastro em nosso site dando informações sobre seu estabelecimento 
                (nome, CNPJ, endereço, etc), depois cadastra os serviços prestados, então você compartilha 
                com seus clientes um link parecido com redes sociais como Instagram, contendo as informações 
                do seu negócio e a lista de serviços com opção de compra. Seu cliente acessa o link e 
                compra vouchers de serviços que só serão prestados depois que voltarmos a normalidade.</p>
            <br><br>
            
            <h2>O que são esses vouchers?</h2>
            <p>Pense nos vouchers como um ingresso para um show ou cinema, ou seja, ele é um compromisso que 
                seu cliente tem, que pagou pelo serviço o mesmo será prestado depois. A diferença é que a data 
                será indeterminada, mas assim que voltar ao normal, seu cliente será aviso e você poderá agendar 
                a prestação de serviço da melhor forma possível.</p>
            <br><br>

            <h2>Quem pode usar?</h2>
            <p>A plataforma foi pensada nos prestadores de serviços das seguintes categorias:</p><br>
            <ul style="margin-left: 40px; line-height: 1.75em;">
                <li>Assistência Técnica</li>
                <li>Aulas Particulares</li>
                <li>Autos</li>
                <li>Construção Manutenção Reforma</li>
                <li>Consultoria</li>
                <li>Design e Tecnologia</li>
                <li>Eventos</li>
                <li>Moda e Beleza</li>
                <li>Saúde</li>
                <li>Serviços Domésticos</li>
            </ul>
            <br><br>

            <h2>Quanto custa?</h2>
            <p>O uso da plataforma, até que seja normalizado tudo, será GRATUITO, mas 
                o empreendedor terá que arcar com as taxas de cartão de crédito do parceiro 
                (PagSeguro), que giram em torno de 4,99% para saque em 15 dias, mais R$ 0,40 
                fixo por venda.</p>
            <br><br>

            <h2>O que você precisa?</h2>
            <p>Para que você possa usar a plataforma só precisa ter uma empresa com CNPJ de 
                prestação de serviços e uma conta no PagSeguro (se não tiver não tem problema, 
                pode criar uma sem custo pelo site http://www.pagseguro.com.br/.</p>
            <br><br>
            
            <h2>Vamos cadastrar?</h2>
            <p>Sabemos que o momento atual não tá fácil para ninguém, e por isso queremos tentar 
                ajudar um pouquinho. Cadastra-se e comece a gerar sua renda agora mesmo. </p>
            <br><br>
            <button onclick="window.location.href ='app/register';">CADASTRE-SE</button>
        </div>
    </div>
</body>
</html>
