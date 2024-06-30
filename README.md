# Projeto de Controle Financeiro de Contas a Pagar

Oi! Eu sou o Gabriel Sena, tenho 19 anos, e estou muito animado em compartilhar com vocês minha resolução do teste PHP da empresa. Vamos dar uma olhada no que fiz? 😊

## 📋 Estrutura do Banco de Dados

Conforme solicitado, criei duas tabelas principais no MySQL para gerenciar as empresas e suas respectivas contas a pagar.

### Tabela `tbl_empresa`
- `id_empresa` (INT, AUTO_INCREMENT, PRIMARY KEY)
- `nome` (VARCHAR(255), NOT NULL)

### Tabela `tbl_conta_pagar`
- `id_conta_pagar` (INT, AUTO_INCREMENT, PRIMARY KEY)
- `valor` (DECIMAL(10,2), NOT NULL)
- `data_pagar` (DATE, NOT NULL)
- `pago` (TINYINT, NOT NULL)
- `id_empresa` (INT, FOREIGN KEY REFERENCES `tbl_empresa(id_empresa)`)

## 🌐 Frontend em HTML & PHP

Então implementei uma página com campos para adicionar e editar contas a pagar, além de uma tabela para listar todas as contas. Também inclui filtros para facilitar a busca e visualização das contas.

### Campos para Adicionar/Editar Conta
1. **Empresa (Select)**: Lista todas as empresas cadastradas na tabela `tbl_empresa`.
2. **Data de Pagamento (Input Date)**: Seleciona a data de pagamento.
3. **Valor (Input)**: Insere o valor a ser pago.

### Funcionalidades
- **Inserir/Editar Conta**: Formulário para adicionar ou editar uma conta a pagar.
- **Listar Contas**: Tabela HTML que lista todas as contas cadastradas com botões para excluir, editar e marcar como paga.
- **Formatação de Valores**: Valores formatados no padrão brasileiro (EX: R$ 500,00).
- **Filtros**: 
  - Filtrar por nome da empresa.
  - Filtrar por valor a pagar (maior, menor ou igual).
  - Filtrar por data de pagamento.

## ⚙️ Regras de Negócio
- **Desconto de 5%**: Contas pagas antes da data de pagamento.
- **Sem Desconto**: Contas pagas no dia do pagamento.
- **Acréscimo de 10%**: Contas pagas após a data de pagamento.

## 💬 Mensagens de Alerta

Adicionei mensagens de alerta para confirmar a exclusão de contas e informar o valor atualizado dependendo da data de pagamento.

## 💡 Conclusão

Espero que você goste do meu projeto! Foi uma ótima oportunidade para aplicar meus conhecimentos em PHP, JavaScript e MySQL, além de aprender novas técnicas. Estou animado para fazer parte da equipe e contribuir com mais projetos legais!

**Gabriel Sena**
