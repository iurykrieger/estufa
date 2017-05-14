<!-- resources/views/common/messages.blade.php -->
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
        $(document).ready(function() {
            displayMessage("Opa, algo deu errado!", "{{$error}}", "error");
            });
        </script>
    @endforeach
@endif
@if(session('successMessage'))
    <script>
        $(document).ready(function() {
            displayMessage("Tudo certo!", "{{ session('successMessage')}}", "success");
        });
    </script>
@elseif(session('warningMessage'))
    <script>
        $(document).ready(function() {
            displayMessage("Aviso!", "{{ session('warningMessage') }}", "warning");
        });
    </script>
@endif

<script>
    function confirmDelete(){
        event.preventDefault();
        swal({   
            title: "Você tem certeza que deseja deletar este registro?",   
            text: "Todos os registros dependentes dele também serão excluídos e você não poderá recuperar este registro!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",  
            confirmButtonText: "Sim, remover!",   
            cancelButtonText: "Não, cancelar!",   
            closeOnConfirm: false,
        }, 
        function(isConfirm){   
            if (isConfirm) {    
                $("#form-delete").submit();
            }
        });
    };
    function displayMessage(title, message, type){
        swal({
            title: title, 
            text: message,
            type: type,
            html: true
        });
    };
</script>
