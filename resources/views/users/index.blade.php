@extends('layouts.master')

@section('title', '- Usuários')
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Usuários</h1>
    <!-- Formulário Cadatrar Usuário -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de  Usuário</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="user-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Sobrenome</th>
                            <th>Documento</th>
                            <th>Email</th>
                            <th>Data de Nascimento</th>
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
            const table = $('#user-table').DataTable({
                processing: true,
                serverSide: true, // Habilita o processamento do lado do servidor para paginação
                lengthMenu: [5, 10, 25, 50, 100], 
                searching: true,
                paginate: true,
                ajax: {
                    url: "{{ route('api.users.index') }}", // A rota da API para buscar dados
                    type: 'GET',
                },
                columns: [
                    { data: 'id' },
                    { data: 'first_name' },
                    { data: 'last_name' },
                    { data: 'document' },
                    { data: 'email' },
                    { data: 'birth_date' },
                ],
            });
        });
    </script>
@endsection