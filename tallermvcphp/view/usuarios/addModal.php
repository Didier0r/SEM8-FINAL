<script>
    $(document).ready(function () {
        $('#agregarConcepto').on('show.bs.modal', function () {
            $.ajax({
                url: '/controller/listUsuarios.php', 
                method: 'GET',
                success: function (data) {
                    $('#outer_div').html(data); 
                },
                error: function () {
                    $('#outer_div').html('<p>Error al cargar usuarios</p>');
                }
            });
        });
    });
</script>
