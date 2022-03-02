<script>
  function deleteConfirm(url){
    Swal.fire({
      title: "¿Deseas continuar con la eliminación?",
      showCancelButton: true,
      cancelButtonText: "Cancelar",
      confirmButtonText: "Continuar",
      confirmButtonColor: "red",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = url
      }
    })
  }
</script>