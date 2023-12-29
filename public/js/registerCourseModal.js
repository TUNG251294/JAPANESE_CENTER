function registerCourseModal() {
    Swal.fire({
        title: "Sure you want to register?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, register it!",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("register-course-form").submit();
        } else {
            Swal.close();
        }
    });
}
