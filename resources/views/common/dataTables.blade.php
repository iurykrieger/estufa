<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script>
	$(document).ready(function() {
		$('#dataTable').DataTable({
			language: {
				"lengthMenu": "Mostrando _MENU_ leituras por página",
				"zeroRecords": "Descuple, nenhum registro encontrado",
				"info": "Mostrando página _PAGE_ de _PAGES_",
				"infoEmpty": "Nenhum registro existente",
				"infoFiltered": "(Filtrado de _MAX_ registros totais)",
				"search": "Buscar:",
				"paginate": {
					"first":      "Primeiro",
					"last":       "Último",
					"next":       "Próximo",
					"previous":   "Anterior"
				},
			},
			"autoWidth": false,
			responsive: true,
			autoWidth: false,
			pageLength: 50,
			paging:false,
			"order": [[ 0, "desc" ], [ 1, "desc" ]]
		});
	} );
</script>