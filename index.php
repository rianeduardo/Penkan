<?php
include('./components/header.php');
?>

<!DOCTYPE html>
<html lang="PT-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PENKAN | Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="./assets/logoPenkan.svg" type="image/x-icon">
</head>

<body>

    <main class="homeHero">
        <div class="containerHero">
            <span class="destaque">// PLATAFORMA DE GERENCIAMENTO DE PENTESTS</span>
            <h1>Organize.<br>Domine.<br>Execute.<br><span class="destaque">Seus pentests.</span></h1>
            <p>Penkan é a plataforma feita por hackers, para hackers. Gerencie seus testes
                de invasão com eficiência, visualize vulnerabilidades, organize evidências,
                e entregue relatórios como um profissional.</p>
            <div class="botoesHero">
                <a href="registro.php" class="btnPrimario">> Começar agora</a>
                <a href="#fluxo" class="btnSecundario">Saiba mais ></a>
            </div>
        </div>
    </main>

    <section id="fluxo">
        <div class="containerFluxo">
            <div class="textosFluxo">
                <p>Feito para quem vive segurança ofensiva</p>
                <h1>Veja seu fluxo de trabalho com <span class="destaqueFluxo">PENKAN</span></h1>
            </div>
            <div class="wrapperCardsFluxo">
                <div class="cardFluxo">
                    <svg xmlns="http://www.w3.org/2000/svg" height="64px" viewBox="0 -960 960 960" width="64px"
                        fill="#0be545">
                        <path
                            d="M624-144v-108H444v-384H336v108H96v-288h240v108h288v-108h240v288H624v-108H516v312h108v-108h240v288H624ZM168-744v144-144Zm528 384v144-144Zm0-384v144-144Zm0 144h96v-144h-96v144Zm0 384h96v-144h-96v144ZM168-600h96v-144h-96v144Z" />
                    </svg>
                    <p class="tituloCard">1. Crie seu novo workspace</p>
                    <p class="descricaoCard">Abra uma nova área de trabalho e se prepare</p>
                    <p class="logoCard">PENKAN</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px"
                    fill="#0be545">
                    <path d="m576-288-51-51 105-105H192v-72h438L525-621l51-51 192 192-192 192Z" />
                </svg>
                <div class="cardFluxo">
                    <svg xmlns="http://www.w3.org/2000/svg" height="64px" viewBox="0 -960 960 960" width="64px"
                        fill="#0be545">
                        <path
                            d="M216-216h336v-192h192v-336H216v528Zm0 72q-29.7 0-50.85-21.15Q144-186.3 144-216v-528q0-29.7 21.15-50.85Q186.3-816 216-816h528q29.7 0 50.85 21.15Q816-773.7 816-744v360L576-144H216Zm72-264v-72h192v72H288Zm0-144v-72h384v72H288Zm-72 336v-528 528Z" />
                    </svg>
                    <p class="tituloCard">2. Organize seu pentest</p>
                    <p class="descricaoCard">Crie cards Kanban que definem o passo-a-passo do seu projeto</p>
                    <p class="logoCard">PENKAN</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px"
                    fill="#0be545">
                    <path d="m576-288-51-51 105-105H192v-72h438L525-621l51-51 192 192-192 192Z" />
                </svg>
                <div class="cardFluxo">
                    <svg xmlns="http://www.w3.org/2000/svg" height="64px" viewBox="0 -960 960 960" width="64px"
                        fill="#0be545">
                        <path
                            d="M216-216h51l375-375-51-51-375 375v51Zm-72 72v-153l498-498q11-11 23.84-16 12.83-5 27-5 14.16 0 27.16 5t24 16l51 51q11 11 16 24t5 26.54q0 14.45-5.02 27.54T795-642L297-144H144Zm600-549-51-51 51 51Zm-127.95 76.95L591-642l51 51-25.95-25.05Z" />
                    </svg>
                    <p class="tituloCard">3. Faça anotações detalhadas</p>
                    <p class="descricaoCard">Oferecemos um campo de anotações na seção de baixo do seu Workspace</p>
                    <p class="logoCard">PENKAN</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px"
                    fill="#0be545">
                    <path d="m576-288-51-51 105-105H192v-72h438L525-621l51-51 192 192-192 192Z" />
                </svg>
                <div class="cardFluxo">
                    <svg xmlns="http://www.w3.org/2000/svg" height="64px" viewBox="0 -960 960 960" width="64px"
                        fill="#0be545">
                        <path
                            d="M566-769.89q-14-13.88-14-34Q552-824 565.89-838q13.88-14 34-14Q620-852 634-838.11q14 13.88 14 34Q648-784 634.11-770q-13.88 14-34 14Q580-756 566-769.89Zm0 648q-14-13.88-14-34Q552-176 565.89-190q13.88-14 34-14Q620-204 634-190.11q14 13.88 14 34Q648-136 634.11-122q-13.88 14-34 14Q580-108 566-121.89Zm168-504q-14-13.88-14-34Q720-680 733.89-694q13.88-14 34-14Q788-708 802-694.11q14 13.88 14 34Q816-640 802.11-626q-13.88 14-34 14Q748-612 734-625.89Zm0 360q-14-13.88-14-34Q720-320 733.89-334q13.88-14 34-14Q788-348 802-334.11q14 13.88 14 34Q816-280 802.11-266q-13.88 14-34 14Q748-252 734-265.89Zm48-180q-14-13.88-14-34Q768-500 781.89-514q13.88-14 34-14Q836-528 850-514.11q14 13.88 14 34Q864-460 850.11-446q-13.88 14-34 14Q796-432 782-445.89ZM480-96q-79.38 0-149.19-30T208.5-208.5Q156-261 126-330.96t-30-149.5Q96-560 126-629.5q30-69.5 82.5-122T330.81-834q69.81-30 149.19-30v72q-130 0-221 91t-91 221q0 130 91 221t221 91v72Zm-51-333.15Q408-450.3 408-480v-9.5q0-4.5 2-9.5l-74-74 51-51 74 74q6-2 19-2 29.7 0 50.85 21.21 21.15 21.21 21.15 51T530.79-429q-21.21 21-51 21T429-429.15Z" />
                    </svg>
                    <p class="tituloCard">4. E veja o quanto seu trabalho melhora</p>
                    <p class="descricaoCard">Com nosso método observamos um fluxo de trabalho 54% mais rápido</p>
                    <p class="logoCard">PENKAN</p>
                </div>
            </div>
        </div>
    </section>

    <section id="recursos">
    <div class="containerRecursos">
        <div class="textosRecursos">
            <p>Ferramentas pensadas para pentesters modernos</p>
            <h1>Recursos que elevam seu <span class="destaqueRecursos">workflow</span></h1>
        </div>

        <div class="gridRecursos">

            <div class="cardRecurso">
                <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#0be545"><path d="M212-260q-90 0-151-65.5T0-482q0-90 61.5-154T212-700q36 0 69.5 12t59.5 37l93 90-42 42-89-87q-18-18-41.5-26t-49.5-8q-64 0-108 46.5T60-482q0 66 43.5 114T212-320q25 0 48.5-8t42.5-25l316-298q26-25 59.5-37t68.5-12q90 0 151.5 64T960-482q0 91-61.5 156.5T747-260q-35 0-69-11.5T619-308l-91-90 42-42 87 87q17 17 41 25t49 8q65 0 109-48t44-114q0-65-44.5-111.5T747-640q-25 0-48.5 9T657-605L341-307q-26 24-60 35.5T212-260Z"/></svg>
                <h2>Workspaces ilimitados gratuitos</h2>
                <p>Crie projetos sem limites e mantenha clientes e escopos em ambientes separados e fáceis de gerenciar.</p>

            </div>

            <div class="cardRecurso">
                <svg xmlns="http://www.w3.org/2000/svg" height="56px" viewBox="0 -960 960 960" width="56px"
                    fill="#0be545">
                    <path
                        d="M480-96q-79 0-149-30t-122-82q-52-52-82-122T96-480q0-79 30-149t82-122q52-52 122-82t149-30q79 0 149 30t122 82q52 52 82 122t30 149q0 79-30 149t-82 122q-52 52-122 82T480-96Zm0-72q130 0 221-91t91-221q0-130-91-221t-221-91q-130 0-221 91t-91 221q0 130 91 221t221 91Zm-36-144 228-228-51-51-177 177-105-105-51 51 156 156Z" />
                </svg>
                <h2>Gestão de vulnerabilidades</h2>
                <p>Registre, classifique e acompanhe vulnerabilidades com controle completo do status e evolução das correções aplicadas.</p>
            </div>

            <div class="cardRecurso">
<svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#0be545"><path d="M153-73q-33-33-33-81t33.25-81q33.25-33 80.75-33 14 0 24.5 2.5T280-258l85-106q-19-23-29-52.5t-5-61.5l-121-41q-15 25-39.5 39T114-466q-47.5 0-80.75-33.25T0-580q0-47.5 33.25-80.75T114-694q47.5 0 80.75 33.25T228-580v4l122 42q18-32 43.5-49t56.5-24v-129q-39-11-61.5-43T366-846q0-47.5 33-80.75T480-960q48 0 81 33.25T594-846q0 35-23 67t-61 43v129q31 7 57 24t44 49l121-42v-4q0-47.5 33.25-80.75T846-694q47.5 0 80.75 33T960-580q0 48-33.25 81T846-466q-32 0-57-14t-39-39l-121 41q5 32-4.5 61.5T595-364l85 106q11-5 21.5-7.5t24.06-2.5Q774-268 807-235t33 81q0 48-33 81t-81 33q-48 0-81-33.25T612-154q0-20 5.5-36t15.5-31l-85-106q-32.13 17-68.56 17Q443-310 411-327l-84 107q10 15 15.5 30.5T348-154q0 47.5-33 80.75T234-40q-48 0-81-33Zm-38.96-453q22.96 0 38.46-15.54 15.5-15.53 15.5-38.5 0-22.96-15.54-38.46-15.53-15.5-38.5-15.5Q91-634 75.5-618.46 60-602.93 60-579.96 60-557 75.54-541.5q15.53 15.5 38.5 15.5ZM272.5-115.54q15.5-15.53 15.5-38.5 0-22.96-15.54-38.46-15.53-15.5-38.5-15.5-22.96 0-38.46 15.54-15.5 15.53-15.5 38.5 0 22.96 15.54 38.46 15.53 15.5 38.5 15.5 22.96 0 38.46-15.54Zm246-692q15.5-15.53 15.5-38.5 0-22.96-15.54-38.46-15.53-15.5-38.5-15.5-22.96 0-38.46 15.54-15.5 15.53-15.5 38.5 0 22.96 15.54 38.46 15.53 15.5 38.5 15.5 22.96 0 38.46-15.54ZM480.5-370q37.5 0 63.5-26.5t26-64q0-37.5-26.1-63.5T480-550q-37 0-63.5 26.1T390-460q0 37 26.5 63.5t64 26.5Zm284 254.46q15.5-15.53 15.5-38.5 0-22.96-15.54-38.46-15.53-15.5-38.5-15.5-22.96 0-38.46 15.54-15.5 15.53-15.5 38.5 0 22.96 15.54 38.46 15.53 15.5 38.5 15.5 22.96 0 38.46-15.54Zm120-426q15.5-15.53 15.5-38.5 0-22.96-15.54-38.46-15.53-15.5-38.5-15.5-22.96 0-38.46 15.54-15.5 15.53-15.5 38.5 0 22.96 15.54 38.46 15.53 15.5 38.5 15.5 22.96 0 38.46-15.54ZM480-846ZM114-580Zm366 120Zm366-120ZM234-154Zm492 0Z"/></svg>
                <h2>Central de evidências categorizadas</h2>
                <p>Organize screenshots, payloads, logs e provas de conceito em um repositório central para consultas rápidas.</p>
            </div>

            <div class="cardRecurso">
<svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#0be545"><path d="M480-180q72 0 123-50.5T654-353v-167q0-72-51-122.5T480-693q-72 0-123 50.5T306-520v167q0 72 51 122.5T480-180Zm-80-140h160v-60H400v60Zm0-173h160v-60H400v60Zm80.5 57h-.5.5-.5.5-.5.5-.5.5Zm-.5 316q-65 0-121-31t-83-89H160v-60h92q-7-26-7-52.5V-406h-85v-60h85q0-29 .5-57.5T254-580h-94v-60h120q14-28 37-49t51-35l-77-76 40-40 94 94q28-10 56.5-10t56.5 10l94-94 40 40-76 76q28 14 49.5 35.5T683-640h117v60h-94q9 28 8.5 56.5T714-466h86v60h-86q0 27 .5 53.5T708-300h92v60H685q-26 59-82.5 89.5T480-120Z"/></svg>
                <h2>Relatórios profissionais para exportação</h2>
                <p>Gere relatórios claros e padronizados com as descobertas do projeto prontos para compartilhar com clientes.</p>
            </div>

            <div class="cardRecurso">
<svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#0be545"><path d="M377-377v-205h205v205H377Zm60-60h85v-85h-85v85Zm-77 317v-80H260q-24 0-42-18t-18-42v-100h-80v-60h80v-124h-80v-60h80v-100q0-24 18-42t42-18h100v-76h60v76h124v-76h60v76h100q24 0 42 18t18 42v100h76v60h-76v124h76v60h-76v100q0 24-18 42t-42 18H604v80h-60v-80H420v80h-60Zm344-140v-444H260v444h444ZM480-480Z"/></svg>
                <h2>Metodologia PENKAN Integrada</h2>
               <p>Siga um fluxo estruturado de trabalho com etapas de reconhecimento, exploração, pós-exploração e reporte.</p>
            </div>

            <div class="cardRecurso">
                <svg xmlns="http://www.w3.org/2000/svg" height="56px" viewBox="0 -960 960 960" width="56px"
                    fill="#0be545">
                    <path
                        d="M480-96q-79 0-149-30T209-208q-52-52-82-122T96-480q0-79 30-149t82-122q52-52 122-82t149-30q110 0 198.5 57.5T810-648H696v72h216v-216h-72v91q-54-74-145.5-118T480-864q-97 0-183 36.5T146.5-727Q86-666 50-580T14-480q0 97 36.5 183T146-146.5Q206-86 292-50t188 36q115 0 207.5-50.5T840-204l-62-36q-42 72-115.5 112T480-96Z" />
                </svg>
                <h2>Histórico e auditoria em tempo real</h2>
                <p>Acompanhe alterações, movimentações e atualizações do projeto com rastreabilidade completa das atividades.</p>
            </div>

            <div class="cardRecurso">
<svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#0be545"><path d="m150-400 82-80-82-82-80 82 80 80Zm573-10 87-140 88 140H723Zm-243-70q-50 0-85-35t-35-85q0-51 35-85.5t85-34.5q51 0 85.5 34.5T600-600q0 50-34.5 85T480-480Zm.35-180q-25.35 0-42.85 17.15t-17.5 42.5q0 25.35 17.35 42.85t43 17.5Q506-540 523-557.35t17-43Q540-626 522.85-643t-42.5-17Zm-.35 60ZM0-240v-53q0-39.46 42-63.23Q84-380 150.4-380q12.16 0 23.38.5 11.22.5 22.22 2.23-8 17.27-12 34.84-4 17.57-4 37.43v65H0Zm240 0v-65q0-65 66.5-105T480-450q108 0 174 40t66 105v65H240Zm570-140q67.5 0 108.75 23.77T960-293v53H780v-65q0-19.86-3.5-37.43T765-377.27q11-1.73 22.17-2.23 11.17-.5 22.83-.5Zm-330.2-10Q400-390 350-366q-50 24-50 61v5h360v-6q0-36-49.5-60t-130.7-24Zm.2 90Z"/></svg>
                <h2>Workspaces colaborativos ao vivo</h2>
                <p>Trabalhe em equipe simultaneamente compartilhando informações, tarefas e evidências em tempo real.</p>
            </div>

            <div class="cardRecurso">
<svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#0be545"><path d="M240-294 54-480l186-186 42 42-143 144 143 144-42 42Zm172 133-58-18 195-620 57 17-194 621Zm308-133-42-42 143-144-143-144 42-42 186 186-186 186Z"/></svg>
                <h2>Desenvolvido por Pentesters</h2>
<p>Criado por profissionais da segurança ofensiva para atender às necessidades reais encontradas em campo.</p>            </div>

        </div>
    </div>
</section>

    <section id="contato">
        <div class="containerContato">
            <div class="contatoEsquerda">
                <h1>Quer entrar em contato com nossa equipe?</h1>
                <div class="bulletContato">
                    <div class="bulletTextoIcon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px"
                            fill="#000">
                            <path
                                d="M240-384h336v-72H240v72Zm0-132h480v-72H240v72Zm0-132h480v-72H240v72ZM96-96v-696q0-29.7 21.15-50.85Q138.3-864 168-864h624q29.7 0 50.85 21.15Q864-821.7 864-792v480q0 29.7-21.15 50.85Q821.7-240 792-240H240L96-96Zm114-216h582v-480H168v522l42-42Zm-42 0v-480 480Z" />
                        </svg>
                        <div class="textosBullet">
                            <h1>Whatsapp SAC</h1>
                            <p>(19) 9 99999 9999 • 24/7</p>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px"
                        fill="#000">
                        <path d="m243-240-51-51 405-405H240v-72h480v480h-72v-357L243-240Z" />
                    </svg>
                </div>
                <div class="bulletContato">
                    <div class="bulletTextoIcon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px"
                            fill="#000">
                            <path
                                d="M168-192q-29.7 0-50.85-21.16Q96-234.32 96-264.04v-432.24Q96-726 117.15-747T168-768h624q29.7 0 50.85 21.16Q864-725.68 864-695.96v432.24Q864-234 842.85-213T792-192H168Zm312-240L168-611v347h624v-347L480-432Zm0-85 312-179H168l312 179Zm-312-94v-85 432-347Z" />
                        </svg>
                        <div class="textosBullet">
                            <h1>E-Mail SAC</h1>
                            <p>contatosac@penkan.com.br • 24/7</p>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px"
                        fill="#000">
                        <path d="m243-240-51-51 405-405H240v-72h480v480h-72v-357L243-240Z" />
                    </svg>
                </div>
                <div class="bulletContato">
                    <div class="bulletTextoIcon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px"
                            fill="#000">
                            <path
                                d="M480-264q72 0 120-49t48-119q0-69-48-118.5T480-600q-72 0-120 49.5t-48 119q0 69.5 48 118.5t120 49Zm0-72q-42 0-69-28.13T384-433q0-39.9 27-67.45Q438-528 480-528t69 27.55q27 27.55 27 67.45 0 40.74-27 68.87Q522-336 480-336ZM168-144q-29 0-50.5-21.5T96-216v-432q0-29 21.5-50.5T168-720h120l72-96h240l72 96h120q29.7 0 50.85 21.5Q864-677 864-648v432q0 29-21.15 50.5T792-144H168Zm0-72h624v-432H636l-72.1-96H396l-72 96H168v432Zm312-217Z" />
                        </svg>
                        <div class="textosBullet">
                            <h1>Nosso Instagram</h1>
                            <p>@penkan • Posts todos os dias</p>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px"
                        fill="#000">
                        <path d="m243-240-51-51 405-405H240v-72h480v480h-72v-357L243-240Z" />
                    </svg>
                </div>
                <div class="bulletContato">
                    <div class="bulletTextoIcon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px"
                            fill="#000">
                            <path
                                d="m291-240-51-51 189-189-189-189 51-51 189 189 189-189 51 51-189 189 189 189-51 51-189-189-189 189Z" />
                        </svg>
                        <div class="textosBullet">
                            <h1>Nosso X (Twitter)</h1>
                            <p>@penkantwt • Competições e mais</p>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px"
                        fill="#000">
                        <path d="m243-240-51-51 405-405H240v-72h480v480h-72v-357L243-240Z" />
                    </svg>
                </div>
                <div class="bulletContato">
                    <div class="bulletTextoIcon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px"
                            fill="#000">
                            <path
                                d="m456-384 264-168-264-168v336ZM312-240q-29.7 0-50.85-21.15Q240-282.3 240-312v-480q0-29.7 21.15-50.85Q282.3-864 312-864h480q29.7 0 50.85 21.15Q864-821.7 864-792v480q0 29.7-21.15 50.85Q821.7-240 792-240H312Zm0-72h480v-480H312v480ZM168-96q-29.7 0-50.85-21.15Q96-138.3 96-168v-552h72v552h552v72H168Zm144-696v480-480Z" />
                        </svg>
                        <div class="textosBullet">
                            <h1>Nosso YouTube</h1>
                            <p>PENKAN - Cybersec • Vídeos semanais</p>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px"
                        fill="#000">
                        <path d="m243-240-51-51 405-405H240v-72h480v480h-72v-357L243-240Z" />
                    </svg>
                </div>
            </div>
            <div class="contatoDireita">
            </div>
        </div>
    </section>

</body>
<?php
include('./components/footer.php')
    ?>

    <script src="https://unpkg.com/lenis@1.3.23/dist/lenis.min.js"></script> 

    <script>
        // Initialize Lenis
const lenis = new Lenis({
  autoRaf: true,
  anchors: true,
});

// Listen for the scroll event and log the event data
lenis.on('scroll', (e) => {
  console.log(e);
});
    </script>

</html>
