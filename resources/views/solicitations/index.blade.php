@extends('layouts.master')

@section('title', '- Pedidos')
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Pedidos</h1>
    <!-- Formulário Cadatrar Usuário -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de  Pedidos</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="solicitation-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Descrição</th>
                            <th>Quantidade</th>
                            <th>Preço</th>
                            <th>Usuário</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Os dados da API serão inseridos aqui -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
         $(document).ready(function () {
            // Inicialize a tabela DataTable
            const table = $('#solicitation-table').DataTable({
                processing: true,
                serverSide: true, // Habilita o processamento do lado do servidor para paginação
                lengthMenu: [5, 10, 25, 50, 100], 
                searching: true,
                paginate: true,
                ajax: {
                    url: "{{ route('api.solicitations.index') }}", // A rota da API para buscar dados
                    type: 'GET',
                },
                columns: [
                    { data: 'id' },
                    { data: 'description' },
                    { data: 'quantity' },
                    { data: 'price' },
                    { data: 'user_id' },
                    {
                        data: null,
                        render: function (data, type, row) {
                            var editUrl = '{{ route("solicitations.edit", ":id") }}';
                            editUrl = editUrl.replace(':id', data.id);

                            var deleteUrl = '{{ route("solicitations.destroy", ":id") }}';
                            deleteUrl = deleteUrl.replace(':id', data.id);
                            return '<a href="' + editUrl + '" class="btn btn-primary btn-sm">Editar</a>' + ' <button action="' + deleteUrl + '"  type="button" class="btn btn-danger btn-sm delete-button">Deletar</button>';
                        }
                    }
                ],
                "language": {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
                    "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "Mostrar _MENU_ registros por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sSearch": "Pesquisar:",
                    "sZeroRecords": "Nenhum registro correspondente encontrado",
                    "oPaginate": {
                        "sFirst": "Primeiro",
                        "sLast": "Último",
                        "sNext": "Próximo",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Ative para ordenar a coluna em ordem crescente",
                        "sSortDescending": ": Ative para ordenar a coluna em ordem decrescente"
                    }
                }
            });
        });

        
        document.body.addEventListener('click', function(event) {
            if (event.target.classList.contains('delete-button')) {// Verifique se o botão clicado possui a classe 'delete-button'
                if (confirm('Tem certeza de que deseja excluir este pedido?')) {
                    var deleteAction = event.target.getAttribute('action'); // Obtenha o URL de exclusão
                    axios.delete(deleteAction)
                        .then(function(response) {
                            $('#solicitation-table').DataTable().ajax.reload(null, false);
                            // Exiba a mensagem de sucesso na div de mensagens de sucesso
                            const successDiv = document.getElementById('success-messages');
                            successDiv.innerHTML = 'Pedido excluído com sucesso!';
                            successDiv.style.display = 'block';
                        })
                        .catch(function(error) {
                            $('#user-table').DataTable().ajax.reload(null, false);
                            if (error.response && error.response.status === 422) {
                                // Erros 
                                const errors = error.response.data.errors;
                                let errorMessage = 'Erro!:<br>';

                                for (let field in errors) {
                                    errorMessage += `${errors[field][0]}<br>`;
                                }
                                // Exiba a mensagem de erro na div de mensagens de erro
                                const errorDiv = document.getElementById('error-messages');
                                errorDiv.innerHTML = errorMessage;
                                errorDiv.style.display = 'block';
                            } else {
                                // Outros erros
                                alert('Erro: ' + error.response.data.message);
                            }
                        });
                }
            }
        });
    </script>
@endsection