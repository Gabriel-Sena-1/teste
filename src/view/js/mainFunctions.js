document.addEventListener('DOMContentLoaded', function() {
    const filtroEmpresaInput = document.querySelector('#divFiltro input[type="text"]');
    const tabelasEmpresas = document.querySelectorAll('.tabelaEmpresas');

    filtroEmpresaInput.addEventListener('input', function() {
        const textoFiltro = this.value.trim().toLowerCase();

        tabelasEmpresas.forEach(tabela => {
            const nomeEmpresa = tabela.getAttribute('data-nome').toLowerCase();

            if (nomeEmpresa.includes(textoFiltro)) {
                tabela.style.display = ''; // Mostra a tabela se o nome corresponder ao filtro
            } else {
                tabela.style.display = 'none'; // Oculta a tabela se o nome não corresponder ao filtro
            }
        });
    });
});

function editarConta(idConta) {
    var popEditar = document.getElementById('popEditar');
    var idEditar = document.getElementById('id_conta_pagar');
    popEditar.style.display = 'flex';
    popEditar.style.flexDirection = 'column';
    popEditar.style.position = 'fixed';
    popEditar.style.top = '50%';
    popEditar.style.left = '50%';
    popEditar.style.transform = 'translate(-50%, -50%)';
    popEditar.style.zIndex = '1000';
    popEditar.style.backgroundColor = '#ffffff';
    popEditar.style.padding = '20px';
    popEditar.style.boxShadow = '0 0 20px rgba(0, 0, 0, 0.2)';
    popEditar.style.borderRadius = '5px';
    idEditar.value = idConta;
}

function ordenarTabela(button) {
    var tabela = button.closest('table');
    var tbody = tabela.querySelector('tbody');
    var rowsArray = Array.from(tbody.rows);
    var order = button.getAttribute('data-order');

    rowsArray.sort(function(a, b) {
        var valorA = parseFloat(a.cells[1].innerText.replace('R$', '').replace('.', '').replace(',', '.'));
        var valorB = parseFloat(b.cells[1].innerText.replace('R$', '').replace('.', '').replace(',', '.'));
        return (order === 'desc') ? valorB - valorA : valorA - valorB;
    });

    rowsArray.forEach(function(row) {
        tbody.appendChild(row);
    });

    // Alterna o estado de ordenação
    button.setAttribute('data-order', order === 'desc' ? 'asc' : 'desc');
}