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
    if ($("[name='idClientes']").val()) {
        $("#nomeCliente").focus();
    } else {
        $("#documento").focus();
    }

    // INICIO FUNÇÃO DE MASCARA CPF/CNPJ
    if ($("[name='idClientes']").val()) {
        $("#nomeCliente").focus();
    } else {
        $("#documento").focus();
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
        if (typeof str === 'undefined') { return; }
        str = str.toLocaleLowerCase().split(" ");

        for (var i = 0, x = str.length; i < x; i++) {
            str[i] = str[i][0].toUpperCase() + str[i].substr(1);
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
        return false;
    }
}
    //finaliza a validação do CNPJ

    $('#buscar_info_cnpj').on('click', function () {
        // Pega o valor original do campo, sem remover letras
        var ndocumento = $('#documento').val().trim();

        if (validarCNPJ(ndocumento)) {
            // Se for CNPJ alfanumérico, exibe alerta e não faz requisição
            if (/^[A-Z0-9]{14}$/.test(ndocumento.replace(/[^A-Z0-9]/g, '')) && /[A-Z]/.test(ndocumento)) {
                Swal.fire({
                    icon: "info",
                    title: "Atenção",
                    text: "A consulta automática ainda não está disponível para o novo formato de CNPJ alfanumérico. Preencha os dados manualmente."
                });
                return;
            }

        //Nova variável "ndocumento" somente com dígitos.
        var ndocumento = $('#documento').val().replace(/\D/g, '');

            //Preenche os campos com "..." enquanto consulta webservice.
            $("#nomeCliente").val("...");
            $("#email").val("...");
            $("#cep").val("...");
            $("#rua").val("...");
            $("#numero").val("...");
            $("#bairro").val("...");
            $("#cidade").val("...");
            $("#estado").val("...");
            $("#complemento").val("...");
            $("#telefone").val("...");
            //Consulta o webservice receitaws.com.br/
            $.ajax({
                url: "https://www.receitaws.com.br/v1/cnpj/" + ndocumento,
                dataType: 'jsonp',
                crossDomain: true,
                contentType: "text/javascript",
                success: function (dados) {
                    if (dados.status == "OK") {
                        //Atualiza os campos com os valores da consulta.
                        if ($("#nomeCliente").val() != null) {
                            $("#nomeCliente").val(capital_letter(dados.nome));
                        }
                        if ($("#nomeEmitente").val() != null) {
                            $("#nomeEmitente").val(capital_letter(dados.nome));
                        }
                        $("#cep").val(dados.cep.replace(/\./g, ''));
                        $("#email").val(dados.email.toLocaleLowerCase());
                        $("#telefone").val(dados.telefone.split("/")[0].replace(/\ /g, ''));
                        $("#rua").val(capital_letter(dados.logradouro));
                        $("#numero").val(dados.numero);
                        $("#bairro").val(capital_letter(dados.bairro));
                        $("#cidade").val(capital_letter(dados.municipio));
                        $("#estado").val(dados.uf);
                        if (dados.complemento != "") {
                            $("#complemento").val(capital_letter(dados.complemento));
                        } else{
                            $("#complemento").val("");
                        }

                        // Força uma atualizacao do endereco via cep
                        //document.getElementById("cep").focus();
                        if ($("#nomeCliente").val() != null) {
                            document.getElementById("nomeCliente").focus();
                        }
                        if ($("#nomeEmitente").val() != null) {
                            document.getElementById("nomeEmitente").focus();
                        }
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        if ($("#nomeCliente").val() != null) {
                            $("#nomeCliente").val("");
                        }
                        if ($("#nomeEmitente").val() != null) {
                            $("#nomeEmitente").val("");
                        }
                        $("#cep").val("");
                        $("#email").val("");
                        $("#numero").val("");
                        $("#complemento").val("");
                        $("#telefone").val("");

                        Swal.fire({
                            type: "warning",
                            title: "Atenção",
                            text: "CNPJ não encontrado."
                        });
                    }
                },
                error: function () {
                    ///CEP pesquisado não foi encontrado.
                    if ($("#nomeCliente").val() != null) {
                        $("#nomeCliente").val("");
                    }
                    if ($("#nomeEmitente").val() != null) {
                        $("#nomeEmitente").val("");
                    }
                    $("#cep").val("");
                    $("#email").val("");
                    $("#numero").val("");
                    $("#complemento").val("");
                    $("#telefone").val("");

                    Swal.fire({
                        type: "warning",
                        title: "Atenção",
                        text: "CNPJ não encontrado."
                    });
                },
                timeout: 2000,
            });
        } else {
            Swal.fire({
                type: "warning",
                title: "Atenção",
                text: "CNPJ inválido!"
            });
        }
    });

    //Quando o campo cep perde o foco.
    $(".cep, #cep").blur(function () {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.

            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.

            if (validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#rua").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#estado").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/" + cep.replace(/\./g, '') + "/json/?callback=?", function (dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#rua").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                        $("#estado").val(dados.uf);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulario_cep();
                        Swal.fire({
                            type: "warning",
                            title: "Atenção",
                            text: "CEP não encontrado."
                        });
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulario_cep();
                Swal.fire({
                    type: "error",
                    title: "Atenção",
                    text: "Formato de CEP inválido."
                });
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulario_cep();
        }
    });
}); 

// assets/js/geocoding.js

/**
 * Busca coordenadas de geolocalização para um endereço.
 * Tenta primariamente com a API Nominatim e, em caso de falha, usa a API Photon como fallback.
 *
 * @param {string} street - O logradouro (rua, avenida, etc.).
 * @param {string} number - O número do endereço.
 * @param {string} neighborhood - O bairro.
 * @param {string} city - A cidade.
 * @param {string} state - O estado (UF).
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

    const queries = [
        `${street}, ${number}, ${neighborhood}, ${city}, ${state}, ${cep}, Brasil`, // Mais específico
        `${street}, ${number}, ${city}, ${state}, Brasil`, // Menos bairro e cep
        `${street}, ${city}, ${state}, Brasil` // Apenas rua, cidade e estado
    ];

    let currentQueryIndex = 0;

    function tryNextQuery() {
        if (currentQueryIndex >= queries.length) {
            if (errorCallback) {
                errorCallback('Coordenadas não encontradas. Verifique o endereço.');
            }
            return;
        }

        const encodedQuery = encodeURIComponent(queries[currentQueryIndex]);

        // Tenta com Nominatim primeiro
        $.getJSON(`https://nominatim.openstreetmap.org/search?format=json&q=${encodedQuery}&limit=1`)
            .done(data => {
                if (data && data.length > 0) {
                    successCallback({
                        lat: parseFloat(data[0].lat).toFixed(8),
                        lon: parseFloat(data[0].lon).toFixed(8)
                    });
                } else {
                    // Fallback para Photon se Nominatim não encontrar
                    geocodeWithPhoton(encodedQuery, successCallback, () => {
                        currentQueryIndex++;
                        tryNextQuery();
                    });
                }
            })
            .fail(() => {
                // Fallback para Photon se Nominatim falhar
                geocodeWithPhoton(encodedQuery, successCallback, () => {
                    currentQueryIndex++;
                    tryNextQuery();
                });
            });
    }

    tryNextQuery();
}

function geocodeWithPhoton(encodedQuery, successCallback, errorCallback) {
    $.getJSON(`https://photon.komoot.io/api/?q=${encodedQuery}&limit=1`)
        .done(photonData => {
            if (photonData.features && photonData.features.length > 0) {
                successCallback({
                    lat: parseFloat(photonData.features[0].geometry.coordinates[1]).toFixed(8),
                    lon: parseFloat(photonData.features[0].geometry.coordinates[0]).toFixed(8)
                });
            } else {
                if (errorCallback) {
                    errorCallback();
                }
            }
        })
        .fail(() => {
            if (errorCallback) {
                errorCallback();
            }
        });
}
