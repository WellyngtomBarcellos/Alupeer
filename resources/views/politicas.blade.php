<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/index.css')}}?v={{ time() }}">
    <link rel="stylesheet" href="{{asset('css/navbar/index.css')}}?v={{ time() }}">
    <link rel="stylesheet" href="{{asset('css/filter/filter.css')}}?v={{ time() }}">
    <link rel="stylesheet" href="{{asset('css/politica.css')}}?v={{ time() }}">


    <meta name="description"
        content="Leia os Termos e Condições e a Política de Privacidade do {{ config('app.name') }}. Entenda nossos compromissos com a sua segurança e privacidade ao utilizar nossos serviços.">
    <meta name="keywords"
        content="Termos e Condições, Política de Privacidade, {{ config('app.name') }}, segurança, privacidade, proteção de dados, uso de dados, responsabilidade, direitos do usuário">



    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/5a2e7b261b.js" crossorigin="anonymous"></script>

    <title>Termos e Condições | Política de Privacidade | {{ config('app.name') }}</title>

</head>

<body>
    <style>

    </style>
    <x-navbar :search="false"></x-navbar>

    <div class="image">
        <img loading="lazy"
            src="https://img.freepik.com/free-photo/group-people-working-out-business-plan-office_1303-15872.jpg?t=st=1723004987~exp=1723008587~hmac=58c4a25e20d8e67c919fdf5dfbb730d117763c8d3c5d3930795a1c51fdba865e&w=900"
            alt="">
    </div>

    <section>

        <h1>Termos de Uso</h1>
        <div class="container">
            <h2>Aceitação dos Termos</h2>
            <p>Ao acessar e utilizar nossos serviços, você concorda em cumprir e estar vinculado aos
                seguintes Termos de Uso.</p>
            <br>
            <h2>Descrição do Serviço</h2>
            <p>A {{env('APP_NAME')}}.com oferece uma plataforma para usuários alugarem e listarem produtos para locação.
                Os produtos disponíveis para aluguel são descritos e classificados em cada página do anúncio. O uso de
                nosso serviço
                é para fins
                pessoais e não comerciais, a menos que explicitamente autorizado.</p>
            <br>
            <h2>Registro e Conta</h2>
            <p>Para alugar produtos ou anunciar para aluguel, você deve se registrar e criar uma conta em nosso
                site. Você concorda em fornecer informações precisas e completas durante o registro e em manter suas
                informações atualizadas. É de sua responsabilidade manter a confidencialidade das credenciais da sua
                conta e informar-nos imediatamente sobre qualquer uso não autorizado de sua conta.</p>
            <br>
            <h2>Aluguel de Produtos</h2>
            <ul>
                <li>
                    <p><strong>Reservas</strong>: Você pode reservar produtos diretamente através de nosso site. A
                        confirmação de reserva
                        estará sujeita à disponibilidade e às condições especificadas pelo locador.</p>
                </li>
                <li>
                    <p><strong>Pagamento</strong>: O pagamento pelo aluguel dos produtos deve ser efetuado conforme os
                        métodos
                        disponíveis em nosso site. Todos os pagamentos são processados de forma segura pela plataforma
                        <a target="_blank" href="https://stripe.com/br">Stripe.com</a>.
                    </p>
                </li>
                <li>
                    <p><strong>Responsabilidade</strong>: Você é responsável pelo produto durante o período de locação e
                        deve devolvê-lo nas condições acordadas. Qualquer dano ou perda poderá resultar em
                        <strong>cobranças
                            adicionais, baixa classificação, restrições ou suspensão da conta.</strong>
                    </p>
                </li>
            </ul>
            <br>
            <h2>Listagem de Produtos</h2>
            <ul>
                <li>
                    <p><strong>Propriedade dos Itens</strong>: Você deve ter a propriedade ou autorização para listar o
                        item para aluguel. Todos os itens devem ser descritos com precisão e estar em condições de uso
                        seguras e classificados com cada degradação na sessão de desgaste do anúncio.
                    </p>
                </li>
                <li>
                    <p>
                        <strong>Regras de Listagem</strong>: Não é permitido listar produtos que sejam ilegais,
                        perigosos, ou que violem nossos termos, políticas ou a constituição brasileira.
                    </p>
                </li>
            </ul>
            <br>
            <h2>Cancelamento e Reembolsos</h2>
            <ul>
                <li>
                    <p><strong>Cancelamento por Parte do Locatário</strong>: O locatário pode cancelar uma reserva
                        conforme as políticas de cancelamento especificadas na descrição do produto. Reembolsos estarão
                        sujeitos às condições estabelecidas pelo locador.</p>
                </li>
                <li>
                    <p><strong>Cancelamento por Parte do Locador</strong>: O locador deve notificar o locatário com
                        antecedência adequada em caso de cancelamento. Dependendo das circunstâncias, o locatário poderá
                        receber um reembolso total ou parcial.</p>
                </li>
            </ul>
            <br>
            <h2>Uso Proibido</h2>
            <p>Você concorda em não usar nosso site para:</p>
            <ul>
                <li>
                    <p>Realizar atividades ilegais ou fraudulentas.</p>
                </li>
                <li>
                    <p>Transmitir vírus ou outros códigos maliciosos.</p>
                </li>
                <li>
                    <p>Interferir com o funcionamento do site ou de outras contas.</p>
                </li>
            </ul>
            <br>
            <h2>Propriedade Intelectual</h2>
            <p>Todos os direitos de propriedade intelectual relacionados ao nosso site e aos serviços oferecidos são de
                nossa propriedade ou licenciados para nós. Nenhum conteúdo pode ser reproduzido ou distribuído sem nossa
                autorização prévia.</p>
            <br>
            <h2>Modificações dos Termos</h2>
            <p>Podemos atualizar estes Termos de Uso periodicamente. Quaisquer alterações serão publicadas em nosso
                site, e seu uso contínuo do site após a publicação de alterações será considerado uma aceitação dessas
                mudanças.</p>
            <br>
            <h2>Limitação de Responsabilidade</h2>
            <p>Não nos responsabilizamos por quaisquer danos indiretos, consequenciais ou punitivos relacionados ao uso
                de nosso site ou ao aluguel de produtos. Nossa responsabilidade é limitada ao máximo permitido pela lei
                aplicável.</p>
            <br>
            <h2>Contato</h2>
            <p>Para qualquer dúvida ou preocupação sobre nossos Termos de Uso, entre em contato conosco através das
                informações fornecidas em nosso site.</p>
        </div>


    </section>
    <br><br><br>
    <div class="image">
        <img loading="lazy"
            src="https://img.freepik.com/free-photo/close-up-smiley-people-celebrating_23-2149008962.jpg?t=st=1723005255~exp=1723008855~hmac=7321a5d330c65e697e6242e19b52debf52328f71296347c2dc8409da5372dc46&w=900"
            alt="">
    </div>

    <section>
        <h1>Política de Privacidade</h1>
        <h2>Introdução</h2>
        <p>Esta Política de Privacidade descreve como coletamos, usamos, armazenamos e protegemos suas informações
            pessoais quando você usa nossos serviços. Ao acessar e utilizar nosso site, você concorda
            com as práticas descritas nesta política.</p>
        <br>
        <h2>Informações Coletadas</h2>
        <p>Coletamos as seguintes informações pessoais:</p>
        <ul>
            <li>
                <p><strong>Informações de Cadastro</strong>: Nome, endereço de e-mail, número de telefone, e informações
                    de pagamento
                    quando você cria uma conta ou faz uma reserva.</p>
            </li>
            <li>
                <p><strong>Informações de Transações</strong>: Detalhes sobre suas reservas e pagamentos.</p>
            </li>
            <li>
                <p><strong>Informações de Navegação</strong>: Dados sobre sua interação com nosso site, incluindo
                    localização,
                    tipo de navegador, e páginas acessadas.</p>
            </li>
        </ul>
        <br>
        <h2>Uso das Informações</h2>
        <p>Utilizamos suas informações pessoais para:</p>
        <ul>
            <li>
                <p><strong>Gerenciar Contas e Transações</strong>: Processar reservas, pagamentos e comunicação
                    relacionadas aos serviços.</p>
            </li>
            <li>
                <p><strong>Melhorar o Serviço</strong>: Analisar seu uso do site para melhorar a experiência do usuário
                    e nosso serviço.</p>
            </li>
            <li>
                <p><strong>Comunicação</strong>: Enviar notificações sobre atualizações, ofertas e informações
                    relevantes sobre sua conta e reservas.</p>
            </li>
        </ul>
        <br>
        <h2>Compartilhamento de Informações</h2>
        <p>Não vendemos, alugamos ou trocamos suas informações pessoais com terceiros. Podemos compartilhar suas
            informações nas seguintes circunstâncias:</p>
        <ul>
            <li>
                <p><strong>Com Prestadores de Serviços</strong>: Empresas que ajudam na operação do nosso site e
                    processamento de pagamentos, que estão contratualmente obrigadas a proteger suas informações.</p>
            </li>
            <li>
                <p><strong>Por Requisito Legal</strong>: Se exigido por lei ou para proteger nossos direitos legais.</p>
            </li>
        </ul>
        <br>
        <h2>Segurança</h2>
        <p>Adotamos medidas de segurança apropriadas para proteger suas informações pessoais contra acesso não
            autorizado, alteração, divulgação ou destruição. No entanto, nenhuma transmissão de dados pela internet ou
            armazenamento eletrônico é 100% seguro, e não podemos garantir a segurança absoluta.</p>
        <br>
        <h2>Seus Direitos</h2>
        <p>Você tem o direito de acessar, corrigir ou excluir suas informações pessoais que possuímos. Para exercer
            esses direitos, entre em contato conosco através das informações fornecidas abaixo.</p>
        <br>
        <h2>Cookies e Tecnologias Semelhantes</h2>
        <p>Utilizamos cookies e tecnologias semelhantes para melhorar sua experiência no site. Os cookies ajudam a
            lembrar suas preferências e a analisar o uso do site. Você pode ajustar as configurações do seu navegador
            para recusar cookies, mas isso pode afetar a funcionalidade do site.</p>
        <br>
        <h2>Links para Outros Sites</h2>
        <p>Nosso site pode conter links para sites de terceiros. Não somos responsáveis pela privacidade ou pelo
            conteúdo desses sites. Recomendamos que você leia as políticas de privacidade de qualquer site que visite.
        </p>
        <br>
        <h2>Alterações na Política de Privacidade</h2>
        <p>Podemos atualizar esta Política de Privacidade ocasionalmente. As alterações serão publicadas em nosso site,
            e seu uso contínuo após a publicação das alterações será considerado uma aceitação da nova política.</p>
        <br>
        <span>Última alteração 07/08/2024 01:16AM </span>
    </section>
    <br><br><br>
    <x-footer :top="true"></x-footer>

</body>

</html>