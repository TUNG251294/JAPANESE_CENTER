function deleteModal(targetId) {
    Swal.fire({
        title: "Sure you want to delete?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(targetId).submit();
        } else {
            Swal.close();
        }
    });
}
