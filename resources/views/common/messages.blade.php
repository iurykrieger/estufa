<!-- resources/views/common/messages.blade.php -->
@section('scripts')
    @if (count($errors) > 0)
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
        function displayMessage(title, message, type){
            swal({
                title: title, 
                text: message,
                type: type,
                html: true
            });
        };
    </script>
@endsection

