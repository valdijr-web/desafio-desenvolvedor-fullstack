@extends('layouts.master')

@section('title', '- Usuários')
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Cadastrar de Usuário</h1>
    <!-- Formulário Cadatrar Usuário -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Adicionar Usuário</h6>
        </div>
        <div class="card-body">
            <div id="create-user-main-form" class="">
                <form role="form" id="user-form" action="{{ route('users.update', ['user' => $user]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="first_name">Nome</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"  placeholder="" required >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="last_name">Sobrenome</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"  placeholder="" required >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="document">Documento</label>
                            <input type="text" class="form-control" id="document" name="document"  placeholder="" required >
                        </div>
                    </div>
                    <div class="form-row">
                        
                        
                        <div class="form-group col-md-3">
                            <label for="birth_date">Data de Nascimento</label>
                            <input type="date"  class="form-control" id="birth_date" name="birth_date"  placeholder="" required >
                        </div>
                        <div class="form-group col-md-3">
                            <label for="phone_number">Telefone</label>
                            <input type="tel" class="form-control" id="phone_number" name="phone_number"  placeholder="" required >
                        </div>

                        <div class="form-group col-md-3">
                            <label for="email">Login / E-Mail</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="password">Senha</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // Obtém o ID do usuário da página
    const userId = "{{ $user->id }}";

    // Faz uma solicitação à API para buscar os dados do usuário
    axios.get(`/api/users/${userId}`)
        .then(response => {
            // Preenche os campos do formulário com os dados do usuário
            const userData = response.data;
            
            document.querySelector('input[name="first_name"]').value = userData.data.first_name;
            document.querySelector('input[name="last_name"]').value = userData.data.last_name;
            document.querySelector('input[name="document"]').value = userData.data.document;
            document.querySelector('input[name="email"]').value = userData.data.email;
            document.querySelector('input[name="phone_number"]').value = userData.data.phone_number;
            document.querySelector('input[name="birth_date"]').value = userData.data.birth_date;
            

        })
        .catch(error => {
            // Lógica de tratamento de erro, exiba mensagens de erro, etc.
        });
        document.getElementById('user-form').addEventListener('submit', function (e) {
            e.preventDefault(); // Impede a recarga da página
            // Limpe as mensagens de erro
            const errorDiv = document.getElementById('error-messages');
            errorDiv.innerHTML = '';
            errorDiv.style.display = 'none';
            
            const successDiv = document.getElementById('success-messages');
            successDiv.innerHTML = '';
            successDiv.style.display = 'none';

            const formData = new FormData(this);
            axios.post(this.action, formData)
                .then(response => {
                    // Exiba a mensagem de sucesso na div de mensagens de sucesso
                    const successDiv = document.getElementById('success-messages');
                    successDiv.innerHTML = 'Usuário alterado com sucesso!';
                    successDiv.style.display = 'block';
                })
                .catch(error => {
                    if (error.response && error.response.status === 422) {
                        // Erros de validação do Laravel
                        const errors = error.response.data.errors;
                        let errorMessage = 'Erro de validação:<br>';

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
        });
    </script>
@endsection