<script>
	$("#dropdown").change(function(){
		var idAmbient = $(this).val();
		window.location.replace("{{ url($baseRoute) }}/"+idAmbient);
	});
</script>