@extends('layouts.master')

@section('title', '- Pedidos')
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Alterar Pedido</h1>
    <!-- Formulário Cadatrar Usuário -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Alterar Pedido</h6>
        </div>
        <div class="card-body">
            <div id="create-user-main-form" class="">
            <form role="form" id="solicitation-form" action="{{ route('solicitations.update',  ['solicitation' => $solicitation ]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="description">Descrição</label>
                            <input type="text" class="form-control" id="description" name="description"  placeholder="" required >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="quantity">Quantidade</label>
                            <input type="number" class="form-control" id="quantity" name="quantity"  placeholder="" required >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="price">Preço</label>
                            <input type="text" class="form-control mask-money" id="price" name="price"  placeholder="" required >
                        </div>
                    </div>
                    
                    
                    <button type="submit" class="btn btn-primary">Alterar</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // Obtém o ID do usuário da página
    const solicitationId = "{{ $solicitation->id }}";
    // Faz uma solicitação à API para buscar os dados do usuário
    axios.get(`/api/solicitations/${solicitationId}`)
        .then(response => {
            // Preenche os campos do formulário com os dados do usuário
            const solicitationData = response.data;
            
            document.querySelector('input[name="description"]').value = solicitationData.data.description;
            document.querySelector('input[name="quantity"]').value = solicitationData.data.quantity;
            document.querySelector('input[name="price"]').value = solicitationData.data.price;

        })
        .catch(error => {
            // Lógica de tratamento de erro, exiba mensagens de erro, etc.
            console.log("Erro ao buscar dados do pedido");
        });
        document.getElementById('solicitation-form').addEventListener('submit', function (e) {
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
                    successDiv.innerHTML = 'Pedido alterado com sucesso!';
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