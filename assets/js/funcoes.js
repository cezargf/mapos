$(function () {
    $("#celular").mask("(00) 00000-0000")
    $(".cep, #cep").mask("00000-000")
    $('#cpfUser').mask('000.000.000-00', { reverse: true });
    $('.cnpjEmitente').mask('00.000.000/0000-00', { reverse: true });
});

/* Funções de bloqueio de campos CPF/CNPJ para edição, após a instalação do sistema, para evitar que o usuário altere o CPF/CNPJ do cliente/emitente.
$(function () {
    if ($('.cpfcnpjmine').val() != null) {
        if ($('.cpfcnpjmine').val() != "") {
            $(".cpfcnpjmine").prop('readonly', true);
        }
    }
    if ($('.cpfUser').val() != null) {
        var cpfUser = $('.cpfUser').val().length;
        if (cpfUser == "14") {
            $(".cpfUser").prop('readonly', true);
        }
    }

});
*/

$(function () {
    var telefoneN = function (val) {
        return val.replace(/\D/g, '').length > 10 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
        telefoneOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(telefoneN.apply({}, arguments), options);
            },
        };
    $('.telefone, #telefone').mask(telefoneN, telefoneOptions);
    $('.telefone, #telefone').on('paste', function (e) {
        e.preventDefault();
        var clipboardCurrentData = (e.originalEvent || e).clipboardData.getData('text/plain');
        $('.telefone, #telefone').val(clipboardCurrentData);
    });

});

$(document).ready(function () {
    // INICIO FUNÇÃO DE MASCARA CPF/CNPJ
    if ($("[name='idClientes']").val()) {
        $("#nomeCliente").focus();
    } else {
        $("#documento").focus().select();
    }

    // Máscara dinâmica para CPF, CNPJ tradicional e CNPJ alfanumérico
    $('#documento').on('input', function () {
        let v = $(this).val().replace(/[^a-zA-Z0-9]/g, '').toUpperCase();
        let result = '';
        // CPF: 11 dígitos numéricos
        if (/^\d{0,11}$/.test(v)) {
            for (let i = 0; i < v.length && i < 11; i++) {
                if (i === 3 || i === 6) result += '.';
                if (i === 9) result += '-';
                result += v[i];
            }
        }
        // CNPJ tradicional: 14 dígitos numéricos
        else if (/^\d{12,14}$/.test(v) && !/[A-Z]/.test(v)) {
            for (let i = 0; i < v.length && i < 14; i++) {
                if (i === 2 || i === 5) result += '.';
                if (i === 8) result += '/';
                if (i === 12) result += '-';
                result += v[i];
            }
        }
        // CNPJ alfanumérico: 14 caracteres (letras e números)
        else {
            for (let i = 0; i < v.length && i < 14; i++) {
                if (i === 2 || i === 5) result += '.';
                if (i === 8) result += '/';
                if (i === 12) result += '-';
                result += v[i];
            }
        }
        $(this).val(result);
         // FIM FUNÇÃO DE MASCARA CPF/CNPJ
    });

    // Máscara dinâmica para o campo de telefone (ajusta entre 8 e 9 dígitos)
    var telefoneMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length > 10 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
        telefoneOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(telefoneMaskBehavior.apply({}, arguments), options);
            }
        };
    $('.telefone, #telefone').mask(telefoneMaskBehavior, telefoneOptions);

    function limpa_formulario_cep() {
        // Limpa valores do formulário de cep.
        $("#rua").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#estado").val("");
    }

    function capitalizeFirstLetter(string) {
        if (typeof string === 'undefined') {
            return;
        }

        return string.charAt(0).toUpperCase() + string.slice(1).toLocaleLowerCase();
    }

    function capital_letter(str) {
        if (typeof str === 'undefined' || str === null) {
            return '';
        }
        str = str.toLocaleLowerCase().split(" ");

        for (var i = 0, x = str.length; i < x; i++) {
            if (str[i]) { // Verifica se a parte da string não é vazia
                str[i] = str[i][0].toUpperCase() + str[i].substr(1);
            }
        }

        return str.join(" ");
    }

    // Valida CNPJ
    
    // Função auxiliar para calcular o DV alfanumérico
    function valorCharAlfanumerico(char) {
        const ascii = char.charCodeAt(0);
        return ascii - 48;
    }

    // Função auxiliar para calcular o DV alfanumérico
    function calcularDVAlfanumerico(cnpjBase) {
        let valores = cnpjBase.split('').map(valorCharAlfanumerico);

        // Cálculo do 1º DV
        let pesos1 = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        let soma1 = valores.reduce((acc, val, i) => acc + val * pesos1[i], 0);
        let resto1 = soma1 % 11;
        let dv1 = (resto1 === 0 || resto1 === 1) ? 0 : 11 - resto1;

        // Cálculo do 2º DV
        valores.push(dv1);
        let pesos2 = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        let soma2 = valores.reduce((acc, val, i) => acc + val * pesos2[i], 0);
        let resto2 = soma2 % 11;
        let dv2 = (resto2 === 0 || resto2 === 1) ? 0 : 11 - resto2;

        return `${dv1}${dv2}`;
    }

    function validarCNPJ(cnpj) {
        
        cnpj = cnpj.replace(/[^\w]/g, '').toUpperCase();
    
        // CNPJ numérico tradicional
        if (/^\d{14}$/.test(cnpj)) {
            if (/^(\d)\1{13}$/.test(cnpj)) {
                
                return false;
            }
    
            let tamanho = cnpj.length - 2;
            let numeros = cnpj.substring(0, tamanho);
            let digitos = cnpj.substring(tamanho);
    
            let soma = 0;
            let pos = tamanho - 7;
            for (let i = tamanho; i >= 1; i--) {
                soma += parseInt(numeros.charAt(tamanho - i)) * pos--;
                if (pos < 2) pos = 9;
            }
    
            let resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != parseInt(digitos.charAt(0))) {
               
                return false;
            }
    
            tamanho = tamanho + 1;
            numeros = cnpj.substring(0, tamanho);
            soma = 0;
            pos = tamanho - 7;
            for (let i = tamanho; i >= 1; i--) {
                soma += parseInt(numeros.charAt(tamanho - i)) * pos--;
                if (pos < 2) pos = 9;
            }
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    
            const valido = resultado == parseInt(digitos.charAt(1));
            return valido;
        }
    
        // CNPJ alfanumérico
        if (/^[A-Z0-9]{12}\d{2}$/.test(cnpj)) {
            let base = cnpj.substring(0, 12);
            let dv = cnpj.substring(12, 14);
            const calculado = calcularDVAlfanumerico(base);
            const valido = calculado === dv;
            return valido;
        }
    }

    // --- FUNÇÃO DE BUSCA DE CNPJ UNIFICADA ---
    $(document).on('click', '.btn-consultar-cnpj', function(e) {
        e.preventDefault();
        // Prioriza o modal como container para garantir que o loading seja aplicado no .modal-body.
        const modal = $(this).closest('.modal');
        const container = modal.length ? modal : $(this).closest('form');
        
        // Procura por ambos os nomes de campo de documento
        const cnpjField = container.find('input[name="cnpj"], input[name="documento"]');
        const cnpj = cnpjField.val().replace(/\D/g, '');

        if (cnpj.length !== 14) {
            Swal.fire({ icon: 'error', title: 'Atenção', text: 'CNPJ inválido!' });
            return;
        }

        // Adiciona o efeito de loading
        const loadingTarget = container.is('.modal') ? container.find('.modal-body').first() : container;
        loadingTarget.addClass('loading');
        
        // Seta "..." nos campos para indicar carregamento
        const fieldsToReset = [
            'input[name="nome"]', 'input[name="nome_fantasia"]', 'input[name="nomeCliente"]', 'input[name="cep"]', 
            'input[name="logradouro"]', 'input[name="rua"]', 'input[name="numero"]', 
            'input[name="bairro"]', 'input[name="email"]', 'input[name="telefone"]', 'input[name="tipo"]'
        ].join(', ');
        container.find(fieldsToReset).val('...');

        $.ajax({
            url: `https://www.receitaws.com.br/v1/cnpj/${cnpj}`,
            dataType: 'jsonp',
            crossDomain: true,
            timeout: 10000
        }).done(function(data) {
            loadingTarget.removeClass('loading');

            if (data.message === "Too Many Requests") {
                Swal.fire({ icon: 'error', title: 'Atenção', text: 'Você atingiu o limite de 03 consultas de CNPJ por minuto. Por favor, aguarde um minuto antes de tentar novamente.' });
                container.find('input[type="text"], textarea').val('');
                container.find('select').val('').trigger('change');
                return;
            }

            if (data.status === 'OK') {
                // --- Preenchimento de campos ---
                // Nomes (Razão Social e Fantasia)
                container.find('[name="nome"], [name="nomeCliente"]').val(capital_letter(data.nome));
                container.find('[name="nome_fantasia"], [name="fantasia"]').val(capital_letter(data.fantasia));
                
                // Endereço
                container.find('[name="logradouro"], [name="rua"]').val(capital_letter(data.logradouro));
                container.find('[name="numero"]').val(data.numero);
                container.find('[name="bairro"]').val(capital_letter(data.bairro));
                container.find('[name="complemento"]').val(capital_letter(data.complemento));
                
                // Contato
                container.find('[name="telefone"]').val(data.telefone.split('/')[0].replace(/\s/g, ''));
                container.find('[name="email"]').val(data.email.toLowerCase());

                // --- Campos específicos ---
                container.find('[name="situacao"]').val(data.situacao);
                container.find('[name="porte"]').val(capital_letter(data.porte));
                container.find('[name="tipo"]').val((data.tipo || '').toUpperCase());
                container.find('[name="data_abertura"]').val(data.abertura).mask("00/00/0000");
                container.find('[name="data_situacao"]').val(data.data_situacao).mask("00/00/0000");
                container.find('[name="motivo_situacao"]').val(data.motivo_situacao);
                container.find('[name="situacao_especial"]').val(data.situacao_especial);
                container.find('[name="data_situacao_especial"]').val(data.data_situacao_especial).mask("00/00/0000");
                container.find('[name="natureza_juridica"]').val(data.natureza_juridica);
                container.find('[name="capital_social"]').val(data.capital_social).mask("#.##0,00", { reverse: true });
                
                // Atividades (Principal e Secundárias)
                container.find('[name="atividade_principal"]').val(data.atividade_principal[0]?.text || '');
                if (data.atividades_secundarias && data.atividades_secundarias.length > 0) {
                    const secundariasText = data.atividades_secundarias.map(a => a.text).join('\n');
                    container.find('[name="atividades_secundarias"]').val(secundariasText);
                }
                
                if (data.qsa && data.qsa.length > 0) {
                    const qsaText = data.qsa.map(socio => `Sócio: ${socio.nome}\nQualificação: ${socio.qual}`).join('\n\n');
                    container.find('[name="qsa"]').val(qsaText);
                }

                // Preenche CNAE (se for select/Select2)
                const cnaeSelect = container.find('select[name="cnae"]');
                if (cnaeSelect.length && data.atividade_principal && data.atividade_principal.length > 0) {
                    const cnaeData = data.atividade_principal[0];
                    const cnaeCode = cnaeData.code.replace(/[^0-9]/g, '');
                    const cnaeCodeFormatted = formatCnae(cnaeCode);
                    if (cnaeSelect.find("option[value='" + cnaeCode + "']").length === 0) {
                        const newOption = new Option(cnaeCodeFormatted, cnaeCode, true, true);
                        cnaeSelect.append(newOption);
                    }
                    cnaeSelect.val(cnaeCode).trigger('change');
                } else {
                    // Fallback para input de texto
                    container.find('input[name="cnae"]').val(data.atividade_principal[0]?.code.replace(/[^0-9]/g, ''));
                }

                // Dispara a busca de CEP para preencher estado, cidade e IBGE
                const cepField = container.find('input[name="cep"]');
                if (cepField.length && data.cep) {
                    cepField.val(data.cep.replace(/\./g, '')).trigger('blur');
                }

            } else {
                Swal.fire({ icon: 'error', title: 'Atenção', text: `CNPJ não encontrado: ${data.message}` });
                container.find('input[type="text"], textarea').val('');
                container.find('select').val('').trigger('change');
            }
        }).fail(function(jqXHR) {
            loadingTarget.removeClass('loading');
            container.find('input[type="text"], textarea').val('');
            container.find('select').val('').trigger('change');
            
            let errorMessage = 'Não foi possível consultar o CNPJ. Verifique sua conexão ou tente novamente.';
            if (jqXHR.status === 429) {
                errorMessage = 'Você atingiu o limite de 03 consultas de CNPJ por minuto. Por favor, aguarde um minuto antes de tentar novamente.';
            }
            
            Swal.fire({ icon: 'error', title: 'Atenção', text: errorMessage });
        });
    });

    //Quando o campo cep perde o foco.
    $(".cep, #cep").blur(function () {
        var cepInput = $(this);
        // Tenta encontrar um contexto próximo, senão usa o body como fallback.
        var context = cepInput.closest('form, .modal, .widget-content');
        if (context.length === 0) {
            context = $('body');
        }

        var cep = cepInput.val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {
            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {
                // Seletores mais robustos
                var ruaInput = context.find('input[name="rua"], input[name="logradouro"]');
                var bairroInput = context.find('input[name="bairro"]');
                var estadoSelect = context.find('select[name="uf"], select[name="estado"]');
                var cidadeSelect = context.find('select[name="cidade_select"]');
                var cidadeInput = context.find('input[name="cidade"]');
                var estadoInput = context.find('input[name="uf"], input[name="estado"]');
                var ibgeInput = context.find('input[name="codigo_ibge"]');

                // Animação de carregamento
                ruaInput.val('...');
                bairroInput.val('...');
                if (cidadeSelect.length === 0 && cidadeInput.is('input[type="text"]')) cidadeInput.val('...');
                if (estadoSelect.length === 0 && estadoInput.is('input[type="text"]')) estadoInput.val('...');

                $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function (dados) {
                    if (!("erro" in dados)) {
                        ruaInput.val(dados.logradouro);
                        bairroInput.val(dados.bairro);
                        if (ibgeInput.length) ibgeInput.val(dados.ibge);

                        // Prioriza Selects se existirem
                        if (estadoSelect.length) {
                            estadoSelect.val(dados.uf).trigger('change');
                        } else {
                            estadoInput.val(dados.uf);
                        }

                        if (cidadeSelect.length) {
                            const cityName = dados.localidade;
                            const cityIbge = dados.ibge;
                            
                            if (cidadeSelect.find(`option[value='${cityName}']`).length) {
                                cidadeSelect.val(cityName).trigger('change');
                            } else {
                                var newOption = new Option(cityName, cityName, true, true);
                                $(newOption).attr('data-ibge', cityIbge);
                                cidadeSelect.append(newOption).trigger('change');
                            }

                            cidadeSelect.trigger({
                                type: 'select2:select',
                                params: { data: { id: cityName, text: cityName, ibge: cityIbge } }
                            });

                            var hiddenCityName = context.find('input[name="cidade"]');
                            if(hiddenCityName.attr('type') === 'hidden') {
                                hiddenCityName.val(cityName);
                            }
                        } else {
                            cidadeInput.val(dados.localidade);
                        }
                    } else {
                        limpa_formulario_cep();
                        Swal.fire({ type: 'warning', title: 'Atenção', text: 'CEP não encontrado.' });
                    }
                }).fail(function() {
                    limpa_formulario_cep();
                    Swal.fire({ type: 'error', title: 'Atenção', text: 'Não foi possível consultar o CEP.' });
                });
            } else {
                //cep é inválido.
                limpa_formulario_cep();
                Swal.fire({
                    type: "error",
                    title: "Atenção",
                    text: "Formato de CEP inválido."
                });
            }
        } else {
            //cep sem valor, limpa formulário.
            limpa_formulario_cep();
        }
    });

    // Máscara para o campo de pesquisa do Select2 para o campo CNAE
    $('select[name="cnae"]').on('select2:open', function(e) {
        setTimeout(() => {
            // O seletor '.select2-container--open .select2-search__field' garante
            // que estamos selecionando o campo de busca do select2 que está aberto no momento.
            const searchField = document.querySelector('.select2-container--open .select2-search__field');
            if (searchField) {
                // Aplica a máscara de CNAE.
                $(searchField).mask('0000-0/00');
            }
        }, 50); // Um pequeno atraso para garantir que o campo foi renderizado.
    });
}); 

// assets/js/geocoding.js

/**
 * Busca coordenadas de geolocalização para um endereço.
 * Tenta primariamente com a API Nominatim (busca estruturada), depois Nominatim (busca livre),
 * e por fim, usa a API Photon como fallback com duas tentativas (com e sem bairro).
 *
 * @param {string} street - O logradouro (rua, avenida, etc.).
 * @param {string} number - O número do endereço.
 * @param {string} neighborhood - O bairro.
 * @param {string} city - A cidade.
 * @param {string} state - O estado (UF).
 * @param {string} cep - O CEP.
 * @param {function(object): void} successCallback - Função a ser chamada em caso de sucesso. Recebe um objeto com as chaves 'lat' e 'lon'.
 * @param {function(string): void} errorCallback - Função a ser chamada em caso de erro. Recebe uma mensagem de erro.
 */
function geocodeAddress(street, number, neighborhood, city, state, cep, successCallback, errorCallback) {
    if (!street || !city || !state) {
        if (errorCallback) {
            errorCallback('Por favor, preencha o endereço completo.');
        }
        return;
    }

    const fullAddressQuery = `${street}, ${number}, ${neighborhood}, ${city}, ${state}, ${cep}, Brasil`;
    const addressWithoutNeighborhoodQuery = `${street}, ${number}, ${city}, ${state}, ${cep}, Brasil`;


    // Função auxiliar para chamar a API Photon
    function geocodeWithPhoton(query, callback, nextFallback) {
        $.getJSON(`https://photon.komoot.io/api/?q=${encodeURIComponent(query)}&limit=1`)
            .done(photonData => {
                if (photonData.features && photonData.features.length > 0) {
                    callback({
                        lat: parseFloat(photonData.features[0].geometry.coordinates[1]).toFixed(8),
                        lon: parseFloat(photonData.features[0].geometry.coordinates[0]).toFixed(8)
                    });
                } else {
                    if (nextFallback) {
                        nextFallback();
                    } else if (errorCallback) {
                        errorCallback('Coordenadas não encontradas via Photon. Verifique o endereço.');
                    }
                }
            })
            .fail(() => {
                if (nextFallback) {
                    nextFallback();
                } else if (errorCallback) {
                    errorCallback('Erro ao consultar API Photon. Verifique sua conexão ou tente novamente.');
                }
            });
    }


    // 1. Tentativa Nominatim: Busca puramente estruturada (sem 'q')
    const nominatimParams1 = {
        street: `${number} ${street}, ${neighborhood}`,
        city: city,
        state: state,
        postalcode: cep,
        country: 'Brasil',
        format: 'json',
        limit: 1,
        addressdetails: 1
    };

    $.getJSON('https://nominatim.openstreetmap.org/search', nominatimParams1)
        .done(data => {
            if (data && data.length > 0) {
                successCallback({
                    lat: parseFloat(data[0].lat).toFixed(8),
                    lon: parseFloat(data[0].lon).toFixed(8)
                });
            } else {
                // 2. Tentativa Nominatim: Busca puramente livre (com 'q')
                $.getJSON(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(fullAddressQuery)}&limit=1`)
                    .done(data2 => {
                        if (data2 && data2.length > 0) {
                            successCallback({
                                lat: parseFloat(data2[0].lat).toFixed(8),
                                lon: parseFloat(data2[0].lon).toFixed(8)
                            });
                        } else {
                            // 3. Tentativa Photon: Com bairro
                            geocodeWithPhoton(fullAddressQuery, successCallback, () => {
                                // 4. Tentativa Photon: Sem bairro (se a anterior falhar)
                                geocodeWithPhoton(addressWithoutNeighborhoodQuery, successCallback);
                            });
                        }
                    })
                    .fail(() => {
                        // 3. Tentativa Photon: Com bairro (se a segunda Nominatim falhar)
                        geocodeWithPhoton(fullAddressQuery, successCallback, () => {
                            // 4. Tentativa Photon: Sem bairro (se a anterior falhar)
                            geocodeWithPhoton(addressWithoutNeighborhoodQuery, successCallback);
                        });
                    });
            }
        })
        .fail(() => {
            // 3. Tentativa Photon: Com bairro (se a primeira Nominatim falhar)
            geocodeWithPhoton(fullAddressQuery, successCallback, () => {
                // 4. Tentativa Photon: Sem bairro (se a anterior falhar)
                geocodeWithPhoton(addressWithoutNeighborhoodQuery, successCallback);
            });
        });
}

// Função para formatar o código CNAE (XX.XX-X-XX)
function formatCnae(cnae) {
    if (!cnae) {
        return '';
    }
    // Remove caracteres não numéricos
    cnae = String(cnae).replace(/[^0-9]/g, '');

    // Aplica a máscara XXXX-X-XX
    if (cnae.length === 7) {
        return cnae.substring(0, 4) + '-' +
               cnae.substring(4, 5) + '/' +
               cnae.substring(5, 7);
    }
    return cnae; // Retorna como está se o comprimento não for 7
}

// Validar email
function isValidEmail(email) {
    let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

// Escape HTML
function escapeHtml(text) {
    if (!text) return '';
    return text.replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
}